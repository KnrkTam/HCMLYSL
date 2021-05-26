<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_email_tracking extends MY_Controller
{
    private $scope = 'email_tracking';

    public function __construct()
    {
        parent::__construct();

    }

    public function page_setting($permission)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('電郵推廣數據'),
            'scope_code' => $this->scope,
            'permission' => $permission
        );

        validate_user_access($page_setting['permission']);

        return $page_setting;
    }

    public function index($table_name, $table_id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ));

        $result = Email_tracking_model::where('status', 1);
        if (!empty($table_name)) {
            $result = $result->where('table_name', $table_name);
        }
        if (!empty($table_id)) {
            $result = $result->where('table_id', $table_id);
        }
        $result = $result->orderBy('created_at', 'DESC')->get();

        $data['total_email'] = 0;
        $data['opened_email'] = 0;
        if (!empty($result)) {
            foreach ($result as $key => $row) {
                $data['total_email']++;
                if($row['open']){
                    $data['opened_email']++;
                }
                switch ($row['type']) {
                    case 'EDM TEST EMAIL':
                        $table_info = Edm_model::find($row['table_id']);
                        $data['email_tracking_index'][$key]['type'] = __('測試電郵推廣');
                        $data['email_tracking_index'][$key]['desc'] = $table_info['title_tc'];
                        break;
                    case 'EDM EMAIL':
                        $table_info = Edm_model::find($row['table_id']);
                        $data['email_tracking_index'][$key]['type'] = __('電郵推廣');
                        $data['email_tracking_index'][$key]['desc'] = $table_info['title_tc'];
                        break;
                    case 'RESEND EDM EMAIL':
                        $table_info = Edm_model::find($row['table_id']);
                        $data['email_tracking_index'][$key]['type'] = __('重發電郵推廣');
                        $data['email_tracking_index'][$key]['desc'] = $table_info['title_tc'];
                        break;
                }

                $data['email_tracking_index'][$key]['email'] = $row['email'];
                $data['email_tracking_index'][$key]['open'] = ($row['open'] == 1 ? __('已開啟') . '<br>' . $row['open_at'] : '未開啟');
                $data['email_tracking_index'][$key]['send_date'] = $row['created_at'];
            }
        }

        $edm_list = Edm_model::get();
        $data['edm_options'] = '<option value="">'.__('請選擇').'</option>';
        if (!empty($edm_list)) {
            foreach ($edm_list as $key => $row) {
                $data['edm_options'] .= '<option value="'.$row['id'].'" '.($table_name=='edm' && $table_id == $row['id'] ?'selected' :'').'>'.$row['title_tc'] . ($row['status'] == '0' ? __('失效') : '').'</option>';
            }
        }

        $data['opened_percentage'] = round($data['opened_email'] / $data['total_email'] * 100, 2).'%';

        $GLOBALS["datatable"] = 1;
        $GLOBALS["select2"] = 1;
        $this->load->view('webadmin/' . $this->scope . '_index', $data);
    }

}