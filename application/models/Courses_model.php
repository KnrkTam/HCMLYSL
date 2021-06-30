<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Courses_model extends BaseModel
	{
		protected $table = "courses";

        public static function list($all = null)
		{

            $result = Courses_model::orderby('id', 'ASC')->get();
            if ($all) {
                $list[0] = '所有課程';
            }
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