<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Levels_model extends BaseModel
	{
		protected $table = "levels";

        public static function drop_list()
		{

            $level_result = Levels_model::all();

            foreach($level_result as $row){
                $drop_list[$row['id']] = $row["level"];
            }
            
            return $drop_list;
        }
	}