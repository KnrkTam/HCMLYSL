<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', true);

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
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/****** Self Define ******/

define("VERSION", '2.1.3');

if (ENVIRONMENT == 'production') {
    define("PRODUCTION", 1);
    error_reporting(0);
    ini_set('display_errors', 0);
    define("SEND_EMAIL", 1);
//define("PAYPAL_MODE", "sandbox"); //sandbox / live //disabled
    define("FILE_VERSION", '20180101');
    define("DEBUG", 0);
}else{
    define("PRODUCTION", 0);
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    ini_set('display_errors', 1);
    define("SEND_EMAIL", 1);
//    define("PAYPAL_MODE", "sandbox"); //sandbox / live //disabled
    define("FILE_VERSION", time());
    define("DEBUG", 0);
}

//set server timezone
date_default_timezone_set("Asia/Hong_Kong");

//debug mode will affect some js and make website broken
//define("FILE_VERSION", '20171108_7');
//dev

define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]);
//for public
define("SENDGRID_API_KEY", '');
define("SENDGRID_CODE", '');
define("SENDGRID_DEBUG", 1);
define("ENABLE_EMAIL_BCC_LOG", 1);
define("EMAIL_BCC_LOG_ADDR", 'kelvinchan@onesolution.com.hk');
define("TEST_EMAIL", 0);
define("TEST_EMAIL_ADDR", 'kelvinchan@onesolution.com.hk');
define("LARAVEL_QUERY_LOG", 1); //remember to add laravel_query_log(); in system/helpers/url_helper.php -> redirect function, put in the head
define("LARAVEL_QUERY_LOG_TYPE", 'IGNORE_SELECT'); //ALL / IGNORE_SELECT
define("PROJECT_KEY", 'LqnuNuvg*_PgZz2-');

//extension define
$GLOBALS["tinymce"] = 0;
$GLOBALS["datetimepicker"] = 0;
$GLOBALS["fancybox"] = 0;
$GLOBALS["datatable"] = 0;
$GLOBALS["select2"] = 0;
$GLOBALS["elfinder"] = 0;
$GLOBALS["ionslider"] = 0;
/****** END: Self Define ******/