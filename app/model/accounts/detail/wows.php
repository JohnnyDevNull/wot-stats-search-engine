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

		$accountID = $this->data['account_id'] = $this->requestData['detail'];

		$this->data['info'] = $this->gameReader->getAccountInfo (
			$accountID,
			jpWseConfig::$apiFields['wows']['accounts']['detail']
		);

		$this->data['warships'] = $this->gameReader->getShipsStats($accountID);

		$infoModel = $app->getModelInstance('InfoWows');
		$infoModel->setRequestData($this->requestData);
		$infoModel->load();

		$info =  $infoModel->getData();
		$this->data['info_ship_nations'] = $info->data->ship_nations;
		$this->data['info_ship_types'] = $info->data->ship_types;

		if(!empty($this->data['warships']->data->{$accountID})) {
			$this->_loadExtendedVehiclesData();
			$this->_sortShips();
		}
	}

	/**
	 * @return null
	 */
	protected function _loadExtendedVehiclesData()
	{
		$accountID = $this->data['account_id'];
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

		$idCount = count($shipIdArray);

		while($idCount)
		{
			$callIdArray = array_splice($shipIdArray, 0, $idCount > 20 ? 20 : $idCount);
			$idCount = count($shipIdArray);

			$shipInfo = $this->gameReader->getEncyclopediaShips (
				implode(',', $callIdArray),
				jpWseConfig::$apiFields['wiki']['shipinfo']
			);

			if(empty($this->data['shipinfo']))
			{
				$this->data['shipinfo'] = $shipInfo;
			}
			else
			{
				$this->data['shipinfo']->data = (object) array_merge (
					(array)$this->data['shipinfo']->data,
					(array)$shipInfo->data
				);
			}
		}

		foreach($this->data['shipinfo']->data as $shipInfo) {

			if(empty($shipInfo)) {
				continue;
			}

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

		$this->data['armament'] = [
			'main_battery' => 0,
			'aircraft' => 0,
			'torpedos' => 0,
			'other' => 0,
		];

		foreach($warships as $ship) {
			if(empty($this->data['shipinfo']->data->{$ship->ship_id})) {
				continue;
			}

			$type = $this->data['shipinfo']->data->{$ship->ship_id}->type;
			$nation = $this->data['shipinfo']->data->{$ship->ship_id}->nation;

			$this->data['ship_types'][$type]['wins'] += $ship->pvp->wins;
			$this->data['ship_types'][$type]['battles'] += $ship->pvp->battles;

			$this->data['nations'][$nation]['wins'] += $ship->pvp->wins;
			$this->data['nations'][$nation]['battles'] += $ship->pvp->battles;

			$this->data['armament']['main_battery'] += (int)$ship->pvp->main_battery->frags;
			$this->data['armament']['aircraft'] += (int)$ship->pvp->aircraft->frags;
			$this->data['armament']['torpedos'] += (int)$ship->pvp->torpedoes->frags;

			$this->data['armament']['other'] += (int)$ship->pvp->second_battery->frags;
			$this->data['armament']['other'] += (int)$ship->pvp->ramming->frags;
		}

		// add now the other frags from sunk and burn down
		$accountFrags = $this->data['info']->data->{$accountID}->statistics->pvp->frags;
		$otherFrags = array_sum($this->data['armament']);
		$this->data['armament']['other'] += $accountFrags - $otherFrags;
	}

	/**
	 * Sorts the warships array from most partcipated battles to lowest.
	 */
	protected function _sortShips()
	{
		usort (
			$this->data['warships']->data->{$this->data['account_id']},
			function($a, $b) {
				return (int)$a->pvp->battles < (int)$b->pvp->battles;
			}
		);
	}
}
