<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('user_model');
        $this->load->model('submenu_model');
    }
    public function index()
    {
        $data['user'] = $this->user_model->afterLogin();
        $data['title'] = 'Menu Management';
        $data['menu'] = $this->menu_model->addMenu();
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Menu Added!
          </div>');
            redirect('menu');
        }
    }
    public function submenu()
    {

        $data['title'] = 'Submenu Management';
        $data['user'] = $this->user_model->afterLogin();
        $data['subMenu'] = $this->submenu_model->getSubMenu();
        $data['menu'] = $this->menu_model->addMenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->submenu_model->insert_submenu($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Submenu Added!
          </div>');
            redirect('menu/submenu');
        }
    }
}
