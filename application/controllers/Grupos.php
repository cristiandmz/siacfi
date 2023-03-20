<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grupos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model("Grupos_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        //$this->load->model("rol_model");

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Grupos/nuevo");
        } else {
            redirect(base_url());
        }
    }
    public function nuevo($cod_catastral = null)
    {

        if ($this->session->userdata("login")) {
		    $data['data_table_grupo'] = $this->Grupos_model->get_data_table();			
            $this->load->view('datatable/header');
			$this->load->view('admin/menu');
			$this->load->view('crud/grupos',$data);
			
        } else {
            redirect(base_url());
        }
    }  
     public function create(){
        if ($this->session->userdata("login")) {
        $data = array(
            'nombre' => $this->input->post('nombre'), //input                        
            'codGrup' => $this->input->post('codGrup'), //input    
        );
        $this->db->set('fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('grupo', $data);
        redirect(base_url() . 'grupos/borrar_cache/');
    } else {
        redirect(base_url());
    }
    }
    public function update()
    {
        if ($this->session->userdata("login")) {
            $data = array(
            'nombre' => $this->input->post('nombre'), //input 
            'codGrup' => $this->input->post('codGrup'), //input                                          
            );
            $id=$this->input->post('grupo_id');            
            $this->db->where('grupo_id', $id);
            $this->db->update('grupo', $data); 


            redirect(base_url() . 'grupos/nuevo/');           
           
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
            $this->db->where('grupo_id', $id);
            $this->db->update('grupo', $data);          
            redirect(base_url() . 'Grupos/borrar_cache/');
        } else {
            redirect(base_url());
        }
    }

    public function borrar_cache()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Grupos/nuevo");
        } else {
            redirect(base_url());
        }
    }

    public function edit($id = null)
    {
        if ($this->session->userdata("login")) {
            $data['row'] = $this->Grupos_model->get_data_porid($id);          
            $this->load->view('admin/header');
            $this->load->view('admin/menu');
            $this->load->view('crud/grupo_edit',$data);
            $this->load->view('admin/footer');  
        } else {
            redirect(base_url());
        }
    } 
   
    
}
