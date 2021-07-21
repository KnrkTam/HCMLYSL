<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Key_performances_model extends BaseModel
	{
		protected $table = "key_performances";


		public static function subject_cat_lesson($lesson_id, $sub_cat_id)
		{   
			$subject_lesson_id_arr = Subject_lessons_model::where('subject_category_id', $sub_cat_id)->where('lesson_id', $lesson_id)->pluck('id');

			foreach ($subject_lesson_id_arr as $subject_lesson_id) {
				$list[$subject_lesson_id] = Key_performances_model::where('subject_lesson_id',$subject_lesson_id)->get();
			}

			return $list;
        }

	}