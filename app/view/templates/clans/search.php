<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$count = 0;

if(!isset($data['result'])) {
	$data['result'] = array();
}

$game = $data['request']['clans']['game'];
$language = jpWseLanguage::getInstance();
?>
<div class="row">
	<div class="col-lg-12">
		<form role="form"
			  action="index.php?page=<?=$data['page']?>&sub=detail"
			  method="post">
			<input type="hidden" name="game" value="<?=$game?>" />
			<table class="table table-striped">
				<colgroup>
					<col style="width: 60px;" />
					<col />
					<col />
					<col />
					<col />
					<col style="width: 40px;"/>
				</colgroup>
				<tr>
					<th><?=$language->get('SEARCH_RESULT_TABLE_HEAD_COUNTER_TEXT')?></th>
					<th><?=$language->get('SEARCH_RESULT_TABLE_HEAD_NAME_TEXT')?></th>
					<th><?=$language->get('SEARCH_RESULT_TABLE_HEAD_CLANID_TEXT')?></th>
					<th>
						<span class="glyphicon glyphicon-cog"
							  title="<?=$language->get('ICON_ACTIONS_TITLE')?>"
							  style="margin-left: 5px;">
						</span>
					</th>
				</tr>
			<?php foreach($data['result']->data as $searchResult) : ?>
				<tr>
					<td><?=++$count?></td>
					<td><?=$searchResult->name?> [ <?=$searchResult->tag?> ]</td>
					<td><?=$searchResult->clan_id?></td>
					<td>
						<button type="submit"
								class="btn btn-default btn-xs"
								name="request[clans][detail]"
								value="<?=$searchResult->clan_id?>">
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
