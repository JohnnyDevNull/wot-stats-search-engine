<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWotController
{
	/**
	 * @var array
	 */
	protected $_request = array();

	/**
	 * Invokes the model and view loading.
	 */
	public function index()
	{
		$app = jpWotApp::getInstance();
		$model = null;

		if(!empty($this->_request[$app->getPageKey()])) {
			$model = $app->getModelInstance($app->getPageKey());
			$model->setRequestData($this->_request[$app->getPageKey()]);
			$model->load();
		}

		$view = new jpWotView($this, $model);
		$view->render();
	}

	/**
	 * Sets the request data from the filter area.
	 *
	 * @param array $data
	 */
	public function setRequestData($data)
	{
		$this->_request = $data;
	}

	/**
	 * Returns the whole request array.
	 *
	 * @return array
	 */
	public function getRequestData()
	{
		return $this->_request;
	}

	/**
	 * Returns the request specified by the given path.
	 *
	 * @param type $key
	 */
	public function getRequestDataByK($key)
	{
		$ret = array();

		if(isset($this->_request[$key])) {
			$ret = $this->_request[$key];
		}

		return $ret;
	}
}
