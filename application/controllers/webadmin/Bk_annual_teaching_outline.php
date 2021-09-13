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

        $annual_module = Annual_modules_model::where('year_id', $asg->year_id)->where('level_id', $asg->level_id)->where('class_id', $asg->class_id)->where('module_order', $asg->module_order)->first();
        $data['function'] = "create";

        $data['module_id'] = $annual_module->module_id ? $annual_module->module_id : null;
        $module_week = Modules_week_model::where('year_id', $asg->year_id)->where('level_id', $asg->level_id)->first();
        $data['week_from'] = $module_week['week_from_'.$asg->module_order];
        $data['week_to'] = $module_week['week_to_'.$asg->module_order];
        // dump($module_week['week_from_'.$asg->module_order]);
        // dump($module_week['week_to_'.$asg->module_order]);

        // dump( $data['week_from']);
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $annual_subject_group_id);

        $data['function'] = "create";
        $data['year_id'] = $asg->year_id;
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
        $GLOBALS["datatable"] = 1;
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

    public function search_ajax() 
    {
        // $postData = $this->input->post();
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $module_id = $_GET['module_id']; 
        $year_id = $_GET['year_id'];
        // dump($_GET);

        if ($module_id) {
            $intended_learning_outline = Subject_lessons_modules_model::search($year_id, null, $module_id, null, null);

            if ($intended_learning_outline) {
                foreach ($intended_learning_outline as $y => $subject_lesson_module_id) {
                    $sub_ann_module = Subject_lessons_modules_model::find($subject_lesson_module_id);
                    $subject_id = $sub_ann_module->subject_id;
                    $subject_lesson = $sub_ann_module->subject_lesson;
                    $lesson = Lessons_model::find($subject_lesson->lesson_id);
                    $lesson_id = $lesson->id;
                    $group_count = Lessons_group_model::id_list($lesson->id);
                    $subject_lesson_id = $subject_lesson->id;
    
                    foreach ($group_count as $group_id => $group) {
                        $lessons_arr[] = array('lesson' => Lessons_model::table_list($lesson_id), 'subject_lesson_id' =>  $subject_lesson_id, 'subject_cat_id' => $subject_lesson->subject_category_id, 'subject_id' => $subject_lesson->subject_id, 'count' => $y, 'modules' =>  Subject_lessons_modules_model::moduleList($subject_lesson_id, $year_id), 'remarks' => Lessons_remarks_model::id_list($subject_lesson_id), 'group_id' => $group_id, 'additional_content' => $add_content, 'subject_lesson_module_id' => $subject_lesson_module_id);
                    }                
                }
            }
        }
        // dump(count($lessons_arr));
        $result_count = count($lessons_arr);
        //rearrange data
        $data = array();
        $num = 0;
        
        
        if (!empty( $lessons_arr)) {  
            // dump($lessons_arr);  
            foreach ($lessons_arr as $key => $row) {
                $lesson_performance = Key_performances_model::where('subject_lesson_id', $row['subject_lesson_id'])->get();
                foreach ($lesson_performance as $i => $foo ) {
                    $add_content_box = array();
                    foreach ($row['modules'] as $m => $module) {
                        $add_content_box[] = $m;

                    }
                    // $data[$num]['id'] = '<input type="checkbox" class="addLesson" value="'.$row['subject_lesson_id'].'"/>';
                    // '<a class="editLinkBtn" href="#" data-id="'.$row['id'].'" data-subject_lesson="'.$row['subject_lesson_id'].'"
                    $data[$num]['id'] = '<input type="checkbox" class="addLesson"s data-group="'.$row['group_id'].'"  data-key_performance="'.$foo['id'].'" value="'.$row['subject_lesson_id'].'"/>';
                    $data[$num]['subject'] = Subjects_model::name($row['subject_id']);
                    $data[$num]['course'] = $row['lesson']['course'];
                    $data[$num]['category'] = $row['lesson']['category'];
                    $data[$num]['sb_obj'] = $row['lesson']['sb_obj'];
                    $data[$num]['element'] = $row['lesson']['element'];
                    $data[$num]['group'] =  Groups_model::name($row['group_id']);
                    $data[$num]['expected_outcome'] = $row['lesson']['expected_outcome'];
                    $add_box = "";
                    foreach ($add_content_box as $add_content) {
                        $add_box .= '<p class="text-blue"><strong class="text-black">'.Modules_model::name($add_content). ':</strong> &nbsp  '. Additional_contents_model::content($row['group_id'], $add_content, $row['subject_lesson_module_id']).'</p>';
                    }
                    $module_add_content = Additional_contents_model::where('subject_lessons_module_id', $row['subject_lesson_module_id'])->first();
                    $data[$num]['addon'] =   $module_add_content ? $add_box :null;
                    $data[$num]['performance'] = $foo['performance'];
                    $data[$num]['assessment'] = Assessments_model::mode($foo['assessment_id']);
                    $data[$num]['code'] = $row['lesson']['code'];
                    $data[$num]['related_lesson'] = $row['lesson']['expected_outcome'];
                    $data[$num]['rel_code'] = $row['lesson']['rel_code'];
                    $remarks = '';
                    foreach ($row['remarks'] as $remark) {
                        $remarks .=  '<button type="button" class="btn-xs btn btn-primary badge">' .Remarks_model::name($remark).'</button> &nbsp';
                    }
                    $data[$num]['remarks'] = $remarks;
                    $num++;
                }
            }
        }
        // dump(count($lesson_arr));

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function preview($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        $asg = Annual_subject_groups_model::find($id);

        $data['year'] = Years_model::annual($asg->year_id);
        $data['subject'] = Subjects_model::name($asg->subject_id);
        $data['group_name'] = $asg->group_name ? $asg->group_name  : Classes_model::name($asg->class_id);
        $data['module'] = Modules_model::order_list($asg->module_order);
        $module_week = Modules_week_model::where('year_id', $asg->year_id)->where('level_id', $asg->level_id)->first();
        $data['week_from'] = $module_week['week_from_'.$asg->module_order];
        $data['week_to'] = $module_week['week_to_'.$asg->module_order];
        $data['annual_module'] = $_POST['annual_module_id'] == 0 ? '不適用' : Modules_model::name($_POST['annual_module_id']);
        // if (!$id) {
        //     $year_id = $_POST['year_id'];
        //     $subject_id = $_POST['subject_id'];
        //     $module_id = $_POST['module_id'];
        // } else {
        //     $data['id'] = $id;
        //     $asg = Annual_subject_groups_model::find($id);
        //     $year_id = $asg->year_id;
        //     $subject_id = $asg->subject_id;
        //     $module_id = array($asg->module_order);
        // }
        dump($_POST);

        // $staff1_id = $_POST['staff1_id'];
        // $staff2_id = $_POST['staff2_id'];
        // $other_staff_id = $_POST['other_staff_id'];
        // $class_id = $_POST['class_id'];
        // $custom_group_name = $_POST['custom_group_name'];
        // $group_name = $_POST['group_name'];
        // $student_id = $_POST['student_id'];
        // $level_id = $_POST['level_id'] ? $_POST['level_id']: Classes_model::level($class_id);

        $previous = $_POST['action'];
        
        foreach ($module_id as $row) {
            $data['preview_modules'] .= '<button type="button" style="margin: 1px;" class="btn btn-success">'. Modules_model::order_list($row) .'</button>';
        }
    
        foreach ($other_staff_id as $row) {
            $data['preview_other_staff'] .= '<li>'.Staff_model::name($row) .'</li>';
        }

        // $data['preview_year'] = Years_model::annual($year_id);
        // $data['preview_subject'] =Subjects_model::name($subject_id);
        // $data['preview_staff1'] = Staff_model::name($staff1_id);
        // $data['preview_staff2'] = Staff_model::name($staff2_id);
        // $data['preview_level'] = Levels_model::name($level_id);

        // if ($id) {
        //     $asg = Annual_subject_groups_model::find($id);
        //     $data['preview_group_name'] = $asg->group_name?$asg->group_name : Classes_model::name($asg->class_id);
        //     // $student_result = Students_model::classList($asg->class_id)->pluck('id')->toArray();
            
        //     foreach ($student_id as $student) {
        //         $class_name = Students_model::find($student)->class;
        //         $data['preview_students'] .= '<li>'. Students_model::name($student).' - '. $class_name. '</li>';
        //     }
        // } else {
        //     if ($group_name == "class") {
        //         $data['preview_group_name'] = Classes_model::name($class_id);
        //         $student_result = Students_model::where('class', $data['preview_group_name'])->get();
        //         foreach ($student_result as $student) {
        //             $data['preview_students'] .= '<li>'. Students_model::name($student->id).' - '.  $data['preview_group_name']. '</li>';
    
        //         }
        //     } else if ($group_name == 'other'){
        //         $data['preview_group_name'] = $custom_group_name;
        //         foreach ($student_id as $student) {
        //             $data['preview_students'] .= '<li>'. Students_model::name($student).' - '. Students_model::find($student)->class. '</li>';
        //         } 
        //     }
        // }
    
        $data['previous'] = $previous;
        $data['post_data'] = $_POST;
        $data['action'] = __('預 覽');

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'. $id );


        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }
}
