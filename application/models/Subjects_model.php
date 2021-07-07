<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Subjects_model extends BaseModel
	{
		protected $table = "subjects";

        public static function list($all = null)
		{
            if ($all) {
                $list[0] = '所有科目';
            }
            $result = Subjects_model::all();
            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            return $list;
        }

        public static function newList()
		{   
            $existing_subject = Subject_lessons_model::distinct()->pluck('subject_id'); // Extract ids that has created subject
            $result = Subjects_model::whereNotIn('id', $existing_subject)->get();
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