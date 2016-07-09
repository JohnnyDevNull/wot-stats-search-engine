<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$items = jpWseConfig::$menuItems;

$app = jpWseApp::getInstance();
$language = jpWseLanguage::getInstance();
$activeLink = 'index.php?'.$_SERVER['QUERY_STRING'];
?>
<div class="row">
	<div class="col-lg-12">
		<nav>
			<ul class="nav nav-tabs" role="tablist">
				<?php foreach($items as $index => $item) :
					if(isset($item['hide']) && (bool)$item['hide']) {
						continue;
					}

					if(isset($item['static_name'])) {
						$title = $text = $item['static_name'];
					} else {
						$title = $language->get('MENU_ITEM_'.$item['lang_constant'].'_TITLE');
						$text = $language->get('MENU_ITEM_'.$item['lang_constant'].'_TEXT');
					}

					$query = '';

					if(isset($item['params'])) {
						$query = '&'.http_build_query($item['params']);
					}

					$link = 'index.php?page='.$item['page'].$query;
					?>
				<li id="item_<?=(int)$index?>" <?=$activeLink == $link ? 'class="active"' : ''?>>
					<a href="<?=$link?>"
					   title="<?=$title?>">
						<?=$text?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
</div>
