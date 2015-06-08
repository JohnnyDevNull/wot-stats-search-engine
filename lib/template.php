<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
abstract class jpWotTemplate
{
	/**
	 * @param string $path
	 * @param array $data (optional) default empty array
	 * @param string $extension (optional) default ".php"
	 */
	public static function render($path, $data = array(), $extension = 'php')
	{
		$parts = explode('.', $path);
		$path = BPATH.'/app/view/templates/'.implode('/', $parts).'.'.$extension;

		if(is_file($path)) {
			if(!isset($data['page'])) {
				$app = jpWotApp::getInstance();
				$data['page'] = $app->getPageKey();
			}

			require_once $path;
		}
	}	
}
