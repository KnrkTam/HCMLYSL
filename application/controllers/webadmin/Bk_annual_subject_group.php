<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_annual_subject_group extends CI_Controller //change this
{
    private $scope = 'annual_subject_group'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('年度科目分組 - 檢視'), //change this
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

    public function index()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        $data['years_list'] = Years_model::list();
        $year_id = Years_model::orderBy('year_from', 'DESC')->first()->id;
        $data['year_id'] = $year_id; 
        
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);
        $data['years_list'] = Years_model::list();
        $data['subject_list'] = Subjects_model::list();
        $data['staff_list'] = Staff_model::list();

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form');
        $data['action'] = __('新 增');

        $GLOBALS["select2"] = 1;
        $GLOBALS['datetimepicker'] = 1;
        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }
    public function edit()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);


        $data['action'] = __('修 改');
        $GLOBALS["select2"] = 1;


        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }
    public function preview()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);


        $data['action'] = __('預 覽');



        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    
}
