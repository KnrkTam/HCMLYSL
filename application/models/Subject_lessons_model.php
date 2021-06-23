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

    public static function id_list($subject_id)
    {        
        $result = Subject_lessons_model::where('subject_id', $subject_id)->get();

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