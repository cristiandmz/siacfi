<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oficina extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model("Oficina_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Oficina/nuevo");
        } else {
            redirect(base_url());
        }
    }
    public function nuevo()
    {

        if ($this->session->userdata("login")) {
		    $data['data_table_unidad'] = $this->Oficina_model->get_data_table();
            			
            $this->load->view('datatable/header');
			$this->load->view('admin/menu');
			$this->load->view('oficina/oficina',$data);

			//$this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }  
     public function create(){
        if ($this->session->userdata("login")) {
        $data = array(
            'oficina' => $this->input->post('unidad'), //input              
        );       
        $this->db->set('fecha_creacion', 'NOW()', FALSE);
        $this->db->set('usu_creacion',$this->session->userdata("persona_perfil_id") );
        $this->db->insert('oficina', $data);
        
        redirect(base_url() . 'Oficina/borrar_cache/');
    } else {
        redirect(base_url());
    }
    }

    public function editar()
    {
        if ($this->session->userdata("login")) {

          $unidad_id = $this->input->post('asign_id');
          $data['row'] = $this->Oficina_model->get_data_porid($unidad_id);
          $response=$this->load->view('oficina/oficina_editar',$data,TRUE);
          echo $response;

        } else {
            redirect(base_url());
        }
    }

    public function update()
    {
        if ($this->session->userdata("login")) {            
            $data = array(
            'oficina' => $this->input->post('nombre'), //input                                               
            );
            $id=$this->input->post('oficina_id');            
            $this->db->where('oficina_id', $id);
            $this->db->update('oficina', $data); 
            redirect(base_url() . 'Oficina/borrar_cache/');           
           
        } else {
            redirect(base_url());
        }
    }

    public function borrar_cache()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Oficina/nuevo");
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
            $this->db->where('oficina_id', $id);
            $this->db->update('oficina', $data);          
            redirect(base_url() . 'Oficina/borrar_cache/');
        } else {
            redirect(base_url());
        }
    }

   
   
    
}


