<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Modules_model extends BaseModel
	{
		protected $table = "modules";


        public static function list($level_id = null)
		{   
            $result = Modules_model::orderBy('code', 'asc')->get();

            if ($level_id) {
                $result = Modules_model::orderBy('id', 'asc')->where('level_id', $level_id)->get();
            } 

            
            foreach($result as $row){
                $list[$row['id']] = $row['code']. ' '. $row["name"];
            }
            
            return $list;
        }

        public static function module_row($level_id)
		{
            $result = Modules_model::where('level_id', $level_id)->get();

            foreach($result as $key => $row){
                $module_row[$key] = $row;
            }
            
            return $module_row;
        }

        public static function name($id, $code = null){
            $result = Modules_model::where('id', $id)->first()->name;

            if ($code = 'code') {
                $result =  Modules_model::where('id', $id)->first()->code. ' '.  Modules_model::where('id', $id)->first()->name;
            }

            return $result;
        }
	}