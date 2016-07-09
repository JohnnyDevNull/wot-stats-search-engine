<?php
/**
 * Request class for all "Wargaming.NET" game apis, that are implemented.
 *
 * This class is used to perform the requests for all api classes.
 *
 * @package jp-wargaming-api-reader
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2016, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWargamingRequest
{
	/**
	 * @var resource
	 */
	private $_ch;

	/**
	 * @var jpWargamingRegion
	 */
	private $region;

	/**
	 * @var bool
	 */
	private $secure;

	/**
	 * @var string
	 */
	private $method = 'GET';

	/**
	 * @var bool
	 */
	private $decode = false;

	/**
	 * @var bool
	 */
	private $prettyPrint = false;

	/**
	 * @var bool
	 */
	private $assoc = false;

	/**
	 * @var mixed[]
	 */
	private $lastRequest = [];

	/**
	 * @param jpWargamingRegion $region
	 */
	public function __construct(jpWargamingRegion $region)
	{
		$this->region = $region;
	}

	/**
	 * Closes an open curl resource.
	 */
	public function __destruct()
	{
		if($this->_ch !== null) {
			curl_close($this->_ch);
		}
	}

	/**
	 * @param string $path
	 * @param mixed[] $query
	 * @return mixed
	 */
	public function perform($path, array $query)
	{
		if($this->_ch === null) {
			$this->_ch = curl_init();
			curl_setopt($this->_ch, CURLOPT_FORBID_REUSE, 0);
		}

		$url = 'http';

		if($this->secure) {
			$url = 'https';
		}

		$url .= '://'.$this->region->getUrl().$path;

		$query = array_merge( $query, [
			'language' => $this->region->getLang(),
			'application_id' => $this->region->getAppId()
		]);

		$query = array_filter($query);

		if($this->method === 'GET') {
			$url .= '?'.http_build_query($query);
		} elseif ($this->method === 'POST') {
			curl_setopt($this->_ch, CURLOPT_POST, 1);
			curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $query);
		} else {
			throw new LogicException('Invalid request method given.');
		}

		curl_setopt($this->_ch, CURLOPT_URL, $url);
		curl_setopt($this->_ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($this->_ch);

		if($output === false) {
			$output = json_encode([
				'errorno' => curl_errno($this->_ch),
				'error' => curl_error($this->_ch),
			]);
		}

		if($this->getPrettyPrint()) {
			$output = json_decode($output);
			$output = json_encode($output, JSON_PRETTY_PRINT);
		}

		if($this->getDecode()) {
			$response = json_decode($output, $this->getAssoc());
		} else {
			$response = $output;
		}

		$this->setLastRequest($this->method, $url, $query, $response);

		return $response;
	}

	/**
	 * @param string $method
	 * @param string $url
	 * @param mixed[] $query
	 * @param string|mixed[]|stdClass $response
	 */
	private function setLastRequest($method, $url, $query, $response)
	{
		$this->lastRequest = [
			'method' => $method,
			'url' => $url,
			'query' => $query,
			'response' => $response,
		];
	}

	/**
	 * @return mixed[]
	 */
	public function getLastRequest()
	{
		return $this->lastRequest;
	}

	/**
	 * @param bool $bool
	 */
	public function setSecure($bool)
	{
		$this->secure = $bool;
	}

	/**
	 * @return bool
	 */
	public function getSecure()
	{
		return $this->secure;
	}

	/**
	 * Sets the request method fix to POST
	 */
	public function setPostMethod()
	{
		$this->method = 'POST';
	}

	/**
	 * Sets the request method fix to GET
	 */
	public function setGetMethod()
	{
		$this->method = 'GET';
	}

	/**
	 * @param bool $bool
	 */
	public function setDecode($bool)
	{
		$this->decode = (bool)$bool;
	}

	/**
	 * @return bool
	 */
	public function getDecode()
	{
		return $this->decode;
	}

	/**
	 * @param $bool
	 */
	public function setPrettyPrint($bool)
	{
		$this->prettyPrint = (bool)$bool;
	}

	/**
	 * @return bool
	 */
	public function getPrettyPrint()
	{
		return $this->prettyPrint;
	}

	/**
	 * @param $bool
	 */
	public function setAssoc($bool)
	{
		$this->assoc = (bool)$bool;
	}

	/**
	 * @return bool
	 */
	public function getAssoc()
	{
		return $this->assoc;
	}
}
