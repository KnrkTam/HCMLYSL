<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_modules_week extends CI_Controller //change this
{
    private $scope = 'modules_week'; //change this

    public function __construct()
    {
        parent::__construct();
    }

    public function page_setting($permission, $return = TRUE, $redirect = FALSE)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('全校學習單元週次 - 檢視'), //change this
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

        $GLOBALS["select2"] = 1;
        $GLOBALS["datatable"] = 1;
        $postData = $this->input->post();


        $data['years_list'] = Years_model::list();
        $data['levels_list'] = Levels_model::list();

        if ($postData) {
            $data['year_id'] = $postData->year_id;
            $data['level_id'] = $postData->level_id;
    
        } else {
            $data['year_id'] = Years_model::orderBy('year_from', 'DESC')->first()->id;
        }

        $data['form_action'] = admin_url($data['page_setting']['controller']);


        $this->load->view('webadmin/' . $this->scope . '', $data);
    }


    public function ajax(){
        $postData = $this->input->post();
        // dump($postData);
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);
        $year_id =  $postData['year_search'];
        $level_id =  $postData['level_search'];

        $module_list = array(
            '1' => '單元一',
            '2' => '單元二',
            '3' => '單元三',
            '4' => '單元四',
        );
        $result_arr = array();
        // $result = Modules_week_model::where('year_id', $year_id)->orderBy('level_id', 'ASC')->get();

        if ($year_id) {
            if ($level_id) {
                if ($level_id == 5) {
                    $result = Modules_week_model::where('year_id', $year_id)->orderBy('level_id', 'ASC')->get();
                }else {
                    $result = Modules_week_model::where('year_id', $year_id)->where('level_id', $level_id)->get();
                }
            } else {
                $result = Modules_week_model::where('year_id', $year_id)->orderBy('level_id', 'ASC')->get();
            }

        }
        
        $result_count = count($result);

        //rearrange data
        $data = array();
        $num = 0;

        foreach ($result as $row) {
            foreach ($module_list as $i => $foo) {
                $data[$num][] = '<a class="editLinkBtn" href="'.admin_url(current_controller() . '/edit/'. $row['id'] ).'"><i class="fa fa-edit"></i></a>';
                $data[$num][] = Years_model::annual($row['year_id']);
                $data[$num][] = Levels_model::name($row['level_id']);
                $data[$num][] = date('d/m/Y', strtotime($row['module_from_'.$i.''])).' - '. date('d/m/Y', strtotime($row['module_to_'.$i.'']));
                $data[$num][] = $row['week_from_'.$i.''].'-'.$row['week_to_'.$i.''];
                $data[$num][] = date('d/m/Y', strtotime($row['first_assessment_'.$i.'']));
                $data[$num][] = date('d/m/Y', strtotime($row['second_assessment_'.$i.'']));
                $num++; 

            }
        }  

        $return = json_encode(array("draw" =>  $postData["draw"], "data" => $data, "get" => $_GET, "recordsTotal" => $result_count, "recordsFiltered" => $result_count));

        echo $return;

    }

    public function create()
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview');
        $data['action'] = __('新 增');
        $data['years_list'] = Years_model::list();
        $data['levels_list'] = Levels_model::list(1234);
        $data['modules_list'] = array(
            '1' => '單元一',
            '2' => '單元二',
            '3' => '單元三',
            '4' => '單元四',
        );
        $week_count = array();

        for ($i = 1; $i< 24; $i++) {
            $week_count[$i] = $i;
        }
        $data['week_count'] = $week_count;
        
        $GLOBALS["select2"] = 1;
        $GLOBALS['datetimepicker'] = 1;
        $this->load->view('webadmin/' . $this->scope . '_form',  $data);
    }

    public function validate()
    {
        $data['page_setting'] = $this->page_setting(array(
            'create_' . $this->scope
        ), FALSE, TRUE);

        $postData = $this->input->post();

        switch(true) {
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

            default;
            $data = array(
                'status' => 'success',
            );
        }
        echo json_encode($data);

    }

    public function edit($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $modules_week = Modules_week_model::find($id);
        if (!$modules_week) {
            $_SESSION['error_msg'] = __('找不到資料');
            redirect(admin_url('bk_'.$this->scope. '/create'));
        }
        // $data[] = $modules_week;

        $data['action'] = __('修 改');
        $data['years_list'] = Years_model::list();
        $data['levels_list'] = Levels_model::list(1234);
        $data['modules_list'] = array(
            '1' => '單元一',
            '2' => '單元二',
            '3' => '單元三',
            '4' => '單元四',
        );
        $week_count = array();

        for ($i = 1; $i< 24; $i++) {
            $week_count[$i] = $i;
        }
        $data['week_count'] = $week_count;
        $data['year_id'] = $modules_week->year_id;
        $data['level_id'] = $modules_week->level_id;
        $data['data'] = $modules_week;



        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/preview/'. $id);

        $GLOBALS["select2"] = 1;
        $GLOBALS['datetimepicker'] = 1;


        $this->load->view('webadmin/' . $this->scope . '_edit',  $data);
    }

    public function preview($id = null)
    {
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
        ), FALSE, TRUE);

        $postData = $this->input->post();
        $previous = $postData['action'];


        if (!$id) {
            $dup_modules_week = Modules_week_model::where('year_id', $postData['year_id'])->where('level_id', $postData['level_id'])->first();

            if ($dup_modules_week) {
                $_SESSION['log_msg'] = __('已重複年度學習單元');
                redirect(admin_url('bk_'.$this->scope. '/edit/'. $dup_modules_week->id));
            }
        }


        $data['modules_list'] = array(
            '1' => '單元一',
            '2' => '單元二',
            '3' => '單元三',
            '4' => '單元四',
        );
        $data['annual'] = Years_model::annual($postData['year_id']);
        $data['level'] = Levels_model::name($postData['level_id']);
        $data['moduleFrom'] = $postData['moduleFrom'];
        $data['moduleTo'] = $postData['moduleTo'];
        $data['weekNumFrom'] = $postData['weekNumFrom'];
        $data['weekNumTo'] = $postData['weekNumTo'];
        $data['assessment1'] = $postData['assessment1'];
        $data['assessment2'] = $postData['assessment2'];

        $data['previous'] = $previous;
        $data['postData'] = $postData;

        $data['id'] = $id;



        $data['action'] = __('預 覽');

        $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/'. $id);


        $this->load->view('webadmin/' . $this->scope . '_preview',  $data);
    }

    public function submit_form($id = null){
        $data['page_setting'] = $this->page_setting(array(
            'view_'. $this->scope,
            'update_'. $this->scope,
        ), FALSE, TRUE);


        $postForm = $this->input->post();

        $postData = json_decode($postForm['post_data']);

        $module_week_data = array();

            foreach ($postData->moduleFrom as $i => $row) {
                $module_week_data['year_id'] = $postData->year_id;
                $module_week_data['level_id'] = $postData->level_id;
                $module_week_data['module_from_'.$i.''] = date('Y-m-d', strtotime(str_replace('/', '-', $row)));
                $module_week_data['module_to_'.$i.''] = date('Y-m-d', strtotime(str_replace('/', '-',$postData->moduleTo->$i)));
                $module_week_data['week_from_'.$i.''] = $postData->weekNumFrom->$i;
                $module_week_data['week_to_'.$i.''] = $postData->weekNumTo->$i;
                $module_week_data['first_assessment_'.$i.''] = date('Y-m-d', strtotime(str_replace('/', '-',$postData->assessment1->$i)));
                $module_week_data['second_assessment_'.$i.''] = date('Y-m-d', strtotime(str_replace('/', '-',$postData->assessment2->$i)));
            }

        // );
        
        // dump($module_week_data);
    
        if (!$id) {

            $created_id = Modules_week_model::create($module_week_data)->id;
        
        } else {
            $created_id = Modules_week_model::find($id)->update($module_week_data);

            $_SESSION['success_msg'] = __('修改各級年度學習單元成功');
            redirect(admin_url('bk_'.$this->scope));

        };

        if ($created_id) {
            $_SESSION['success_msg'] = __('設定各級年度學習單元成功');
            redirect(admin_url('bk_'.$this->scope));
        } else {
            $_SESSION['error_msg'] = __('Error');

        }


    }


}
