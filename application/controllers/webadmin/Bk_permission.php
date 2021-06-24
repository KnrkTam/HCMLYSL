<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bk_permission extends CI_Controller
{

    protected $databaseConfig = [];

    private $role_list, $perm_list, $rbac;

    public function __construct()
    {
        parent::__construct();

        // Create a Role
        $this->role_list = array(
            array(
                'title' => 'super_admin',
                'desc' => 'Super Admin Account',
                'level' => 1,
                'lang' => __('Super Admin Account') // for po editor
            ),
            array(
                'title' => 'admin',
                'desc' => 'Admin Account',
                'level' => 2,
                'lang' => __('Admin Account') // for po editor
            ),
            array(
                'title' => 'user',
                'desc' => 'User Account',
                'level' => 3,
                'lang' => __('User Account') // for po editor
            ),
        );
        // Create a Permission
        $this->perm_list = array(
            // sys_user
            'create_sys_user' => array(
                'desc' => 'Can create sys_user',
                'role' => array('super_admin', 'admin')
            ),
            'update_sys_user' => array(
                'desc' => 'Can update sys_user',
                'role' => array('super_admin', 'admin')
            ),
            'delete_sys_user' => array(
                'desc' => 'Can delete sys_user',
                'role' => array('super_admin', 'admin')
            ),
            'view_sys_user' => array(
                'desc' => 'Can view sys_user',
                'role' => array('super_admin', 'admin')
            ),

            // master_modules
            'create_master_modules' => array(
                'desc' => 'Can create master_modules',
                'role' => array('super_admin', 'admin')
            ),
            'update_master_modules' => array(
                'desc' => 'Can update master_modules',
                'role' => array('super_admin', 'admin')
            ),
            'delete_master_modules' => array(
                'desc' => 'Can delete master_modules',
                'role' => array('super_admin', 'admin')
            ),
            'view_master_modules' => array(
                'desc' => 'Can view master_modules',
                'role' => array('super_admin', 'admin')
            ),

             // create list option
             'create_options' => array(
                'desc' => 'Can create options',
                'role' => array('super_admin', 'admin')
            ),
            'update_options' => array(
                'desc' => 'Can update options',
                'role' => array('super_admin', 'admin')
            ),
            'delete_options' => array(
                'desc' => 'Can delete options',
                'role' => array('super_admin', 'admin')
            ),
            'view_options' => array(
                'desc' => 'Can view options',
                'role' => array('super_admin', 'admin')
            ),

              // school base course outline
            'create_master_lesson_outline' => array(
                'desc' => 'Can create master_lesson_outline',
                'role' => array('super_admin', 'admin')
            ),
            'update_master_lesson_outline' => array(
                'desc' => 'Can update master_lesson_outline',
                'role' => array('super_admin', 'admin')
            ),
            'delete_master_lesson_outline' => array(
                'desc' => 'Can delete master_lesson_outline',
                'role' => array('super_admin', 'admin')
            ),
            'view_master_lesson_outline' => array(
                'desc' => 'Can view master_lesson_outline',
                'role' => array('super_admin', 'admin')
            ),

            // subject course outline
            'create_subject_outcome' => array(
                'desc' => 'Can create subject_outcome',
                'role' => array('super_admin', 'admin')
            ),
            'update_subject_outcome' => array(
                'desc' => 'Can update subject_outcome',
                'role' => array('super_admin', 'admin')
            ),
            'delete_subject_outcome' => array(
                'desc' => 'Can delete subject_outcome',
                'role' => array('super_admin', 'admin')
            ),
            'view_subject_outcome' => array(
                'desc' => 'Can view subject_outcome',
                'role' => array('super_admin', 'admin')
            ),

            // subject course outline
            'create_subject_outline' => array(
                'desc' => 'Can create subject_outline',
                'role' => array('super_admin', 'admin')
            ),
            'update_subject_outline' => array(
                'desc' => 'Can update subject_outline',
                'role' => array('super_admin', 'admin')
            ),
            'delete_subject_outline' => array(
                'desc' => 'Can delete subject_outline',
                'role' => array('super_admin', 'admin')
            ),
            'view_subject_outline' => array(
                'desc' => 'Can view subject_outline',
                'role' => array('super_admin', 'admin')
            ),

            //news_ajax
            'create_news_ajax' => array(
                'desc' => 'Can create news_ajax',
                'role' => array('super_admin', 'admin')
            ),
            'update_news_ajax' => array(
                'desc' => 'Can update news_ajax',
                'role' => array('super_admin', 'admin')
            ),
            'delete_news_ajax' => array(
                'desc' => 'Can delete news_ajax',
                'role' => array('super_admin', 'admin')
            ),
            'view_news_ajax' => array(
                'desc' => 'Can view news_ajax',
                'role' => array('super_admin', 'admin', 'user')
            ),
            //news2
            'create_news2' => array(
                'desc' => 'Can create news2',
                'role' => array('super_admin', 'admin')
            ),
            'update_news2' => array(
                'desc' => 'Can update news2',
                'role' => array('super_admin', 'admin')
            ),
            'delete_news2' => array(
                'desc' => 'Can delete news2',
                'role' => array('super_admin', 'admin')
            ),
            'view_news2' => array(
                'desc' => 'Can view news2',
                'role' => array('super_admin', 'admin', 'user')
            ),
            //news
            'create_news' => array(
                'desc' => 'Can create news',
                'role' => array('super_admin', 'admin')
            ),
            'update_news' => array(
                'desc' => 'Can update news',
                'role' => array('super_admin', 'admin')
            ),
            'delete_news' => array(
                'desc' => 'Can delete news',
                'role' => array('super_admin', 'admin')
            ),
            'view_news' => array(
                'desc' => 'Can view news',
                'role' => array('super_admin', 'admin', 'user')
            ),

             //site_info
            'update_site_info' => array(
                'desc' => 'Can update site info',
                'role' => array('super_admin', 'admin')
            ),


        );

        //init database and rbac
        $this->load->database();

        $this->rbac = new PhpRbac\Rbac('', array(
            'adapter' => 'pdo_mysql',
            'host' => $this->db->hostname,
            'dbname' => $this->db->database,
            'tablePrefix' => 'phprbac_',
            'user' => $this->db->username,
            'pass' => $this->db->password,
        ));
    }


    //for first initialization
    public function init()
    {
        //please check vendor\owasp\phprbac\PhpRbac\src\PhpRbac\Rbac.php, replace __construct as follow to solve the database connection issue

        /*public function __construct($unit_test = '', $databaseConfig = array())
        {
            if ((string)$unit_test === 'unit_test') {
                require_once dirname(dirname(__DIR__)) . '/tests/database/database.config';
            } elseif (!empty($databaseConfig)) {
                extract($databaseConfig);
            } else {
                require_once dirname(dirname(__DIR__)) . '/database/database.config';
            }

            require_once 'core/lib/Jf.php';

            $this->Permissions = Jf::$Rbac->Permissions;
            $this->Roles = Jf::$Rbac->Roles;
            $this->Users = Jf::$Rbac->Users;
        }*/

        if (!is_super_admin()) {
            redirect(admin_url('bk_admin/access_denied'));
        }

        //update database.config
        //file_put_contents(APPPATH.'vendor/owasp/phprbac/PhpRbac/database/database.config', '<?php $host="'.$this->db->hostname.'"; $user="'.$this->db->username.'"; $pass="'.$this->db->password.'"; $dbname="'.$this->db->database.'"; $adapter="pdo_mysql"; $tablePrefix = "phprbac_";');

        //clean all phprabc record
//        Phprbac_permissions_model::truncate();
//        Phprbac_roles_model::truncate();
//        Phprbac_userroles_model::truncate();
//        Phprbac_rolepermissions_model::truncate();

        try {
            // Reset the table back to its initial state
            $this->rbac->reset(TRUE);

            foreach ($this->role_list as $role) {
                // Create a Role
                $this->rbac->Roles->add($role['title'], $role['desc']);
                Phprbac_roles_model::where('Title', $role['title'])->update(['Level' => $role['level']]);

                // Create Role and Permission
                //default account
                $sys_users = Sys_user_model::where('login_role', $role['title'])->get();
                foreach ($sys_users as $sys_user) {
                    $this->rbac->Users->assign($role['title'], $sys_user->id);
                }
            }

            foreach ($this->perm_list as $perm => $dtl) {
                // Create a Permission
                $this->rbac->Permissions->add($perm, $dtl['desc']);
                // Assign Permission to Role
                foreach ($dtl['role'] as $dtl_role) {
                    $this->rbac->Roles->assign($dtl_role, $perm);
                }

                //uncomment to debug
                /*$sys_users = Sys_user_model::groupBy('login_role')->get();
                echo $perm;
                foreach ($sys_users as $sys_user) {
                    vdump($sys_user->login_role,$this->rbac->check($perm, $sys_user->id));
                }
                echo '<hr>';*/
            }
        } catch (Exception $exception) {
            exit($exception->getMessage());
            //through RbacUserNotProvidedException }
        }

        //echo 'Done';
        $_SESSION['success_msg'] = __('Done');
        redirect(admin_url('bk_sys_user'));
    }

    public function test()
    {
        echo "Current user: " . "<br>" .
            $_SESSION["login_name"] . "<br>" .
            $_SESSION["login_role"] . "<br>" .
            $_SESSION["role_level"] . "<br>" . "<hr>";


        foreach ($this->perm_list as $perm => $dtl) {
            echo "<p>validate_user_access($perm): " . (validate_user_access([$perm]) ? "<span style='color:green'>TRUE</span>" : "<span style='color:red'>FALSE</span>") . '</p>';
        }
    }

    public function new_user($role, $sys_user_id)
    {
        check_sys_user_login();

        if (!empty($role)) {
            //check role level
            $result = Phprbac_roles_model::where('Title', $role)->first();
            if ($result['Level'] < $_SESSION['role_level']) {
                $_SESSION['error_msg'] = __('You do not have permission.');
                redirect(admin_url());
            }
        }

        $role_id = $this->rbac->Roles->returnId($role);

        if (!empty($role_id)) {
            try {
                $this->rbac->Users->assign($role, $sys_user_id);
            } catch (Exception $exception) {
                exit($exception->getMessage());
                //through RbacUserNotProvidedException }
            }
        }

        redirect(admin_url('bk_sys_user'));
    }

    public function update_user($old_role, $role, $sys_user_id)
    {
        check_sys_user_login();

        if (!empty($role)) {
            //check role level
            $result = Phprbac_roles_model::where('Title', $role)->first();
            if ($result['Level'] < $_SESSION['role_level']) {
                $_SESSION['error_msg'] = __('You do not have permission.');
                redirect(admin_url('bk_sys_user'));
            }
        }
        $role_id = $this->rbac->Roles->returnId($role);

        if (!empty($role_id) && !empty($old_role)) {
            try {
                $this->rbac->Users->unassign($old_role, $sys_user_id);
                $this->rbac->Users->assign($role, $sys_user_id);
            } catch (Exception $exception) {
                exit($exception->getMessage());
                //through RbacUserNotProvidedException }
            }
        }

        redirect(admin_url('bk_sys_user'));
    }

    public function delete_user($role, $sys_user_id)
    {
        check_sys_user_login();

        if (!empty($role)) {
            //check role level
            $result = Phprbac_roles_model::where('Title', $role)->first();
            if ($result['Level'] < $_SESSION['role_level']) {
                $_SESSION['error_msg'] = __('You do not have permission.');
                redirect(admin_url('bk_sys_user'));
            }
        }

        $role_id = $this->rbac->Roles->returnId($role);

        if (!empty($role_id)) {
            try {
                $this->rbac->Users->unassign($role, $sys_user_id);
            } catch (Exception $exception) {
                exit($exception->getMessage());
                //through RbacUserNotProvidedException }
            }
        }

        redirect(admin_url('bk_sys_user'));

    }
}
