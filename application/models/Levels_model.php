<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Levels_model extends BaseModel
	{
		protected $table = "levels";

        public static function list()
		{

            $result = Levels_model::all();

            foreach($result as $row){
                $list[$row['id']] = $row["level"];
            }
            
            return $list;
        }
	}