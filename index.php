<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */

error_reporting(E_ALL | E_STRICT);

/**
 * Contains the base path of the app.
 *
 * @var string
 */
define('BPATH', __DIR__);

require_once BPATH.'/inc/autoload.php';
require_once BPATH.'/inc/function.php';
require_once BPATH.'/inc/wot.class.php';
require_once BPATH.'/config.php';

$app = jpWotApp::getInstance();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap-override.css" />
		<link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
		<script src="./assets/js/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="./assets/js/jquery.form.js" type="text/javascript"></script>
		<script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>
		<script>
			(function($) {
				$(document).ready(function() {
					$('.hasTip').on('mouseover', function() {
						$(this).tooltip('show');
					});
				});
			})(jQuery);
		</script>
	</head>
	<body>
		<div class="container">
			<div class="page-header" id="tb_logo">
				<img src="./assets/img/wot-logo.png"
					 alt="World of Tanks Logo"
					 title="World of Tanks"
					 style="max-width: 160px; display: inline-block;"/>
				<h1 style="display: inline-block;">SSE (Stats Search Engine)</h1>
			</div>
			<div class="row" id="contentbox">
				<div class="col-lg-12">
					<?php $app->invoke(); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center small text-muted">
					&copy; <?=date('Y')?> JPlace <a href="http://www.jplace.de" target="_blank">www.jplace.de</a>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
jpWotSession::writeClose();
