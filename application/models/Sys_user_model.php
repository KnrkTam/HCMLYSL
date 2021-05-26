<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sys_user_model extends BaseModel
	{
		protected $table = "sys_user";

        public static function role_name($role)
        {
            $role_name = array(
                'Super Admin Account' => '超級管理員',
                'Admin Account' => '管理員',
                'User Account' => '用戶',
            );

            return $role_name[$role];
        }
	}