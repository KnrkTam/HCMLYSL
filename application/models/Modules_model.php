<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Modules_model extends BaseModel
	{
		protected $table = "modules";


        public static function list($level_id = null)
		{   
            $result = Modules_model::orderBy('code', 'asc')->get();

            if ($level_id) {
                $result = Modules_model::orderBy('level_id', 'asc')->where('level_id', $level_id)->orWhere('level_id', 0)->get();
            } 

            
            foreach($result as $row){
                $list[$row['id']] = $row['code']. ' '. $row["name"];
            }
            
            return $list;
        }

        public static function module_row($level_id)
		{
            $result = Modules_model::orderBy('code', 'ASC')->where('level_id', $level_id)->get();

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
        public static function order_list($order = array()){
            $arr = array(
                1 => "單元一",
                2 => "單元二",
                3 => "單元三",
                4 => "單元四",
            );

            $result = $arr;
            if ($order) {
                $result = $arr[$order];

            };

            return $result;
        }
    }