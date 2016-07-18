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

		switch($this->apiCall) {
			case 'search':
				$this->data = $this->clanReader->getClansList (
					$this->requestData[$this->apiCall],
					jpWseConfig::$apiFields['clans']['search'],
					$this->requestData['limit']
				);
				break;

			case 'detail':
				$this->data['clan_id'] = $this->requestData[$this->apiCall];

				$this->data['info'] = $this->clanReader->getClansInfo (
					$this->data['clan_id'],
					jpWseConfig::$apiFields['clans']['detail']
				);

				break;

			default:
				$this->data['error'] = 1;
				$this->data['error_msg'] = 'Unknown Request invoked. "'.$this->apiCall.'"';
		}
	}
}
