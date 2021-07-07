<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Services_model extends BaseModel
	{
		protected $table = "services";

        public static function list()
		{
            $result = Services_model::all();
            foreach($result as $row){
                $list[$row['id']] =  $row["name"];
            }
            return $list;
        }

        public static function name($id){
            $result = Services_model::where('id', $id)->first()->name;

            return $result;
        }
	}