<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cargos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model("Cargos_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        //$this->load->model("rol_model");

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() );
        } else {
            redirect(base_url());
        }
    }
    public function nuevo()
    {
        if ($this->session->userdata("login")) {
		    $data['data_table_cargo'] = $this->Cargos_model->get_data_table();
            $data['data_table_grupo'] = $this->Cargos_model->get_data_grupo();			
            $this->load->view('datatable/header');
			$this->load->view('admin/menu');
			$this->load->view('cargos/cargos',$data);
			           
        } else {
            redirect(base_url());
        }
    }  
     public function create(){
        if ($this->session->userdata("login")) {       
        $data = array(
            'descripcion' => $this->input->post('cargo'), //input                             
        );       
        $this->db->set('fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('cargos', $data);
        
        redirect(base_url() . 'Cargos/borrar_cache/');
    } else {
        redirect(base_url());
    }
    }
    public function update()
    {
        if ($this->session->userdata("login")) {            
            $data = array(
            'descripcion' => $this->input->post('descripcion'), //input                                       
            );
            $id=$this->input->post('cargo_id');            
            $this->db->where('cargo_id', $id);
            $this->db->update('cargos', $data); 


            redirect(base_url() . 'Cargos/borrar_cache/');           
           
        } else {
            redirect(base_url());
        }
    }

    public function delete($id = null)
    {
        if ($this->session->userdata("login")) {
                                 
            $data = array(
                'activo' => 0, //input                                 
            );
            $this->db->where('cargo_id', $id);
            $this->db->update('cargos', $data);          
            redirect(base_url() . 'Cargos/borrar_cache/');
        } else {
            redirect(base_url());
        }
    }

    public function borrar_cache()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Cargos/nuevo");
        } else {
            redirect(base_url());
        }
    }

    public function editar()
    {
        if ($this->session->userdata("login")) {

          $cargo_id = $this->input->post('asign_id');
           $data['row'] = $this->Cargos_model->get_data_porid($cargo_id);
            $data['data_table_grupo'] = $this->Cargos_model->get_data_grupo(); 

         
          $response=$this->load->view('cargos/cargos_edit',$data,TRUE);
          echo $response;

        } else {
            redirect(base_url());
        }
    }
   
    
}
