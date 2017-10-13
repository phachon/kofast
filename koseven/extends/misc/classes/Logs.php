<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 记录后台日志
 * @author phachon@163.com
 */
class Logs {

	protected static $_instance = NULL;

	public static function instance() {

		if(self::$_instance == NULL) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {

	}

	/**
	 * 写入日志
	 * @param  string $message
	 */
	public function write($message) {

		$accountId = Author::instance()->getAccountId();
		$name = Author::instance()->getName();

		$data = array (
			'message' => $message,
			'account_id' => $accountId,
			'account_name' => $name,
		);
		
		try {
			Logger::factory('log')->write($data)->execute();
		} catch (Exception $e) {
			echo $e->getMessage();exit();
		}
		
	}

	/**
	 * 添加日志
	 * @param $message
	 * @param $accountId
	 * @param $name
	 * @throws Kohana_Exception
	 */
	public function add($message, $accountId, $name) {
		$data = array (
			'message' => $message,
			'account_id' => $accountId,
			'account_name' => $name,
		);

		try {
			Logger::factory('log')->write($data)->execute();
		} catch (Exception $e) {
			throw new Kohana_Exception($e->getMessage());
		}
	}
}