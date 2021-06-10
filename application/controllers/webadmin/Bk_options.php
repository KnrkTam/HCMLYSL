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

        $data['courses_list'] = Courses_model::list();
        $data['categories_list'] = Categories_model::list();
        $data['central_obj_list'] = Central_obj_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['subjects_list'] = Subjects_model::list();


        $this->load->view('webadmin/' . $this->scope . '', $data);
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
        $dup_course = Courses_model::where('name',$name)->first()->name;
        $dup_category = Categories_model::where('name',$name)->first()->name;
        $dup_central_obj = Central_obj_model::where('name',$name)->first()->name;
        $dup_sb_obj = Sb_obj_model::where('name',$name)->first()->name;
        $dup_subject = Subjects_model::where('name',$name)->first()->name;

        if (empty($name)) {
            $data['status'] = '請輸入'. $type. '名稱';
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
            }
        }
    
        echo json_encode($data);
    }


}
