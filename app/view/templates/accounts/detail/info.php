<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$info = $result['info']->data->$accountID;
$statsAll = $info->statistics->all;
$clan = false;

if(!empty($info->clan)) {
	$clan = $info->clan->data->{$info->clan_id};
}

$language = jpWseLanguage::getInstance();
?>
<div class="row">
	<div class="col-lg-4">
		<h4><?=$language->get('STATS_GENERAL_HEADLINE')?></h4>
		<table class="table">
			<tr>
				<td><?=$language->get('STATS_GENERAL_NICK_LABEL')?></td>
				<td><?=$info->nickname?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_GENERAL_CREATED_LABEL')?></td>
				<td><?=date('d.m.Y', $info->created_at)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_GENERAL_UPDATED_LABEL')?></td>
				<td><?=date('d.m.Y', $info->updated_at)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_GENERAL_RATING_LABEL')?></td>
				<td><?=number_format($info->global_rating)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_GENERAL_LANGUAGE_LABEL')?></td>
				<td><?=strtoupper($info->client_language)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_GENERAL_CLAN_LABEL')?></td>
				<td>
					<?php if ($clan === false) : ?>
						<?=$language->get('TEXT_NO_CLAN')?>
					<?php else : ?>
						<span class="detail_clan_name"><?=$clan->name?></span>
						<span class="detail_clan_tag">[<?=$clan->tag?>]</span>
					<?php endif; ?>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-lg-4">
		<h4><?=$language->get('STATS_OVERALL_HEADLINE')?></h4>
		<table class="table">
			<tr>
				<td><?=$language->get('STATS_OVERALL_BATTLES_LABEL')?></td>
				<td><?=number_format($statsAll->battles)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_WINS_LABEL')?></td>
				<td><?=number_format($statsAll->wins)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_LOSSES_LABEL')?></td>
				<td><?=number_format($statsAll->losses)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_SURVIVED_LABEL')?></td>
				<td><?=number_format($statsAll->survived_battles)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_XP_LABEL')?></td>
				<td><?=number_format($statsAll->xp)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_BATTLE_AVG_XP_LABEL')?></td>
				<td><?=number_format($statsAll->battle_avg_xp)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_MAX_XP_LABEL')?></td>
				<td><?=number_format($statsAll->max_xp)?></td>
			</tr>
		</table>
	</div>
	<div class="col-lg-4">
		<h4><?=$language->get('STATS_PERFORMANCE_HEADLINE')?></h4>
		<table class="table">
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_FRAGS_LABEL')?></td>
				<td><?=number_format($statsAll->frags)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_SPOTTED_LABEL')?></td>
				<td><?=number_format($statsAll->spotted)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_HITS_PERCENTS_LABEL')?></td>
				<td><?=$statsAll->hits_percents?> %</td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_DAMAGE_DEALT_LABEL')?></td>
				<td><?=number_format($statsAll->damage_dealt)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_BATTLE_AVG_DEMAGE_LABEL')?></td>
				<td><?=number_format(((float)$statsAll->damage_dealt / (float)$statsAll->battles))?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_CAPTURE_POINTS_LABEL')?></td>
				<td><?=number_format($statsAll->capture_points)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_DEFENCE_POINTS_LABEL')?></td>
				<td><?=number_format($statsAll->dropped_capture_points)?></td>
			</tr>
		</table>
	</div>
</div>
