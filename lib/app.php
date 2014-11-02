<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */
class jpWotApp
{
	/**
	 * @var tbApp
	 */
	static private $_appInstance = null;

	/**
	 * @var string
	 */
	protected $_pageKey = '';

	/**
	 * @var string
	 */
	protected $_subKey = '';

	/**
	 * @return string
	 */
	public function getPageKey()
	{
		return $this->_pageKey;
	}

	/**
	 * @return string
	 */
	public function getSubKey()
	{
		return $this->_subKey;
	}

	/**
	 * Invokes the whole application.
	 */
	public function invoke()
	{
		$this->_pageKey = getGetValue('page', 'accounts');
		$this->_subKey = getGetValue('sub');

		$language = jpWotLanguage::getInstance();
		$language->load('main', BPATH);
		$language->load('filter', BPATH);
		$language->load($this->_pageKey, BPATH);

		$controller = $this->getControllerInstance();

		if(!empty(getPostValue('request'))) {
			$controller->setRequestData(getPostValue('request'));
		}

		$controller->index();
	}

	/**
	 * @return jpWotApp
	 */
	public static function getInstance()
	{
		if(self::$_appInstance === null) {
			self::$_appInstance = new self();
		}

		return self::$_appInstance;
	}

	/**
	 * @param string $key
	 * @return false|jpWotController
	 */
	public function getControllerInstance($key = '')
	{
		$class = 'jpWotController'.ucfirst(strtolower($key));

		if(class_exists($class)) {
			$controller = new $class;

			return $controller;
		}

		return new tbController();
	}

	/**
	 * @param string $key
	 * @return false|jpWotView
	 */
	public function getViewInstance($key)
	{
		$class = 'jpWotView'.ucfirst(strtolower($key));

		if(class_exists($class)) {
			$view = new $class;

			return $view;
		}

		return false;
	}

	/**
	 * @param string $key
	 * @return false|JpWotModel
	 */
	public function getModelInstance($key)
	{
		$class = 'jpWotModel'.ucfirst(strtolower($key));

		if(class_exists($class)) {
			$model = new $class;

			return $model;
		}

		$class = 'jpWotModel';

		if(class_exists($class)) {
			$model = new $class;

			return $model;
		}

		return false;
	}
}
