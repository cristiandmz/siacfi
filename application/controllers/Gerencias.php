<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gerencias extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model("Gerencias_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        //$this->load->model("rol_model");

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Gerencias/nuevo");
        } else {
            redirect(base_url());
        }
    }
    public function nuevo()
    {

        if ($this->session->userdata("login")) {
		    $data['data_table_Gerencias'] = $this->Gerencias_model->get_data_table();
            		
            $this->load->view('datatable/header');
			$this->load->view('admin/menu');
			$this->load->view('gerencia/gerencia',$data);

			//$this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }  
     public function create(){
        if ($this->session->userdata("login")) {

            $data = array(
            'gerencia' => $this->input->post('nombre'), 
            'codGerencia' => $this->input->post('codGerencia'), //input                   
        ); 
        $this->db->set('usu_creacion', $this->session->userdata("persona_id"));      
        $this->db->set('fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('gerencia', $data);
        
        redirect(base_url() . 'Gerencias/borrar_cache/');
    } else {
        redirect(base_url());
    }
    }

    public function editar()
    {
        if ($this->session->userdata("login")) {

          $gerencia_id = $this->input->post('gerencia_id');
       
            $data['gerencia'] = $this->Gerencias_model->getDataGerencias($gerencia_id); 
            

           

         
          $response=$this->load->view('gerencia/gerencia_editar',$data,TRUE);
          echo $response;

        } else {
            redirect(base_url());
        }
    }

    public function update()
    {
        if ($this->session->userdata("login")) {            
            $data = array(
            'gerencia' => $this->input->post('nombre'), 
            'codGerencia' => $this->input->post('codGerencia'), //input    
          
            );
            $id=$this->input->post('gerencia_id');            
            $this->db->where('gerencia_id', $id);
            $this->db->update('gerencia', $data); 


            redirect(base_url() . 'Gerencias/borrar_cache/');           
           
        } else {
            redirect(base_url());
        }
    }

    public function borrar_cache()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Gerencias/nuevo");
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
            $this->db->where('gerencia_id', $id);
            $this->db->update('gerencia', $data);          
            redirect(base_url() . 'Gerencias/borrar_cache/');
        } else {
            redirect(base_url());
        }
    }

   
   
    
}


