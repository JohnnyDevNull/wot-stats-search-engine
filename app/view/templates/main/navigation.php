<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */

$items = array (
	'accounts' => array (
		'LANG_CONSTANT' => 'ACCOUNTS'
	),
	'clans' => array (
		'LANG_CONSTANT' => 'CLANS'
	),
	'ratings' => array (
		'LANG_CONSTANT' => 'RATINGS'
	),
	'clanratings' => array (
		'LANG_CONSTANT' => 'CLANRATINGS'
	),
);

$app = jpWotApp::getInstance();
$activePageKey = $app->getPageKey();
$language = jpWotLanguage::getInstance();
?>
<div class="row">
	<div class="col-lg-12">
		<nav>
			<ul class="nav nav-tabs" role="tablist">
				<?php foreach($items as $pageKey => $item) : ?>
				<li <?=$activePageKey == $pageKey ? 'class="active"' : ''?>>
					<a href="index.php?page=<?=$pageKey?>"
					   title="<?=$language->get('MENU_ITEM_'.$item['LANG_CONSTANT'].'_TITLE')?>">
						<?=$language->get('MENU_ITEM_'.$item['LANG_CONSTANT'].'_TEXT')?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
</div>
