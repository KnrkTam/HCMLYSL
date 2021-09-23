<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Classes_model extends BaseModel
	{
		protected $table = "classes";

        public static function list($level_id = null)
		{   
            $result = Classes_model::orderBy('id', 'asc')->get();

            if ($level_id) {
                $result = Classes_model::orderBy('id', 'asc')->where('level_id', $level_id)->get();
            } 
            
            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            
            return $list;
        }

        public static function name($id){
            $result = Classes_model::find($id)->name;

            return $result;
        }

        public static function level($id){
            $result = Classes_model::find($id)->level_id;

            return $result;
        }


	}