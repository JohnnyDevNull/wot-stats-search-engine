<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$sessionLang = jpWseSession::get('active_language');
?>
<form method="post" id="changeLangForm">
	<input id="currentLanguageValue" type="hidden" name="lang[current]" value="<?=$sessionLang?>" />
	<input id="changeLanguageValue" type="hidden" name="lang[new]" value="<?=$sessionLang?>" />
	<div id="langSwichter">
		<a title="Françai" data-langkey="fr">
			<i class="icon ico_fr <?=($sessionLang == 'fr') ? '' : 'inactive'?>"></i>
			<span class="sr-only">Françai</span>
		</a>
		<a title="English" data-langkey="en">
			<i class="icon ico_en <?=($sessionLang == 'en') ? '' : 'inactive'?>"></i>
			<span class="sr-only">English</span>
		</a>
		<a title="Deutsch" data-langkey="de">
			<i class="icon ico_de <?=($sessionLang == 'de') ? '' : 'inactive'?>"></i>
			<span class="sr-only">Deutsch</span>
		</a>
	</div>
</form>
<script>
	$('#langSwichter a').on('click', function() {
		var currentKey = $('#currentLanguageValue').val();
		var toChangeKey = $(this).data('langkey');

		if(currentKey !== toChangeKey) {
			$('#changeLanguageValue').val(toChangeKey);
			$('#changeLangForm').submit();
		}
	});
</script>
