<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_options extends CI_Controller //change this
{
    private $scope = 'options'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('增加選項'), //change this
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
        $data['action'] = __('檢視清單');

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $data['courses_list'] = Courses_model::list('All');
        $data['categories_list'] = json_encode(Categories_model::optionList('All')); 
        $data['subject_categories_list'] = json_encode(Subject_categories_model::optionList('All')); 
        $data['central_obj_list'] = Central_obj_model::list('Alln');
        $data['sb_obj_list'] = Sb_obj_model::list('All');
        $data['subjects_list'] = Subjects_model::list('All');
        $data['years_list'] = Years_model::list();
        $data['staff_list'] = Staff_model::list();
        $data['students_list'] = Students_model::list();
        $data['classes_list'] = Classes_model::list();

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }


    public function readAPI()
    {
        // dump($_POST);
        // $params = array('user_post' => null, 'a' => "staff", "encode"  => "array");
        $params['user_post'] = null; 
        $params['a'] = $_POST['a']; 
        $params['encode'] = $_POST['encode']; 
        $params['year'] = date("Y");
        $year_id = Years_model::where('year_to', date("Y"))->first()->id;

        if (!$year_id) {
            $year_id = Years_model::create(array(
                'year_from' => date("Y")-1,
                'year_to' => date("Y"),
            ))->id;
        }
        // dump($year_id);
        // $header = array('Set-Cookie: PHPSESSID=4b9ppf47fp7ira97vsffc2neb5; path=/');
        // dump($_POST);
        $header = array('Content-Type: application/x-www-form-urlencoded');
        // $header = array('Content-Type: multipart/form-data');

        

        $api_response = uCurl('http://203.198.169.212:9000/api/index.php', 'POST', $params);

        // dump(json_decode($api_response,true));

        $data = json_decode(preg_replace("/\r|\n|\t/", "", substr($api_response, 82, -3)));

        switch (true) {
            case($_POST['a'] == "staff"):

                foreach ($data as $i => $staff) {
                    $staff_data = (array)$staff;
                    $info_data = array(
                        'id' => $staff_data['id'],
                        'username' => $staff_data['username'],
                        'name' => $staff_data['name'],
                        'name_short' => $staff_data['name_short'],
                        'user_post' => $staff_data['user_post'],
                    );
                    $staff_id = Staff_model::updateOrCreate($info_data, array('status' => $staff_data['status'] == 'IN' ? 1 : 0, 'updated_at' => date('Y-m-d H:i:s'),))->$id;
                }
        
                $result = array('status' => 'success', 'msg' => '職員名單已更新');
                break;
            case ($_POST['a'] == "students"):
                foreach ($data as $student) {
                    $student_data = (array)$student;
                    $info_data = array(
                        'id' => $student_data['id'],
                        'sid' => $student_data['sid'],
                        'chinese_name' => $student_data['chinese_name'],
                        'english_name' => $student_data['english_name'],
                        'class' => $student_data['class'],
                        'dob' => $student_data['dob'],
                        'class_level' => $student_data['class_level'],
                        'lineage' => $student_data['lineage'],
                    );
                

                    $update_data = array(
                        'study_status' => $student_data['study_status'], 
                        'status' => $student_data['study_status'] == '在學' ? 1 : 0, 
                        'updated_at' => date('Y-m-d H:i:s'),
                        'year_id' => $year_id

                    );

                    $class_data = array(
                        'name' => $student_data['class'],
                        'year_id' => 1,
                        'teacher1_id' => 0,
                        'teacher2_id' => 0,
                    );

                    $class_update_data = array(
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    Students_model::updateOrCreate($info_data, $update_data);
                    Classes_model::updateOrCreate($class_data, $class_update_data);
                }

                $result = array('status' => 'success', 'msg' => '學生名單已更新');

                break;

        }
        echo json_encode($result);

    }


    public function ajax($type = NULL)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);

        // POST
        $postData = $this->input->post();
        $type = $postData['type'];
        $name = $postData['name'];
        $name2 = $postData['name2'];
        $dup_course = Courses_model::where('name',$name)->first()->name;
        $dup_category = Categories_model::where('name',$name)->first()->name;
        $dup_central_obj = Central_obj_model::where('name',$name)->first()->name;
        $dup_sb_obj = Sb_obj_model::where('name',$name)->first()->name;
        $dup_subject = Subjects_model::where('name',$name)->first()->name;
        $dup_subject_category = Subject_categories_model::where('name',$name)->first()->name;
        $dup_year = Years_model::where('year_from', $name)->first()->year_from;
        $dup_year2 = Years_model::where('year_to', $name2)->first()->year_to;


        if (empty($name)) {
            $data['status'] = '請輸入'. $type;
        } else {
            switch ($type) {
                    case ('課程'):
                        if ($dup_course) {
                            $data['status'] =  $type. '名稱重複';
                        } else {
                            $new_data = array(
                                'name' => $name,
                            );
                            Courses_model::create($new_data);
                            $data['status'] =  'success';
                            $_SESSION['success_msg'] = __('新增'.$type.'成功');
                        };
                        break;               
                    case ('範疇'):
                        if ($dup_category) {
                            $data['status'] =  $type. '名稱重複';
                        } else {
                            $new_data = array(
                                'name' => $name,
                                'course_id' => $name2,
                            );
                            Categories_model::create($new_data);
                            $data['status'] =  'success';
                            $_SESSION['success_msg'] = __('新增'.$type.'成功');
                        } ;         
                        break;               
        
                    case ('中央課程學習重點'):
                        if ($dup_central_obj) {
                            $data['status'] =  $type. '名稱重複';
                        } else {
                            $new_data = array(
                                'name' => $name,
                            );
                            Central_obj_model::create($new_data);
                            $data['status'] =  'success';
                            $_SESSION['success_msg'] = __('新增'.$type.'成功');
                        } ;        
                        break;               
        
                    case ('校本課程學習重點'):
                        if ($dup_sb_obj) {
                            $data['status'] =  $type. '名稱重複';
                        } else {
                            $new_data = array(
                                'name' => $name,
                            );
                            Sb_obj_model::create($new_data);
                            $data['status'] =  'success';
                            $_SESSION['success_msg'] = __('新增'.$type.'成功');
                        };       
                        break;               
            
                    case ('科目'):
                        if ($dup_subject) {
                            $data['status'] =  $type. '名稱重複';
                        } else {
                            $new_data = array(
                                'name' => $name,
                            );
                            Subjects_model::create($new_data);
                            $data['status'] =  'success';
                            $_SESSION['success_msg'] = __('新增'.$type.'成功');
                        };
                        break;      

                    case ('科目範疇'):
                        if ($dup_subject_category) {
                            $data['status'] =  $type. '名稱重複';
                        } else {
                            $new_data = array(
                                'name' => $name,
                                'subject_id' => $name2,
                            );
                            Subject_categories_model::create($new_data);
                            $data['status'] =  'success';
                            $_SESSION['success_msg'] = __('新增'.$type.'成功');
                        } ;         
                        break;               
        
                    
                    case ('年度'):
                        if (empty($name2)) {
                            $data['status'] = '請輸入'. $type. ' 至';
                        } else {
                            if($dup_year || $dup_year2) {
                                $data['status'] =  $type. '已重複';
                            } else if ($name2 < $name) {
                                $data['status'] =  $type. '次序錯誤';
                            } else if ($name2 - $name > 1 || $name == $name2 || strlen($name) !== 4 || strlen($name2) !== 4 ) {
                                    $data['status'] =  $type. '錯誤';
                            } else {
                                $new_data = array(
                                    'year_from' => $name,
                                    'year_to' => $name2,
                                );
                                Years_model::create($new_data);
                                $data['status'] =  'success';
                                $_SESSION['success_msg'] = __('新增'.$type.'成功');
                            }
                        }
                        break;              
            }
        }
    
        echo json_encode($data);
    }


}
