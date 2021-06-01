<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Poas_model extends BaseModel
	{
		protected $table = "poas";

        public static function list()
		{
            $result = Poas_model::all();
            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            return $list;
        }

        public static function name($id){
            $result = Poas_model::where('id', $id)->first()->name;

            return $result;
        }
	}