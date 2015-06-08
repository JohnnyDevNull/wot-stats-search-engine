<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWotModel extends Wot
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
	 * Initialize the parent World of Tanks web api class with the app's defaults
	 */
	public function __construct()
	{
		parent::__construct (
			jpWotConfig::$region,
			jpWotConfig::$lang,
			jpWotConfig::$app_id
		);

		$this->setCacheType (
			jpWotConfig::$cache,
			jpWotConfig::$cacheParams
		);
	}

	/**
	 * Invokes the model loading.
	 */
	public function load()
	{
		$request = array_keys($this->_requestData);
		$this->_apiCall = reset($request);

		if(isset($this->_requestData['limit'])) {
			$this->setLimit($this->_requestData['limit']);
		} else {
			$this->setLimit(20);
		}
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
