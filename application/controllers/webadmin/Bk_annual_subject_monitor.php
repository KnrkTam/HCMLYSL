<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_annual_subject_monitor extends CI_Controller //change this
{
    private $scope = 'annual_subject_monitor'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('設定年度科長 - 檢視'), //change this
            'scope_code' => $this->scope,
            'permission' => $permission
        );

        $result = validate_user_access($page_setting['permission']);

        if (!$result) {
            if ($redirect) {
                $_SESSION['error_msg'] = __('Access Denied.');
                redirect(admin_url());
            } else if ($return) {
                return $result;
            } else {
                $response = ['success' => FALSE, 'data' => [], 'message' => __('Access Denied.')];
                echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                exit;
            }
        }

        return $page_setting;
    }

    public function index($filter_type = NULL, $filter_para = NULL, $filter_para2 = NULL)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        $data['years_list'] = Years_model::list();
        $data['subjects_list'] = Subjects_model::list();

        $year_id = Years_model::orderBy('year_from', 'DESC')->first()->id;
        $data['year_id'] = $year_id; 
        

        $data['data'] = json_decode();
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        $this->load->view('webadmin/' . $this->scope . '', $data);
    }

    public function validate($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);

        $postData = $this->input->post();
        if (!$id){
            $dup_annual_staff = Annual_staff_model::where('year_id', $postData['year_id'])->where('monitor_id', $postData['monitor_id'])->where('subject_id', $postData['subject_id'])->first();
        }


        switch(true) {
            case ($dup_annual_staff);
            $data = array(
                'status' => '已加入職員名單',
            );
            break;

            case (!$postData['year_id']);
            $data = array(
                'status' => '請選擇年度',
            );
            break;

            case (!$postData['staff_id']);
            $data = array(
                'status' => '請選擇人選',
            );
            break;

            case (!$postData['position_id']);
            $data = array(
                'status' => '請選擇職位',
            );
            break;

            default;
            $data = array(
                'status' => 'success',
            );
        }
        echo json_encode($data);

    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        $GLOBALS["select2"] = 1;

        $data['action'] = __('新 增');
        $data['years_list'] = Years_model::list();
        $data['staff_list'] = Staff_model::list();
        $data['subjects_list'] = Subjects_model::list();

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');

        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }


    public function edit()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);


        $data['action'] = __('修 改');



        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }
    public function preview()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);
        dump($_POST);

        $data['action'] = __('預 覽');
        $data['year_id'] = Years_model::annual($_POST['year_id']);
        $data['position_id'] = Positions_model::name($_POST['position_id']);
        $data['staff_id'] = Staff_model::name($_POST['staff_id']);


        $data['postData'] = $_POST;

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'. $id);


        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

}
