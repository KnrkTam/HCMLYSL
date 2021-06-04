<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons_model extends BaseModel
{
    protected $table = "lessons";

    public static function table_list($id)
    {
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
            'preliminary_skill' => $lesson['preliminary_skills'],
            'expected_outcome' => $lesson['expected_outcome'],
            'code' => $lesson['code'],


        );
        return $table_list;
    }

    public static function list()
    {

        $result = Lessons_model::all();

        foreach($result as $row){
            $list[$row['id']] = $row["code"];
        }
        
        return $list;
    }

};