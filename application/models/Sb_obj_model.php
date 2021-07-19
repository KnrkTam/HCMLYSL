<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sb_obj_model extends BaseModel
	{
		protected $table = "sb_obj";

        public static function list($all = null)
		{
            $result = Sb_obj_model::all();
            if ($all) {
                $list[0] = '所有學習重點';
            }
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