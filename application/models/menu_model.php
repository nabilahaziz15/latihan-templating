<?php
defined('BASEPATH') or exit('No direct script access allowed');
class menu_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function queryMenu()
    {
        $role_id = $this->session->userdata('role_id');
        $this->db->select('*');
        $this->db->from('user_menu');
        $this->db->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id', 'left');
        $this->db->where('user_access_menu.role_id', $role_id);
        $this->db->ORDER_BY('user_access_menu.menu_id', 'ASC');
        $menu = $this->db->get();
        return $menu->result_array();
        // var_dump($menu);
        // die();
    }
    public function subMenu($param_menu_id = null)
    {

        $this->db->select('*');
        $this->db->from('user_sub_menu');
        $where = " menu_id = '" . $param_menu_id . "' AND is_active ='1'";
        $this->db->where($where);
        $submenu = $this->db->get();
        return $submenu->result_array();
    }
    public function addMenu()
    {
        $this->db->select('*');
        $this->db->from('user_menu');
        $nambah = $this->db->get();
        return $nambah->result_array();
        /*if ($this->form_validation->run() == true) {
            $this->db->insert('menu', $data);
            return $this->db->insert_id();
        } */
    }
}
