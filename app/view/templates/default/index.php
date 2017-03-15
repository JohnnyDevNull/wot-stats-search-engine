	<head>
		<title>jp-wggames-se</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./assets/system/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="./assets/system/css/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="./assets/system/css/style.css" />
		<?php if(!empty(jpWseConfig::$cssTheme)) : ?>
		<link rel="stylesheet" type="text/css" href="./assets/system/css/<?=jpWseConfig::$cssTheme?>" />
		<?php endif; ?>
		<link rel="stylesheet" type="text/css" href="./assets/default/css/style.css" />
		<?php if(is_file('./assets/css/custom.css')) : ?>
		<link rel="stylesheet" type="text/css" href="./assets/default/css/custom.css" />
		<?php endif; ?>
		<script src="./assets/system/js/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="./assets/system/js/jquery.form.js" type="text/javascript"></script>
		<script src="./assets/system/js/bootstrap.min.js" type="text/javascript"></script>
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
				<h1><?=jpWseConfig::$title?></h1>
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
