<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$stats = $info->statistics;
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
				<td><?=$language->get('STATS_GENERAL_LEVEL_LABEL')?></td>
				<td><?=(int)$info->leveling_tier?></td>
			</tr>
		</table>
	</div>
	<div class="col-lg-4">
		<h4><?=$language->get('STATS_OVERALL_HEADLINE')?> (PVP)</h4>
		<table class="table">
			<tr>
				<td><?=$language->get('STATS_OVERALL_BATTLES_LABEL')?></td>
				<td><?=number_format($stats->battles)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_DISTANCE_LABEL')?></td>
				<td><?=number_format($stats->distance)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_WINS_LABEL')?></td>
				<td><?=number_format($stats->pvp->wins)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_DRAWS_LABEL')?></td>
				<td><?=number_format($stats->pvp->draws)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_LOSSES_LABEL')?></td>
				<td><?=number_format($stats->pvp->losses)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_SURVIVED_LABEL')?></td>
				<td><?=number_format($stats->pvp->survived_battles)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_XP_LABEL')?></td>
				<td><?=number_format($stats->pvp->xp)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_BATTLE_AVG_XP_LABEL')?></td>
				<td><?=number_format(((int)$stats->pvp->xp / (int)$stats->pvp->battles))?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_OVERALL_MAX_XP_LABEL')?></td>
				<td><?=number_format($stats->pvp->max_xp)?></td>
			</tr>
		</table>
	</div>
	<div class="col-lg-4">
		<h4><?=$language->get('STATS_PERFORMANCE_HEADLINE')?> (PVP)</h4>
		<table class="table">
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_FRAGS_WOWS_LABEL')?></td>
				<td><?=number_format($stats->pvp->frags)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_PLANES_KILLED_LABEL')?></td>
				<td><?=number_format($stats->pvp->planes_killed)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_DAMAGE_DEALT_LABEL')?></td>
				<td><?=number_format($stats->pvp->damage_dealt)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_BATTLE_AVG_DEMAGE_LABEL')?></td>
				<td><?=number_format(((int)$stats->pvp->damage_dealt / (int)$stats->battles))?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_CAPTURE_POINTS_LABEL')?></td>
				<td><?=number_format($stats->pvp->capture_points)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_DEFENCE_POINTS_LABEL')?></td>
				<td><?=number_format($stats->pvp->dropped_capture_points)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_MAX_FRAGS_LABEL')?></td>
				<td><?=number_format($stats->pvp->max_frags_battle)?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_PERFORMANCE_MAX_PLANES_LABEL')?></td>
				<td><?=number_format($stats->pvp->max_planes_killed)?></td>
			</tr>
		</table>
	</div>
</div>
