<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_annual_sen_support extends CI_Controller //change this
{
    private $scope = 'annual_sen_support'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('設定年度支援/個別化學習負責人 - 檢視'), //change this
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


        $data['years_list'] = Years_model::list();
        $data['services_list'] = Services_model::list();
        $year_id = Years_model::orderBy('year_from', 'DESC')->first()->id;
        $data['year_id'] = $year_id; 
        

        $data['data'] = json_decode();
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        $this->load->view('webadmin/' . $this->scope . '', $data);
    }

    public function validate($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);

        $postData = $this->input->post();
        if (!$id){
            $dup_data = Annual_sen_support_model::where('year_id', $postData['year_id'])->where('service_id', $postData['service_id'])->first();
        }


        switch(true) {
            case ($dup_data);
            $data = array(
                'status' => '已存在年度支援/個別化學習負責人',
            );
            break;

            case (!$postData['year_id']);
            $data = array(
                'status' => '請選擇年度',
            );
            break;

            case (!$postData['staff_id']);
            $data = array(
                'status' => '請選擇人選',
            );
            break;

            case (!$postData['service_id']);
            $data = array(
                'status' => '請選擇服務',
            );
            break;

            default;
            $data = array(
                'status' => 'success',
            );
        }
        echo json_encode($data);

    }

    public function ajax(){
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $year_id = $_GET['year_search'];
        $service_id = $_GET['service_search'];

        $result_arr = array();

        switch (true) {
            case ($year_id && $service_id);
            $result = Annual_sen_support_model::where('year_id', $year_id)->where('service_id', $service_id)->get();
            break;

            case ($year_id);
            $result = Annual_sen_support_model::where('year_id', $year_id)->get();
            break;

            case ($service_id);
            $result = Annual_sen_support_model::where('service_id', $service_id)->get();
            break;
        }
        
        $result_count = count($result);

        //rearrange data
        $data = array();
        $num = 0;

        foreach ($result as $row) {
            $data[$num][] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. $row['id'] ).'"><i class="fa fa-edit"></i></a>';
            $data[$num][] = Years_model::annual($row['year_id']);
            $data[$num][] = Services_model::name($row['service_id']);
            $data[$num][] = Staff_model::name($row['staff_id']);
            $num++; 
        }  

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_news'
        ), FALSE, TRUE);

        $GLOBALS["select2"] = 1;

        $data['action'] = __('新 增');
        $data['years_list'] = Years_model::list();
        $data['services_list'] = Services_model::list();
        $data['staff_list'] = Staff_model::list();

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');

        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }
    public function edit($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);


        $GLOBALS["select2"] = 1;

        $annual_sen = Annual_sen_support_model::find($id);

        
        if (!$id || !$annual_sen) {
            $_SESSION['error_msg'] = __('找不到相關資料');
            redirect(admin_url('bk_'.$this->scope));
        }


        $data['action'] = __('修 改');
        $data['years_list'] = Years_model::list();
        $data['staff_list'] = Staff_model::list();
        $data['services_list'] = Services_model::list();
        $data['year_id'] = $annual_sen['year_id'];
        $data['service_id'] = $annual_sen['service_id'];
        $data['staff_id'] = $annual_sen['staff_id'];



        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $id);


        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }


    public function preview($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $previous = $_POST['action'];

        $data['action'] = __('預 覽');
        $data['year_id'] = Years_model::annual($_POST['year_id']);
        $data['service_id'] = Services_model::name($_POST['service_id']);
        $data['staff_id'] = Staff_model::name($_POST['staff_id']);
        $data['previous'] = $previous;
        $data['id'] = $id;

        $data['postData'] = $_POST;

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'. $id);

        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    public function submit_form($id = null){
        $postData = json_decode($_POST['post_data']);
        $result_data = array(
            'year_id' => $postData->year_id,
            'staff_id' => $postData->staff_id,
            'service_id' => $postData->service_id,
        );
        if (!$id) {
            $created_id = Annual_sen_support_model::create($result_data)->id;
        } else {
            $created_id = Annual_sen_support_model::find($id)->update($result_data);

            $_SESSION['success_msg'] = __('修改設定年度教職員成功');
            redirect(admin_url('bk_'.$this->scope));

        };

        if ($created_id) {
            $_SESSION['success_msg'] = __('新增年度教職員成功');
            redirect(admin_url('bk_'.$this->scope));
        } else {
            $_SESSION['error_msg'] = __('Error');

        }


    }

}
