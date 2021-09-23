<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Annual_modules_model extends BaseModel
	{
		protected $table = "annual_modules";

		public static function list($year_id = null) {
			$year_data= Annual_modules_model::when($year_id, function($query, $year_id){
				return $query->where('year_id', $year_id);
			})
			->groupBy('year_id','level_id','class_id')
			->get();

	
			foreach ($year_data as $row) {
				// foreach ($row as $module) {
					$modules = Annual_modules_model::where('year_id', $year_id)->where('level_id', $row['level_id'])->where('class_id',$row['class_id'])->get();
					$result[] = array(
						'year_id' => $year_id, 
						'level_id' => $row['level_id'], 
						'class_id'=> $row['class_id'], 
						'modules'=> array(
							1 => $modules->where('module_order',1)->first(), 
							2 => $modules->where('module_order',2)->first(), 
							3 => $modules->where('module_order',3)->first(), 
							4 => $modules->where('module_order',4)->first()
						)
					);

			}
			return $result;
		}

		public static function year_list($year_id, $all = null, $not_app = null) {
			if ($year_id) {
				$year_data = Annual_modules_model::where('year_id', $year_id)->pluck('module_id')->unique();
			} 

			if ($not_app) {
				$list[0] = '不適用';

			}
			if ($all) {
				$list[0] = '所有年度學習單元';

			}
			foreach($year_data as $i => $row){
                $list[$row] = Modules_model::name($row);
            }
			// dump($list);

            return $list;
			
		}

		public static function module($id){
            $result = Annual_modules_model::find($id);

            return $result;
        }
	}