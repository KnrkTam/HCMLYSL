<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	use Illuminate\Database\Capsule\Manager as DB;

	class News extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->load->model('News_model');
		}

		public function index()
		{
			echo 'new index';
		}

		public function detail($id = null)
		{
			echo 'new detail';
		}

		public function news_list()
		{
			echo 'new list';
		}

	}
