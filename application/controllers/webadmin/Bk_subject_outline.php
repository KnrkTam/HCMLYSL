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
        $data['courses_list'] = Courses_model::list();
        $data['categories_list'] = Categories_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['lessons_list'] = Lessons_model::list();
        array_unshift($data['courses_list'], "所有課程");
        array_unshift($data['categories_list'], "所有課程");

        $_SESSION['post_data'] = null;

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }

    public function ajax(){
        // $postData = $this->input->post();
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        $subject_id = $_GET['subject_search'];
        $course_id = $_GET['course_search'];
        $category_id = $_GET['category_search'];
        $sb_obj_id = $_GET['sb_obj_search'];
        $lesson_id = $_GET['lesson_search'];
        $lessons_arr = array();

        if ($subject_id) {
            $filtered_lessons = Lessons_model::list($course_id, $category_id,$sb_obj_id, $lesson_id, $subject_id);
            foreach ($filtered_lessons as $i =>$row) {
                $lessons_arr[$i] = Lessons_model::table_list($i);
            }
        } else {
            $lessons_arr = null;
        }
        
        $result_count = count($lessons_arr);

        //rearrange data
        $data = array();
        $name = array();
        $num = 0;
        if (!empty( $lessons_arr)) {
            foreach ( $lessons_arr as $key => $row) {
                $subject_lesson_id = Subject_lessons_model::where('subject_id', $subject_id)->where('lesson_id', $row['id'])->first()->id;
                $lesson_performance = Key_performances_model::where('subject_lesson_id', $subject_lesson_id)->get();
                foreach ($lesson_performance as $foo ) {
                    $data[$num][] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. $subject_lesson_id ).'"><i class="fa fa-edit"></i></a>';
                    $data[$num][] = Subjects_model::name($subject_id);
                    $data[$num][] = $row['course'];
                    $data[$num][] = $row['category'];
                    $data[$num][] = $row['sb_obj'];
                    $data[$num][] = $row['element'];
                    $data[$num][] = $row['groups'];
                    $data[$num][] = $row['lpf_basic'];
                    $data[$num][] = $row['lpf_advanced'];
                    $data[$num][] = $row['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num][] = $row['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num][] = $row['expected_outcome'];
                    $data[$num][] = $foo['performance'];
                    $data[$num][] = Assessments_model::mode($foo['assessment_id']);
                    $data[$num][] = $row['code'];
                    $rel_les = '';
                    foreach ($row['rel_lessons'] as $key) {
                        $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                    }
                    $data[$num][] = $rel_les;
                    $data[$num][] = '相關項目編號';
                    $data[$num][] = 'remark';
                    $num++;
                }
            }
        }
        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function create($subject_id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);

        $data['action'] = __('新 增');
        $data['function'] = "create";
        $data['subject_list'] = Subjects_model::list();
        $data['categories_list'] = Categories_model::list();
        $data['assessments_list'] = Assessments_model::list();
        $data['lessons_list'] = Lessons_model::newlist($subject_id);
        $data['remarks_list'] = Remarks_model::list();

        array_unshift($data['courses_list'], "所有課程");
        array_unshift($data['categories_list'], "所有課程");
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');
        $data['subject_id'] = $subject_id;
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
    

    public function edit($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);
        $data['action'] = __('更 改');

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $subject_lesson = Subject_lessons_model::find($id);
        $lesson_id = $subject_lesson->lesson_id;
        $subject_id = $subject_lesson->subject_id;

        $performance_model = Key_performances_model::where('subject_lesson_id', $id)->get();

        foreach ($performance_model as $i => $row) {
            $performance_arr[$i] = array('performance' => $row['performance'], 'assessment' => $row['assessment_id'], 'other' =>$row['assessment_other']);
        }
    
        $lesson = Lessons_model::find($lesson_id);
        $data['subject_list'] = Subjects_model::list();
        $data['lessons_list'] = Lessons_model::list();
        $data['assessments_list'] = Assessments_model::list();
        $data['remarks_list'] = Remarks_model::list();
        $data['remark_id'] =  Lessons_remarks_model::id_list($lesson_id);

        $data['performance_arr'] = $performance_arr;
        $data['subject_id'] = $subject_id;
        $data['lesson_id'] = $lesson_id ;
        $data['expected_outcome'] = $lesson->expected_outcome;

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $id);

        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }



    public function preview($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);

        $postData = $this->input->post();
        $previous = $postData['action'];
        if (!$id) {
            dump($postData);
            $id = Subject_lessons_model::where('subject_id', $postData['subject_id'])->where('lesson_id', $postData['lesson_id'])->first()->id;

            if (!$postData['lesson_id']) {
                $_SESSION['error_msg'] = __('請選擇課程編號');
                redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id ));
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
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'.$id);


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
                'remark_id' => $row,
                'created_by' => $_SESSION['sys_user_id'],
            );
            Lessons_remarks_model::create($lessons_remarks_data);
        }


            $_SESSION['success_msg'] = __('修改科目課程大綱成功');
            redirect(admin_url('bk_'.$this->scope));

    }


}
