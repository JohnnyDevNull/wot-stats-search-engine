<?php
/**
 * Region class for all "Wargaming.NET" game apis, that are implemented.
 *
 * This class is used to set and get request relevant data by region.
 *
 * @package jp-wargaming-api-reader
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
	 * @param string $appId
	 * @param string $region
	 * @param string $lang [optional] default: 'en'
	 * @param string $api [optional] default: 'worldoftanks'
	 */
	public function __construct($appId, $region = 'EU', $lang = 'en', $api = 'worldoftanks')
	{
		$this->setAppId($appId);
		$this->setLang($lang);

		switch (strtoupper($region)) {
			case 'EU':
				$this->region = 'EU';
				$this->url = 'api.'.$api.'.eu';
				break;

			case 'NA':
				$this->region = 'NA';
				$this->url = 'api.'.$api.'.com';
				break;

			case 'ASIA':
				$this->region = 'ASIA';
				$this->url = 'api.'.$api.'.asia';
				break;

			case 'KR':
				$this->region = 'KR';
				$this->url = 'api.'.$api.'.kr';
				break;

			case 'RU':
			default:
				$this->region = 'RU';
				$this->url = 'api.'.$api.'.ru';
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
