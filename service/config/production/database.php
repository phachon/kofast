<?php
/**
 * 生产环境数据库配置
 */
return array
(
	'default' => array
	(
		'type'       => 'PDO',
		'connection' => array(
			'dsn'        => 'mysql:host=127.0.0.1;port=3306;dbname=test;charset=utf8',
			'username'   => 'root',
			'password'   => '123456',
			'persistent' => FALSE,
		),
		'table_prefix' => 'test_',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),
);