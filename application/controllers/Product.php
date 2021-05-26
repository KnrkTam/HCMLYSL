<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index($id, $friendly_url)
    {
        If(empty($id)){
            //use $name to find table: page_seo, where table = “product”, friendly_url = “product_one” => find table_id (product id)
            var_dump($friendly_url);
        }else{
            //direct use $id to find product id
            echo 1;
        }

    }

}
