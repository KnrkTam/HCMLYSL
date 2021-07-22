<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons_remarks_model extends BaseModel
{
    protected $table = "lessons_remarks";

    public static function list($lesson_id)
    {        
        $result = Lessons_remarks_model::where('lesson_id', $lesson_id)->get();

        foreach ($result as $i => $row){
            $group_arr[$i] = Remarks_model::name($row['remark_id']);
        }; 
        
        return implode(',', $group_arr);
    }

    public static function id_list($subject_lesson_id)
    {        
        $result = Lessons_remarks_model::where('subject_lesson_id', $subject_lesson_id)->get();

        foreach ($result as $i => $row){
            $group_arr[$i] = $row['remark_id'];
        }; 
        
        return $group_arr;
    }
};