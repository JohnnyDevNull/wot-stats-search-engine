<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$count = 0;
$accounts = array();

if(!empty($data['result']->data)) {
	$accounts = $data['result']->data;
}

$language = jpWseLanguage::getInstance();
?>
<div class="row">
	<div class="col-lg-12 jp-wse-container">
		<form role="form"
			  action="index.php?page=<?=$data['page']?>&sub=detail"
			  method="post">
			<input type="hidden" name="request[page]" value="accounts" />
			<input type="hidden" name="request[call]" value="detail" />
			<input type="hidden" name="game" value="<?=$data['request']['game']?>" />
			<table class="table table-striped no_succession">
				<colgroup>
					<col style="width: 60px;" />
					<col />
					<col />
					<col />
					<col style="width: 40px;"/>
				</colgroup>
				<thead>
					<tr>
						<th><?=$language->get('SEARCH_RESULT_TABLE_HEAD_COUNTER_TEXT')?></th>
						<th><?=$language->get('SEARCH_RESULT_TABLE_HEAD_NICK_TEXT')?></th>
						<th><?=$language->get('SEARCH_RESULT_TABLE_HEAD_ACCID_TEXT')?></th>
						<th>
							<span class="glyphicon glyphicon-cog"
								  title="<?=$language->get('ICON_ACTIONS_TITLE')?>"
								  style="margin-left: 5px;">
							</span>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($accounts as $account) : ?>
					<tr>
						<td><?=++$count?></td>
						<td><?=$account->nickname?></td>
						<td><?=$account->account_id?></td>
						<td>
							<button type="submit"
									class="btn btn-default btn-xs"
									name="request[detail]"
									value="<?=$account->account_id?>">
								<span class="glyphicon glyphicon-search"
									  title="<?=$language->get('BUTTON_DETAIL_VIEW_TITLE')?>">
								</span>
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</form>
	</div>
</div>
