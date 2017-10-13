<?php
/**
 * api 示例
 * @author: phachon@163.com
 */
class Controller_Api extends Controller_Interfaces {

	/**
	 * 调用示例
	 * json：http://****.com/api/index?
	 * xml：http://****.com/api/index?data_type=xml
	 * jsonp：http://****.com/api/index?data_type=jsonp&callback=pp
	 */
	public function action_index() {

		$data = array(
			"name" => "phachon",
			"email" => "phachon@163.com",
		);

		$this->success($data);
	}
}