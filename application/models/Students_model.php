<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Students_model extends BaseModel
	{
		protected $table = "students";

        public static function list($class = null)
		{
            $result = Students_model::where('status', 1)->get();
            foreach($result as $row){
                if ($class) {
                    $list[$row['id']] =  $row["chinese_name"]. ' ('. $row["class"]. ')';

                } else {
                    $list[$row['id']] =  $row["chinese_name"];

                }
            }
            return $list;
        }

        public static function name($id){
            $result = Students_model::find($id)->chinese_name;

            return $result;
        }

        public static function classList($class_id) {
            $class_name = Classes_model::find($class_id)->name;
            $result = Students_model::where('class', $class_name)->get();

            return $result;
        }
	}