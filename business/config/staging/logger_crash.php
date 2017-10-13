<?php
/**
 * 预生产异常日志配置
 */
return array
(
	'custom' => array
	(
		'type'       => 'PDO',
		'connection' => array(
			'dsn'        => 'mysql:host=bj01-ops-mysv02.pre.gomeplus.com;port=3306;dbname=video_approved;charset=utf8',
			'username'   => 'video_u',
			'password'   => 'ZywbfGU1',
			'persistent' => FALSE,
		),
		'charset'      => 'utf8',
		'table'        => 'approve_log_crash'
	),
); 