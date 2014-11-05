<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */
class jpWotModelClans extends jpWotModel
{
	/**
	 * Loads the display data from given request.
	 */
	public function load()
	{
		parent::load();

		switch($this->_apiCall) {
			case 'search':
				$this->_data = $this->getClan (
					'search',
					$this->_requestData[$this->_apiCall],
					jpWotConfig::$wotApiFields['clans']['search']
				);
				break;

			case 'detail':
				$this->_data['clan_id'] = $this->_requestData[$this->_apiCall];

				$this->_data['info'] = $this->getClan (
					'info',
					$this->_data['clan_id'],
					jpWotConfig::$wotApiFields['clans']['detail']
				);

				break;

			default:
				$this->_data['error'] = 1;
				$this->_data['error_msg'] = 'Unknown Request invoked. "'.$this->_apiCall.'"';
		}
	}
}
