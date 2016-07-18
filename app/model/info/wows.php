<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseModelInfoWows extends jpWseModel
{
	/**
	 * Loads the display data from given request.
	 */
	public function load()
	{
		$this->initReader('wows');
		$this->data = $this->gameReader->getEncyclopediaInfo ([
			'game_version',
			'ship_nations',
			'ship_types',
			'ship_type_images',
		]);
	}
}
