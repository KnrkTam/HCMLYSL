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
            'create_' . $this->scope
        ), FALSE, TRUE);
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');

        $data['year_id'] = Years_model::orderBy('year_to', 'DESC')->first()->id;
        $data['years_list'] = Years_model::list();
        $data['subject_list'] = Subjects_model::list();
        $data['staff_list'] = Staff_model::list();
        $data['modules_list'] = Modules_model::list();
        $data['classes_list'] = Classes_model::list();


        $data['action'] = __('新 增');

        $GLOBALS["select2"] = 1;
        $GLOBALS['datetimepicker'] = 1;
        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }
    public function edit()
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);


        $data['action'] = __('修 改');
        $GLOBALS["select2"] = 1;


        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }


    public function validate()
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);
        // $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;
        // dump($_POST);
        $year_id = $_POST['year_id'];
        $subject_id = $_POST['subject_id'];
        $module_id = $_POST['module_id'];
        $staff1_id = $_POST['staff1_id'];
        $staff2_id = $_POST['staff2_id'];
        $other_staff_id = $_POST['other_staff_id'];

         // explode(',', $postData['subject_lessons']);

        // foreach ($subject_lessons as $i => $row) {
        //     $duplicated_sub = Subject_lessons_modules_model::where('year_id', $year_id)->where('module_id', $module_id)->where('subject_lessons_id', $row)->where('subject_id', $subject_id)->first()->subject_lessons_id;
        //     $duplicated = Subject_lessons_model::find($duplicated_sub)->lesson_id;

        //     if ($duplicated) {
        //         $check[] = $duplicated;
        //     }
        // }

        switch(true) {
            case (empty($subject_id));
            $data = array(
                'status' => '請選擇科目',
            );
            break;
            case (empty($staff1_id) || empty($staff2_id));
            $data = array(
                'status' => '請選擇主教老師',
            );
            break;
            case (empty($module_id));
            $data = array(
                'status' => '請選擇單元',
            );
            break;
        //     case (!$subject_id);
        //     $data = array(
        //         'status' => '請選擇科目',
        //     );
        //     break;

        //     case (!$postData['module_id']);
        //     $data = array(
        //         'status' => '請選擇年度學習單元',
        //     );
        //     break;

        //     case (strlen($postData['subject_lessons']) == 0);
        //     $data = array(
        //         'status' => '請選擇選擇教學大綱項目',
        //     );
        //     break;
        //     case (count($check) > 0);
        //     $data = array(
        //         'status' => '已存在課程'. json_encode(Lessons_model::code($check)),
        //     );
        //     break;
            default;
            $data = array(
                'status' => 'success',
            );
        }
        echo json_encode($data);

    }

    public function preview()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        dump($_POST);

        $year_id = $_POST['year_id'];
        $subject_id = $_POST['subject_id'];
        $staff1_id = $_POST['staff1_id'];
        $staff2_id = $_POST['staff2_id'];
        $module_id = $_POST['module_id'];



        $data['preview_year'] = Years_model::annual($year_id);
        $data['preview_subject'] =Subjects_model::name($subject_id);
        $data['preview_staff1'] = Staff_model::name($staff1_id);
        $data['preview_staff2'] = Staff_model::name($staff2_id);
        $data['preview_modules'] = json_encode($module_id);


        $data['action'] = __('預 覽');



        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    
}
