<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Subjects_model extends BaseModel
	{
		protected $table = "subjects";

        public static function list()
		{
            $result = Subjects_model::all();
            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            return $list;
        }

        public static function name($id){
            $result = Subjects_model::where('id', $id)->first()->name;

            return $result;
        }
	}