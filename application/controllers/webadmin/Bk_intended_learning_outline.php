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


    public function index()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;
        $data['subject_list'] = Subjects_model::list('all');
        $data['modules_list'] = Modules_model::list();
        $data['select_list'] = Modules_model::list();
        $data['remarks_list'] = Remarks_model::list();
        $data['subject_categories_list'] = json_encode(Subject_categories_model::optionList('All')); 

        if ($_POST) {
            $sub_cat= Subject_categories_model::where('subject_id', $_POST['subject_id'])->get();
            $list[0] = '所有科目範疇';

            foreach ($sub_cat as $i => $row) {
                $list[$row['id']] = $row['name'];
            }
            $data['subject_id'] = $_POST['subject_id'];
            $data['annual_module_id'] = $_POST['annual_module_id'];
            $data['subject_category_id'] = $_POST['subject_category_id'];
            $data['remark_id'] = $_POST['remark_id'];
            // $data['subject_categories_list'] = $list;
        }


        $_SESSION['post_data'] = null;
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
        $category_id = $_GET['category_search'];
        $remark_ids = $_GET['remark_search'];

        $offset = (int)$_GET['start'];
        $pagination = (int)$_GET['length'];


        if ($category_id == 'undefined') {
            $category_id = null;
        }
        $intended_learning_outline = Subject_lessons_modules_model::search($year_id, $subject_id, $module_id, $category_id, $remark_ids);

        if ($intended_learning_outline) {
            foreach ($intended_learning_outline as $y => $subject_lesson_module_id) {
                $sub_ann_module = Subject_lessons_modules_model::find($subject_lesson_module_id);
                $subject_id = $sub_ann_module->subject_id;
                $subject_lesson = $sub_ann_module->subject_lesson;
                $lesson = Lessons_model::find($subject_lesson->lesson_id);
                $lesson_id = $lesson->id;
                $group_count = Lessons_group_model::list($lesson->id);
                $subject_lesson_id = $subject_lesson->id;

                $group_id = $group_count;

                $lessons_arr[$y] = array('id' => $subject_lesson_module_id, 'lesson' => Lessons_model::table_list($lesson_id), 'subject_lesson_id' =>  $subject_lesson_id, 'subject_cat_id' => $subject_lesson->subject_category_id, 'subject_id' => $subject_id, 'count' => $y, 'modules' => Subject_lessons_modules_model::moduleList($subject_lesson_id, $year_id), 'remarks' => Lessons_remarks_model::id_list($subject_lesson_id), 'group_id' => $group_id);
            }
        }
        // dump($lessons_arr);
        $result_count = count($lessons_arr);

        $paginated_result = array_slice($lessons_arr, $offset, $pagination, true);

        // dump($result_count);
        $data = array();
        $num = 0;
        if (!empty( $lessons_arr)) {
            foreach ($paginated_result as $key => $row) {
                $lesson_performance = Key_performances_model::where('subject_lesson_id', $row['subject_lesson_id'])->get();
                foreach ($lesson_performance as $foo ) {
                    $modules_arr = Subject_lessons_modules_model::where('subject_lessons_id', $row['subject_lesson_id'])->where('year_id', $year_id)->pluck('module_id')->toArray();

                    $data[$num]['edit'] = '<a class="editLinkBtn" href="#" data-id="'.$row['id'].'" data-subject_lesson="'.$row['subject_lesson_id'].'" data-subject="'.Subjects_model::name($row['subject_id']).'" data-subject_cat="'.Subject_categories_model::name($row['subject_cat_id']).'" data-modules="'.json_encode($modules_arr) .'"  data-lesson="'.$row['lesson']['code'].'" data-toggle="modal" data-target="#editDetail" ><i class="fa  fa-edit"></i></a>';
                    $data[$num]['subject'] = Subjects_model::name($row['subject_id']);
                    $data[$num]['subject_category'] = Subject_categories_model::name($row['subject_cat_id']);
                    $data[$num]['lesson'] = $row['lesson']['code'];
                    $data[$num]['course'] = $row['lesson']['course'];
                    $data[$num]['category'] = $row['lesson']['category'];
                    $data[$num]['sb_obj'] = $row['lesson']['sb_obj'];
                    $data[$num]['element'] = $row['lesson']['element'];
                    $data[$num]['groups'] = $row['group_id'];
                    $data[$num]['lpf_basic'] = $row['lesson']['lpf_basic'];
                    $data[$num]['lpf_advanced'] = $row['lesson']['lpf_advanced'];
                    $data[$num]['poas'] = $row['lesson']['poas'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num]['skills'] = $row['lesson']['skills'].'<span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    $data[$num]['expected_outcome'] = in_array('1', $row['remarks']) ? $row['lesson']['expected_outcome'] . '<span class="highlight text-aqua"><i class="fa fa-circle"/><span>' : $row['lesson']['expected_outcome'];
                    $modules = "";
                    foreach ($row['modules'] as $module) {
                        $modules .=  $module. '&nbsp';
                    }
                    $data[$num]['modules'] = $modules;
                    $data[$num]['performance'] = $foo['performance'];
                    $remarks = '';
                    foreach ($row['remarks'] as $remark) {
                        $remarks .=  '<button type="button" class="btn-xs btn btn-primary badge">' .Remarks_model::name($remark).'</button> &nbsp';
                    }
                    $data[$num]['remarks'] = $remarks;
                    $num++;
                }
            }
        }
        // dump($result_count);

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }


    public function select_subject()
    {
        $id = $_POST['subject_id'];
        $list = array();
        $sub_cat= Subject_categories_model::where('subject_id', $id)->get();
        // $sub_cat = Subject_categories_model::where('subject_id', $id)->whereNotIn('id', $existing_arr)->get();
       

        foreach ($sub_cat as $i => $row) {
            $list[$i+1] = array('id' => $row['id'], 'text' => $row['name']);

        }

        $list[0] = array ('id' => 'undefined','text' => '所有科目範疇');
        sort($list);
    
        echo json_encode($list);
    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');
        $data['action'] = __('新 增');
        $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;
        $data['subject_categories_list'] = json_encode(Subject_categories_model::optionList('All')); 
        // dump( $data['subject_categories_list']);
        if ($_SESSION['post_data']) {
            $data['subject_id'] = $_SESSION['post_data']['subject_id'];
            $data['module_id'] = $_SESSION['post_data']['module_id'];
        }

        $data['subject_list'] = Subjects_model::list();
        $data['annual_modules_list'] = Annual_modules_model::year_list($year_id);
        $data['remarks_list'] = Remarks_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }

    public function validate()
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);
        $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;
        // dump($_POST);
        $postData = $this->input->post();
        $subject_id = $postData['subject_id'];
        $subject_lessons = explode(',', $postData['subject_lessons']);
        $module_id = $postData['module_id'];

        foreach ($subject_lessons as $i => $row) {
            $duplicated_sub = Subject_lessons_modules_model::where('year_id', $year_id)->where('module_id', $module_id)->where('subject_lessons_id', $row)->where('subject_id', $subject_id)->first()->subject_lessons_id;
            $duplicated = Subject_lessons_model::find($duplicated_sub)->lesson_id;

            if ($duplicated) {
                $check[] = $duplicated;
            }
        }

        switch(true) {
            case (!$subject_id);
            $data = array(
                'status' => '請選擇科目',
            );
            break;

            case (!$postData['module_id']);
            $data = array(
                'status' => '請選擇年度學習單元',
            );
            break;

            case (strlen($postData['subject_lessons']) == 0);
            $data = array(
                'status' => '請選擇選擇教學大綱項目',
            );
            break;
            case (count($check) > 0);
            $data = array(
                'status' => '已存在課程'. json_encode(Lessons_model::code($check)),
            );
            break;
            default;
            $data = array(
                'status' => 'success',
            );
        }
        echo json_encode($data);

    }

    public function search_ajax() 
    {
        // $postData = $this->input->post();
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        
        $sb_obj_id = $_GET['sb_obj_search'];
        $annual_module_id = $_GET['annual_module_search'];
        $sub_category_id = $_GET['subject_category_search'];

        // $subject_id = $_GET['subject_search'];
        $subject_id = Subject_categories_model::find($sub_category_id)->subject_id;
        // dump($_GET);

        // dump($sub_category_id);
        // dump($subject_id);

        $offset = (int)$_GET['start'];
        $pagination = (int)$_GET['length'];
        if ($_GET['subject_category_search'] == 'undefined' || empty($_GET['subject_category_search'])) {
            $sub_category_id = 0;
        }

        $filtered_lessons = Lessons_model::subjectList($sub_category_id,$sb_obj_id, $lesson_id, $subject_id);
        // dump($filtered_lessons);
        foreach ($filtered_lessons as $i =>$row) {  
            $lessons_arr[$i] = array('lesson' => Lessons_model::table_list($row['id']), 'subject_lesson_id' => $row['sub_lesson_id'], 'subject_cat_id' => Subject_lessons_model::find($row['sub_lesson_id'])->subject_category_id, 'remarks' => Lessons_remarks_model::id_list( $row['sub_lesson_id']));
        }
        // }
        // dump($lessons_arr);
        
        $result_count = count($lessons_arr);
        //rearrange data
        $data = array();
        $name = array();
        $num = 0;
        
        
        if (!empty( $lessons_arr)) {  
            // dump($lessons_arr);  
            foreach ( $lessons_arr as $key => $row) {
                $subject_lesson = Subject_lessons_model::find($row['subject_lesson_id']);
                $subject_lesson_id = $subject_lesson->id;
                $subject_id =  $subject_lesson->subject_id;

                $lesson_performance = Key_performances_model::where('subject_lesson_id', $subject_lesson_id)->get();
                foreach ($lesson_performance as $foo ) {
                    $data[$num][] = '<input type="checkbox" class="addLesson" value="'.$row['subject_lesson_id'].'"/>';
                    $data[$num][] = Subjects_model::name($subject_id);
                    $data[$num][] = Subject_categories_model::name($row['subject_cat_id']);
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

        public function edit($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);

        $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;
        $subject_lesson_id = $_POST['subject_lesson_id'];
        $new_module_arr = $_POST['module_arr'];
        $old_module_arr = Subject_lessons_modules_model::where('subject_lessons_id', $_POST['subject_lesson_id'])->pluck('module_id')->toArray();

        sort($new_module_arr);
        sort($old_module_arr);
        $delete_result = array_diff($old_module_arr,  $new_module_arr );
        $add_result = array_diff( $new_module_arr ,$old_module_arr);

        switch (true) {
            case ($new_module_arr == $old_module_arr):
                $data = array(
                    'status' => 'no_change',
                );
                break;
            case ($delete_result):
                foreach ($delete_result as $row){
                    Subject_lessons_modules_model::where('module_id', $row)->where('subject_lessons_id', $subject_lesson_id)->where('year_id', $year_id)->update(array('status' =>  0, 'deleted' => 1));
                }
            case ($add_result):
                foreach ($add_result as $row){
                    $data = array(
                        'year_id' => $year_id,
                        'module_id' => $row, 
                        'subject_lessons_id' => $subject_lesson_id,
                    );
                    $created_id = Subject_lessons_modules_model::updateOrCreate($data, array('status' => 1, 'deleted' => 0));
                }
                
                $_SESSION['success_msg'] = __('修改單元成功');

                $data = array(
                    'status' =>  'success',
                );
            break;
            case ($new_module_arr == null):
                Subject_lessons_modules_model::where('subject_lessons_id', $subject_lesson_id)->where('year_id', $year_id)->update(array('status' =>  0, 'deleted' => 1));
                $_SESSION['success_msg'] = __('修改單元成功');

                $data = array(
                    'status' =>  'success',
                );
            break;
        }


        echo json_encode($data);

    }

    public function preview()
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);
        $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;

        $postData = $_POST;

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
        $added_ids = json_decode($_POST['lessons_id'][0],true); 
        $subject_id = $_POST['subject_id'];
        $module_id = $_POST['module_id'];
        $year_id = $_POST['year_id'];

        foreach ($added_ids as $subject_lessons_id) {
            $lesson_id = Subject_lessons_model::find($subject_lessons_id)->lesson_id;
            
            $lesson = Lessons_model::find($lesson_id);

            $groups_arr = Lessons_group_model::where('lesson_id', $lesson->id)->pluck('group_id')->toArray();
            foreach ($groups_arr as $group_id) {
                $data = array(
                    'year_id' => $year_id,
                    'module_id' => $module_id,
                    'subject_lessons_id' => $subject_lessons_id,
                    'subject_id' => $subject_id,
                );
                Subject_lessons_modules_model::create($data); 
            }
        }

        $_SESSION['success_msg'] = __('新增既定單元大綱成功');

        redirect(admin_url('bk_'.$this->scope));
        
    }
}
