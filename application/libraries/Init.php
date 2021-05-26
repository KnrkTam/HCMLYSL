<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Gettext\Translator;

class Init
{

    public function __construct()
    {
        //self define

        //default use www
        /*if (strpos($_SERVER['HTTP_HOST'], 'www') === false) {
            $protocol = isset($_SERVER['HTTPS']) && filter_var($_SERVER['HTTPS'], FILTER_VALIDATE_BOOLEAN)
                ? 'https'
                : 'http';

            header("Location: $protocol://www." . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            exit;
        }*/

        //$CI =& get_instance();
        //should ignore in member auth action
        /*if (!empty($_SESSION['member_id']) && strpos($_SERVER['REQUEST_URI'], '/member/auth/') === false) {
            $CI->load->model('Member_model');
            $member_info = $CI->Member_model->select($_SESSION['member_id'], null, 1);

            if ($member_info['login_session'] != session_id()) {
                unset($_SESSION['member_id']);
                $_SESSION['error_msg'] = '本帳戶已在其他地方登入。';
                redirect('member/logout/' . $member_info['id']);
            }
        }*/


        //TODO:: for testing only
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->set_lang();
        $this->sanitize_data();
    }

    private function sanitize_data()
    {
        if(!empty($_GET)){
            $json_encode = json_encode($_GET);
            $sanitize_data = str_replace(array('<script>', '<\/script>'), '', json_encode($_GET));
            $_GET = json_decode($json_encode, true);
        }

        if(!empty($_POST)){
            $sanitize_data = str_replace(array('<script>', '<\/script>'), '', json_encode($_POST));
            $_POST = json_decode($sanitize_data, true);
        }
    }

    private function set_lang()
    {

        $CI =& get_instance();

        $enable_frontend = config_item('frontend_multiple_language');
        $default_frontend_lang = config_item('frontend_default_language');
        $frontend_lang_list = config_item('frontend_lang_list');
        $enable_backend = config_item('backend_multiple_language');
        $default_backend_lang = config_item('backend_default_language');
        $backend_lang_list = config_item('backend_lang_list');

        /* get the language abbreviation from uri */
        $lang_uri = $CI->uri->segment(1);
        $lang_uri = strtolower(trim($lang_uri));

        $lang = $default_frontend_lang;
        $wlang = $default_backend_lang;
        $locale = $frontend_lang_list[$default_frontend_lang];
        $wlocale = $backend_lang_list[$default_backend_lang];

        //Create the translator instance
        $t = new Translator();

        if ($enable_frontend) {
            if (!empty($lang_uri) && strlen($lang_uri) == 2 &&
                is_array($frontend_lang_list) && array_key_exists($lang_uri, $frontend_lang_list)) {
                $lang = $lang_uri;
                if (!empty($frontend_lang_list[$lang_uri])) {
                    $locale = $frontend_lang_list[$lang_uri];
                    $this->load_translation($t, $locale);
                }
                $CI->config->set_item('language', $lang);
            }
        }

        if ($enable_backend && $lang_uri == 'webadmin') {
            $lang_uri2 = $CI->uri->segment(2);
            if (!empty($lang_uri2) && strlen($lang_uri2) == 2
                && is_array($backend_lang_list) && array_key_exists($lang_uri2, $backend_lang_list)) {
                $wlang = $lang_uri2;
                if (!empty($backend_lang_list[$lang_uri2])) {
                    $wlocale = $backend_lang_list[$lang_uri2];
                    $this->load_translation($t, $wlocale);
                }

                $CI->config->set_item('language', $wlang);
            }
        }

        $t->register();

        $_SESSION['lang'] = $lang;
        $_SESSION['wlang'] = $wlang;
        $_SESSION['locale'] = $locale;
        $_SESSION['wlocale'] = $wlocale;
    }


    private function load_translation($t, $locale = '')
    {

        if ($locale <> '') {
            //Load your translations (exported as PhpArray):
            $translate_file = APPPATH . 'locale/' . $locale . '/' . $locale . '.php';
            $po_file = APPPATH . 'locale/' . $locale . '/' . $locale . '.po';
            if (file_exists($translate_file)) {
                if (file_exists($po_file) && date("Y-m-d H:i:s", filemtime($po_file)) > date("Y-m-d H:i:s", filemtime($translate_file))) {
                    //po file updated, need to regenerate php file
                    $translations = Gettext\Translations::fromPoFile($po_file);
                    $translations->toPhpArrayFile($translate_file);
                }

                $t->loadTranslations($translate_file);
            } elseif (file_exists($po_file)) {
                //po to php and load file
                $translations = Gettext\Translations::fromPoFile($po_file);
                $translations->toPhpArrayFile($translate_file);
                if (file_exists($translate_file)) {
                    $t->loadTranslations($translate_file);
                }
            }
        }
    }
}

