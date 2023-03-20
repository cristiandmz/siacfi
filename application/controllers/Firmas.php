<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Firmas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Activos_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        //$this->load->model("rol_model");

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "firmas/firmas");
        } else {
            redirect(base_url());
        }
    }

     public function firmas()
    {
        if ($this->session->userdata("login")) {  
            $data['firmas'] = $this->Activos_model->get_firmas();
            $data['encabezado'] = $this->Activos_model->get_encabezado();
            
            
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('firmas/firmas',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }

    public function borrar_cache()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "firmas/firmas");
        } else {
            redirect(base_url());
        }
    }

    public function detalles()
    {
        if ($this->session->userdata("login")) {

          $userid = $this->input->post('userid');
          $data['firma_id'] = $userid;
          
          $data['solicitud'] = $this->Activos_model->get_detalle_firma( $userid);
          $data['personas'] = $this->Activos_model->get_personas();

          $response=$this->load->view('firmas/editar',$data,TRUE);
          echo $response;

        } else {
            redirect(base_url());
        }
    }

    public function detalle_encabezado()
    {
        if ($this->session->userdata("login")) {

          $userid = $this->input->post('userid');
          $data['encabezado_id'] = $userid;
          
          $data['datos'] = $this->Activos_model->get_detalle_encabezado($userid);
          

          $response=$this->load->view('firmas/editar_encabezado',$data,TRUE);
          echo $response;

        } else {
            redirect(base_url());
        }
    }

    
   


    
    
    
    public function update()
    {
        if ($this->session->userdata("login")) {
            $data = array(               
            'persona_id' => $this->input->post('persona_id'), //input                                         
            'cargo' => $this->input->post('cargo'), //input  
            'firma' => $this->input->post('firma'), //input  
            );
            $id=$this->input->post('firma_id');            
            $this->db->where('firma_id', $id);
            $this->db->update('firmas', $data); 
            redirect(base_url() . 'Firmas/borrar_cache/');           
           
        } else {
            redirect(base_url());
        }
    }
      public function editarEncabezado($id)
    {
        if ($this->session->userdata("login")) {  
            $data['encabezado_id'] = $id;
          
            
              $data['datos'] = $this->Activos_model->get_detalle_encabezado($id);
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('firmas/editarEncabezado',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }
    public function update_encabezado()
    {
        if ($this->session->userdata("login")) {
            
            $encabezado_id=$this->input->post('encabezado_id');
            // var_dump($encabezado_id);exit();
            $this->db->set('texto_uno', $this->input->post('texto_uno'));           
            $this->db->where('encabezado_id',$encabezado_id );
            $this->db->update('encabezado'); 
            redirect(base_url() . 'Firmas/borrar_cache/');           
           
        } else {
            redirect(base_url());
        }
    }

   

    

    

    

    
}
