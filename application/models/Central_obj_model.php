<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Central_obj_model extends BaseModel
	{
		protected $table = "central_obj";

        public static function list($all = null)
		{
            $result = Central_obj_model::all();
            if ($all) {
                $list[0] = '所有學習重點';
            }
            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            
            return $list;
        }

        public static function name($id){
            $result = Central_obj_model::where('id', $id)->first()->name;

            return $result;
        }
	}