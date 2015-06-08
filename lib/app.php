<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
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

		$sessionLang = jpWotSession::get('active_language');

		if(empty($sessionLang)) {
			jpWotSession::set (
				'active_language',
				strtolower(trim(jpWotConfig::$lang))
			);
		}

		$changeLang = getPostValue('lang');

		if(
			isset($changeLang['current'], $changeLang['new'])
			&& $changeLang['current'] != $changeLang['new']
		) {
			jpWotSession::set('active_language', $changeLang['new']);
			$langKey = $changeLang['new'];
		} else {
			$langKey = jpWotSession::get('active_language');
		}

		$langKey = $this->getIniLanguageKey($langKey);
		$language = jpWotLanguage::getInstance();
		$language->load('main', BPATH, $langKey);
		$language->load('filter', BPATH, $langKey);
		$language->load($this->_pageKey, BPATH, $langKey);

		$controller = $this->getControllerInstance();

		$page = getPostValue('request');

		if(!empty($page)) {
			$controller->setRequestData($page);
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

	/**
	 * Returns the needed language key for the ini files, e.g. "en-GB" or "de-DE"
	 */
	public function getIniLanguageKey($key)
	{
		switch($key) {
			case 'en':
				return 'en-GB';

			default:
				return strtolower($key).'-'.strtoupper($key);
		}
	}
}
