<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_intended_learning_outline extends CI_Controller //change this
{
    private $scope = 'intended_learning_outline'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('設定單元既定教學大綱 - 檢視'), //change this
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
        $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;
        $data['subject_list'] = Subjects_model::list();
        $data['annual_modules_list'] = Annual_modules_model::year_list($year_id);
        $data['remarks_list'] = Remarks_model::list();
        

        if ($_POST) {
            $sub_cat= Subject_categories_model::where('subject_id', $_POST['subject_id'])->get();
    
            foreach ($sub_cat as $i => $row) {
                $list[$row['id']] = $row['name'];
            }
            // dump($_POST);
            $data['subject_id'] = $_POST['subject_id'];
            $data['annual_module_id'] = $_POST['annual_module_id'];
            $data['subject_category_id'] = $_POST['subject_category_id'];
            $data['remark_id'] = $_POST['remark_id'];
            $data['subject_categories_list'] = $list;
        }

        $data['form_action'] = admin_url($data['page_setting']['controller']);

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
        // dump($_GET);

        // $lessons_arr = array();
        // if ($subject_id) {
        //     $filtered_lessons = Lessons_model::subjectList($course_id, $category_id, $sb_obj_id, $lesson_id, $subject_id);
        //     foreach ($filtered_lessons as $i => $row) {
        //         $lessons_arr[$i]  = array('lesson' => Lessons_model::table_list($row['id']), 'subject_lesson_id' => $row['sub_lesson_id'], 'subject_cat_id' => Subject_lessons_model::find($row['sub_lesson_id'])->subject_category_id);
        //     }
        // } 
        
        // $result_count = count($lessons_arr);

        // $data = array();
        // $num = 0;
        // if (!empty( $lessons_arr)) {
        //     foreach ($lessons_arr as $row) {
        //         // dump($row); 
        //         $data[$num][] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. Subject_lessons_model::where('subject_category_id',$row['subject_cat_id'] )->first()->id).'"><i class="fa fa-edit"></i></a>';
        //         $data[$num][] = Subject_categories_model::name($row['subject_cat_id']);
        //         $data[$num][] = $row['lesson']['course'];
        //         $data[$num][] = $row['lesson']['central_obj'];
        //         $data[$num][] = $row['lesson']['sb_obj'];
        //         $data[$num][] = $row['lesson']['element'];
        //         $data[$num][] = $row['lesson']['groups'];
        //         $data[$num][] = $row['lesson']['lpf_basic'];
        //         $data[$num][] = $row['lesson']['lpf_advanced'];
        //         $data[$num][] = $row['lesson']['poas'] ? $row['lesson']['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>': "&nbsp";
        //         $data[$num][] = $row['lesson']['skills'] ? $row['lesson']['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>': "&nbsp";
        //         if ($row['lesson']['preliminary_skill'] == "1") { 
        //             $data[$num][] = '<p><span class="text-green"><i class="fa fa-check"></i></span></p>';
        //         } else {
        //             $data[$num][] = '<p><span class="text-red"><i class="fa fa-close"></i></span></p>';
        //         }
        //         $data[$num][] = $row['lesson']['expected_outcome'];
        //         $data[$num][] = $row['lesson']['code'];
        //         $rel_les = '';
        //         foreach ($row['lesson']['rel_lessons'] as $foo) {
        //             $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($foo).'</button> &nbsp';
        //         }
        //         $data[$num][] = $rel_les;

        //         $num++;
        //     }
        // }
        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => 1, "recordsFiltered" => 1));

        echo $return;

    }


    public function select_subject()
    {
        $id = $_POST['subject_id'];
        $list = array();
        $sub_cat= Subject_categories_model::where('subject_id', $id)->get();
        // $sub_cat = Subject_categories_model::where('subject_id', $id)->whereNotIn('id', $existing_arr)->get();

        foreach ($sub_cat as $i => $row) {
            $list[$i] = array('id' => $row['id'], 'text' => $row['name']);

        }

        echo json_encode($list);
    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');
        $data['action'] = __('新 增');
        $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;
        // dump(Lessons_model::with('remarks')->get());
        if ($_SESSION['post_data']) {
            $data['subject_id'] = $_SESSION['post_data']['subject_id'];
            $data['annual_module_id'] = $_SESSION['post_data']['annual_module_id'];

            // dump($_SESSION['post_data']);
        }
        $data['subject_list'] = Subjects_model::list();
        $data['annual_modules_list'] = Annual_modules_model::year_list($year_id);
        $data['remarks_list'] = Remarks_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list('all');
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }

    public function search_ajax() 
    {
        // $postData = $this->input->post();
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        
        $sb_obj_id = $_GET['sb_obj_search'];
        $annual_module_id = $_GET['annual_module_search'];
        $subject_id = $_GET['subject_search'];
        $sub_category_id = $_GET['subject_category_search'];
        $offset = (int)$_GET['start'];
        $pagination = (int)$_GET['length'];
        // dump($_GET);

        if ($subject_id) {
            $filtered_lessons = Lessons_model::subjectList($sub_category_id,$sb_obj_id, $lesson_id, $subject_id);
            foreach ($filtered_lessons as $i =>$row) {     
                // dump( Lessons_remarks_model::id_list($row['sub_lesson_id']));   
                $lessons_arr[$i] = array('lesson' => Lessons_model::table_list($row['id']), 'subject_lesson_id' => $row['sub_lesson_id'], 'subject_cat_id' => Subject_lessons_model::find($row['sub_lesson_id'])->subject_category_id, 'remarks' => Lessons_remarks_model::id_list( $row['sub_lesson_id']));
            }
        }
        // dump($lessons_arr);
        
        $result_count = count($lessons_arr);
        //rearrange data
        $data = array();
        $name = array();
        $num = 0;
        
        
        if (!empty( $lessons_arr)) {  
            // dump($lessons_arr);  
            foreach ( $lessons_arr as $key => $row) {
                // dump($row);
                if ($subject_id) {
                    $subject_lesson_id = Subject_lessons_model::find($row['subject_lesson_id'])->id;

                    // dump($subject_lesson_id);

                } else {
                    $subject_lesson_id = Subject_lessons_model::where('lesson_id', $row['id'])->first()->id;
                    $subject_id = Subject_lessons_model::where('lesson_id', $row['id'])->first()->subject_id;
                }

                $lesson_performance = Key_performances_model::where('subject_lesson_id', $subject_lesson_id)->get();
                foreach ($lesson_performance as $foo ) {
                    $data[$num][] = '<input type="checkbox" class="addLesson" value="'.$row['subject_lesson_id'].'"/>';
                    $data[$num][] = Subjects_model::name($subject_id);
                    $data[$num][] = Subject_categories_model::name($sub_category_id);
                    // $data[$num][] = $row['subject_cat_id'] ? Subject_categories_model::name($row['subject_cat_id']) : "not yet assigned";
                    $data[$num][] = $row['lesson']['code'];
                    $data[$num][] = $row['lesson']['course'];
                    $data[$num][] = $row['lesson']['category'];
                    $data[$num][] = $row['lesson']['sb_obj'];
                    $data[$num][] = $row['lesson']['element'];
                    $data[$num][] = $row['lesson']['groups'];
                    $data[$num][] = $row['lesson']['lpf_basic'];
                    $data[$num][] = $row['lesson']['lpf_advanced'];
                    $data[$num][] = $row['lesson']['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num][] = $row['lesson']['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num][] = $row['lesson']['expected_outcome'];
                    $data[$num][] = $foo['performance'];
                    $data[$num][] = Assessments_model::mode($foo['assessment_id']);
                    $rel_les = '';
                    foreach ($row['lesson']['rel_lessons'] as $key) {
                        $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                    }
                    $data[$num][] = $rel_les;
                    $data[$num][] = '相關項目編號';
                    $remarks = '';
                    foreach ($row['remarks'] as $remark) {
                        $remarks .=  '<button type="button" class="btn-xs btn btn-primary badge">' .Remarks_model::name($remark).'</button> &nbsp';
                    }
                    $data[$num][] = $remarks;
                    $num++;
                }
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
                
                $offset = (int)$_GET['start'];
                $pagination = (int)$_GET['length'];
                $added_subject_lesson_ids = $_GET['added_ids'];
                if ($added_subject_lesson_ids) {
                    foreach ($added_subject_lesson_ids as $i => $subject_lesson_id) {
                        $subject_lesson = Subject_lessons_model::find($subject_lesson_id);
                        $lesson_id = $subject_lesson->lesson_id;
                        $lessons_arr[$i] = array('lesson' => Lessons_model::table_list($lesson_id), 'subject_lesson_id' => $subject_lesson_id, 'subject_cat_id' => $subject_lesson->subject_category_id, 'subject_id' => $subject_lesson->subject_id, 'remarks' => Lessons_remarks_model::id_list($subject_lesson_id), 'count' => $i);
                    }
                    $result_count = count($lessons_arr);
                }

                //rearrange data
                $data = array();
                $num = 0;
                if (!empty( $lessons_arr)) {
                    foreach ( $lessons_arr as $key => $row) {
                        $lesson_performance = Key_performances_model::where('subject_lesson_id', $row['subject_lesson_id'])->get();
                        foreach ($lesson_performance as $foo ) {
                            $data[$num][] = '<a class="removeRow text-red" name="subject_lessons['.$row['count'].']" value="'.$row['subject_lesson_id'] .'"><i class="fa fa-fw fa-trash-o"></i></a>';
                            $data[$num][] = Subjects_model::name($row['subject_id']);
                            $data[$num][] = Subject_categories_model::name($row['subject_cat_id']);
                            $data[$num][] = $row['lesson']['code'];
                            $data[$num][] = $row['lesson']['course'];
                            $data[$num][] = $row['lesson']['category'];
                            $data[$num][] = $row['lesson']['sb_obj'];
                            $data[$num][] = $row['lesson']['element'];
                            $data[$num][] = $row['lesson']['groups'];
                            $data[$num][] = $row['lesson']['lpf_basic'];
                            $data[$num][] = $row['lesson']['lpf_advanced'];
                            $data[$num][] = $row['lesson']['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                            $data[$num][] = $row['lesson']['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                            $data[$num][] = $row['lesson']['expected_outcome'];
                            $data[$num][] = $foo['performance'];
                            $data[$num][] = Assessments_model::mode($foo['assessment_id']);
                            $rel_les = '';
                            foreach ($row['lesson']['rel_lessons'] as $key) {
                                $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                            }
                            $data[$num][] = $rel_les;
                            $data[$num][] = '相關項目編號';
                            $remarks = '';
                            foreach ($row['remarks'] as $remark) {
                                $remarks .=  '<button type="button" class="btn-xs btn btn-primary badge">' .Remarks_model::name($remark).'</button> &nbsp';
                            }
                            $data[$num][] = $remarks;
                            $num++;
                        }
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

        $added_subject_lesson_ids = $_GET['added_ids'];
        $offset = (int)$_GET['start'];
        $pagination = (int)$_GET['length'];
        // dump($_GET);
        if ($added_subject_lesson_ids) {
            foreach ($added_subject_lesson_ids as $i => $subject_lesson_id) {
                $subject_lesson = Subject_lessons_model::find($subject_lesson_id);
                $lesson_id = $subject_lesson->lesson_id;
                $lessons_arr[$i] = array('lesson' => Lessons_model::table_list($lesson_id), 'subject_lesson_id' => $subject_lesson_id, 'subject_cat_id' => $subject_lesson->subject_category_id, 'subject_id' => $subject_lesson->subject_id, 'remarks' => Lessons_remarks_model::id_list($subject_lesson_id), 'count' => $i);
            }
            // $searched_lessons = Lessons_model::list(null, null, null, $added_ids);        

            // $selected_lessons = array_slice($searched_lessons, $offset, $pagination);

            // $lessons_arr = array();
            // foreach ($selected_lessons as $i =>$row) {
            //     $lessons_arr[$row['id']] = Lessons_model::table_list($row['id']);
            // }
            $result_count = count($lessons_arr);
        }

        //rearrange data
        $data = array();
        $num = 0;
        if (!empty( $lessons_arr)) {
            foreach ( $lessons_arr as $key => $row) {
                $lesson_performance = Key_performances_model::where('subject_lesson_id', $row['subject_lesson_id'])->get();
                foreach ($lesson_performance as $foo ) {
                    $data[$num][] = Subjects_model::name($row['subject_id']);
                    $data[$num][] = Subject_categories_model::name($row['subject_cat_id']);
                    $data[$num][] = $row['lesson']['code'];
                    $data[$num][] = $row['lesson']['course'];
                    $data[$num][] = $row['lesson']['category'];
                    $data[$num][] = $row['lesson']['sb_obj'];
                    $data[$num][] = $row['lesson']['element'];
                    $data[$num][] = $row['lesson']['groups'];
                    $data[$num][] = $row['lesson']['lpf_basic'];
                    $data[$num][] = $row['lesson']['lpf_advanced'];
                    $data[$num][] = $row['lesson']['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num][] = $row['lesson']['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num][] = $row['lesson']['expected_outcome'];
                    $data[$num][] = $foo['performance'];
                    $data[$num][] = Assessments_model::mode($foo['assessment_id']);
                    $rel_les = '';
                    foreach ($row['lesson']['rel_lessons'] as $key) {
                        $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                    }
                    $data[$num][] = $rel_les;
                    $data[$num][] = '相關項目編號';
                    $remarks = '';
                    foreach ($row['remarks'] as $remark) {
                        $remarks .=  '<button type="button" class="btn-xs btn btn-primary badge">' .Remarks_model::name($remark).'</button> &nbsp';
                    }
                    $data[$num][] = $remarks;
                    $num++;
                }
            }
        }
        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function edit()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);


        $data['action'] = __('修 改');


        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }

    public function preview()
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);
        $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;

        $postData = $_POST;

        // dump($_POST);
        if (!$_POST['module_id']) {
            $_SESSION['error_msg'] = __('請選擇年度學習單元');
            redirect(admin_url($data['page_setting']['controller']. '/'. $_POST['action']));
        } else if (!$_POST['subject_lessons']) {
            $_SESSION['error_msg'] = __('請選擇課程');
            redirect(admin_url($data['page_setting']['controller']. '/'. $_POST['action']));
        }

        $data['action'] = __('預 覽');
        $data['previous'] = $_POST['action'];
        $subject_id = $_POST['subject_id'];


        $data['subject'] = Subjects_model::name($subject_id);
        $data['annual_module'] = Modules_model::name($_POST['module_id']);
        $GLOBALS["datatable"] = 1;
        $postData = $this->input->post();
        $postData['added_ids'] = explode(',', $postData['subject_lessons'][0]);

        $_SESSION['post_data'] = $postData;
        $data['subject_id'] = $subject_id;
        $data['year_id'] = $year_id;
        $data['module_id'] = $_POST['module_id'];

        $data['added_ids'] =  $postData['added_ids'];
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'.$subject_lesson_id );

        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    public function submit_form(){
        $_SESSION['post_data'] = null;
        dump($_POST);
        
    }
}
