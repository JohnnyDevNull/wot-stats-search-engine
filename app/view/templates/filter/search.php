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

if(!isset($data['id'])) {
	$data['id'] = 'input'.ucfirst($data['page']);
}

if(!isset($data['last_value'])) {
	$data['last_value'] = '';
}

if(!isset($data['label'])) {
	$data['label'] = '';
}

if(!isset($data['placeholder'])) {
	$data['placeholder'] = '';
}
?>
<label for="<?=$data['id']?>"
	   class="sr-only">
	<?=$data['label']?>
</label>
<input type="text"
	   class="form-control input-sm"
	   name="request[<?=$data['page']?>][search]"
	   placeholder="<?=$data['placeholder']?>"
	   id="<?=$data['id']?>"
	   value="<?=$data['last_value']?>">
