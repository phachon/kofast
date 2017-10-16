<?php
/**
 * ueditor 配置
 */
return array (

	/* 默认 */
	'default' => array (
		'state' => 'ok',
	),

	/* config配置 */
	'config' => array (
		/*图片配置*/
		'imageFieldName'=> 'upfile',
		'imageActionName'=> 'uploadimage',
		'imageAllowFiles'=> array ('.png', '.jpg', '.jpeg', '.gif', '.bmp'),
		'imageCompressEnable'=> true,
		'imageCompressBorder'=> 1600,
		'imageInsertAlign'=> 'none',
		'imageUrlPrefix'=> '',
		 /* 涂鸦图片上传配置项 */
	    'scrawlActionName' => 'uploadscrawl', /* 执行上传涂鸦的action名称 */
	    'scrawlFieldName' => 'upfile', /* 提交的图片表单名称 */
	    'scrawlUrlPrefix' => '', /* 图片访问路径前缀 */
	    'scrawlInsertAlign' => 'none',
	    /* 截图工具上传 */
	    'snapscreenActionName' => 'uploadimage', /* 执行上传截图的action名称 */
	    'snapscreenUrlPrefix' => '', /* 图片访问路径前缀 */
	    'snapscreenInsertAlign' => 'none', /* 插入的图片浮动方式 */

	    /* 抓取远程图片配置 */
	    'catcherLocalDomain' => array ('127.0.0.1', 'localhost', 'img.baidu.com'),
	    'catcherActionName' => 'catchimage', /* 执行抓取远程图片的action名称 */
	    'catcherFieldName' => 'source', /* 提交的图片列表表单名称 */
	    'catcherUrlPrefix' => '', /* 图片访问路径前缀 */
	    'catcherAllowFiles' => array ('.png', '.jpg', '.jpeg', '.gif', '.bmp'), /* 抓取图片格式显示 */

	    /* 上传视频配置 */
	    'videoActionName' => 'uploadvideo', /* 执行上传视频的action名称 */
	    'videoFieldName' => 'upfile', /* 提交的视频表单名称 */
	    'videoUrlPrefix' => '', /* 视频访问路径前缀 */
	    'videoAllowFiles' => array (
	        '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
	        '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid'
	    ), /* 上传视频格式显示 */

	    /* 上传文件配置 */
	    'fileActionName' => 'uploadfile', /* controller里,执行上传视频的action名称 */
	    'fileFieldName' => 'upfile', /* 提交的文件表单名称 */
	    'fileUrlPrefix' => '', /* 文件访问路径前缀 */
	    'fileAllowFiles' => array (
	        '.png', '.jpg', '.jpeg', '.gif', '.bmp',
	        '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
	        '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid',
	        '.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso',
	        '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml'
	    ), /* 上传文件格式显示 */

	    /* 列出指定目录下的图片 */
	    'imageManagerActionName' => 'listimage', /* 执行图片管理的action名称 */
	    'imageManagerListPath' => '/ueditor/php/upload/image/', /* 指定要列出图片的目录 */
	    'imageManagerListSize' => 20, /* 每次列出文件数量 */
	    'imageManagerUrlPrefix' => '', /* 图片访问路径前缀 */
	    'imageManagerInsertAlign' => 'none', /* 插入的图片浮动方式 */
	    'imageManagerAllowFiles' => array ('.png', '.jpg', '.jpeg', '.gif', '.bmp'), /* 列出的文件类型 */

	    /* 列出指定目录下的文件 */
	    'fileManagerActionName' => 'listfile', /* 执行文件管理的action名称 */
	    'fileManagerListPath' => '/ueditor/php/upload/file/', /* 指定要列出文件的目录 */
	    'fileManagerUrlPrefix' => '', /* 文件访问路径前缀 */
	    'fileManagerListSize' => 20, /* 每次列出文件数量 */
	    'fileManagerAllowFiles' => array (
	        '.png', '.jpg', '.jpeg', '.gif', '.bmp',
	        '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
	        '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid',
	        '.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso',
	        '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml'
	    )/* 列出的文件类型 */
	),

	/* 上传图片配置项 */
	'uploadimage' => array (
		'handle' => 'upload',
		'type' => 'common',
		'fieldName' => 'upfile',
		'maxSize' => 2048000,
		'allowFiles' => array ('.png', '.jpg', '.jpeg', '.gif', '.bmp'),
		'pathFormat' => '/upload/ueditor/image/{yyyy}{mm}{dd}/{time}{rand:6}',
	),

	/* 涂鸦图片上传配置项 */
	'uploadscrawl' => array (
		'handle' => 'upload',
		'type' => 'base64',
		'fieldName' => 'upfile',
		'maxSize' => 2048000,
		'oriName' => 'scrawl.png',
		'pathFormat' => '/upload/ueditor/scrawl/{yyyy}{mm}{dd}/{time}{rand:6}',
	),

	/* 截图工具上传 */
	'uploadsnapscreen' => array (
		'handle' => 'upload',
		'type' => 'common',
		'actionName' => 'uploadimage',
		'insertAlign' => 'none',
		'urlPrefix' => '',
		'pathFormat' => '/upload/ueditor/image/{yyyy}{mm}{dd}/{time}{rand:6}',
	),

	/* 抓取远程图片配置 */
	'catchimage' => array (
		'handle' => 'upload',
		'type' => 'remote',
		'fieldName' => 'source',
		'actionName' => 'catchimage',
		'maxSize' => 2048000,
		'allowFiles' => array ('.png', '.jpg', '.jpeg', '.gif', '.bmp'),
		'urlPrefix' => '',
		'localDomain' => array ('127.0.0.1', 'localhost', 'img.baidu.com'),
		'pathFormat' => '/upload/ueditor/image/{yyyy}{mm}{dd}/{time}{rand:6}',
	),

	/* 上传视频配置 */
	'uploadvideo' => array (
		'handle' => 'upload',
		'type' => 'common',
		'fieldName' => 'upfile',
		'maxSize' => 102400000,
		'allowFiles' => array (
			'.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
			'.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid'
		),
		'pathFormat' => '/upload/ueditor/video/{yyyy}{mm}{dd}/{time}{rand:6}',
	),

	/* 上传文件配置 */
	'uploadfile' => array (
		'handle' => 'upload',
		'type' => 'common',
		'fieldName' => 'upfile',
		'maxSize' => 51200000,
		'allowFiles' => array (
			'.png', '.jpg', '.jpeg', '.gif', '.bmp',
			'.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
			'.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid',
			'.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso',
			'.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml'
		),
		'pathFormat' => '/upload/ueditor/file/{yyyy}{mm}{dd}/{time}{rand:6}',
	),

	/* 列出指定目录下的图片 */
	'listimage' => array (
		'handle' => 'list',
		'type' => 'image',
		'actionName' => 'listimage',
		'listPath' => '/upload/ueditor/image/',
		'listSize' => 20,
		'urlPrefix' => '',
		'insertAlign' => 'none',
		'allowFiles' => array ('.png', '.jpg', '.jpeg', '.gif', '.bmp'),
	),

	/* 列出指定目录下的文件 */
	'listfile' => array (
		'handle' => 'list',
		'type' => 'file',
		'actionName' => 'listfile',
		'listPath' => '/upload/ueditor/file/',
		'urlPrefix' => '',
		'listSize' => 20,
		'allowFiles' => array (
			'.png', '.jpg', '.jpeg', '.gif', '.bmp',
			'.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
			'.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid',
			'.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso',
			'.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml'
		),
	),

);