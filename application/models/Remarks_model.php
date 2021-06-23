<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Remarks_model extends BaseModel
	{
		protected $table = "remarks";

        public static function list()
		{
            $result = Remarks_model::all();

            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            
            return $list;
        }

        public static function name($id){
            $result = Remarks_model::where('id', $id)->first()->name;

            return $result;
        }


	}