<?php
/**
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
}

