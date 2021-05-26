<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Bk_sys_user extends CI_Controller
{

    private $scope = 'sys_user';

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Sys_user_model');
        $this->load->model('Phprbac_roles_model');

        //load decryption
        $this->load->helper('cryptojs-aes');
    }

    public function create()
    {
        check_sys_user_login(['create_sys_user']);

        $sys_user_role = [];
        $result        = Phprbac_roles_model::where('Level', '>', $_SESSION['role_level'])->orderBy('Level', 'ASC')->get();
        foreach ($result as $role) {
            $sys_user_role[$role['Title']] = __($role['Description']);
        }

        $data['sys_user_role_list'] = $sys_user_role;

        $this->load->view('webadmin/' . $this->scope . '_form', $data);
    }

    public function delete($id)
    {
        check_sys_user_login(['delete_sys_user']);

        $result = Sys_user_model::find($id);

        $this->role_level_checking($result);

        $data = array(
            "deleted"    => 1,
            "deleted_by" => $_SESSION['sys_user_id'],
            "deleted_at" => date('Y-m-d H:i:s'),
        );
        Sys_user_model::where('id', $id)->update($data);

        $_SESSION['success_msg'] = __('Deleted successfully');

        redirect(admin_url('bk_permission/delete_user/' . $result->login_role . '/' . $id));
    }

    public function index()
    {
        check_sys_user_login(['view_sys_user']);

        $data["sys_user_index"] = Sys_user_model::Where('role_level', '>', $_SESSION['role_level'])->orWhere(function ($query) {
            $query
                ->where('role_level', '=', $_SESSION['role_level'])
                ->where('id', '=', $_SESSION['sys_user_id']);
        })->where('id', '!=', $_SESSION["sys_user_id"])->get();

        $this->load->view('webadmin/' . $this->scope . '_index', $data);
    }

    public function modify($id)
    {
        check_sys_user_login(['update_sys_user']);

        $data = Sys_user_model::find($id);

        $this->role_level_checking($data);

        if (empty($data)) {
            redirect(admin_url('bk_sys_user'));
        } else {
            $data = $data->toArray();
        }

        $data["id"] = $id;

        $sys_user_role = [];
        $operation = '>';
        if ($id == $_SESSION['sys_user_id']) {
            $operation = '>=';
        }

        $result = Phprbac_roles_model::where('Level', $operation, $_SESSION['role_level'])->orderBy('Level', 'ASC')->get();
        foreach ($result as $role) {
            $sys_user_role[$role['Title']] = __($role['Description']);
        }

        $data['sys_user_role_list'] = $sys_user_role;

        $this->load->view('webadmin/sys_user_form', $data);
    }

    public function role_level_checking($data)
    {
        if (empty($data)) {
            //error
            $_SESSION['error_msg'] = __('Cannot find valid record.');
            redirect(admin_url('bk_sys_user'));
        } else {
            if ($data['role_level'] < $_SESSION['role_level'] || ($data['role_level'] == $_SESSION['role_level'] && $data['id'] != $_SESSION['sys_user_id'])) {
                //error
                $_SESSION['error_msg'] = __('You do not have permission.');
                redirect(admin_url('bk_sys_user'));
            }
        }
    }

    public function status($id, $status)
    {
        check_sys_user_login(['update_sys_user']);

        $result = Sys_user_model::find($id);

        $this->role_level_checking($result);

        $data = array(
            "status"     => $status,
            'updated_by' => $_SESSION["sys_user_id"],
        );
        Sys_user_model::where('id', $id)->update($data);

        $_SESSION['success_msg'] = __('Update Successfully.');

        redirect(admin_url('bk_sys_user'));
    }

    public function submit_form($id = null)
    {
        check_sys_user_login(['create_sys_user', 'update_sys_user']);

        //tackle language parameter
        if (!is_numeric($id)) {
            $id = null;
        }

        //decryption
        $password = $this->input->post('password') ? cryptoJsAesDecrypt($this->input->post('password')) : '';
        $password2 = $this->input->post('password2') ? cryptoJsAesDecrypt($this->input->post('password2')) : '';

        //set form data
        $this->form_validation->set_data(array(
            'login_role' => $this->input->post('login_role'),
            'login_id'   => $this->input->post('login_id'),
            'login_name' => $this->input->post('login_name'),
            'email'      => $this->input->post('email'),
            'password'   => $password,
            'password2'  => $password2,
        ));

        //validate data
        $this->form_validation->set_rules('login_role', __('Login Role'), 'trim|required', array(
            'required' => __('Please enter') . ' %s.',
        ));
        $this->form_validation->set_rules('login_id', __('Login ID'), 'trim|required', array(
            'required' => __('Please enter') . ' %s.',
        ));
        $this->form_validation->set_rules('login_name', __('Login Name'), 'trim|required', array(
            'required' => __('Please enter') . ' %s.',
        ));

        $this->form_validation->set_rules('password', __('Login Password'), 'trim|regex_match[/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/]', array(
            'required'    => __('Please enter') . ' %s.',
            'regex_match' => '%s ' . __('should contain at least 8 characters, at least 1 upper letter, at least 1 lower letter and at least 1 number.'),
        ));

        $this->form_validation->set_rules('password2', __('Confirm Password'), 'trim|matches[password]', array(
            'required' => __('Please enter') . ' %s.',
            //'regex_match' => '%s ' . __('should contain at least 8 characters, at least 1 upper letter, at least 1 lower letter and at least 1 number.'),
        ));

        if (!empty($this->input->post('login_role'))) {
            //check role level
            $role = Phprbac_roles_model::where('Title', $this->input->post('login_role'))->first();

            if (empty($id)) {
                //only allow to create lower level user
                if ($role['Level'] <= $_SESSION['role_level']) {
                    $_SESSION['error_msg'] = __('You do not have permission.');
                }
            } else {
                //cannot update upper level user and
                if ($role['Level'] < $_SESSION['role_level'] || ($role['Level'] == $_SESSION['role_level'] && $id != $_SESSION['sys_user_id'])) {
                    $_SESSION['error_msg'] = __('You do not have permission.');
                }
            }
        }

        if ($this->form_validation->run() == false || !empty($_SESSION['error_msg'])) {
            if (empty($id)) {
                $this->create();
            } else {
                $this->modify($id);
            }
        } else {

            //form data
            $data = array(
                'login_role' => $this->input->post('login_role'),
                'role_level' => $role['Level'],
                'login_id'   => $this->input->post('login_id'),
                'login_name' => $this->input->post('login_name'),
                'updated_by' => $_SESSION["sys_user_id"],
            );


            if ($password) {
                $data['login_pw'] = sha256_hash($password);
            }

            //insert into database
            if (empty($id)) {
                validate_user_access(['create_sys_user'], 0);

                $data['created_by'] = $_SESSION["sys_user_id"];
                //Sys_user_model::create($data);
                $sys_user = new Sys_user_model();
                $sys_user->fill($data)->save();

                $id = $sys_user->id;

                $_SESSION['success_msg'] = __('Create Successfully.');

                redirect(admin_url('bk_permission/new_user/' . $this->input->post('login_role') . '/' . $id));

            } else {
                validate_user_access(['update_sys_user'], 0);
                $old_sys_user = Sys_user_model::find($id);
                Sys_user_model::where('id', $id)->update($data);

                $_SESSION['success_msg'] = __('Update Successfully.');


                if ($old_sys_user->id && $old_sys_user->login_role <> $this->input->post('login_role')) {
                    redirect(admin_url('bk_permission/update_user/' . $old_sys_user->login_role
                        . '/' . $this->input->post('login_role') . '/' . $id));

                } else {

                    $this->index();

                }
            }

        }
    }
}
