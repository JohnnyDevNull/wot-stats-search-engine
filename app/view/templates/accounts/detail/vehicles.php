<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */

$vehicles = $result['vehicles']->$accountID;
$vehicleTypes = $result['vehicle_types'];
$tankInfo = $result['tankinfo'];
$nations = $result['nations'];
$language = jpWotLanguage::getInstance();
?>
<div class="row">
	<div class="col-lg-offset-1 col-lg-4">
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
	<div class="col-lg-offset-1 col-lg-4">
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
	<div class="col-lg-offset-1 col-lg-9">
		<h4><?=$language->get('STATS_VEHICLE_VEHICLES_HEADLINE')?></h4>
		<div class="vehicles-scrollbox">
			<table class="table">
			<?php foreach($vehicles as $vehicle) :
				$vehicleInfo = $tankInfo->{$vehicle->tank_id};
				?>
				<tr>
					<td>
						<div class="vehicle-wrapper">
							<span class="level"><?=  romanic_number((int)$vehicleInfo->level)?></span>
							<img src="<?=$vehicleInfo->image_small?>"
								 alt="<?=$vehicleInfo->short_name_i18n?>" />
						</div>
						<span class="name"><?=$vehicleInfo->name_i18n?></span>
					</td>
					<td><?=$vehicle->statistics->battles?></td>
					<td><?=$vehicle->statistics->wins?></td>
					<td>-</td>
				</tr>
			<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>