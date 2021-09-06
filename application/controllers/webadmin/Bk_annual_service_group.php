<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_annual_service_group extends CI_Controller //change this
{
    private $scope = 'annual_service_group'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('年度服務分組 - 檢視'), //change this
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

    

    public function ajax(){
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        $year_id = $_GET['year_id'];

        $result = Annual_service_groups_model::where('year_id', $year_id)->get();


        $result_count = count($result);
        // dump($result_count);
        $data = array();
        $num = 0;
        if (!empty( $result)) {
            foreach ($result as $key => $row) {
                $student_list = Annual_service_groups_students_model::id_list($row['id']);
                $other_staff_list = Annual_service_groups_other_staff_model::id_list($row['id']);

                $student = "";
                foreach ($student_list as $student_id) {
                    $class_name = Students_model::find($student_id)->class;
                    $student .= '<li>'. Students_model::name($student_id). ' - '. $class_name.'</li>';
                }
                $other_staff = "";
                foreach ($other_staff_list as $staff_id) {
                    $other_staff .= '<li>'. Staff_model::name($staff_id). '</li>';
                }
                $data[$num]['edit'] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. $row['id'] ).'"><i class="fa  fa-edit"></i></a>';
                $data[$num]['subject'] = Services_model::name($row['service_id']);
                $data[$num]['staff'] = Staff_model::name($row['staff1_id']). ', '. Staff_model::name($row['staff2_id']);
                $data[$num]['other_staff'] = $other_staff ? $other_staff : '<p style="color:lightgrey">暫無其他負責人員</p>';
                $data[$num]['module'] = '<span class="hidden">'. $row['module_order'].'</span>'. Modules_model::order_list($row['module_order']);
                $data[$num]['group'] = $row['group_name'] ? $row['group_name'] : Classes_model::name($row['class_id']);
                $data[$num]['students'] = $student;

                $num++;
            }
        }

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');
        $data['function'] = "create";
        $data['year_id'] = Years_model::orderBy('year_to', 'DESC')->first()->id;
        $data['years_list'] = Years_model::list();
        $data['services_list'] = Services_model::list();
        $data['staff_list'] = Staff_model::list();
        $data['module_order_list'] = Modules_model::order_list();
        $data['classes_list'] = Classes_model::list();
        $data['students_list'] = Students_model::list('class');
        $data['action'] = __('新 增');

        $GLOBALS["select2"] = 1;
        $GLOBALS['datetimepicker'] = 1;
        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }
    

    
    public function edit($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);
        $data['id'] = $id;

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $id);
        $data['function'] = "edit";
        $data['years_list'] = Years_model::list();
        $data['services_list'] = Services_model::list();
        $data['staff_list'] = Staff_model::list();
        $data['module_order_list'] = Modules_model::order_list();
        $data['classes_list'] = Classes_model::list();
        $data['students_list'] = Students_model::list('class');

        $asg = Annual_service_groups_model::find($id);

        if (!$asg) {
            $_SESSION['error_msg'] = __('找不到頁面');
            redirect(admin_url('bk_'.$this->scope));
        }
        $data['year'] = Years_model::annual($asg->year_id);
        $data['subject'] = Subjects_model::name($asg->service_id);
        $data['module_order'] = Modules_model::order_list($asg->module_order);
        $data['group_name'] = $asg->group_name?$asg->group_name : Classes_model::name($asg->class_id);
        $data['staff1_id'] = $asg->staff1_id;
        $data['staff2_id'] = $asg->staff2_id;
        $data['class_id'] = $asg->class_id;
        $data['group_name_option'] = $asg->group_name ? "other" : "class";
        $other_staff_result = Annual_service_groups_other_staff_model::where('annual_service_group_id', $id)->pluck('staff_id')->toArray();
        $student_result = Annual_service_groups_students_model::where('annual_service_group_id', $id)->pluck('student_id')->toArray();

        $data['other_staff_id'] = json_encode($other_staff_result);

        $data['student_id'] = json_encode($student_result);


        $data['action'] = __('修 改');
        $GLOBALS["select2"] = 1;


        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }


    public function validate($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);
        // $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;
        // dump($_POST);
        $year_id = $_POST['year_id'];
        $service_id = $_POST['service_id'];
        $module_id = $_POST['module_id'];
        $staff1_id = $_POST['staff1_id'];
        $staff2_id = $_POST['staff2_id'];
        $other_staff_id = $_POST['other_staff_id'];
        $group_name = $_POST['group_name'];
        $class_id = $_POST['class_id'];
        $custom_group_name = $_POST['custom_group_name'];
        
        // Create
        if (!$id) {
            switch(true) {
                case (empty($service_id));
                $data = array(
                    'status' => '請選擇服務',
                    'id' => $id,
                );
                break;
                case (empty($module_id));
                $data = array(
                    'status' => '請選擇單元',
                );
                break;
                case (empty($group_name));
                $data = array(
                    'status' => '請選擇施教組別名稱',
                );
                break;
                case ($group_name);
                if ($group_name == "class") {
                    if (empty($class_id)) {
                        $data = array(
                            'status' => '請選擇施教組別名稱',
                        );
                        break;
                    }
                } else if ($group_name == "other") {
                    if (empty($custom_group_name)) {
                        $data = array(
                            'status' => '請選擇施教組別名稱',
                        );
                        break;
                    }
                }
            }

        }

        switch(true) {
            case (empty($staff1_id) || empty($staff2_id));
            $data = array(
                'status' => '請選擇主教老師',
            );
            break;
            case ($staff1_id == $staff2_id);
            $data = array(
                'status' => '主教老師重複',
            );
            break;
            default;
            $data = array(
                'status' => 'success',
            );
        } 
        
        echo json_encode($data);

    }

    public function preview($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        if (!$id) {
            $year_id = $_POST['year_id'];
            $service_id = $_POST['service_id'];
            $module_id = $_POST['module_id'];
        } else {
            $data['id'] = $id;
            $asg = Annual_service_groups_model::find($id);
            $year_id = $asg->year_id;
            $service_id = $asg->service_id;
            $module_id = array($asg->module_order);
        }

        $staff1_id = $_POST['staff1_id'];
        $staff2_id = $_POST['staff2_id'];
        $other_staff_id = $_POST['other_staff_id'];
        $class_id = $_POST['class_id'];
        $custom_group_name = $_POST['custom_group_name'];
        $group_name = $_POST['group_name'];
        $student_id = $_POST['student_id'];
        $previous = $_POST['action'];
        

        foreach ($module_id as $row) {
            $data['preview_modules'] .= '<button type="button" style="margin: 1px;" class="btn btn-success">'. Modules_model::order_list($row) .'</button>';
        }
    
        foreach ($other_staff_id as $row) {
            $data['preview_other_staff'] .= '<li>'.Staff_model::name($row) .'</li>';
        }

        $data['preview_year'] = Years_model::annual($year_id);
        $data['preview_service'] =Services_model::name($service_id);
        $data['preview_staff1'] = Staff_model::name($staff1_id);
        $data['preview_staff2'] = Staff_model::name($staff2_id);
        if ($id) {
            $asg = Annual_service_groups_model::find($id);
            $data['preview_group_name'] = $asg->group_name?$asg->group_name : Classes_model::name($asg->class_id);
            // $student_result = Students_model::classList($asg->class_id)->pluck('id')->toArray();
            
            foreach ($student_id as $student) {
                $class_name = Students_model::find($student)->class;
                $data['preview_students'] .= '<li>'. Students_model::name($student).' - '. $class_name. '</li>';
            }
        } else {
            if ($group_name == "class") {
                $data['preview_group_name'] = Classes_model::name($class_id);
                $student_result = Students_model::where('class', $data['preview_group_name'])->get();
                foreach ($student_result as $student) {
                    $data['preview_students'] .= '<li>'. Students_model::name($student->id).' - '.  $data['preview_group_name']. '</li>';
    
                }
            } else if ($group_name == 'other'){
                $data['preview_group_name'] = $custom_group_name;
                foreach ($student_id as $student) {
                    $data['preview_students'] .= '<li>'. Students_model::name($student).' - '. Students_model::find($student)->class. '</li>';
                } 
            }
        }
    
        $data['previous'] = $previous;
        $data['post_data'] = $_POST;
        $data['action'] = __('預 覽');

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'. $id );


        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    public function select_student($class_id){

        $result = Students_model::classList($class_id);

        foreach ($result as $student) {
            
            $list[] = array('id' => $student['id'], 'text' => $student->chinese_name);
        }
    
        echo json_encode($list);

    }

    public function submit_form($id = null){
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);
        

        $postData = json_decode($_POST['post_data']);
        // dump($postData);
        $year_id = $postData->year_id;
        $service_id = $postData->service_id;
        $module_order = $postData->module_id;
        $staff1_id = $postData->staff1_id;
        $staff2_id = $postData->staff2_id;
        $other_staff_id = $postData->other_staff_id;
        $class_id = $postData->class_id;
        $group_name = $class_id ? null : $postData->custom_group_name;
        $student_id = $postData->student_id;

        if ($id) {
            $asg = Annual_service_groups_model::find($id);
            $year_id = $asg->year_id;
            $service_id = $asg->service_id;
            $module_order = array($asg->module_order);
        }
        if (!$student_id && $class_id) {
            $student_id = Students_model::classList($class_id)->pluck('id')->toArray();
        }       

        foreach ($module_order as $row) {
            $data = array (
                'year_id' => $year_id,
                'service_id' => $service_id,
                'module_order' => $row,
                'class_id' => $class_id ? $class_id : null,
                'group_name' => $group_name ? $group_name: null,

            );
            $add_content = array (
                'staff1_id' => $staff1_id,
                'staff2_id' => $staff2_id,
                'updated_at' => date("Y-m-d"),
            );

            $annual_service_group_id = Annual_service_groups_model::updateOrCreate($data, $add_content)->id;
            if (!$id) {
            // Create
                foreach ($student_id as $student) {
                    $student_data = array(
                        'annual_service_group_id' => $annual_service_group_id,
                        'student_id' => $student,
                    );
                    Annual_service_groups_students_model::create($student_data);
                }

                foreach ($other_staff_id as $staff) {
                    $other_staff_data = array(
                        'annual_service_group_id' => $annual_service_group_id,
                        'staff_id' => $staff,
                    );
                    Annual_service_groups_other_staff_model::create($other_staff_data);
                }
            } else if ($id) {
                // Edit
                $new_staff_arr = $other_staff_id;
                $old_staff_arr = Annual_service_groups_other_staff_model::where('annual_service_group_id', $id)->pluck('staff_id')->toArray();
                sort($new_staff_arr);
                sort($old_staff_arr);
                $delete_staff = array_diff($old_staff_arr, $new_staff_arr);
                $add_staff = array_diff($new_staff_arr, $old_staff_arr);
                

                foreach ($delete_staff as $row) {
                    Annual_service_groups_other_staff_model::where('annual_service_group_id', $id)->where('staff_id', $row)->update(array('status' =>  0, 'deleted' => 1));
                };
                foreach ($add_staff as $row) {
                    $staff_data = array(
                        'annual_service_group_id' => $id,
                        'staff_id' => $row,
                    );
                    Annual_service_groups_other_staff_model::updateOrCreate($staff_data, array('status' => 1, 'deleted' => 0));
                };

                $new_student_arr = $student_id;
                $old_student_arr = Annual_service_groups_students_model::where('annual_service_group_id', $id)->pluck('student_id')->toArray();
                sort($new_student_arr);
                sort($old_student_arr);
                $delete_student = array_diff($old_student_arr, $new_student_arr);
                $add_student = array_diff($new_student_arr, $old_student_arr);

                foreach ($delete_student as $row) {
                    Annual_service_groups_students_model::where('annual_service_group_id', $id)->where('student_id', $row)->update(array('status' =>  0, 'deleted' => 1));
                };
                foreach ($add_student as $row) {
                    $student_data = array(
                        'annual_service_group_id' => $id,
                        'student_id' => $row,
                    );
                    Annual_service_groups_students_model::updateOrCreate($student_data, array('status' => 1, 'deleted' => 0));
                };
            }
        }

        $_SESSION['success_msg'] = __('新增年度科目分組 成功');
        redirect(admin_url('bk_'.$this->scope));
    }

}
