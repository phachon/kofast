<?php
/**
 * 测试环境 session 配置
 */
return array(
	'database' => array(
		/**
		 * Database settings for session storage.
		 *
		 * string   group  configuation group name
		 * string   table  session table name
		 * integer  gc     number of requests before gc is invoked
		 * columns  array  custom column names
		 */
		'group'   => 'approve',
		'table'   => 'session',
		'gc'      => 3,
		'lifetime' => 1800,//15分钟
		'columns' => array(
			/**
			 * session_id:  session identifier
			 * last_active: timestamp of the last activity
			 * contents:    serialized session data
			 */
			'session_id'  => 'session_id',
			'last_active' => 'last_active',
			'contents'    => 'contents'
		),
	),
);
