<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Annual_service_groups_students_model extends BaseModel
	{
		protected $table = "annual_service_groups_students";

		public static function id_list($asg_id)
		{
            $result = Annual_service_groups_students_model::where('annual_service_group_id', $asg_id)->pluck('student_id')->toArray();
            return $result;
        }

	}