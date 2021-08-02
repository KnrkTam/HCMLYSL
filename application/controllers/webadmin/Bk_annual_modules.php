<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_annual_modules extends CI_Controller //change this
{
    private $scope = 'annual_modules'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('設定各級年度學習單元 - 檢視'), //change this
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

        $data['years_list'] = Years_model::list();
        $year_id = Years_model::orderBy('year_from', 'DESC')->first()->id;
        $data['year_id'] = $year_id; 

        $data['form_action'] = admin_url($data['page_setting']['controller']);

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }

    public function ajax(){
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        $year_id = $_GET['year_search'];

        $result = Annual_modules_model::list($year_id);
        
        $result_count = count($result);

        //rearrange data
        $data = array();
        $num = 0;

        foreach ($result as $i => $row) {
            // dump($row);
                $data[$num][] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. $row['modules'][1]['id'] ).'"><i class="fa fa-edit"></i></a>';
                $data[$num][] = Levels_model::name($row['level_id']);
                $data[$num][] = Classes_model::name($row['class_id']);
                $data[$num][] = Modules_model::name($row['modules'][1]['module_id']);
                $data[$num][] = $row['modules'][1]['remark'];
                $data[$num][] = Modules_model::name($row['modules'][2]['module_id']);
                $data[$num][] = $row['modules'][2]['remark'];
                $data[$num][] = Modules_model::name($row['modules'][3]['module_id']);
                $data[$num][] = $row['modules'][3]['remark'];
                $data[$num][] = Modules_model::name($row['modules'][4]['module_id']);
                $data[$num][] = $row['modules'][4]['remark'];
                $num++; 

        }  

        $return = json_encode(array("draw" => $_GET["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function select_level()
    {
        $postData = $this->input->post();

        $data = Modules_model::list($postData['level_id']);


        echo json_encode($data);


    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;

        $data['action'] = __('新 增');
        $data['years_list'] = Years_model::list();
        $data['levels_list'] = Levels_model::list();
        $data['classes_list'] = Classes_model::list();
        // $data['modules_list'] = Modules_model::list();
        



        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');

        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }

    public function edit($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);

        $annual_module1 = Annual_modules_model::find($id);
        if (!$annual_module1) {
            $_SESSION['error_msg'] = __('找不到資料');
            redirect(admin_url('bk_'.$this->scope. '/create'));
        }


        $data['action'] = __('修 改');
        $data['years_list'] = Years_model::list();
        $data['levels_list'] = Levels_model::list(123);
        $data['classes_list'] = Classes_model::list();
        $data['modules_list'] = Modules_model::list($annual_module1->level_id);

        $annual_module_data = Annual_modules_model::where('year_id', $annual_module1->year_id)->where('class_id', $annual_module1->class_id)->where('level_id', $annual_module1->level_id)->get();
        // dump($annual_module_data);

        $data['year_id'] = $annual_module1->year_id;
        $data['level_id'] = $annual_module1->level_id;
        $data['class_id'] = $annual_module1->class_id;
        $data['module1_id'] = $annual_module_data[0]->module_id;
        $data['module2_id'] = $annual_module_data[1]->module_id;
        $data['module3_id'] = $annual_module_data[2]->module_id;
        $data['module4_id'] = $annual_module_data[3]->module_id;
        $data['remark1'] =  $annual_module_data[0]->remark;
        $data['remark2'] = $annual_module_data[1]->remark;
        $data['remark3'] = $annual_module_data[2]->remark;
        $data['remark4'] = $annual_module_data[3]->remark;


        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $id);

        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }

    public function validate($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);

        $postData = $this->input->post();
        if (!$id){
            $dup_annual_module = Annual_modules_model::where('year_id', $postData['year_id'])->where('level_id', $postData['level_id'])->where('class_id', $postData['class_id'])->first();
        }


        switch(true) {
            case ($dup_annual_module);
            $data = array(
                'status' => '已重複年度學習單元',
            );
            break;

            case (!$postData['year_id']);
            $data = array(
                'status' => '請選擇年度',
            );
            break;

            case (!$postData['level_id']);
            $data = array(
                'status' => '請選擇學階',
            );
            break;

            case (!$postData['class_id']);
            $data = array(
                'status' => '請選擇班別',
            );
            break;

            default;
            $data = array(
                'status' => 'success',
            );
        }
        echo json_encode($data);

    }

    public function preview($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_' . $this->scope
        ), FALSE, TRUE);
        $postData = $this->input->post();
        $previous = $postData['action'];
        if (!$id) {
            $dup_annual_module = Annual_modules_model::where('year_id', $postData['year_id'])->where('level_id', $postData['level_id'])->where('class_id', $postData['class_id'])->first();
        }
    
        switch(true) {
            case ($dup_annual_module);
            $_SESSION['log_msg'] = __('已重複年度學習單元');
            redirect(admin_url('bk_'.$this->scope. '/edit/'. $dup_annual_module->id));
            break;

            case (!$postData['year_id']);
            $_SESSION['error_msg'] = __('請選擇年度');
            redirect(admin_url('bk_'.$this->scope. '/'. $previous));
            break;

            case (!$postData['level_id']);
            $_SESSION['error_msg'] = __('請選擇學階');
            redirect(admin_url('bk_'.$this->scope. '/'. $previous));
            break;

            case (!$postData['class_id']);
            $_SESSION['error_msg'] = __('請選擇班別');
            redirect(admin_url('bk_'.$this->scope. '/'. $previous));
            break;

            default;  
        }

        $data['previous'] = $previous;
        $data['action'] = __('預 覽');
        $data['annual'] = Years_model::annual($postData['year_id']);
        $data['level'] = Levels_model::name($postData['level_id']);
        $data['class'] = Classes_model::name($postData['class_id']);

        foreach ($postData['module_id'] as $i => $module_id) {
            $data['module'.($i+1)] = Modules_model::name($module_id, 'code');
            $data['remark'.($i+1)] = $postData['remark'][$i];

        }
 

        $data['id'] = $id;
        $data['postData'] = $postData;


        
        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'. $id);



        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    public function submit_form($first_module_id = null){
        $postForm = $this->input->post();
        $postData = (array)json_decode($postForm['post_data']);

        foreach ($postData['module_id'] as $i => $module_id) {
            $annual_module_data = array(
                'year_id' => $postData['year_id'],
                'level_id' => $postData['level_id'],
                'class_id' => $postData['class_id'],
                'module_id' => $module_id,
                'remark' => $postData['remark'][$i],
                'module_order' => ($i+1),
            );
            if (!$first_module_id) {

                $created_id = Annual_modules_model::create($annual_module_data)->id;
            } else {
                $updated_id = Annual_modules_model::where('year_id', $postData['year_id'])->where('level_id', $postData['level_id'])->where('class_id', $postData['class_id'])->where('module_order', ($i+1))->update($annual_module_data);
            };
        }
        if ($created_id) {
            $_SESSION['success_msg'] = __('設定各級年度學習單元成功');
            redirect(admin_url('bk_'.$this->scope));
        } else if ($updated_id){
            $_SESSION['success_msg'] = __('修改各級年度學習單元成功');
            redirect(admin_url('bk_'.$this->scope));
        } else {
            $_SESSION['error_msg'] = __('Error');

        }


    }

}
