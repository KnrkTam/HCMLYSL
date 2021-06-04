<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons_group_model extends BaseModel
{
    protected $table = "lessons_group";

    public static function list($lesson_id)
    {        
        $result = Lessons_group_model::where('lesson_id', $lesson_id)->get();

        foreach ($result as $i => $row){
            $group_arr[$i] = Groups_model::name($row['group_id']);
        }; 
        
        return implode(',', $group_arr);
    }

    public static function id_list($lesson_id)
    {        
        $result = Lessons_group_model::where('lesson_id', $lesson_id)->get();

        foreach ($result as $i => $row){
            $group_arr[$row['group_id']] = Groups_model::name($row['group_id']);
        }; 
        
        return $group_arr;
    }
};