<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_tracking extends MY_Controller
{

    public function open($email, $code)
    {
        if (!empty($email) && !empty($code)) {
            $result = Email_tracking_model::where('email', urldecode($email))->where('code', $code)->first();
            if (!empty($result)) {
                if($result['open'] != 1){
                    $result->update(array(
                        'open' => 1,
                        'open_at' => date('Y-m-d H:i:s'),
                        'ip' => get_client_ip(),
                        'user_agent' => $_SERVER['HTTP_USER_AGENT']
                    ));
                }
            }
        }
    }

}
