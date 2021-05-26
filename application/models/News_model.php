<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class News_model extends BaseModel
	{
		protected $table = "news";

		//protected $hidden = ['createdate', 'createby', 'lastupdate', 'lastupby', 'deletedate', 'deleteby'];

        public function photos()
        {
            return $this->hasMany('News_photo_model','news_id');
        }
	}