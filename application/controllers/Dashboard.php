<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        $this->load->model("Depreciaciones_model");
        $this->load->model("Dashboard_model");
    }

    public function index()
    {
      if ($this->session->userdata("login")) {
        $rol= $this->session->userdata("rol");
        if($rol==1 || $rol==2){
            redirect(base_url() . "Activos/borrar_cache");            
        }else{            
            redirect(base_url() . "asignacion/lista_user");
        }



        
        } else {
            redirect(base_url());
        }
    }    
    public function borrar_cache()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Activos");
        } else {
            redirect(base_url());
        }
    }

    public function graficos()
    {
        if ($this->session->userdata("login")) {     
            $data['conteo_dep'] = $this->Depreciaciones_model->get_rest_count(1461);
            $data['conteo_pers'] = $this->Dashboard_model->get_count_pers(); 
            $data['conteo_asign'] = $this->Dashboard_model->get_count_asign(); 
            $data['conteo_act'] = $this->Dashboard_model->get_count_act(); 

            $this->load->view('dashboard/header');
            $this->load->view('admin/menu');
            $this->load->view('dashboard/dashboard',$data);
            //$this->load->view('dashboard/footer');   
        } else {
            redirect(base_url());
        }
    }

    public function listado()
    {
        if ($this->session->userdata("login")) {  
            $data['data_table_activos'] = $this->Depreciaciones_model->get_rest(1461); 
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('dashboard/listado',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }   
    

    
}
