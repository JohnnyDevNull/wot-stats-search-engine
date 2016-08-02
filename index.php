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
	<head>
		<title>jp-wggames-se</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap-theme.min.css" />
		<?php if(!empty(jpWseConfig::$cssTheme)) : ?>
		<link rel="stylesheet" type="text/css" href="./assets/css/<?=jpWseConfig::$cssTheme?>" />
		<?php endif; ?>
		<link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
		<?php if(is_file('./assets/css/custom.css')) : ?>
		<link rel="stylesheet" type="text/css" href="./assets/css/custom.css" />
		<?php endif; ?>
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
			<?php if(!empty(jpWseConfig::$title)) : ?>
			<div class="page-header">
				<h1>WGGames Search Engine</h1>
			</div>
			<?php endif; ?>
			<div class="row" id="contentbox">
				<div class="col-lg-12">
					<?php $app->invoke(); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 small text-center">
					<span class="text-muted">
						&copy; <?=date('Y')?> Philipp John <a href="http://www.jplace.de" target="_blank">www.jplace.de</a>
					</span>
					<?php if(empty(jpWseConfig::$layouts['language_switcher']['hide'])) : ?>
					<div class="pull-right">
						<?php jpWseTemplate::render('filter.lang') ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
jpWseSession::writeClose();
