<?php
/**
 * 测试环境异常日志配置
 */
return array
(
	'custom' => array
	(
		'type'       => 'PDO',
		'connection' => array(
			'dsn'        => 'mysql:host=bj05-ops-mys03.dev.gomeplus.com;port=3306;dbname=video_approve;charset=utf8',
			'username'   => 'tester',
			'password'   => 'Test_usEr',
			'persistent' => FALSE,
		),
		'charset'      => 'utf8',
		'table'        => 'approve_log_crash'
	),
); 