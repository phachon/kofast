<?php
/**
 * 生产环境异常日志配置
 */
return array
(
	'custom' => array
	(
		'type'       => 'PDO',
		'connection' => array(
			'dsn' => 'mysql:host=g1mysmv1.video.pro.gomeplus.com;port=3306;dbname=video_approved;charset=utf8',
			'username'   => 'video_user',
			'password'   => 'FcU5mrdt',
			'persistent' => FALSE,
		),
		'charset'      => 'utf8',
		'table'        => 'approve_log_crash'
	),
); 