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
<input type="hidden"
	   name="request[call]"
	   value="search" />
<input type="text"
	   class="form-control input-sm"
	   name="request[search]"
	   placeholder="<?=$data['placeholder']?>"
	   id="<?=$data['id']?>"
	   value="<?=$data['last_value']?>"
	   required>
