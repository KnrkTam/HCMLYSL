<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Groups_model extends BaseModel
	{
		protected $table = "groups";

        public static function list()
		{
            $result = Groups_model::all();
            foreach($result as $row){
                $list[$row['id']] = array('name' => $row["name"], 'nickname' => $row["nickname"]);
            }
            return $list;
        }

        public static function name($id){
            $result = Groups_model::where('id', $id)->first()->name;

            return $result;
        }
	}