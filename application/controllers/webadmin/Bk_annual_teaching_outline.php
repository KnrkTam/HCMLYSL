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
            'scope' => __('年度教學大綱'), //change this
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
        $data['subjects_list'] = Subjects_model::list('all');
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

        $created_ato = Annual_teaching_outline_model::pluck('annual_subject_group_id')->unique()->toArray();
        
        $class_id = $asg->class_id;
        $group_name = $asg->group_name;// foreach ($created_ato as $row) {
        //     $created_class[] = Annual_subject_groups_model::find($row)->class_id; 
        // }
        $class_list = Annual_subject_groups_model::
            when($class_id, function($query, $class_id){
                return $query->whereRaw('(class_id != ? or class_id is null)', [$class_id]);
            })
            ->when($group_name, function($query, $group_name){
                return $query->whereRaw('(group_name != ? or group_name is null)', [$group_name]);
            })   
            ->where('year_id', $asg->year_id)
            ->where('subject_id', $asg->subject_id)
            ->where('level_id',$asg->level_id) 
            ->where('module_order', $asg->module_order)
            ->get();
            // dump($class_list);

        foreach ($class_list as $row) {
            $group_list[$row->id] = $row->class_id ? Classes_model::name($row->class_id): $row->group_name; 
        }

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
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $annual_subject_group_id);

        $data['function'] = "create";
        $data['id'] = $annual_subject_group_id;

        $data['year_id'] = $asg->year_id;
        $data['years_list'] = Years_model::list();
        $data['year'] = Years_model::annual($asg->year_id);
        $data['subject'] = Subjects_model::name($asg->subject_id);
        $data['group_name'] = $asg->group_name ? $asg->group_name  : Classes_model::name($asg->class_id);
        $data['group_id'] = $lessons_arr;
        $data['group_list'] = $group_list;
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
    

    public function edit($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        $GLOBALS["select2"] = 1;

        $result = Annual_teaching_outline_model::find($id);
        $data['subject'] = $result['subject'];

        $asg_id = $result->annual_subject_group_id;
        $asg_result = Annual_teaching_outline_model::where('annual_subject_group_id', $asg_id);
        $key_performances =  $asg_result->select('id','lesson_expected_outcome','lesson_performance')->get()->toArray();
        $expected_outcomes = $asg_result->pluck('lesson_expected_outcome')->unique()->toArray();
        foreach ($expected_outcomes as $row){
            $list[$row] = $row;
        }
        $data['asg_id'] = $asg_id;
        $data['id'] = $id;
        $data['expected_outcome'] = $list;
        $data['key_performances'] = $key_performances;
        $data['group_name'] = $result->group_name;
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/save_edit');
        $data['action'] = __('修 改');
        // dump($data);
        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }

    public function save_edit(){
        foreach ($_POST['id'] as $i => $id) {
            $result[$i] = array(
                'id' => $id,
                'lesson_additional_content' => $_POST['content'][$i] ? $_POST['content'][$i] : null, 
            );
            Annual_teaching_outline_model::find($id)->update($result[$i]);
        }
        // dump($result);
        $_SESSION['success_msg'] = __('修改補充內容成功');
        redirect(admin_url('bk_'.$this->scope. '/edit/'. $_POST['ato_id']));

    }

    public function select_expected_outcome(){
        $expected_outcome = $_POST['expected_outcome'];
        $asg_id = $_POST['asg_id'];

        $data = array();
        $add_contents = Annual_teaching_outline_model::where('annual_subject_group_id', $asg_id)
            ->where('lesson_expected_outcome', $expected_outcome)
            ->select('id', 'lesson_performance','lesson_additional_content', 'lesson_assessment', 'annual_module', 'lesson_group')
            ->get()
            ->toArray();

        foreach ($add_contents as $i => $row) {
            $add_content[$row['id']] = $row;
        }
        $data['groups'] = Annual_teaching_outline_model::where('annual_subject_group_id', $asg_id)
            ->where('lesson_expected_outcome', $expected_outcome)
            ->pluck('lesson_group')
            ->unique()
            ->toArray();

        $data['list'] =  Annual_teaching_outline_model::where('annual_subject_group_id', $asg_id)
            ->where('lesson_expected_outcome', $expected_outcome)
            ->pluck('lesson_performance')
            ->unique()
            ->toArray();

        $modules = Annual_teaching_outline_model::where('annual_subject_group_id', $asg_id)
            ->where('lesson_expected_outcome', $expected_outcome)
            ->pluck('module_id')
            ->unique()
            ->toArray();

        $data['common_value'] = Annual_teaching_outline_model::where('annual_subject_group_id', $asg_id)
            ->where('lesson_expected_outcome', $expected_outcome)
            ->pluck('common_value')
            ->unique()
            ->first();
        
        foreach ($modules as $row) {
            $data['modules'][] = Modules_model::name($row);
        }
        $data['add_content'] = $add_content;
        echo json_encode($data);
    }



    public function ajax(){
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        $year_id = $_GET['year_id'];
        $subject_id = $_GET['subject_id'];
        $result = Annual_subject_groups_model::where('year_id', $year_id)
        ->when($subject_id, function($query, $subject_id){
            return $query->where('subject_id', $subject_id);
        })
        ->get();
        // dump($_GET);
        $result_count = count($result);
        // dump($result_count);
        $data = array();
        $num = 0;
        if (!empty($result)) {
            foreach ($result as $key => $row) {
                $student_list = Annual_subject_groups_students_model::id_list($row['id']);
                $other_staff_list = Annual_subject_groups_other_staff_model::id_list($row['id']);
                $annual_teaching_outline = Annual_teaching_outline_model::where('annual_subject_group_id', $row['id'])->first();
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
                $data[$num]['annual_module'] = $annual_teaching_outline ? $annual_teaching_outline->annual_module : null;
                $data[$num]['annual_teaching_outline'] = $annual_teaching_outline ? '   <ul class="colorMapList inlinelist"><li class="text-green bold"> <a href="'.admin_url(current_controller() . '/view/'. $annual_teaching_outline->id).'">查 閱</a></li></ul>' : ' <ul class="colorMapList inlinelist"><li class="text-orange bold"><a href="'.admin_url(current_controller() . '/create/'. $row['id'] ).'">新 增</a></li></ul>';
                $num++;
            }
        }

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $_GET['length']));

        echo $return;

    }

    public function search_ajax() 
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $module_id = $_GET['module_id']; 
        $year_id = $_GET['year_id'];
        $offset = (int)$_GET['start'];
        $pagination = (int)$_GET['length'];

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
                        $lessons_arr[] = array(
                            'lesson' => Lessons_model::table_list($lesson_id), 
                            'subject_lesson_id' =>  $subject_lesson_id, 
                            'subject_cat_id' => $subject_lesson->subject_category_id, 
                            'subject_id' => $subject_lesson->subject_id, 
                            'modules' =>  Subject_lessons_modules_model::moduleList($subject_lesson_id, $year_id), 
                            'remarks' => Lessons_remarks_model::id_list($subject_lesson_id), 
                            'group_id' => $group_id, 
                            'additional_content' => $add_content, 
                            'subject_lesson_module_id' => $subject_lesson_module_id
                        );
                    }                
                }
            }
        }
        $filtered_lessons = array_slice($lessons_arr, $offset, $pagination);


        $result_count = count($lessons_arr);
        //rearrange data
        $data = array();
        $num = 0;
        
        if (!empty( $filtered_lessons)) {  
            foreach ($filtered_lessons as $key => $row) {
                $lesson_performance = Key_performances_model::where('subject_lesson_id', $row['subject_lesson_id'])->get();
                foreach ($lesson_performance as $i => $foo ) {
                    $add_content_box = array();
                    // dump($row['modules']);
                    foreach ($row['modules'] as $m => $module) {
                        $add_content_box[] = $m;

                    }
                    // dump($add_content_box);
                    $data[$num]['id'] = '<input type="checkbox" class="addLesson" data-group="'.$row['group_id'].'"  data-key_performance="'.$foo['id'].'" value="'.$row['subject_lesson_id'].'"/>';
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

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "start"=> $_GET['start'], "get" => $_GET, "recordsTotal" =>   $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function search_ajax_common() 
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $year_id = $_GET['year_id'];
        $offset = (int)$_GET['start'];
        $pagination = (int)$_GET['length'];
        $subject_id = Subjects_model::where('name', '共通能力')->first()->id;
    
        $searched_lessons = Subject_lessons_modules_model::search($year_id, $subject_id, null, null, null);
        if ($searched_lessons) {
            foreach ($searched_lessons as $y => $subject_lesson_module_id) {
                $sub_ann_module = Subject_lessons_modules_model::find($subject_lesson_module_id);

                $subject_id = $sub_ann_module->subject_id;
                $subject_lesson = $sub_ann_module->subject_lesson;
                $lesson = Lessons_model::find($subject_lesson->lesson_id);
                $lesson_id = $lesson->id;
                $group_count = Lessons_group_model::id_list($lesson_id);
                $subject_lesson_id = $subject_lesson->id;

                foreach ($group_count as $group_id => $group) {
                    $lessons_arr[] = array(
                        'lesson' => Lessons_model::table_list($lesson_id), 
                        'subject_lesson_id' =>  $subject_lesson_id, 
                        'subject_cat_id' => $subject_lesson->subject_category_id, 
                        'subject_id' => $subject_lesson->subject_id, 
                        'modules' =>  Subject_lessons_modules_model::moduleList($subject_lesson_id, $year_id), 
                        'remarks' => Lessons_remarks_model::id_list($subject_lesson_id), 
                        'group_id' => $group_id, 
                        'additional_content' => $add_content, 
                        'subject_lesson_module_id' => $subject_lesson_module_id
                    );
                }                
            }
        }
    
        // $filtered_lessons = array_slice($lessons_arr, $offset, $pagination);
 

        $result_count = count($lessons_arr);
        // dump($result_count);
        //rearrange data
        $data = array();
        $num = 0;
        // dump($_GET);
        
        if (!empty( $lessons_arr)) {  
            foreach ($lessons_arr as $key => $row) {
                $lesson_performance = Key_performances_model::where('subject_lesson_id', $row['subject_lesson_id'])->get();
                foreach ($lesson_performance as $i => $foo ) {
                    $add_content_box = array();
                    foreach ($row['modules'] as $m => $module) {
                        $add_content_box[] = $m;

                    }
                    $data[$num]['id'] = '<input type="checkbox" class="addCommon" data-group="'.$row['group_id'].'"  data-key_performance="'.$foo['id'].'" value="'.$row['subject_lesson_id'].'"/>';
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
        // dump($result_count);

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "start"=> $_GET['start'], "get" => $_GET, "recordsTotal" =>   $result_count, "recordsFiltered" => $result_count));

        echo $return;
    }

    public function validate($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);
        // $year_id = Years_model::orderBy('year_to', 'DESC')->first()->id;
        // dump($_POST);
        $id = $_POST['id'];
        $annual_module_id = $_POST['annual_module_id'];
        $raw_added_ids = $_POST['added_ids'];
        $raw_common_ids = $_POST['common_ids'];
        
        switch(true) {
            case (!$id);
            $data = array(
                'status' => 'Error',
            );
            break;
            case (empty($annual_module_id) && $annual_module_id != 0);
            $data = array(
                // 'status' => '請選擇年度學習單元',
                'status' => $annual_module_id,

            );
            break;
            case (!$raw_added_ids);
            $data = array(
                'status' => '請選擇教學項目',
            );
            break;
            default;
            $data = array(
                'status' => 'success',
            );
        } 

        foreach ($raw_added_ids as $i => $row) {
            $lesson_arr[$i] = array('group' => explode(",", $row)[0], 'key_performance' =>  explode(",", $row)[1]);
        }
        foreach ($raw_common_ids as $i => $common_id) {
            $common_arr[$i] = array('group' => explode(",", $common_id)[0], 'key_performance' =>  explode(",", $common_id)[1]);
        }
        
        echo json_encode($data);

    }


    public function preview($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        $GLOBALS["datatable"] = 1;
        $GLOBALS["select2"] = 1;

        $previous = $_POST['action'];
        // dump($_POST);
        $group_ids = $_POST['mutual_group_id'] ? $_POST['mutual_group_id'] : array() ;

        array_push($group_ids, $id);
        // dump()
        // dump($group_ids);

        $selected_lessons_arr = explode(",", $_POST['selected_lessons'][0]);
        foreach ($selected_lessons_arr as $row) {
            $raw = explode("_", $row);
            $subject_lesson_id = Key_performances_model::find($raw[1])->subject_lesson_id;
            $selected_lessons[] = array(
                'group_id' => (int)$raw[0], 
                "key_performance_id" => (int)$raw[1], 
                "subject_lesson_id" => $subject_lesson_id
            );
        }

        $common_lessons_arr = explode(",", $_POST['common_lessons'][0]);
        foreach ($common_lessons_arr as $row) {
            $raw = explode("_", $row);
            $subject_lesson_id = Key_performances_model::find($raw[1])->subject_lesson_id;
            $common_lessons[] = array(
                'group_id' => (int)$raw[0], 
                "key_performance_id" => (int)$raw[1], 
                "subject_lesson_id" => $subject_lesson_id
            );
        }

        $data['added_ids'] =  $selected_lessons;
        // dump($selected_lessons);

        $data['common_ids'] =  $common_lessons;
        $asg = Annual_subject_groups_model::find($id);
        $data['year_id'] = $asg->year_id;
        $data['year'] = Years_model::annual($asg->year_id);
        $data['subject'] = Subjects_model::name($asg->subject_id);
        foreach ($group_ids as $group_id) {
            $group_asg =  Annual_subject_groups_model::find($group_id);
            $group_list[] = $group_asg -> group_name ? $group_asg ->group_name  : Classes_model::name($group_asg ->class_id);

        }
        $data['group_name'] = implode(', ', $group_list);
        $data['group_ids'] = $group_ids;
        $data['module'] = Modules_model::order_list($asg->module_order);
        $module_week = Modules_week_model::where('year_id', $asg->year_id)->where('level_id', $asg->level_id)->first();
        $data['week_from'] = $module_week['week_from_'.$asg->module_order];
        $data['week_to'] = $module_week['week_to_'.$asg->module_order];
        $data['annual_module'] = $_POST['annual_module_id'] == 0 ? '不適用' : Modules_model::name($_POST['annual_module_id']);
        $data['previous'] = $previous;
        $data['post_data'] = $_POST;
        $data['action'] = __('預 覽');
        $data['id'] = $id;


        $data['post_data'] = array(
            'annual_subject_group_id' => $id,
            'annual_module_id' => $_POST['annual_module_id'],
            'year' => Years_model::annual($asg->year_id),
            'subject' => Subjects_model::name($asg->subject_id),
            'group_name' => $asg->group_name ? $asg->group_name  : Classes_model::name($asg->class_id),
            'week_from' => $module_week['week_from_'.$asg->module_order],
            'week_to' => $module_week['week_to_'.$asg->module_order],
        );

        
        foreach ($module_id as $row) {
            $data['preview_modules'] .= '<button type="button" style="margin: 1px;" class="btn btn-success">'. Modules_model::order_list($row) .'</button>';
        }
    
        foreach ($other_staff_id as $row) {
            $data['preview_other_staff'] .= '<li>'.Staff_model::name($row) .'</li>';
        }


        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'. $id );
        // dump($data);


        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    

    public function preview_ajax($common = null) 
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);


        $offset = (int)$_GET['start'];
        $pagination = (int)$_GET['length'];
        $year_id = $_GET['year_id'];
        if ($common) {
            $added_ids = $_GET['common_ids'];
        } else {
            $added_ids = $_GET['added_ids'];
        };
        
        // dump($_GET);

        if ($added_ids) {
            foreach ($added_ids as $row) {
                $key_performance = Key_performances_model::find($row['key_performance_id']);
                $subject_lesson = Subject_lessons_model::find($key_performance['subject_lesson_id']);
                $lesson_id = $subject_lesson->lesson_id;
                $searched_lessons[] = array(
                    'lesson' => Lessons_model::table_list($lesson_id), 
                    'key_performance' => $key_performance, 
                    'group_id' => $row['group_id'], 
                    'subject_id' => $subject_lesson['subject_id'],
                    'subject_lesson_id' => $subject_lesson->id, 
                    'remarks' => Lessons_remarks_model::id_list($subject_lesson->id)
                );
            }

            $selected_lessons = array_slice($searched_lessons, $offset, $pagination);
    
            $result_count = count($searched_lessons);
        }

        //rearrange data
        $data = array();
        $num = 0;
        if (!empty($selected_lessons)) {
            foreach ($selected_lessons as $key => $row) {
                $modules = Subject_lessons_modules_model::moduleList($row['subject_lesson_id'], $year_id);
                $subject_lessons_modules_id = Subject_lessons_modules_model::where('year_id', $year_id)->where('subject_lessons_id', $row['subject_lesson_id'])->first()->id;
                // $data[$num]['id'] = '<input type="checkbox" class="addCommon" data-group="'.$row['group_id'].'"  data-key_performance="'.$foo['id'].'" value="'.$row['subject_lesson_id'].'"/>';
                $data[$num]['code'] = $row['lesson']['code'];
                $data[$num]['subject'] = Subjects_model::name($row['subject_id']);
                $data[$num]['course'] = $row['lesson']['course'];
                $data[$num]['category'] = $row['lesson']['category'];
                $data[$num]['sb_obj'] = $row['lesson']['sb_obj'];
                $data[$num]['element'] = $row['lesson']['element'];
                $data[$num]['group'] =  Groups_model::name($row['group_id']);
                $data[$num]['expected_outcome'] = $row['lesson']['expected_outcome'];
                $add_box = "";
                foreach ($modules as $module_id => $module_name) {
                    $add_box .= '<p class="text-blue"><strong class="text-black">'.$module_name.':</strong> &nbsp  '. Additional_contents_model::content((int)$row['group_id'],$module_id, $subject_lessons_modules_id).'</p>';
                }
                $module_add_content = Additional_contents_model::where('subject_lessons_module_id', $subject_lessons_modules_id)->first();
                $data[$num]['addon'] =  $module_add_content ? $add_box : null;

                $data[$num]['performance'] = $row['key_performance']['performance'];
                $data[$num]['assessment'] = Assessments_model::mode($row['key_performance']['assessment_id']);
                $rel_lessons = "";

                foreach ($row['lesson']['rel_lessons'] as $rel) {
                    $rel_lessons .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($rel).'</button> &nbsp';
                }
                $data[$num]['related_lesson'] = $rel_lessons ? $rel_lessons : 'null';
                $data[$num]['rel_code'] = $row['lesson']['rel_code'] ? $row['lesson']['rel_code'] : '暫無相關項目編號';
                $remarks = '';
                foreach ($row['remarks'] as $remark) {
                    $remarks .=  '<button type="button" class="btn-xs btn btn-primary badge">' .Remarks_model::name($remark).'</button> &nbsp';
                }
                $data[$num]['remarks'] = $remarks;
                $num++;
            }
        }
        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;
    }


    public function view($annual_teaching_outline_id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        $GLOBALS["datatable"] = 1;
        $GLOBALS["select2"] = 1;

        $ato = Annual_teaching_outline_model::find($annual_teaching_outline_id);
        $data['id'] = $ato->id;
        $data['year'] = $ato->year;
        $data['subject'] = $ato->subject;
        $data['group_name'] = $ato->group_name;
        $data['annual_module'] = $ato->annual_module;
        $data['module'] = Modules_model::order_list($ato->module_order);
        $data['week_from'] = $ato->week_from;
        $data['week_to'] = $ato->week_to;
    
        $data['action'] = __('查 閱');

        $annual_subject_group_id = $ato->annual_subject_group_id;

        $searched_arr = Annual_teaching_outline_model::where('annual_subject_group_id', $annual_subject_group_id)->where('common_value', 0)->get();

        $table_data = array();
        $num = 0;
        if (!empty($searched_arr)) {
            foreach ($searched_arr as $row) {
                $module_name = explode(';',$row->lesson_module)[1];
                $table_data[$num]['code'] = $row->lesson_code;
                $table_data[$num]['subject'] = $row->lesson_subject;
                $table_data[$num]['course'] = $row->lesson_course;
                $table_data[$num]['category'] = $row->lesson_category;
                $table_data[$num]['sb_obj'] = $row->lesson_sb_obj;
                $table_data[$num]['element'] = $row->lesson_element;
                $table_data[$num]['group'] =  $row->lesson_group;
                $table_data[$num]['expected_outcome'] = $row->lesson_expected_outcome;            
                $table_data[$num]['addon'] =  $row->lesson_additional_content ?  $module_name. ': <a class="small">'.$row->lesson_additional_content.'</span>': $module_name .':';
                $table_data[$num]['performance'] = $row->lesson_performance;
                $table_data[$num]['assessment'] = $row->lesson_assessment;
                $table_data[$num]['related_lesson'] = $row->lesson_relevant_lesson ? $row->lesson_relevant_lesson: '暫無相關課程編號	';
                $table_data[$num]['rel_code'] = $row->lesson_relevant_code ? $row->lesson_relevant_code : '暫無相關項目編號';
                $table_data[$num]['remarks'] = $row->lesson_remarks;
                $num++;
            }
        }

        $common_arr = Annual_teaching_outline_model::where('annual_subject_group_id', $annual_subject_group_id)->where('common_value', 1)->get();
        $common_data = array();
        $num = 0;
        if (!empty($common_arr)) {
            foreach ($common_arr as $row) {
                $module_name = explode(';',$row->lesson_module)[1];
                $common_data[$num]['code'] = $row->lesson_code;
                $common_data[$num]['subject'] = $row->lesson_subject;
                $common_data[$num]['course'] = $row->lesson_course;
                $common_data[$num]['category'] = $row->lesson_category;
                $common_data[$num]['sb_obj'] = $row->lesson_sb_obj;
                $common_data[$num]['element'] = $row->lesson_element;
                $common_data[$num]['group'] =  $row->lesson_group;
                $common_data[$num]['expected_outcome'] = $row->lesson_expected_outcome;            
                $common_data[$num]['addon'] =  $row->lesson_additional_content ?  $module_name. ': <a class="small">'.$row->lesson_additional_content.'</span>': $module_name .':';
                $common_data[$num]['performance'] = $row->lesson_performance;
                $common_data[$num]['assessment'] = $row->lesson_assessment;
                $common_data[$num]['related_lesson'] = $row->lesson_relevant_lesson ? $row->lesson_relevant_lesson: '暫無相關課程編號	';
                $common_data[$num]['rel_code'] = $row->lesson_relevant_code ? $row->lesson_relevant_code : '暫無相關項目編號';
                $common_data[$num]['remarks'] = $row->lesson_remarks;
                $num++;
            }
        }
   
        $data['table_data'] = $table_data;
        $data['common_data'] = $common_data;
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/edit/'. $annual_teaching_outline_id);

        $this->load->view('webadmin/' . $this->scope . '_view',  $data);
    }


    public function submit_form($asg_id = null){
        $added_ids = json_decode($_POST['added_id'][0]);
        $group_ids = json_decode($_POST['group_ids'][0]);
        $common_ids = json_decode($_POST['common_id'][0]);
        $post_data = json_decode($_POST['post_data']);
        $annual_module = $_POST['annual_module'];
        $annual_module_id = $post_data->annual_module_id;
        $week_from = $post_data->week_from;
        $week_to = $post_data->week_to;
        $asg = Annual_subject_groups_model::find($asg_id); 
        $year_id = $asg->year_id;


        foreach ($added_ids as $added_id) {
            $key_performance = Key_performances_model::find($added_id->key_performance_id);
            $subject_lesson = Subject_lessons_model::find($key_performance->subject_lesson_id);
            $lesson_id = $subject_lesson->lesson_id;
            $lesson = Lessons_model::table_list($lesson_id);
            $modules = Subject_lessons_modules_model::moduleList( $subject_lesson->id, $year_id);
            $subject_lessons_modules_id = Subject_lessons_modules_model::where('year_id', $year_id)->where('subject_lessons_id', $subject_lesson->id)->first()->id;
            $rel_les_arr = array();
            foreach ($lesson['rel_lessons'] as $rel_les_id) {
                $rel_les_arr[] = Lessons_model::code($rel_les_id);
            }
            foreach ($modules as $module_id => $module_name) {
                $addon = Additional_contents_model::content($added_id->group_id,$module_id, $subject_lessons_modules_id);
                foreach ($group_ids as $groups_asg_id) {
                    $group_asg = Annual_subject_groups_model::find($groups_asg_id);
                    $data = array(
                        'year' => Years_model::annual($year_id),
                        'subject' => $post_data->subject,
                        'group_name' => $group_asg->group_name ? $group_asg->group_name  : Classes_model::name($group_asg->class_id),
                        'module_order' => $asg->module_order,
                        'annual_module' => $annual_module,
                        'lesson_code' => Lessons_model::code($lesson_id), 
                        'lesson_group' => Groups_model::name($added_id->group_id), 
                        'lesson_subject' => Subjects_model::name($subject_lesson->subject_id),
                        'lesson_course' => $lesson['course'],
                        'lesson_category' => $lesson['category'],
                        'lesson_sb_obj' => $lesson['sb_obj'],
                        'lesson_element' => $lesson['element'],
                        'lesson_expected_outcome' => $lesson['expected_outcome'],
                        'lesson_performance' => $key_performance->performance,
                        'lesson_additional_content' => $addon,
                        'lesson_assessment' => Assessments_model::mode($key_performance->assessment_id), 
                        'lesson_relevant_code' => $lesson['rel_code'],
                        'lesson_remarks' => $lesson['lesson_remark'],
                        'lesson_relevant_lesson' => implode(',', $rel_les_arr),
                        'lesson_module' =>  $module_id.';'.$module_name, 
                        'subject_lesson_id' => $subject_lesson->id, 
                        'key_performance_id' => $key_performance->id,
                        'group_id' => $added_id->group_id,
                        'module_id' => $module_id, 
                        'annual_subject_group_id' => $groups_asg_id,
                        'common_value' => 0,
                        'annual_module_id' => $annual_module_id,
                        'week_from' => $week_from,
                        'week_to' => $week_to,
                        'additional_content' => Additional_contents_model::id($added_id->group_id,$module_id, $subject_lessons_modules_id),
                    );
                    Annual_teaching_outline_model::create($data);
              
                }
            }
        }

        foreach ($common_ids as $added_id) {
            $key_performance = Key_performances_model::find($added_id->key_performance_id);
            $subject_lesson = Subject_lessons_model::find($key_performance->subject_lesson_id);
            $lesson_id = $subject_lesson->lesson_id;
            $lesson = Lessons_model::table_list($lesson_id);
            $modules = Subject_lessons_modules_model::moduleList( $subject_lesson->id, $year_id);
            $subject_lessons_modules_id = Subject_lessons_modules_model::where('year_id', $year_id)->where('subject_lessons_id', $subject_lesson->id)->first()->id;
            // dump('lesson',$lesson);
            foreach ($lesson['rel_lessons'] as $rel_les_id) {
                $rel_les_arr[] = Lessons_model::code($rel_les_id);
            }
            foreach ($modules as $module_id => $module_name) {
                $addon = Additional_contents_model::content($added_id->group_id,$module_id, $subject_lessons_modules_id);
        
                foreach ($group_ids as $groups_asg_id) {
                    $group_asg = Annual_subject_groups_model::find($groups_asg_id);
                    // dump($group_asg);
                    $data = array(
                        'year' => Years_model::annual($year_id),
                        'subject' => $post_data->subject,
                        'group_name' => $group_asg->group_name ? $group_asg->group_name  : Classes_model::name($group_asg->class_id),
                        'module_order' => $asg->module_order,
                        'annual_module' => $annual_module,
                        'lesson_code' => Lessons_model::code($lesson_id), 
                        'lesson_group' => Groups_model::name($added_id->group_id), 
                        'lesson_subject' => Subjects_model::name($subject_lesson->subject_id),
                        'lesson_course' => $lesson['course'],
                        'lesson_category' => $lesson['category'],
                        'lesson_sb_obj' => $lesson['sb_obj'],
                        'lesson_element' => $lesson['element'],
                        'lesson_expected_outcome' => $lesson['expected_outcome'],
                        'lesson_performance' => $key_performance->performance,
                        'lesson_additional_content' => $addon,
                        'lesson_assessment' => Assessments_model::mode($key_performance->assessment_id), 
                        'lesson_relevant_code' => $lesson['rel_code'],
                        'lesson_remarks' => $lesson['lesson_remark'],
                        'lesson_relevant_lesson' => implode(',', $rel_les_arr),
                        'lesson_module' =>  $module_id.';'.$module_name, 
                        'subject_lesson_id' => $subject_lesson->id, 
                        'key_performance_id' => $key_performance->id,
                        'group_id' => $added_id->group_id,
                        'module_id' => $module_id, 
                        'annual_subject_group_id' => $groups_asg_id,
                        'common_value' => 1,
                        'annual_module_id' => $annual_module_id,
                        'week_from' => $week_from,
                        'week_to' => $week_to,
                        'additional_content' => Additional_contents_model::id($added_id->group_id,$module_id, $subject_lessons_modules_id),
                    );
                    Annual_teaching_outline_model::create($data);
                }
            }
        }

        
        $_SESSION['success_msg'] = __('儲存年度教學大綱成功');
        redirect(admin_url('bk_'.$this->scope));

    }
}
