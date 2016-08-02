<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$vehicleTypes = $result['vehicle_types'];
$nations = $result['nations'];
$language = jpWseLanguage::getInstance();
?>
<div class="row">
	<div class="col-lg-offset-4 col-lg-4 jp-wse-box-container">
		<h4><?=$language->get('STATS_VEHICLE_TYPES_HEADLINE')?></h4>
		<table class="table">
			<?php foreach($vehicleTypes as $type) : ?>
				<tr>
					<td><?=$type['type_i18n']?></td>
					<td><?=$type['battles']?></td>
					<td><?=number_format($type['wins'] * 100 / $type['battles'])?> %</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div class="col-lg-4 jp-wse-box-container">
		<h4><?=$language->get('STATS_VEHICLE_NATIONS_HEADLINE')?></h4>
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
	<div class="col-lg-12 jp-wse-box-container">
		<h4><?=$language->get('STATS_VEHICLE_VEHICLES_HEADLINE')?></h4>
		<div class="vehicles-scrollbox">
			<table class="table">
				<colgroup>
					<col>
					<col>
					<col>
					<col>
					<col>
				</colgroup>
				<tr>
					<th><?=$language->get('STATS_VEHICLE_TABLE_COUNTER_TEXT')?></th>
					<th><?=$language->get('STATS_VEHICLE_TABLE_TIER_TEXT')?></th>
					<th><?=$language->get('STATS_VEHICLE_TABLE_BATTLES_TEXT')?></th>
					<th><?=$language->get('STATS_VEHICLE_TABLE_WINS_TEXT')?></th>
					<th><?=$language->get('STATS_VEHICLE_TABLE_MASTERY_TEXT')?></th>
				</tr>
				<?php
				$vi = 1;

				foreach($vehicles as $vehicle) :
					$vehicleInfo = $tankInfo->{$vehicle->tank_id};
					?>
					<tr>
						<td><?=$vi?></td>
						<td>
							<div class="vehicle-wrapper">
								<span class="level"><?=romanic_number((int)$vehicleInfo->tier)?></span>
								<img src="<?=$vehicleInfo->images->small_icon?>"
									 alt="<?=$vehicleInfo->short_name?>" />
							</div>
							<span class="name"><?=$vehicleInfo->name?></span>
						</td>
						<td><?=$vehicle->statistics->battles?></td>
						<td><?=$vehicle->statistics->wins?></td>
						<td>
							<?php
							$url = 'http://worldoftanks.eu/static/3.23.0.3/common/img/classes/';

							switch ($vehicle->mark_of_mastery) {
								case 1:
									$suffix = 'st';
								case 2:
									$suffix = !isset($suffix) ? 'nd' : $suffix;
								case 3:
									$suffix = !isset($suffix) ? 'rd' : $suffix;
									$image = 'class-'.$vehicle->mark_of_mastery;
									$title = $vehicle->mark_of_mastery.$suffix.' Class';
									break;

								case 4:
									$image = 'class-ace';
									$title = 'Ace Tanker';
									break;

								case 0:
								default:
									$image = false;
									break;
							}

							if($image !== false) : ?>
								<img src="<?=$url.$image.'.png'?>"
									 alt ="<?=$title?>"
									 title="<?=$title?>" />
							<?php endif; ?>
						</td>
					</tr>
					<?php
					$vi++;
				endforeach; ?>
			</table>
		</div>
	</div>
</div>
