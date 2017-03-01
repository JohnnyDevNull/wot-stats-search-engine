<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
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
<select name="request[limit]"
		class="form-control input-sm"
		title="<?=$data['title']?>">
<?php foreach($data['limit_entries'] as $limit) : ?>
	<option value="<?=$limit?>"
		<?=$data['last_value'] == $limit ? 'selected' : ''?>>
		<?=$limit?>
	</option>
<?php endforeach;?>
</select>
