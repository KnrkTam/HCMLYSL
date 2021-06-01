<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Lpf_basic_model extends BaseModel
	{
		protected $table = "lpf_basic";

        public static function list()
		{
            $result = Lpf_basic_model::all();
            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            return $list;
        }

        public static function name($id){
            $result = Lpf_basic_model::where('id', $id)->first()->name;

            return $result;
        }
	}