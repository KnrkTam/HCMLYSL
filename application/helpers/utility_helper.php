<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
//use Gettext\Translator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*** Common Function List ***/

// Ctwo ver.

function uCurl($url, $method, $params = array(), $header = array(), $type = "x-www-form-urlencoded", $username = null, $password = null)
{
   //activity_log('uCurl', array('url' => $url, 'method' => $method, 'params' => $params, 'header' => $header, 'type' => $type));
    $curl = curl_init();
    $timeout = 15;

    if($method == 'GET' && $type != null){
        $url = $url . '?' . http_build_query($params);
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);

    if($type == "x-www-form-urlencoded"){
        /*$header = array(
        );*/
    }else if($type == "xml"){
        $header = array(
            "Content-type: application/xml",
            "Content-length: " . strlen($params['xml']),
            "Connection: close",
        );
    }else{
        if (empty($header)) {
            $header = array('Content-Type: application/json; charset=UTF-8');
        }
    }

    //    activity_log('uCurl', array('url' => $url, 'method' => $method, 'params' => $params, 'header' => $header, 'type' => $type));

    if($header){
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    }

    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);

    if ($username && $password) {
        curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
    }

    switch ($method) {
        case 'GET' :
            curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
            break;
        case 'POST':
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');

            if($type == "x-www-form-urlencoded"){
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
            }else if($type == "xml"){
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params['xml']);
            }else if($type == "json"){
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params['json']);
            }else{
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            }
            break;
        case 'PUT' :
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            if($type == "xml"){
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params['xml']);
            }else if($type == "json"){
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params['json']);
            }else{
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            }
            break;
        case 'DELETE':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            //curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            break;
    }

    $data = curl_exec($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if (curl_error($curl)) {
        //echo 'error:' . curl_error($curl);
        // activity_log('utility_helper', __FUNCTION__, ['uCurl: error' => curl_error($curl)]);
    }

    curl_close($curl);

    if(ENVIRONMENT == 'production'){
        //   activity_log('utility_helper', __FUNCTION__, ['uCurl' => array('http_code' => $http_code, 'response' => 'hide')]);
    }else{
        //   activity_log('utility_helper', __FUNCTION__, ['uCurl' => array('http_code' => $http_code, 'response' => $data)]);
    }

    // if($type == "xml"){
        $res = $data;
    // }else{
        // $res = json_decode($data, TRUE);
    // }

   //return ['http_code' => $http_code, 'response' => $res];
   return $res;
}

   /////////   /////////   /////////   /////////   /////////   /////////   /////////   /////////   /////////   /////////   /////////   /////////

if (!function_exists('_curl')) {
    function _curl($url, $postData, $post, $username = null, $password = null)
    {
        if (!empty($post)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            if ($username && $password) {
                curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            $result = curl_exec($ch);

            if (curl_error($ch)) {
                echo 'error:' . curl_error($ch);
            }

            curl_close($ch);
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            if ($username && $password) {
                curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
            }
            $result = curl_exec($ch);

            if (curl_error($ch)) {
                echo 'error:' . curl_error($ch);
            }

            curl_close($ch);
        }

        return $result;
    }
}

if (!function_exists('change_lang')) {
    function change_lang($lang)
    {
        $CI =& get_instance();
        $uri_string = $CI->uri->uri_string();
        return str_replace('/' . get_lang(), '/' . $lang, base_url($uri_string));
    }
}


if (!function_exists('get_lang')) {
    function get_lang()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['lang'] ?: config_item('frontend_default_language');

    }
}


if (!function_exists('get_wlang')) {
    function get_wlang()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['wlang'] ?: config_item('backend_default_language');
    }
}


if (!function_exists('get_locale')) {
    function get_locale()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['locale'] ?: 'en';
    }
}

if (!function_exists('get_wlocale')) {
    function get_wlocale()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['wlocale'] ?: 'en';
    }
}


if (!function_exists('admin_url')) {
    function admin_url($url = null)
    {
        if (config_item('backend_multiple_language')) {
            return base_url('webadmin' . '/' . get_wlang() . '/' . $url);
        } else {
            return base_url('webadmin/' . $url);
        }
    }
}


if (!function_exists('front_url')) {
    function front_url($url = '')
    {
        if (config_item('frontend_multiple_language')) {
            return base_url(get_lang() . '/' . $url);
        } else {
            return base_url($url);
        }
    }
}

if (!function_exists('current_controller')) {
    function current_controller($path = null)
    {
        $CI =& get_instance();
        return $CI->router->fetch_class() . $path;
    }
}

if (!function_exists('current_method')) {
    function current_method($path = null)
    {
        $CI =& get_instance();
        return $CI->router->fetch_method() . $path;
    }
}

