<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */
class jpWotView
{
	/**
	 * @var jpWotController
	 */
	protected $_controller;

	/**
	 * @var jpWotModel
	 */
	protected $_model = null;

	/**
	 * @param jpWotController $controller
	 * @param jpWotModel $model (optional) default null
	 */
	public function __construct($controller, $model = null)
	{
		$this->_controller = $controller;
		$this->_model = $model;
	}

	/**
	 * Loads the nessecarry templates and invokes the html generating.
	 */
	public function render()
	{
		$app = jpWotApp::getInstance();
		$this->_renderTemplate('main.navigation');

		?>
		<div id="main" role="main">
			<?php
			$this->_renderTemplate (
				$app->getPageKey().'.filterarea',
				$this->_controller->getRequestData($app->getPageKey())
			);

			if(!empty($this->_model)) {
				$this->_renderTemplate (
					$app->getPageKey().'.'.$this->_model->getApiCall(),
					array('result' => $this->_model->getData())
				);
			}
			?>
		</div>
		<?php
	}

	/**
	 * @param string $path
	 * @param array $data (optional) default empty array
	 * @param string $extension (optional) default ".php"
	 */
	protected function _renderTemplate($path, $data = array(), $extension = 'php')
	{
		$parts = explode('.', $path);
		$path = BPATH.'/app/view/templates/'.implode('/', $parts).'.'.$extension;

		if(is_file($path)) {
			if(!isset($data['page'])) {
				$app = jpWotApp::getInstance();
				$data['page'] = $app->getPageKey();
			}

			require_once $path;
		}
	}
}
