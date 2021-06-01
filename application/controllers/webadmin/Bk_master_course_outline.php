<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_master_course_outline extends CI_Controller //change this
{
    private $scope = 'master_course_outline'; //change this

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

    // public function ajax($type = NULL)
    // {
    //     $page_setting = $this->page_setting(array(
    //         'view_' . $this->scope
    //     ));

    //     switch ($type) {
    //         case 'delete_record':
    //             if (!validate_user_access(['delete_' . $this->scope])) {
    //                 $response = ['success' => FALSE, 'data' => [], 'message' => __('Access Denied.')];
    //                 echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //                 exit;
    //             }

    //             $id = (int)$this->input->post('id');
    //             $result = News_ajax_model::find($id);
    //             if (!empty($result)) {
    //                 $data = array(
    //                     "deleted" => 1,
    //                     "deleted_by" => $_SESSION['sys_user_id'],
    //                     "deleted_at" => date('Y-m-d H:i:s'),
    //                 );
    //                 $result->update($data);
    //                 //update sort
    //                 $db_result = DB::table('news')->where('sort', '>', $result['sort'])->update(['sort' => DB::raw('sort-1')]);

    //                 $response = ['success' => TRUE, 'data' => [], 'message' => __('Delete Successfully.')];
    //             } else {
    //                 $response = ['success' => FALSE, 'data' => [], 'message' => __('Cannot find data.')];
    //             }

    //             echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //             break;
    //         case 'submit_form':
    //             if (!validate_user_access(['create_' . $this->scope, 'update_' . $this->scope])) {
    //                 $response = ['success' => FALSE, 'data' => [], 'message' => __('Access Denied.')];
    //                 echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //                 exit;
    //             }
    //             $response = ['success' => FALSE, 'data' => [], 'message' => ''];
    //             $id = (int)$this->input->post('id') > 0 ? (int)$this->input->post('id') : NULL;
    //             dump('submitted');

    //             //modify checking id data
    //             if (!empty($id)) {
    //                 $news = News_model::find($id);
    //                 if (empty($news)) {
    //                     $response['message'] = __('Cannot find data.');
    //                     echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //                     exit;
    //                 }
    //             }

    //             $rules = array();
    //             $form_list = News_ajax_model::form_list();
    //             $form_data = [];
    //             foreach ($form_list as $field => $row) {
    //                 $form_validation_error = form_validation_default_errors($row['label']);
    //                 $form_validation_error['validate_date'] = $row['label'] . ' must be a date format.';
    //                 $form_validation_error['validate_start_date'] = $row['label'] . ' must be a date format and before end date.';
    //                 $form_validation_error['validate_end_date'] = $row['label'] . ' must be a date format and after end date.';
    //                 array_push(
    //                     $rules,
    //                     array(
    //                         'field' => $field,
    //                         'label' => $row['label'],
    //                         'rules' => $row['form_validation_rules'],
    //                         'errors' => $form_validation_error,
    //                     )
    //                 );

    //                 $form_data[$field] = $this->input->post($field);

    //                 if ($id && in_array($row['type'], ['file', 'single_image_upload'])) {
    //                     $form_data[$field] = $news->{$field};
    //                 }
    //             }

    //             $this->form_validation->set_rules($rules);

    //             //other checking
    //             $error_message = '';
    //             //upload file
    //             foreach ($form_list as $field => $row) {
    //                 if (in_array($row['type'], ['file', 'single_image_upload', 'elfinder_upload'])) {
    //                     if ($id && $this->input->post('del_' . $field) == 1) {
    //                         $news_model = News_ajax_model::find($id);
    //                         if ($news_model->id) {
    //                             $file_path = FCPATH . 'assets/' . $news_model->{$field};
    //                             $form_data[$field] = ''; // remove on database
    //                             if (file_exists($file_path) && $row['type'] != 'elfinder_upload') {
    //                                 unlink($file_path);
    //                             }
    //                         }
    //                     }
    //                 }

    //                 if (in_array($row['type'], ['file', 'single_image_upload'])) {
    //                     //single image upload
    //                     $single_upload = single_upload($field, $row['upload_config'], $row['thumb_config']);
    //                     //if success return $single_upload['filename'] else return $single_upload['error']
    //                     if ($single_upload['error']) {
    //                         $error_message .= '<p>' . $single_upload['error'] . '</p>';
    //                     } else if ($single_upload['filename']) {
    //                         $form_data[$field] = $single_upload['file_path'];
    //                     }
    //                     //end of single image upload
    //                 }
    //             }
    //             //.other checking

    //             if ($this->form_validation->run() == FALSE || !empty($error_message)) {
    //                 $response['message'] = validation_errors('<p>', '</p>') . $error_message;
    //             } else {
    //                 $data = array(
    //                     'updated_at' => date("Y-m-d H:i:s"),
    //                     'updated_by' => $_SESSION["sys_user_id"],
    //                 );
    //                 if (empty($id)) {
    //                     $data['created_at'] = date("Y-m-d H:i:s");
    //                     $data['created_by'] = $_SESSION["sys_user_id"];
    //                 }
    //                 foreach ($form_list as $field => $row) {
    //                     if ($row['type'] == 'display')
    //                         continue;

    //                     if ($row['encryption']) {
    //                         $data[$field] = $this->encryption->encrypt($form_data[$field]);
    //                     } else {
    //                         $data[$field] = $form_data[$field];
    //                     }
    //                 }
    //                 //.upload file

    //                 //var_dump($data);
    //                 //exit;
    //                 if (empty($id)) {
    //                     $news = News_ajax_model::create($data);
    //                     if ($news->id) {
    //                         $response = ['success' => TRUE, 'data' => ['id' => $news->id], 'message' => __('Create Successfully.')];
    //                     } else {
    //                         $response = ['success' => FALSE, 'data' => [], 'message' => __('Create Unsuccessfully.')];
    //                     }
    //                 } else {
    //                     $news = News_model::where('id', $id)->update($data);
    //                     $response = ['success' => TRUE, 'data' => ['id' => $id], 'message' => __('Update Successfully.')];
    //                 }
    //             }
    //             echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //             break;
    //         case 'update_sort':
    //             if (!validate_user_access(['update_' . $this->scope])) {
    //                 $response = ['success' => FALSE, 'data' => [], 'message' => __('Access Denied.')];
    //                 echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //                 exit;
    //             }

    //             $sorts = $this->input->post('sort');
    //             if (!empty($sorts)) {
    //                 foreach ($sorts as $id => $sort) {
    //                     $data = array(
    //                         "sort" => $sort,
    //                     );
    //                     News_model::where('id', $id)->update($data);
    //                 }
    //             }

    //             $response = ['success' => TRUE, 'data' => [], 'message' => __('Update Successfully.')];
    //             echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    //             break;
    //         case 'update_status':
    //             if (!validate_user_access(['update_' . $this->scope])) {
    //                 $response = ['success' => FALSE, 'data' => [], 'message' => __('Access Denied.')];
    //                 echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //                 exit;
    //             }

    //             $id = $this->input->post('id');
    //             $status = $this->input->post('status');
    //             $result = News_ajax_model::find($id);
    //             if (!empty($result)) {
    //                 $data = array(
    //                     'status' => $status,
    //                     "updated_by" => $_SESSION['sys_user_id'],
    //                     "updated_at" => date('Y-m-d H:i:s'),
    //                 );
    //                 $result->update($data);

    //                 $response = ['success' => TRUE, 'data' => [], 'message' => __('Update Successfully.')];
    //             } else {
    //                 $response = ['success' => FALSE, 'data' => [], 'message' => __('Cannot find data.')];
    //             }
    //             echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //             break;
    //         default:
    //             $start = (int)$_GET["start"];
    //             $length = (int)$_GET["length"];
    //             $search = $_GET["search"]["value"];
    //             $filter_type = $_GET["search_filter_type"];
    //             $filter_para = $_GET["search_filter_para"];
    //             $filter_para2 = $_POST["search_filter_para2"];

    //             $result = News_ajax_model::orderBy('sort', 'ASC');

    //             switch ($filter_type) {
    //                 case 1: //All
    //                     break;
    //                 case 2: //title
    //                     $result = $result->where('id', $filter_para);
    //                     break;
    //             }

    //             if (empty($search)) {
    //                 $result_count = $result->count();
    //                 $result2 = $result->skip($start)->take($length)->get();
    //             } else {
    //                 $valid_result = array();
    //                 $result = $result->get();
    //                 $search_fields = array('title', 'date');
    //                 $search_encrypted_fields = array();

    //                 foreach ($result as $key => $row) {
    //                     if (!empty($search_fields)) {
    //                         $found = FALSE;
    //                         foreach ($search_fields as $search_field) {
    //                             if (strpos($row[$search_field], $search) !== FALSE) {
    //                                 $found = TRUE;
    //                             }
    //                         }

    //                         if (!$found) {
    //                             if (!empty($search_encrypted_fields)) {
    //                                 foreach ($search_encrypted_fields as $search_field) {
    //                                     if (!empty($row[$search_field])) {
    //                                         if (strpos($this->encryption->decrypt($row[$search_field]), $search) !== FALSE) {
    //                                             $found = TRUE;
    //                                         }
    //                                     }
    //                                 }
    //                             }
    //                         }

    //                         if ($found) {
    //                             $valid_result[] = $row;
    //                         }
    //                     }
    //                 }

    //                 $result_count = count($valid_result);
    //                 $result2 = array();
    //                 foreach ($valid_result as $key => $row) {
    //                     if ($key >= $start && $key < ($start + $length)) {
    //                         $result2[] = $row;
    //                     }
    //                 }
    //             }

    //             //rearrange data
    //             $data = array();
    //             $num = 0;
    //             if (!empty($result2)) {
    //                 foreach ($result2 as $key => $row) {
    //                     $data[$num][] = '<input type="number" name="sort[' . $row["id"] . ']" value="' . $row["sort"] . '" style="width: 50px;"/>';
    //                     $data[$num][] = $row["date"];
    //                     $data[$num][] = '<a href="' . admin_url($page_setting['controller'] . '/modify/' . $row["id"]) . '">' . $row["title"] . '</a>';
    //                     $action = '<div class="nowrap">';
    //                     if (validate_user_access(['update_' . $this->scope])) {
    //                         $action .= '<button type="button" class="btn btn-' . ($row["status"] == 1 ? 'success' : 'warning') . '" onclick="ajax_update_status(' . $row['id'] . ', ' . ($row["status"] == 1 ? 0 : 1) . ');" style="margin-right: 5px;">' . ($row["status"] == 1 ? __('Enable') : __('Disable')) . '</button>';
    //                         $action .= '<a href="' . admin_url($page_setting['controller'] . '/modify/' . $row['id']) . '" style="margin-right: 5px;"><button type="button" class="btn btn-warning">' . __('Modify') . '</button></a>';
    //                     }
    //                     //delete this event and relate parent id
    //                     if (validate_user_access(['delete_' . $this->scope])) {
    //                         $action .= '<button type="button" class="btn btn-danger" onclick="ajax_delete_record(' . $row['id'] . ');">' . __('Delete') . '</button>';
    //                     }
    //                     $action .= '</div>';
    //                     $data[$num][] = $action;
    //                     $num++;
    //                 }
    //             }
    //             $return = json_encode(array("draw" => $_GET["draw"], "recordsTotal" => $result_count, "recordsFiltered" => $result_count, "data" => $data));

    //             echo $return;
    //             break;
    //     }
    // }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');
        $data['action'] = __('新 增');
        $data['courses_list'] = Courses_model::list();
        $data['categories_list'] = Categories_model::list();
        $data['central_obj_list'] = Central_obj_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['elements_list'] = Elements_model::list();
        $data['groups_list'] = Groups_model::list();
        $data['lpf_basic_list'] = Lpf_basic_model::list();
        $data['lpf_advanced_list'] = Lpf_advanced_model::list();
        $data['poas_list'] = Poas_model::list();
        $data['skills_list'] = Skills_model::list();




        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }


    public function edit()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form');
        $data['action'] = __('修 改');
        $data['courses_list'] = Courses_model::list();
        $data['categories_list'] = Categories_model::list();
        $data['central_obj_list'] = Central_obj_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['elements_list'] = Elements_model::list();
        $data['groups_list'] = Groups_model::list();
        $data['lpf_basic_list'] = Lpf_basic_model::list();
        $data['lpf_advanced_list'] = Lpf_advanced_model::list();
        $data['poas_list'] = Poas_model::list();
        $data['skills_list'] = Skills_model::list();

        $GLOBALS["select2"] = 1;        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }


    public function preview()
    {        
        $postData = $this->input->post();

        $dup_lesson_code = Lessons_model::where('code', $postData['lesson_code'])->first()->code;

        if ($dup_lesson_code) {
            $_SESSION['error_msg'] = __('課程編號不能重覆');
            redirect(admin_url('bk_'.$this->scope.'/create'));
        }

        $group_arr = array();
        foreach ($postData['group_id'] as $i => $row){
            $group_arr[$i] = $row;
        };

        $skill_arr = array();
        foreach ($postData['skills_id'] as $i => $row){
            $skill_arr[$i] = Skills_model::name($row);
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
            "pv_rel_code" => $postData['rel_code'],
            "pv_skills_id" => implode(',', $skill_arr),
            "pv_preliminary_skills" => $postData['preliminary_skills'],
            'pv_expected_outcome' => $postData['expected_outcome']
        );

        $data['page_setting'] = $this->page_setting(array(
            'update_'. $this->scope,
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form');
        $data['action'] = __('預 覽');

        $GLOBALS["datatable"] = 1;

        $data['postData'] = $postData;
        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }


    public function index($filter_type = NULL, $filter_para = NULL, $filter_para2 = NULL)
    {
        $data['page_setting'] = $this->page_setting(array(
            //'view_' . $this->scope
            'view_news'
        ), FALSE, TRUE);

        // $data['filter_type'] = $filter_type;
        // $data['filter_para'] = $filter_para;
        // if ($filter_type == 6 && $filter_para == 'null') {
        //     $data['filter_para'] = '';
        // }
        // $data['filter_para2'] = $filter_para2;

        // $data['filter_type_list'] = '';

        // $option_array = array(1 => __('All'), 2 => __('Title'));

        // foreach ($option_array as $key => $row) {
        //     $selected = '';
        //     if ($filter_type == $key) {
        //         $selected = 'selected';
        //     }
        //     $data['filter_type_list'] .= '<option value="' . $key . '" ' . $selected . '>' . $row . '</option>';
        // }

        // $data['filter_2_para_list'] = '';
        // //$result = News_ajax_model::orderBy('title', 'asc')->get();
        // $result = [];
        // if (!empty($result)) {
        //     foreach ($result as $row) {
        //         $selected = '';
        //         if ($filter_type == 2 && $filter_para == $row['id']) {
        //             $selected = 'selected';
        //         }
        //         $data['filter_2_para_list'] .= '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['title'] . '</option>';
        //     }
        // }

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $data['courses_list'] = Courses_model::list();
        $data['categories_list'] = Categories_model::list();
        $data['central_obj_list'] = Central_obj_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['elements_list'] = Elements_model::list();
        $this->load->view('webadmin/' . $this->scope . '', $data);
    }

    public function submit_form(){
        $data = $this->input->post('post_data');
        $group_ids = $this->input->post('group_id');
        $skills_ids = $this->input->post('skills_id');
        $school_based_data = array(
            'code' => $data['lesson_code'],
            'course_id' => $data['course_id'],
            'category_id' => $data['categories_id'],
            'central_obj_id' => $data['central_obj_id'],
            'sb_obj_id' => $data['sb_obj_id'],
            'element_id' => $data['element_id'],
            'lpf_basic_id' => $data['lpf_basic_id'],
            'lpf_advanced_id' => $data['lpf_advanced_id'],
            'poas_id' => $data['poas_id'],
            'preliminary_skills' => $data['preliminary_skills'],
            'expected_outcome' => $data['expected_outcome'],
            'created_by' => $_SESSION["sys_user_id"],
            'created_at' => date("Y-m-d H:i:s"),
        );

        $lesson_id = Lessons_model::create($school_based_data)->id;

        foreach ($group_ids as $i => $row) {
            Lessons_group_model::create(array('lesson_id' => $lesson_id, 'group_id' => $i,));
        }

        foreach ($skill_ids as $i => $row) {
            Lessons_skill_model::create(array('lesson_id' => $lesson_id, 'skill_id' => $row,));
        }
        
        if ($lesson_id) {
            $_SESSION['success_msg'] = __('新增課程大綱成功');
            redirect(admin_url('bk_'.$this->scope));
        } else {
            $_SESSION['error_msg'] = __('Error');
        }
    }
}
