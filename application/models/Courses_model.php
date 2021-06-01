<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Courses_model extends BaseModel
	{
		protected $table = "courses";

        public static function list()
		{
            $result = Courses_model::all();
            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            return $list;
        }

        public static function name($id){
            $result = Courses_model::where('id', $id)->first()->name;

            return $result;
        }
	}