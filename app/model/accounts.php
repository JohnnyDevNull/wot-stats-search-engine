<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseModelAccounts extends jpWseModel
{
	/**
	 * Loads the display data from given request.
	 */
	public function load()
	{
		parent::load();

		$app = jpWseApp::getInstance();

		switch($this->_apiCall) {
			case 'search':
				$this->_data = $this->_gameReader->getAccountList (
					$this->_requestData[$this->_apiCall],
					jpWseConfig::$wotApiFields['accounts']['search'],
					'',
					$this->_requestData['limit']
				);
				break;

			case 'detail':
				$accountID = $this->_data['account_id'] = $this->_requestData[$this->_apiCall];

				$this->_data['info'] = $this->_gameReader->getAccountInfo (
					$accountID,
					jpWseConfig::$wotApiFields['accounts']['detail']
				);

				$clanID = $this->_data['info']->data->$accountID->clan_id;

				if(!empty($clanID)) {
					$this->_data['info']->data->$accountID->clan = $this->_clanReader->getClansInfo (
						$clanID,
						array('name', 'tag')
					);
				}

				$this->_data['vehicles'] = $this->_gameReader->getAccountVehicles($accountID);
				$this->_data['vehicles']->data->{$accountID} =  array_slice (
					$this->_data['vehicles']->data->{$accountID}, 0, 50
				);

				$nationsModel = $app->getModelInstance('info');
				$nationsModel->load();
				$info =  $nationsModel->getData();
				$this->_data['info_vehicle_nations'] = $info->data->vehicle_nations;
				$this->_data['info_vehicle_types'] = $info->data->vehicle_types;

				$this->_loadExtendedVehiclesData();

				break;

			default:
				$this->_data['error'] = 1;
				$this->_data['error_msg'] = 'Unknown Request invoked. "'.$this->_apiCall.'"';
		}
	}

	/**
	 * @return null
	 */
	protected function _loadExtendedVehiclesData()
	{
		$accountID = $this->_data['account_id'];

		if(empty($this->_data['vehicles']->data->{$accountID})) {
			return;
		}

		$vehicles = $this->_data['vehicles']->data->{$accountID};
		$this->_data['tankinfo'] = array();
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

		$this->_data['tankinfo'] = $this->_gameReader->getEncyclopediaVehicles (
			implode(',', $tankIdArray),
			jpWseConfig::$wotApiFields['wiki']['tankinfo']
		);

		foreach($this->_data['tankinfo']->data as $tankInfo) {
			if(!isset($this->_data['vehicle_types'][$tankInfo->type])) {
				$this->_data['vehicle_types'][$tankInfo->type] = array(
					'type_i18n' => $this->_data['info_vehicle_types']->{$tankInfo->type},
					'wins' => 0,
					'battles' => 0,
				);
			}

			if(!isset($this->_data['nations'][$tankInfo->nation])) {
				$this->_data['nations'][$tankInfo->nation] = array(
					'nation_i18n' => $this->_data['info_vehicle_nations']->{$tankInfo->nation},
					'wins' => 0,
					'battles' => 0,
				);
			}
		}

		foreach($vehicles as $vehicle)
		{
			$type = $this->_data['tankinfo']->data->{$vehicle->tank_id}->type;
			$nation = $this->_data['tankinfo']->data->{$vehicle->tank_id}->nation;

			$this->_data['vehicle_types'][$type]['wins'] += $vehicle->statistics->wins;
			$this->_data['vehicle_types'][$type]['battles'] += $vehicle->statistics->battles;

			$this->_data['nations'][$nation]['wins'] += $vehicle->statistics->wins;
			$this->_data['nations'][$nation]['battles'] += $vehicle->statistics->battles;
		}
	}
}
