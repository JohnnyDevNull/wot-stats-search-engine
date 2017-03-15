<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$shipTypes = $result['ship_types'];
$nations = $result['nations'];
$armament = $result['armament'];
$language = jpWseLanguage::getInstance();

?>

<div class="row">
	<div class="col-lg-4 jp-wse-container">
		<h4><?=$language->get('STATS_ARMAMENT_HEADLINE')?> (PVP)</h4>
		<table class="table">
			<tr>
				<td><?=$language->get('STATS_ARMAMENT_MAIN_BATTERY_LABEL')?></td>
				<td><?=$armament['main_battery']?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_ARMAMENT_AIRCRAFT_LABEL')?></td>
				<td><?=$armament['aircraft']?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_ARMAMENT_TORPEDOS_LABEL')?></td>
				<td><?=$armament['torpedos']?></td>
			</tr>
			<tr>
				<td><?=$language->get('STATS_ARMAMENT_OTHER_LABEL')?></td>
				<td><?=$armament['other']?></td>
			</tr>
		</table>
	</div>
	<div class="col-lg-4 jp-wse-container">
		<h4><?=$language->get('STATS_VEHICLE_TYPES_HEADLINE')?> (PVP)</h4>
		<table class="table">
			<?php foreach($shipTypes as $type) : ?>
				<tr>
					<td><?=$type['type_i18n']?></td>
					<td><?=$type['battles']?></td>
					<td><?=number_format($type['wins'] * 100 / $type['battles'])?> %</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div class="col-lg-4 jp-wse-container">
		<h4><?=$language->get('STATS_VEHICLE_NATIONS_HEADLINE')?> (PVP)</h4>
		<table class="table">
			<?php foreach($nations as $nation) : ?>
				<tr>
					<td><?=$nation['nation_i18n']?></td>
					<td><?=$nation['battles']?></td>
					<td><?=number_format($nation['wins'] * 100 / $nation['battles'])?> %</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 jp-wse-container">
		<h4><?=$language->get('STATS_SHIPS_HEADLINE')?></h4>
		<div class="vehicles-scrollbox">
			<table class="table">
				<colgroup>
					<col>
					<col>
					<col>
					<col>
					<col>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th><?=$language->get('STATS_SHIPS_TABLE_COUNTER_TEXT')?></th>
						<th><?=$language->get('STATS_SHIPS_TABLE_TIER_TEXT')?></th>
						<th><?=$language->get('STATS_SHIPS_TABLE_BATTLES_TEXT')?></th>
						<th><?=$language->get('STATS_SHIPS_TABLE_WINS_TEXT')?></th>
						<th><?=$language->get('STATS_SHIPS_TABLE_FRAGS_TEXT')?></th>
						<th><?=$language->get('STATS_SHIPS_TABLE_PLANES_TEXT')?></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$vi = 1;

				foreach($warships as $ship) {
					$shipData = $shipInfo->{$ship->ship_id};

					if(isset($shipData->tier, $shipData->images->small, $shipData->ship_id_str, $shipData->name)) {
						?>
						<tr>
							<td><?=$vi?></td>
							<td>
								<div class="vehicle-wrapper">
									<span class="level"><?=romanic_number((int)$shipData->tier)?></span>
									<img src="<?=$shipData->images->small?>"
										 alt="<?=$shipData->ship_id_str?>"
										 style="max-height: 30px;"/>
								</div>
								<span class="name"><?=$shipData->name?></span>
							</td>
							<td><?=$ship->pvp->battles?></td>
							<td><?=$ship->pvp->wins?></td>
							<td><?=$ship->pvp->frags?></td>
							<td><?=$ship->pvp->planes_killed?></td>
						</tr>
						<?php
					}
					$vi++;
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
