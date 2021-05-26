<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_news2 extends MY_Controller
{
    private $scope = 'news2';

    public function __construct()
    {
        parent::__construct();

    }

    public function page_setting($permission)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('News2'),
            'scope_code' => $this->scope,
            'permission' => $permission
        );

        validate_user_access($page_setting['permission']);

        return $page_setting;
    }

    public function ajax()
    {
        $page_setting = $this->page_setting(array(
            'view_' . $this->scope
        ));

        header('Content-Type: application/json; charset=utf-8');

        $start = (int)$_GET["start"];
        $length = (int)$_GET["length"];
        $search = $_GET["search"]["value"];

        //$filter_type = $_GET["search_filter_type"];
        //$filter_para = $_GET["search_filter_para"];

        $result = News2_model::orderBy('date', 'DESC');


        if (!empty($search)) {
            $result = $result
                ->where(function ($query) use ($search) {
                    $query->orWhere('news2.title_en', 'LIKE', '%' . _h($search) . '%');
                    $query->orWhere('news2.title_tc', 'LIKE', '%' . _h($search) . '%');
                });
        }

        $result_count = $result->count();
        $result2 = $result->skip($start)->take($length)->get();

        //rearrange data
        $data = array();
        $num = 0;
        if (!empty($result2)) {
            foreach ($result2 as $key => $row) {
                $data[$num][] = _h($row['date']);
                $data[$num][] = _h($row['title_en']);
                $data[$num][] = _h($row['title_tc']);
                if($row["cover_img_tc"]){
                    $data[$num][] = '<img src="'.assets_url('files/news/cover_img/'. $row["cover_img_tc"]).'" style="width: 100%;">';
                }else{
                    $data[$num][] = '';
                }
                if($row["cover_img_en"]){
                    $data[$num][] = '<img src="'.assets_url('files/news/cover_img/'. $row["cover_img_en"]).'" style="width: 100%;">';
                }else{
                    $data[$num][] = '';
                }

                $action = '<a href="' . admin_url($page_setting['controller'] . '/modify/' . $row['id']) . '" style="margin-right: 5px;"><button type="button" class="btn btn-warning">' . __('Modify') . '</button></a>';
                if (validate_user_access(['delete_' . $page_setting['scope_code']])) {
                    $action .= '<button type="button" class="btn btn-danger" onclick="confirm_delete(\'' . admin_url($page_setting['controller'] . '/delete/' . $row['id']) . '\');">' . __('Delete') . '</button>';
                }

                if ($row['status'] == 1) {
                    $data[$num][] = '<a href="'.admin_url($page_setting['controller'] . '/status/' . $row["id"] . "/0") .'" style="margin-right: 5px;"><button type="button" class="btn btn-success">'.__('Active') .'</button></a>'.$action;
                } else {
                    $data[$num][] = '<a href="'.admin_url($page_setting['controller'] . '/status/' . $row["id"] . "/1") .'" style="margin-right: 5px;"><button type="button" class="btn btn-warning">'.__('Inactive') .'</button></a>'.$action;
                }

                $num++;
            }
        }

        $return = json_encode(array("draw" => $_GET["draw"], "recordsTotal" => $result_count, "recordsFiltered" => $result_count, "data" => $data));

        echo $return;
        exit;
    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ));

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form');
        $data['action'] = __('Create');

        $data['form_list'] = News2_model::form_list();

        $GLOBALS['datetimepicker'] = 1;
        $GLOBALS['fileinput'] = 1;
        $GLOBALS['tinymce'] = 1;
        $this->load->view('webadmin/' . $this->scope . '_form', $data);
    }

    public function delete($id)
    {
        check_sys_user_login(['delete_' . $this->scope]);

        //check if link with member
        $result = News2_model::where('id', $id)->first();
        if (!empty($result)) {
            $data = array(
                "deleted" => 1,
                "deleted_by" => $_SESSION['sys_user_id'],
                "deleted_at" => date('Y-m-d H:i:s'),
            );
            News2_model::where('id', $id)->update($data);
            $_SESSION["success_msg"] = __('Delete Successfully.');
        } else {
            $_SESSION['error_msg'] = __('Cannot find valid data.');
        }

        redirect(admin_url('bk_' . $this->scope));
    }

    public function index()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ));

        $GLOBALS["datatable"] = 1;
        $this->load->view('webadmin/' . $this->scope . '_index', $data);
    }

    public function init_upload_file()
    {
        return $upload_file_list = array(
            'base64_img' => array(
                'upload_path' => FCPATH . 'assets/files/news/base64_img/',
                'relative_upload_path' => 'assets/files/news/base64_img/',
                'allowed_types' => 'jpeg|jpg|png|pdf',
                'max_size' => 2048,
                'encrypt_name' => true,
                'type' => '',
                'file_name' => null,
                'ori_file_name' => null,
                'extension' => null,
                'deleted' => false,
                'required' => true,
                'label' => __('Base64 Img'),
                'base64' => true,
            ),
            'cover_img_en' => array(
                'upload_path' => FCPATH . 'assets/files/news/cover_img/',
                'relative_upload_path' => 'assets/files/news/cover_img/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => 2048,
                'encrypt_name' => true,
                'type' => '',
                'file_name' => null,
                'ori_file_name' => null,
                'extension' => null,
                'deleted' => false,
                'required' => true,
                'label' => __('Cover Img (TC)'),
                'base64' => false,
            ),
            'cover_img_tc' => array(
                'upload_path' => FCPATH . 'assets/files/news/cover_img/',
                'relative_upload_path' => 'assets/files/news/cover_img/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => 2048,
                'encrypt_name' => true,
                'type' => '',
                'file_name' => null,
                'ori_file_name' => null,
                'extension' => null,
                'deleted' => false,
                'required' => true,
                'label' => __('Cover Img (EN)'),
                'base64' => false,
            ),
            'banner_en' => array(
                'upload_path' => FCPATH . 'assets/files/news/banner/',
                'relative_upload_path' => 'assets/files/news/banner/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => 2048,
                'encrypt_name' => true,
                'type' => '',
                'file_name' => null,
                'ori_file_name' => null,
                'extension' => null,
                'deleted' => false,
                'required' => false,
                'label' => __('Banner (TC)'),
                'base64' => false,
            ),
            'banner_tc' => array(
                'upload_path' => FCPATH . 'assets/files/news/banner/',
                'relative_upload_path' => 'assets/files/news/banner/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => 2048,
                'encrypt_name' => true,
                'type' => '',
                'file_name' => null,
                'ori_file_name' => null,
                'extension' => null,
                'deleted' => false,
                'required' => false,
                'label' => __('Banner (EN)'),
                'base64' => false,
            ),
        );
    }

    public function modify($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ));

        $news = News2_model::find($id);
        if (empty($news)) {
            $_SESSION['error_msg'] = __('Cannot find valid data.');
            redirect(admin_url());
        }
        //end checking

        if (!empty($id)) {
            $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/' . $id);
            $data['action'] = __('Modify');
        }

        $data['id'] = $id;
        $data['form_list'] = News2_model::form_list();

        foreach ($data['form_list'] as $key => $field) {
            $data['form_list'][$key]['value'] = $news[$key];

            if($key == 'base64_img'){
                //need to set extension and ori_file_name
                $data['form_list'][$key]['extension'] = $news[$key.'_extension'];
                $data['form_list'][$key]['ori_file_name'] = $news[$key.'_ori_file_name'];
            }
        }

        $GLOBALS['datetimepicker'] = 1;
        $GLOBALS['fileinput'] = 1;
        $GLOBALS['tinymce'] = 1;
        $this->load->view('webadmin/' . $this->scope . '_form', $data);
    }

    public function status($id, $status)
    {
        check_sys_user_login(['update_' . $this->scope]);

        $data = array(
            "status" => $status,
            'updated_by' => $_SESSION["sys_user_id"],
        );
        News2_model::where('id', $id)->update($data);

        $_SESSION['success_msg'] = __('Update Successfully.');

        redirect(admin_url('bk_' . $this->scope));
    }

    public function submit_form($id = null)
    {
        if (empty($id)) {
            validate_user_access(['create_' . $this->scope], 0);
        } else {
            validate_user_access(['update_' . $this->scope], 0);
        }

        //tackle language parameter
        if (!is_numeric($id)) {
            $id = null;
        }

        if (!empty($id)) {
            $news = News2_model::where('id', $id)->first();

            if (empty($news)) {
                $_SESSION['error_msg'] = __('Cannot find valid data。');
                redirect(admin_url('bk_' . $this->scope));
            }
        }

        $rules = array();
        $form_list = News2_model::form_list();
        foreach ($form_list as $field => $row) {
            array_push($rules, array(
                    'field' => $field,
                    'lable' => $row['label'],
                    'rules' => $row['form_validation_rules'],
                    'errors' => form_validation_default_errors($row['label']),
                )
            );

            $form_data[$field] = $this->input->post($field);
        }

        $this->form_validation->set_rules($rules);

        $_SESSION['message'] = '';

        //check file
        $upload_file_list = $this->init_upload_file();

        foreach ($upload_file_list as $key => $row) {
            if ($row['required'] && ((!$id && empty($_FILES[$key]['name'])) || ($id && $this->input->post('del_' . $key) == 1 && empty($_FILES[$key]['name'])))) {
                $_SESSION['message'] .= $row['label'] . __(' must upload file.') . '<br><br>';
            } else {
                if ($id) {
                    $upload_file_list[$key]['file_name'] = $news[$key];
                }

                //delete file
                if ($id && $this->input->post('del_' . $key) == 1) {
                    $file_path = $row['upload_path'] . $news[$key];

                    $upload_file_list[$key]['file_name'] = ''; // remove on database
                    $upload_file_list[$key]['ori_file_name'] = ''; // remove on database
                    $upload_file_list[$key]['extension'] = ''; // remove on database
                    $upload_file_list[$key]['deleted'] = true; // remove on database
                    $upload_file_list[$key]['base64'] = $row['base64'];
                }

                if (!empty($_FILES[$key]['name'])) {
                    if($row['base64']){
                        $single_upload = base64_upload($key, $row['upload_path'], $row['label']);
                    }else{
                        $single_upload = single_upload($key, $row);
                    }

                    //if success return $single_upload['filename'] else return $single_upload['error']
                    if ($single_upload['error']) {
                        $_SESSION['message'] = $single_upload['error'];
                        //history_back();
                    } else if ($single_upload['filename']) {
                        $upload_file_list[$key]['file_name'] = $single_upload['filename'];
                        $upload_file_list[$key]['ori_file_name'] = $single_upload['ori_filename'];
                        $upload_file_list[$key]['extension'] = $single_upload['extension'];
                        $upload_file_list[$key]['base64'] = $row['base64'];
                    }
                }
            }
        }
        //end

        if (!$this->validate_datetime('Y-m-d H:i:s', 'date')) {
            $_SESSION['message'] .= __('Incorrect date format.') . '<br><br>';
        }

        if ($this->form_validation->run() == false || !empty($_SESSION['message'])) {
            if (empty($id)) {
                $this->create();
            } else {
                $this->modify($id);
            }
        } else {

            $data = array(
                'updated_at' => date("Y-m-d H:i:s"),
                'updated_by' => $_SESSION["sys_user_id"],
            );

            if (empty($id)) {
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['created_by'] = $_SESSION["sys_user_id"];
            }

            foreach ($form_list as $field => $row) {
                if (strpos($field, 'cover_img_') === false && strpos($field, 'banner_') === false && strpos($field, 'base64_img') === false) {
                    if ($row['encryption']) {
                        $data[$field] = $this->encryption->encrypt($form_data[$field]);
                    } else {
                        $data[$field] = $form_data[$field];
                    }
                } else {
                    foreach ($upload_file_list as $key => $row2) {
                        $data[$key] = $row2['file_name'];

                        if($key == 'base64_img'){
                            $data['base64_img_extension'] = $row2['extension'];
                            $data['base64_img_ori_file_name'] = $row2['ori_file_name'];
                        }
                        //optional, record ori_file_name, extension, base64
                    }

                    //another sample
                    //update upload doc in table member_profile_doc
                    /*foreach ($upload_file_list as $key => $row) {
                        //an other table
                        $member_profile_doc = Member_profile_doc_model::where('member_profile_id', $member_profile_id)->where('type', $row['type'])->first();

                        if (!$member_profile_doc) {
                            if ($_FILES[$key]['name']) {
                                $data = array(
                                    'created_at' => date("Y-m-d H:i:s"),
                                    'created_by' => $_SESSION["sys_user_id"],
                                    'updated_at' => date("Y-m-d H:i:s"),
                                    'updated_by' => $_SESSION["sys_user_id"],
                                    'member_profile_id' => $member_profile->id,
                                    'type' => $row['type'],
                                    'title_tc' => $row['file_name'],
                                    'file_name' => $row['file_name'],
                                    'ori_file_name' => $row['ori_file_name'],
                                    'extension' => $row['extension'],
                                    'base64' => $row['base64'],
                                );

                                Member_profile_doc_model::create($data);
                            }
                        } else {
                            $data = array(
                                'updated_at' => date("Y-m-d H:i:s"),
                                'updated_by' => $_SESSION["sys_user_id"],
                            );

                            if ($row['deleted'] || $_FILES[$key]['name']) {
                                $data['file_name'] = $row['file_name'];
                                $data['ori_file_name'] = $row['ori_file_name'];
                                $data['extension'] = $row['extension'];
                                $data['base64'] = $row['base64'];
                            }

                            $member_profile_doc->update($data);
                        }
                    }*/

                }
            }

            //insert into database
            if (empty($id)) {
                $news = News2_model::create($data);

                if ($news->id) {
                    $news_id = $news->id;
                    $_SESSION['success_msg'] = __('Create Successfully.');
                } else {
                    $_SESSION["error_msg"] = __('Create Unsuccessfully.');
                }
            } else {
                $news_id = $id;
                News2_model::where('id', $id)->update($data);

                $_SESSION['success_msg'] = __('Modify Successfully.');
            }

            redirect(admin_url('bk_' . $this->scope . '/index'));
        }
    }

    //validate datetime
    public function validate_datetime($format = 'Y-m-d H:i:s', $field_name)
    {
        $d = DateTime::createFromFormat($format, $this->input->post($field_name));
        return $d && $d->format($format) == $this->input->post($field_name);
    }


}
