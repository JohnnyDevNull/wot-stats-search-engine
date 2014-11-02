<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */

if(!isset($data['page'])) {
	$data['page'] = '';
}

if(!isset($data['limit_entries'])) {
	$data['limit_entries'] = array ( 10, 20, 50, 100);
}

if(!isset($data['last_value'])) {
	$data['last_value'] = 10;
}

if(!isset($data['title'])) {
	$data['title'] = '';
}
?>
<select name="request[<?=$data['page']?>][limit]"
		class="form-control input-sm"
		title="<?=$data['title']?>">
<?php foreach($data['limit_entries'] as $limit) : ?>
	<option value="<?=$limit?>"
		<?=$data['last_value'] == $limit ? 'selected' : ''?>>
		<?=$limit?>
	</option>
<?php endforeach;?>
</select>