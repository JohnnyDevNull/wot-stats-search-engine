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
	protected $_requestData = '';

	/**
	 * @var string
	 */
	protected $_apiCall = '';

	/**
	 * @var array
	 */
	protected $_data = array();

	/**
	 * @var jpWargamingReaderWot|jpWargamingReaderWows
	 */
	protected $_gameReader;

	/**
	 * @var jpWargamingReaderClans
	 */
	protected $_clanReader;

	/**
	 * Initialize the parent World of Tanks web api class with the app's defaults
	 */
	public function __construct()
	{
		switch(jpWseConfig::$game)
		{
			case 'wot':
				$this->_gameReader = new jpWargamingReaderWot (
					jpWseConfig::$app_id,
					jpWseConfig::$region,
					jpWseConfig::$lang
				);
				break;
			case 'wows':
				$this->_gameReader = new jpWargamingReaderWows (
					jpWseConfig::$app_id,
					jpWseConfig::$region,
					jpWseConfig::$lang
				);
				break;
		}

		$this->_gameReader->setDecode(true);
		$this->_gameReader->setAssoc(false);

		$this->_clanReader = new jpWargamingReaderClans (
			jpWseConfig::$app_id,
			jpWseConfig::$region,
			jpWseConfig::$lang
		);
		$this->_clanReader->setDecode(true);
		$this->_clanReader->setAssoc(false);
	}

	/**
	 * Invokes the model loading.
	 */
	public function load()
	{
		$request = array_keys($this->_requestData);
		$this->_apiCall = reset($request);
	}

	/**
	 * @param string|array $value
	 */
	public function setRequestData($value)
	{
		$this->_requestData = $value;
	}

	/**
	 * @return string|array
	 */
	public function getRequestData()
	{
		return $this->_requestData;
	}

	/**
	 * @return array
	 */
	public function getData()
	{
		return $this->_data;
	}

	/**
	 * @return string
	 */
	public function getApiCall()
	{
		return $this->_apiCall;
	}
}
