<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Materials_model extends BaseModel
	{
		protected $table = "materials";

        public static function list()
		{
            $result = Materials_model::all();
            foreach($result as $row){
                $list[$row['id']] =  $row["name"];
            }
            return $list;
        }

        public static function name($id){
            $result = Materials_model::where('id', $id)->first()->name;

            return $result;
        }
	}