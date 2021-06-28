<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Levels_model extends BaseModel
	{
		protected $table = "levels";

        public static function list($id = null)
		{   
            if (!$id) {
                $result = Levels_model::all();
            } else {
                $result = Levels_model::where('id', '!=', 5)->get();
            }
            
            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            
            return $list;
        }

        public static function name($id){

            $result = Levels_model::find($id)->name;

            return $result;
        }
	}