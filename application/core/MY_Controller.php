<?php
class MY_Controller extends CI_Controller
{

    public function __construct() {
        parent::__construct();

        if(strpos($_SERVER['REQUEST_URI'], '/webadmin') !== FALSE){
            if($_SESSION['PROJECT_KEY'] != PROJECT_KEY){
                redirect(admin_url('bk_admin/logout'));
            }
        }
    }
}