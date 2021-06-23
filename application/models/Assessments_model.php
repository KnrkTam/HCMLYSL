<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Assessments_model extends BaseModel
	{
		protected $table = "assessments";

        public static function list()
		{
            $result = Assessments_model::where('id', '!=', 0)->get();

            foreach($result as $row){
                $list[$row['id']] = $row["mode"];
            }
            
            return $list;
        }

        public static function mode($id){
            $result = Assessments_model::where('id', $id)->first()->mode;

            return $result;
        }
	}