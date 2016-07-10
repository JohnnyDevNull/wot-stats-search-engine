<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseModelAccountsDetailWot extends jpWseModel
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
			jpWseConfig::$wotApiFields['accounts']['detail']
		);

		$clanID = $this->data['info']->data->$accountID->clan_id;

		if(!empty($clanID)) {
			$this->data['info']->data->$accountID->clan = $this->clanReader->getClansInfo (
				$clanID,
				array('name', 'tag')
			);
		}

		$this->data['vehicles'] = $this->gameReader->getAccountVehicles($accountID);
		$this->data['vehicles']->data->{$accountID} =  array_slice (
			$this->data['vehicles']->data->{$accountID}, 0, 50
		);

		$infoModel = $app->getModelInstance('info');
		$infoModel->setRequestData($this->requestData);
		$infoModel->load();

		$info =  $infoModel->getData();
		$this->data['info_vehicle_nations'] = $info->data->vehicle_nations;
		$this->data['info_vehicle_types'] = $info->data->vehicle_types;

		$this->_loadExtendedVehiclesData();
	}

	/**
	 * @return null
	 */
	protected function _loadExtendedVehiclesData()
	{
		$accountID = $this->data['account_id'];

		if(empty($this->data['vehicles']->data->{$accountID})) {
			return;
		}

		$vehicles = $this->data['vehicles']->data->{$accountID};
		$this->data['tankinfo'] = array();
		$tankIdArray = array();

		foreach($vehicles as $vehicle) {
			/*
			 * Fetch the tank_id's to an array, that we can get the tankinfo in
			 * one bigger api call instead of many single api calls.
			 */
			$tankIdArray[] = $vehicle->tank_id;
		}

		if(empty($tankIdArray)) {
			return;
		}

		$this->data['tankinfo'] = $this->gameReader->getEncyclopediaVehicles (
			implode(',', $tankIdArray),
			jpWseConfig::$wotApiFields['wiki']['tankinfo']
		);

		foreach($this->data['tankinfo']->data as $tankInfo) {
			if(!isset($this->data['vehicle_types'][$tankInfo->type])) {
				$this->data['vehicle_types'][$tankInfo->type] = array(
					'type_i18n' => $this->data['info_vehicle_types']->{$tankInfo->type},
					'wins' => 0,
					'battles' => 0,
				);
			}

			if(!isset($this->data['nations'][$tankInfo->nation])) {
				$this->data['nations'][$tankInfo->nation] = array(
					'nation_i18n' => $this->data['info_vehicle_nations']->{$tankInfo->nation},
					'wins' => 0,
					'battles' => 0,
				);
			}
		}

		foreach($vehicles as $vehicle)
		{
			$type = $this->data['tankinfo']->data->{$vehicle->tank_id}->type;
			$nation = $this->data['tankinfo']->data->{$vehicle->tank_id}->nation;

			$this->data['vehicle_types'][$type]['wins'] += $vehicle->statistics->wins;
			$this->data['vehicle_types'][$type]['battles'] += $vehicle->statistics->battles;

			$this->data['nations'][$nation]['wins'] += $vehicle->statistics->wins;
			$this->data['nations'][$nation]['battles'] += $vehicle->statistics->battles;
		}
	}
}
