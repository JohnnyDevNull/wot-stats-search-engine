<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseModel
{
	/**
	 * @var string|array
	 */
	protected $requestData = '';

	/**
	 * @var string
	 */
	protected $apiCall = '';

	/**
	 * @var array
	 */
	protected $data = array();

	/**
	 * @var jpWargamingReaderWot|jpWargamingReaderWows
	 */
	protected $gameReader;

	/**
	 * @var jpWargamingReaderClans
	 */
	protected $clanReader;

	/**
	 * Invokes the model loading.
	 */
	public function load()
	{
		$request = array_keys($this->requestData);
		$this->apiCall = reset($request);

		if(!isset($this->requestData['game'])) {
			throw new LogicException('game index is missing in request data');
		}

		$this->initReader($this->requestData['game']);
	}

	/**
	 * @param string|array $value
	 */
	public function setRequestData($value)
	{
		$this->requestData = $value;
	}

	/**
	 * @return string|array
	 */
	public function getRequestData()
	{
		return $this->requestData;
	}

	/**
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @return string
	 */
	public function getApiCall()
	{
		return $this->apiCall;
	}

	/**
	 * Initializes the game and clan reader
	 *
	 * @param string $game
	 */
	protected function initReader($game)
	{
		switch($game)
		{
			case 'wot':
				$this->gameReader = new jpWargamingReaderWot (
					jpWseConfig::$app_id,
					jpWseConfig::$region,
					jpWseConfig::$lang
				);
				break;
			case 'wows':
				$this->gameReader = new jpWargamingReaderWows (
					jpWseConfig::$app_id,
					jpWseConfig::$region,
					jpWseConfig::$lang
				);
				break;
		}

		$this->gameReader->setDecode(true);
		$this->gameReader->setAssoc(false);

		$this->clanReader = new jpWargamingReaderClans (
			jpWseConfig::$app_id,
			jpWseConfig::$region,
			jpWseConfig::$lang
		);
		$this->clanReader->setDecode(true);
		$this->clanReader->setAssoc(false);
	}
}
