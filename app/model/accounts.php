<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */
class jpWotModelAccounts extends jpWotModel
{
	/**
	 * Loads the display data from given request.
	 */
	public function load()
	{
		parent::load();

		switch($this->_apiCall) {
			case 'search':
				$this->_data = $this->getUser (
					'search',
					$this->_requestData[$this->_apiCall]
				);
				break;

			case 'detail':
				$this->_data['account_id'] = $this->_requestData[$this->_apiCall];

				$this->_data['info'] = $this->getUser (
					'info',
					$this->_data['account_id']
				);

				$this->_data['vehicles'] = $this->getUser (
					'vehicles',
					$this->_data['account_id']
				);

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

		if(empty($this->_data['vehicles']->$accountID)) {
			return;
		}

		$vehicles = $this->_data['vehicles']->$accountID;
		$this->_data['tankinfo'] = array();
		$tankIdArray = array();

		foreach($vehicles as $vehicle) {
			/*
			 * Fetch the tank_id's to an array, that we can get the tankinfo in
			 * one bigger api call instead of many single api calls. This will
			 * be very much faster.
			 */
			$tankIdArray[] = $vehicle->tank_id;
		}

		if(!empty($tankIdArray)) {
			$this->_data['tankinfo'] = $this->getWiki (
				'tankinfo',
				implode(',', $tankIdArray),
				jpWotConfig::$wotApiFields['wiki']['tankinfo']
			);
		}

		foreach($this->_data['tankinfo'] as $tankInfo) {
			if(!isset($this->_data['vehicle_types'][$tankInfo->type])) {
				$this->_data['vehicle_types'][$tankInfo->type] = array(
					'type_i18n' => $tankInfo->type_i18n,
					'wins' => 0,
					'battles' => 0,
				);
			}

			if(!isset($this->_data['nations'][$tankInfo->nation])) {
				$this->_data['nations'][$tankInfo->nation] = array(
					'nation_i18n' => $tankInfo->nation_i18n,
					'wins' => 0,
					'battles' => 0,
				);
			}
		}

		foreach($vehicles as $vehicle)
		{
			$type = $this->_data['tankinfo']->{$vehicle->tank_id}->type;
			$nation = $this->_data['tankinfo']->{$vehicle->tank_id}->nation;

			$this->_data['vehicle_types'][$type]['wins'] += $vehicle->statistics->wins;
			$this->_data['vehicle_types'][$type]['battles'] += $vehicle->statistics->battles;

			$this->_data['nations'][$nation]['wins'] += $vehicle->statistics->wins;
			$this->_data['nations'][$nation]['battles'] += $vehicle->statistics->battles;
		}
	}
}
