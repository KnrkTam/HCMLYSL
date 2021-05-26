<?php
	class MY_Security extends CI_Security {

		public function __construct()
		{
			parent::__construct();
		}

		public function csrf_show_error()
		{
			if(session_id() == '' || !isset($_SESSION)) {
				// session isn't started
				session_start();
			}
			$_SESSION['error_msg'] = _('Form verification code is invalid. Please enter form content again.');
			header('Location: '.$_SERVER['HTTP_REFERER']);
			exit;
		}
	}