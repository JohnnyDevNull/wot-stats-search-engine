<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseView
{
	/**
	 * @var jpWseController
	 */
	protected $_controller;

	/**
	 * @var jpWseModel
	 */
	protected $_model = null;

	/**
	 * @param jpWseController $controller
	 * @param jpWseModel $model [optional] default: null
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
		$app = jpWseApp::getInstance();
		jpWseTemplate::render('main.navigation');

		?>
		<div id="main" role="main">
			<?php
			jpWseTemplate::render (
				$app->getPageKey().'.filterarea',
				$this->_controller->getRequestData($app->getPageKey())
			);

			if(!empty($this->_model)) {
				jpWseTemplate::render (
					$app->getPageKey().'.'.$this->_model->getApiCall(),
					array('result' => $this->_model->getData())
				);
			}
			?>
		</div>
		<?php
	}
}
