<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons_model extends BaseModel
{
    protected $table = "lessons";

    public static function form_list()
    {
        return array();
    }
};