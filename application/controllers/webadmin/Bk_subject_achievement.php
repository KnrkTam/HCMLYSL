<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_subject_achievement extends CI_Controller //change this
{
    private $scope = 'subject_achievement'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('科目預期學習成果 - 檢視'), //change this
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

    public function index()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
            // 'view_news'
        ), FALSE, TRUE);

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $data['subject_list'] = Subjects_model::list();
        $data['courses_list'] = Courses_model::list();
        $data['categories_list'] = Categories_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['lessons_list'] = Lessons_model::list();

       
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
        $lessons_arr = array();

        if ($subject_id) {
            $filtered_lessons = Lessons_model::list($course_id, $category_id,$sb_obj_id, $lesson_id);
            foreach ($filtered_lessons as $i =>$row) {
                $lessons_arr[$i] = Lessons_model::table_list($i);
            }
            // return $lessons_arr;
        } else {
            $lessons_arr = null;
        }
        // dump($lessons_arr);
       
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
                $data[$num][] = $row['preliminary_skill'];
                $data[$num][] = $row['code'];
                $data[$num][] = $row['expected_outcome'];
                $rel_les = '';
                foreach ($row['rel_lessons'] as $key) {
                    $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                }
                $data[$num][] = $rel_les;

                // $action = '<div class="nowrap">';
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
                $num++;
            }
        }
        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));
        // dump(current_controller());
        echo $return;
        // echo json_encode($data);

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
                $subject_id = $_GET['subject_search'];

                $lessons_arr = array();

                // if ($subject_id) {
                    $filtered_lessons = Lessons_model::list($course_id, $category_id,$sb_obj_id, $lesson_id);
                    foreach ($filtered_lessons as $i =>$row) {
                        $lessons_arr[$i] = Lessons_model::table_list($i);
                    }

                // } else {
                //     $lessons_arr = null;
                // }

        
                $result_count = count($lessons_arr);
        
                //rearrange data
                $data = array();
                $num = 0;
                if (!empty( $lessons_arr)) {
                    foreach ( $lessons_arr as $key => $row) {
                        $data[$num][] = '<input type="checkbox" class="addLesson" value="'.$row['id'].'"/>';
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
                        $data[$num][] = $row['preliminary_skill'];
                        $data[$num][] = $row['code'];
                        $data[$num][] = $row['expected_outcome'];
                        $rel_les = '';
                        foreach ($row['rel_lessons'] as $key) {
                            $rel_les .= '<button type="button" class="btn-xs btn btn-primary badge">' .Lessons_model::code($key).'</button> &nbsp';
                        }
                        $data[$num][] = $rel_les;                        
                        // $action = '<div class="nowrap">';
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
                        $num++;
                    }
                }
                $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));
                // dump(current_controller());
                echo $return;
                // echo json_encode($data);
    }

    public function select_ajax() 
    {
                // $postData = $this->input->post();
                $data['page_setting'] = $this->page_setting(array(
                    'view_'. $this->scope,
                ), FALSE, TRUE);
        
                $added_ids = $_GET['added_ids'];
                if ($added_ids) {
                    $selected_lessons = Lessons_model::list(null, null, null, $added_ids);
                    $lessons_arr = array();
                    foreach ($selected_lessons as $i =>$row) {
                        $lessons_arr[$i] = Lessons_model::table_list($i);
                    }
            
                    $result_count = count($lessons_arr);
                }

                //rearrange data
                $data = array();
                $num = 0;
                if (!empty( $lessons_arr)) {
                    foreach ( $lessons_arr as $key => $row) {
                        $data[$num][] = '<a class="removeRow text-red" name="subject_lessons['.$key.']" value="'.$row['id'] .'"><i class="fa fa-fw fa-trash-o"></i></a>';
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
                        $num++;
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
        
                $added_ids = $_GET['added_ids'];
                if ($added_ids) {
                    $selected_lessons = Lessons_model::list(null, null, null, $added_ids);
                    $lessons_arr = array();
                    foreach ($selected_lessons as $i =>$row) {
                        $lessons_arr[$i] = Lessons_model::table_list($i);
                    }
            
                    $result_count = count($lessons_arr);
                }

                //rearrange data
                $data = array();
                $num = 0;
                if (!empty( $lessons_arr)) {
                    foreach ( $lessons_arr as $key => $row) {
                        // $data[$num][] = '<a class="removeRow text-red" name="subject_lessons['.$key.']" value="'.$row['id'] .'"><i class="fa fa-fw fa-trash-o"></i></a>';
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
                        $num++;
                    }
                }
                $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

                echo $return;

    }
    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);

        // $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form');
        $data['action'] = __('新 增');

        $data['subject_list'] = Subjects_model::list();
        $data['courses_list'] = Courses_model::list();
        $data['categories_list'] = Categories_model::list();
        $data['sb_obj_list'] = Sb_obj_model::list();
        $data['lessons_list'] = Lessons_model::list();



        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');

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

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $postData = $this->input->post();

        $added_ids_str = $postData['subject_lessons'][0];
        $added_ids = explode(',', $added_ids_str);
 


        $data['added_ids'] = $added_ids;

        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }
    
}
