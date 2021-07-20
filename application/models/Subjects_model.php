<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Subjects_model extends BaseModel
	{
		protected $table = "subjects";

        public static function list($all = null, $subject_outcome = null)
		{
            if ($all) {
                $list[0] = '所有科目';
            }
            $result = Subjects_model::all();




            if ($subject_outcome) {
                $existing_arr = Subject_lessons_model::pluck('subject_category_id')->unique();
                $new_arr = Subject_categories_model::whereNotIn('id', $existing_arr)->pluck('subject_id')->unique();
                $result = Subjects_model::whereIn('id', $new_arr)->get();
            }





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


        public function cat() 
        {
            return $this->hasMany('Subject_categories_model', 'subject_id');
        }
	}