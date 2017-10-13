<?php
/** 
 * UEditor 返回类封装
 * @author phachon@163.com
 */
abstract class UEditor_Result {

	protected static $_result = array ();

	public static function factory($type, $result) {

		$type = strtolower($type);
		self::$_result = $result;
		if($type == 'json') {
			return new UEditor_Result_Json();
		}
		if($type == 'array') {
			return new UEditor_Result_Array();
		}
		if($type == 'xml') {
			return new UEditor_Result_Xml();
		}

		return new UEditor_Result_Json();
	}

	abstract public function execute();
}
