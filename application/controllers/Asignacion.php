<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asignacion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Asignacion_model");
        $this->load->model("Activos_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        $this->load->library('phpqrcode/qrlib');
        $this->load->helper('url');
        //$this->load->model("rol_model");

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "asignacion/nuevo");
        } else {
            redirect(base_url());
        }
    }
    public function nuevo()
    {
        if ($this->session->userdata("login")) {  
            $data['data_table_asign'] = $this->Asignacion_model->get_data_table(); 
            $data['data_table_activo'] = $this->Asignacion_model->get_data_activo();
            $data['data_table_persona'] = $this->Asignacion_model->get_data_persona();         
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('asignacion/asignacionListado',$data);
            //$this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    } 
     public function asignar()
    {
        if ($this->session->userdata("login")) {  
             $data['data_table_grupo'] = $this->Activos_model->get_data_grupo();
            $data['data_table_asign'] = $this->Asignacion_model->get_data_table(); 
            $data['data_table_activo'] = $this->Asignacion_model->get_data_activo();
            $data['data_table_persona'] = $this->Asignacion_model->get_data_persona();         
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('asignacion/asignacion',$data);
            //$this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }  
    public function bajas()
    {
        if ($this->session->userdata("login")) {  
            $data['data_table_asign'] = $this->Asignacion_model->get_data_table(); 
            $data['data_table_activo'] = $this->Asignacion_model->get_data_activo();
            $data['data_table_persona'] = $this->Asignacion_model->get_data_persona();         
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('asignacion/asignacion',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }  
    //crear las asignaciones
    public function create(){  
        if ($this->session->userdata("login")) {       
            $data = array(
            'empleado_id' => $this->input->post('empleado'), //input             
        );
            $this->db->set('usu_creacion', $this->session->userdata("persona_id"));
            $this->db->set('fecha_asign', 'NOW()', FALSE);
            $this->db->set('fecha_creacion', 'NOW()', FALSE);
            $this->db->insert('asignacion', $data);
            $asignacion_id=$this->db->insert_id();//id de la asignacion
            
            //activos
            $cont = 0;
            $codigoAsign_id = $this->input->post('activo_id');//id del subactivo
            
            // var_dump($codigoAsign_id);exit();
            
            for ($j = 0; $j < count($codigoAsign_id); $j++) {
                $materiales_array = array(                
                'asignacion_id' => $asignacion_id,
                'codigoAsign_id' => $codigoAsign_id[$j],
                
                );
                //poner el activo a asignado
                $idActivo=$this->idActivo($codigoAsign_id[$j]);
                
                // var_dump($idActivo);exit();
                //poner el subactivo a no visible            
                $this->db->set('usu_modificacion', $this->session->userdata("persona_id"));
                $this->db->set('asignado',2);
               
                $this->db->where('codigoAsign_id', $codigoAsign_id[$j]);
                $this->db->update('actcodasign'); 
                //       

             $this->db->set('activo_id',$idActivo);    
            $this->db->set('usu_creacion', $this->session->userdata("persona_id"));       
            $this->db->set('fecha_creacion', 'NOW()', FALSE);
            $this->db->insert('detalle_asignacion', $materiales_array);


            //generacion del qr            
            $codigoAsignId=$codigoAsign_id[$j];
            $datos = $this->Asignacion_model->get_activo($codigoAsignId);
            $codigoGen = $datos->codigoGen;
            // $codigoAsign_id = $datos->codigoAsign_id;
            //$fecha_asignacion_qr = $datos->fecha_incorporacion;
            $estado_q = $datos->estado;                        
            $descripcion_qr = strtoupper($datos->descripcion);

            $empleado = $this->Asignacion_model->get_empleado($this->input->post('empleado'));
  
            
            $responsable = strtoupper($empleado->nombre);
            
            $this->qrcodeGenerator($codigoAsignId,$codigoGen,$datos->codigoAsign,$datos->grupo,$datos->auxiliar,$descripcion_qr,$datos->oficina,$responsable,$estado_q);
            
            }

            //fin de guardar de activos



            redirect(base_url() . 'asignacion/borrar_cache');
        } else {
            redirect(base_url());
        }
    }
    public function update()
    {
        if ($this->session->userdata("login")) {
            
            /*$data = array(
            'activo_id' => $this->input->post('activo_id'), //input                                         
            'empleado_id' => $this->input->post('empleado'), //input                                         
            );
            
            $this->db->where('asignacion_id', $id);
            $this->db->update('asignacion', $data); */
            $asignacion_id=$this->input->post('asignacion_id');
            $asd  = $this->input->post('empleado_id'); //input 
            

            


            //actualizamos los activos

            $this->db->query("UPDATE activos SET activo = 1
            WHERE activo_id IN (SELECT activo_id FROM detalle_asignacion WHERE asignacion_id=$asignacion_id)");            
            //end update


            //borramos el detalle de la asignacion
            $this->db->where('asignacion_id', $asignacion_id);
            $this->db->delete('detalle_asignacion');
            //fin de borrar

            //activos
            
            $activo_id = $this->input->post('activo_id');            
            for ($j = 0; $j < count($activo_id); $j++) {
                $materiales_array = array(                
                'asignacion_id' => $asignacion_id,
                'activo_id' => $activo_id[$j],                
            );
            //poner el activo a no visible            
                           
                $this->db->set('activo',2);
                $this->db->where('activo_id', $activo_id[$j]);
                $this->db->update('activos'); 
                //       
            $this->db->insert('detalle_asignacion', $materiales_array);
            

            //fin de guardar de activos

            //generacion del qr            
            $activoId=$activo_id[$j];            
            $datos = $this->Asignacion_model->get_activo($activoId);
            $code = $datos->codigo;
            $costo = $datos->costo;
            //$fecha_asignacion_qr = $datos->fecha_incorporacion;
            $estado_q = $datos->estado;                        
            $descripcion_qr = strtoupper($datos->descripcion);


            $empleado = $this->Asignacion_model->get_empleado($this->input->post('empleado_id'));
            $oficina = $empleado->oficina;
            
            $empleado = strtoupper($empleado->nombre);

            $fecha_asignacion_qr = $this->Asignacion_model->get_asignacion($asignacion_id);
            $fecha_asignacion_qr = $fecha_asignacion_qr->fecha_asign;
            

            //se quito la actualizacion del qr        
            $this->qrcodeGenerator($activoId,$empleado,$code,$descripcion_qr,$fecha_asignacion_qr,$estado_q,$oficina,$costo);
            //fin de qr
        }




            redirect(base_url() . 'asignacion/borrar_cache');
           
        } else {
            redirect(base_url());
        }
    }

    public function delete($id = null)
    {
        if ($this->session->userdata("login")) {
            $activo = $this->db->query("SELECT activo from asignacion WHERE asignacion_id=$id");            
            foreach ($activo ->result() as $row)
            {
                $valor=$row->activo;                    
            }  
            $valor=1-$valor;                      
            $data = array(
                'activo' => $valor, //input                                 
            );
            $this->db->where('asignacion_id', $id);
            $this->db->update('asignacion', $data);          
            redirect(base_url() . 'asignacion/nuevo/');
        } else {
            redirect(base_url());
        }
    }

    public function edit($id = null)
    {
        if ($this->session->userdata("login")) {
            $data['asignacion'] = $this->Asignacion_model->get_data_porid($id); 
            $data['data_table_activo'] = $this->Asignacion_model->get_data_activo();
            $data['detalle'] = $this->Asignacion_model->get_detalle($id);                     
            $this->load->view('empresa/header_datetime');
            $this->load->view('admin/menu');
            $this->load->view('asignacion/asignacion_edit',$data);
            $this->load->view('empresa/footer_datetime');  
        } else {
            redirect(base_url());
        }
    }    

    public function lista_user()
    {
        if ($this->session->userdata("login")) {  
            $id_user=$this->session->userdata("persona_perfil_id");
            $data['data_table_asign'] = $this->Asignacion_model->get_idpersona($id_user); 
            $data['data_table_activo'] = $this->Asignacion_model->get_data_activo();
            $data['data_table_persona'] = $this->Asignacion_model->get_data_persona(); 
            $data['id_persona'] = $id_user;        
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('asignacion/listado_user',$data);
                    
        } else {
            redirect(base_url());
        }
    } 

    public function vista_detalles()
    {
        if ($this->session->userdata("login")) {

          $asign_id = $this->input->post('asign_id');
         
          
          $data['solicitud'] = $this->Asignacion_model->getDetalleAsignacion($asign_id);
       
          $response=$this->load->view('asignacion/detalle',$data,TRUE);
          echo $response;

        } else {
            redirect(base_url());
        }
    }

    public function detalleAsignacion($asign_id)
    {
        if ($this->session->userdata("login")) {
         $data['solicitud'] = $this->Asignacion_model->getDetalleAsignacion($asign_id);
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('asignacion/detalleAsignacion',$data);
        } else {
            redirect(base_url());
        }
    }

    public function borrar_cache()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "asignacion/nuevo");
        } else {
            redirect(base_url());
        }
    }

    public function qrcodeGenerator($codigoAsignId,$codigoGen,$codigoAsign,$grupo,$auxiliar,$descripcion_qr,$oficina,$responsable,$estado_q)
    {                
               //$this->qrcodeGenerator($codigoAsignId,$responsable,$codigoGen,$codigoAsign_id,$datos->grupo,$datos->auxiliar,$descripcion_qr,$datos->oficina,$oficina,$estado_q);

        if(isset($responsable))
        { 
            //file path for store images
            $SERVERFILEPATH = './qr/';

            //$text = $empleado;
            //$text1= substr($text, 0,9); 

            // here our data
           
            // exit();
 
            
            // we building raw data
            //$codeContents  = 'BEGIN:VCARD'."\n";
            /*$codeContents .= 'ACTIVO: '.$desc."\n";
            $codeContents .= 'CODIGO: '.$codigo."\n";
           $codeContents .= 'FECHA: '.$fecha."\n";
            $codeContents .= 'COSTO: '.$costo."\n";
            $codeContents .= 'ESTADO: '.$est."\n";
            $codeContents .= 'UNIDAD: DEPARTAMENTO I – ADM. RR. HH '."\n";
            $codeContents .= 'OFICINA: '.$oficina."\n";
           // $codeContents .= 'END:VCARD';   */        

            // generating
            $folder = $SERVERFILEPATH;            
            $file_name1 = $codigoAsignId.".png";
            $file_name = $folder.$file_name1;
            QRcode::png('Codigo Generico: '.$codigoGen."\n".'Codigo Asignado: '.$codigoAsign."\n".'Grupo: '.$grupo."\n".'Producto: '.$auxiliar."\n".'Descripcion: '.$descripcion_qr."\n".'Ubicacion: '.$oficina."\n".'Estado: '.$estado_q."\n".'Responsable: '.$responsable."\n",$file_name);            
            // displaying

            
            // echo"<center><img src=".base_url().'images/'.$file_name1."></center";
        }
        else
        {
            echo 'No Text Entered';
        }   
    }

      //combo listado auxiliares
    public function apiAuxiliares()
{   
    $grupoId=$this->input->post('grupoId');
    

    $contenido['datosAuxiliares'] = $this->Activos_model->getAuxiliarId($grupoId);

    $response=$this->load->view('asignacion/auxiliarList',$contenido,TRUE);    
    

    echo $response; 
    
}

     //combo listado activos
    public function apiActivosList()
    {   
        $auxiliarId=$this->input->post('auxiliarId');
        $listadoActivos=$this->Activos_model->getListaActivos($auxiliarId);        
        //solo la asignacion se hara a una persona
        $contenido['listadoActivos'] = $this->Activos_model->getListaActivos($auxiliarId);
          
        
        if ($listadoActivos) {
            $response=$this->load->view('asignacion/activosLista',$contenido,TRUE);  
        }else{
            $response=$this->load->view('asignacion/404',$contenido,TRUE); 
        }
        echo $response; 
        
    }

    //obtener el id del activo
    public function idActivo($idsubactivo)
    {
        if ($this->session->userdata("login")) {

          
          
                $idActivo= $this->Asignacion_model->getIdActivo($idsubactivo);
                $this->db->set('usu_modificacion', $this->session->userdata("persona_id"));
                $this->db->set('asignado',2);
                $this->db->where('activo_id', $idActivo->activo_id);
                $this->db->update('activos');
         
                return $idActivo->activo_id;
       

        } else {
            redirect(base_url());
        }
    }

}
