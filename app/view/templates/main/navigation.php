<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
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

$app = jpWseApp::getInstance();
$activePageKey = $app->getPageKey();
$language = jpWseLanguage::getInstance();
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
