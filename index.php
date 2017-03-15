<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

error_reporting(0);

/**
 * Contains the base path of the app.
 *
 * @var string
 */
define('BPATH', __DIR__);

require_once BPATH.'/inc/autoload.php';
require_once BPATH.'/inc/function.php';
require_once BPATH.'/config.php';

if(jpWseConfig::$debug) {
	error_reporting(E_ALL ^ E_STRICT);
	ini_set('display_errors', 1);
}

jpWseSession::start();
$app = jpWseApp::getInstance();
?>
<!DOCTYPE html>
<html>
	<?php jpWseTemplate::render('index') ?>
</html>
<?php
jpWseSession::writeClose();
