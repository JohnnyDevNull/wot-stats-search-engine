<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
$result = $data['result'];
$clanID = $result['clan_id'];
$info = $result['info']->data->{$clanID};
$count = 0;
$language = jpWseLanguage::getInstance();
?>
<div class="row">
	<div class="col-lg-12">
		<div id="info">
			<div class="row">
				<div class="col-lg-12 jp-wse-container">
					<h4><?=$language->get('DETAIL_GENERAL_HEADLINE')?></h4>
					<div class="row">
						<div class="col-lg-6">
							<table class="table">
								<tbody>
									<tr>
										<td>Name</td>
										<td><?=$info->name?></td>
									</tr>
									<tr>
										<td>Tag</td>
										<td><?=$info->tag?></td>
									</tr>
									<tr>
										<td>Leader</td>
										<td><?=$info->creator_name?></td>
									</tr>
									<tr>
										<td>Clan Created</td>
										<td><?=date('d.m.Y', $info->created_at)?></td>
									</tr>
									<tr>
										<td>Amount of members</td>
										<td><?=$info->members_count?></td>
									</tr>
									<tr>
										<td>Motto</td>
										<td><?=$info->motto?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-lg-6">
							<table class="table">
								<tbody>
									<tr>
										<td>Description</td>
										<td><?=$info->description_html?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 jp-wse-container">
					<h4><?=$language->get('DETAIL_MEMBERS_HEADLINE')?></h4>
					<table class="table">
						<colgroup>
							<col style="width: 60px;" />
							<col />
							<col />
							<col />
							<col />
							<col style="width: 40px;"/>
						</colgroup>
						<thead>
							<tr>
								<th><?=$language->get('MEMBERS_TABLE_HEAD_COUNTER_TEXT')?></th>
								<th><?=$language->get('MEMBERS_TABLE_HEAD_NAME_TEXT')?></th>
								<th><?=$language->get('MEMBERS_TABLE_HEAD_ROLE_TEXT')?></th>
								<th><?=$language->get('MEMBERS_TABLE_HEAD_ID_TEXT')?></th>
								<th><?=$language->get('MEMBERS_TABLE_HEAD_JOINED_TEXT')?></th>
								<th>
									<span class="glyphicon glyphicon-cog"
										  title="<?=$language->get('ICON_ACTIONS_TITLE')?>"
										  style="margin-left: 5px;">
									</span>
								</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($info->members as $member) :
							$leader = $member->account_id == $info->creator_id ? 'class="clan members leader"' : '';
							?>
							<tr <?=$leader?>>
								<td><?=++$count?></td>
								<td>
									<?=$member->account_name?>
								</td>
								<td><?=$member->role_i18n?></td>
								<td>
									<?=$member->account_id?>
								</td>
								<td><?=date('d.m.Y', $member->joined_at)?></td>
								<td>
									<form role="form"
										  action="index.php?page=accounts&sub=detail"
										  method="post"
										  class="form-inline"
										  style="display: inline;">
										<input type="hidden" name="request[game]" value="<?=$data['request']['game']?>" />
										<input type="hidden" name="request[page]" value="accounts" />
										<input type="hidden" name="request[call]" value="detail" />
										<button type="submit"
												class="btn btn-default btn-xs"
												name="request[detail]"
												value="<?=$member->account_id?>">
											<span class="glyphicon glyphicon-search"
												  title="<?=$language->get('BUTTON_DETAIL_VIEW_TITLE')?>">
											</span>
										</button>
									</form>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
