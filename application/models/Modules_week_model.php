<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Modules_week_model extends BaseModel
	{
		protected $table = "modules_week";


		public static function date($year_id,  $level_id, $module_order)
		{
            $source = Modules_week_model::where('year_id', $year_id)
			->where('level_id', $level_id)
			->first();

			$result = array(
				'date_from' => substr($source['module_from_'.(int)$module_order],0,10),
				'date_to' => substr($source['module_to_'.(int)$module_order],0,10),
			);

            return $result;
        }
	}