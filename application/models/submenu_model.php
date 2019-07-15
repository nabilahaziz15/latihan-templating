<?php
defined('BASEPATH') or exit('No direct script access allowed');

class submenu_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
        from `user_sub_menu` join `user_menu`
        On `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";
        return  $this->db->query($query)->result_array();
    }
    public function insert_submenu($data)
    {

        $this->db->insert('user_sub_menu', $data);
        return $this->db->insert_id();
    }
}
