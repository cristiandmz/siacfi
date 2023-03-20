<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Personas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Personas_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        //$this->load->model("rol_model");

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Personas/nuevo");
        } else {
            redirect(base_url());
        }
    }
    public function nuevo()
    {
        if ($this->session->userdata("login")) {  

            $data['data_table_personas'] = $this->Personas_model->get_data_table();     
            $data['data_table_cargo'] = $this->Personas_model->get_data_cargo();  
            
            $data['getGerencias'] = $this->Personas_model->getGerencias();   
            $data['getSucursal'] = $this->Personas_model->getSucursal();
            $data['perfil'] = $this->Personas_model->getRol();
            $this->load->view('personas/header_datetime');
            $this->load->view('admin/menu');
            $this->load->view('personas/nuevo',$data);
            //$this->load->view('personas/footer_datetime');
                    
        } else {
            redirect(base_url());
        }
    }  
    public function create(){
        if ($this->session->userdata("login")) {  
            $cargo_id=$this->input->post('cargo_id');
            $unidad_id=$this->input->post('unidad_id');
            // var_dump($this->input->post('imagen'));exit();
            //generacion de codigo asignacion de la gerencia
        $getConteo = $this->Personas_model->getConteo($this->input->post('gerencia_id'));

        $getCodGerencia = $this->Personas_model->getCodGerencia($this->input->post('gerencia_id'));
        $getCodGerencia=$getCodGerencia->codGerencia;
        $getConteo=$getConteo->total;
        $getConteo=$getConteo+1;
      
        $getCodGerencia=$getCodGerencia.$getConteo;
     
     

        $data = array(
            'nombres' => ucwords($this->input->post('nombres')), //input
            'paterno' => ucwords($this->input->post('paterno')), //input 
            'materno' => ucwords($this->input->post('materno')), //input 
            'direccion' => ucwords($this->input->post('direccion')), //input 
            'telefono' => $this->input->post('telefono'), //input 
            'ci' => $this->input->post('ci'), //input 
            'fec_nacimiento' => $this->input->post('fecha_nacimiento'), //input 
            'fec_incorporacion' => $this->input->post('fecha_incorporacion'), //input                 
            'gerencia_id' => $this->input->post('gerencia_id'), //input 
            'sucursal_id' => $this->input->post('sucursal_id'), //input 
            'cargo_id' => $this->input->post('cargo_id'), //input                       
        );
        $this->db->set('usu_creacion', $this->session->userdata("persona_id"));
        $this->db->set('codAsignGer',$getCodGerencia);
        $this->db->set('fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('persona', $data);
        $persona_id = $this->db->insert_id();//ultimo id


          //subida de imagen
         $img = $persona_id;

            
                $config['upload_path']          = './usuarios';
                $config['file_name']        = $img;
                $config['allowed_types']        = 'png';
                $config['overwrite']        = TRUE;
                $config['max_size']             = 100000000;
            
                
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('imagen')){
                    $error = array('error' => $this->upload->display_errors());
                    // var_dump($error);
                    // exit();
                    $img='default';
                }  
                else {
                    $data = array('upload_data' => $this->upload->data());

                }
                //
        $paterno=strtolower(($this->input->post('paterno')));      
        $usuario=$paterno.'.'.$this->input->post('ci');
        $password=md5($this->input->post('password'));
        $data_c = array(
            'usuario' => $usuario, //input
            'contrasenia' => $password, //input                    
            'rol_id' => $this->input->post('rol'), //input
            'persona_id'  => $persona_id,
            'img'  => $img,
        );
        $this->db->set('usu_creacion', $this->session->userdata("persona_id"));
        $this->db->set('fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('credencial', $data_c);



      
        redirect(base_url() . 'Personas/borrar_cache/');
    } else {
        redirect(base_url());
    }
    }
    public function update()
    {

        if ($this->session->userdata("login")) {
            $data = array(
             'nombres' => ucwords($this->input->post('nombres')), //input
            'paterno' => ucwords($this->input->post('paterno')), //input 
            'materno' => ucwords($this->input->post('materno')), //input 
            'direccion' => ucwords($this->input->post('direccion')), //input 
            'telefono' => $this->input->post('telefono'), //input 
            'ci' => $this->input->post('ci'), //input 
            'fec_nacimiento' => $this->input->post('fecha_nacimiento'), //input 
            'fec_incorporacion' => $this->input->post('fecha_incorporacion'), //input                 
            'gerencia_id' => $this->input->post('gerencia_id'), //input 
            'sucursal_id' => $this->input->post('sucursal_id'), //input 
            'cargo_id' => $this->input->post('cargo_id'), //input
            );
            $id=$this->input->post('persona_id');            
            $this->db->where('persona_id', $id);
            $this->db->update('persona', $data); 
            $imagen=$this->input->post('imagen');
            // var_dump(empty($imagen));exit();
         
            // if (isset($this->input->post('cargo_id'))) {
                
            // }else{

            // }

          //subida de imagen
        

            
                $config['upload_path']          = './usuarios';
                $config['file_name']        = $id;
                $config['allowed_types']        = 'png';
                $config['overwrite']        = TRUE;
                $config['max_size']             = 100000000;
            
                
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('imagen')){
                    $error = array('error' => $this->upload->display_errors());
                    // var_dump($error);
                    // exit();
                   
                }  
                else {
                    $data = array('upload_data' => $this->upload->data());
                     
                        $this->db->set('img', $id);
                        $this->db->set('usu_creacion', $this->session->userdata("persona_id"));
                        $this->db->set('fecha_creacion', 'NOW()', FALSE);
                         $this->db->where('persona_id', $id);
                        $this->db->update('credencial');
                }
                //
                        $this->db->set('rol_id', $this->input->post('rol'));
                        $this->db->where('persona_id', $id);
                        $this->db->update('credencial');
       
       

        redirect(base_url() . 'Personas/nuevo/');           
           
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
            $this->db->where('persona_id', $id);
            $this->db->update('persona', $data); 

            $this->db->where('persona_id', $id);
            $this->db->delete('credencial');
                            
            redirect(base_url() . 'Personas/borrar_cache/');
        } else {
            redirect(base_url());
        }
    }

    public function borrar_cache()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Personas/nuevo");
        } else {
            redirect(base_url());
        }
    }

    public function edit($id = null)
    {
        if ($this->session->userdata("login")) {
            $data['datosP'] = $this->Personas_model->get_data_porid($id); 
              $data['data_table_personas'] = $this->Personas_model->get_data_table();     
            $data['data_table_cargo'] = $this->Personas_model->get_data_cargo();  
            
            $data['getGerencias'] = $this->Personas_model->getGerencias();   
            $data['getSucursal'] = $this->Personas_model->getSucursal();
            $data['perfil'] = $this->Personas_model->getRol();          
            $this->load->view('personas/header_datetime');
            $this->load->view('admin/menu');
            $this->load->view('personas/persona_edit',$data);
            $this->load->view('personas/footer_datetime');  
        } else {
            redirect(base_url());
        }
    }

    public function update_password_usuario()
{
    if ($this->session->userdata("persona_id")) {

      $password_nuevo_usuarios = $this->input->post('password_nuevo_usuarios');

      $id = $this->input->post('usuario_id_cambio_password');  

      
      $usuario_actual=$this->session->userdata("persona_id");

      // echo 'ingreso por si';
      $password = md5($password_nuevo_usuarios);
      $this->db->set('contrasenia', $password);
      $this->db->set('fecha_modificacion', 'NOW()', FALSE);
      $this->db->set('usu_modificacion',$usuario_actual);
      $this->db->where('persona_id', $id);
      $this->db->update('credencial');

      // new




      $jsondata['msj'] = 'si';  
      echo json_encode($jsondata);   


  } else {
    redirect(base_url());
}
}    


}

