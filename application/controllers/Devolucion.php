<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Devolucion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Devolucion_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        $this->load->model("Asignacion_model");
        //$this->load->model("rol_model");
        $this->load->library('phpqrcode/qrlib');

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Devolucion/nuevo");
        } else {
            redirect(base_url());
        }
    }
    public function nuevo()
    {
        if ($this->session->userdata("login")) {  
            $data['data_table_asign'] = $this->Devolucion_model->get_data_table(); 
            $data['data_table_activo'] = $this->Devolucion_model->get_data_activo();
            $data['data_table_persona'] = $this->Devolucion_model->get_data_persona();         

            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('devolucion/devolucion',$data);
            //$this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }  

    public function lista()
    {
        if ($this->session->userdata("login")) {  
            $data['data_table_asign'] = $this->Devolucion_model->get_data_histo(); 
            $data['data_table_activo'] = $this->Devolucion_model->get_data_activo();
            $data['data_table_persona'] = $this->Devolucion_model->get_data_persona();         
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('devolucion/devolucion_lista',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }  

    public function bajaActivo()
    {
        if ($this->session->userdata("login")) {

            // var_dump($this->input->post('codigoAsign'));exit();
            $motivo=$this->input->post('motivo');
            if ($this->input->post('motivo')==1) {
                $motivo=$this->input->post('otro');
            }
            $data = array(
            'empleado_id' => $this->input->post('empleado'), //input             
            'asignacion_id' => $this->input->post('asignacion_id'), //input
            'observacion' => $this->input->post('obsv'), //input
            'motivo' => $motivo, //input             
        );
            $this->db->set('fecha_devolucion', 'NOW()', FALSE);
            $this->db->set('usu_creacion', $this->session->userdata("persona_id"));  
            $this->db->set('fecha_creacion', 'NOW()', FALSE);
            $this->db->insert('devolucion', $data);
            $devolucion_id=  $this->db->insert_id();
            $asignacion_id=$this->input->post('asignacion_id');                                
             //insertar detalle de activos devueltos
            $codAsign=$this->input->post('codigoAsign');
            // var_dump(count($codAsign));exit();
            for ($i=0; $i < count($codAsign) ; $i++) { 
                $detAsign = $this->Devolucion_model->getDetalleAsignacionID($codAsign[$i]);
                 // var_dump($detAsign);exit();
                $this->db->set('devolucion_id',$devolucion_id);
                $this->db->set('asignacion_id',$detAsign->asignacion_id); 
                $this->db->set('codigoAsign_id',$detAsign->codigoAsign_id); 
                $this->db->set('activo_id',$detAsign->activo_id);    
                $this->db->set('usu_creacion', $this->session->userdata("persona_id"));       
                $this->db->set('fecha_creacion', 'NOW()', FALSE);
                $this->db->insert('detalle_devolucion');
                //dar de baja los detalles de la asignacion
                $this->db->set('activo',0);
                $this->db->where('detalle_id',$codAsign[$i]);            
                $this->db->update('detalle_asignacion');
                //actualizar el estado de los subactivos
                $this->db->set('asignado',1);
                $this->db->where('codigoAsign_id',$detAsign->codigoAsign_id);            
                $this->db->update('actcodasign');
                // //actualizar el estado de los activos
                
                $conteoAsignados=$this->db->query("SELECT COUNT(activo_id) as conteo FROM actcodasign WHERE activo_id=$detAsign->activo_id and asignado=2")->row();
                if ($conteoAsignados->conteo==0) {
                    $this->db->set('asignado',1);
                    $this->db->where('activo_id',$detAsign->activo_id);            
                    $this->db->update('activos');                    
                }

                // actualizar el codigo qr
                $codigoAsignId=$detAsign->codigoAsign_id;

                    $datos = $this->Asignacion_model->get_activo($codigoAsignId);
                    // var_dump($datos);exit();
                    $codigoGen = $datos->codigoGen;                  
                    $estado_q = $datos->estado;                        
                    $descripcion_qr = strtoupper($datos->descripcion);
                    $responsable = 'NO ASIGNADO';  
                    $this->qrcodeGenerator($codigoAsignId,$codigoGen,$datos->codigoAsign,$datos->grupo,$datos->auxiliar,$descripcion_qr,$datos->oficina,$responsable,$estado_q);
               
            }
            

            // //dar de baja a la asignacion
            $estadoAsignacion=$this->db->query("SELECT SUM(activo) as suma FROM detalle_asignacion
                WHERE asignacion_id=$asignacion_id")->row(); 
            // var_dump($estadoAsignacion->suma);exit();
            if ($estadoAsignacion->suma=="0") {
                // code...

                $this->db->set('activo',0);
                $this->db->where('asignacion_id',$asignacion_id);            
                $this->db->update('asignacion');
            }
            

            

            

            redirect(base_url() . 'Devolucion/borrar_cacheDev/'.$devolucion_id);
        } else {
            redirect(base_url());
        }
    }
    public function bajaOld()
    {
        if ($this->session->userdata("login")) {
            $data = array(
            'empleado_id' => $this->input->post('empleado'), //input             
            'asignacion_id' => $this->input->post('asignacion_id'), //input
            'motivo' => $this->input->post('motivo'), //input             
        );
            $this->db->set('fecha_devolucion', 'NOW()', FALSE);
            $this->db->set('fecha_creacion', 'NOW()', FALSE);
            $this->db->insert('devolucion', $data);
            $asignacion_id=$this->input->post('asignacion_id');                                


            //actualizar el estado de los activos
            $this->db->query("UPDATE activos SET asignado = 1
                WHERE activo_id IN (SELECT activo_id FROM detalle_asignacion WHERE asignacion_id=$asignacion_id)");    
            //actualizar el estado de los subactivos
            $this->db->query("UPDATE actcodasign SET asignado = 1
                WHERE codigoAsign_id IN (SELECT codigoAsign_id FROM detalle_asignacion WHERE asignacion_id=$asignacion_id)");         
            //end update

            //dar de baja a la asignacion
            $this->db->set('activo',0);
            $this->db->where('asignacion_id',$asignacion_id);            
            $this->db->update('asignacion');
            //dar de baja los detalles de la asignacion
            $this->db->set('activo',0);
            $this->db->where('asignacion_id',$asignacion_id);            
            $this->db->update('detalle_asignacion');

            redirect(base_url() . 'Devolucion/borrar_cache');
        } else {
            redirect(base_url());
        }
    }

    public function vista_insertar($id = null)
    {
        if ($this->session->userdata("login")) {
          $asign_id = $this->input->post('asign_id');
          $data['id_solicitud'] = $asign_id;          
          $data['row'] = $this->Devolucion_model->get_data_porid($asign_id);         
          $response=$this->load->view('devolucion/devolucion_baja',$data,TRUE);
          echo $response;
      } else {
        redirect(base_url());
    }
}

public function vista_detalles()
{
    if ($this->session->userdata("login")) {

      $asign_id = $this->input->post('asign_id');
      $data['id_solicitud'] = $asign_id;

      $data['solicitud'] = $this->Devolucion_model->getDetalleAsignacion($asign_id);

      $response=$this->load->view('devolucion/detalle',$data,TRUE);
      echo $response;

  } else {
    redirect(base_url());
}
}

public function detalleDevolucion($devolucion_id)
{
    if ($this->session->userdata("login")) {
       $data['solicitud'] = $this->Devolucion_model->getDetalleDevolucion($devolucion_id);
       $this->load->view('datatable/header');
       $this->load->view('admin/menu');
       $this->load->view('devolucion/detalleDevolucion',$data);
   } else {
    redirect(base_url());
}
}

public function detalleAsignacion($asign_id)
{
    if ($this->session->userdata("login")) {
       $data['solicitud'] = $this->Asignacion_model->getDetalleAsignacion($asign_id);
       $data['id_solicitud'] = $asign_id;          
       $data['act'] = $this->Devolucion_model->get_data_porid($asign_id);
       $data['motivos'] = $this->Devolucion_model->getMotivos();
       $this->load->view('datatable/header');
       $this->load->view('admin/menu');
       $this->load->view('devolucion/devolucionBaja',$data);
   } else {
    redirect(base_url());
}
}


public function borrar_cache()
{
    if ($this->session->userdata("login")) {

        redirect(base_url() . "Devolucion/nuevo");
    } else {
        redirect(base_url());
    }
}

public function borrar_cacheDev($devolucion_id)
{
    if ($this->session->userdata("login")) {

        redirect(base_url() . "Devolucion/detalleDevolucion/".$devolucion_id);
    } else {
        redirect(base_url());
    }
}

public function qrcodeGenerator($codigoAsignId,$codigoGen,$codigoAsign,$grupo,$auxiliar,$descripcion_qr,$oficina,$responsable,$estado_q)
    {                
        //$this->qrcodeGenerator($codigoAsignId,$codigoGen,$datos->codigoAsign,$datos->grupo,$datos->auxiliar,$descripcion_qr,$datos->oficina,$responsable,$estado_q);

        if(isset($responsable))
        { 
            //file path for store images
            // $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/AF/images/';
            $SERVERFILEPATH = './qr/';

             

            // generating
            $folder = $SERVERFILEPATH;            
            $file_name1 = $codigoAsignId.".png";
            $file_name = $folder.$file_name1;
            // QRcode::png($codeContents,$file_name);


            QRcode::png('Codigo Generico: '.$codigoGen."\n".'Codigo Asignado: '.$codigoAsign."\n".'Grupo: '.$grupo."\n".'Producto: '.$auxiliar."\n".'Descripcion: '.$descripcion_qr."\n".'Ubicacion: '.$oficina."\n".'Estado: '.$estado_q."\n".'Responsable: '.$responsable."\n",$file_name);            
            // displaying
            // echo"<center><img src=".base_url().'qr/'.$file_name1."></center";
        }
        else
        {
            echo 'No Text Entered';
        }   
    
    }












    
}
