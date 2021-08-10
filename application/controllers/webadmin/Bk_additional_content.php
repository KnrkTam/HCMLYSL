<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

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
        $module_id_arr = $_GET['module_search'];
        // $category_id = $_GET['category_search'];
        // $remark_ids = $_GET['remark_search'];
        $intended_learning_outline = array();

        if ($module_id_arr) {
            foreach ($module_id_arr as $x => $module_id) {
                $arr = Subject_lessons_modules_model::search($year_id, $subject_id, $module_id, null, null);
                foreach ($arr as $id) {
                    array_push($intended_learning_outline, $id);
                }
            }
        }

        // dump($intended_learning_outline);

        if ($intended_learning_outline) {
            foreach ($intended_learning_outline as $y => $subject_lesson_module_id) {
                $sub_ann_module = Subject_lessons_modules_model::find($subject_lesson_module_id);
                $add_content = $sub_ann_module->additional_content;
                // dump($add_content);
                $group_id = $sub_ann_module->group_id;
                $subject_lesson = Subject_lessons_model::find($sub_ann_module->subject_lessons_id);
                $subject_lesson_id = $subject_lesson->id;
                $lesson_id = $subject_lesson->lesson_id;
                $lessons_arr[$y] = array('lesson' => Lessons_model::table_list($lesson_id), 'subject_lesson_id' =>  $subject_lesson_id, 'subject_cat_id' => $subject_lesson->subject_category_id, 'subject_id' => $subject_lesson->subject_id, 'count' => $y, 'modules' => Subject_lessons_modules_model::moduleList($subject_lesson_id, $year_id), 'remarks' => Lessons_remarks_model::id_list($subject_lesson_id), 'group_id' => $group_id, 'additional_content' => $add_content);
            }
        }

        // dump($lessons_arr);

        // dump($lessons_arr);
        $result_count = count($lessons_arr);
        $data = array();
        $num = 0;
        if (!empty( $lessons_arr)) {
            foreach ($lessons_arr as $key => $row) {
                $lesson_performance = Key_performances_model::where('subject_lesson_id', $row['subject_lesson_id'])->get();
                foreach ($lesson_performance as $foo ) {
                    // $data[$num][] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. $row['subject_lesson_id'] ).'"><i class="fa  fa-search"></i></a>';
                    $data[$num][] = Subjects_model::name($row['subject_id']);
                    // $data[$num][] = Subject_categories_model::name($row['subject_cat_id']);
                    // $data[$num][] = $row['lesson']['code'];
                    $data[$num][] = $row['lesson']['course'];
                    $data[$num][] = $row['lesson']['category'];
                    $data[$num][] = $row['lesson']['sb_obj'];
                    $data[$num][] = $row['lesson']['element'];
                    $data[$num][] = Groups_model::name($row['group_id']);
                    $data[$num][] = $row['lesson']['lpf_basic'];
                    $data[$num][] = $row['lesson']['lpf_advanced'];
                    $data[$num][] = $row['lesson']['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num][] = $row['lesson']['skills'];
                    $data[$num][] = $row['lesson']['expected_outcome'];
                    $modules = '';
                    foreach ($row['modules'] as $module) {
                        $modules .=  '<button type="button" class="btn-xs btn btn-success badge">' .$module. '</button> &nbsp</br>';
                    }
                    $data[$num][] = $row['additional_content'];

                    $data[$num][] = $foo['performance'];
                    // $remarks = '';
                    // foreach ($row['remarks'] as $remark) {
                    //     $remarks .=  '<button type="button" class="btn-xs btn btn-primary badge">' .Remarks_model::name($remark).'</button> &nbsp';
                    // }
                    $data[$num][] = $modules;

                    // $data[$num][] = $remarks;

                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;
                    // $data[$num][] = $row;

                    $num++;
                }
            }
        }
        // dump($result_count);

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);

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
