<?php
/** 
 * UEditor 返回xml
 * @author phachon@163.com
 */
class UEditor_Result_Xml extends UEditor_Result {

	public function execute() {
		return json_encode(self::$_result);
	}
}