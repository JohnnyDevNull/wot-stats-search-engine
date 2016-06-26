<?php
/**
 * Region class for all "Wargaming.NET" game apis, that are implemented.
 *
 * This class is used to set and get request relevant data by region.
 *
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
	private $url;

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
				$this->url = 'api.worldoftanks.eu';
				break;

			case 'NA':
				$this->region = 'NA';
				$this->url = 'api.worldoftanks.com';
				break;

			case 'ASIA':
				$this->region = 'ASIA';
				$this->url = 'api.worldoftanks.asia';
				break;

			case 'KR':
				$this->region = 'KR';
				$this->url = 'api.worldoftanks.kr';
				break;

			case 'RU':
			default:
				$this->region = 'RU';
				$this->url = 'api.worldoftanks.ru';
		}
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
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
	 * @param string $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
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
