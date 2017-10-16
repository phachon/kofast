<?php
/** 
 * UEditor 返回array
 * @author phachon@163.com
 */
class UEditor_Result_Array extends UEditor_Result {

	public function execute() {
		return self::$_result;
	}
}