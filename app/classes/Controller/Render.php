<?php
/**
 * 渲染模板控制器基类 (适用于后台系统开发)
 * @author phachon@163.com
 */
abstract class Controller_Render extends Controller {

	/**
	 * layout view
	 */
	protected $_layout = 'layouts/default';

	/**
	 * 是否验证登录
	 * @var bool
	 */
	protected $_checkLogin = TRUE;

	/**
	 * 是否自动渲染模板
	 * @var bool
	 */
	protected $_autoRender = TRUE;

	/**
	 * code
	 * @var int
	 */
	protected $_code = 1;

	/**
	 * auto return json message
	 * @var string
	 */
	protected $_message = '';

	/**
	 * auto return json redirect
	 * @var null
	 */
	protected $_redirect = null;

	/**
	 * auto return json data
	 * @var array
	 */
	protected $_data = [];

	/**
	 * return body
	 * @var string
	 */
	protected $_body = '';

	/**
	 * login url
	 * @var string
	 */
	protected $_loginURL = '';

	/**
	 * default header contentType
	 * @var string
	 */
	protected $_contentType = self::CONTENT_TYPE_HTML;

	const CONTENT_TYPE_HTML = 'text/html';

	const CONTENT_TYPE_JSON = 'application/json';

	const CONTENT_TYPE_XML = 'text/xml';

	/**
	 * Loads the template [View] object.
	 */
	public function before() {

		parent::before();

		if($this->_autoRender === TRUE) {
			if($this->_contentType == self::CONTENT_TYPE_HTML) {
				$this->_layout = View::factory($this->_layout);
			}
		}
	}

	public function execute() {
		$this->before();

		$action = $this->request->action();

		$actionFull = 'action_'.$action;

		if(!method_exists($this, $actionFull)) {
			exit('The requested URL :'. $this->request->uri() .' was not found on this server.');
		}

		//TODO check login
		if($this->_checkLogin) {
			$login = true;
			if(!$login) {
				Controller::redirect('author');
			}
		}

		//TODO check privilege

		$this->{$actionFull}();

		$this->after();

		return $this->response;
	}

	/**
	 * Assigns the template [View] as the request response.
	 */
	public function after() {
		$this->response->headers('Content-type', $this->_contentType);

		if($this->_autoRender === TRUE) {
			$body = array(
				'code' => $this->_code,
				'message' => $this->_message,
				'redirect' => $this->_redirect,
				'data' => $this->_data
			);

			if($this->_contentType == self::CONTENT_TYPE_HTML) {
				$this->_body = $this->_layout->render();
			}
			if($this->_contentType == self::CONTENT_TYPE_JSON) {
				$this->_body = json_encode($body, true);
			}
			if($this->_contentType == self::CONTENT_TYPE_XML) {
				$this->_body = Xmld::arrayToXml($body);
			}
		}

		$this->response->body($this->_body);

		parent::after();
	}

	/**
	 * return when error
	 * @param string $message
	 * @param string $redirect
	 * @param array $data
	 */
	public function error($message, $redirect = '', $data = []) {
		$this->_code = 0;
		$this->_message = $message;
		$this->_redirect = $redirect;
		$this->_data = $data;
	}

	/**
	 * return when success
	 * @param string $message
	 * @param string $redirect
	 * @param array $data
	 */
	public function success($message, $redirect = '', $data = []) {
		$this->_code = 1;
		$this->_message = $message;
		$this->_redirect = $redirect;
		$this->_data = $data;
	}
}