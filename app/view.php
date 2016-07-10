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
	protected $controller;

	/**
	 * @var jpWseModel
	 */
	protected $model = null;

	/**
	 * @param jpWseController $controller
	 * @param jpWseModel $model [optional] default: null
	 */
	public function __construct($controller, $model = null)
	{
		$this->controller = $controller;
		$this->model = $model;
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
				$this->controller->getRequestData()
			);

			if(!empty($this->model)) {
				jpWseTemplate::render (
					$app->getPageKey().'.'.$this->model->getApiCall(),
					[
						'result' => $this->model->getData(),
						'request' => $this->controller->getRequestData()
					]
				);
			}
			?>
		</div>
		<?php
	}
}
