<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class QueryLogger
{
    private $ci;
    private $types;

    public function __construct()
    {
        $this->ci    =& get_instance();
        $this->types = $this->ci->config->item('query_types');
    }

    public function laravel_query_log()
    {
        laravel_query_log();
    }

    public function save()
    {
        if ($this->can_saved()) {
            $key = random_string('md5');
            foreach ($this->ci->db->queries as $query) {
                $query = str_replace("\n", ' ', $query);
                $type  = $this->get_type($query);

                if ($type !== '') {
                    $this->ci->db->insert('query_logs', [
                        'key'       => $key,
                        'type'       => $type,
                        'query'      => $query,
                        'path'       => $this->ci->router->fetch_class() . '/' . $this->ci->router->fetch_method(),
                        //'admin_id' => $this->ci->session->admin_id,
                        'member_id'  => $_SESSION['member_id'],
                        'session_id' => session_id(),
                        'order_id'   => $_SESSION['order_id'],
                        'createdate' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }

    public function can_saved()
    {
        //if (count($this->ci->db->queries) > 0 && $this->ci->session->has_userdata('admin_id')) {
        if (count($this->ci->db->queries) > 0 && true) {
            return true;
        }

        return false;
    }

    public function get_type($query)
    {
        $types = $this->ci->config->item('query_types');

        /*return implode('', array_filter($this->types, function ($type) use ($query) {
            return stristr($query, $type);
        }));*/

        foreach ($types as $type){
            if(stristr($query, $type)){
                return $type;
            }
        }

    }
}