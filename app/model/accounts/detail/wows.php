<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseModelAccountsDetailWows extends jpWseModel
{
	/**
	 * Loads the display data from given request.
	 */
	public function load()
	{
		parent::load();

		$app = jpWseApp::getInstance();

		$accountID = $this->data['account_id'] = $this->requestData[$this->apiCall];

		$this->data['info'] = $this->gameReader->getAccountInfo (
			$accountID,
			jpWseConfig::$apiFields['wows']['accounts']['detail']
		);

		// @todo watch later for limitation... in wot the call has a max. of 50
		$this->data['warships'] = $this->gameReader->getShipsStats($accountID);

		$infoModel = $app->getModelInstance('InfoWows');
		$infoModel->setRequestData($this->requestData);
		$infoModel->load();

		$info =  $infoModel->getData();
		$this->data['info_ship_nations'] = $info->data->ship_nations;
		$this->data['info_ship_types'] = $info->data->ship_types;

		$this->_loadExtendedVehiclesData();
	}

	/**
	 * @return null
	 */
	protected function _loadExtendedVehiclesData()
	{
		$accountID = $this->data['account_id'];

		if(empty($this->data['warships']->data->{$accountID})) {
			return;
		}

		$warships = $this->data['warships']->data->{$accountID};
		$this->data['shipinfo'] = [];
		$shipIdArray = [];

		foreach($warships as $ship) {
			/*
			 * Fetch the tank_id's to an array, that we can get the tankinfo in
			 * one bigger api call instead of many single api calls.
			 */
			$shipIdArray[] = $ship->ship_id;
		}

		if(empty($shipIdArray)) {
			return;
		}

		$this->data['shipinfo'] = $this->gameReader->getEncyclopediaShips (
			implode(',', $shipIdArray),
			jpWseConfig::$apiFields['wiki']['shipinfo']
		);

		foreach($this->data['shipinfo']->data as $shipInfo) {
			if(!isset($this->data['ship_types'][$shipInfo->type])) {
				$this->data['ship_types'][$shipInfo->type] = [
					'type_i18n' => $this->data['info_ship_types']->{$shipInfo->type},
					'wins' => 0,
					'battles' => 0,
				];
			}

			if(!isset($this->data['nations'][$shipInfo->nation])) {
				$this->data['nations'][$shipInfo->nation] = [
					'nation_i18n' => $this->data['info_ship_nations']->{$shipInfo->nation},
					'wins' => 0,
					'battles' => 0,
				];
			}
		}

		foreach($warships as $ship)
		{
			$type = $this->data['shipinfo']->data->{$ship->ship_id}->type;
			$nation = $this->data['shipinfo']->data->{$ship->ship_id}->nation;

			$this->data['ship_types'][$type]['wins'] += $ship->pvp->wins;
			$this->data['ship_types'][$type]['battles'] += $ship->pvp->battles;

			$this->data['nations'][$nation]['wins'] += $ship->pvp->wins;
			$this->data['nations'][$nation]['battles'] += $ship->pvp->battles;
		}
	}
}
