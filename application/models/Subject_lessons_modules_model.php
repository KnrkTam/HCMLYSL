<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Subject_lessons_modules_model extends BaseModel
	{
		protected $table = "subject_lessons_modules";

        public static function moduleList($subject_lessons_id, $year_id)
		{
            $module_id_arr = Subject_lessons_modules_model::where('year_id', $year_id)->where('subject_lessons_id', $subject_lessons_id)->pluck('module_id');
            
            
            if ($module_id_arr) {
                // dump($module_id_arr);
                foreach ($module_id_arr as $module_id) {
                    $list[$module_id] = Modules_model::name($module_id);
                }
            }
            
            return $list;
        }


        public static function search($year_id = null, $subject_id = null, $module_id = null, $subject_cat_id = null, $remark_ids = array()) {
            // dump($remark_ids);
            if ($remark_ids) {
                if ($subject_cat_id) {
                    $ids_arr = Subject_lessons_model::where('subject_category_id', $subject_cat_id)->pluck('id')->unique()->toArray();
                    $lessons_arr = Lessons_remarks_model::whereIn('remark_id', $remark_ids)->pluck('subject_lesson_id')->unique()->toArray();
                    $subject_lessons_arr = array_intersect($ids_arr, $lessons_arr);

                } else {
                    $subject_lessons_arr = Lessons_remarks_model::whereIn('remark_id', $remark_ids)->pluck('subject_lesson_id')->unique();
                }
            } else {
                if ($subject_cat_id) {
                    $subject_lessons_arr = Subject_lessons_model::where('subject_category_id', $subject_cat_id)->pluck('id');
                } else {
                    $subject_lessons_arr = Subject_lessons_model::pluck('id');
                }
            }
            
            if ($subject_id == "0") {
                $subject_id = null;
            }


            $result = Subject_lessons_modules_model::where('year_id', $year_id)->when($subject_id, function($query, $subject_id) {
                return $query->where('subject_id', $subject_id);
            })
            ->when($module_id, function($query, $module_id) {
                return $query->where('module_id', $module_id);
            })
            ->whereIn('subject_lessons_id', $subject_lessons_arr)
            ->pluck('id')
            ->toArray();

            return $result;

        }
    
	}