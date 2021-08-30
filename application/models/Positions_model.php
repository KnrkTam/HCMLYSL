<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Positions_model extends BaseModel
	{
		protected $table = "positions";

        public static function list()
		{
            $result = Positions_model::orderBy('id', 'ASC')->get();
            foreach($result as $row){
                $list[$row['id']] =  $row["name"];
            }
            return $list;
        }

        public static function name($id){
            $result = Positions_model::find($id)->name;

            return $result;
        }

        public static function idByName($name){
            $result = Positions_model::where('name', $name)->first()->id;

            return $result;
        }

    }