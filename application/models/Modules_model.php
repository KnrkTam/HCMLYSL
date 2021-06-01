<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Modules_model extends BaseModel
	{
		protected $table = "modules";

        public static function module_row($level_id)
		{
            $result = Modules_model::where('level_id', $level_id)->get();

            foreach($result as $key => $row){
                $module_row[$key] = $row;
            }
            
            return $module_row;
        }

        public static function name($id){
            $result = Modules_model::where('id', $id)->first()->name;

            return $result;
        }
	}