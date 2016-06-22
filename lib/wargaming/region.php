<?php
/**
 * @package jpWargamingApiReader
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2016, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWargamingRegion
{
	/**
	 * @var string
	 */
	private $apiUrl;

	/**
	 * @var string
	 */
	private $region;

	/**
	 * @var string
	 */
	private $lang;

	/**
	 * @var string
	 */
	private $appId;

	/**
	 * @param string $region
	 */
	public function __construct($appId, $region = 'EU')
	{
		$this->setAppId($appId);

		switch (strtoupper($region)) {
			case 'EU':
				$this->region = 'EU';
				$this->apiUrl = 'http://api.worldoftanks.eu';
				break;

			case 'NA':
				$this->region = 'NA';
				$this->apiUrl = 'http://api.worldoftanks.com';
				break;

			case 'ASIA':
				$this->region = 'ASIA';
				$this->apiUrl = 'http://api.worldoftanks.asia';
				break;

			case 'KR':
				$this->region = 'KR';
				$this->apiUrl = 'http://api.worldoftanks.kr';
				break;

			case 'RU':
			default:
				$this->region = 'RU';
				$this->apiUrl = 'http://api.worldoftanks.ru';
		}
	}

	/**
	 * @return string
	 */
	public function getApiUrl()
	{
		return $this->apiUrl;
	}

	/**
	 * @return string
	 */
	public function getRegion()
	{
		return $this->region;
	}

	/**
	 * @return string
	 */
	public function getLang()
	{
		return $this->lang;
	}

	/**
	 * @return string
	 */
	public function getAppId()
	{
		return $this->appId;
	}

	/**
	 * @param string $apiUrl
	 */
	public function setApiUrl($apiUrl)
	{
		$this->apiUrl = $apiUrl;
	}

	/**
	 * @param string $region
	 */
	public function setRegion($region)
	{
		$this->region = $region;
	}

	/**
	 * @param string $lang
	 */
	public function setLang($lang = 'ru')
	{
		$this->lang = $lang;
	}

	/**
	 * @param string $appId
	 */
	public function setAppId($appId)
	{
		$this->appId = $appId;
	}
}
