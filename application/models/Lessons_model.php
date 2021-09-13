<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons_model extends BaseModel
{
    protected $table = "lessons";

    public static function table_list($id)
    {   
        //export data as in table list format
        $lesson = Lessons_model::find($id);

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
            'rel_code' => $lesson['rel_code'],
            'preliminary_skill' => $lesson['preliminary_skills'],
            'expected_outcome' => $lesson['expected_outcome'],
            'code' => $lesson['code'],
            'lesson_remark' => Lessons_remarks_model::list($lesson['id']),

        );
        return $table_list;
    }

    public static function list($course_id = null, $category_id = null, $sb_obj_id = array(), $id = array(), $subject_id = null)
    {
        if ($subject_id) {
            $subject_arr = Subject_lessons_model::id_list($subject_id);
        }
        
        $result = Lessons_model::when($course_id, function($query, $course_id){
            return $query->where('course_id', $course_id);
        })
        ->when($category_id, function($query, $category_id) {
            return $query->where('category_id', $category_id);
        })
        ->when($subject_id, function($query, $subject_id) {
            return $query->whereIn('id', $subject_arr);
        })
        ->when($sb_obj_id, function($query, $sb_obj_id) {
            return $query->whereIn('sb_obj_id', $sb_obj_id);
        })
        ->when($id, function($query, $id) {
            return $query->whereIn('id', $id);
        })
        ->get();


        foreach($result as $i => $row){
            // $list[$row['id']] = $row["code"].'  (' .$row['expected_outcome'].')';  old version
            $list[$i] = array('id' => $row['id'], 'code' => $row["code"].'  (' .$row['expected_outcome'].')');  

        }
        
        return $list;
    }

    public static function subjectList($subject_category_id = null, $sb_obj_id = null, $id = array(), $subject_id)
    {
        $subject_arr = Subject_lessons_model::id_list($subject_id, $subject_category_id, $id);

        if ($sb_obj_id) {
            foreach ($subject_arr as $i => $sub) {
                $result[$i] = array('subject_lesson_id' => $sub['id'],'lesson' => Lessons_model::whereIn('sb_obj_id', $sb_obj_id)->where('id', $sub['lesson_id'])->get());
            }
        } else {
            foreach ($subject_arr as $i => $sub) {
                $result[$i] = array('subject_lesson_id' => $sub['id'], 'lesson' => Lessons_model::where('id', $sub['lesson_id'])->get());
            }
        }  
    

        foreach($result as  $i => $row){
            if (count($row['lesson'])) {
                $list[$i] = array('name' => $row['lesson'][0]["code"].'  (' .$row['lesson'][0]['expected_outcome'].')', 'id' => $row['lesson'][0]['id'], 'sub_lesson_id' => $row['subject_lesson_id']);
            }
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

    public static function newlist($subject_id = null)
    {
        $subject_arr = Subject_lessons_model::newlist($subject_id);
        $result = Lessons_model::whereIn('id', $subject_arr)->get();

        foreach($result as $row){
            $list[$row['id']] = $row["code"];
        }
        
        return $list;
    }

    public static function newlist2($subject_id = null)
    {
        $subject_arr = Subject_lessons_model::newlist($subject_id);
        $result = Lessons_model::whereIn('id', $subject_arr)->get();

        foreach($result as $row){
            $list[$row['id']] = $row["code"];
        }
        return $list;
    }

    public static function remark()
    {
        return $this->hasMany('Remarks_model', 'lessons_remarks', 'lesson_id', 'remarks_id' );
    }
};