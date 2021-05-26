<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_tracking_model extends BaseModel
{
    protected $table = 'email_tracking';

    public static function create_email_tracking($email, $table_name, $table_id, $type = null, $code = null, $remark = null)
    {
        if (empty($code)) {
            //random code
            $code = sha256_hash(time() . uniqid(mt_rand(), true));
        }

        $result = Email_tracking_model::create(array(
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => $_SESSION["sys_user_id"],
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => $_SESSION["sys_user_id"],
            'email' => $email,
            'table_name' => $table_name,
            'table_id' => $table_id,
            'type' => $type,
            'code' => $code,
            'remark' => $remark,
        ));

        $email = urlencode($email);

        if ($result->id) {
            return array('code' => $code, 'html' => '<img src="'.front_url('email_tracking/open/'.$email.'/'.$code).'" style="display:none !important;" />');
        } else {
            return null;
        }
    }

}