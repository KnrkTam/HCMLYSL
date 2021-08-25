<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class Bk_additional_content extends CI_Controller //change this
{
    private $scope = 'additional_content'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('補充內容 - 檢視'), //change this
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

        $data['subject_list'] = Subjects_model::list('All');
        $data['modules_list'] = Modules_model::list();

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $data['form_action'] = admin_url($data['page_setting']['controller']);

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }

    public function ajax(){
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;
        $subject_id = $_GET['subject_search'];
        $module_id = $_GET['module_search'];
        // dump($_GET);

        $intended_learning_outline = array();

        if ($module_id) {
            $intended_learning_outline = Subject_lessons_modules_model::search($year_id, $subject_id, $module_id, null, null);
        } else {
            $intended_learning_outline = Subject_lessons_modules_model::search($year_id, $subject_id, $module_id, null, null);

        }

        if ($intended_learning_outline) {
            foreach ($intended_learning_outline as $y => $subject_lesson_module_id) {
                $sub_ann_module = Subject_lessons_modules_model::find($subject_lesson_module_id);
                $subject_lesson = $sub_ann_module->subject_lesson;
                $lesson = $subject_lesson->lesson;
                $group_count = Lessons_group_model::id_list($lesson->id);
                // $group_id = $sub_ann_module->group_id;
                $subject_lesson_id = $subject_lesson->id;
                $lesson_id = $subject_lesson->lesson_id;
                $modules = Subject_lessons_modules_model::moduleList($subject_lesson_id, $year_id);
                // dump($sub_ann_module);
                // dump($modules);
                foreach ($group_count as $group_id => $group) {
                    $lessons_arr[] = array('lesson' => Lessons_model::table_list($lesson_id), 'subject_lesson_id' =>  $subject_lesson_id, 'subject_cat_id' => $subject_lesson->subject_category_id, 'subject_id' => $subject_lesson->subject_id, 'count' => $y, 'modules' => $modules, 'remarks' => Lessons_remarks_model::id_list($subject_lesson_id), 'group_id' => $group_id, 'additional_content' => $add_content, 'subject_lesson_module_id' => $subject_lesson_module_id);
                }
            }
        }
        // dump($lessons_arr);

        $result_count = count($lessons_arr);
        $data = array();
        $num = 0;
        if (!empty( $lessons_arr)) {
            foreach ($lessons_arr as $key => $row) {
                $lesson_performance = Key_performances_model::where('subject_lesson_id', $row['subject_lesson_id'])->get();
                foreach ($lesson_performance as $foo ) {
                    $modules = '';
                    $add_content_box = array();

                    foreach ($row['modules'] as $m => $module) {
                        $modules .=  '<button type="button" class="btn-xs btn btn-success badge">' .$module. '</button> &nbsp</br>';
                        // $add_content_box = Additional_contents_model::content($row['group_id'], $m, $row['subject_lesson_module_id']).'</p>';  
                        $add_content_box[] = $m;

                    }
            
                    $data[$num]['subject'] = Subjects_model::name($row['subject_id']);
                    $data[$num]['course'] = $row['lesson']['course'];
                    $data[$num]['sub_category'] = Subject_categories_model::name($row['subject_cat_id']);
                    $data[$num]['sb_obj'] = $row['lesson']['sb_obj'];
                    $data[$num]['element'] = $row['lesson']['element'];
                    $data[$num]['group'] = Groups_model::name($row['group_id']);
                    $data[$num]['lpf1'] = $row['lesson']['lpf_basic'];
                    $data[$num]['lpf2'] = $row['lesson']['lpf_advanced'];
                    $data[$num]['poas'] = $row['lesson']['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num]['skill'] = $row['lesson']['skills'];
                    $data[$num]['expected_outcome'] = $row['lesson']['expected_outcome'];
                    $add_box = "";
                    foreach ($add_content_box as $add_content) {
                        $add_box .= '<p class="text-blue"><strong class="text-black">'.Modules_model::name($add_content). ':</strong> &nbsp  '. Additional_contents_model::content($row['group_id'], $add_content, $row['subject_lesson_module_id']).'</p>';
                    }
                    $module_add_content = Additional_contents_model::where('subject_lessons_module_id', $row['subject_lesson_module_id'])->first();
                    $data[$num]['add_content'] =   $module_add_content ? $add_box : null;
                    $data[$num]['performance'] = $foo['performance'];
                    $data[$num]['module'] = $modules;
                    $data[$num]['id'] = $row['subject_lesson_module_id'];

                    $num++;
                }
            }
        }

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form');
        $data['action'] = __('新 增');

        $GLOBALS["select2"] = 1;
        $GLOBALS['datetimepicker'] = 1;
        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }

    public function edit($subject_lessons_modules_id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        $first_entry = Subject_lessons_modules_model::find($subject_lessons_modules_id);



        $subject_lesson_module = Subject_lessons_modules_model::where('year_id', $first_entry->year_id)->where('subject_lessons_id', $first_entry->subject_lessons_id)->first();
        
        if (!$subject_lesson_module || !$subject_lessons_modules_id) {
            $_SESSION['error_msg'] = __('不存在頁面');
            redirect(admin_url($data['page_setting']['controller']));
        } else if ($subject_lessons_modules_id == $subject_lesson_module->id){

        }else {
            redirect(admin_url($data['page_setting']['controller'].'/edit/'.$subject_lesson_module->id));
            // redirect(admin_url($data['page_setting']['controller'].'/edit/'.$subject_lesson_module->id));
        }



        $subject_lesson = $subject_lesson_module->subject_lesson;

        $subject = $subject_lesson->subject;
        $lesson = $subject_lesson->lesson;
        $modules = Subject_lessons_modules_model::moduleList($subject_lesson_module->subject_lessons_id, $subject_lesson_module->year_id);
        $groups = Lessons_group_model::where('lesson_id', $lesson->id)->pluck('group_id')->toArray();
        $add_contents = Additional_contents_model::where('subject_lessons_module_id', $subject_lesson_module->id)->pluck('content')->toArray();
        // dump($modules);
        // dump($groups);
        // dump($subject_lesson_module->id);
        $list = array();


        if (!empty($add_contents)) {
            foreach ($add_contents as $content) {
                if ($content){
                    $list[] = $content;
                } else {
                    $list[] = null;
                }
            }
            
            $data['add_content'] = $list;
            // dump( $data['add_content']);

        }
        $data['groups'] = $groups;

        $data['subject_lesson'] = $subject_lesson;
        $data['subject'] = $subject;
        $data['lesson'] = $lesson;
        $data['modules'] = $modules;
        $data['sb_obj'] = Sb_obj_model::name($lesson->sb_obj_id);
        $data['sub_category'] = Subject_categories_model::name($subject_lesson->subject_category_id);
        $data['key_performance'] = Key_performances_model::list($subject_lesson->id);
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $subject_lessons_modules_id  );
        $data['num'] = 0;
        $data['action'] = __('修 改');

        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }

    public function preview($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

       

        $subject_lesson_module = Subject_lessons_modules_model::find($id);

        if (!$subject_lesson_module || !$id) {
            $_SESSION['error_msg'] = __('不存在頁面');
            redirect(admin_url($data['page_setting']['controller']));
        }
        
   
        // dump($_POST);
        $subject_lesson = $subject_lesson_module->subject_lesson;

        $subject = $subject_lesson->subject;
        $lesson = $subject_lesson->lesson;
        $modules = Subject_lessons_modules_model::moduleList($subject_lesson_module->subject_lessons_id, $subject_lesson_module->year_id);
        $groups = Lessons_group_model::where('lesson_id', $lesson->id)->pluck('group_id')->toArray();
        $data['groups'] = $groups;
        $data['id'] = $id;
        $data['subject_lesson'] = $subject_lesson;
        $data['subject'] = $subject;
        $data['lesson'] = $lesson;
        $data['modules'] = $modules;
        $data['sb_obj'] = Sb_obj_model::name($lesson->sb_obj_id);
        $data['sub_category'] = Subject_categories_model::name($subject_lesson->subject_category_id);
        $data['key_performance'] = Key_performances_model::list($subject_lesson->id);
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form' );

        $data['action'] = __('預 覽');



        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    public function submit_form(){

        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);

        foreach ($_POST['module'] as $i => $module_id) {
            // $test_data = array(
            //     'group_id' => $_POST['group'][$i],
            //     'module_id' => $module_id,
            //     'subject_lessons_module_id' => $_POST['id'],

            // );

            
            // dump($test_data);
            // // dump($_POST['id']);
            // $primary_key = Additional_contents_model::where('group_id', $_POST['group'][$i])->where('module_id', $module_id)->where('subject_lessons_module_id', $_POST['id'])->whereNotNull('deleted')->toSQL();
            //     dump($primary_key);
            $data = array(
                'id' => $primary_key,
                'group_id' => $_POST['group'][$i],
                'module_id' => $module_id,
                'subject_lessons_module_id' => $_POST['id'],

            );

            if ($_POST['content'][$i]) {
                $add_content = array(
                    'content' => $_POST['content'][$i],
                    'deleted' => 0
                );
            } else {
                $add_content = array(
                    'content' => null,
                    'deleted' => 1
                );
            }
        
            Additional_contents_model::updateOrCreate($data, $add_content);
        }

        $_SESSION['success_msg'] = __('修改補充內容成功');
        redirect(admin_url('bk_'.$this->scope));
        
    }
}
