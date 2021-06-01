<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Elements_model extends BaseModel
	{
		protected $table = "elements";

        public static function list()
		{
            $result = Elements_model::all();
            foreach($result as $row){
                $list[$row['id']] = array('name' => $row["name"], 'nickname' => $row["nickname"]);
            }
            return $list;
        }

        public static function name($id){
            $result = Elements_model::where('id', $id)->first()->name;

            return $result;
        }
	}