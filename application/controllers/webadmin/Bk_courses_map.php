<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_courses_map extends CI_Controller //change this
{
    private $scope = 'courses_map'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('校本課程大綱樹狀圖'), //change this
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
        $data['courses'] = Courses_model::all();
        $courses = Courses_model::list(null, null);
        $data['courses_list'] = $courses; 
        foreach ($courses as $i => $course) {
            $data['categories_list_'.$i] = Categories_model::list($i, null);
        }
        $data['categories_list'] = Categories_model::list(null, null);
        $lessons_arr = Lessons_model::list();

        foreach ($lessons_arr as $row) {
            $lessons_list[$row['id']] =  $row['code'];
        }
        $data['lessons_list'] = $lessons_list;
        // dump($data['lessons_list']);
        // dump( $data['courses_list']);
        $this->load->view('webadmin/' . $this->scope . '', $data);
    }

    public function create($type)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);

        switch ($type) {
            case ('category'):
                $duplicate = Categories_model::where('name',$_POST['category_name'])->where('course_id', $_POST['course_id'])->first()->name;
                switch (true) {
                    case (empty($_POST['course_id'])):
                        $data = array(
                            'status' => '請選擇相應課程',
                        );
                        break;
                    case ($duplicate):
                        $data = array(
                            'status' => '己存在範疇',
                        );
                        break;
                    case (empty($_POST['category_name'])):
                        $data = array(
                            'status' => '請輸入範疇名稱',
                        );
                        break;
                    default:
                    $new_data = array(
                        'course_id' => $_POST['course_id'],
                        'name' =>  $_POST['category_name'],
                    );
                    $cat_id = Categories_model::create($new_data)->id;
                    $_SESSION['success_msg'] = __('新增範疇成功');
                    $data = array(
                        'status' => 'success',
                    );
                }
            break;
            case ('obj'):
                $duplicate1 = Central_obj_model::where('name',$_POST['central_obj_name'])->first()->name;
                $duplicate2 = Sb_obj_model::where('name',$_POST['sb_obj_name'])->first()->name;
                switch (true) {
                    case ($duplicate1):
                        $data = array(
                            'status' => '己存在中央課程學習重點',
                        );
                        break;
                    case ($duplicate2):
                        $data = array(
                            'status' => '己存在校本課程學習重點',
                        );
                        break;
                    case (empty($_POST['central_obj_name'])):
                        $data = array(
                            'status' => '請輸入中央課程學習重點',
                        );
                        break;   
                    case (empty($_POST['central_obj_name'])):
                        $data = array(
                            'status' => '請輸入校本課程學習重點',
                        );
                        break;
                    default:
                    Central_obj_model::create(array('name' => $_POST['central_obj_name']));
                    Sb_obj_model::create(array('name' => $_POST['sb_obj_name']));
                    $_SESSION['success_msg'] = __('新增課程學習重點成功');
                    $data = array(
                        'status' => 'success',
                    );
                }
            break;

        }
        // $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form');
        // $data['action'] = __('新 增');


        echo json_encode($data);

    }




    public function edit($type)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);

        switch ($type) {
            case ('course'):
                $course = Courses_model::find($_POST['course_id']);
                $duplicate = Courses_model::where('name', $_POST['course_name'])->first()->name;
                switch (true) {
                    case (empty($course)):
                        $data = array(
                            'status' => '請選擇課程',
                        );
                        break;
                    case ($duplicate):
                        $data = array(
                            'status' => '已存在相同名稱課程',
                        );
                        break;
                    // case ($course->name == $_POST['course_name']):
                    //     $data = array(
                    //         'status' => '名稱相同',
                    //     );
                    //     break;
                    case (empty($_POST['course_name'])):
                        $data = array(
                            'status' => '請輸入新課程名稱',
                        );
                        break;
                    default:
                    Courses_model::where('id', $_POST['course_id'])->update(array('name' =>  $_POST['course_name']));
                    $_SESSION['success_msg'] = __('修改課程成功');
                    $data = array(
                        'status' => 'success',
                    );
                }
                break;
            case ('category'):
                $duplicate = Categories_model::where('name', $_POST['new_category_name'])->where('course_id', $_POST['course_id'])->first()->name;
                switch(true) {
                    case (empty($_POST['category_id'])):
                        $data = array(
                            'status' => '請選擇範疇',
                        );
                        break;
                    case (empty($_POST['new_category_name'])):
                        $data = array(
                            'status' => '請輸入新範疇名稱',
                        );
                        break;
                    case ($duplicate):
                        $data = array(
                            'status' => '已存在相同名稱範疇',
                        );
                        break;
                    default:
                    $new_data = array(
                        'name' =>  $_POST['new_category_name'],
                    );
                    Categories_model::where('id', $_POST['category_id'])->update($new_data);
                    $_SESSION['success_msg'] = __('修改範疇成功');
                    $data = array(
                        'status' => 'success',
                    );
                }
                break;
                case ('expected_outcome'):
                $lesson = Lessons_model::find($_POST['lesson_id']);
                $duplicate = Lessons_model::where('expected_outcome', $_POST['name'])->first();
                switch(true) {
                    case (empty($_POST['lesson_id'])):
                        $data = array(
                            'status' => '請選擇課程編號',
                        );
                        break;
                    case (empty($_POST['name'])):
                        $data = array(
                            'status' => '請輸入新預期學習成果',
                        );
                        break;
    
                    default:
                    $new_data = array(
                        'expected_outcome' =>  $_POST['name'],
                    );
                    Lessons_model::where('id', $_POST['lesson_id'])->update($new_data);
                    $_SESSION['success_msg'] = __('修改預期學習成果成功');
                    $data = array(
                        'status' => 'success',
                    );
                }   
                break;



        }

        echo json_encode($data);
    }



    public function preview()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);


        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

}
