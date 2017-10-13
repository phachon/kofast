<?php
/** 
 * UEditor 编辑器封装
 * @author phachon@163.com
 */
class UEditor {

	protected $_action = '';

	protected static $_instance = NULL;

	protected $_returnType = 'json';

	/**
	 * instance
	 * @return object
	 */
	public static function instance() {
		if(self::$_instance === NULL) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * action
	 * @param  string $action
	 * @return object
	 */
	public function action($action) {
		$this->_action = $action;
		return $this;
	}

	/**
	 * return array
	 */
	public function getArray() {
		$this->_returnType = 'array';
		return $this->_execute();
	}

	/**
	 * return array
	 */
	public function getJson() {
		$this->_returnType = 'json';
		return $this->_execute();
	}

	/**
	 * execute
	 * @return array
	 */
	protected function _execute() {

		$config = Kohana::$config->load('ueditor.' . $this->_action)->as_array();
		$handle = Arr::get($config, 'handle', '');
		$type = Arr::get($config, 'type', '');

		if($this->_action == 'default') {
			return Ueditor_Result::factory($this->_returnType, $config)->execute();
		}
		if($this->_action == 'config') {
			return Ueditor_Result::factory($this->_returnType, $config)->execute();
		}
		if($handle == 'upload') {
			return Ueditor_Upload::factory($type)->config($config)->returnType($this->_returnType)->execute();
		}
		if($handle == 'list') {
			return Ueditor_List::factory($type)->config($config)->returnType($this->_returnType)->execute();
		}
	}
}