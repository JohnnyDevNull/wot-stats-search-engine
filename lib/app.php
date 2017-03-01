<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseApp
{
	/**
	 * @var jpWseApp
	 */
	static private $appInstance = null;

	/**
	 * @var string
	 */
	protected $page = '';

	/**
	 * @var string
	 */
	protected $subPage = '';

	/**
	 * @return string
	 */
	public function getPageKey()
	{
		return $this->page;
	}

	/**
	 * @return string
	 */
	public function getSubKey()
	{
		return $this->subPage;
	}

	/**
	 * Invokes the whole application.
	 */
	public function invoke()
	{
		$this->page = strip_tags(getGetValue('page', 'accounts'));
		$this->subPage = strip_tags(getGetValue('sub'));

		$sessionLang = jpWseSession::get('active_language');

		if(empty($sessionLang)) {
			jpWseSession::set (
				'active_language',
				strtolower(trim(jpWseConfig::$lang))
			);
		}

		$changeLang = getPostValue('lang');

		if(
			isset($changeLang['current'], $changeLang['new'])
			&& $changeLang['current'] != $changeLang['new']
		) {
			jpWseSession::set('active_language', $changeLang['new']);
			$langKey = $changeLang['new'];
		} else {
			$langKey = jpWseSession::get('active_language');
		}

		$langKey = $this->getIniLanguageKey($langKey);
		$language = jpWseLanguage::getInstance();
		$language->load('main', BPATH, $langKey);
		$language->load('filter', BPATH, $langKey);

		$controller = $this->getControllerInstance();

		$request = [];
		$staticKey = getGetValue('static');

		if(empty($staticKey)) {
			$request = getPostValue('request');

			if(!empty($request)) {
				if(empty($request['game'])) {
					$request['game'] = strip_tags(getPostValue('game'));

					if(empty($request['game'])) {
						$request['game'] = jpWseConfig::$game;
					}
				}
			}
		} else {
			$item = $this->getStaticItemByKey($staticKey);

			if(!empty($item['page'])) {
				$this->page = $item['page'];

				if(!empty($item['params'])) {
					$request = $item['params'];
					$request['page'] = $this->page;
				}
			}
		}

		$language->load($this->page, BPATH, $langKey);

        $controller->setRequestData($request);
        $controller->index();
	}

	/**
	 * @return jpWseApp
	 */
	public static function getInstance()
	{
		if(self::$appInstance === null) {
			self::$appInstance = new self();
		}

		return self::$appInstance;
	}

	/**
	 * @param string $key [optional] default: ''
	 * @return false|jpWseController
	 */
	public function getControllerInstance($key = '')
	{
		$class = 'jpWseController'.ucfirst(strtolower($key));

		if(class_exists($class)) {
			$controller = new $class;

			return $controller;
		}

		return new jpWseController();
	}

	/**
	 * @param string $key
	 * @return false|jpWseView
	 */
	public function getViewInstance($key)
	{
		$class = 'jpWseView'.ucfirst(strtolower($key));

		if(class_exists($class)) {
			$view = new $class;

			return $view;
		}

		return false;
	}

	/**
	 * @param string $key
	 * @return false|jpWseModel
	 */
	public function getModelInstance($key)
	{
		$class = 'jpWseModel'.ucfirst($key);

		if(class_exists($class)) {
			$model = new $class;

			return $model;
		}

		$class = 'jpWseModel';

		if(class_exists($class)) {
			$model = new $class;

			return $model;
		}

		return false;
	}

	/**
	 * Returns the needed language key for the ini files, e.g. "en-GB" or "de-DE"
	 *
	 * @param string $key
	 * @return string
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

	/**
	 * @param string $staticKey
	 * @return mixed[]
	 */
	private function getStaticItemByKey($staticKey)
	{
		foreach(jpWseConfig::$menuItems as $item)
		{
			if (
				isset($item['static_key'])
				&& $item['static_key'] == $staticKey
			) {
				return $item;
			}
		}

		return [];
	}
}
