<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_subjects_map extends CI_Controller //change this
{
    private $scope = 'subjects_map'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('科目課程大綱樹狀圖'), //change this
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
            //'view_' . $this->scope
            'view_news'
        ), FALSE, TRUE);
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $data['subjects_list'] = Subjects_model::list();
        $_SESSION['path'] = $this->scope;

        if ($_POST) {
            $id = $_POST['subject_id'];
            $subject = Subjects_model::find($id);
            $data['subject_id'] = $id;
            $data['subject'] = $subject->name; 
            $data['subject_cat'] = $subject->cat;
        }
        // $data['courses'] = Courses_model::list();
        // $data['categories'] = Categories_model::list();

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/index');

        // dump($_SESSION*);

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form');
        $data['action'] = __('新 增');


        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }

    public function edit()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);
        $data['action'] = __('更 改');

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }



    public function preview()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);


        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    public function select()
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);

        $id = $_POST['subject_id'];
        $subject = Subjects_model::find($id);
        $lessons_arr = Subject_lessons_model::where('subject_id', $id)->get();

        foreach ($subject->cat as $i => $lesson)

        $data = array(
            'status' => 'success',
            'subject' => $subject,
            'subject_categories' => $subject->cat,
        );


        echo json_encode($data);

    }
}
