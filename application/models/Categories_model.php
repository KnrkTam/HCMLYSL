<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Categories_model extends BaseModel
	{
		protected $table = "categories";

        public static function list($course_id = null, $all = null)
		{

            if ($all) {
                $result = Categories_model::orderBy('id', 'DESC')->get();

                $list[0] = '所有範疇';
            }
            if ($course_id) {
                $result = Categories_model::orderBy('id', 'DESC')->where('course_id', $course_id)->get();
            } else {

            }

            foreach($result as $row){
                $list[$row['id']] =Courses_model::name($row['course_id']). ' - '. $row["name"];
            }
            
            return $list;
        }

        public static function name($id){
            $result = Categories_model::where('id', $id)->first()->name;

            return $result;
        }
        public static function optionList()
        {
            $result = Categories_model::orderBy('course_id', 'DESC')->get();
            $courses = Courses_model::with('cat')->get();

            foreach ($courses as $j => $course) {
                foreach($course->cat as $i => $row){

                    $children_list[$course->id][$i] = array('id' => $row['id'], 'text' => $row['name']);
            
                    $list[$j] = array('text' => $course->name, 'children' => $children_list[$course->id]);
                }
            }



            return $list;
        }


	}