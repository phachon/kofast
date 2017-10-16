<?php
/**
 * 开发环境日志配置
 */
return array(
	/**
	 * 行为日志（数据库）
	 */
	'behave_log' => array(
		'type' => 'database',
		'parameters' => array (
			'group' 	 => 'approve',
			'table'      => 'log',
			'slice'		 => '',
		),
		'columns' => array(
			'controller' => strtolower(Request::current()->controller()),
			'portal' => PORTAL,
			'action' => strtolower(Request::current()->action()),
			'`get`' => json_encode($_GET),
			'post' => json_encode($_POST),
			'message' => '',
			'ip' => Misc::getClientIp(),
			'referer' => Request::current()->referrer() ? Request::current()->referrer() : '',
			'user_agent' => Request::$user_agent,
			'account_id' => '',
			'account_name' => '',
			'create_time' => time(),
		),
	),
);
