<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Annual_subject_groups_students_model extends BaseModel
	{
		protected $table = "annual_subject_groups_students";

		public static function id_list($asg_id)
		{
            $result = Annual_subject_groups_students_model::where('annual_subject_group_id', $asg_id)->pluck('student_id')->toArray();
            return $result;
        }

	}