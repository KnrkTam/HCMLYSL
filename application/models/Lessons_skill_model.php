<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons_skill_model extends BaseModel
{
    protected $table = "lessons_skill";

    public static function list($lesson_id)
    {        
        $result = Lessons_skill_model::where('lesson_id', $lesson_id)->get();

        foreach ($result as $i => $row){
            $skill_arr[$i] = Skills_model::name($row['skill_id']);
        }; 
        
        return implode(',', $skill_arr);
    }

    public static function id_list($lesson_id)
    {        
        $result = Lessons_skill_model::where('lesson_id', $lesson_id)->get();
            foreach ($result as $i => $row){
                $skill_arr[$i] = $row['skill_id'];
            }; 
        
        
        return $skill_arr;
    }
}