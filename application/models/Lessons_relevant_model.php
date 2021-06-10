<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons_relevant_model extends BaseModel
{
    protected $table = "lessons_relevant";

    public static function list($lesson_id)
    {        
        $result = Lessons_relevant_model::where('lesson_id', $lesson_id)->get();

        foreach ($result as $i => $row){
            $lesson_arr[$i] = Lessons_model::code($row['rel_lesson_id']);
        }; 
        
        return implode(',', $lesson_arr);
    }

    public static function id_list($lesson_id)
    {        
        $result = Lessons_relevant_model::where('lesson_id', $lesson_id)->orWhere('rel_lesson_id', $lesson_id)->get();
            foreach ($result as $i => $row){
                $lesson_arr[$i] = $row['rel_lesson_id'];
            }; 
        
        
        return $lesson_arr;
    }
}