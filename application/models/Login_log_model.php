codeigniter Login_log_model update+


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_log_model extends BaseModel
{
    protected $table = "login_log";
    protected $hidden = ['createby', 'lastupdate', 'lastupby', 'deletedate', 'deleteby', 'deleted'];

    public static function check_if_lock()
    {
        $date = new DateTime();
        $date->modify('-10 minutes');
        $last_ten_minutes = $date->format('Y-m-d H:i:s');

        $result = Login_log_model::where('is_block', 1)->
        where('createdate', '>=', $last_ten_minutes)->
        where('createdate', '<=', date('Y-m-d H:i:s'))->
        whereRaw('(ip_address = ? or session_id = ?)', array(get_client_ip(), session_id()))->count();

        return $result >= 5;
    }

    public static function count_retry()
    {
        $date = new DateTime();
        $date->modify('-10 minutes');
        $last_ten_minutes = $date->format('Y-m-d H:i:s');

        $result = Login_log_model::where('is_block', 1)->
        whereRaw('(ip_address = ? or session_id = ?)', array(get_client_ip(), session_id()))->
        where('createdate', '>=', $last_ten_minutes)->
        where('createdate', '<=', date('Y-m-d H:i:s'))->count();

        return 5-$result;
    }

    public static function form_list()
    {

        return array(
            'table_name'   => array(
                'label'                 => __('平台'),
            ),
            'table_id'   => array(
                'label'                 => __('登入名稱'),
            ),
            'createdate'   => array(
                'label'                 => __('登錄日期'),
            ),
            'ip_address'  => array(
                'label'                 => __('IP地址'),
            ),
            'is_success'   => array(
                'label'                 => __('是否成功登錄'),
            ),
            'is_block'   => array(
                'label'                 => __('是否已阻擋登錄'),
            ),
//            'user_agent' => array(
//                'label'                 => __('用戶介面'),
//            ),
        );
    }

}