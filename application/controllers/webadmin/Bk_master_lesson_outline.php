<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_master_lesson_outline extends CI_Controller //change this
{
    private $scope = 'master_lesson_outline'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('校本課程大綱 - 檢視'), //change this
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

    public function index($filter_type = NULL, $filter_para = NULL, $filter_para2 = NULL)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $data['courses_list'] = Courses_model::list('All');
        $data['categories_list'] = Categories_model::optionList('all');
        $data['central_obj_list'] = Central_obj_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['elements_list'] = Elements_model::list();
        
        $lesson_data = Lessons_model::list();
        foreach ($lesson_data as $row) {
            $lessons_list[$row['id']] = $row['code']; 
        }
        $data['lessons_list'] = $lessons_list;

        $data['sb_obj_id'] = $_POST['sb_obj_id'];
        $data['lesson_id'] = $_POST['lesson_id'];
        $data['category_id'] = $_POST['categories_id'];
        $_SESSION['post_data'] = null;

        $data['form_action'] = admin_url($data['page_setting']['controller']);

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }
    


    public function ajax(){
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $course_id = $_GET['course_search'];
        $category_id = $_GET['category_search'];
        $sb_obj_id = $_GET['sb_obj_search'];
        $lesson_id = $_GET['lesson_search'];

        $filtered_lessons = Lessons_model::list($course_id, $category_id, $sb_obj_id, $lesson_id);
        $lessons_arr = array();
        foreach ($filtered_lessons as $i =>$row) {
            $lessons_arr[$row['id']] = Lessons_model::table_list($row['id']);
        }

        $result_count = count($lessons_arr);

        //rearrange data
        $data = array();
        $num = 0;
        if (!empty( $lessons_arr)) {
            foreach ( $lessons_arr as $key => $row) {
                $data[$num][] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. $row['id']).'"><i class="fa fa-edit"></i></a>';
                $data[$num][] = $row['course'];
                $data[$num][] = $row['category'];
                $data[$num][] = $row['central_obj'];
                $data[$num][] = $row['sb_obj'];
                $data[$num][] = $row['element'];
                $data[$num][] = $row['groups'];
                $data[$num][] = $row['lpf_basic'];
                $data[$num][] = $row['lpf_advanced'];
                $data[$num][] = $row['poas'];
                $data[$num][] = $row['skills'];
                $data[$num][] = $row['preliminary_skill'] == 1? '<span class="text-green" ><i class="fa fa-check"></i></span>': '<span class="text-red"><i class="fa fa-close"></i></span>';
                $data[$num][] = $row['code'];
                $data[$num][] = $row['expected_outcome'];
                $rel_les = '';
                foreach ($row['rel_lessons'] as $key) {
                    $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                }
                $data[$num][] = $rel_les;
                $data[$num][] = $row['rel_code'];

    
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
        
                // dump($_GET);
                $filtered_lessons = Lessons_model::list($course_id, $category_id,$sb_obj_id, $lesson_id);
                $lessons_arr = array();
                foreach ($filtered_lessons as $i =>$row) {
                    $lessons_arr[$row['id']] = Lessons_model::table_list($row['id']);
                }
        
                $result_count = count($lessons_arr);
        
                //rearrange data
                $data = array();
                $num = 0;
                if (!empty( $lessons_arr)) {
                    foreach ( $lessons_arr as $key => $row) {
                        $data[$num][] = '<input type="checkbox" name="rel_lesson_check" class="checkboxClass" value="'.$row['id'].'"/>';
                        $data[$num][] = $row['course'];
                        $data[$num][] = $row['category'];
                        $data[$num][] = $row['central_obj'];
                        $data[$num][] = $row['sb_obj'];
                        $data[$num][] = $row['element'];
                        $data[$num][] = '<span class="hidden">'.Groups_model::value($row['group']).'</span>'.$row['group']; 
                        $data[$num][] = $row['lpf_basic'];
                        $data[$num][] = $row['lpf_advanced'];
                        $data[$num][] = $row['poas'];
                        $data[$num][] = $row['skills'];
                        $data[$num][] = $row['preliminary_skill'];
                        $data[$num][] = $row['code'];
                        $data[$num][] = $row['expected_outcome'];
                        $rel_les = '';
                        foreach ($row['rel_lessons'] as $key) {
                            $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                        }
                        $data[$num][] = $rel_les;                        // $action = '<div class="nowrap">';
                        // if (validate_user_access(['update_' . $this->scope])) {
                        //     $action .= '<button type="button" class="btn btn-' . ($row["status"] == 1 ? 'success' : 'warning') . '" onclick="ajax_update_status(' . $row['id'] . ', ' . ($row["status"] == 1 ? 0 : 1) . ');" style="margin-right: 5px;">' . ($row["status"] == 1 ? __('Enable') : __('Disable')) . '</button>';
                        //     $action .= '<a href="' . admin_url($page_setting['controller'] . '/modify/' . $row['id']) . '" style="margin-right: 5px;"><button type="button" class="btn btn-warning">' . __('Modify') . '</button></a>';
                        // }
                        // //delete this event and relate parent id
                        // if (validate_user_access(['delete_' . $this->scope])) {
                        //     $action .= '<button type="button" class="btn btn-danger" onclick="ajax_delete_record(' . $row['id'] . ');">' . __('Delete') . '</button>';
                        // }
                        // $action .= '</div>';
                        // $data[$num][] = $action;
                        $data[$num][] = $row['rel_code'];

                        $num++;
                    }
                }
                $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));
                echo $return;

    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        $postData = $this->input->post();

        $data['action'] = __('新 增');
        $data['function'] = 'create';
        $lesson_data = Lessons_model::list();
        foreach ($lesson_data as $row) {
            $lessons_list[$row['id']] = $row['code']; 
        }
        $data['lessons_list'] = $lessons_list;        
        $data['courses_list'] = Courses_model::list();
        $data['categories_list'] = Categories_model::list(null, 0);
        $data['central_obj_list'] = Central_obj_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['elements_list'] = Elements_model::list();
        $data['groups_list'] = Groups_model::list();
        $data['lpf_basic_list'] = Lpf_basic_model::list();
        $data['lpf_advanced_list'] = Lpf_advanced_model::list();
        $data['poas_list'] = Poas_model::list();
        $data['skills_list'] = Skills_model::list();

        $lesson_list = Lessons_model::list();
        $lessons_arr = array();
        foreach ($lesson_list as $i =>$row) {
            $lessons_arr[$i] = Lessons_model::table_list($i);
        }
        $data['lessons'] = $lessons_arr;
        $lesson = Lessons_model::find($id);


        if ($_SESSION['post_data']) {
            $sessionData = $_SESSION['post_data'];
            $data['course_id'] = $sessionData['course_id'];
            $data['categories_id'] = $sessionData['categories_id'];
            $data['lesson_code'] = $sessionData['lesson_code'];
            $data['central_obj_id'] = $sessionData['central_obj_id'];
            $data['sb_obj_id'] = $sessionData['sb_obj_id'];
            $data['element_id'] = $sessionData['element_id'];
            $data['rel_lessons'] = $sessionData['rel_lessons'];
            $data['lpf_basic_id'] = $sessionData['lpf_basic_id'];
            $data['lpf_advanced_id'] = $sessionData['lpf_advanced_id'];
            $data['poas_id'] = $sessionData['poas_id'];
            $data['preliminary_skills'] = $sessionData['preliminary_skills'];
            $data['expected_outcome'] = $sessionData['expected_outcome'];
            $data['expected_outcome_eng'] = $sessionData['expected_outcome_eng'];

            $data['group_id'] = $sessionData['group_id'];
            $data['skills_ids'] = $sessionData['skills_id'];
        }

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');

        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }

    public function select_course()
    {
        $id = $_POST['course_id'];
        $list = array();
        $cat = Categories_model::where('course_id', $id)->get();

        foreach ($cat as $i => $row) {
            $list[$i] = array('id' => $row['id'], 'text' => Courses_model::name($row['course_id']). ' - '. $row['name']);
        }

        $data = $list;
        echo json_encode($data);
    }


    public function edit($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        $lesson = Lessons_model::find($id);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $id);
        $data['action'] = __('修 改');
        $data['function'] = 'edit';
        $data['lessons_list'] = Lessons_model::rel_list($id);
        $data['courses_list'] = Courses_model::list();
        $data['categories_list'] = Categories_model::list($lesson->course_id, null);
        $data['central_obj_list'] = Central_obj_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['elements_list'] = Elements_model::list();
        $data['groups_list'] = Groups_model::list();
        $data['lpf_basic_list'] = Lpf_basic_model::list();
        $data['lpf_advanced_list'] = Lpf_advanced_model::list();
        $data['poas_list'] = Poas_model::list();
        $data['skills_list'] = Skills_model::list();

        $lesson_list = Lessons_model::list();
        $lessons_arr = array();
        foreach ($lesson_list as $i =>$row) {
            $lessons_arr[$i] = Lessons_model::table_list($i);
        }
        $data['lessons'] = $lessons_arr;

    
        if ($_SESSION['post_data']) {
            $sessionData = $_SESSION['post_data'];
            $data['id'] = $id;
            $data['course_id'] = $sessionData['course_id'];
            $data['categories_id'] = $sessionData['categories_id'];
            $data['lesson_code'] = $sessionData['lesson_code'];
            $data['central_obj_id'] = $sessionData['central_obj_id'];
            $data['sb_obj_id'] = $sessionData['sb_obj_id'];
            $data['element_id'] = $sessionData['element_id'];
            $data['rel_lessons'] = $sessionData['rel_lessons'];
            $data['lpf_basic_id'] = $sessionData['lpf_basic_id'];
            $data['lpf_advanced_id'] = $sessionData['lpf_advanced_id'];
            $data['rel_code'] = $sessionData['rel_code'];
            $data['poas_id'] = $sessionData['poas_id'];
            $data['preliminary_skills'] = $sessionData['preliminary_skills'];
            $data['expected_outcome'] = $sessionData['expected_outcome'];
            $data['expected_outcome_eng'] = $sessionData['expected_outcome_eng'];

            $data['group_ids'] = $sessionData['group_id'];
            $data['skills_ids'] = $sessionData['skills_id'];

        } else if ($lesson){
            $data['id'] = $id;
            $data['course_id'] = $lesson['course_id'];
            $data['categories_id'] = $lesson['category_id'];
            $data['lesson_code'] = $lesson['code'];
            $data['central_obj_id'] = $lesson['central_obj_id'];
            $data['sb_obj_id'] = $lesson['sb_obj_id'];
            $data['element_id'] = $lesson['element_id'];
            $data['lpf_basic_id'] = $lesson['lpf_basic_id'];
            $data['lpf_advanced_id'] = $lesson['lpf_advanced_id'];
            $data['poas_id'] = $lesson['poas_id'];
            $data['rel_code'] = $lesson['rel_code'];
            $data['preliminary_skills'] = $lesson['preliminary_skills'];
            $data['expected_outcome'] = $lesson['expected_outcome'];
            $data['expected_outcome_eng'] = $lesson['expected_outcome_eng'];
            $data['group_ids'] = Lessons_group_model::id_list($id);
            $data['skills_ids'] = Lessons_skill_model::id_list($id);
            $data['rel_lessons'] = Lessons_relevant_model::id_list($id);

        }

        // dump($data['categories_id']);
        // dump($data['categories_list']);

        $GLOBALS["select2"] = 1;        
        $GLOBALS["datatable"] = 1;

        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }


    public function preview($id = null)
    {        
        $postData = $this->input->post();
        $GLOBALS["datatable"] = 1;

        $_SESSION['post_data'] = $postData;
        $previous = $postData['action'];
        $dup_lesson_code = Lessons_model::where('code', $postData['lesson_code'])->first()->code;

        // validation
        if (empty($id)) {
            $dup_lesson_code = Lessons_model::where('code', $postData['lesson_code'])->first()->code;
        } else {
            $dup_lesson_code = Lessons_model::where('id', '!=', $id)->where('code', $postData['lesson_code'])->first()->code;
        }
        switch (true){
            case ($dup_lesson_code):
                $_SESSION['error_msg'] = __('課程編號不能重覆');
                redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id ));
                break;
            case (empty($postData['course_id'])):
                $_SESSION['error_msg'] = __('請選擇課程編號');
                redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id ));
                break;
            case (empty($postData['categories_id'])):
                $_SESSION['error_msg'] = __('請選擇範疇');
                redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id));
                break;
            case (empty($postData['lesson_code'])):
                $_SESSION['error_msg'] = __('請選擇課程編號');
                redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id));
                break;
            case (empty($postData['central_obj_id'])):
                $_SESSION['error_msg'] = __('請選擇中央課程學習重點');
                redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id));
                break;
            case (empty($postData['sb_obj_id'])):
                $_SESSION['error_msg'] = __('請選擇校本課程學習重點');
                redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id));
                break;     
            case (empty($postData['element_id'])):
                $_SESSION['error_msg'] = __('請選擇學習元素');
                redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id));
                break;
            case (empty($postData['group_id'])):
                $_SESSION['error_msg'] = __('請選擇組別');
                redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id));
                break;           
            case (empty($postData['expected_outcome'])):
                $_SESSION['error_msg'] = __('請輸入預期學習成果');
                redirect(admin_url('bk_'.$this->scope.'/'.$previous.'/'.$id));
                break;
            default;
        }
        

        $group_arr = array();
        foreach ($postData['group_id'] as $i => $row){
            if (strlen($i > 0)) {
            $group_arr[$i] = $row;
            };
        };

        $skill_arr = array();
        foreach ($postData['skills_id'] as $i => $row){
            if (strlen($row > 0)) {
            $skill_arr[$i] = Skills_model::name($row);
            };
        };

        $rel_lesson_arr = array();
        foreach ($postData['rel_lessons'] as $i => $row){
            if (strlen($row > 0)) {
            $rel_lesson_arr[$i] = Lessons_model::code($row);
            };
        };

        $data = array(
            'pv_course_id' => Courses_model::name($postData['course_id']),
            'pv_categories_id' => Categories_model::name($postData['categories_id']),
            'pv_lesson_code' => $postData['lesson_code'],
            'pv_central_obj_id' => Central_obj_model::name($postData['central_obj_id']),
            'pv_sb_obj_id' => Sb_obj_model::name($postData['sb_obj_id']),
            'pv_element_id' => Elements_model::name($postData['element_id']),
            'pv_group_id' => implode(',', $group_arr),
            "pv_lpf_basic_id" => Lpf_basic_model::name($postData['lpf_basic_id']),
            "pv_lpf_advanced_id" => Lpf_advanced_model::name($postData['lpf_advanced_id']),
            "pv_poas_id" => Poas_model::name($postData['poas_id']),
            "pv_rel_code" => $postData['rel_code'] ? $postData['rel_code'] : "&nbsp",
            "pv_skills_id" => implode(',', $skill_arr),
            'pv_rel_lessons' => implode(',', $rel_lesson_arr),
            "pv_preliminary_skills" => $postData['preliminary_skills'],
            'pv_expected_outcome' => $postData['expected_outcome'],
            'pv_expected_outcome_eng' => $postData['expected_outcome_eng']

        );
    
        $data['page_setting'] = $this->page_setting(array(
            'update_'. $this->scope,
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'.$id);
        $data['action'] = __('預 覽');
        $data['previous'] =  $previous;
        $data['id'] = $id;
        $data['postData'] = $postData;
        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }


    

    public function submit_form($id = null){
        $data = $this->input->post('post_data');
        $group_ids = $this->input->post('group_id');
        $skill_ids = $this->input->post('skills_id');
        $rel_lessons = $this->input->post('rel_lessons');
        // dump($group_ids);

        $school_based_data = array(
            'code' => $data['lesson_code'],
            'course_id' => $data['course_id'],
            'category_id' => $data['categories_id'],
            'central_obj_id' => $data['central_obj_id'],
            'sb_obj_id' => $data['sb_obj_id'],
            'element_id' => $data['element_id'],
            'lpf_basic_id' => (int)$data['lpf_basic_id'],
            'lpf_advanced_id' => (int)$data['lpf_advanced_id'],
            'poas_id' => (int)$data['poas_id'],
            // 'group_id' => (int)$data['group_id'],
            'rel_code' => $data['rel_code'],
            'preliminary_skills' => $data['preliminary_skills'],
            'expected_outcome' => $data['expected_outcome'],
            'expected_outcome_eng' => $data['expected_outcome_eng'],
            'created_by' => $_SESSION["sys_user_id"],
            'created_at' => date("Y-m-d H:i:s"),
        );

        if (empty($id)) {
            $lesson_id = Lessons_model::create($school_based_data)->id;
            foreach ($group_ids as $i => $row) {
                Lessons_group_model::create(array('lesson_id' => $lesson_id, 'group_id' => $i,));
            }
            foreach ($skill_ids as $i => $row) {
                Lessons_skill_model::create(array('lesson_id' => $lesson_id, 'skill_id' => $row,));
            }

            foreach ($rel_lessons as $i => $row) {
                Lessons_relevant_model::create(array('lesson_id' => $lesson_id, 'rel_lesson_id' => $row,));
            }
            
            if ($lesson_id) {
                $_SESSION['success_msg'] = __('新增課程大綱成功'); 
                $_SESSION['post_data'] = null;
                redirect(admin_url('bk_'.$this->scope));
            } else {
                $_SESSION['error_msg'] = __('Error');
            }
        } else {
            Lessons_model::where('id', $id)->update($school_based_data);
            
            Lessons_group_model::where('lesson_id', $id)->delete(); 
            Lessons_skill_model::where('lesson_id', $id)->delete(); 
            Lessons_relevant_model::where('lesson_id', $id)->orwhere('rel_lesson_id', $id)->delete(); 

            foreach ($group_ids as $i => $row) {
                Lessons_group_model::create(array('lesson_id' => $id, 'group_id' => $i,));
            }
            if (strlen($skill_ids[0]) > 0) {
                foreach ($skill_ids as $i => $row) {
                    Lessons_skill_model::create(array('lesson_id' => $id, 'skill_id' => $row,));
                }
            }

            if (strlen($rel_lessons[0]) > 0) {
                foreach ($rel_lessons as $i => $row) {
                    Lessons_relevant_model::create(array('lesson_id' => $id, 'rel_lesson_id' => $row,));
                }
            }


            $_SESSION['success_msg'] = __('修改課程大綱成功');
            redirect(admin_url('bk_'.$this->scope));

        } 
    }
}
