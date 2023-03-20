<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bienvenido extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
       

    }

    public function index()
    {
        if ($this->session->userdata("login")) {           
            $this->load->view('admin/header');
            $this->load->view('admin/menu');
            $this->load->view('bienvenido');
            $this->load->view('admin/footer');   
        } else {
            redirect(base_url());
        }
    }    
    

    
}
