<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$autoLoad = function($className) {
	if(strpos($className, 'jp') === false) {
		throw new LogicException('Wrong class name given, jpWot class prefix is missing: "'.$className.'"');
	} else {
		$className = str_replace('jpWot', '', $className);
	}

	$classArr = splitStringOnUpperCase($className);

	$filepath = BPATH.'/lib/'.strtolower(implode('/', $classArr)).'.php';

	if(is_file($filepath)) {
		require_once $filepath;
	}

	$filepath = BPATH.'/app/'.strtolower(implode('/', $classArr)).'.php';

	if(is_file($filepath)) {
		require_once $filepath;
	}
};

spl_autoload_register($autoLoad);
