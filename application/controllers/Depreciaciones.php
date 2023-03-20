<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Depreciaciones extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Depreciaciones_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        //$this->load->model("rol_model");

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Depreciaciones/nuevo");
        } else {
            redirect(base_url());
        }
    }
    public function nuevo()
    {
        if ($this->session->userdata("login")) {  
            $data['data_table_activos'] = $this->Depreciaciones_model->get_data_activos(); 
                   
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('depreciaciones/listado',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }  
     public function bajas()
    {
        if ($this->session->userdata("login")) {  
            $data['data_table_inactivos'] = $this->activos_model->get_data_inactivos();          
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('activos/bajas',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    } 
    public function create(){
        if ($this->session->userdata("login")) {

        $code="RYNV-".$this->input->post('auxiliar_id')."-".$this->input->post('grupo_id')."-00001";
        $data = array(
            'codigo' => $code, //input
            'descripcion' => $this->input->post('descripcion'), //input 
            'costo' => $this->input->post('costo'), //input 
            'auxiliar_id' => $this->input->post('auxiliar_id'), //input 
            'grupo_id' => $this->input->post('grupo_id'), //input     
            'fecha_incorporacion' => $this->input->post('fecha'), //input  
            'observaciones' => $this->input->post('observaciones'), //input  
            'estado' =>'1', //input           
        );
        $this->db->set('fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('activos', $data);
        redirect(base_url() . 'activos/nuevo/');
         } else {
            redirect(base_url());
        }
    }
    public function update()
    {
        if ($this->session->userdata("login")) {
            $data = array(
            'codigo' => '12346', //input
            'descripcion' => $this->input->post('descripcion'), //input 
            'costo' => $this->input->post('costo'), //input 
            'auxiliar_id' => $this->input->post('auxiliar_id'), //input 
            'grupo_id' => $this->input->post('grupo_id'), //input     
            'fecha_incorporacion' => $this->input->post('fecha'), //input  
            'observaciones' => $this->input->post('observaciones'), //input  
            'estado' =>'1', //input                              
            );
            $id=$this->input->post('activo_id');            
            $this->db->where('activo_id', $id);
            $this->db->update('activos', $data); 


            redirect(base_url() . 'activos/nuevo/');           
           
        } else {
            redirect(base_url());
        }
    }

    public function alta($id = null)
    {
        if ($this->session->userdata("login")) {
            $activo = $this->db->query("SELECT activo from activos WHERE activo_id=$id");            
            foreach ($activo ->result() as $row)
            {
                $valor=$row->activo;                    
            }  
            $valor=1-$valor;                      
            $data = array(
                'activo' => $valor, //input                                 
            );
            $this->db->where('activo_id', $id);
            $this->db->update('activos', $data);          
            redirect(base_url() . 'activos/nuevo/');
        } else {
            redirect(base_url());
        }
    }

    public function delete()
    {
        if ($this->session->userdata("login")) {
            $id = $this->input->post('activo_id');                                            
            $data = array(
                'activo' => 0, //input                                 
            );
            $this->db->where('activo_id', $id);
            $this->db->update('activos', $data);

            $data_b = array(            
            'motivo' => $this->input->post('motivo'),
            'activo_id' => $this->input->post('activo_id'),
            );
            $this->db->set('fecha_baja', 'NOW()', FALSE);
            $this->db->insert('bajas', $data_b);
            redirect(base_url() . 'activos/nuevo/');
        } else {
            redirect(base_url());
        }
    }

    public function edit($id = null)
    {
        if ($this->session->userdata("login")) {
            $data['row'] = $this->activos_model->get_data_porid($id); 
            $data['data_table_grupo'] = $this->activos_model->get_data_grupo();
            $data['data_table_auxiliar'] = $this->activos_model->get_data_auxiliar();                
            $this->load->view('empresa/header_datetime');
            $this->load->view('admin/menu');
            $this->load->view('activos/activos_edit',$data);
            $this->load->view('empresa/footer_datetime');  
        } else {
            redirect(base_url());
        }
    }
    public function edit_baja($id = null)
    {
        if ($this->session->userdata("login")) {
            $data['row'] = $this->activos_model->get_data_porid($id); 
            $data['data_table_grupo'] = $this->activos_model->get_data_grupo();
            $data['data_table_auxiliar'] = $this->activos_model->get_data_auxiliar();                
            $this->load->view('empresa/header_datetime');
            $this->load->view('admin/menu');
            $this->load->view('activos/activos_baja',$data);
            $this->load->view('empresa/footer_datetime');  
        } else {
            redirect(base_url());
        }
    }       
}
