<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
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
		jpWotTemplate::render('main.navigation');

		?>
		<div id="main" role="main">
			<?php
			jpWotTemplate::render (
				$app->getPageKey().'.filterarea',
				$this->_controller->getRequestData($app->getPageKey())
			);

			if(!empty($this->_model)) {
				jpWotTemplate::render (
					$app->getPageKey().'.'.$this->_model->getApiCall(),
					array('result' => $this->_model->getData())
				);
			}
			?>
		</div>
		<?php
	}
}
