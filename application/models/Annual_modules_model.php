<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Annual_modules_model extends BaseModel
	{
		protected $table = "annual_modules";

		public static function list($year_id = null) {
			
			if ($year_id) {
				$year_data = Annual_modules_model::where('year_id', $year_id)->get()->groupBy('level_id', 'class_id', 'year_id');
			} else {
				$year_data = Annual_modules_model::all()->groupBy('level_id', 'class_id', 'year_id');
			}

			$y = 0;
			foreach ($year_data as $i => $group) {
				$list[] = array_values(array_values((array)$group)[0]);
				
				foreach ($list as $j => $module) {
					$result[$y] = array('year_id' => $year_id, 'level_id' => $module[0]['level_id'], 'class_id'=> $module[0]['class_id'], 'modules' => array(1 => $module[0], 2 => $module[1], 3 => $module[2], 4 => $module[3]));
				}
				$y++;
	
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