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
        $data['subjects_list'] = Subjects_model::list('all');

        $year_id = Years_model::orderBy('year_from', 'DESC')->first()->id;
        $data['year_id'] = $year_id; 
        

        $data['data'] = json_decode();
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $data['form_action'] = admin_url($data['page_setting']['controller']);

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }


    public function ajax(){
        // $postData = $this->input->post();
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        $year_id = $_GET['year_search'];
        $subject_id = $_GET['subject_search'];

        $result_arr = array();

        switch (true) {
            case ($year_id && $subject_id);
            $result = Annual_subject_monitor_model::where('year_id', $year_id)->where('subject_id', $subject_id)->get();
            break;

            case ($year_id);
            $result = Annual_subject_monitor_model::where('year_id', $year_id)->get();
            break;

            case ($subject_id);
            $result = Annual_subject_monitor_model::where('subject_id', $subject_id)->get();
            break;
        }

        $result_count = count($result);
        //rearrange data
        $data = array();
        $num = 0;

        foreach ($result as $row) {
            $data[$num][] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. $row['id'] ).'"><i class="fa fa-edit"></i></a>';
            $data[$num][] = Years_model::annual($row['year_id']);
            $data[$num][] = Subjects_model::name($row['subject_id']);
            $data[$num][] = Staff_model::name($row['monitor_id']);
            $data[$num][] = Staff_model::name($row['deputy_monitor_id']);
            $num++; 
        }  

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function validate($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);

        if (!$id){
            $dup_annual_subject = Annual_subject_monitor_model::where('year_id', $_POST['year_id'])->where('subject_id', $_POST['subject_id'])->first();
        }


        switch(true) {
            case ($dup_annual_subject);
            $data = array(
                'status' => '已存在年度科長',
            );
            break;

            case (!$_POST['year_id']);
            $data = array(
                'status' => '請選擇年度',
            );
            break;

            case (!$_POST['subject_id']);
            $data = array(
                'status' => '請選擇科目',
            );
            break;

            case (!$_POST['monitor_id']);
            $data = array(
                'status' => '請選擇科長',
            );
            break;

            case (!$_POST['deputy_monitor_id']);
            $data = array(
                'status' => '請選擇副科長',
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


    public function edit($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);


        $data['action'] = __('修 改');
        $data['years_list'] = Years_model::list();
        $data['staff_list'] = Staff_model::list();
        $data['subjects_list'] = Subjects_model::list();
        $annual_subject = Annual_subject_monitor_model::find($id);
        $data['id'] = $id;
        $data['year_id'] = $annual_subject->year_id;
        $data['subject_id'] = $annual_subject->subject_id;
        $data['monitor_id'] = $annual_subject->monitor_id;
        $data['deputy_monitor_id'] = $annual_subject->deputy_monitor_id;

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $id);

        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }


    public function preview($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);
        $previous = $_POST['action'];

        $data['action'] = __('預 覽');
        $data['year_id'] = Years_model::annual($_POST['year_id']);
        $data['subject_id'] = Subjects_model::name($_POST['subject_id']);
        $data['monitor_id'] = Staff_model::name($_POST['monitor_id']);
        $data['deputy_monitor_id'] = Staff_model::name($_POST['deputy_monitor_id']);
        $data['previous'] = $previous;
        $data['id'] = $id;

        $data['postData'] = $_POST;

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'. $id);


        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    public function submit_form($id = null){
        $postData = json_decode($_POST['post_data']);
        $annual_subject_monitor_data = array(
            'year_id' => $postData->year_id,
            'subject_id' => $postData->subject_id,
            'monitor_id' => $postData->monitor_id,
            'deputy_monitor_id' => $postData->deputy_monitor_id,

        );
        if (!$id) {
            $created_id = Annual_subject_monitor_model::create($annual_subject_monitor_data)->id;
            if ($created_id) {
                $_SESSION['success_msg'] = __('新增年度科長成功');
                redirect(admin_url('bk_'.$this->scope));
            }
        } else {
            $created_id = Annual_subject_monitor_model::find($id)->update($annual_subject_monitor_data);

            $_SESSION['success_msg'] = __('修改設定年度科長成功');
            redirect(admin_url('bk_'.$this->scope));

        };

        if ($created_id) {
            $_SESSION['success_msg'] = __('新增年度科長成功');
            redirect(admin_url('bk_'.$this->scope));
        } else {
            $_SESSION['error_msg'] = __('Error');

        }


    }
}
