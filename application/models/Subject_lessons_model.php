<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject_lessons_model extends BaseModel
{
    protected $table = "subject_lessons";

    public static function list($subject_id)
    {        
        $result = Subject_lessons_model::where('subject_id', $subject_id)->get();

        foreach ($result as $i => $row){
            $subject_lessons_arr[$i] = Lessons_model::code($row['lesson_id']);
        }; 
        
        return implode(',', $subject_lessons_arr);
    }

    public static function id_list($subject_id, $subject_category_id = null, $lessons_id = array())
    {        
        $result = Subject_lessons_model::where('subject_id', $subject_id)
        ->when($subject_category_id, function($query, $subject_category_id) {
            return $query->where('subject_category_id', $subject_category_id);
        })
        ->when($lessons_id, function($query, $lessons_id) {
            return $query->whereIn('lesson_id', $lessons_id);
        })
        ->get();
    
        foreach ($result as $i => $row){
            if ($row['subject_id'] == $subject_id) {
                $subject_lessons_arr[$i] = array('id' => $row['id'], 'lesson_id' => $row['lesson_id']);
            } else if ($row['lesson_id'] == $subject_id) {
                $subject_lessons_arr[$i] = array('id' => $row['id'], 'lesson_id' => $row['subject_id']);;
            }
        }; 
    
        return $subject_lessons_arr;
    }


    public static function newlist($subject_id)
    {        
        $existing_arr = Key_performances_model::distinct()->pluck('subject_lesson_id');
        $result = Subject_lessons_model::where('subject_id', $subject_id)->whereNotIn('id', $existing_arr)->get();

            foreach ($result as $i => $row){
                if ($row['subject_id'] == $subject_id) {
                    $subject_lessons_arr[$i] = $row['lesson_id'];
                } else if ($row['lesson_id'] == $subject_id) {
                    $subject_lessons_arr[$i] = $row['subject_id'];
                }
            }; 
        return $subject_lessons_arr;
    }

    public static function newlist2($subject_id)
    {        
        $existing_arr = Key_performances_model::distinct()->pluck('subject_lesson_id');
        $result = Subject_lessons_model::where('subject_id', $subject_id)->whereNotIn('id', $existing_arr)->get();

            foreach ($result as $i => $row){
                if ($row['subject_id'] == $subject_id) {
                    $subject_lessons_arr[$i] = $row['lesson_id'];
                } else if ($row['lesson_id'] == $subject_id) {
                    $subject_lessons_arr[$i] = $row['subject_id'];
                }
            }; 
        return $subject_lessons_arr;
    }



}