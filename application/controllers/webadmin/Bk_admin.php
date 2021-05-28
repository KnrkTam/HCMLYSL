<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bk_admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //load decryption
        $this->load->helper('cryptojs-aes');
    }

    public function access_denied()
    {
        $this->load->view('webadmin/access_denied');
    }

    public function auth()
    {
        //decryption
        $password = $this->input->post('login_pw') ? cryptoJsAesDecrypt($this->input->post('login_pw')) : '';

        //form checking
        $this->form_validation->set_rules('login_id', __('Login ID'), 'trim|required', array(
            'required' => __('Please enter') . ' %s.',
        ));
        $this->form_validation->set_rules('login_pw', __('Login Password'), 'trim|required|min_length[8]', array(
            'required' => __('Please enter') . ' %s.',
            'min_length' => '%s should contain at least 8 characters.',
        ));

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            //check if login lock
            $this->load->model('Login_log_model');
            $lock = Login_log_model::check_if_lock();

            if ($lock) {
                $_SESSION["error_msg"] = __('You have failed to log in many times, please try again after 10 minutes.If you forget your password, please contact us.');
                redirect(admin_url());
            }

            //form data
            $sys_user = Sys_user_model::where('login_id', $this->input->post('login_id'))->where('status', 1)->first();

            $valid = false;
            //login log
            $data["ip_address"] = get_client_ip();
            $data["user_agent"] = $_SERVER['HTTP_USER_AGENT'];
            $data["session_id"] = session_id();

            if (!empty($sys_user)) {
                $sys_user = $sys_user->toArray();
                //if ($this->encryption->decrypt($sys_user['login_pw']) == $this->input->post('login_pw')) {
                if (($sys_user['login_pw']) == sha256_hash($password)) {
                    //valid login
                    $data["table_name"] = "sys_user";
                    $data["table_id"] = $sys_user["id"];
                    $data["is_success"] = 1;
                    $data["is_block"] = 0;
                    $data["createdate"] = date("Y-m-d H:i:s");
                    Login_log_model::create($data);

                    $valid = true;
                    $_SESSION["sys_user_id"] = $sys_user["id"];
                    $_SESSION["login_id"] = $sys_user["login_id"];
                    $_SESSION["login_name"] = $sys_user["login_name"];
                    $_SESSION["login_role"] = $sys_user["login_role"];
                    $_SESSION["role_level"] = $sys_user["role_level"];
                    //$_SESSION["message"] = "登入成功.";

                    //for elfinder
                    $_SESSION["ELFINDER"] = true;

                    $_SESSION["PROJECT_KEY"] = PROJECT_KEY;

                    redirect(admin_url());
                }
            }

            if (!$valid) {
                $data["table_name"] = "sys_user";
                $data["table_id"] = $this->input->post('login_id');
                $data["is_success"] = 0;
                $data["is_block"] = 1;
                $data["createdate"] = date("Y-m-d H:i:s");
                Login_log_model::create($data);

                $_SESSION["error_msg"] = __('Login Fail. Please try again.');
                redirect(admin_url());
            }
        }
    }


    public function blank()
    {
        $this->load->view("webadmin/blank");
    }

    public function index()
    {
        if (!empty($_SESSION['login_id'])) {
            $this->load->view('webadmin/index');
        } else {
            $this->load->view('webadmin/login');
        }
    }

    public function logout()
    {
        unset($_SESSION["sys_user_id"]);
        unset($_SESSION["login_id"]);
        unset($_SESSION["login_name"]);
        unset($_SESSION["login_role"]);
        unset($_SESSION["role_level"]);
        unset($_SESSION["ELFINDER"]);
        unset($_SESSION["PROJECT_KEY"]);

        redirect(admin_url());
    }

    public function profile()
    {
        //check_sys_user_login(['view_sys_user']);

        $sys_user = Sys_user_model::find($_SESSION['sys_user_id']);

        $sys_user = _toArray($sys_user, 'webadmin');
        if (!empty($sys_user['login_role'])) {
            $sys_user['login_role'] = get_login_role_name($sys_user['login_role']);
        }

        $this->load->view("webadmin/profile_form", $sys_user);
    }


    public function profile_submit()
    {

        //decryption
        $password = $this->input->post('password') ? cryptoJsAesDecrypt($this->input->post('password')) : '';
        $password2 = $this->input->post('password2') ? cryptoJsAesDecrypt($this->input->post('password2')) : '';
        // dump($this->input->post());
        //set form data
        $this->form_validation->set_data(array(
            'login_name' => $this->input->post('login_name', 1),
            'email'      => $this->input->post('email', 1),
            'password'   => $password,
            'password2'  => $password2,
        ));

        $this->form_validation->set_rules('password', __('New Password'), 'trim|regex_match[/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/]', array(
            'required' => __('Please enter') . ' %s.',
            'regex_match' => '%s ' . __('should contain at least 8 characters, at least 1 upper letter, at least 1 lower letter and at least 1 number.'),
        ));

        $this->form_validation->set_rules('password2', __('Confirm Password'), 'trim|matches[password]', array(
            'required' => __('Please enter') . ' %s.',
            //'regex_match' => '%s ' . __('should contain at least 8 characters, at least 1 upper letter, at least 1 lower letter and at least 1 number.'),
        ));

        if ($this->form_validation->run() == false) {
            $_SESSION['error_msg'] = __('Update failed, please try again.');

            $this->profile();

        } else {
            //form data
            $data = array(
                'login_name' => ($this->input->post('login_name')),
                'updated_by' => $_SESSION['sys_user_id'],
            );

            if ($password) {
                $data['login_pw'] = sha256_hash($password);
            }

            //update database
            Sys_user_model::find($_SESSION['sys_user_id'])->update($data);

            $_SESSION['success_msg'] = __('Update Successfully.');

            redirect(admin_url('bk_admin/profile'));
        }
    }

    public function version()
    {
        check_sys_user_login();
        $this->load->view("webadmin/version");
    }

}
