<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_site_info extends CI_Controller
{
    private $scope = 'site_info';
    private $langcode = '';

    public function __construct()
    {
        parent::__construct();

        $this->langcode = get_wlang();
    }

    public function page_setting($permission)
    {
        $page_setting = array(
            'controller' => current_controller(),
            'scope' => __('Site setting'),
            'scope_code' => $this->scope,
            'permission' => $permission
        );

        validate_user_access($page_setting['permission']);

        return $page_setting;
    }

    public function modify($id)
    {
        $data['page_setting'] = $this->page_setting(array(
            'update_' . $this->scope
        ));

        $site_info = Site_info_model::find($id);

        if (empty($site_info)) {
            $_SESSION['error_msg'] = __('No data found。');
            redirect(admin_url());
        }
        //end checking
        if (!empty($id)) {
            $data['form_action'] = admin_url($data['page_setting']['controller'] . '/submit_form/' . $id);
            $data['action'] = __('Modify');
        }

        $data['id'] = $id;
        $data['form_list'] = Site_info_model::form_list();

        foreach ($data['form_list'] as $key => $field) {
            $data['form_list'][$key]['value'] = $site_info[$key];
        }

        $this->load->view('webadmin/' . $this->scope . '_form', $data);
    }

    public function submit_form($id = null)
    {
        validate_user_access(['update_' . $this->scope], 0);

        $form_checking = Site_info_model::form_checking();

        if ($form_checking['response'] == 0) {//form error
            $_SESSION['message'] = $form_checking['msg'];
            $this->create();
        } else {// form success
            $form_submit = Site_info_model::form_submit($form_checking['data'], $id);
            $_SESSION['success_msg'] = $form_submit['msg'];
            if ($form_submit['response'] == 0) {
                if(!$id){
                    $this->create();
                }else{
                    $this->modify($id);
                }
            } else {
                redirect(admin_url('bk_' . $this->scope));
            }
        }
    }

}
