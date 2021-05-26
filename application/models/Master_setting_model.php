<?php

use Illuminate\Database\Capsule\Manager as DB;
use Carbon\Carbon as Carbon;

class Master_setting_model extends BaseModel{
    protected $table = "master_setting";

    protected static $alldata = array();
    protected static $init = false;

    protected static function init(){
        self::all()->each(function($m){
            Master_setting_model::$alldata[$m->attribute] = $m->val;
        });
        self::$init = true;
    }

    public static function get($attribute=null){
        if(!self::$init){
            self::init();
        }

        if($attribute){
            return self::$alldata[$attribute];
        }else{
            return self::$alldata;
        }
    }

    public static function get_code($code){
        return self::where('code', $code)->first();
    }
}
