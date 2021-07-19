<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_master_modules extends CI_Controller //change this
{
    private $scope = 'master_modules'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('各學階單元設定(master)'), //change this
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

        $data['scope_code'] = $this->scope;
        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        
        //level drop down
        $data['level_list'] = Levels_model::list('aal');


        //modules
        $modules = Modules_model::all();
        $data['modules'] = $modules;
        $data['module_count'] = Modules_model::select('level_id', DB::raw('count(*) as count'))->groupBy('level_id')->orderBy('count','desc')->first()->count;
        for ($i=0; $i < 5; $i++){
            $data['module_row'.$i] = Modules_model::module_row($i);
        };

        $this->load->view('webadmin/' . $this->scope . '', $data);
    }


    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);

        // POST
        $postData = $this->input->post();

        $dup_code = Modules_model::where('code',$postData['code'])->first()->name;

        switch (true) {
            case (empty($postData['code'])):
                $data = array(
                    'status' => '請輸入單元編號',
                );
                break;
            case (!empty($dup_code)):
                $data = array(
                    'status' => '單元編號重複',
                );
                break;
            case (empty($postData['name'])):
                $data = array(
                    'status' => '請輸入單元名稱',
                );
                break;
            default:
            $module_data = array(
                'code' => $postData['code'],
                'name' => $postData['name'],
                'level_id' => $postData['level_id'],
            );
            $module_id = Modules_model::create($module_data)->id;
            $_SESSION['success_msg'] = __('新增單元成功');
            $data = array(
                'status' => 'success',
            );
        }
    
        echo json_encode($data);
    }

    
    public function edit($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ), FALSE, TRUE);

        // POST
        $postData = $this->input->post();
        $dup_code = Modules_model::where('id', '!=', $id)->where('code',$postData['code'])->first()->name;

        $module = Modules_model::find($id);
        $module_arr = array(
            'level_id' => strval($module->level_id),
            'code' => $module->code,
            'name' => $module->name,
            'id' => strval($module->id),
        );
        $new_arr = array(
            'level_id' => $postData['level_id'],
            'code' => $postData['code'],
            'name' => $postData['name'],
        );


        switch (true) {
            case ($module_arr === $postData):
                $data = array(
                    'status' => 'no_change',
                );
                break;
            case (empty($postData['code'])):
                $data = array(
                    'status' => '請輸入單元編號',
                );
                break;
            case ($dup_code):
                if ($dup_code !== $module->code) {
                    $data = array(
                        'status' => '單元編號重複',
                    );
                } 
                break;
            case (empty($postData['name'])):
                $data = array(
                    'status' => '請輸入單元名稱',
                );
                break;
            default:
                $_SESSION['success_msg'] = __('修改單元成功');
                Modules_model::where('id', $id)->update($new_arr);
                $data = array(
                    'status' => 'success',
                );
        }


        echo json_encode($data);

    }



}
