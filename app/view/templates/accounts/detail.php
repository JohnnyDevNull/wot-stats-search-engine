<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */

$result = $data['result'];
$accountID = $result['account_id'];
?>
<div class="row">
	<div class="col-lg-12">
		<div id="info">
			<?php
			if(isset($result['info']->data->$accountID)) {
				include __DIR__.'/detail/info.php';
			}
			?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div id="vehicles">
			<?php
			if(isset($result['vehicles']->data->$accountID, $result['tankinfo'])) {
				include __DIR__.'/detail/vehicles.php';
			}
			?>
		</div>
	</div>
</div>
