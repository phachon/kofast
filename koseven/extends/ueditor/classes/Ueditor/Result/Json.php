<?php
/** 
 * UEditor 返回json
 * @author phachon@163.com
 */
class UEditor_Result_Json extends UEditor_Result {

	public function execute() {
		return json_encode(self::$_result);
	}
}