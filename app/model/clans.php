<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseModelClans extends jpWseModel
{
	/**
	 * Loads the display data from given request.
	 */
	public function load()
	{
		parent::load();

		switch($this->_apiCall) {
			case 'search':
				$this->_data = $this->_clanReader->getClansList (
					$this->_requestData[$this->_apiCall],
					jpWseConfig::$wotApiFields['clans']['search'],
					$this->_requestData['limit']
				);
				break;

			case 'detail':
				$this->_data['clan_id'] = $this->_requestData[$this->_apiCall];

				$this->_data['info'] = $this->_clanReader->getClansInfo (
					$this->_data['clan_id'],
					jpWseConfig::$wotApiFields['clans']['detail']
				);

				break;

			default:
				$this->_data['error'] = 1;
				$this->_data['error_msg'] = 'Unknown Request invoked. "'.$this->_apiCall.'"';
		}
	}
}
