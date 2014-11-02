<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */

$count = 0;
?>
<div class="row">
	<div class="col-lg-12">
		<form role="form"
			  action="index.php?page=clans&sub=detail"
			  method="post">
			<table class="table table-striped">
				<colgroup>
					<col style="width: 60px;" />
					<col />
					<col />
					<col />
					<col style="width: 40px;"/>
				</colgroup>
				<tr>
					<th>#</th>
					<th>Nickname</th>
					<th>ID</th>
					<th>Account-ID</th>
					<th>
						<span class="glyphicon glyphicon-cog"
							  title="Actions"
							  style="margin-left: 5px;">
						</span>
					</th>
				</tr>
			<?php foreach($data as $searchResult) : ?>
				<tr>
					<td><?=++$count?></td>
					<td><?=$searchResult->nickname?></td>
					<td><?=$searchResult->id?></td>
					<td><?=$searchResult->account_id?></td>
					<td>
						<button type="submit"
								class="btn btn-default btn-xs"
								name="request[clans][detail]"
								value="<?=$searchResult->account_id?>">
							<span class="glyphicon glyphicon-search"
								  title="Open detail view">
							</span>
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
			</table>
		</form>
	</div>
</div>
