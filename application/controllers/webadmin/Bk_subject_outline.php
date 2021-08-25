<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_subject_outline extends CI_Controller //change this
{
    private $scope = 'subject_outline'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('科目課程大綱 - 檢視'), //change this
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

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        $data['subject_list'] = Subjects_model::list();
        $data['sub_categories_list'] = json_encode(Subject_categories_model::optionList('All')); 
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['sb_obj_id'] = $_POST['sb_obj_id'];
        $lesson_data = Lessons_model::list();

        foreach ($lesson_data as $row) {
            $lessons_list[$row['id']] = $row['code']; 
        }
        $data['lessons_list'] = $lessons_list;
        if (count($_POST)) {
            if(!$_POST['lesson_id']) {
                $data['subject_categories_id'] = $_POST['subject_category_id'];
                if (count($_POST['sb_obj_id'])){
                    $data['sb_obj_id'] = json_encode($_POST['sb_obj_id']);
                }
            } else {
                $data['lesson_id'] = json_encode($_POST['lesson_id']);
            }
        }
        $_SESSION['post_data'] = null;
        $_SESSION['path'] = null;

        $data['form_action'] = admin_url($data['page_setting']['controller']);


        $this->load->view('webadmin/' . $this->scope . '', $data);
    }

    public function ajax(){
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        $subject_id = $_POST['subject_search'];
        $sub_category_id = $_POST['category_search'];
        $sb_obj_id = $_POST['sb_obj_search'];
        $lesson_id = $_POST['lesson_search'];
        $lessons_arr = array();

        if ($subject_id) {
            $filtered_lessons = Lessons_model::subjectList($sub_category_id,$sb_obj_id, $lesson_id, $subject_id);
            foreach ($filtered_lessons as $i =>$row) {
                $lessons_arr[$i] = array('lesson' => Lessons_model::table_list($row['id']), 'subject_lesson_id' => $row['sub_lesson_id'], 'subject_cat_id' => Subject_lessons_model::find($row['sub_lesson_id'])->subject_category_id,  'remarks' => Lessons_remarks_model::id_list($row['sub_lesson_id']));
            }
        }

        $result_count = count($lessons_arr);
        //rearrange data
        $data = array();
        $name = array();
        $num = 0;
        if (!empty( $lessons_arr)) {    
            foreach ( $lessons_arr as $key => $row) {
                if ($subject_id) {
                    $subject_lesson_id = Subject_lessons_model::find($row['subject_lesson_id'])->id;
                } else {
                    $subject_lesson_id = Subject_lessons_model::where('lesson_id', $row['id'])->first()->id;
                    $subject_id = Subject_lessons_model::where('lesson_id', $row['id'])->first()->subject_id;
                }

                $lesson_performance = Key_performances_model::where('subject_lesson_id', $subject_lesson_id)->get();
                foreach ($lesson_performance as $foo ) {
                    $data[$num][] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. $subject_lesson_id) .'"><i class="fa fa-edit"></i></a>';
                    $data[$num]['subject_cat'] = $row['subject_cat_id'] ? Subject_categories_model::name($row['subject_cat_id']) : "not yet assigned";
                    $data[$num]['code'] = $row['lesson']['code'];
                    $data[$num]['course'] = $row['lesson']['course'];
                    $data[$num]['category'] = $row['lesson']['category'];
                    $data[$num]['sb_obj'] = $row['lesson']['sb_obj'];
                    $data[$num]['element'] = $row['lesson']['element'];
                    $data[$num]['group'] = $row['lesson']['groups'];
                    $data[$num]['lpf_basic'] = $row['lesson']['lpf_basic'];
                    $data[$num]['lpf_advanced'] = $row['lesson']['lpf_advanced'];
                    $data[$num]['poas'] = $row['lesson']['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num]['skill'] = $row['lesson']['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num]['expected_outcome'] = $row['lesson']['expected_outcome'];
                    $data[$num]['performance'] = $foo['performance'];
                    $data[$num]['assessment'] = Assessments_model::mode($foo['assessment_id']);
                    $rel_les = '';
                    foreach ($row['lesson']['rel_lessons'] as $key) {
                        $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                    }
                    $data[$num]['relevant_lessons'] = $rel_les;
                    $data[$num]['relevant_code'] = '相關項目編號';
                    $remarks = '';
                    foreach ($row['remarks'] as $remark) {
                        $remarks .=  '<button type="button" class="btn-xs btn btn-primary badge">' .Remarks_model::name($remark).'</button> &nbsp';
                    }
                    $data[$num]['remarks'] = $remarks;
                    $num++;
                }
            }
        }
        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function create($subject_id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);
        $subject = Subjects_model::find($subject_id);

        if (!$subject) {
            $_SESSION['error_msg'] = __('找不到相關科目');
            redirect(admin_url('bk_'.$this->scope));
        }
        $data['action'] = __('新 增');
        $data['function'] = "create";
        $data['assessments_list'] = Assessments_model::list();
        $data['lessons_list'] = Lessons_model::newlist2($subject_id);
        $data['remarks_list'] = Remarks_model::list();
        $data['expected_outcome'] = $subject->expected_outcome;
        $data['subject_cat_list'] = Subject_categories_model::list($subject_id, null, 'newlist');
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');
        $data['subject_id'] = $subject_id;
        $data['subject'] = Subjects_model::name($subject_id);
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }

    public function select_lesson()
    {
        $id = $this->input->post('lesson_id');

        $data = Lessons_model::find($id);

        echo json_encode($data);

    }

    public function select_subject()
    {
        $id = $this->input->post('subject_id');

        $data = Subjects_model::find($id);

        echo json_encode($data);

    }
    

    public function edit($subject_lesson_id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);
        $data['action'] = __('更 改');

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $subject_lesson = Subject_lessons_model::find($subject_lesson_id);
        $lesson_id = $subject_lesson->lesson_id;
        $subject_id = $subject_lesson->subject_id;
        
        $subject_cat_id = $subject_lesson->subject_category_id;
        $lesson = Lessons_model::find($lesson_id);

        $performance_model = Key_performances_model::where('subject_lesson_id', $subject_lesson_id)->get();

        foreach ($performance_model as $i => $row) {
            $performance_arr[$i] = array('performance' => $row['performance'], 'assessment' => $row['assessment_id'], 'other' =>$row['assessment_other']);
        }
    
        $lesson = Lessons_model::find($lesson_id);
        $data['subject_list'] = Subjects_model::list();
        $data['subject_cat_list'] = Subject_categories_model::list(null, 'all');
        // $data['courses_list'] = Courses_model::list();
        $lesson_data = Lessons_model::list();;
        foreach ($lesson_data as $row) {
            $lessons_list[$row['id']] = $row['code']; 
        }
        $data['lessons_list'] = $lessons_list;        
        $data['assessments_list'] = Assessments_model::list();
        $data['remarks_list'] = Remarks_model::list();
        $data['remark_id'] =  Lessons_remarks_model::id_list($subject_lesson_id);
        $data['subject'] = Subjects_model::name($subject_id);
        $data['performance_arr'] = $performance_arr;
        $data['subject_id'] = $subject_id;
        $data['subject_cat_id'] = $subject_cat_id;
        $data['lesson_id'] = $lesson_id ;
        $data['expected_outcome'] = $lesson->expected_outcome;
        $data['return'] = $_SERVER['HTTP_REFERER'];

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $subject_lesson_id);

        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }


    public function select_subject_cat()
    {
        $id = $_POST['subject_cat_id'];
        $list = array();

        $existing_arr = Subject_lessons_model::where('subject_category_id', $id)->pluck('id')->unique();
        $existing_key_performance = Key_performances_model::whereIn('subject_lesson_id', $existing_arr)->pluck('subject_lesson_id')->unique();
        $cat_lessons = Subject_lessons_model::where('subject_category_id', $id)->whereNotIn('id', $existing_key_performance)->pluck('lesson_id')->unique();


        foreach ($cat_lessons as $i => $row) {
            $list[$i] = array('id' => $row, 'text' => Lessons_model::code($row));
        }

        $data = $list;
        echo json_encode($data);
    }



    public function preview($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);

        $postData = $this->input->post();
        $subject_id = $postData['subject_id'];

        $previous = $postData['action'];
        if (!$id) {
            $id = Subject_lessons_model::where('subject_id', $subject_id)->where('lesson_id', $postData['lesson_id'])->first()->id;
            $data['subject_id'] = $subject_id;
            if (!$postData['lesson_id']) {
                $_SESSION['error_msg'] = __('請選擇課程編號');
                redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$subject_id));
            }
        }

            
        $subject_lesson = Subject_lessons_model::find($id);
        $subject = Subjects_model::name($subject_lesson->subject_id);
        $lesson = Lessons_model::code($subject_lesson->lesson_id);

        foreach ($postData['remark_id'] as $i => $row) {
            $remark[$i] = Remarks_model::name($row);
        }

        
        foreach ($postData['performance'] as $i => $row) {
            $performance[$i] = array('performance' => $row, 'assessment' => $postData['assessment_id'][$i], 'other' => $postData['assessment_other_field'][$i]);

            foreach ($performance as $set) {
                if ($set['assessment'] == null) {
                    $_SESSION['error_msg'] = __('請確定已選擇所有評估模式');
                    redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id ));
                } else if ($set['assessment'] == 'other') {
                    if ($set['other'] == null) {
                        $_SESSION['error_msg'] = __('請輸入其他評估模式');
                        redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id ));
                    }
                }
            }
        }
        $data['assessments_list'] = Assessments_model::list();

        $data['subject'] = $subject;
        $data['lesson'] = $lesson;
        $data['remark'] = $remark;
        $data['performance'] = $performance;
        $data['remark_ids'] = $postData['remark_id'];
        $data['previous'] = $previous;
        $data['id'] = $id;
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'. $id);
        $_SESSION['post_data'] = $postData;

        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    public function submit_form($id = null){
        $postData = $this->input->post();

        $subject_lessons = Subject_lessons_model::find($id);

        $performance = json_decode($postData['performance'][0], true);
        $remark_id = json_decode($postData['remark_id'][0],true);
        $lesson_id = $subject_lessons->lesson_id;


        if ($performance) {
            Key_performances_model::where('subject_lesson_id', $id)->delete();
        }
        if ($remark_id) {
            Lessons_remarks_model::where('lesson_id', $lesson_id)->delete();
        }
        foreach ($performance as $row) {
            $performance_data =  array(
                'performance' => $row['performance'],
                'assessment_id' => $row['assessment'],
                'assessment_other' => $row['other'],
                'subject_lesson_id' => $id,
                'created_by' => $_SESSION['sys_user_id'],
            );
            Key_performances_model::create($performance_data);
        }

        foreach ($remark_id as $row) {
            $lessons_remarks_data =  array(
                'lesson_id' => $lesson_id,
                'subject_lesson_id' => $id,
                'remark_id' => $row,
                'created_by' => $_SESSION['sys_user_id'],
            );
            Lessons_remarks_model::create($lessons_remarks_data);
        }


        $_SESSION['success_msg'] = __('修改科目課程大綱成功');
        if ($_SESSION['path'] == 'subjects_map') {
            redirect(admin_url('bk_subjects_map'));
        }
        redirect(admin_url('bk_'.$this->scope));
    }
}
