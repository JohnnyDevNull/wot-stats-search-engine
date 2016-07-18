<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseModelInfoWot extends jpWseModel
{
	/**
	 * Loads the display data from given request.
	 */
	public function load()
	{
		$this->initReader('wot');
		$this->data = $this->gameReader->getEncyclopediaInfo ([
			'game_version',
			'vehicle_nations',
			'vehicle_types'
		]);
	}
}
