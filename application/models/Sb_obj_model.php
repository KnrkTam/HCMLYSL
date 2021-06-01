<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sb_obj_model extends BaseModel
	{
		protected $table = "sb_obj";

        public static function list()
		{
            $result = Sb_obj_model::all();

            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            
            return $list;
        }

        public static function name($id){
            $result = Sb_obj_model::where('id', $id)->first()->name;

            return $result;
        }
	}