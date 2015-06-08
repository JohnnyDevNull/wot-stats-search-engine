<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
abstract class jpWotSession
{
	/**
	 * Starts or continue a session
	 */
	public static function start()
	{
		session_start();
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 */
	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	/**
	 * @param string $key
	 * @return mixed|false
	 */
	public static function get($key, $default = null)
	{
		$ret = $default;

		if(isset($_SESSION[$key])) {
			$ret = $_SESSION[$key];
		}

		return $ret;
	}

	/**
	 * @param string $key
	 */
	public static function unsetKey($key)
	{
		if(isset($_SESSION[$key])) {
		   unset($_SESSION[$key]);
		}
	}

	/**
	 * @return bool
	 */
	public static function destroy()
	{
		self::init();

		$_SESSION = array();

		session_unset();

		if(ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();

			setcookie (
				session_name(),
				'',
				time() - 42000, $params["path"],
				$params["domain"],
				$params["secure"],
				$params["httponly"]
			);
		}

		return session_destroy();
	}

	/**
	 * Writes the session data and closes it.
	 */
	public static function writeClose()
	{
		session_write_close();
	}

	/**
	 * @param bool $reset
	 * @return bool
	 */
	public static function regenerate($reset = false)
	{
		return session_regenerate_id($reset);
	}
}
