<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//route example: http://domain.tld/en/controller => http://domain.tld/controller
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$uri = $this->uri->segment(1);

if ($uri == 'cron_job' || $uri == 'sync' || !empty($GLOBALS['external'])) {
    //skip route
}else {
    if ($uri == 'webadmin') {
        // Enabled Back-end multiple language
        if (config_item('backend_multiple_language')) {

            //redirect .com/webadmin > .com/webadmin/en
            $route['webadmin'] = function () {
                header('Location: ' . config_item('base_url') . 'webadmin/' . config_item('backend_default_language'));
                exit;
            };

            if (is_array(config_item('backend_lang_list'))) {
                foreach (config_item('backend_lang_list') as $lang => $locale) {
                    // eg: /webadmin/en , /webadmin/en/bk_admin/profile
                    $route['webadmin/(\w[' . $lang . '])'] = 'webadmin/bk_admin';
                    $route['webadmin/(\w[' . $lang . '])/(.*)'] = 'webadmin/$2';
                }
            }
        } else {
            $route['webadmin'] = "webadmin/bk_admin";
        }
    }else{

        // Enabled Font-end multiple language
        if (config_item('frontend_multiple_language')) {


            //redirect .com to .com/tc
            if(!array_key_exists($uri, config_item('frontend_lang_list'))){
                header('Location: ' . config_item('base_url') . config_item('frontend_default_language'));
                exit;
            }

            if (is_array(config_item('frontend_lang_list'))) {
                foreach (config_item('frontend_lang_list') as $lang => $locale) {
                    /*$route['(\w[' . $lang . '])/product/(.*)'] = 'product/index/0/$2';
                    $route['(\w[' . $lang . '])/category/(.*)/(.*)'] = 'category/index/0/$2/$3';
                    $route['(\w[' . $lang . '])/page/(.*)'] = 'page/index/$2';*/

                    // .com/en = default controller, .com/en/login = call login controller
                    $route['(\w[' . $lang . '])'] = $route['default_controller'];
                    $route['(\w[' . $lang . '])/(.*)'] = '$2';


                }
            }
        }

    }

}

// redirect .com/bk_admin to 404 for protect backend controller
//$route['bk_(.*)'] = function (){
//    show_404();
//};
