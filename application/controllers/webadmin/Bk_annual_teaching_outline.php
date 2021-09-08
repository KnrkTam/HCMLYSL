<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_annual_teaching_outline extends CI_Controller //change this
{
    private $scope = 'annual_teaching_outline'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('年度教學大綱 - 檢視'), //change this
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
        $data['subjects_list'] = Subjects_model::list();
        $year_id = Years_model::orderBy('year_from', 'DESC')->first()->id;
        $data['year_id'] = $year_id; 
        
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }
    public function create($annual_subject_group_id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);

        $asg = Annual_subject_groups_model::find($annual_subject_group_id);
        if (!$asg || !$annual_subject_group_id) {
            $_SESSION['error_msg'] = __('找不到頁面');
            redirect(admin_url('bk_'.$this->scope));
        }
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');
        $data['function'] = "create";
        $data['year_id'] = Years_model::orderBy('year_to', 'DESC')->first()->id;
        $data['years_list'] = Years_model::list();
        $data['year'] = Years_model::annual($asg->year_id);
        $data['subject'] = Subjects_model::name($asg->subject_id);
        $data['group_name'] = $asg->group_name ? $asg->group_name  : Classes_model::name($asg->class_id);
        $data['annual_modules_list'] = Annual_modules_model::year_list($asg->year_id, null, 'not_app');
        $data['module'] = Modules_model::order_list($asg->module_order);
        $data['subject_list'] = Subjects_model::list();
        $data['staff_list'] = Staff_model::list();
        $data['module_order_list'] = Modules_model::order_list();
        $data['classes_list'] = Classes_model::list();
        $data['students_list'] = Students_model::list('class');

        $data['action'] = __('新 增');

        $GLOBALS["select2"] = 1;
        $GLOBALS['datetimepicker'] = 1;
        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }
    
    public function ajax(){
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        $year_id = $_GET['year_id'];

        $result = Annual_subject_groups_model::where('year_id', $year_id)->get();


        $result_count = count($result);
        // dump($result_count);
        $data = array();
        $num = 0;
        if (!empty( $result)) {
            foreach ($result as $key => $row) {
                $student_list = Annual_subject_groups_students_model::id_list($row['id']);
                $other_staff_list = Annual_subject_groups_other_staff_model::id_list($row['id']);

                $student = "";
                foreach ($student_list as $student_id) {
                    $class_name = Students_model::find($student_id)->class;
                    $student .= '<li>'. Students_model::name($student_id). ' - '. $class_name.'</li>';
                }
                $other_staff = "";
                foreach ($other_staff_list as $staff_id) {
                    $other_staff .= '<li>'. Staff_model::name($staff_id). '</li>';
                }
                $data[$num]['year'] = Years_model::annual($row['year_id']);
                $data[$num]['subject'] = Subjects_model::name($row['subject_id']);
                $data[$num]['group'] = $row['group_name'] ? $row['group_name'] : Classes_model::name($row['class_id']);
                $data[$num]['module'] = '<span class="hidden">'. $row['module_order'].'</span>'. Modules_model::order_list($row['module_order']);
                $data[$num]['annual_module'] = null;
                $data[$num]['annual_teaching_outline'] = '<a href="'.admin_url(current_controller() . '/create/'. $row['id'] ).'">新 增</a>';
                // $data[$num]['students'] = $student;

                $num++;
            }
        }

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }
}
