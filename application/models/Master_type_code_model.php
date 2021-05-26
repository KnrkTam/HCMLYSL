<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Master_type_code_model extends BaseModel
	{
		protected $table = "master_type_code";

		public function get_mater_type_code($type_code){
			return self::where('type_code', $type_code)->where('status', 1)->get();
		}

	}