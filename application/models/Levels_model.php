<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Levels_model extends BaseModel
	{
		protected $table = "levels";

        public static function list($id = null)
		{
            $result = Levels_model::all();
            
            foreach($result as $row){
                $list[$row['id']] = $row["level"];
            }
            
            return $list;
        }

        public static function name($id){
            $result = Levels_model::where('id', $id)->first()->name;

            return $result;
        }
	}