<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */

/**
 * @param mixed $index
 * @return mixed
 */
function getPostValue($index, $default = '')
{
	if(isset($_POST[$index])) {
		if(is_array($_POST[$index])) {
			return $_POST[$index];
		} else {
			return trim($_POST[$index]);
		}
	}

	return $default;
}

/**
 * @param mixed $index
 * @return mixed
 */
function getGetValue($index, $default = '')
{
	if(isset($_GET[$index])) {
		if(is_array($_GET[$index])) {
			return $_POST[$index];
		} else {
			return trim($_GET[$index]);
		}
	}

	return $default;
}

/**
 * @param string $str
 * @return string[]
 */
function splitStringOnUpperCase($str)
{
	$ret = array();

	if(!ctype_upper($str)) {
		return preg_split('/(?=[A-Z])/', $str, -1, PREG_SPLIT_NO_EMPTY);
	} else {
		$ret[] = $str;
	}

	return $ret;
}

/**
 * Converts integer numbers to roman representation.
 *
 * @param int $integer
 * @param bool $upcase
 * @return string
 * @link http://stackoverflow.com/a/15023547
 */
function romanic_number($integer, $upcase = true)
{
	$table = array (
		'M' => 1000,
		'CM' => 900,
		'D' => 500,
		'CD' => 400,
		'C' => 100,
		'XC' => 90,
		'L' => 50,
		'XL' => 40,
		'X' => 10,
		'IX' => 9,
		'V' => 5,
		'IV' => 4,
		'I' => 1
	);

	$return = '';

	while($integer > 0) {
		foreach($table as $rom => $arb) {
			if($integer >= $arb) {
				$integer -= $arb;
				$return .= $rom;
				break;
			}
		}
	}

	return $return;
}