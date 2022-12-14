<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Levels_model extends BaseModel
	{
		protected $table = "levels";

        public static function list($all = null)
		{   
            if ($all) {
                $list[0] = 'ζζε­Έι';
            }
            $result = Levels_model::orderBy('id', 'ASC')->get();
        
            
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