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

if(!isset($data['game_entries'])) {
	$data['game_entries'] = [
		0 => [
			'key' => 'wot',
			'name' => 'World of Tanks',
		],
		1 => [
			'key' => 'wows',
			'name' => 'World of Warships',
		]
	];
}

if(!isset($data['last_value'])) {
	$data['last_value'] = jpWseConfig::$game;
}

if(!isset($data['title'])) {
	$data['title'] = '';
}
?>
<select name="request[<?=$data['page']?>][game]"
		class="form-control input-sm"
		title="<?=$data['title']?>">
	<?php foreach($data['game_entries'] as $game) : ?>
		<option value="<?=$game['key']?>"
			<?=$data['last_value'] == $game['key'] ? 'selected' : ''?>>
			<?=$game['name']?>
		</option>
	<?php endforeach;?>
</select>
