<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Custon define variable
| Define by sujit shah @ July 10 2012
|--------------------------------------------------------------------------
*/
define('ASSETS_PATH',									'assets/');

define('ADMIN_CSS_DIR_FULL_PATH',						ASSETS_PATH.'admin_css/');
define('ADMIN_IMG_DIR_FULL_PATH',						ASSETS_PATH.'admin_images/');
define('ADMIN_JS_DIR_FULL_PATH',						ASSETS_PATH.'js/admin/');

define('UPLOAD_BASE_PATH',					'upload_files/');

define('MAIN_CSS_DIR_FULL_PATH',						ASSETS_PATH.'css/');
define('MAIN_IMG_DIR_FULL_PATH',						ASSETS_PATH.'images/');
define('MAIN_JS_DIR_FULL_PATH',							ASSETS_PATH.'js/');

define('USER_DASHBOARD_PATH',					'my-account/user');


//admin login session
define('ADMIN_LOGIN_ID',							'admin_user_id');
define('ADMIN_PROFILE_DEFAULT_IMG',ADMIN_IMG_DIR_FULL_PATH.'admin_default_image.png');

//admin & dashboard path
define('ADMIN_LOGIN_PATH',					'admin/index');
define('ADMIN_DASHBOARD_PATH',					'dashboard');

//upload file location
define('PAYMENT_API_LOGO_PATH',					'upload_files/payment/');
define('CMS_IMG_PATH',							'upload_files/cmsimg/');
define('BLOG_IMG_PATH',							'upload_files/blog/');


define('SESSION','BID2UEMTSNP');

define('MY_ACCOUNT','my-account');

define('ADMIN_RECORDS_PER_PAGINATION',20);

//Captcha
define('ASSETS_DIR', 'assets/');
define('CAPTCHA_PATH','upload_files/captcha/');
define('CAPTCHA_FONTS',ASSETS_DIR.'captcha_fonts/');


/* End of file constants.php */
/* Location: ./application/config/constants.php */