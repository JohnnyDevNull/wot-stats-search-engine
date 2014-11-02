<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */
class jpWotLanguage
{
	/**
	 * @var jpWotLanguage
	 */
	private static $_langInstance = null;

	/**
	 * @var array
	 */
	private static $_cache = array();

	/**
	 * @return jpWotApp
	 */
	public static function getInstance()
	{
		if(self::$_langInstance === null) {
			self::$_langInstance = new self();
		}

		return self::$_langInstance;
	}

	/**
	 * @param string $component
	 * @param string $basePath
	 * @param string $langKey
	 * @return bool
	 */
	public function load($component = '', $basePath = '', $langKey = 'en-GB')
	{
		$filepath = $basePath.'/lang/'.$langKey.'/'.$langKey.'.'.trim($component).'.ini';

		if(!is_file($filepath)) {
			return false;
		}

		$langArray = parse_ini_file($filepath);

		if(empty($langArray)) {
			return false;
		}

		self::$_cache = array_merge(self::$_cache, $langArray);
	}

	/**
	 * @param string $const
	 * @param mixed $default
	 * @return string
	 */
	public function get($const, $default = '')
	{
		$ret = $default;

		if(isset(self::$_cache[(string)$const])) {
			$ret = self::$_cache[(string)$const];
		}

		return $ret;
	}

	/**
	 * @return array
	 */
	public function getCache()
	{
		return self::$_cache;
	}
}
