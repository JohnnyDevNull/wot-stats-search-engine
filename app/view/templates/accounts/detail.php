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
$accountID = 0;

if(!empty($data['result'])) {
	$result = $data['result'];
	$accountID = $result['account_id'];

	$info = $result['info']->data->{$accountID};
	$vehicles = $result['vehicles']->data->{$accountID};
	$tankInfo = $result['tankinfo']->data;
}

$game = $data['request'][$data['page']]['game'];
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
			if(!empty($vehicles) && !empty($tankInfo)) {
				include __DIR__.'/detail/'.$game.'.vehicles.php';
			}
			?>
		</div>
	</div>
</div>
