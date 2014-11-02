<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */

$count = 0;

if(!isset($data['result'])) {
	$data['result'] = array();
}

$language = jpWotLanguage::getInstance();
?>
<div class="row">
	<div class="col-lg-12">
		<form role="form"
			  action="index.php?page=accounts&sub=detail"
			  method="post">
			<table class="table table-striped no_succession">
				<colgroup>
					<col style="width: 60px;" />
					<col />
					<col />
					<col />
					<col style="width: 40px;"/>
				</colgroup>
				<tr>
					<th><?=$language->get('SEARCH_RESULT_TABLE_HEAD_COUNTER_TEXT')?></th>
					<th><?=$language->get('SEARCH_RESULT_TABLE_HEAD_NICK_TEXT')?></th>
					<th><?=$language->get('SEARCH_RESULT_TABLE_HEAD_ID_TEXT')?></th>
					<th><?=$language->get('SEARCH_RESULT_TABLE_HEAD_ACCID_TEXT')?></th>
					<th>
						<span class="glyphicon glyphicon-cog"
							  title="<?=$language->get('ICON_ACTIONS_TITLE')?>"
							  style="margin-left: 5px;">
						</span>
					</th>
				</tr>
			<?php foreach($data['result'] as $searchResult) : ?>
				<tr>
					<td><?=++$count?></td>
					<td><?=$searchResult->nickname?></td>
					<td><?=$searchResult->id?></td>
					<td><?=$searchResult->account_id?></td>
					<td>
						<button type="submit"
								class="btn btn-default btn-xs"
								name="request[accounts][detail]"
								value="<?=$searchResult->account_id?>">
							<span class="glyphicon glyphicon-search"
								  title="<?=$language->get('BUTTON_DETAIL_VIEW_TITLE')?>">
							</span>
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
			</table>
		</form>
	</div>
</div>