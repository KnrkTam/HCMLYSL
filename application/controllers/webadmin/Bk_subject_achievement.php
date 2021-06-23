<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_subject_achievement extends CI_Controller //change this
{
    private $scope = 'subject_achievement'; //change this

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
            // 'view_news'
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
            // return $lessons_arr;
        } else {
            $lessons_arr = null;
        }
        
        $result_count = count($lessons_arr);

        //rearrange data
        $data = array();
        $num = 0;
        if (!empty( $lessons_arr)) {
            foreach ( $lessons_arr as $key => $row) {
                $data[$num][] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. $subject_id).'"><i class="fa fa-edit"></i></a>';
                $data[$num][] = $row['course'];
                $data[$num][] = $row['category'];
                $data[$num][] = $row['central_obj'];
                $data[$num][] = $row['sb_obj'];
                $data[$num][] = $row['element'];
                $data[$num][] = $row['groups'];
                $data[$num][] = $row['lpf_basic'];
                $data[$num][] = $row['lpf_advanced'];
                $data[$num][] = $row['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                $data[$num][] = $row['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                if ($row['preliminary_skill'] == "1") { 
                    $data[$num][] = '<p><span class="text-green"><i class="fa fa-check"></i></span></p>';
                } else {
                    $data[$num][] = '<p><span class="text-red"><i class="fa fa-close"></i></span></p>';
                }
                $data[$num][] = $row['expected_outcome'];
                $data[$num][] = $row['code'];

                $rel_les = '';
                foreach ($row['rel_lessons'] as $key) {
                    $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                }
                $data[$num][] = $rel_les;


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
        
                $course_id = $_GET['course_search'];
                $category_id = $_GET['category_search'];
                $sb_obj_id = $_GET['sb_obj_search'];
                $lesson_id = $_GET['lesson_search'];
                $subject_id = $_GET['subject_search'];

                $lessons_arr = array();

                    $filtered_lessons = Lessons_model::list($course_id, $category_id,$sb_obj_id, $lesson_id);
                    foreach ($filtered_lessons as $i =>$row) {
                        $lessons_arr[$i] = Lessons_model::table_list($i);
                    }


        
                $result_count = count($lessons_arr);
        
                //rearrange data
                $data = array();
                $num = 0;
                if (!empty( $lessons_arr)) {
                    foreach ($lessons_arr as $key => $row) {
                        $data[$num][] = '<input type="checkbox" class="addLesson" value="'.$row['id'].'"/>';
                        $data[$num][] = $row['course'];
                        $data[$num][] = $row['category'];
                        $data[$num][] = $row['central_obj'];
                        $data[$num][] = $row['sb_obj'];
                        $data[$num][] = $row['element'];
                        $data[$num][] = $row['groups'];
                        $data[$num][] = $row['lpf_basic'];
                        $data[$num][] = $row['lpf_advanced'];
                        $data[$num][] = $row['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                        $data[$num][] = $row['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                        if ($row['preliminary_skill'] == "1") { 
                            $data[$num][] = '<p><span class="text-green"><i class="fa fa-check"></i></span></p>';
                        } else {
                            $data[$num][] = '<p><span class="text-red"><i class="fa fa-close"></i></span></p>';
                        }                        $data[$num][] = $row['code'];
                        $data[$num][] = $row['expected_outcome'];
                        $rel_les = '';
                        foreach ($row['rel_lessons'] as $key) {
                            $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                        }
                        $data[$num][] = $rel_les;                        
    
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
                        $lessons_arr[$i] = Lessons_model::table_list($i);
                    }
            
                    $result_count = count($lessons_arr);
                }

                //rearrange data
                $data = array();
                $num = 0;
                if (!empty( $lessons_arr)) {
                    foreach ( $lessons_arr as $key => $row) {
                        $data[$num][] = '<a class="removeRow text-red" name="subject_lessons['.$key.']" value="'.$row['id'] .'"><i class="fa fa-fw fa-trash-o"></i></a>';
                        $data[$num][] = $row['course'];
                        $data[$num][] = $row['category'];
                        $data[$num][] = $row['central_obj'];
                        $data[$num][] = $row['sb_obj'];
                        $data[$num][] = $row['element'];
                        $data[$num][] = $row['groups'];
                        $data[$num][] = $row['lpf_basic'];
                        $data[$num][] = $row['lpf_advanced'];
                        $data[$num][] = $row['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                        $data[$num][] = $row['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                        if ($row['preliminary_skill'] == "1") { 
                            $data[$num][] = '<p><span class="text-green"><i class="fa fa-check"></i></span></p>';
                        } else {
                            $data[$num][] = '<p><span class="text-red"><i class="fa fa-close"></i></span></p>';
                        }                        $data[$num][] = $row['code'];
                        $data[$num][] = $row['expected_outcome'];
                        $rel_les = '';
                        foreach ($row['rel_lessons'] as $key) {
                            $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                        }
                        $data[$num][] = $rel_les;                        
    
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
        if ($added_ids) {
            $selected_lessons = Lessons_model::list(null, null, null, $added_ids);
            $lessons_arr = array();
            foreach ($selected_lessons as $i =>$row) {
                $lessons_arr[$i] = Lessons_model::table_list($i);
            }
    
            $result_count = count($lessons_arr);
        }

        //rearrange data
        $data = array();
        $num = 0;
        if (!empty( $lessons_arr)) {
            foreach ( $lessons_arr as $key => $row) {
                // $data[$num][] = '<a class="removeRow text-red" name="subject_lessons['.$key.']" value="'.$row['id'] .'"><i class="fa fa-fw fa-trash-o"></i></a>';
                $data[$num][] = $row['course'];
                $data[$num][] = $row['category'];
                $data[$num][] = $row['central_obj'];
                $data[$num][] = $row['sb_obj'];
                $data[$num][] = $row['element'];
                $data[$num][] = $row['groups'];
                $data[$num][] = $row['lpf_basic'];
                $data[$num][] = $row['lpf_advanced'];
                $data[$num][] = $row['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                $data[$num][] = $row['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                if ($row['preliminary_skill'] == "1") { 
                    $data[$num][] = '<p><span class="text-green"><i class="fa fa-check"></i></span></p>';
                } else {
                    $data[$num][] = '<p><span class="text-red"><i class="fa fa-close"></i></span></p>';
                }                        $data[$num][] = $row['code'];
                $data[$num][] = $row['expected_outcome'];
                $rel_les = '';
                foreach ($row['rel_lessons'] as $key) {
                    $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                }
                $data[$num][] = $rel_les;                        

                $num++;
            }
        }
        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

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
        $data['subject_list'] = Subjects_model::newList();
        $data['courses_list'] = Courses_model::list();
        $data['categories_list'] = Categories_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['lessons_list'] = Lessons_model::list();
        array_unshift($data['courses_list'], "所有課程");
        array_unshift($data['categories_list'], "所有課程");


        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');

        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }

    public function edit($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_'. $this->scope,
        ), FALSE, TRUE);

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $subject = Subjects_model::find($id);
        $data['action'] = __('更 改');
        $data['function'] = "edit";
        $data['subject_list'] = Subjects_model::list();
        $data['courses_list'] = Courses_model::list();
        $data['categories_list'] = Categories_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['lessons_list'] = Lessons_model::list();
        array_unshift($data['courses_list'], "所有課程");
        array_unshift($data['categories_list'], "所有課程");
        $result = Subject_lessons_model::where('subject_id',$id)->pluck('lesson_id');
        $data['added_ids'] = $result;

        $data['subject'] = Subjects_model::name($id); 
        $data['subject_id'] = $id; 
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $id);

        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }



    public function preview($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_'. $this->scope,
        ), FALSE, TRUE);
        $postData = $this->input->post();
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        if (empty($id)) {
            $id = $postData['subject_id'];

            if (empty($postData['subject_id'])) {
                $_SESSION['error_msg'] = __('請選擇科目');
                redirect(admin_url($data['page_setting']['controller']. '/'. $postData['action']));
            }
        }

        $postData['added_ids'] = explode(',', $postData['subject_lessons'][0]);
        $_SESSION['post_data'] = $postData;
        $data['id'] = $id; 
        $data['previous'] = $postData['action'];
        $data['subject'] = Subjects_model::name($id); 
        $data['added_ids'] =  $postData['added_ids'];
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'.$id);

        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }
    

    public function submit_form($id = null){
        $postData = $this->input->post();

        if ($id == null) {
            $id = $postData['subject_id'];
            $lessons_id = json_decode($postData['lessons_id'][0]);

            foreach ($lessons_id as $row){
                $subject_lessons_id = Subject_lessons_model::create(array('subject_id' => $postData['subject_id'], 'lesson_id' => $row))->id;
            }
            if ($subject_lessons_id) {
                $_SESSION['success_msg'] = __('新增課程大綱成功');
                $_SESSION['post_data'] = null;
                redirect(admin_url('bk_'.$this->scope));
            } else {
                $_SESSION['error_msg'] = __('Error');
            }        
        } else {
            Subject_lessons_model::where('subject_id', $id)->delete();
            $lessons_id = json_decode($postData['lessons_id'][0]);
            if ($lessons_id[0] !== "NaN") {
                foreach ($lessons_id as $row){
                    $subject_lessons_id = Subject_lessons_model::create(array('subject_id' => $id, 'lesson_id' => $row))->id;
                }
            } else {
                $_SESSION['error_msg'] = __('已清空課程大綱');
                redirect(admin_url('bk_'.$this->scope));

            }
    
            if ($subject_lessons_id) {
                $_SESSION['success_msg'] = __('修改課程大綱成功');
                $_SESSION['post_data'] = null;
    
                redirect(admin_url('bk_'.$this->scope));
            } else {
                $_SESSION['error_msg'] = __('修改課程大綱失敗');
            }        
        }
    }
}
