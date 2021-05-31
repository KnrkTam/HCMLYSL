<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Central_obj_model extends BaseModel
	{
		protected $table = "central_obj";

        public static function list()
		{
            $result = Central_obj_model::all();

            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            
            return $list;
        }
	}