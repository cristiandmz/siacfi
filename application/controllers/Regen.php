<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Regen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model("Activos_model");
        $this->load->model("Asignacion_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        // $this->load->model('Activos_ajax_model','activos');
        //QR CODE
        $this->load->library('phpqrcode/qrlib');
        $this->load->helper('url');
        
        //$this->load->model("rol_model");

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "activos/nuevo");
        } else {
            redirect(base_url());
        }
    }
   


    public function actualizar(){

        if ($this->session->userdata("login")) {
            
            $todosActivos = $this->Asignacion_model->getActivosList();
            //activos sin asignar
                 for ($i=0; $i <count($todosActivos); $i++) { 
                   
                    //generacion del qr            
                    $codigoAsignId=$todosActivos[$i]['codigoAsign_id'];


                    $datos = $this->Asignacion_model->get_activo($codigoAsignId);
                    if (isset($datos)) {
                        // var_dump($datos);exit();
                    $codigoGen = $datos->codigoGen;                  
                    $estado_q = $datos->estado;                        
                    $descripcion_qr = strtoupper($datos->descripcion);
                    $responsable = 'NO ASIGNADO';  
                    $this->qrcodeGenerator($codigoAsignId,$codigoGen,$datos->codigoAsign,$datos->grupo,$datos->auxiliar,$descripcion_qr,$datos->oficina,$responsable,$estado_q);
                    //fin de qr
                    }
                    
                 }

                   //activos asignados    
            $todosActivos = $this->Asignacion_model->getActivosAsignadosList();
      
                 for ($i=0; $i <count($todosActivos); $i++) { 
                   
                    //generacion del qr            
                    $codigoAsignId=$todosActivos[$i]['codigoAsign_id'];

                    $datos = $this->Asignacion_model->getActivosAsignadosDato($codigoAsignId);
                    // var_dump($datos);exit();
                    if (isset($datos)) {
                    $codigoGen = $datos->codigoGen;                  
                    $estado_q = $datos->estado;                        
                    $descripcion_qr = strtoupper($datos->descripcion);
                    $responsable = $datos->nombres;  
                    $this->qrcodeGenerator($codigoAsignId,$codigoGen,$datos->codigoAsign,$datos->grupo,$datos->auxiliar,$descripcion_qr,$datos->oficina,$responsable,$estado_q);
                    //fin de qr
                    }
                 }
                 
                redirect(base_url() . 'Activos/reportes/'); 
      
            }// fin de sw=1 insertar archivo

             
        else {
            redirect(base_url());
        }//fin else login
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
            $file_name1 = $codigoAsignId.".jpg";
            $file_name = $folder.$file_name1;
            // QRcode::png($codeContents,$file_name);


            QRcode::png('Codigo Generico: '.$codigoGen."\n".'Codigo Asignado: '.$codigoAsign."\n".'Grupo: '.$grupo."\n".'Producto: '.$auxiliar."\n".'Descripcion: '.$descripcion_qr."\n".'Ubicacion: '.$oficina."\n".'Estado: '.$estado_q."\n".'Responsable: '.$responsable."\n",$file_name,'H',10,2);            
            // displaying
            // echo"<center><img src=".base_url().'qr/'.$file_name1."></center";
        }
        else
        {
            echo 'No Text Entered';
        }   
    }

         

    

 

    





    


}


