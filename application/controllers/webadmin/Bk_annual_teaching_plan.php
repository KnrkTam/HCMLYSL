<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_annual_teaching_plan extends CI_Controller //change this
{
    private $scope = 'annual_teaching_plan'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('年度教案'), //change this
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


        if ($_POST) {
            $data['year_id'] = $_POST['year_id'];
            $data['subject_id'] = $_POST['subject_id'];
            $data['module_id'] = $_POST['module_id'];
            $data['status_id'] = $_POST['status_id'];
            $data['staff_id'] = $_POST['staff_id'];
            // dump($data);
        }
        
        $year_id = Years_model::orderBy('year_from', 'DESC')->first()->id;
        $data['year_id'] = $year_id; 
        $data['years_list'] = Years_model::list();
        $data['subjects_list'] = Subjects_model::list('all');
        $data['module_list'] = Modules_model::order_list();
        $data['staff_list'] = Staff_model::list('All');
        array_unshift($data['module_list'], '全部單元');
        // dump($data);

        $data['status_list'] = array(
            0 => '全部',
            1 => '未提交',
            2 => '已提交',
            3 => '已審批',
        );
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        // dump($_POST);

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }


    public function ajax(){
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        $year_id = $_GET['year_id'];
        $subject_id = $_GET['subject_id'];
        $module_id = $_GET['module_id'];
        $staff_id = $_GET['staff_id'];

        $result = Annual_subject_groups_model::where('year_id', $year_id)
        ->when($staff_id, function($query, $staff_id){
            return $query->where(function ($query) use ($staff_id) {
                return $query->where('staff1_id', $staff_id)
                        ->orWhere('staff2_id', $staff_id);
            });
        })
        ->when($subject_id, function($query, $subject_id){
            return $query->where('subject_id', $subject_id);
        })
        ->when($module_id, function($query, $module_id){
            return $query->where('module_order', $module_id);
        })

        ->get();

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
                // $data[$num]['staff'] = $row['staff1_isd'];
                $data[$num]['staff'] = $row['staff2_id'] ? Staff_model::name($row['staff1_id']).','.  Staff_model::name($row['staff2_id']) :  Staff_model::name($row['staff1_id']);
                $data[$num]['created_by'] = $annual_teaching_plan ? $annual_teaching_outline->annual_module : null;
                $data[$num]['annual_teaching_outline'] = $annual_teaching_outline ? '<a href="'.admin_url('Bk_annual_teaching_outline' . '/view/'. $annual_teaching_outline->id).'">查 閱</a>' : '<a href="'.admin_url('Bk_annual_teaching_outline' . '/create/'.$annual_teaching_outline->id).'">新 增</a>';
                $data[$num]['annual_teaching_plan'] = $annual_teaching_outline ? '<a href="'.admin_url(current_controller() . '/create/'. $annual_teaching_outline->id).'">新 增</a>' : null;
                $data[$num]['file'] = $annual_teaching_plan ? '<a href="'.admin_url(current_controller()  . '/exportWord/'. $annual_teaching_outline->id).'">下 載</a>': null;

                $num++;
            }
        }

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $_GET['length']));

        echo $return;

    }


    public function create($ato_id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);
        $ato = Annual_teaching_outline_model::find($ato_id);
        $asg = Annual_subject_groups_model::find($ato->annual_subject_group_id);
        // dump(!$ato);
        // dump($ato_id);
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
        
        if (!$ato || !$ato_id) {
            $_SESSION['error_msg'] = __('找不到頁面');
            redirect(admin_url('bk_'.$this->scope));
        }
        $module_date = Modules_week_model::date($asg->year_id, $asg->level_id, $ato->module_order);
        // $annual_module = Annual_modules_model::where('year_id', $asg->year_id)->where('level_id', $asg->level_id)->where('class_id', $asg->class_id)->where('module_order', $asg->module_order)->first();
        $data['function'] = "create";
    


        $data['id'] = $ato->id;
        $data['asg_id'] = $asg->id;
        $data['year_id'] = $asg->year_id;
        $data['year'] = $ato->year;
        $data['subject'] = $ato->subject;
        $data['group_name'] = $ato->group_name;
        $data['annual_module'] = $ato->annual_module;
        $data['module'] = Modules_model::order_list($ato->module_order);
        $data['week_from'] = $ato->week_from;
        $data['week_to'] = $ato->week_to;
        $data['date_from'] = $module_date['date_from'];
        $data['date_to'] = $module_date['date_to'];
        $module_week = Modules_week_model::where('year_id', $asg->year_id)->where('level_id', $asg->level_id)->first();

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/create2/'. $ato_id);

        $searched_arr = Annual_teaching_outline_model::where('annual_subject_group_id', $asg->id)->where('common_value', 0)->get();

        $table_data = array();
        $num = 0;
        if (!empty($searched_arr)) {
            foreach ($searched_arr as $row) {
                $module_name = explode(';',$row->lesson_module)[1];
                $table_data[$num]['id'] = $row->id;
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

        $common_arr = Annual_teaching_outline_model::where('annual_subject_group_id', $asg->id)->where('common_value', 1)->get();
        $common_data = array();
        $num = 0;
        if (!empty($common_arr)) {
            foreach ($common_arr as $row) {
                $module_name = explode(';',$row->lesson_module)[1];
                $common_data[$num]['id'] = $row->id;
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

        $data['action'] = __('新 增 (Step 1)');
        $GLOBALS["datatable"] = 1;
        $GLOBALS["select2"] = 1;
        
        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }

    public function create2($ato_id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);
        $GLOBALS["datatable"] = 1;
        $GLOBALS["select2"] = 1;
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/create3/'. $ato_id);

        if ($ato_id != $_POST['ato_id'] || !count($_POST['subjectCheck'])) {
            $_SESSION['error_msg'] = __('找不到頁面');
            redirect(admin_url('bk_'.$this->scope. '/create/'. $ato_id));
        }
        $asg_id = $_POST['asg_id'];
        $data['today'] = date("Y-m-d ");
        $order_list = array();

        foreach ($_POST['subjectCheck'] as $i => $row) {
            $order_list[($i+1)] = '#'. ($i+1);
        }
        $ato = Annual_teaching_outline_model::find($ato_id);
        $asg = Annual_subject_groups_model::find($asg_id);
        $module_date = Modules_week_model::date($asg->year_id, $asg->level_id, $ato->module_order);
        $data['id'] = $ato->id;
        $data['asg_id'] = $asg->id;
        $data['level_id'] = $asg->level_id;
        $data['event_count'] = $order_list;
        $data['year_id'] = $asg->year_id;
        $data['year'] = $ato->year;
        $data['subject'] = $ato->subject;
        $data['group_name'] = $ato->group_name;
        $data['annual_module'] = $ato->annual_module;
        $data['module'] = Modules_model::order_list($ato->module_order);
        $data['week_from'] = $ato->week_from;
        $data['week_to'] = $ato->week_to;
        $data['date_from'] = $module_date['date_from'];
        $data['date_to'] = $module_date['date_to'];
        $data['current_user'] = $_SESSION['login_name'];
        $data['staff'] = $asg->staff2_id ? Staff_model::name($asg->staff1_id).','.  Staff_model::name($asg->staff2_id) :  Staff_model::name($asg->staff1_id);$asg->staff1_id;
        $data['staff_list'] = Staff_model::list();
        $data['level_list'] = array(
            1 => '低',
            2 => '中',
            3 => '高'
        );
        $data['action'] = __('新 增 (Step 2)');


        $student_data = Annual_subject_groups_students_model::where('annual_subject_group_id', $asg_id)->get()->toArray();

        $student_list = array();
        foreach ($student_data as $row) {
            $student_list[$row['id']] = Students_model::name($row['student_id']);
        }
        $data['student_list'] = $student_list;

        $lesson_arr = Annual_teaching_outline_model::whereIn('id', $_POST['subjectCheck'])->get();
        $lesson_data = array();
        $num = 0;
        if (!empty($lesson_arr)) {
            foreach ($lesson_arr as $row) {
                $module_name = explode(';',$row->lesson_module)[1];

                $lesson_data[$num]['common_value'] = $row->common_value;
                $lesson_data[$num]['order'] = ($num+1) ;
                $lesson_data[$num]['id'] = $row->id;
                $lesson_data[$num]['code'] = $row->lesson_code;
                // $lesson_data[$num]['subject'] = $row->lesson_subject;
                // $lesson_data[$num]['course'] = $row->lesson_course;
                $lesson_data[$num]['category'] = $row->lesson_category;
                $lesson_data[$num]['sb_obj'] = $row->lesson_sb_obj;
                $lesson_data[$num]['element'] = $row->lesson_element;
                $lesson_data[$num]['group'] =  $row->lesson_group;
                $lesson_data[$num]['expected_outcome'] = $row->lesson_expected_outcome;            
                $lesson_data[$num]['addon'] =  $row->lesson_additional_content ?  $module_name. ': <a class="small">'.$row->lesson_additional_content.'</span>': $module_name .':';
                $lesson_data[$num]['performance'] = $row->lesson_performance;
                $lesson_data[$num]['assessment'] = $row->lesson_assessment;
                $lesson_data[$num]['all_select'] = $row->id;
                $lesson_data[$num]['part_select'] = $row->id;
                // $lesson_data[$num]['related_lesson'] = $row->lesson_relevant_lesson ? $row->lesson_relevant_lesson: '暫無相關課程編號	';
                // $lesson_data[$num]['rel_code'] = $row->lesson_relevant_code ? $row->lesson_relevant_code : '暫無相關項目編號';
                $lesson_data[$num]['remarks'] = $row->lesson_remarks;
                $num++;
            }
        }
        // dump($data);
        $data['table_data'] = $lesson_data;

        $this->load->view('webadmin/' . $this->scope . '_form2',  $data);
    }


    public function fetch_student_list(){
        $asg_id = $_POST['asg_id'];

        $data = Annual_subject_groups_students_model::where('annual_subject_group_id', $asg_id)->get()->toArray();

        $student_list = array();
        foreach ($data as $row) {
            $student_list[$row['id']] = Students_model::name($row['student_id']);
        }
        
        echo json_encode($student_list);
    }


    public function create3($ato_id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);
        $GLOBALS["datatable"] = 1;
        $GLOBALS["select2"] = 1;
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $ato_id);
        // dump($_POST);
        if ($ato_id != $_POST['ato_id'] ) {
            $_SESSION['error_msg'] = __('找不到頁面');
            redirect(admin_url('bk_'.$this->scope. '/create/'. $ato_id));
        }
        $asg_id = $_POST['asg_id'];
        $data['today'] = date("Y-m-d ");

        $ato = Annual_teaching_outline_model::find($ato_id);
        $asg = Annual_subject_groups_model::find($asg_id);
        $module_date = Modules_week_model::date($asg->year_id, $asg->level_id, $ato->module_order);
        $data['id'] = $ato->id;
        $data['asg_id'] = $asg->id;
        $data['year_id'] = $asg->year_id;
        $data['year'] = $ato->year;
        $data['subject'] = $ato->subject;
        $data['group_name'] = $ato->group_name;
        $data['annual_module'] = $ato->annual_module;
        $data['module'] = Modules_model::order_list($ato->module_order);
        $data['week_from'] = $ato->week_from;
        $data['week_to'] = $ato->week_to;
        $data['date_from'] = $module_date['date_from'];
        $data['date_to'] = $module_date['date_to'];
        $data['current_user'] = $_SESSION['login_name'];
        $data['staff'] = $asg->staff2_id ? Staff_model::name($asg->staff1_id).','.  Staff_model::name($asg->staff2_id) :  Staff_model::name($asg->staff1_id);$asg->staff1_id;
        $data['staff_list'] = Staff_model::list();
        $data['i'] = 1;

        $data['atp_data'] = array(
            'annual_subject_group_id' => $asg_id,
            'topic' => $_POST['topic'],
            'remarks' => $_POST['remark'],
            'lesson_session' => $_POST['session_count'],
            'created_by' => $_POST['created_by'],
        );

        foreach ($_POST['order'] as $i => $row) {
            $data['atp_ato'][$row] = array(
                'ato_id' => $row,
                'order' => $i,
                'allCheck' => in_array($row, $_POST['allStudentCheck']) ? 1 : 0,
                'partCheck' => in_array($row, $_POST['partStudentCheck']) ? 1 : 0,
                'level_id' => $_POST['level'][$row], 
            );
        } 
        
        $data['action'] = __('新 增 (Step 3)');


        foreach ($_POST['studentLevel'] as $i => $row) {
            $student_level = array(
                'student_level_id' => $row,
            );
            Annual_subject_groups_students_model::where('id', $i)->update($student_level);
        } 
        // $lesson_arr = Annual_teaching_outline_model::whereIn('id', $_POST['subjectCheck'])->get();
        // $lesson_data = array();
        // $num = 0;
        // if (!empty($lesson_arr)) {
        //     foreach ($lesson_arr as $row) {
        //         $module_name = explode(';',$row->lesson_module)[1];

        //         $lesson_data[$num]['common_value'] = $row->common_value;
        //         $lesson_data[$num]['order'] = '#'.($num+1);

        //         $lesson_data[$num]['id'] = $row->id;
        //         $lesson_data[$num]['code'] = $row->lesson_code;
        //         // $lesson_data[$num]['subject'] = $row->lesson_subject;
        //         // $lesson_data[$num]['course'] = $row->lesson_course;
        //         $lesson_data[$num]['category'] = $row->lesson_category;
        //         $lesson_data[$num]['sb_obj'] = $row->lesson_sb_obj;
        //         $lesson_data[$num]['element'] = $row->lesson_element;
        //         $lesson_data[$num]['group'] =  $row->lesson_group;
        //         $lesson_data[$num]['expected_outcome'] = $row->lesson_expected_outcome;            
        //         $lesson_data[$num]['addon'] =  $row->lesson_additional_content ?  $module_name. ': <a class="small">'.$row->lesson_additional_content.'</span>': $module_name .':';
        //         $lesson_data[$num]['performance'] = $row->lesson_performance;
        //         $lesson_data[$num]['assessment'] = $row->lesson_assessment;
        //         $lesson_data[$num]['all_select'] = $row->id;
        //         $lesson_data[$num]['part_select'] = $row->id;
        //         // $lesson_data[$num]['related_lesson'] = $row->lesson_relevant_lesson ? $row->lesson_relevant_lesson: '暫無相關課程編號	';
        //         // $lesson_data[$num]['rel_code'] = $row->lesson_relevant_code ? $row->lesson_relevant_code : '暫無相關項目編號';
        //         $lesson_data[$num]['remarks'] = $row->lesson_remarks;
        //         $num++;
        //     }
        // }
        // $data['table_data'] = $lesson_data;
        $data['event_count'] = json_decode($_POST['event_count']);
        // dump()
        // dump($data);
        $this->load->view('webadmin/' . $this->scope . '_form3',  $data);
    }


    public function preview($ato_id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        // dump($_POST);
        $data['action'] = __('預 覽');
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        $asg_id = $_POST['asg_id'];
        $data['today'] = date("Y-m-d ");

        $ato = Annual_teaching_outline_model::find($ato_id);
        $asg = Annual_subject_groups_model::find($asg_id);
        $module_date = Modules_week_model::date($asg->year_id, $asg->level_id, $ato->module_order);
        $data['id'] = $ato->id;
        $data['asg_id'] = $asg->id;
        $data['year_id'] = $asg->year_id;
        $data['year'] = $ato->year;
        $data['subject'] = $ato->subject;
        $data['group_name'] = $ato->group_name;
        $data['annual_module'] = $ato->annual_module;
        $data['module'] = Modules_model::order_list($ato->module_order);
        $data['week_from'] = $ato->week_from;
        $data['week_to'] = $ato->week_to;
        $data['date_from'] = $module_date['date_from'];
        $data['date_to'] = $module_date['date_to'];
        $data['current_user'] = $_SESSION['login_name'];
        $data['staff'] = $asg->staff2_id ? Staff_model::name($asg->staff1_id).','.  Staff_model::name($asg->staff2_id) :  Staff_model::name($asg->staff1_id);$asg->staff1_id;
        $data['staff_list'] = Staff_model::list();
        $data['i'] = 1;
        $atp_data = json_decode($_POST['atp_data']);
        $data['session'] = $atp_data->lesson_session;
        $data['created_by'] = Staff_model::name($atp_data->created_by);
        $data['topic'] = $atp_data->topic;


        // $lesson_arr = Annual_teaching_outline_model::whereIn('id', $_POST['subjectCheck'])->get();
        $event_arr = $_POST['activity_event'];
        $activity_name = $_POST['activity_name'];
        $activity_content = $_POST['activity_content'];
        $activity_materials = $_POST['materials'];

        $event_data = array();
        $num = 0;
        if (!empty($event_arr)) {
            foreach ($event_arr as $j => $row) {
                $event_num = array();
                foreach ($row as $event_id) {
                    // $event_num .= '<button type="button" class="btn btn-primary">'. '#'. $event_id. '</button>';
                    array_push($event_num, $event_id);

                }
                $material_list = array();
                foreach ($activity_materials[$j] as $row) {
                    array_push($material_list, Materials_model::name($row));
                }
                $event_data[$num]['event'] = implode(',', $event_num);
                $event_data[$num]['name'] = $activity_name[$j];
                $event_data[$num]['material'] = implode(',', $material_list);
                $event_data[$num]['activity'] = $activity_content[$j];
                // $event_data[$num]['photo'] = '尚';
                $event_data[$num]['action'] = '<a class="editBtn" href="#"> 修改 </a>';
                $num++;
            }
        }
        // dump($data);
        $data['table_data'] = $event_data;


        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }


    public function create02()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form');
        $data['action'] = __('新 增(Step 2)');

        $GLOBALS["datatable"] = 1;
        $GLOBALS["select2"] = 1;
        $GLOBALS["jquery19"] = 1;
        $this->load->view('webadmin/' . $this->scope . '_step2',  $data);
    }

    public function create03()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form');
        $data['action'] = __('學習活動 新 增');

        $GLOBALS["datatable"] = 1;
        $GLOBALS["select2"] = 1;

        $this->load->view('webadmin/' . $this->scope . '_step3',  $data);
    }


    public function approve()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form');
        $data['action'] = __('審 批');

        $GLOBALS["datatable"] = 1;
        $GLOBALS["select2"] = 1;

        $this->load->view('webadmin/' . $this->scope . '_approve',  $data);
    }
    public function edit()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);

        $data['action'] = __('修 改');
        $GLOBALS["select2"] = 1;

        $GLOBALS["datatable"] = 1;
        $this->load->view('webadmin/' . $this->scope . '_step2_edit',  $data);
    }
    public function editEvent()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);

        $data['action'] = __('學習活動 修 改');
        $GLOBALS["select2"] = 1;

        $this->load->view('webadmin/' . $this->scope . '_step3_edit',  $data);
    }

}
