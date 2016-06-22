<?php
/**
 * @package jpWargamingApiReader
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2016, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWargamingRequest
{
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
		if($this->_curl !== null) {
			curl_close($this->_ch);
		}
	}

	/**
	 * @param bool $bool
	 */
	public function setSecure($bool)
	{
		$this->secure = $bool;
	}

	/**
	 * @param string $path
	 * @param mixed[] $query
	 * @param bool $assoc
	 * @return mixed
	 */
	public function perform($path, array $query, $assoc = false)
	{
		$prot = 'http';

		if($this->secure) {
			$prot = 'https';
		}

		$url = $prot.'://'.$this->_region->getHost().$path;

		if(strpos($url, '?') !== false) {
			$url .= '&';
		} else {
			$url .= '?';
		}

		$url .= 'language='.$this->region->getLang()
			  . '&application_id='.$this->region->getAppId();

		if(strpos('search', $url) !== false && !empty(WARGAMING_API_RESPONSE_LIMIT)) {
			$url .= '&limit='.(int)WARGAMING_API_RESPONSE_LIMIT;
		}

		if($this->_ch === null) {
			$this->_ch = curl_init();
			curl_setopt($this->_ch, CURLOPT_FORBID_REUSE, 0);
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

		return json_decode($output, $assoc);
	}

	public function setUsePost()
	{
		$this->method = 'POST';
	}

	public function setUseGet()
	{
		$this->method = 'GET';
	}
}
