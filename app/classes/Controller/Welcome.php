<?php
/**
 * Welcome Controller
 */
class Controller_Welcome extends Controller_Render {
	
	protected $_layout = "layouts/default";

	// 是否需要验证登录
	protected $_checkLogin = TRUE;

	/**
	 * 返回 html 模板
	 */
	public function action_index() {
		$this->_layout->content = View::factory("welcome/index");
	}

	/**
	 * 按照定义模板返回 json 格式数据
	 */
	public function action_json() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		// process
		//Business::factory("Welcome")->getText();

		//return $this->error("error info!");
		return $this->success("success info!");
	}

	/**
	 * 按照定义模板返回 xml 格式数据
	 */
	public function action_xml() {
		$this->_contentType = self::CONTENT_TYPE_XML;

		// process

		//return $this->error("error info!");
		return $this->success("success info!");
	}

	/**
	 * 自定义返回 html 模板
	 */
	public function action_customHtml() {
		$this->_autoRender = FALSE;

		$default = View::factory("layouts/default");
		$default->content = View::factory("welcome/index");
		$body = $default->render();

		$this->_body = $body;
	}

	/**
	 * 自定义数据模板返回 json 格式数据
	 */
	public function action_customJson() {
		$this->_autoRender = FALSE;
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$data = array(
			"name" => "phachon",
			"email" => "phachon@163.com",
		);

		$body = json_encode($data, true);

		$this->_body = $body;
	}

	/**
	 * 自定义数据模板返回 xml 格式数据
	 */
	public function action_customXml() {
		$this->_autoRender = FALSE;
		$this->_contentType = self::CONTENT_TYPE_XML;

		$data = array(
			"name" => "phachon",
			"email" => "phachon@163.com",
		);

		$body = Xmld::arrayToXml($data);

		$this->_body = $body;
	}

	/**
	 * 错误提示页面
	 */
	public function action_errorView() {
		Prompt::errorView("这是个错误提示页面", URL::site("author"));
	}

	/**
	 * 成功提示页面
	 */
	public function action_successView() {
		Prompt::successView("这是个成功提示页面", URL::site("author"));
	}
}
