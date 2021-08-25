<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Students_model extends BaseModel
	{
		protected $table = "students";

        public static function list()
		{
            $result = Students_model::where('status', 1)->get();
            foreach($result as $row){
                $list[$row['id']] =  $row["chinese_name"];
            }
            return $list;
        }

        public static function name($id){
            $result = Students_model::find($id)->chinese_name;

            return $result;
        }
	}