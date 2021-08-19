<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Subject_lessons_modules_model extends BaseModel
	{
		protected $table = "subject_lessons_modules";

        public static function moduleList($subject_lessons_id, $year_id)
		{
            $module_id_arr = Subject_lessons_modules_model::where('year_id', $year_id)->where('subject_lessons_id', $subject_lessons_id)->pluck('module_id')->toArray();
            
            if ($module_id_arr) {
                // dump($module_id_arr);
                foreach ($module_id_arr as $module_id) {
                    $list[$module_id] = Modules_model::name($module_id);
                }
            }
            
            return $list;
        }


        public static function search($year_id = null, $subject_id = null, $module_id = array(), $subject_cat_id = null, $remark_ids = array()) {
            if ($remark_ids) {
                if ($subject_cat_id) {
                    $ids_arr = Subject_lessons_model::where('subject_category_id', $subject_cat_id)->pluck('id')->unique()->toArray();
                    $lessons_arr = Lessons_remarks_model::whereIn('remark_id', $remark_ids)->pluck('subject_lesson_id')->unique()->toArray();
                    $subject_lessons_arr = array_intersect($ids_arr, $lessons_arr)->unique();
                } else {
                    $subject_lessons_arr = Lessons_remarks_model::whereIn('remark_id', $remark_ids)->pluck('subject_lesson_id')->unique();
                }
            } else {
                if ($subject_cat_id) {
                    $subject_lessons_arr = Subject_lessons_model::where('subject_category_id', $subject_cat_id)->pluck('id')->unique();
                } else {
                    $subject_lessons_arr = Subject_lessons_model::pluck('id')->unique();
                }
            }

            
            if ($subject_id == "0") {
                $subject_id = null;
            } else {
                $subject_arr = Subject_lessons_model::where('subject_id', $subject_id)->pluck('id')->toArray();
            }

        
            if (count($module_id) > 1) {
                foreach ($subject_lessons_arr as $subject_lesson_id) {
                    // $group_count = Subject_lessons_modules_model::where('subject_lessons_id', $subject_lesson_id)->first()->group_count;
                    
                    $lesson_id = Subject_lessons_model::find($subject_lesson_id)->lesson_id;
                    $group_count_model = Lessons_group_model::id_list($lesson_id); 
                    $group_count = count($group_count_model);
                    // dump($group_count); 
                    if ($group_count) {
                        $result[] = Subject_lessons_modules_model::where('year_id', $year_id)->when($subject_arr, function($query, $subject_arr) {
                            return $query->whereIn('subject_lessons_id', $subject_arr);
                        })
                        ->when($module_id, function($query, $module_id) {
                            return $query->whereIn('module_id', $module_id);
                        })
                        ->where('subject_lessons_id', $subject_lesson_id)
                        ->pluck('id')
                        ->toArray();
                    }
                }

                foreach ($result as $p => $row) {
                    if ($row) {
                        $list[] = $row[0];
                    }
                }
            } else {
                foreach ($subject_lessons_arr as $subject_lesson_id) {
                    $lesson_id = Subject_lessons_model::find($subject_lesson_id)->lesson_id;
                    $group_count_model = Lessons_group_model::id_list($lesson_id); 
                    $group_count = count($group_count_model);

                    // dump($group_count);
                    if ($group_count) {
                        $result[] = Subject_lessons_modules_model::where('year_id', $year_id)->when($subject_arr, function($query, $subject_arr) {
                            return $query->whereIn('subject_lessons_id', $subject_arr);
                        })
                        ->when($module_id, function($query, $module_id) {
                            return $query->where('module_id', $module_id);
                        })
                        ->where('subject_lessons_id', $subject_lesson_id)
                        ->pluck('id')
                        ->toArray();

                    }
                }
                foreach ($result as $p => $row) {
                    if ($row) {
                        $list[] = $row[0];

                    }
                }
            }

            // $list = call_user_func_array("array_merge", $result);

            return $list;
            // return $result;
            // return $subject_arr;

        }
 
        public function subject_lesson() 
        {
            return $this->belongsTo('Subject_lessons_model', 'subject_lessons_id');
        }
	}