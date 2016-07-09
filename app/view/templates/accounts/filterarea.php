<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$search = '';
$limit = 20;
$game = jpWseConfig::$game;

if(!empty($data['accounts']['search'])) {
	$search = $data['accounts']['search'];
}

if(!empty($data['accounts']['limit'])) {
	$limit = $data['accounts']['limit'];
}

if(!empty($data['accounts']['game'])) {
	$game = $data['accounts']['game'];
}

$language = jpWseLanguage::getInstance();
?>
<div class="row">
	<div class="col-lg-12">
		<div id="filterarea">
			<form class="form-inline"
				  role="form"
				  action="index.php?page=<?=$data['page']?>"
				  method="post">
				<div class="form-group">
					<?php
					jpWseTemplate::render (
						'filter.search',
						array (
							'last_value' => $search,
							'label' => $language->get('FILTER_SEARCH_LABEL'),
							'placeholder' => $language->get('FILTER_SEARCH_PLACEHOLDER')
						)
					);
					?>
				</div>
				<div class="form-group">
					<?php
					jpWseTemplate::render (
						'filter.limit',
						array (
							'last_value' => $limit,
							'title' => $language->get('FILTER_LIMIT_TITLE')
						)
					);
					?>
				</div>
				<div class="form-group">
					<?php
					jpWseTemplate::render (
						'filter.game',
						array (
							'last_value' => $game,
							'title' => $language->get('FILTER_GAME_TITLE')
						)
					);
					?>
				</div>
				<div class="form-group">
					<input type="submit"
						   class="btn btn-primary btn-sm"
						   value="<?=$language->get('FILTER_SUBMIT_BUTTON_TEXT')?>">
				</div>
			</form>
		</div>
	</div>
</div>
