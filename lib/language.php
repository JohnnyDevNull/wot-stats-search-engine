<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseLanguage
{
	/**
	 * @var jpWseLanguage
	 */
	private static $langInstance = null;

	/**
	 * @var array
	 */
	private static $cache = array();

	/**
	 * @return jpWseLanguage
	 */
	public static function getInstance()
	{
		if(self::$langInstance === null) {
			self::$langInstance = new self();
		}

		return self::$langInstance;
	}

	/**
	 * @param string $component [optional] default: ''
	 * @param string $basePath [optional] default: ''
	 * @param string $langKey [optional] default: 'en-GB'
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

		self::$cache = array_merge(self::$cache, $langArray);
	}

	/**
	 * @param string $const
	 * @param mixed $default [optional] default: ''
	 * @return string
	 */
	public function get($const, $default = '')
	{
		$ret = $default;

		if(isset(self::$cache[(string)$const])) {
			$ret = self::$cache[(string)$const];
		}

		return $ret;
	}

	/**
	 * @return array
	 */
	public function getCache()
	{
		return self::$cache;
	}
}
