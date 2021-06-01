<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Skills_model extends BaseModel
	{
		protected $table = "skills";

        public static function list()
		{
            $result = Skills_model::all();
            foreach($result as $row){
                $list[$row['id']] =  $row["name"];
            }
            return $list;
        }

        public static function name($id){
            $result = Skills_model::where('id', $id)->first()->name;

            return $result;
        }
	}