<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$sessionLang = jpWotSession::get('active_language');
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
<!--
		<a title="Türkçe" data-langkey="tr">
			<i class="icon ico_tr <?=($sessionLang == 'tr') ? '' : 'inactive'?>"></i>
			<span class="sr-only">Türkçe</span>
		</a>
		<a title="Español" data-langkey="es">
			<i class="icon ico_es <?=($sessionLang == 'es') ? '' : 'inactive'?>"></i>
			<span class="sr-only">Español</span>
		</a>
		<a title="Čeština" data-langkey="cz">
			<i class="icon ico_cz <?=($sessionLang == 'cz') ? '' : 'inactive'?>"></i>
			<span class="sr-only">Čeština</span>
		</a>
		<a title="Polski" data-langkey="pl">
			<i class="icon ico_pl <?=($sessionLang == 'pl') ? '' : 'inactive'?>"></i>
			<span class="sr-only">Polski</span>
		</a>
-->
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
