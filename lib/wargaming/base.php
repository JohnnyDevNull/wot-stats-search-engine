<?php
/**
 * Base class for all "Wargaming.NET" game apis, that are implemented.
 *
 * This class is used to distribute the region and request class to all api
 * reader classes.
 *
 * @package jpWargamingApiReader
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2016, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
abstract class jpWargamingBase
{
	/**
	 * @var jpWargamingRegion
	 */
	protected $region;

	/**
	 * @var jpWargamingRequest
	 */
	protected $request;

	/**
	 * @param string $appId
	 * @param string $region
	 */
	public function __construct($appId, $region = 'EU')
	{
		$this->region = new jpWargamingRegion($appId, $region);
		$this->request = new jpWargamingRequest($this->region);
	}

	/**
	 * @param string|string[] $fields
	 * @return string
	 */
	protected function toListString($fields)
	{
		if(is_array($fields))
		{
			return  implode(',', $fields);
		}

		return $fields;
	}

	/**
	 * @param bool $bool
	 */
	public function setSecure($bool)
	{
		$this->request->setSecure($bool);
	}

	/**
	 * Sets the request method fix to POST
	 */
	public function setPostMethod()
	{
		$this->request->setPostMethod();
	}

	/**
	 * Sets the request method fix to GET
	 */
	public function setGetMethod()
	{
		$this->request->setGetMethod();
	}

	/**
	 * @param bool $bool
	 */
	public function setDecode($bool)
	{
		$this->request->setDecode($bool);
	}

	/**
	 * @param bool $bool
	 */
	public function setPrettyPrint($bool)
	{
		$this->request->setPrettyPrint($bool);
	}
}
