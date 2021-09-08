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

            // 各學階單元設定
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

             // 增加選項
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

              // 校本課程大綱
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

            // 科目預期學習成果
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

            // 科目課程大綱
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

            // 設定各級年度學習單元
            'create_annual_modules' => array(
            'desc' => 'Can create annual_modules',
            'role' => array('super_admin', 'admin')
            ),
            'update_annual_modules' => array(
                'desc' => 'Can update annual_modules',
                'role' => array('super_admin', 'admin')
            ),
            'delete_annual_modules' => array(
                'desc' => 'Can delete annual_modules',
                'role' => array('super_admin', 'admin')
            ),
            'view_annual_modules' => array(
                'desc' => 'Can view annual_modules',
                'role' => array('super_admin', 'admin')
            ),

            // 全校學習單元週次
            'create_modules_week' => array(
            'desc' => 'Can create modules_week',
            'role' => array('super_admin', 'admin')
            ),
            'update_modules_week' => array(
                'desc' => 'Can update modules_week',
                'role' => array('super_admin', 'admin')
            ),
            'delete_modules_week' => array(
                'desc' => 'Can delete modules_week',
                'role' => array('super_admin', 'admin')
            ),
            'view_modules_week' => array(
                'desc' => 'Can view modules_week',
                'role' => array('super_admin', 'admin')
            ),
            // 校本課程大綱樹狀圖
            'create_courses_map' => array(
                'desc' => 'Can create courses_map',
                'role' => array('super_admin', 'admin')
            ),
            'update_courses_map' => array(
                'desc' => 'Can update courses_map',
                'role' => array('super_admin', 'admin')
            ),
            'delete_courses_map' => array(
                'desc' => 'Can delete courses_map',
                'role' => array('super_admin', 'admin')
            ),
            'view_courses_map' => array(
                'desc' => 'Can view courses_map',
                'role' => array('super_admin', 'admin')
            ),
            
            // 校本課程大綱樹狀圖
            'create_subjects_map' => array(
                'desc' => 'Can create subjects_map',
                'role' => array('super_admin', 'admin')
            ),
            'update_subjects_map' => array(
                'desc' => 'Can update subjects_map',
                'role' => array('super_admin', 'admin')
            ),
            'delete_subjects_map' => array(
                'desc' => 'Can delete subjects_map',
                'role' => array('super_admin', 'admin')
            ),
            'view_subjects_map' => array(
                'desc' => 'Can view subjects_map',
                'role' => array('super_admin', 'admin')
            ),

            // 設定年度教職員
            'create_annual_staff_list' => array(
            'desc' => 'Can create annual_staff_list',
            'role' => array('super_admin', 'admin')
            ),
            'update_annual_staff_list' => array(
                'desc' => 'Can update annual_staff_list',
                'role' => array('super_admin', 'admin')
            ),
            'delete_annual_staff_list' => array(
                'desc' => 'Can delete annual_staff_list',
                'role' => array('super_admin', 'admin')
            ),
            'view_annual_staff_list' => array(
                'desc' => 'Can view annual_staff_list',
                'role' => array('super_admin', 'admin')
            ),

            // 設定年度科長
            'create_annual_subject_monitor' => array(
            'desc' => 'Can create annual_subject_monitor',
            'role' => array('super_admin', 'admin')
            ),
            'update_annual_subject_monitor' => array(
                'desc' => 'Can update annual_subject_monitor',
                'role' => array('super_admin', 'admin')
            ),
            'delete_annual_subject_monitor' => array(
                'desc' => 'Can delete annual_subject_monitor',
                'role' => array('super_admin', 'admin')
            ),
            'view_annual_subject_monitor' => array(
                'desc' => 'Can view annual_subject_monitor',
                'role' => array('super_admin', 'admin')
            ),           
            // 設定年度科長
            'create_annual_sen_support' => array(
            'desc' => 'Can create annual_sen_support',
            'role' => array('super_admin', 'admin')
            ),
            'update_annual_sen_support' => array(
                'desc' => 'Can update annual_sen_support',
                'role' => array('super_admin', 'admin')
            ),
            'delete_annual_sen_support' => array(
                'desc' => 'Can delete annual_sen_support',
                'role' => array('super_admin', 'admin')
            ),
            'view_annual_sen_support' => array(
                'desc' => 'Can view annual_sen_support',
                'role' => array('super_admin', 'admin')
            ),

            // 設定單元既定教學大綱
            'create_intended_learning_outline' => array(
            'desc' => 'Can create intended_learning_outline',
            'role' => array('super_admin', 'admin')
            ),
            'update_intended_learning_outline' => array(
                'desc' => 'Can update intended_learning_outline',
                'role' => array('super_admin', 'admin')
            ),
            'delete_intended_learning_outline' => array(
                'desc' => 'Can delete intended_learning_outline',
                'role' => array('super_admin', 'admin')
            ),
            'view_intended_learning_outline' => array(
                'desc' => 'Can view intended_learning_outline',
                'role' => array('super_admin', 'admin')
            ),


            // 補充內容 
            'create_additional_content' => array(
            'desc' => 'Can create additional_content',
            'role' => array('super_admin', 'admin')
            ),
            'update_additional_content' => array(
                'desc' => 'Can update additional_content',
                'role' => array('super_admin', 'admin')
            ),
            'delete_additional_content' => array(
                'desc' => 'Can delete additional_content',
                'role' => array('super_admin', 'admin')
            ),
            'view_additional_content' => array(
                'desc' => 'Can view additional_content',
                'role' => array('super_admin', 'admin')
            ),

            

            // 年度科目分組
            'create_annual_subject_group' => array(
                'desc' => 'Can create annual_subject_group',
                'role' => array('super_admin', 'admin')
            ),
                'update_annual_subject_group' => array(
                    'desc' => 'Can update annual_subject_group',
                    'role' => array('super_admin', 'admin')
            ),
                'delete_annual_subject_group' => array(
                    'desc' => 'Can delete annual_subject_group',
                    'role' => array('super_admin', 'admin')
            ),
                'view_annual_subject_group' => array(
                    'desc' => 'Can view annual_subject_group',
                    'role' => array('super_admin', 'admin')
            ),

            // 年度服務分組 
            'create_annual_service_group' => array(
                'desc' => 'Can create annual_service_group',
                'role' => array('super_admin', 'admin')
            ),
            'update_annual_service_group' => array(
                'desc' => 'Can update annual_service_group',
                'role' => array('super_admin', 'admin')
            ),
            'delete_annual_service_group' => array(
                'desc' => 'Can delete annual_service_group',
                'role' => array('super_admin', 'admin')
            ),
            'view_annual_service_group' => array(
                'desc' => 'Can view annual_service_group',
                'role' => array('super_admin', 'admin')
            ),

            // 年度教學大綱 
            'create_annual_teaching_outline' => array(
                'desc' => 'Can create annual_teaching_outline',
                'role' => array('super_admin', 'admin')
            ),
            'update_annual_teaching_outline' => array(
                'desc' => 'Can update annual_teaching_outline',
                'role' => array('super_admin', 'admin')
            ),
            'delete_annual_teaching_outline' => array(
                'desc' => 'Can delete annual_teaching_outline',
                'role' => array('super_admin', 'admin')
            ),
            'view_annual_teaching_outline' => array(
                'desc' => 'Can view annual_teaching_outline',
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
