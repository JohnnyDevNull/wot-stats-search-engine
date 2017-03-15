<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
abstract class jpWseTemplate
{
	/**
	 * @param string $path
	 * @param array $data [optional] default: array()
	 * @param string $extension [optional] default: 'php'
	 */
	public static function render($path, $data = array(), $extension = 'php')
	{
		$template  = jpWseConfig::$template;
		$parts = explode('.', $path);
		$path = BPATH.'/app/view/templates/'
			  . $template.'/'
			  . implode('/', $parts)
			  . '.'.$extension;

		if(is_file($path)) {
			if(!isset($data['page'])) {
				$app = jpWseApp::getInstance();
				$data['page'] = $app->getPageKey();
			}

			require_once $path;
		}
	}	
}