if (!function_exists('_h')) {
    function _h($data)
    {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('_dh')) {
    function _dh($data)
    {
        return htmlspecialchars_decode($data);
    }
}

if (!function_exists('_toArray')) {
    function _toArray($data, $redirect = null)
    {
        if (!empty($data)) {
            return $data = $data->toArray();
        } else {
            if (!empty($redirect)) {
                redirect($redirect);
            }
        }
    }
}

if (!function_exists('captcha_checking')) {
    function captcha_checking()
    {
        $CI =& get_instance();
        $captcha = $CI->session->userdata('captcha');
        return $captcha['word'] == $CI->input->post('captcha_code', 1);
    }
}

if (!function_exists('captcha_img')) {
    function captcha_img($id = '', $width = 150, $height = 30, $expiration = 3600, $word_length = 6, $font_size = 18)
    {
        $CI =& get_instance();
        $CI->load->helper('captcha');


        $img_path = FCPATH . 'assets/captcha/';
        //create directory if not exist
        if (!is_dir($img_path)) {
            mkdir($img_path, 0775, true);
        }
        $vals = array(
//            'word'          => '',
            'img_path' => $img_path,
            'img_url' => assets_url('captcha/'),
            'font_path' => BASEPATH . 'fonts/texb.ttf',
            'img_width' => $width,
            'img_height' => $height,
            'expiration' => $expiration,
            'word_length' => $word_length,
            'font_size' => $font_size,
            'img_id' => $id,
            'pool' => '123456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors' => array(
                'background' => array(rand(200, 255), rand(200, 255), rand(200, 255)),
                'border' => array(255, 255, 255),
                'text' => array(rand(0, 25), rand(0, 25), rand(0, 25)),
                'grid' => array(rand(0, 255), rand(0, 255), rand(0, 255))
            )
        );

        $cap = create_captcha($vals);
        if (!$cap) {
            return 'Failed create captcha';
        } else {
            $CI->session->set_userdata('captcha', $cap);
            return $cap['image'];
        }
    }
}

if (!function_exists('check_sys_user_login')) {
    function check_sys_user_login($permissions = null, $return = 0)
    {
        $CI =& get_instance();
        $uri = $CI->uri->segment(1);

        if ($uri <> "webadmin") {
            redirect(admin_url('bk_admin/access_denied'));
        }

        if (empty($_SESSION["sys_user_id"])) {
            redirect(admin_url());
        }

        if (!empty($permissions)) {
            validate_user_access($permissions, $return);
        }
    }
}

//for ajax
if (!function_exists('check_sys_user_login2')) {
    function check_sys_user_login2($permissions = null, $return = 0)
    {
        $CI =& get_instance();
        $uri = $CI->uri->segment(1);

        $response = ['success' => true, 'data' => [], 'message' => ''];
        if ($uri <> 'webadmin' || empty($_SESSION['sys_user_id'])) {
            $response = ['success' => false, 'data' => [], 'message' => __('Access Denied.')];
        }else{
            if (!empty($permissions)) {
                $response = ['success' => validate_user_access($permissions), 'data' => [], 'message' => __('Access Denied.')];
            }
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        if(!$response['success']){
            exit;
        }

    }
}

if (!function_exists('date_ago')) {
    function date_ago($datetime1, $datetime2)
    {
        //datetime 1 smaller than datetime 2
        $datetime1 = new DateTime($datetime1);

        $datetime2 = new DateTime($datetime2);

        $difference = $datetime1->diff($datetime2);

        $ago = "";

        if ($difference->y > 0) {
            $ago .= $difference->y . __("年");
        }

        if ($difference->m > 0) {
            $ago .= $difference->m . __("月");
        }

        if ($difference->d > 0) {
            $ago .= $difference->d . __("日");
        } else {
            if ($difference->h > 0) {
                $ago .= $difference->h . __("小時");
            }

            if ($difference->i > 0) {
                $ago .= $difference->i . __("分鐘");
            }
        }

        $ago .= __("前");

        return $ago;
    }
}

if (!function_exists('time2range')) {
    function time2range($start_time, $end_time, $format = 'H:i')
    {
        if (strtotime($start_time) <= strtotime($end_time)) {
            return date($format, strtotime($start_time)) . ' - ' . date($format, strtotime($end_time));
        } else {
            return 'ERROR';
        }
    }
}

if (!function_exists('debug_log')) {
    function debug_log($code, $_data)
    {
        $CI =& get_instance();
        $CI->load->model('Debug_log_model');

        $data = array(
            'code' => $code,
            'data' => json_encode($_data)
        );

        Debug_log_model::create($data);
    }
}

if (!function_exists('debugbar_log')) {
    function debugbar_log($data)
    {
        $_SESSION['debugbar_log'][] = json_encode($data);
    }
}

if (!function_exists('form_list_type')) {
    function form_list_type($key, $row, $form_name = null)
    {
        //full sample
        //$form_list['sample'] = array('type' => 'select', 'label' => __(''), 'attr' => '', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1, 'multiple' => 1);

        $CI =& get_instance();

        $id = str_replace('[]', '', $key);

        switch ($row["type"]) {

            case "display":
                echo '<div id="' . $id . '" class="' . $row['class'] . '" ' . $row["attr"] . ' style="padding-top: 7px;' . $row["style"] . '">' . $row["value"] . '</div>';

                break;

            case "text":
                $post_value = $CI->input->post($key);
                $value = isset($post_value) ? $post_value : $row["value"];

                echo '<input type="text" id="' . $id . '" name="' . $key . '" value="' . $value . '" placeholder="' . $row["label"] . '" class="form-control ' . $row["class"] . '" ' . $row["attr"] . ' style="' . $row["style"] . '">';

                if (!empty($row['help_txt'])) {
                    echo '<p class="help-block" style="color: red; margin: 5px 0; font-size: 12px;">' . $row['help_txt'] . '</p>';
                }
                break;

            case "radio":
                $post_value = $CI->input->post($key);
                $value = isset($post_value) ? $post_value : $row["value"];

                if (!empty($row["enable_value"])) {
                    foreach ($row["enable_value"] as $key2 => $row2) {
                        echo '<div style="display: inline-block;"><input type="radio" name="' . $key . '" id="' . $key2 . '" value="' . $key2 . '" ' . ($key2 == $value ? "checked" : "") . ' class="' . $row["class"] . '" ' . $row["attr"] . ' style="' . $row["style"] . '"><span style="padding: 0 10px;' . $row["style"] . '">' . $row2 . '</span></div>';
                    }
                }

                if (!empty($row['help_txt'])) {
                    echo '<p class="help-block" style="color: red; margin: 5px 0; font-size: 12px;">' . $row['help_txt'] . '</p>';
                }
                break;

            case "checkbox":
                $post_value = $CI->input->post($key);
                $value = isset($post_value) ? $post_value : $row["value"];

                if (!empty($row["enable_value"])) {
                    foreach ($row["enable_value"] as $key2 => $row2) {
                        $checked = '';

                        if (!empty($value)) {
                            /* if(!is_array($value)){
                           $value = explode('|', $value);
                       }*/
                            if(is_array($value)){
                                foreach ($value as $row3) {
                                    if ($row3 == $key2) {
                                        $checked = 'checked';
                                    }
                                }
                            }else{
                                if ($value == $key2) {
                                    $checked = 'checked';
                                }
                            }
                        }

                        echo '<div style="display: inline-block;"><input type="checkbox" name="' . $key . '" id="' . $key2 . '" value="' . $key2 . '" ' . $checked . ' class="' . $row["class"] . '" ' . $row["attr"] . ' style="' . $row["style"] . '"><span style="padding: 0 10px;' . $row["style"] . '">' . $row2 . '</span></div>';
                    }
                }

                if (!empty($row['help_txt'])) {
                    echo '<p class="help-block" style="color: red; margin: 5px 0; font-size: 12px;">' . $row['help_txt'] . '</p>';
                }
                break;

            case "select":
                $post_value = $CI->input->post($key);
                $value = isset($post_value) ? $post_value : $row["value"];

                echo '<select id="' . $id . '" name="' . $key . '" data-placeholder="' . $row["data-placeholder"] . '" placeholder="' . $row["name"] . '" class="form-control ' . $row["class"] . '" ' . $row["attr"] . ' style="' . $row["style"] .'" '. ($row['multiple'] == 1 ? ' multiple' : '') .' '. ($row['disabled'] == 1 ? ' disabled' : '').  '>';

                if (!isset($row['disable_please_select'])) {
                    if (isset($row['please_select_label'])) {
                        echo '<option value="" >' . ($row['please_select_label']) . '</option>';
                    } else {
                        echo '<option value="" >' . _("請選擇") . '</option>';
                    }
                }

                if (!empty($row["enable_value"])) {
                    foreach ($row["enable_value"] as $key2 => $row2) {
                        if ($row['multiple'] == 1) {
                            if (!empty($row['value'])) {
                                $selected = (in_array($key2, $row['value']) == true ? "selected" : "");
                            } else {
                                $selected = "";
                            }
                        } else {
                            $selected = ($key2 == $value ? "selected" : "");
                        }

                        if (is_array($row2)) {
                            echo '<option value="' . $key2 . '" ' . $selected . ' ' . $row2['attr'] . '>' . $row2['label'] . '</option>';
                        } else {
                            echo '<option value="' . $key2 . '" ' . $selected . ' >' . $row2 . '</option>';
                        }
                    }
                }

                echo '</select>';

                if (!empty($row['help_txt'])) {
                    echo '<p class="help-block" style="color: red; margin: 5px 0; font-size: 12px;">' . $row['help_txt'] . '</p>';
                }
                break;

            case "textarea":
                $post_value = $CI->input->post($key);
                $value = isset($post_value) ? $post_value : $row["value"];

                echo '<textarea id="' . $id . '" name="' . $key . '" placeholder="' . $row["name"] . '" class="form-control ' . $row["class"] . '" ' . $row["attr"] . ' style="' . $row["style"] . '" rows="5" >' . $value . '</textarea>';

                if (!empty($row['help_txt'])) {
                    echo '<p class="help-block" style="color: red; margin: 5px 0; font-size: 12px;">' . $row['help_txt'] . '</p>';
                }
                break;

            case "file":
                if (!empty($row["value"])) {
                    if($row['base64']){
                        if (preg_match("/jpg|jpeg|png|gif/i", $row["extension"])) {
                            echo '<div>' . base64_upload_decode($row['base64_path'] . $row['value'], $row['extension'], $row['ori_file_name'], 'height: 200px;') . '<br>' . $row['ori_file_name'] . '<br><input type="checkbox" name="del_' . $key . '" value="1" > ' . __('刪除') . '?<br><br></div>';
                        } else {
                            echo '<div>' . base64_upload_decode($row['base64_path'] . $row['value'], $row['extension'], $row['ori_file_name']) . '<input type="checkbox" name="del_' . $key . '" value="1" > ' . __('刪除') . '?<br><br></div>';
                        }
                    }else{
                        if (preg_match("/jpg|jpeg|png|gif/i", $row["value"])) {
                            echo '<div><img src="' .assets_url($row["value"]) . '" style="height: 200px;"/><br>' . $row['ori_file_name'] . '<br><input type="checkbox" name="del_' . $key . '" value="1" > ' . __('刪除') . '?<br><br></div>';
                        } else {
                            echo '<div><a href="' . assets_url($row["value"]) . '" target="_blank"/>' . $row['ori_file_name'] . '</a><br><input type="checkbox" name="del_' . $key . '" value="1" > ' . __('刪除') . '?<br><br></div>';
                        }
                    }

                }
                echo '<input type="file" id="' . $id . '" name="' . $key . '" value="" placeholder="' . $row["label"] . '" class="' . $row["class"] . '" ' . $row["attr"] . ' style="' . $row["style"] . '">';

                if (!empty($row['help_txt'])) {
                    echo '<p class="help-block" style="color: red; margin: 5px 0; font-size: 12px;">' . $row['help_txt'] . '</p>';
                }
                break;

            case "single_image_upload":

                if (!empty($row["value"])) {
                    echo '<img src="' . assets_url($row["value"]) . '" class="img-responsive img-thumbnail"><br><label><input type="checkbox" name="del_' . $key . '" value="1" class="checkbox_position_fix" style="margin-top: 10px;"> ' . __('刪除?') . '</label>';

                }
                echo '<div class="file-loading"><input class="file" name="' . $key . '" type="file" ' . $row['file_init'] . '></div><div id="errorBlock_' . $key . '" class="help-block"></div>';

                break;

            case "elfinder_upload":
                if(!empty($row["value"])){
                    echo '<img src="'.assets_url($row["value"]).'" style="width: 200px;"><br><input type="text" name="'.$key.'" value="'.$row["value"].'" class="elfinder_btn form-control" placeholder="'.__('請選擇檔案。').'" readonly><label><input type="checkbox" name="del_'.$key.'" value="1" class="checkbox_position_fix" style="margin-top: 10px;"> '.__('刪除?').'</label>';
                }else{
                    echo '<div class="input-group"><input type="text" name="'.$key.'" value="" class="elfinder_btn form-control" placeholder="'.__('Please click here to upload file.') .'" readonly><span class="input-group-btn"><button class="btn btn-danger elfinder_btn_remove" type="button">'.__('Clear').'</button></span></div>';
                }
                break;
        }
    }
}

if (!function_exists('get_client_ip')) {
    function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}

if (!function_exists('get_login_role_name')) {
    function get_login_role_name($login_role)
    {
        $CI =& get_instance();
        $CI->load->model('Phprbac_roles_model');

        $result = Phprbac_roles_model::where('Title', $login_role)->first();
        $result = _toArray($result);
        //return __($result['Description']);
        return Sys_user_model::role_name($result['Description']);
    }
}

if (!function_exists('get_site_info')) {
    function get_site_info($field = '')
    {
        if (!empty($field)) {
            $site_info = Site_info_model::select($field)->first()->{$field};
        } else {
            $site_info = Site_info_model::first();
        }
        return $site_info;
    }
}

if (!function_exists('history_back')) {
    function history_back($javascript = 0)
    {
        if ($javascript == 0) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo '<html><head><script>history.back();</script></head></html>';
        }
        exit;
    }
}

if (!function_exists('last_url')) {
    function last_url()
    {
        $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https')
        === false ? 'http' : 'https';
        $host = $_SERVER['HTTP_HOST'];
        /*$script   = $_SERVER['SCRIPT_NAME'];
        $params   = $_SERVER['QUERY_STRING'];*/

        //$lastUrl = $protocol . '://' . $host . $script . '?' . $params;

        $path = $_SERVER['REQUEST_URI'];
        $lastUrl = $protocol . '://' . $host . $path;

        return $lastUrl;
    }

}

if (!function_exists('numberformat')) {
    function numberformat($data)
    {
        return number_format($data, 1);
    }
}

if (!function_exists('is_webadmin')) {
    function is_webadmin()
    {
        if (!empty($_SESSION["login_role"])) {
            if ($_SESSION["login_role"] == "admin" || $_SESSION["login_role"] == "super_admin") {
                return true;
            }
        } else {
            return false;
        }
    }
}

if (!function_exists('is_super_admin')) {
    function is_super_admin()
    {
        if (!empty($_SESSION["login_role"])) {
            if ($_SESSION["login_role"] == "super_admin") {
                return true;
            }
        } else {
            return false;
        }
    }
}

if (!function_exists('assets_url')) {
    function assets_url($path = null)
    {
        $url = base_url('assets/' . $path);

        $parse_url = parse_url($url);
        $ext = pathinfo($parse_url['path'], PATHINFO_EXTENSION);
        if ($ext == 'js' || $ext == 'css') {
            $url = $url . '?v=' . FILE_VERSION;
        }

        return $url;
    }
}

if (!function_exists('random_string2')) {
    function random_string2($length = 8)
    {
        $chars = "abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789";
        $random_string = substr(str_shuffle($chars), 0, $length);
        return $random_string;
    }
}

if (!function_exists('ci_send_email')) {
    function ci_send_email($from, $from_name, $to, $to_name, $subject, $message = '', $bcc = array(), $template_field = array(), $template_path = '', $template_content = '', $attachments = array(), $table_name, $table_id, $email_tracking = null, $email_tracking_type = null, $email_tracking_code = null)
    {
        /**
         * Codeigniter Email Library
         * Email setting on "application/config/email.php"
         */
        $result = false;
        if (SEND_EMAIL == 1) {
            $CI =& get_instance();
            $CI->load->library('email');
            $CI->email->clear(true);
            $CI->email->from($from, $from_name);
            $CI->email->to($to);

            if (PRODUCTION == 1) {
                $CI->email->to($to);
                foreach ($bcc as $email) {
                    $CI->email->bcc($email);
                }
            } else {
                $CI->email->to(TEST_EMAIL_ADDR);
            }


            foreach ($attachments as $attachment) {
                if(!empty($attachment['path'])){
                    if (file_exists($attachment['path'])) {
                        $CI->email->attach($attachment['path'], 'attachment', $attachment['name']);
                    }
                }else if(file_exists($attachment['url'])){
                    $CI->email->addStringAttachment(file_get_contents($attachment["url"]), $attachment["name"]);
                }else{
                    if (file_exists($attachment)) {
                        $CI->email->attach($attachment);
                    }
                }
            }


            if ($template_path) {
                $template = file_get_contents($template_path);
                foreach ($template_field as $key => $value) {
                    $template = str_replace('{' . $key . '}', $value, $template);
                }
            } else {
                $template = $template_content;
                foreach ($template_field as $key => $value) {
                    $template = str_replace('{' . $key . '}', $value, $template);
                }
            }

            $CI->email->subject($subject);

            $email_tracking_response = null;
            if($email_tracking == 1){
                //set email tracking
                $email_tracking_response = Email_tracking_model::create_email_tracking($to, $table_name, $table_id, $email_tracking_type, $email_tracking_code);
            }

            if (!empty($message)) {
                $CI->email->message($message.$email_tracking_response['html']);
            } else {
                $CI->email->message($template.$email_tracking_response['html']);
            }

            $result = $CI->email->send();

            $data = array(
                'table_name' => $table_name,
                'table_id' => $table_id,
            );

            if ($result) {
                $data['send_email'] = 1;
                $data['email_message'] = $subject;
                Email_log_model::create($data);
            } else {
                $data['send_email'] = 0;
                $data['email_message'] = $subject;
                $data['email_response'] = $CI->email->print_debugger();
                Email_log_model::create($data);

                if($email_tracking){
                    //delete that email tracking record when send email fail
                    Email_tracking_model::where('email', $email)->where('code', $email_tracking_response['code'])->update(array(
                        'delete' => 1,
                        'deleted_at' => date('Y-m-d H:i:s'),
                        'remark' => 'send email fail',
                    ));
                }
            }

        }
        return $result;
    }
}

if (!function_exists('send_email')) {
    function send_email($from, $from_name, $to, $to_name, $bcc = array(), $subject, $template_field = array(), $template_path = null, $template_content = null, $attachments = array(), $localhost = 1, $table_name, $table_id, $success_message, $fail_message, $return = 0)
    {
        if (SEND_EMAIL == 1) {
            //include('inc/class.phpmailer.php');

            if ($template_path) {
                $template = file_get_contents($template_path);
                foreach ($template_field as $key => $value) {
                    $template = str_replace('{' . $key . '}', $value, $template);
                }
            } else {
                $template = $template_content;
                foreach ($template_field as $key => $value) {
                    $template = str_replace('{' . $key . '}', $value, $template);
                }
            }

            $x_mail = new PHPMailer();
            $x_mail->IsSMTP();
            //$x_mail->SMTPDebug  = 2;
            //$x_mail->Host       = 'localhost';
            //$localhost=0;
            if ($localhost == 0) {
                $x_mail->Host = '';                 // Specify main and backup server
                $x_mail->Port = 3030;                                    // Set the SMTP port
                $x_mail->SMTPAuth = true;                               // Enable SMTP authentication
                $x_mail->Username = 'kenricktam';                // SMTP username
                $x_mail->Password = 'kenricktam1';                  // SMTP password
                $x_mail->SMTPSecure = 'tls';
            } else {
                $x_mail->Host = 'localhost';                 // Specify main and backup server
                //$x_mail->SMTPAuth = true;
            }

            $x_mail->CharSet = "UTF-8";
            $x_mail->Sender = $from;
            $x_mail->From = $from;
            $x_mail->FromName = $from_name;

            $x_mail->AddAddress($to, $to_name);

            if (!empty($bcc)) {
                foreach ($bcc as $email => $name) {
                    if (!empty($email)) {
                        $x_mail->AddBCC($email, $name);
                    }
                }
            }

            $x_mail->WordWrap = 50;
            $x_mail->IsHTML(true);
            $x_mail->Subject = $subject;
            $x_mail->Body = $template;

            if (!empty($attachments)) {
                foreach ($attachments as $key => $attachment) {
                    $x_mail->addStringAttachment(file_get_contents($attachment["url"]), $attachment["name"]);
                }
            }

            $data = array(
                'table_name' => $table_name,
                'table_id' => $table_id,
                'created_at' => date('Y-m-d H:i:s'),
            );

            if ($x_mail->Send()) {
                $data['send_email'] = 1;
                $send_email = 1;
                $data['email_message'] = $success_message;
                $_SESSION["success_msg"] = $success_message;
                $_SESSION["error_msg"] = '';
            } else {
                $data['send_email'] = 0;
                $send_email = 0;
                $data['email_message'] = $fail_message . ' | ' . $x_mail->ErrorInfo;
                $_SESSION["success_msg"] = '';
                $_SESSION["error_msg"] = $fail_message;
            }

            $CI =& get_instance();
            $CI->load->model('Email_log_model');
            Email_log_model::create($data);

            if (!empty($return)) {
                if ($send_email == 1) {
                    return $success_message;
                } else {
                    return $fail_message;
                }
            }
        } else {
            if (!empty($return)) {
                return $success_message;
            }
        }
    }
}

if (!function_exists('sendgrid_email')) {
    function sendgrid_email($code, $from_name, $from_email, $to_name, $to_email, $bcc, $subject, $body, $table_name, $table_id, $success_message, $fail_message, $cc, $return = 0)
    {
        if (SEND_EMAIL == 1) {
            /*
            Sendgrid status code meaning
            Response Code	Reason	Description
            2xx	2xx responses indicate a successful request	The request that you made is valid and successful.
            200	OK	Your message is valid, but it is not queued to be delivered. †
            202	ACCEPTED	Your message is both valid, and queued to be delivered.
            4xx	4xx responses indicate an error with the request	There was a problem with your request.
            400	BAD REQUEST
            401	UNAUTHORIZED	You do not have authorization to make the request.
            403	FORBIDDEN
            404	NOT FOUND	The resource you tried to locate could not be found or does not exist.
            405	METHOD NOT ALLOWED
            413	PAYLOAD TOO LARGE	The JSON payload you have included in your request is too large.
            415	UNSUPPORTED MEDIA TYPE
            429	TOO MANY REQUESTS	The number of requests you have made exceeds SendGrid’s rate limitations
            5xx	5xx responses indicate an error made by SendGrid	An error occurred when SendGrid attempted to processes it.
            500	SERVER UNAVAILABLE	An error occurred on a SendGrid server.
            503	SERVICE NOT AVAILABLE	The SendGrid v3 Web API is not available.
            */

            if (!filter_var($from_email, FILTER_VALIDATE_EMAIL) || !filter_var($to_email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION["success_msg"] = '';
                $_SESSION["error_msg"] = $fail_message;
            }

            $CI =& get_instance();
            $CI->load->model('Email_log_model');

            // If you are not using Composer
            // require('path/to/sendgrid-php/sendgrid-php.php');

            $from = new SendGrid\Email(_h($from_name), _h($from_email));
            $subject = _h($subject);
            $to = new SendGrid\Email(_h($to_name), _h($to_email));

            if (TEST_EMAIL == 1) {
                $to = new SendGrid\Email("Test", TEST_EMAIL_ADDR);
            }

            $content = new SendGrid\Content('text/html', $body);
            $mail = new SendGrid\Mail($from, $subject, $to, $content);

            if (ENABLE_EMAIL_BCC_LOG == 1) {
                $bcc_to = new SendGrid\Email("Test", EMAIL_BCC_LOG_ADDR);
                //addTo, addBcc
                if ($to_email != EMAIL_BCC_LOG_ADDR && TEST_EMAIL_ADDR != EMAIL_BCC_LOG_ADDR) {
                    //bcc and to cannot duplicate?
                    $mail->personalization[0]->addBcc($bcc_to);
                }
            }

            if (!empty($bcc)) {
                foreach ($bcc as $name => $email) {
                    if (!empty($email)) {
                        $to2 = new SendGrid\Email($name, $email);
                        $mail->personalization[0]->addBcc($to2);
                    }
                }
            }

            if (!empty($cc)) {
                foreach ($cc as $name => $email) {
                    if (!empty($email)) {
                        $to2 = new SendGrid\Email($name, $email);
                        $mail->personalization[0]->addTo($to2);
                    }
                }
            }

            //$mail->personalization[0]->addHeader("Priority", "Urgent");
            $mail->personalization[0]->addHeader("Importance", "high");

            $sg = new \SendGrid(SENDGRID_API_KEY);

            $response = $sg->client->mail()->send()->post($mail);
            /*echo $response->statusCode();
            print_r($response->headers());
            echo $response->body();*/

            $data = array(
                'code' => $code,
                'table_name' => $table_name,
                'table_id' => $table_id,
                'createdate' => date('Y-m-d H:i:s'),
            );

            if (SENDGRID_DEBUG == 1) {
                $data['email_response'] = json_encode(array('body' => $response->body(), 'statusCode' => $response->statusCode(), 'headers' => $response->headers(), 'email' => $mail));
            } else {
                $data['email_response'] = json_encode(array('statusCode' => $response->statusCode(), 'headers' => $response->headers()));
            }

            if ($response->statusCode() == 202) {
                $data['send_email'] = 1;
                $send_email = 1;
                $data['email_message'] = $success_message;
                $_SESSION["success_msg"] = $success_message;
                $_SESSION["error_msg"] = '';
            } else {
                $data['send_email'] = 0;
                $send_email = 0;
                $data['email_message'] = $fail_message;
                $_SESSION["success_msg"] = '';
                $_SESSION["error_msg"] = $fail_message;
            }

            $CI->Email_log_model->create($data);
            //return $data['email_message'];

            if (!empty($return)) {
                return $data['send_email'];
            }
        } else {
            if (!empty($return)) {
                return $success_message;
            }
        }

    }
}

//not use (reference only)
/*if (!function_exists('set_lang')) {
    function set_lang()
    {
        $lang  = DEFAULT_FRONTEND_LANGUAGE;
        $wlang = DEFAULT_BACKEND_LANGUAGE;

        if (strpos($_SERVER['REQUEST_URI'] . '/', "/webadmin/") !== false) {
            foreach ($GLOBALS["BACKEND_LANGUAGE_LIST"] as $language => $name) {
                if (strpos($_SERVER['REQUEST_URI'] . '/', '/' . $language . '/') !== false) {
                    $wlang = $language;
                    break;
                }
            }
        } else {
            foreach ($GLOBALS["FRONTEND_LANGUAGE_LIST"] as $language => $name) {
                if (strpos($_SERVER['REQUEST_URI'] . '/', '/' . $language . '/') !== false) {
                    $lang = $language;
                    break;
                }
            }
        }

        $_SESSION['lang']  = $lang;
        $_SESSION['wlang'] = $wlang;


        //zh_TW, zh_CN, en_US

        //language transaltion
        //Create the translator instance
        $t = new Translator();

        //Load your translations (exported as PhpArray):
        switch ($_SESSION["lang"]) {
            case 'en':
                //$t->loadTranslations(APPPATH . 'locale/en_US2zh_TW.php');
                break;

            case 'tc':
                if(file_exists(APPPATH . 'locale'.DIRECTORY_SEPARATOR.'zh_TW'.DIRECTORY_SEPARATOR.'en_US2zh_TW.php')){
                    $t->loadTranslations(APPPATH . 'locale'.DIRECTORY_SEPARATOR.'zh_TW'.DIRECTORY_SEPARATOR.'en_US2zh_TW.php');
                }
                break;

            case 'sc':
                if(file_exists(APPPATH . 'locale'.DIRECTORY_SEPARATOR.'zh_CN'.DIRECTORY_SEPARATOR.'en_US2zh_CN.php')){
                    $t->loadTranslations(APPPATH . 'locale'.DIRECTORY_SEPARATOR.'zh_CN'.DIRECTORY_SEPARATOR.'en_US2zh_CN.php');
                }
                break;
        }

        switch ($_SESSION["wlang"]) {
            case 'en':
                //$t->loadTranslations(APPPATH . 'locale/en_US2zh_TW.php');
                break;

            case 'tc':
                if(file_exists(APPPATH . 'locale'.DIRECTORY_SEPARATOR.'zh_TW'.DIRECTORY_SEPARATOR.'en_US2zh_TW.php')){
                    $t->loadTranslations(APPPATH . 'locale'.DIRECTORY_SEPARATOR.'zh_TW'.DIRECTORY_SEPARATOR.'en_US2zh_TW.php');
                }
                break;

            case 'sc':
                if(file_exists(APPPATH . 'locale'.DIRECTORY_SEPARATOR.'zh_CN'.DIRECTORY_SEPARATOR.'en_US2zh_CN.php')){
                    $t->loadTranslations(APPPATH . 'locale'.DIRECTORY_SEPARATOR.'zh_CN'.DIRECTORY_SEPARATOR.'en_US2zh_CN.php');
                }
                break;
        }

        //Use it:
        //echo $t->gettext('Title'); // "Mazá"

        //If you want use global functions:
        $t->register();

        //echo __('Title'); // "Mazá"
        // END: language translation
    }
}*/

if (!function_exists('force_redirect')) {
    function force_redirect($path, $limit_time = 1800, $memory = '')
    {
//        if(PRODUCTION <> 1){
//            return;
//        }

        @header("Location: {$path}");
        ob_end_clean();
        @header("Connection: close");
        ignore_user_abort(true);
        set_time_limit($limit_time);
        if ($memory <> '') {
            ini_set("memory_limit", $memory);
        }
        ob_start();
        @header("Content-Length: 0");
        ob_end_flush();
        flush();
        session_write_close();
    }
}

if (!function_exists('set_select2')) {
    function set_select2($array, $selected_value, $name, $class = null)
    {
        $select = '<select name="' . $name . '" class="' . $class . '"><option value="">--- Please Select ---</option>';
        foreach ($array as $value => $option_text) {
            $select .= '<option value="' . $value . '" ' . ($value == $selected_value ? 'selected' : '') . '>' . $option_text . '</option>';
        }
        $select .= '</select>';

        return $select;
    }
}

//for password
if (!function_exists('sha256_hash')) {
    function sha256_hash($str)
    {
        $SALT1 = ")5=4n:qnRDXakBYP";
        $SALT2 = "AMR(-339f=sH%csV";
        $SALT3 = ";}2WP#b/e]JB[sew";
        $SALT4 = "a_c7_wPxX-jja-9N";

        $len = strlen($str);
        $len_a = (int)($len / 3);
        $len_b = (int)($len / 3);
        //$len_c = $len - $a - $b;
        $a = substr($str, 0, $len_a);
        $b = substr($str, $len_a, $len_b);
        $c = substr($str, $len_a + $len_b);

        return hash('sha256', $SALT1 . $c . $SALT2 . $b . $SALT3 . $a . $SALT4);
    }
}

if (!function_exists('validateDate')) {
    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

}

if (!function_exists('validate_user_access')) {
    function validate_user_access($permissions, $return = 1, $user_id = null)
    {
        if (empty($_SESSION['sys_user_id'])) {
            if ((current_controller() == 'bk_admin' && current_method() == 'index')) {
            } else {
                if($return){
                    return false;
                }else{
                    redirect(admin_url());
                }
            }
        }

        $CI =& get_instance();
        $CI->load->database();

        $databaseConfig = [
            'adapter' => 'pdo_mysql',
            'host' => $CI->db->hostname,
            'dbname' => $CI->db->database,
            'tablePrefix' => 'phprbac_',
            'user' => $CI->db->username,
            'pass' => $CI->db->password,
        ];

        $rbac = new PhpRbac\Rbac('', $databaseConfig);

        if (empty($user_id)) {
            $user_id = $_SESSION['sys_user_id'];
        }

        foreach ($permissions as $key => $permission) {
            $perm_id = $rbac->Permissions->returnId($permission);
            if ($perm_id) {
                //$rbac->enforce($permission, $user_id);

                $result = $rbac->check($permission, $user_id);

                if ($result) {
                    if ($return == 1) {
                        return true;
                    }
                } else {
                    if ($return == 1) {
                        return false;
                    } else {
                        //not allow
                        if (count($permissions) == $key + 1) {
                            redirect(admin_url('bk_admin/access_denied'));
                        }
                    }
                }
            } else {
                if ($return == 1) {
                    return false;
                } else {
                    //not allow
                    if (count($permissions) == $key + 1) {
                        redirect(admin_url('bk_admin/access_denied'));
                    }
                }
            }
        }
        return false;
    }
}

//handle chinese char
if (!function_exists('pathinfo2')) {
    function pathinfo2($path)
    {
        $dirname = '';
        $basename = '';
        $extension = '';
        $filename = '';

        $pos = strrpos($path, '/');

        if($pos !== false) {
            $dirname = substr($path, 0, strrpos($path, '/'));
            $basename = substr($path, strrpos($path, '/') + 1);
        } else {
            $basename = $path;
        }

        $ext = strrchr($path, '.');
        if($ext !== false) {
            $extension = substr($ext, 1);
        }

        $filename = $basename;
        $pos = strrpos($basename, '.');
        if($pos !== false) {
            $filename = substr($basename, 0, $pos);
        }

        return array (
            'dirname' => $dirname,
            'basename' => $basename,
            'extension' => $extension,
            'filename' => $filename
        );
    }
}

/*if (!function_exists('single_upload')) {
    function single_upload($upload_field = null, $config = array())
    {
        if (!empty($_FILES[$upload_field]['name'])) {
            $CI =& get_instance();
            $CI->load->library('upload');
            $CI->upload->initialize($config);

            // File upload
            if ($CI->upload->do_upload($upload_field)) {
                // Get data about the file
                $uploadData = $CI->upload->data();
                $ori_filename = pathinfo2($_FILES[$upload_field]['name']);

                return array('filename' => $uploadData['file_name'], 'ori_filename' => $ori_filename['filename'], 'extension' => $ori_filename['extension']);
            } else {
                return array('error' => $CI->upload->display_errors());
            }
        }
        return array();
    }
}*/


if (!function_exists('single_upload')) {
    function single_upload($upload_field = NULL, $config = array(), $thumb_config = array())
    {
        if (!empty($_FILES[$upload_field]['name'])) {
            $CI =& get_instance();
            $CI->load->library('image_lib');
            $CI->load->library('upload');
            $CI->upload->initialize($config);

            // File upload
            if ($CI->upload->do_upload($upload_field)) {

                // Get data about the file
                $uploadData = $CI->upload->data();

                if (!empty($thumb_config)) {
                    $thumb_config['image_library'] = 'gd2';
                    $thumb_config['source_image'] = $uploadData['full_path'];
                    $thumb_config['new_image'] = $uploadData['file_path'] . 'thumb/' . $uploadData['file_name'];
                    $thumb_config['maintain_ratio'] = TRUE;
                    $CI->image_lib->initialize($thumb_config);
                    $CI->image_lib->resize();
                }
                $ori_filename = pathinfo($_FILES[$upload_field]['name']);

                return array('filename' => $uploadData['file_name'], 'ori_filename' => $ori_filename['filename'], 'extension' => $ori_filename['extension'], 'file_path' => $config['relative_path'] . $uploadData['file_name']);
            } else {
                //api_log(0, date('Y-m-d H:i:s'), 'upload error: ', $CI->upload->display_errors());

                return array('error' => $CI->upload->display_errors());
            }
        }
        return array();
    }
}


if (!function_exists('base64_upload')) {
    function base64_upload($upload_field = null, $path, $label, $allow_file_type = array("image/jpeg", "image/png", "image/gif", "application/pdf"))
    {
        if (!empty($_FILES[$upload_field]['name'])) {
            //validate file type
            $valid_file_type = false;
            $mime = get_file_mime_type($_FILES[$upload_field]['tmp_name']);

            foreach ($allow_file_type as $row) {
                if (strpos($mime, $row) !== false) {
                    $valid_file_type = true;
                }
            }

            if($valid_file_type){
                $ori_filename = pathinfo2($_FILES[$upload_field]['name']);

                $filename = md5(time().uniqid(rand(), true)).".ed";

                $encoded_string = base64_encode(file_get_contents($_FILES[$upload_field]['tmp_name']));

                //var_dump($encoded_string);

                //add salt
                $token1 = substr($encoded_string, 0, 50);
                $token1 = strrev($token1);
                $token2 = substr($encoded_string, strlen($encoded_string)-50, 50);
                $token2 = strrev($token2);
                $main = substr($encoded_string, 50, strlen($encoded_string)-100);

                $encoded_string = $token1.$main.$token2;
                //var_dump($encoded_string);
                $myfile = fopen($path.$filename, "w") or die("Unable to open file!");
                //get upload file content, base64 encode, add salt, aes encrypt
                fwrite($myfile, codeigniter_aes($encoded_string, 1));

                if(file_exists($path . $filename)){
                    //change uploaded file content to base64_encode and use aes to encrypt it
                    return array('filename' => $filename, 'ori_filename' => $ori_filename['filename'], 'extension' => $ori_filename['extension']);
                }else{
                    return array('error' => $label . ' ' . __('不成功。'));
                }
            }else{
                echo '<script>alert("'.$label.' '.__('檔案格式不正確。').'"); history.back();</script>';
                exit;
            }


        }
        return array();
    }
}

if (!function_exists('base64_upload_decode')) {
    function base64_upload_decode($file_path, $file_type, $ori_file_name, $style="")
    {
        //get salted base64 encode data
        $decoded_string = codeigniter_aes(file_get_contents(FCPATH . $file_path), 2);
        //remove salt
        $token1 = substr($decoded_string, 0, 50);
        $token1 = strrev($token1);
        $token2 = substr($decoded_string, strlen($decoded_string)-50, 50);
        $token2 = strrev($token2);
        $main = substr($decoded_string, 50, strlen($decoded_string)-100);
        $decoded_string = $token1.$main.$token2;

        if($file_type == 'pdf'){
            echo "<div style='cursor: pointer;' onclick=\"var pdfWindow = window.open(''); pdfWindow.document.write('<iframe frameborder=0 width=\'100%\' height=\'100%\' src=\'data:application/pdf;base64,".$decoded_string."\'></iframe>');\">"._h($ori_file_name)."</div>";
        }else{
            echo '<img src="data:image/'._h($file_type).';base64,'.$decoded_string.'" style="'.$style.'" title="'._h($ori_file_name).'"/>';
        }

    }
}

if (!function_exists('multi_upload')) {
    function multi_upload($upload_field = null, $config = array(), $thumb_config = array())
    {
        global $_FILES;
        // upload photos

        $photos = array();
        if (!$upload_field) {
            return $photos;
        }
        $CI =& get_instance();

        // Count total files
        $countfiles = count($_FILES[$upload_field]['name']);

        $CI->load->library(array('upload', 'image_lib'));
        // Looping all files
        for ($i = 0; $i < $countfiles; $i++) {

            if (!empty($_FILES[$upload_field]['name'][$i])) {

                // Define new $_FILES array - $_FILES['file']
                $_FILES['file']['name'] = $_FILES[$upload_field]['name'][$i];
                $_FILES['file']['type'] = $_FILES[$upload_field]['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES[$upload_field]['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES[$upload_field]['error'][$i];
                $_FILES['file']['size'] = $_FILES[$upload_field]['size'][$i];

                //Load upload library
                $CI->upload->initialize($config);


                // File upload
                if ($CI->upload->do_upload('file')) {
                    // Get data about the file
                    $uploadData = $CI->upload->data();

                    if (!empty($thumb_config)) {
                        $thumb_config['image_library'] = 'gd2';
                        $thumb_config['source_image'] = $uploadData['full_path'];
                        $thumb_config['new_image'] = $uploadData['file_path'] . 'thumb/' . $uploadData['file_name'];
                        $thumb_config['maintain_ratio'] = false;
                        $CI->image_lib->initialize($thumb_config);
                        $CI->image_lib->resize();
                    }

                    $photos[] = $uploadData['file_name'];
                }
            }

        }
        return $photos;
    }
}

//upload file

if( ! function_exists( 'get_file_mime_type' ) ) {
    function get_file_mime_type( $filename, $debug = false ) {

        if ( function_exists( 'finfo_open' ) && function_exists( 'finfo_file' ) && function_exists( 'finfo_close' ) ) {
            $fileinfo = finfo_open( FILEINFO_MIME );
            $mime_type = finfo_file( $fileinfo, $filename );
            finfo_close( $fileinfo );

            if ( ! empty( $mime_type ) ) {
                if ( true === $debug )
                    return array( 'mime_type' => $mime_type, 'method' => 'fileinfo' );
                return $mime_type;
            }
        }

        if ( function_exists( 'mime_content_type' ) ) {
            $mime_type = mime_content_type( $filename );

            if ( ! empty( $mime_type ) ) {
                if ( true === $debug )
                    return array( 'mime_type' => $mime_type, 'method' => 'mime_content_type' );
                return $mime_type;
            }
        }

        $mime_types = array(
            'ai'      => 'application/postscript',
            'aif'     => 'audio/x-aiff',
            'aifc'    => 'audio/x-aiff',
            'aiff'    => 'audio/x-aiff',
            'asc'     => 'text/plain',
            'asf'     => 'video/x-ms-asf',
            'asx'     => 'video/x-ms-asf',
            'au'      => 'audio/basic',
            'avi'     => 'video/x-msvideo',
            'bcpio'   => 'application/x-bcpio',
            'bin'     => 'application/octet-stream',
            'bmp'     => 'image/bmp',
            'bz2'     => 'application/x-bzip2',
            'cdf'     => 'application/x-netcdf',
            'chrt'    => 'application/x-kchart',
            'class'   => 'application/octet-stream',
            'cpio'    => 'application/x-cpio',
            'cpt'     => 'application/mac-compactpro',
            'csh'     => 'application/x-csh',
            'css'     => 'text/css',
            'dcr'     => 'application/x-director',
            'dir'     => 'application/x-director',
            'djv'     => 'image/vnd.djvu',
            'djvu'    => 'image/vnd.djvu',
            'dll'     => 'application/octet-stream',
            'dms'     => 'application/octet-stream',
            'doc'     => 'application/msword',
            'docx'     => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'dvi'     => 'application/x-dvi',
            'dxr'     => 'application/x-director',
            'eps'     => 'application/postscript',
            'etx'     => 'text/x-setext',
            'exe'     => 'application/octet-stream',
            'ez'      => 'application/andrew-inset',
            'flv'     => 'video/x-flv',
            'gif'     => 'image/gif',
            'gtar'    => 'application/x-gtar',
            'gz'      => 'application/x-gzip',
            'hdf'     => 'application/x-hdf',
            'hqx'     => 'application/mac-binhex40',
            'htm'     => 'text/html',
            'html'    => 'text/html',
            'ice'     => 'x-conference/x-cooltalk',
            'ief'     => 'image/ief',
            'iges'    => 'model/iges',
            'igs'     => 'model/iges',
            'img'     => 'application/octet-stream',
            'iso'     => 'application/octet-stream',
            'jad'     => 'text/vnd.sun.j2me.app-descriptor',
            'jar'     => 'application/x-java-archive',
            'jnlp'    => 'application/x-java-jnlp-file',
            'jpe'     => 'image/jpeg',
            'jpeg'    => 'image/jpeg',
            'jpg'     => 'image/jpeg',
            'js'      => 'application/x-javascript',
            'kar'     => 'audio/midi',
            'kil'     => 'application/x-killustrator',
            'kpr'     => 'application/x-kpresenter',
            'kpt'     => 'application/x-kpresenter',
            'ksp'     => 'application/x-kspread',
            'kwd'     => 'application/x-kword',
            'kwt'     => 'application/x-kword',
            'latex'   => 'application/x-latex',
            'lha'     => 'application/octet-stream',
            'lzh'     => 'application/octet-stream',
            'm3u'     => 'audio/x-mpegurl',
            'man'     => 'application/x-troff-man',
            'me'      => 'application/x-troff-me',
            'mesh'    => 'model/mesh',
            'mid'     => 'audio/midi',
            'midi'    => 'audio/midi',
            'mif'     => 'application/vnd.mif',
            'mov'     => 'video/quicktime',
            'movie'   => 'video/x-sgi-movie',
            'mp2'     => 'audio/mpeg',
            'mp3'     => 'audio/mpeg',
            'mpe'     => 'video/mpeg',
            'mpeg'    => 'video/mpeg',
            'mpg'     => 'video/mpeg',
            'mpga'    => 'audio/mpeg',
            'ms'      => 'application/x-troff-ms',
            'msh'     => 'model/mesh',
            'mxu'     => 'video/vnd.mpegurl',
            'nc'      => 'application/x-netcdf',
            'odb'     => 'application/vnd.oasis.opendocument.database',
            'odc'     => 'application/vnd.oasis.opendocument.chart',
            'odf'     => 'application/vnd.oasis.opendocument.formula',
            'odg'     => 'application/vnd.oasis.opendocument.graphics',
            'odi'     => 'application/vnd.oasis.opendocument.image',
            'odm'     => 'application/vnd.oasis.opendocument.text-master',
            'odp'     => 'application/vnd.oasis.opendocument.presentation',
            'ods'     => 'application/vnd.oasis.opendocument.spreadsheet',
            'odt'     => 'application/vnd.oasis.opendocument.text',
            'ogg'     => 'application/ogg',
            'otg'     => 'application/vnd.oasis.opendocument.graphics-template',
            'oth'     => 'application/vnd.oasis.opendocument.text-web',
            'otp'     => 'application/vnd.oasis.opendocument.presentation-template',
            'ots'     => 'application/vnd.oasis.opendocument.spreadsheet-template',
            'ott'     => 'application/vnd.oasis.opendocument.text-template',
            'pbm'     => 'image/x-portable-bitmap',
            'pdb'     => 'chemical/x-pdb',
            'pdf'     => 'application/pdf',
            'pgm'     => 'image/x-portable-graymap',
            'pgn'     => 'application/x-chess-pgn',
            'png'     => 'image/png',
            'pnm'     => 'image/x-portable-anymap',
            'ppm'     => 'image/x-portable-pixmap',
            'ppt'     => 'application/vnd.ms-powerpoint',
            'pptx'     => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'ps'      => 'application/postscript',
            'qt'      => 'video/quicktime',
            'ra'      => 'audio/x-realaudio',
            'ram'     => 'audio/x-pn-realaudio',
            'ras'     => 'image/x-cmu-raster',
            'rgb'     => 'image/x-rgb',
            'rm'      => 'audio/x-pn-realaudio',
            'roff'    => 'application/x-troff',
            'rpm'     => 'application/x-rpm',
            'rtf'     => 'text/rtf',
            'rtx'     => 'text/richtext',
            'sgm'     => 'text/sgml',
            'sgml'    => 'text/sgml',
            'sh'      => 'application/x-sh',
            'shar'    => 'application/x-shar',
            'silo'    => 'model/mesh',
            'sis'     => 'application/vnd.symbian.install',
            'sit'     => 'application/x-stuffit',
            'skd'     => 'application/x-koan',
            'skm'     => 'application/x-koan',
            'skp'     => 'application/x-koan',
            'skt'     => 'application/x-koan',
            'smi'     => 'application/smil',
            'smil'    => 'application/smil',
            'snd'     => 'audio/basic',
            'so'      => 'application/octet-stream',
            'spl'     => 'application/x-futuresplash',
            'src'     => 'application/x-wais-source',
            'stc'     => 'application/vnd.sun.xml.calc.template',
            'std'     => 'application/vnd.sun.xml.draw.template',
            'sti'     => 'application/vnd.sun.xml.impress.template',
            'stw'     => 'application/vnd.sun.xml.writer.template',
            'sv4cpio' => 'application/x-sv4cpio',
            'sv4crc'  => 'application/x-sv4crc',
            'swf'     => 'application/x-shockwave-flash',
            'sxc'     => 'application/vnd.sun.xml.calc',
            'sxd'     => 'application/vnd.sun.xml.draw',
            'sxg'     => 'application/vnd.sun.xml.writer.global',
            'sxi'     => 'application/vnd.sun.xml.impress',
            'sxm'     => 'application/vnd.sun.xml.math',
            'sxw'     => 'application/vnd.sun.xml.writer',
            't'       => 'application/x-troff',
            'tar'     => 'application/x-tar',
            'tcl'     => 'application/x-tcl',
            'tex'     => 'application/x-tex',
            'texi'    => 'application/x-texinfo',
            'texinfo' => 'application/x-texinfo',
            'tgz'     => 'application/x-gzip',
            'tif'     => 'image/tiff',
            'tiff'    => 'image/tiff',
            'torrent' => 'application/x-bittorrent',
            'tr'      => 'application/x-troff',
            'tsv'     => 'text/tab-separated-values',
            'txt'     => 'text/plain',
            'ustar'   => 'application/x-ustar',
            'vcd'     => 'application/x-cdlink',
            'vrml'    => 'model/vrml',
            'wav'     => 'audio/x-wav',
            'wax'     => 'audio/x-ms-wax',
            'wbmp'    => 'image/vnd.wap.wbmp',
            'wbxml'   => 'application/vnd.wap.wbxml',
            'wm'      => 'video/x-ms-wm',
            'wma'     => 'audio/x-ms-wma',
            'wml'     => 'text/vnd.wap.wml',
            'wmlc'    => 'application/vnd.wap.wmlc',
            'wmls'    => 'text/vnd.wap.wmlscript',
            'wmlsc'   => 'application/vnd.wap.wmlscriptc',
            'wmv'     => 'video/x-ms-wmv',
            'wmx'     => 'video/x-ms-wmx',
            'wrl'     => 'model/vrml',
            'wvx'     => 'video/x-ms-wvx',
            'xbm'     => 'image/x-xbitmap',
            'xht'     => 'application/xhtml+xml',
            'xhtml'   => 'application/xhtml+xml',
            'xls'     => 'application/vnd.ms-excel',
            'xlsx'     => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xml'     => 'text/xml',
            'xpm'     => 'image/x-xpixmap',
            'xsl'     => 'text/xml',
            'xwd'     => 'image/x-xwindowdump',
            'xyz'     => 'chemical/x-xyz',
            'zip'     => 'application/zip'
        );

        $filename = explode(".", $filename);
        $ext = strtolower(array_pop($filename));   //Line 32

        //$ext = strtolower( array_pop( explode( '.', $filename ) ) );

        if ( ! empty( $mime_types[$ext] ) ) {
            if ( true === $debug )
                return array( 'mime_type' => $mime_types[$ext], 'method' => 'from_array' );
            return $mime_types[$ext];
        }

        if ( true === $debug )
            return array( 'mime_type' => 'application/octet-stream', 'method' => 'last_resort' );
        return 'application/octet-stream';
    }
}

if (!function_exists('upload_files')) {
    function upload_files($FILE, $file_path, $allow_file_type = array("image/jpeg", "image/png"), $single_file_max_size = 2097152)
    {
        //check file size
        if ($FILE['size'] < $single_file_max_size) {
            //check file type
            $valid_file_type = false;
            $mime            = get_file_mime_type($FILE['tmp_name']);

            foreach ($allow_file_type as $row) {
                if ($mime == $row) {
                    $valid_file_type = true;
                }
            }

            if ($valid_file_type) {
                $filename = $FILE['name'];
                preg_match("/\.([^\.]+)$/", $filename, $file_ext);
                $newfilename = md5(time().uniqid(rand(), true)) . "." . $file_ext[1];
                if (PRODUCTION == 1) {
                    move_uploaded_file($FILE['tmp_name'], $file_path . $newfilename) or die ("Upload file: " . $filename . " error.");
                } else {
                    move_uploaded_file($FILE['tmp_name'], $file_path . $newfilename) or die ("Upload file: " . $filename . " error.");
                }

                if($mime == "image/jpeg"){
                    image_fix_orientation($file_path . $newfilename);
                }

                return $newfilename;
            } else {
                //return _translation("File type is invalid.");
                echo '<script>alert("' . __("File type is invalid.") .'"); history.back();</script>';
                exit;
            }
        } else {
            //return _translation("File size is over maximum size.");
            echo '<script>alert("' . __("File size is over maximum size.") . '"); history.back();</script>';
            exit;
        }
    }
}

if (!function_exists('image_fix_orientation')) {
    function image_fix_orientation($filename)
    {
        //$exif = exif_read_data($filename);
        try {
            $exif = exif_read_data($filename);
        }
        catch (Exception $exp) {
            $exif = false;
        }
        if ($exif){
            if (!empty($exif['Orientation'])) {
                $image = imagecreatefromjpeg($filename);
                switch ($exif['Orientation']) {
                    case 3:
                        $image = imagerotate($image, 180, 0);
                        break;

                    case 6:
                        $image = imagerotate($image, -90, 0);
                        break;

                    case 8:
                        $image = imagerotate($image, 90, 0);
                        break;
                }

                imagejpeg($image, $filename, 90);
            }
        }


    }
}
//end upload file

if (!function_exists('form_validation_default_errors')) {
    function form_validation_default_errors($lable)
    {
        if (get_wlang() == 'tc') {
            $lang['required'] = '要求含有 ' . $lable . ' 欄位';
            $lang['isset'] = $lable . ' 欄位必須有值';
            $lang['valid_email'] = $lable . ' 欄位必須是一個有效的 E-mail 地址';
            $lang['valid_emails'] = $lable . ' 欄位必須包含有效的 E-mail地址';
            $lang['valid_url'] = $lable . ' 欄位必須是一個有效的 URL';
            $lang['valid_ip'] = $lable . ' 欄位必須包含一個有效的 IP 位址';
            $lang['min_length'] = $lable . ' 欄位最少需要有 {param} 字元';
            $lang['max_length'] = $lable . ' 欄位不能超過 {param} 字元';
            $lang['exact_length'] = $lable . ' 欄位必須是 {param} 字元';
            $lang['alpha'] = $lable . ' 欄位取值只允許為字母';
            $lang['alpha_numeric'] = $lable . ' 欄位取值只允許為字母和數字字元';
            $lang['alpha_numeric_spaces'] = $lable . ' 欄位取值只允許為字母、數位和空格';
            $lang['alpha_dash'] = $lable . ' 欄位取值只允許為字母、數位、底線和破折號';
            $lang['numeric'] = $lable . ' 欄位取值只允許為數字';
            $lang['is_numeric'] = $lable . ' 欄位必須只包含數字字元';
            $lang['integer'] = $lable . ' 欄位必須是整數';
            $lang['regex_match'] = $lable . ' 欄位的格是錯誤';
            $lang['matches'] = $lable . ' 欄位與 {param} 欄位不符';
            $lang['differs'] = $lable . ' 欄位與 {param} 欄位必須不同';
            $lang['is_unique'] = $lable . ' 欄位必須是一個獨一無二的值';
            $lang['is_natural'] = $lable . ' 欄位必須是自然數';
            $lang['is_natural_no_zero'] = $lable . ' 欄位必須是非 0 的自然數';
            $lang['decimal'] = $lable . ' 欄位必須是十進位數字';
            $lang['less_than'] = $lable . ' 欄位的值必須小於 {param}';
            $lang['less_than_equal_to'] = $lable . ' 欄位的值必須小於等於 {param}';
            $lang['greater_than'] = $lable . ' 欄位的值必須大於 {param}';
            $lang['greater_than_equal_to'] = $lable . ' 欄位的值必須大於等於 {param}';
            $lang['error_message_not_set'] = '無法取得 ' . $lable . ' 欄位的錯誤資訊';
            $lang['in_list'] = $lable . ' 欄位必须是 {param} 中的一種';
        }

        return $lang;
    }
}

if (!function_exists('sql_select_as')) {
    function sql_select_as($table, $field)
    {
        return $table . '.' . $field . ' as ' . $table . '_' . $field;
    }
}

if (!function_exists('codeigniter_aes')) {
    function codeigniter_aes($data, $encrypt_decrypt)
    {
        $CI =& get_instance();

        if ($encrypt_decrypt == 1) {
            return $CI->encryption->encrypt($data);
        } else if ($encrypt_decrypt == 2) {
            return $CI->encryption->decrypt($data);
        }
    }
}

if (!function_exists('toChiNum')) {
    function toChiNum($num)
    {
        if (strlen($num) == 1) {
            $tens = 0;
            $units = $num;
        } else if (strlen($num) == 2) {
            $tens = substr($num, 0, 1);
            $units = substr($num, 1, 1);;
        }

        $chinum = '';
        switch ($tens) {
            case '0':
                $chinum .= '';
                break;
            case '1':
                $chinum .= '十';
                break;
            case '2':
                $chinum .= '二十';
                break;
            case '3':
                $chinum .= '三十';
                break;
            case '4':
                $chinum .= '四十';
                break;
            case '5':
                $chinum .= '五十';
                break;
            case '6':
                $chinum .= '六十';
                break;
            case '7':
                $chinum .= '七十';
                break;
            case '8':
                $chinum .= '八十';
                break;
            case '9':
                $chinum .= '九十';
                break;
        }

        switch ($units) {
            case '1':
                $chinum .= '一';
                break;
            case '2':
                $chinum .= '二';
                break;
            case '3':
                $chinum .= '三';
                break;
            case '4':
                $chinum .= '四';
                break;
            case '5':
                $chinum .= '五';
                break;
            case '6':
                $chinum .= '六';
                break;
            case '7':
                $chinum .= '七';
                break;
            case '8':
                $chinum .= '八';
                break;
            case '9':
                $chinum .= '九';
                break;
        }

        return $chinum;
    }
}

if (!function_exists('objectToArray')) {
    function objectToArray($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map('objectToArray', $object);
    }
}

//###########################################################################

/*** Grouped Function List ***/

/*** for query log debug ***/
if (!function_exists('vdump')) {
    function vdump()
    {
        print"<pre>";
        call_user_func_array('var_dump', func_get_args());
        //var_dump($a);
        print"</pre>";
    }
}

if (!function_exists('is_assoc')) {
    function is_assoc(array $array = array())
    {
        if (empty($array)) {
            return false;
        }
        return (bool)count(array_filter(array_keys($array), 'is_string'));
    }
}

if (!function_exists('dq_bind_array')) {
    function dq_bind_array($query, $binding = array())
    {
        foreach ($binding as $v) {
            $query = preg_replace('/[?]/', "'{$v}'", $query, 1);
        }
        return $query;
    }

}

if (!function_exists('dq_bind_assoc')) {
    function dq_bind_assoc($query, $binding = array())
    {
        if (sizeof($binding) > 0) {
            krsort($binding);
            foreach ($binding as $key => $value) {
                $query = str_replace("{$key}", "'{$value}'", $query);
            }
        }
        return $query;
    }
}

if ( ! function_exists('dq')) {
    function dq($bind = TRUE, $die = FALSE, $return = FALSE, $connection = "default", $time=FALSE)
    {

        if ( ! DB::connection($connection)->logging()) {
            echo "Please enable Capsule::connection('{$connection}')->enableQueryLog(); in database.php";
            return;
        }

        $results = DB::connection($connection)->getQueryLog();

        if ($bind) {
            foreach ($results as $k => $result) {
                if (is_assoc($result['bindings'])) {
                    $queries[] = dq_bind_assoc($result['query'], $result['bindings']).($time?"\nexecute time: ".$result['time']/1000:'');
                } else {
                    $queries[] = dq_bind_array($result['query'], $result['bindings']).($time?"\nexecute time: ".$result['time']/1000:'');
                }
            }
            if ($return) {
                return $queries;
            } else {
                vdump($queries);
                if ($die) exit();
                return;
            }
        }

        if ($return) {
            return $results;
        } else {
            vdump($results);
            if ($die) exit();
        }
    }
}

if ( ! function_exists('laravel_query_log')) {
    function laravel_query_log(){
        if(LARAVEL_QUERY_LOG == 1){
            $query = dq(1, FALSE, TRUE, 'default', TRUE);
            $date = new DateTime();
            $log_query = array();

            if(LARAVEL_QUERY_LOG == 'ALL'){
                $log_query = $query;
            }else{ //IGNORE_SELECT
                if(!empty($query)){
                    foreach ($query as $row){
                        if(substr($row, 0, 6 ) != "select"){
                            $log_query[] = $row;
                        }
                    }
                }
            }

            if(!empty($log_query)){
                file_put_contents(APPPATH."logs/query/".$date->format("Y-m-d").".log", "########## ".$date->format("Y-m-d H:i:s")." ##########\n\n".implode("\n\n", $log_query)."\n\n", FILE_APPEND);
            }
        }
    }
}
/*** END : for query log debug ***/

/*** Paypal ***/

if (!function_exists('_curl2')) {
    function _curl2($url, $postData, $post)
    {
        if (!empty($post)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 600); //timeout in seconds
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            $result = curl_exec($ch);
            curl_close($ch);
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 600); //timeout in seconds
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            $result = curl_exec($ch);
            curl_close($ch);
        }

        return $result;
    }
}

if (!function_exists('paypal_error')) {
    function paypal_error($order_id, $session_id, $data)
    {
        paypal_log($order_id, $session_id, "APIError", (array($_REQUEST, $_SESSION)));
    }
}

if (!function_exists('paypal_log')) {
    function paypal_log($order_id, $session_id, $code, $data)
    {
        $CI =& get_instance();
        /*unset($data[1]["nvpReqArray"]["PWD"]);
        unset($data[1]["nvpReqArray"]["USER"]);
        unset($data[1]["nvpReqArray"]["SIGNATURE"]);*/

        $sql = "INSERT INTO paypal_log (order_id, session_id, code, log_data, createdate) VALUE (?,?,?,?,?)";
        $parameters = array($order_id, $session_id, $code, json_encode($data), date("Y-m-d H:i:s"));
        $CI->db->query($sql, $parameters);
    }
}

if (!function_exists('NVP_header')) {
    function NVP_header()
    {
        $header = array(
            "USER" => API_USERNAME,
            "PWD" => API_PASSWORD,
            "SIGNATURE" => API_SIGNATURE,
            "VERSION" => VERSION,
        );

        return http_build_query($header);
    }
}

if (!function_exists('SetExpressCheckout')) {
    function SetExpressCheckout($order_id, $session_id, $data)
    {
        paypal_log($order_id, $session_id, "SetExpressCheckout_data", $data);

        $data["METHOD"] = "SetExpressCheckout";

        $NVP_header = NVP_header();
        $url = API_ENDPOINT;
        $response = _curl2($url, ($NVP_header . "&" . http_build_query($data)), 1);
        parse_str($response, $response_array);

        //$_SESSION['SetExpressCheckout_response'] = $response_array;
        $_SESSION['SetExpressCheckout_response']['TOKEN'] = $response_array["TOKEN"];
        paypal_log($order_id, $session_id, "SetExpressCheckout_response", $response_array);

        return $response_array;
    }
}

if (!function_exists('GetExpressCheckoutDetails')) {
    function GetExpressCheckoutDetails($order_id, $session_id, $data)
    {
        paypal_log($order_id, $session_id, "GetExpressCheckoutDetails_data", $data);

        $data["METHOD"] = "GetExpressCheckoutDetails";

        $NVP_header = NVP_header();
        $url = API_ENDPOINT;
        $response = _curl2($url, ($NVP_header . "&" . http_build_query($data)), 1);
        parse_str($response, $response_array);

        //$_SESSION['GetExpressCheckoutDetails_response'] = $response_array;
        paypal_log($order_id, $session_id, "GetExpressCheckoutDetails_response", $response_array);

        return $response_array;
    }
}

if (!function_exists('DoExpressCheckoutPayment')) {
    function DoExpressCheckoutPayment($order_id, $session_id, $data)
    {
        paypal_log($order_id, $session_id, "DoExpressCheckoutPayment_data", $data);

        $data["METHOD"] = "DoExpressCheckoutPayment";

        $NVP_header = NVP_header();
        $url = API_ENDPOINT;
        $response = _curl2($url, ($NVP_header . "&" . http_build_query($data)), 1);
        parse_str($response, $response_array);

        //$_SESSION['DoExpressCheckoutPayment_response'] = $response_array;
        paypal_log($order_id, $session_id, "DoExpressCheckoutPayment_response", $response_array);

        return $response_array;
    }
}

/*** END : Paypal ***/