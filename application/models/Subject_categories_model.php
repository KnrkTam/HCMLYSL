<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Subject_categories_model extends BaseModel
	{
		protected $table = "subject_categories";

        public static function list($subject_id = null, $all = null, $subject_outline = null)
		{

            if ($all) {
                $result = Subject_categories_model::orderBy('id', 'DESC')->get();

                $list[0] = '所有科目範疇';
            }
            if ($subject_id) {
                $result = Subject_categories_model::orderBy('id', 'DESC')->where('subject_id', $subject_id)->get();
            
                if ($subject_outline) {
                    $existing_arr = (Key_performances_model::orderBy('subject_lesson_id', 'ASC')->pluck('subject_lesson_id')->unique());
                    $new_arr = Subject_lessons_model::whereNotIn('id', $existing_arr)->pluck('subject_category_id');
                    $result = Subject_categories_model::orderBy('id', 'DESC')->where('subject_id', $subject_id)->whereIn('id', $new_arr)->get();

                }
            } 

            

            foreach($result as $row){
                $list[$row['id']] = $row["name"];
                // $list[$row['id']] = $row["name"];

            }
            
            return $list;
        }

        public static function name($id){
            $result = Subject_categories_model::where('id', $id)->first()->name;

            return $result;
        }



        public static function optionList($all = null)
        {
            $result = Subject_categories_model::orderBy('subject_id', 'DESC')->get();
            $subjects = Subjects_model::with('cat')->get();

            if ($all) {
                $list[0] = array('text'=> '所有科目範疇', 'children' => array(['id' => 0, 'text' => '所有科目範疇']));
            }
            $num = 1;
            foreach ($subjects as $j => $subject) {
                foreach($subject->cat as $i => $row){
                    // $children_list[$subject->id][0] = array('text' => 'something');
                    $children_list[$subject->id][$i] = array('id' => $row['id'], 'text' => $row['name']);
            
                    $list[$num] = array('text' => $subject->name, 'children' => $children_list[$subject->id]); 
            }
            if (count($subject->cat)) {
                // dump($subject->cat);
                $num ++;
            }
        }

            return $list;
        }

        
        public function cat() 
        {
            return $this->hasMany('Subject_categories_model', 'subject_id');
        }

            
        public function lesson() 
        {
            return $this->belongsToMany('Lessons_model', 'subject_lessons', 'subject_category_id', 'lesson_id' )->withPivot('id');;
        }



	}