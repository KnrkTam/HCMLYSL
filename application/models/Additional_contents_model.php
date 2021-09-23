<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Additional_contents_model extends BaseModel
	{
		protected $table = "additional_contents";

		public static function content($group_id, $module_id, $subject_lessons_module_id) {
			
			$add = Additional_contents_model::where('group_id', $group_id)->where('module_id', $module_id)->where('subject_lessons_module_id', $subject_lessons_module_id)->first();
			$result = $add->content;
            return $result;
		}

		public static function id($group_id, $module_id, $subject_lessons_module_id) {
			$add = Additional_contents_model::where('group_id', $group_id)->where('module_id', $module_id)->where('subject_lessons_module_id', $subject_lessons_module_id)->first();
			$result = $add->id;
            return $result;
		}

		// public static function year_list($year_id, $all = null) {
		// 	if ($year_id) {
		// 		$year_data = Annual_modules_model::where('year_id', $year_id)->pluck('module_id')->unique();
		// 	} 

		// 	if ($all) {
		// 		$list[0] = '所有年度學習單元';

		// 	}
		// 	foreach($year_data as $i => $row){
        //         $list[$row] = Modules_model::name($row);
        //     }
		// 	// dump($list);

        //     return $list;
			
		// }
	}