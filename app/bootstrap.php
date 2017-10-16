<?php

// -- Environment setup --------------------------------------------------------
session_start();
// Load the core Kohana class
require SYSPATH.'classes/Kohana/Core'.EXT;

if (is_file(APPPATH.'classes/Kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/Kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/Kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
//date_default_timezone_set('America/Chicago');
//update by phachon@163.com
date_default_timezone_set('Asia/Shanghai');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
//setlocale(LC_ALL, 'en_US.utf-8');
//update by phachon@163.com
setlocale(LC_ALL, 'zh_CN.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

/**
 * Enable composer autoload libraries
 */
// require DOCROOT . '/vendor/autoload.php';

/**
 * Set the mb_substitute_character to "none"
 *
 * @link http://www.php.net/manual/function.mb-substitute-character.php
 */
mb_substitute_character('none');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
//I18n::lang('en-us');
//update by phachon@163.com
I18n::lang('utf-8');

if (isset($_SERVER['SERVER_PROTOCOL']))
{
	// Replace the default protocol.
	HTTP::$protocol = $_SERVER['SERVER_PROTOCOL'];
}

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
/**
 * 设置运行环境，可以为 PRODUCTION、STAGING、TESTING、DEVELOPMENT中的任一个，默认为DEVELOPMENT
 * update by phachon@163.com
 */
if(!isset($_SERVER['ENVIRONMENT'])) {

	$_SERVER['ENVIRONMENT'] = 'development';
}
Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['ENVIRONMENT']));

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php", if set to FALSE uses clean URLS     index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(array(
	'base_url'   => MODULEDIR,
	'cache_dir'  => CACHEDIR,
	'index_file' => FALSE,//去除index.php
	'errors'     => TRUE,
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 * update by phachon@163.com
 */
if(Kohana::$environment === Kohana::DEVELOPMENT) {
	Kohana::$log->attach(new Log_File(LOGDIR));
}else {
	Kohana::$log->attach(new Log_File('/var/log/app'));
}


/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File());

/**
 * Attach a file reader to config by ENVIRONMENT
 */
Kohana::$config->attach(new Config_File('config/' . strtolower($_SERVER['ENVIRONMENT'])));
Kohana::$config->attach(new Config_File('../config/' . strtolower($_SERVER['ENVIRONMENT'])));
/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	// 'encrypt'    => MODPATH.'encrypt',    // Encryption supprt
	// 'auth'       => MODPATH.'auth',       // Basic authentication
	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	 'database'   => MODPATH.'database',   // Database access
	 'image'      => MODPATH.'image',      // Image manipulation
	// 'minion'     => MODPATH.'minion',     // CLI Tasks
	// 'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'pagination' => MODPATH.'pagination', // Pagination
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	 'service'  => SERPATH,
	 'dao'      => EXTPATH.'dao',
	 'logger'   => EXTPATH.'logger',
	 'captchas' => EXTPATH.'captchas',
	 'misc'     => EXTPATH.'misc',
	));

/**
 * Cookie Salt
 * @see  http://kohanaframework.org/3.3/guide/kohana/cookies
 * 
 * If you have not defined a cookie salt in your Cookie class then
 * uncomment the line below and define a preferrably long salt.
 */
 Cookie::$salt = 'adsasdas';

/**
 * Cookie HttpOnly directive
 * If set to true, disallows cookies to be accessed from JavaScript
 * @see https://en.wikipedia.org/wiki/Session_hijacking
 */
// Cookie::$httponly = TRUE;
/**
 * If website runs on secure protocol HTTPS, allows cookies only to be transmitted
 * via HTTPS.
 * Warning: HSTS must also be enabled in .htaccess, otherwise first request
 * to http://www.example.com will still reveal this cookie
 */
// Cookie::$secure = isset($_SERVER['HTTPS']) AND $_SERVER['HTTPS'] == 'on' ? TRUE : FALSE;

/**
 * session
 * database | redis | memcache | mongodb | native
 * add by phachon@163.com
 */
Session::$default = 'database';

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => $defaultController,
		'action'     => $defaultAction,
	));
