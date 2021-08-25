<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_subject_outcome extends CI_Controller //change this
{
    private $scope = 'subject_outcome'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('科目預期學習成果 - 檢視'), //change this
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
        $data['courses_list'] = Courses_model::list('All');
        $data['subject_categories_list'] = json_encode(Subject_categories_model::optionList('All')); 
        $data['sb_obj_list'] = Sb_obj_model::list();
        $lesson_data = Lessons_model::list();

        foreach ($lesson_data as $row) {
            $lessons_list[$row['id']] = $row['code']; 
        }

        $data['lessons_list'] = $lessons_list;

        // dump($lessons_list);

        // dump(Lessons_model::list());
        if (count($_POST)) {
            if (!$_POST['subject_id']) {
                $_SESSION['error_msg'] = __('請選擇科目');
                redirect(admin_url('bk_'.$this->scope));
            } else {
                if(!$_POST['lesson_id']) {
                    $data['subject_categories_id'] = $_POST['subject_category_id'];
                    if (count($_POST['sb_obj_id'])){
                        $data['sb_obj_id'] = json_encode($_POST['sb_obj_id']);
                    }
                } else {
                    $data['lesson_id'] = json_encode($_POST['lesson_id']);
                }
            }
        }

        $_SESSION['post_data'] = null;
        $_SESSION['path'] = null;


        $data['form_action'] = admin_url($data['page_setting']['controller']);

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }



    public function ajax(){
        // $postData = $this->input->post();
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $subject_id = $_GET['subject_search'];
        $category_id = $_GET['category_search'];
        $sb_obj_id = $_GET['sb_obj_search'];
        $lesson_id = $_GET['lesson_search'];
        // dump($_GET);

        $lessons_arr = array();
        if ($subject_id) {
            $filtered_lessons = Lessons_model::subjectList($category_id, $sb_obj_id, $lesson_id, $subject_id);
            // dump($filtered_lessons);
            foreach ($filtered_lessons as $i => $row) {
                $lessons_arr[$i]  = array('lesson' => Lessons_model::table_list($row['id']), 'subject_lesson_id' => $row['sub_lesson_id'], 'subject_cat_id' => Subject_lessons_model::find($row['sub_lesson_id'])->subject_category_id);
            }
        } 
        
        $result_count = count($lessons_arr);

        $data = array();
        $num = 0;
        if (!empty( $lessons_arr)) {
            foreach ($lessons_arr as $row) {
                // dump($row); 
                $data[$num]['edit'] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. Subject_lessons_model::where('subject_category_id',$row['subject_cat_id'] )->first()->id).'"><i class="fa fa-exchange"></i></a>';
                $data[$num]['sub_cat'] = Subject_categories_model::name($row['subject_cat_id']);
                $data[$num]['course'] = $row['lesson']['course'];
                // $data[$num][] = $row['lesson']['central_obj'];
                $data[$num]['sb_obj'] = $row['lesson']['sb_obj'];
                $data[$num]['element'] = $row['lesson']['element'];
                $data[$num]['groups'] = $row['lesson']['groups'];
                $data[$num]['lpf_basic'] = $row['lesson']['lpf_basic'];
                $data[$num]['lpf_advanced'] = $row['lesson']['lpf_advanced'];
                $data[$num]['poas'] = $row['lesson']['poas'] ? $row['lesson']['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>': "&nbsp";
                $data[$num]['skills'] = $row['lesson']['skills'] ? $row['lesson']['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>': "&nbsp";
                if ($row['lesson']['preliminary_skill'] == "1") { 
                    $data[$num]['pre-skills'] = '<p><span class="text-green"><i class="fa fa-check"></i></span></p>';
                } else {
                    $data[$num]['pre-skills'] = '<p><span class="text-red"><i class="fa fa-close"></i></span></p>';
                }
                $data[$num]['expected_outcome'] = $row['lesson']['expected_outcome'];
                $data[$num]['code'] = $row['lesson']['code'];
                $rel_les = '';
                foreach ($row['lesson']['rel_lessons'] as $foo) {
                    $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($foo).'</button> &nbsp';
                }
                $data[$num]['rel_les'] = $rel_les;

                $num++;
            }
        }
        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count, "subject_id" => $subject_id));

        echo $return;

    }

    
    public function search_ajax() 
    {
                // $postData = $this->input->post();
                $data['page_setting'] = $this->page_setting(array(
                    'view_'. $this->scope,
                ), FALSE, TRUE);
        
                $course_id = $_GET['course_search'];
                $category_id = $_GET['category_search'];
                $sb_obj_id = $_GET['sb_obj_search'];
                $lesson_id = $_GET['lesson_search'];
                $subject_id = $_GET['subject_search'];
                $offset = (int)$_GET['start'];
                $pagination = (int)$_GET['length'];


                $searched_lessons = Lessons_model::list($course_id, $category_id, $sb_obj_id, $lesson_id);

                $filtered_lessons = array_slice($searched_lessons, $offset, $pagination);

                // pagination
                $result_count = count($searched_lessons);

                $lessons_arr = array();

                foreach ($filtered_lessons as $row) {
                    $lessons_arr[$row['id']] = Lessons_model::table_list($row['id']);
                }

                //rearrange data
                $data = array();
                $num = 0;
                if (!empty( $lessons_arr)) {
                    foreach ($lessons_arr as $key => $row) {
                        $data[$num]['edit'] = '<input type="checkbox" class="addLesson" value="'.$row['id'].'"/>';
                        $data[$num]['course'] = $row['course'];
                        $data[$num]['category'] = $row['category'];
                        $data[$num]['sb_obj'] = $row['sb_obj'];
                        $data[$num]['element'] = $row['element'];
                        $data[$num]['groups'] = $row['groups'];
                        $data[$num]['lpf_basic'] = $row['lpf_basic'];
                        $data[$num]['lpf_advanced'] = $row['lpf_advanced'];
                        $data[$num]['poas'] = $row['poas'] ? $row['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>': null ;
                        $data[$num]['skills'] = $row['skills'] ? $row['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>': null;
                        if ($row['preliminary_skill'] == "1") { 
                            $data[$num]['pre-skills'] = '<p><span class="text-green"><i class="fa fa-check"></i></span></p>';
                        } else {
                            $data[$num]['pre-skills'] = '<p><span class="text-red"><i class="fa fa-close"></i></span></p>';
                        }                        
                        $data[$num]['code'] = $row['code'];
                        $data[$num]['expected_outcome'] = $row['expected_outcome'];
                        $rel_les = '';
                        foreach ($row['rel_lessons'] as $key) {
                            $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                        }
                        $data[$num]['rel_les'] = $rel_les;                        
                        $num++;
                    }
                }
                $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));
                echo $return;
    }

    public function select_ajax() 
    {
                $data['page_setting'] = $this->page_setting(array(
                    'view_'. $this->scope,
                ), FALSE, TRUE);
        
                $added_ids = $_GET['added_ids'];
                if ($added_ids) {
                    $selected_lessons = Lessons_model::list(null, null, null, $added_ids);
                    $lessons_arr = array();
                    foreach ($selected_lessons as $i =>$row) {
                        $lessons_arr[$row['id']] = Lessons_model::table_list($row['id']);
                    }
            
                    $result_count = count($lessons_arr);
                }

                //rearrange data
                $data = array();
                $num = 0;
                if (!empty( $lessons_arr)) {
                    foreach ( $lessons_arr as $key => $row) {
                        $data[$num]['edit'] = '<a class="removeRow text-red" name="subject_lessons['.$key.']" value="'.$row['id'] .'"><i class="fa fa-fw fa-trash-o"></i></a>';
                        $data[$num]['course'] = $row['course'];
                        $data[$num]['category'] = $row['category'];
                        $data[$num]['sb_obj'] = $row['sb_obj'];
                        $data[$num]['element'] = $row['element'];
                        $data[$num]['groups'] = $row['groups'];
                        $data[$num]['lpf_basic'] = $row['lpf_basic'];
                        $data[$num]['lpf_advanced'] = $row['lpf_advanced'];
                        $data[$num]['poas'] = $row['poas'] ? $row['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>': null ;
                        $data[$num]['skills'] = $row['skills'] ? $row['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>': null;
                        if ($row['preliminary_skill'] == "1") { 
                            $data[$num]['pre-skills'] = '<p><span class="text-green"><i class="fa fa-check"></i></span></p>';
                        } else {
                            $data[$num]['pre-skills'] = '<p><span class="text-red"><i class="fa fa-close"></i></span></p>';
                        }                        
                        $data[$num]['code'] = $row['code'];
                        $data[$num]['expected_outcome'] = $row['expected_outcome'];
                        $rel_les = '';
                        foreach ($row['rel_lessons'] as $key) {
                            $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                        }
                        $data[$num]['rel_les'] = $rel_les;                        
                        $num++;
                    }
                }
                $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

                echo $return;

    }


    public function preview_ajax() 
    {
        // $postData = $this->input->post();
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $added_ids = $_GET['added_ids'];
        $offset = (int)$_GET['start'];
        $pagination = (int)$_GET['length'];

        if ($added_ids) {
            $searched_lessons = Lessons_model::list(null, null, null, $added_ids);        

            $selected_lessons = array_slice($searched_lessons, $offset, $pagination);

            $lessons_arr = array();
            foreach ($selected_lessons as $i =>$row) {
                $lessons_arr[$row['id']] = Lessons_model::table_list($row['id']);
            }
    
            $result_count = count($searched_lessons);
        }

        //rearrange data
        $data = array();
        $num = 0;
        if (!empty( $lessons_arr)) {
            foreach ( $lessons_arr as $key => $row) {
                // $data[$num][] = '<a class="removeRow text-red" name="subject_lessons['.$key.']" value="'.$row['id'] .'"><i class="fa fa-fw fa-trash-o"></i></a>';
                $data[$num]['course'] = $row['course'];
                $data[$num]['category'] = $row['category'];
                $data[$num]['sb_obj'] = $row['sb_obj'];
                $data[$num]['element'] = $row['element'];
                $data[$num]['groups'] = $row['groups'];
                $data[$num]['lpf_basic'] = $row['lpf_basic'];
                $data[$num]['lpf_advanced'] = $row['lpf_advanced'];
                $data[$num]['poas'] = $row['poas'] ? $row['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>': null ;
                $data[$num]['skills'] = $row['skills'] ? $row['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>': null;
                if ($row['preliminary_skill'] == "1") { 
                    $data[$num]['pre-skills'] = '<p><span class="text-green"><i class="fa fa-check"></i></span></p>';
                } else {
                    $data[$num]['pre-skills'] = '<p><span class="text-red"><i class="fa fa-close"></i></span></p>';
                }                        
                $data[$num]['code'] = $row['code'];
                $data[$num]['expected_outcome'] = $row['expected_outcome'];
                $rel_les = '';
                foreach ($row['rel_lessons'] as $key) {
                    $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                }
                $data[$num]['rel_les'] = $rel_les;                        
                $num++;
            }
        }
        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function select_subject()
    {
        $id = $_POST['subject_id'];
        $list = array();
        $existing_arr = Subject_lessons_model::where('subject_id', $id)->pluck('subject_category_id')->unique();
        $sub_cat = Subject_categories_model::where('subject_id', $id)->whereNotIn('id', $existing_arr)->get();

        foreach ($sub_cat as $i => $row) {
            $list[$i] = array('id' => $row['id'], 'text' => $row['name']);

        }

        $data = $list;
        echo json_encode($data);
    }


    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_'. $this->scope,
        ), FALSE, TRUE);

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $data['action'] = __('新 增');
        $data['function'] = "create";
        // $data['subject_list'] = Subjects_model::newList();
        $data['subject_list'] = Subjects_model::list(null, 'subject_outcome');

        $data['courses_list'] = Courses_model::list('All');
        $data['categories_list'] = Categories_model::list(null, 'all');
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['lessons_list'] = Lessons_model::list();

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');

        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }

    public function edit($subject_lesson_id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_'. $this->scope,
        ), FALSE, TRUE);

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $subject_lesson = Subject_lessons_model::find($subject_lesson_id);
        $id = $subject_lesson->subject_id;

        $subject = Subjects_model::find($id);
        $data['action'] = __('更 改');
        $data['function'] = "edit";
        $data['subject_list'] = Subjects_model::list();
        $data['courses_list'] = Courses_model::list('All');
        $data['categories_list'] = Categories_model::list(null, 'all');
        $data['sb_obj_list'] = Sb_obj_model::list();
        $lesson_data = Lessons_model::list();
        foreach ($lesson_data as $row) {
            $lessons_list[$row['id']] = $row['code']; 
        }

        $data['lessons_list'] = $lessons_list;    
        $result = Subject_lessons_model::where('subject_id',$id)->where('subject_category_id',$subject_lesson->subject_category_id )->pluck('lesson_id');
        $data['added_ids'] = $result;
        $data['subject'] = Subjects_model::name($id); 
        $data['subject_category'] = Subject_categories_model::name($subject_lesson->subject_category_id);
        $data['subject_id'] = $id; 
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $subject_lesson_id);
        $data['return'] = $_SERVER['HTTP_REFERER'];

        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }



    public function preview($subject_lesson_id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_'. $this->scope,
        ), FALSE, TRUE);
        $postData = $this->input->post();
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        if ($subject_lesson_id) {
            $subject_lesson = Subject_lessons_model::find($subject_lesson_id);
            $id = $subject_lesson->subject_id;
            $data['subject_category'] = Subject_categories_model::name($subject_lesson->subject_category_id);

        } 
        if (empty($id)) {
            $id = $postData['subject_id'];
            $dup_subject_lesson = Subject_lessons_model::where('subject_id', $id)->where('subject_category_id', $postData['sub_category_id'])->first();

            switch (true) {
                case (empty($postData['subject_id'])):
                    $_SESSION['error_msg'] = __('請選擇科目');
                    redirect(admin_url($data['page_setting']['controller']. '/'. $postData['action']));
                    break;
                case (empty($postData['sub_category_id'])):

                    break;
                case ($dup_subject_lesson):
                    $_SESSION['error_msg'] = __('已存在科目範疇');
                    redirect(admin_url($data['page_setting']['controller']. '/'. $postData['action']));
                    break;
                
            };

            $data['subject_id'] = $postData['subject_id'];
            $data['subject_category_id'] = $postData['sub_category_id'];
            $data['subject_category'] = Subject_categories_model::name($postData['sub_category_id']);

        }

        $postData['added_ids'] = explode(',', $postData['subject_lessons'][0]);
        $_SESSION['post_data'] = $postData;
        $data['id'] = $id; 
        $data['subject_lesson_id'] = $subject_lesson_id; 

        $data['previous'] = $postData['action'];
        $data['subject'] = Subjects_model::name($id); 
        $data['added_ids'] =  $postData['added_ids'];
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'.$subject_lesson_id );

        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }
    

    public function submit_form($subject_lesson_id = null){
        $postData = $this->input->post();
        // dump($_SESSION['referrer']);
        // Create
        if ($subject_lesson_id == null) {
            $subject_id = $postData['subject_id'];
            $subject_category_id = $postData['subject_categories_id']; 
            $lessons_id = json_decode($postData['lessons_id'][0]);
            foreach ($lessons_id as $row){
                $subject_lessons_id = Subject_lessons_model::create(array('subject_id' => $subject_id, 'lesson_id' => $row, 'subject_category_id' =>  $subject_category_id ))->id;
            }
            if ($subject_lessons_id) {
                $_SESSION['success_msg'] = __('新增課程大綱成功');
                $_SESSION['post_data'] = null;
                redirect(admin_url('bk_'.$this->scope));
            } else {
                $_SESSION['error_msg'] = __('Error');
            }  
        // Edit      
        } else {
            $subject_lesson = Subject_lessons_model::find($subject_lesson_id);
            $subject_id = $subject_lesson->subject_id;
            $subject_category_id = $subject_lesson->subject_category_id;
            $exist_lessons_id = json_decode(Subject_lessons_model::where('subject_id', $subject_id)->where('subject_category_id', $subject_category_id)->pluck('lesson_id'));
            $lessons_id = json_decode($postData['lessons_id'][0]);
            $add_result = array_diff($lessons_id,$exist_lessons_id);
            $delete_result = array_diff($exist_lessons_id, $lessons_id);


            if ($lessons_id[0] !== "NaN") {
                foreach ($delete_result as $row){
                    Subject_lessons_model::where('subject_id', $subject_id)->where('subject_category_id', $subject_category_id)->where('lesson_id', $row)->delete();
                }
                foreach ($add_result as $row){
                    $created_id = Subject_lessons_model::create(array('subject_id' => $subject_id, 'lesson_id' => $row, 'subject_category_id' =>  $subject_category_id))->id;
                }
                $_SESSION['success_msg'] = __('修改課程大綱成功');
                $_SESSION['post_data'] = null;
                
                if ($_SESSION['path'] == 'subjects_map') {
                    redirect(admin_url('bk_subjects_map'));
                }
                redirect(admin_url('bk_'.$this->scope));

            } else {
                    $_SESSION['error_msg'] = __('已清空課程大綱');
                    if ($_SESSION['path'] == 'subjects_map') {
                        redirect(admin_url('bk_subjects_map'));
                    }
                    redirect(admin_url('bk_'.$this->scope));
            }
        
                $_SESSION['error_msg'] = __('修改課程大綱失敗');
        }
    }
}
