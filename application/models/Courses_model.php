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
	}