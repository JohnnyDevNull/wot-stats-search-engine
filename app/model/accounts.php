<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWseModelAccounts extends jpWseModel
{
	/**
	 * Loads the display data from given request.
	 */
	public function load()
	{
		parent::load();

		$app = jpWseApp::getInstance();

		switch($this->apiCall) {
			case 'search':
				$this->data = $this->gameReader->getAccountList (
					strip_tags($this->requestData['search']),
					jpWseConfig::$apiFields['wot']['accounts']['search'],
					'',
					$this->requestData['limit']
				);
				break;

			case 'detail':

				$game = $this->requestData['game'];
				$detailModel = $app->getModelInstance('AccountsDetail'.ucfirst($game));
				$detailModel->setRequestData($this->requestData);
				$detailModel->load();

				$this->data = $detailModel->getData();

				break;

			default:
				$this->data['error'] = 1;
				$this->data['error_msg'] = 'Unknown Request invoked. "'.$this->apiCall.'"';
		}
	}
}
