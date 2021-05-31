<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Categories_model extends BaseModel
	{
		protected $table = "categories";

        public static function list()
		{
            $result = Categories_model::all();

            foreach($result as $row){
                $list[$row['id']] = $row["name"];
            }
            
            return $list;
        }
	}