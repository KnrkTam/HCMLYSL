<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Years_model extends BaseModel
	{
		protected $table = "years";

        public static function list()
		{
            $result = Years_model::orderBy('year_from', 'DESC')->get();

            foreach($result as $row){
                $list[$row['id']] = $row["year_from"].'/'.$row['year_to'];
            }
            
            return $list;
        }

        public static function annual($id){
            $annual = Years_model::find($id);

            $result = $annual['year_from'].'/'.$annual['year_to'];

            return $result;
        }
	}