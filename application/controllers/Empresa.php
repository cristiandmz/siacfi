<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empresa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Empresa_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        //$this->load->model("rol_model");

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Empresa/nuevo");
        } else {
            redirect(base_url());
        }
    }
    public function nuevo()
    {
        if ($this->session->userdata("login")) {  
            $data['data_table_empresa'] = $this->Empresa_model->get_data_table();          
            $this->load->view('empresa/header_datetime');
            $this->load->view('admin/menu');
            $this->load->view('empresa/empresa',$data);
            $this->load->view('empresa/footer_datetime');            
        } else {
            redirect(base_url());
        }
    }  
    public function create(){
        if ($this->session->userdata("login")) {  
        $data = array(
            'nombre' => $this->input->post('fecha_creacion_emp'), //input
            'direccion' => $this->input->post('direccion'), //input 
            'nit' => $this->input->post('nit'), //input 
            'ciudad' => $this->input->post('ciudad'), //input 
            'telefono' => $this->input->post('telefono'), //input     
            'fecha_creacion_emp' => $this->input->post('fecha_creacion_emp'), //input            
        );
        $this->db->set('fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('empresa', $data);
        redirect(base_url() . 'empresa/nuevo/');
    } else {
        redirect(base_url());
    }
    }
    public function update()
    {
        if ($this->session->userdata("login")) {
            $data = array(
            'nombre' => $this->input->post('nombre'), //input
            'direccion' => $this->input->post('direccion'), //input 
            'nit' => $this->input->post('nit'), //input 
            'ciudad' => $this->input->post('ciudad'), //input 
            'telefono' => $this->input->post('telefono'), //input     
            'fecha_creacion_emp' => $this->input->post('fecha_creacion_emp'), //input                              
            );
            $id=$this->input->post('empresa_id');            
            $this->db->where('empresa_id', $id);
            $this->db->update('empresa', $data); 


            redirect(base_url() . 'empresa/nuevo/');           
           
        } else {
            redirect(base_url());
        }
    }

    public function delete($id = null)
    {
        if ($this->session->userdata("login")) {
            $activo = $this->db->query("SELECT activo from empresa WHERE empresa_id=$id");            
            foreach ($activo ->result() as $row)
            {
                $valor=$row->activo;                    
            }  
            $valor=1-$valor;                      
            $data = array(
                'activo' => $valor, //input                                 
            );
            $this->db->where('empresa_id', $id);
            $this->db->update('empresa', $data);          
            redirect(base_url() . 'Empresa/nuevo/');
        } else {
            redirect(base_url());
        }
    }

    public function edit($id = null)
    {
        if ($this->session->userdata("login")) {
            $data['row'] = $this->Empresa_model->get_data_porid($id);          
            $this->load->view('empresa/header_datetime');
            $this->load->view('admin/menu');
            $this->load->view('empresa/empresa_edit',$data);
            $this->load->view('empresa/footer_datetime');  
        } else {
            redirect(base_url());
        }
    }    
}
