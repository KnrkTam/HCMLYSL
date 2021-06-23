<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons_model extends BaseModel
{
    protected $table = "lessons";

    public static function table_list($id)
    {   
        //export data as in table list format
        $lesson= Lessons_model::find($id);

        $table_list = array(
            'id' => $lesson['id'],
            'course' => Courses_model::name($lesson['course_id']),
            'category' => Categories_model::name($lesson['category_id']),
            'central_obj' => Central_obj_model::name($lesson['central_obj_id']),
            'sb_obj' => Sb_obj_model::name($lesson['sb_obj_id']),
            'element' => Elements_model::name($lesson['element_id']),
            'groups' => Lessons_group_model::list($id),
            'lpf_basic' => Lpf_basic_model::name($lesson['lpf_basic_id']),
            'lpf_advanced' => Lpf_advanced_model::name($lesson['lpf_advanced_id']),
            'poas' => Poas_model::name($lesson['poas_id']),
            'skills' => Lessons_skill_model::list($id),
            'rel_lessons' => Lessons_relevant_model::id_list($id),
            'preliminary_skill' => $lesson['preliminary_skills'],
            'expected_outcome' => $lesson['expected_outcome'],
            'code' => $lesson['code'],


        );
        return $table_list;
    }

    public static function list($course_id = null, $category_id = null, $sb_obj_id = array(), $id = array(), $subject_id = null)
    {
        if (!$subject_id) {
            if ($id) {
                $result = Lessons_model::whereIn('id', $id)->get();
            } else if ($sb_obj_id) {
                $result = Lessons_model::whereIn('sb_obj_id', $sb_obj_id)->get();
            } else if (!$course_id && !$category_id) {
                $result = Lessons_model::all();
            } else if ($course_id && !$category_id) {
                $result = Lessons_model::where('course_id', $course_id)->get();
            } else if ($category_id && !$course_id) {
                $result = Lessons_model::where('category_id', $category_id)->get();
            } else if ($course_id && $category_id) {
                $result = Lessons_model::where('course_id', $course_id)->where('category_id', $category_id)->get();
            }  
        } else if ($subject_id) {
            $subject_arr = Subject_lessons_model::id_list($subject_id);
            if ($id) {
                $result = Lessons_model::whereIn('id', $id)->whereIn('id', $subject_arr)->get();
            } else if ($sb_obj_id) {
                $result = Lessons_model::whereIn('sb_obj_id', $sb_obj_id)->whereIn('id', $subject_arr)->get();
            } else if (!$course_id && !$category_id) {
                $result = Lessons_model::whereIn('id', $subject_arr)->get();
            } else if ($course_id && !$category_id) {
                $result = Lessons_model::whereIn('id', $subject_arr)->where('course_id', $course_id)->get();
            } else if ($category_id && !$course_id) {
                $result = Lessons_model::whereIn('id', $subject_arr)->where('category_id', $category_id)->get();
            } else if ($course_id && $category_id) {
                $result = Lessons_model::whereIn('id', $subject_arr)->where('course_id', $course_id)->where('category_id', $category_id)->get();
            }  
        }

        
        

        foreach($result as $row){
            $list[$row['id']] = $row["code"];
        }
        
        return $list;
    }

    public static function rel_list($id){
        $result = Lessons_model::where('id', '!=', $id)->get();

        foreach($result as $row){
            $list[$row['id']] = $row["code"];
        }
        return $list;
        
    }
    
    public static function code($id){
        $result = Lessons_model::where('id', $id)->first()->code;
        return $result;
    }


};