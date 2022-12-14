<?php
ob_start();
$GLOBALS['external'] = '../../../../';
require $GLOBALS['external'].'index.php';
ob_end_clean();
if (!isset($_SESSION["ELFINDER"])) {
    exit('Please login system first.');
}

error_reporting(0); // Set E_ALL for debuging

// load composer autoload before load elFinder autoload If you need composer
//require './vendor/autoload.php';

// elFinder autoload
require './autoload.php';
// ===============================================

// Enable FTP connector netmount
// elFinder::$netDrivers['ftp'] = 'FTP';
// ===============================================

// // Required for Dropbox network mount
// // Installation by composer
// // `composer require kunalvarma05/dropbox-php-sdk`
// // Enable network mount
// elFinder::$netDrivers['dropbox2'] = 'Dropbox2';
// // Dropbox2 Netmount driver need next two settings. You can get at https://www.dropbox.com/developers/apps
// // AND reuire regist redirect url to "YOUR_CONNECTOR_URL?cmd=netmount&protocol=dropbox2&host=1"
// define('ELFINDER_DROPBOX_APPKEY',    '');
// define('ELFINDER_DROPBOX_APPSECRET', '');
// ===============================================

// // Required for Google Drive network mount
// // Installation by composer
// // `composer require google/apiclient:^2.0`
// // Enable network mount
// elFinder::$netDrivers['googledrive'] = 'GoogleDrive';
// // GoogleDrive Netmount driver need next two settings. You can get at https://console.developers.google.com
// // AND reuire regist redirect url to "YOUR_CONNECTOR_URL?cmd=netmount&protocol=googledrive&host=1"
// define('ELFINDER_GOOGLEDRIVE_CLIENTID',     '');
// define('ELFINDER_GOOGLEDRIVE_CLIENTSECRET', '');
// // Required case of without composer
// define('ELFINDER_GOOGLEDRIVE_GOOGLEAPICLIENT', '/path/to/google-api-php-client/vendor/autoload.php');
// ===============================================

// // Required for Google Drive network mount with Flysystem
// // Installation by composer
// // `composer require nao-pon/flysystem-google-drive:~1.1 nao-pon/elfinder-flysystem-driver-ext`
// // Enable network mount
// elFinder::$netDrivers['googledrive'] = 'FlysystemGoogleDriveNetmount';
// // GoogleDrive Netmount driver need next two settings. You can get at https://console.developers.google.com
// // AND reuire regist redirect url to "YOUR_CONNECTOR_URL?cmd=netmount&protocol=googledrive&host=1"
// define('ELFINDER_GOOGLEDRIVE_CLIENTID',     '');
// define('ELFINDER_GOOGLEDRIVE_CLIENTSECRET', '');
// ===============================================

// // Required for One Drive network mount
// //  * cURL PHP extension required
// //  * HTTP server PATH_INFO supports required
// // Enable network mount
// elFinder::$netDrivers['onedrive'] = 'OneDrive';
// // GoogleDrive Netmount driver need next two settings. You can get at https://dev.onedrive.com
// // AND reuire regist redirect url to "YOUR_CONNECTOR_URL/netmount/onedrive/1"
// define('ELFINDER_ONEDRIVE_CLIENTID',     '');
// define('ELFINDER_ONEDRIVE_CLIENTSECRET', '');
// ===============================================

// // Required for Box network mount
// //  * cURL PHP extension required
// // Enable network mount
// elFinder::$netDrivers['box'] = 'Box';
// // Box Netmount driver need next two settings. You can get at https://developer.box.com
// // AND reuire regist redirect url to "YOUR_CONNECTOR_URL"
// define('ELFINDER_BOX_CLIENTID',     '');
// define('ELFINDER_BOX_CLIENTSECRET', '');
// ===============================================


// // Zoho Office Editor APIKey
// // https://www.zoho.com/docs/help/office-apis.html
// define('ELFINDER_ZOHO_OFFICE_APIKEY', '');
// ===============================================

/**
 * Simple function to demonstrate how to control file access using "accessControl" callback.
 * This method will disable accessing files/folders starting from '.' (dot)
 *
 * @param  string $attr attribute name (read|write|locked|hidden)
 * @param  string $path absolute file path
 * @param  string $data value of volume option `accessControlData`
 * @param  object $volume elFinder volume driver object
 * @param  bool|null $isDir path is directory (true: directory, false: file, null: unknown)
 * @param  string $relpath file path relative to volume root directory started with directory separator
 *
 * @return bool|null
 **/
function access($attr, $path, $data, $volume, $isDir, $relpath)
{
    $basename = basename($path);
    return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
    && strlen($relpath) !== 1           // but with out volume root
        ? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
        : NULL;                                 // else elFinder decide it itself
}

function validName($name)
{
    //return strpos($name, '.') !== 0;
    $filname_without_ext = pathinfo($name, PATHINFO_FILENAME);
    return (preg_match('/^[A-z0-9-_() ]+$/', $filname_without_ext));
}

// Documentation for connector options:
// https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options

$opts = array(
    // 'debug' => true,
    'roots' => array(
        // Items volume
        array(
            'driver' => 'LocalFileSystem',           // driver for accessing file system (REQUIRED)
            'path' => '../../../files/',                 // path to files (REQUIRED)
            'URL' => dirname($_SERVER['PHP_SELF']) . '/../../../files/', // URL to files (REQUIRED)
            'trashHash' => 't1_Lw',                     // elFinder's hash of trash folder
            'winHashFix' => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
            'uploadDeny' => array('all'),                // All Mimetypes not allowed to upload
            'uploadAllow' => array('image', 'application/pdf', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/msword', 'application/vnd.ms-powerpoint', 'text/csv'),// Added pdf/xls/doc/ppt
            // 'uploadAllow'   => array('image','application/pdf'),// Mimetype `image` and `text/plain` allowed to upload
            //uploadAllow' => array('image/png', 'application/x-shockwave-flash') # allow png and flash
            'uploadOrder' => array('deny', 'allow'),      // allowed Mimetype `image` and `text/plain` only
            'accessControl' => 'access',                     // disable and hide dot starting files (OPTIONAL)
            'acceptedName' => 'validName',
        ),
        // Trash volume
        //no need trash
        array(
            'id' => '1',
            'driver' => 'Trash',
            'path' => '../files/.trash/',
            'tmbURL' => dirname($_SERVER['PHP_SELF']) . '/../files/.trash/.tmb/',
            'winHashFix' => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
            'uploadDeny' => array('all'),                // Recomend the same settings as the original volume that uses the trash
            'uploadAllow' => array('image'),// Same as above
            //uploadAllow' => array('image/png', 'application/x-shockwave-flash') # allow png and flash
            'uploadOrder' => array('deny', 'allow'),      // Same as above
            'accessControl' => 'access',                    // Same as above
            'acceptedName' => 'validName',
        )
    )
);

// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();

