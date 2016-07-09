<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseModelInfo extends jpWseModel
{
	/**
	 * Loads the display data from given request.
	 */
	public function load()
	{
		$this->_data = $this->_gameReader->getEncyclopediaInfo(['game_version', 'vehicle_nations', 'vehicle_types']);
	}
}
