<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Staff_model extends BaseModel
	{
		protected $table = "staff";

        public static function list()
		{
            $result = Staff_model::where('status', 1)->get();
            foreach($result as $row){
                $list[$row['id']] =  $row["name"];
            }
            return $list;
        }

        public static function name($id){
            $result = Staff_model::find($id)->name;

            return $result;
        }
	}