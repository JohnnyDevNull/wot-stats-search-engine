<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$info = null;
$vehicles = null;
$tankInfo = null;
$warships = null;
$accountID = 0;

if(!empty($data['result'])) {
	$result = $data['result'];
	$accountID = $result['account_id'];

	$info = $result['info']->data->{$accountID};

	if(!empty($result['vehicles'])) {
		$vehicles = $result['vehicles']->data->{$accountID};
	}

	if(!empty($result['tankinfo'])) {
		$tankInfo = $result['tankinfo']->data;
	}

	if(!empty($result['warships'])) {
		$warships = $result['warships']->data->{$accountID};
	}

	if(!empty($result['shipinfo'])) {
		$shipInfo = $result['shipinfo']->data;
	}
}

$game = $data['request']['game'];
?>
<div class="row">
	<div class="col-lg-12">
		<div id="info">
			<?php
			if(!empty($info)) {
				include __DIR__.'/detail/'.$game.'.info.php';
			}
			?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div id="vehicles">
			<?php
			if (
				$game == 'wot'
				&& !empty($vehicles)
				&& !empty($tankInfo)
			) {
				include __DIR__.'/detail/wot.vehicles.php';
			} else if (
				$game = 'wows'
				&& !empty($warships)
				&& !empty($shipInfo)
			) {
				include __DIR__.'/detail/wows.ships.php';
			}
			?>
		</div>
	</div>
</div>
