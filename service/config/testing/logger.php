<?php
/**
 * 测试环境日志配置
 * @author panchao
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
			'message' => '',
			'ip' => Request::$client_ip,
			'referer' => Request::current()->referrer() ? Request::current()->referrer() : '',
			'user_agent' => Request::$user_agent,
			'account_id' => '',
			'account_name' => '',
			'create_time' => time(),
		),
	),
);
