<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Activos_model");
        $this->load->model("Asignacion_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        $this->load->model('Activos_ajax_model','activos');
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
    public function nuevo()
    {
        if ($this->session->userdata("login")) {  

            // var_dump($this->session->userdata());exit();
            //$data['data_table_activos'] = $this->Activos_model->get_activos_depreciacion(); 
            // $this->Activos_model->crear_vista(); //crear la vista
            $data['data_table_grupo'] = $this->Activos_model->get_data_grupo();
            $data['data_table_auxiliar'] = $this->Activos_model->get_data_auxiliar();
            $data['getOficinaList'] = $this->Activos_model->getOficinaList();
            $data['data_suc'] = $this->Activos_model->getSucList();
            $data['data_table_estado'] = $this->Activos_model->get_data_estado();           
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('activos/activos_ajax',$data);
            //$this->load->view('activos/activos',$data);
            //$this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }  


 public function detalleActivos($id=null)
    {
        if ($this->session->userdata("login")) {  


            //$data['data_table_activos'] = $this->Activos_model->get_activos_depreciacion(); 
            // $this->Activos_model->crear_vista(); //crear la vista
           
            $data['getDatosActivos'] = $this->Activos_model->get_data_porid($id);   
            $data['getActivos'] = $this->Activos_model->getCodAsignId($id);    
            $data['activoId'] = $id;

            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('activos/detalleActivos',$data);
            //$this->load->view('activos/activos',$data);
            //$this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    } 


    public function reportes()
    {
        if ($this->session->userdata("login")) {  

            $data['gestion']=$this->db->query("SELECT DISTINCT YEAR(fecha_incorporacion) as anio FROM activos ")->result(); 
            
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('reportes/dashboard',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }  


     public function bajas()
    {
        if ($this->session->userdata("login")) {  
            $data['data_table_inactivos'] = $this->Activos_model->get_data_inactivos();          
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('activos/bajas',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    } 

         //depreciacion del activo
                //========================
                /*
                $actvid = $this->db->query("SELECT a.*,e.descripcion as descs FROM activos a
                    LEFT JOIN 
                    estado e
                    on a.estado_id=e.estado_id
                    ORDER BY activo_id DESC LIMIT 1");            
                foreach ($actvid ->result() as $row)
                {
                    $activo_id_last=$row->activo_id;
                    $codigo_q=$row->codigo;
                    $fecha_q=$row->fecha_incorporacion;
                    $estado_q=$row->descs;                   
                }
                $grupo_id_u=$this->input->post('grupo_id');
                $vid_u = $this->db->query("SELECT * FROM grupo where grupo_id=$grupo_id_u");            
                foreach ($vid_u ->result() as $row_u)
                {
                    $vida_util=$row_u->vida_util;                    
                }
                $costo=$this->input->post('costo');
                $dep_anual=$costo/$vida_util;
                $dep_mensual=$dep_anual/12;
                $dep_dia=$dep_mensual/30;

                $fecha_actual=$this->input->post('fecha');
                 //$fecha_fin = strtotime ('+1 year' , strtotime($fecha_actual));
                $fecha_fin = strtotime ('+'.$vida_util.' year' , strtotime($fecha_actual));
                $fecha_fin = date ('Y-m-d',$fecha_fin);


                $data_d = array(
                    'activo_id' => $activo_id_last, //input 
                    'vida_util' => $vida_util, //input 
                    'dep_anual' => $dep_anual, //input 
                    'dep_mensual' => $dep_mensual, //input 
                    'dep_dia'=>$dep_dia,
                    'fecha_fin'=>$fecha_fin,
                ); 
                $this->db->set('fecha_creacion', 'NOW()', FALSE);
                $this->db->insert('depreciacion', $data_d);*/

    public function do_upload(){

        if ($this->session->userdata("login")) {
            $sw = $this->input->post('opcion');

            
            if ( $sw==1 )  {//inicio de la insercion
                $sucDesc=$this->Activos_model->getSucId($this->input->post('sucursal'));
                $sucDesc=$sucDesc->codigo_suc;
                $grupoDesc=$this->Activos_model->getGrupoId($this->input->post('grupo_id'));
                $grupoDesc=$grupoDesc->codGrup;
                $conteo=$this->Activos_model->getConteoActivos($this->input->post('grupo_id'));
                $conteo=$conteo->conteo+1;
                // generar el codigo generico
                $CodactivoId = substr(str_repeat(0, 4).$conteo, - 4);
                $codigoGenActivo=$sucDesc.'/'.$grupoDesc.'/'.$CodactivoId;

                $data = array(
                        //'codigo' => $code, //input                        
                        'descripcion' => $this->input->post('descripcion'), //input 
                        'accesorios' => $this->input->post('accesorios'), //input 
                        'forma_pago' => $this->input->post('formaPago'), //input 
                        'nrofactura' => $this->input->post('nrofactura'), //input 
                        
                        'sucursal_id' => $this->input->post('sucursal'), //input 
                        'costo' => $this->input->post('costo'), //input 
                        'cantidad' => $this->input->post('cantidad'), //input 
                        'auxiliar_id' => $this->input->post('auxiliar_id'), //input 
                        'grupo_id' => $this->input->post('grupo_id'), //input     
                        'fecha_incorporacion' => $this->input->post('fecha'), //input  
                        'observaciones' => $this->input->post('observaciones'), //input  
                        'estado_id' =>$this->input->post('estado'), //input 
                        'url' => 'public/assets/images/activos', //input 

                        'marca' => $this->input->post('marca'), //input 
                        'modelo' => $this->input->post('modelo'), //input 
                        'serie' => $this->input->post('serie'), //input 

                        'color' => $this->input->post('color'), //input 
                        'ancho' => $this->input->post('ancho'), //input 
                        'largo' => $this->input->post('largo'), //input

                        'anio' => $this->input->post('anio'), //input
                        'nromotor' => $this->input->post('nromotor'), //input
                        'nrooficina' => $this->input->post('nrooficina'), //input
                        'dimension' => $this->input->post('dimension'), //input
                        'nrocontrato' => $this->input->post('nrocontrato'), //input                                 
                    );
                     $this->db->set('codigo', $codigoGenActivo);
                  $this->db->set('usu_creacion', $this->session->userdata("persona_id"));
                $this->db->set('fecha_creacion', 'NOW()', FALSE);
                $this->db->insert('activos', $data);
                $activoId = $this->Activos_model->getActviIdUser($this->session->userdata("persona_id"));
                
                 
                //imagen del activo

                 for ($i=1; $i <=$this->input->post('cantidad') ; $i++) { 
                        $data = array(
                        'codigoGen' => $codigoGenActivo, //input 
                        'activo_id' => $activoId->activo_id, //input 
                        'oficina_id' => $this->input->post('oficina'),
                        'codigoAsign' => $codigoGenActivo.'/'.$i
                    );
                    $this->db->set('usu_creacion', $this->session->userdata("persona_id"));
                    $this->db->set('fecha_creacion', 'NOW()', FALSE);
                    $this->db->insert('actcodasign', $data);
                    $codigoAsignId = $this->db->insert_id();//id del subactivo
                    //generacion del qr            
                    
                    $datos = $this->Asignacion_model->get_activo($codigoAsignId);
                    $codigoGen = $datos->codigoGen;                  
                    $estado_q = $datos->estado;                        
                    $descripcion_qr = strtoupper($datos->descripcion);
                    $responsable = 'NO ASIGNADO';  
                    $this->qrcodeGenerator($codigoAsignId,$codigoGen,$datos->codigoAsign,$datos->grupo,$datos->auxiliar,$descripcion_qr,$datos->oficina,$responsable,$estado_q);
                    //fin de qr
                 }




                $img = $activoId->activo_id;

            
                $config['upload_path']          = './public/assets/images/activos';
                $config['file_name']        = $img;
                $config['allowed_types']        = 'jpg';
                $config['overwrite']        = TRUE;
                $config['max_size']             = 100000000;
            
                
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('foto_org')){
                    $error = array('error' => $this->upload->display_errors());
                    // var_dump($error);
                    // exit();
                    $img='default';
                }  
                else {
                    $data = array('upload_data' => $this->upload->data());

                }
                 $img = $img.'.jpg'; //input 

                  
                //  $this->db->set('codigo', $codigoGenActivo);
                $this->db->set('imagen', $img);
                $this->db->where('activo_id', $activoId->activo_id);
                $this->db->update('activos');
                // var_dump($img);exit();
                //fin de imagen 
           
                //qr
                
                                
                redirect(base_url() . 'Activos/borrar_cache/'); 
                //fin de codigo de barras
            }// fin de sw=1 insertar archivo

             
              
            
        } 
        else {
            redirect(base_url());
        }//fin else login
    }

         

       public function updateActivo()
    {
        if ($this->session->userdata("login")) {
                $id=$this->input->post('idActivo');

                $config['upload_path']          = './public/assets/images/activos';
                $config['file_name']        = $id;
                $config['allowed_types']        = 'jpg';
                $config['overwrite']        = TRUE;
                $config['max_size']             = 100000000;
                $config['max_width']            = 100024;
                $config['max_height']           = 700068;

                $this->load->library('upload', $config);        
                if ( ! $this->upload->do_upload('foto_org'))//solo pasa cuando fotoorg es true
                {
                    $error = array('error' => $this->upload->display_errors());
                   
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
              
                    $img = $id.'.jpg';

                    
                    $this->db->set('imagen', $img);       
                    $this->db->where('activo_id', $id);
                    $this->db->update('activos');

                }
             

                $data_upd = array(
                      'descripcion' => $this->input->post('descripcion'), //input 
                        'accesorios' => $this->input->post('accesorios'), //input 
                        
                        'forma_pago' => $this->input->post('formaPago'), //input 
                        'nrofactura' => $this->input->post('nrofactura'), //input 
                        'costo' => $this->input->post('costo'), //input 
                       
                            
                        'fecha_incorporacion' => $this->input->post('fecha'), //input  
                          
                        'estado_id' =>$this->input->post('estado'), //input 
                        'observaciones' => $this->input->post('observaciones'), //input  

                        'marca' => $this->input->post('marca'), //input 
                        'modelo' => $this->input->post('modelo'), //input 
                        'serie' => $this->input->post('serie'), //input 

                        'color' => $this->input->post('color'), //input 
                        'ancho' => $this->input->post('ancho'), //input 
                        'largo' => $this->input->post('largo'), //input

                        'anio' => $this->input->post('anio'), //input
                        'nromotor' => $this->input->post('nromotor'), //input
                        'nrooficina' => $this->input->post('nrooficina'), //input
                        'dimension' => $this->input->post('dimension'), //input
                        'nrocontrato' => $this->input->post('nrocontrato'), //
                                                         
                );
                        
                $this->db->where('activo_id', $id);
                $this->db->update('activos', $data_upd);
                redirect(base_url() . 'Activos/borrar_cache/');           
           
        } else {
            redirect(base_url());
        }
    }

    public function update()
    {
        if ($this->session->userdata("login")) {
            $data = array(
            //'codigo' => '12346', //input
            'descripcion' => $this->input->post('descripcion'), //input codigo
            'costo' => $this->input->post('costo'), //input 
            'codigo' => $this->input->post('codigo'), //input 
            'auxiliar_id' => $this->input->post('auxiliar_id'), //input 
            'grupo_id' => $this->input->post('grupo_id'), //input     
            'fecha_incorporacion' => $this->input->post('fecha'), //input  
            'observaciones' => $this->input->post('observaciones'), //input  
            //'estado' =>$this->input->post('estado'), //input                              
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

    public function delete($id)
    {
        if ($this->session->userdata("login")) {
                                                        
            $data = array(
                'activo' => 0, //input                                 
            );
            $this->db->where('activo_id', $id);
            $this->db->update('activos', $data);

            $data = array(
                'activo' => 0, //input                                 
            );
            $this->db->where('activo_id', $id);
            $this->db->update('actcodasign', $data);
            redirect(base_url() . 'activos/borrar_cache/');
        } else {
            redirect(base_url());
        }
    }
     public function desvincular($id)
    {
        if ($this->session->userdata("login")) {
                                                        
            $data = array(
                'activo' => 1, //input                                 
            );
            $this->db->where('activo_id', $id);
            $this->db->update('activos', $data);
            //borrando el activo de la asignacion
            $this->db->where('activo_id', $id);
            $this->db->delete('detalle_asignacion');

            redirect(base_url() . 'activos/borrar_cache/');
        } else {
            redirect(base_url());
        }
    }

    public function borrar_cache()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "Activos");
        } else {
            redirect(base_url());
        }
    }

    public function delete_backup()
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



    public function editar($id = null)
    {
        if ($this->session->userdata("login")) {
            $data['datosA'] = $this->Activos_model->get_data_porid($id); 
            $data['data_table_grupo'] = $this->Activos_model->get_data_grupo();
            $data['data_table_auxiliar'] = $this->Activos_model->get_data_auxiliar();
            $data['getOficinaList'] = $this->Activos_model->getOficinaList();
            $data['data_suc'] = $this->Activos_model->getSucList();
            $data['data_table_estado'] = $this->Activos_model->get_data_estado(); 
            $data['idActivo'] = $id;

            // $grupoId=$this->Activos_model->get_data_porid($id);
            // $grupoId=$grupoId->grupo_id;
                       
            
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('activos/activos_edit',$data);
            $this->load->view('datatable/footer');  

            
        } else {
            redirect(base_url());
        }
    }
    public function edit_baja($id = null)
    {
        if ($this->session->userdata("login")) {
            $data['row'] = $this->Activos_model->get_data_porid($id); 
            $data['data_table_grupo'] = $this->Activos_model->get_data_grupo();
            $data['data_table_auxiliar'] = $this->Activos_model->get_data_auxiliar();                
            $this->load->view('empresa/header_datetime');
            $this->load->view('admin/menu');
            $this->load->view('activos/activos_baja',$data);
            $this->load->view('empresa/footer_datetime');  
        } else {
            redirect(base_url());
        }
    } 

    public function pdftest()
    {
        $this->load->view('user_list');
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
    }

    public function pdf()
    {
        $this->load->view('reportes/cert_dep_pdf');
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('letter', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
    } 
    public function pdf_utf8()
    {
        
        $html = '<html lang="es">
        <head>
            <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        </head>
            <body>
            é á ó í ú ? - $%#@!@^&**
            <p style="font-family: Verdana, Arial, sans-serif;">é á ó í ú ? - $%#@!@^&**</p>
            </body>
        </html>';
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->setPaper('letter', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
    } 

      


     

     

    public function html()
    {
         $data['data_table_activos'] = $this->db->query('SELECT a.*,e.descripcion as est,d.* from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id
                        LEFT JOIN
                        depreciacion d
                        on a.activo_id=d.activo_id
         where a.activo=1 or a.activo=2')->result();

        $data['code'] = $this->db->query('SELECT a.*,e.descripcion as est,d.* from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id
                        LEFT JOIN
                        depreciacion d
                        on a.activo_id=d.activo_id
         where a.activo=1 or a.activo=2')->row();
        $data['fecha']=date('d');
        $this->load->view('reportes/cert_listado_qr',$data);    
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
    public function qrcodeGenerator_asignado($id=null,$cod,$code,$desc,$fecha,$est,$unidad)
    {                
        //$this->qrcodeGenerator($activoId,$codigoQR,$codigo_q,$descripcion_qr,$fecha_compra_qr,$estado_q);

        if(isset($cod))
        { 
            //file path for store images
            $SERVERFILEPATH = './images/';

            $text = $cod;
            $text1= substr($text, 0,9); 

            // here our data
            $desc = $desc;
            $fecha = $fecha;
            $estado = $est;
            $codigo = $code; 
            
            // we building raw data
            // $codeContents  = 'BEGIN:VCARD'."\n";
            $codeContents = 'ACTIVO: '.$desc."\n";            
            $codeContents .= 'CODIGO: '.$codigo."\n";
            $codeContents .= 'FECHA: '.$fecha."\n";
            // $codeContents .= 'COSTO: '.$desc."\n";
            $codeContents .= 'ESTADO: '.$estado."\n";
            $codeContents .= 'UNIDAD: '.$unidad."\n";
       
           // $codeContents .= 'END:VCARD';           

            // generating
            $folder = $SERVERFILEPATH;            
            $file_name1 = $id.".png";
            $file_name = $folder.$file_name1;
            QRcode::png($codeContents,$file_name);            
            // displaying
            // echo"<center><img src=".base_url().'images/'.$file_name1."></center";
        }
        else
        {
            echo 'No Text Entered';
        }   
    }

    private function set_barcode($code,$nombre)
    {
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode
        //Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
       

       $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
       $code = time().$code;
       $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/AF/barcode/';
       
       $store_image = imagepng($file,$SERVERFILEPATH.$nombre.".png");
       //return $code.'.png';
       redirect(base_url());
    } 

      

      

    public function pdf_asignacion_oficinas()
    {
        //ini_set('memory_limit', '64000M');
        //set_time_limit(-1);
        //set_time_limit(0);
        //ini_set('memory_limit', -1);
        //ini_set('max_execution_time', 0);

        $id=$this->input->post('oficina');
        $data['data_table_activos'] = $this->db->query("SELECT a.*,e.descripcion as est, CASE WHEN u.nombre_unidad is NULL THEN
        'No asignado'
    ELSE
        'DEPARTAMENTO I – ADM. RR. HH.'
END  as unidad, CASE WHEN u.nombre_unidad is NULL THEN
        'No asignado'
    ELSE
        u.nombre_unidad
END  as oficina, CASE WHEN p.nombres is NULL THEN
        'No asignado'
    ELSE
        CONCAT(p.grado,' ', p.nombres,' ',p.paterno,' ',p.materno)
END  as nombre
 from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id
                        
                                                LEFT JOIN
                                                detalle_asignacion g
                                                on a.activo_id=g.activo_id
                                                LEFT JOIN
                                                asignacion j
                                                on g.asignacion_id=j.asignacion_id
                                                LEFT JOIN
                                                persona p
                                                on j.empleado_id=p.persona_id
                                                LEFT JOIN
                                                unidad u
                                                on u.unidad_id=p.unidad_id
                                                
                                                
         
                                                WHERE a.activo=2 and j.activo=1 and u.unidad_id=$id
                                                
         ")->result(); 
        $data['fecha']=$this->fecha_actual();

        $data['encabezado']=$this->db->query("SELECT * from encabezado where activo=1 and nivel=1")->row();

        $data['firmas']=$this->db->query("SELECT f.firma_id,f.cargo as cargo_f,f.firma,f.nivel as nivel,CONCAT(p.grado,' ',p.nombres,' ',p.paterno,' ',p.materno) as nombre from firmas f
LEFT JOIN
persona p
on f.persona_id=p.persona_id
where f.activo=1 order by f.nivel")->result_array();

        $data['emp']=$this->db->query("SELECT c.descripcion,CASE WHEN u.nombre_unidad is NULL THEN
        'No asignado'
    ELSE
        'DEPARTAMENTO I – ADM. RR. HH.'
END  as unidad, CASE WHEN u.nombre_unidad is NULL THEN
        'No asignado'
    ELSE
        u.nombre_unidad
END  as oficina, CASE WHEN p.nombres is NULL THEN
        'No asignado'
    ELSE
        CONCAT(p.grado,' ', p.nombres,' ',p.paterno,' ',p.materno)
END  as nombre
 from 
                                                persona p
                                                LEFT JOIN
                                                unidad u
                                                on u.unidad_id=p.unidad_id
                                                LEFT JOIN
                                                                                                cargos c
                                                                                                on c.cargo_id=p.cargo_id
                                                WHERE u.unidad_id=$id LIMIT 1")->row();

        $oficina=$this->db->query("SELECT * from unidad where unidad_id=$id")->row();
        $unidad= $oficina->nombre_unidad;
        $data['oficina']=$unidad;
        $data['encargado']=$this->db->query("SELECT CONCAT( p.grado,' ',p.nombres,' ',p.paterno,' ',p.materno) as nombre,u.nombre_unidad as seccion,c.descripcion as cargo FROM unidad u
LEFT JOIN
persona p
on p.persona_id=u.encargado_id
LEFT JOIN
cargos c
on c.cargo_id=p.cargo_id
WHERE u.unidad_id=$id")->row();

        $data['responsable']=$oficina=$this->db->query("SELECT CONCAT( p.grado,' ',p.nombres,' ',p.paterno,' ',p.materno) as nombre,u.nombre_unidad as seccion,c.descripcion as cargo FROM unidad u
LEFT JOIN
persona p
on p.persona_id=u.auxiliar_id
LEFT JOIN
cargos c
on c.cargo_id=p.cargo_id
WHERE u.unidad_id=$id")->row();

        
        $this->load->view('reportes/cert_asignacion_oficinas',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->set_option('isRemoteEnabled', TRUE);
        //numero de paginas
        $this->dompdf->set_option('isPhpEnabled', TRUE);
   
        $this->dompdf->setPaper('letter', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("listado_".$unidad.".pdf", array("Attachment"=>0));
    } 

    public function pdf_asignacion_unidades()
    {
        //ini_set('memory_limit', '64000M');
        //set_time_limit(-1);
        //set_time_limit(0);
        //ini_set('memory_limit', -1);
        //ini_set('max_execution_time', 0);

        $id=$this->input->post('unidad');
        // echo $id;
        // exit();

        $data['data_table_activos'] = $this->db->query("SELECT a.*,e.descripcion as est, CASE WHEN u.nombre_unidad is NULL THEN
        'No asignado'
    ELSE
        u.nombre_unidad
END  as oficina, CASE WHEN p.nombres is NULL THEN
        'No asignado'
    ELSE
        CONCAT(p.grado,' ', p.nombres,' ',p.paterno,' ',p.materno)
END  as nombre
 from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id
                        
                                                LEFT JOIN
                                                detalle_asignacion g
                                                on a.activo_id=g.activo_id
                                                LEFT JOIN
                                                asignacion j
                                                on g.asignacion_id=j.asignacion_id
                                                LEFT JOIN
                                                persona p
                                                on j.empleado_id=p.persona_id
                                                LEFT JOIN
                                                unidad u
                                                on u.unidad_id=p.unidad_id
                                                
                                                
         
                                                WHERE a.activo=2 and j.activo=1 and a.oficina_id=$id
                                                
         ")->result(); 
        $data['fecha']=$this->fecha_actual();

        $data['encabezado']=$this->db->query("SELECT * from encabezado where activo=1 and nivel=1")->row();

        $data['firmas']=$this->db->query("SELECT f.firma_id,f.cargo as cargo_f,f.firma,f.nivel as nivel,CONCAT(p.grado,' ',p.nombres,' ',p.paterno,' ',p.materno) as nombre from firmas f
LEFT JOIN
persona p
on f.persona_id=p.persona_id
where f.activo=1 order by f.nivel")->result_array();

        $data['emp']=$this->db->query("SELECT c.descripcion,CASE WHEN u.nombre_unidad is NULL THEN
        'No asignado'
    ELSE
        'DEPARTAMENTO I – ADM. RR. HH.'
END  as unidad, CASE WHEN u.nombre_unidad is NULL THEN
        'No asignado'
    ELSE
        u.nombre_unidad
END  as oficina, CASE WHEN p.nombres is NULL THEN
        'No asignado'
    ELSE
        CONCAT(p.grado,' ', p.nombres,' ',p.paterno,' ',p.materno)
END  as nombre
 from 
                                                persona p
                                                LEFT JOIN
                                                unidad u
                                                on u.unidad_id=p.unidad_id
                                                LEFT JOIN
                                                                                                cargos c
                                                                                                on c.cargo_id=p.cargo_id
                                                WHERE u.unidad_id=$id LIMIT 1")->row();

        $oficina=$this->db->query("SELECT * from oficina where oficina_id=$id")->row();
        $unidad= $oficina->oficina;
        $data['oficina']=$unidad;

//         $data['encargado']=$this->db->query("SELECT CONCAT( p.grado,' ',p.nombres,' ',p.paterno,' ',p.materno) as nombre,u.nombre_unidad as seccion,c.descripcion as cargo FROM unidad u
// LEFT JOIN
// persona p
// on p.persona_id=u.encargado_id
// LEFT JOIN
// cargos c
// on c.cargo_id=p.cargo_id
// WHERE u.unidad_id=$id")->row();

//         $data['responsable']=$oficina=$this->db->query("SELECT CONCAT( p.grado,' ',p.nombres,' ',p.paterno,' ',p.materno) as nombre,u.nombre_unidad as seccion,c.descripcion as cargo FROM unidad u
// LEFT JOIN
// persona p
// on p.persona_id=u.auxiliar_id
// LEFT JOIN
// cargos c
// on c.cargo_id=p.cargo_id
// WHERE u.unidad_id=$id")->row();

        
        $this->load->view('reportes/cert_asignacion_unidades',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->set_option('isRemoteEnabled', TRUE);
        //numero de paginas
        $this->dompdf->set_option('isPhpEnabled', TRUE);
   
        $this->dompdf->setPaper('letter', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("listado_".$unidad.".pdf", array("Attachment"=>0));
    }


    
    public function pdf_lista_qr()
    {
        $data['data_table_activos'] = $this->db->query("SELECT a.*,e.descripcion as est,d.*, (a.costo-(d.dep_dia)*DATEDIFF(now(),fecha_incorporacion)) as valor_actual,CASE WHEN u.nombre_unidad is NULL THEN
        'No asignado'
    ELSE
        'DEPARTAMENTO I – ADM. RR. HH.'
END  as unidad, CASE WHEN u.nombre_unidad is NULL THEN
        'No asignado'
    ELSE
        u.nombre_unidad
END  as oficina, CASE WHEN p.nombres is NULL THEN
        'No asignado'
    ELSE
        CONCAT(p.nombres,' ',p.paterno,' ',p.materno)
END  as nombre
 from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id
                        LEFT JOIN
                        depreciacion d
                        on a.activo_id=d.activo_id
                                                LEFT JOIN
                                                detalle_asignacion g
                                                on a.activo_id=g.activo_id
                                                LEFT JOIN
                                                asignacion j
                                                on g.asignacion_id=j.asignacion_id
                                                LEFT JOIN
                                                persona p
                                                on j.empleado_id=p.persona_id
                                                LEFT JOIN
                                                unidad u
                                                on u.unidad_id=p.unidad_id
                                                
                                                
         
                                                WHERE a.activo=2")->result(); 

        $data['fecha']=$this->fecha_actual();



        $this->load->view('reportes/cert_listado_qr',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->set_option('isRemoteEnabled', TRUE);  

        //$this->dompdf->setPaper('letter', 'portrait');
        $this->dompdf->setPaper(array(0,0,260,641), 'portrait');

        $this->dompdf->render();
        $this->dompdf->stream("etiquetas_qr.pdf", array("Attachment"=>0));
    } 

     

     public function anio()
    {
        if ($this->session->userdata("login")) {  
             

            $data['gestion']=$this->db->query("SELECT DISTINCT YEAR(fecha_incorporacion) as anio FROM activos ")->result();        
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('activos/list_anio',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    } 

    public function oficinas()
    {
        if ($this->session->userdata("login")) {  
            $data['oficinas'] = $this->Activos_model->get_unidades(); 
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('activos/list_oficinas',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }

    public function ubicacion()
    {
        if ($this->session->userdata("login")) {  
            $data['oficinas'] = $this->Activos_model->getOficinaList(); 
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('activos/list_oficinas_qr',$data);
            // $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }
     public function codigosAsign()
    {
        if ($this->session->userdata("login")) {  
            $oficina_id=$this->input->post('oficina');
            // echo $oficina_id;exit();
            // var_dump($this->Activos_model->getDataOficina($oficina_id));exit();
            if ($oficina_id=='todos') {
                // code...
                $data['lista'] = $this->Activos_model->getActivosTodos($oficina_id);
                $data['oficina'] = 'TODOS';
                $this->load->view('datatable/header');
                $this->load->view('admin/menu');
                $this->load->view('reportes/listadoCodAsign',$data);
                $this->load->view('datatable/footer'); 
            }else{
                $data['lista'] = $this->Activos_model->getActivosOficina($oficina_id);
                $oficina=$this->Activos_model->getDataOficina($oficina_id);
                $data['oficina'] = $oficina->oficina;
                $this->load->view('datatable/header');
                $this->load->view('admin/menu');
                $this->load->view('reportes/listadoCodAsign',$data);
                $this->load->view('datatable/footer'); 

            }
                       
        } else {
            redirect(base_url());
        }
    }
    public function unidades()
    {
        if ($this->session->userdata("login")) {  
            $data['oficinas'] = $this->Activos_model->get_oficinas(); 
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('activos/list_unidades',$data);
            $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }

     public function reporte_anio()
    {
        if ($this->session->userdata("login")) { 
            $gest=$this->input->post('gestion');
          $data['data_table_activos'] = $this->db->query("SELECT a.*,e.descripcion as est,d.*, (a.costo-(d.dep_dia)*DATEDIFF(now(),fecha_incorporacion)) as valor_actual,CASE WHEN u.nombre_unidad is NULL THEN
        'No asignado'
    ELSE
        'DEPARTAMENTO I – ADM. RR. HH.'
END  as unidad, CASE WHEN u.nombre_unidad is NULL THEN
        'No asignado'
    ELSE
        u.nombre_unidad
END  as oficina, CASE WHEN p.nombres is NULL THEN
        'No asignado'
    ELSE
        CONCAT(p.grado,' ', p.nombres,' ',p.paterno,' ',p.materno)
END  as nombre
 from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id
                        LEFT JOIN
                        depreciacion d
                        on a.activo_id=d.activo_id
                                                LEFT JOIN
                                                (SELECT d.*,a.empleado_id FROM
asignacion a
LEFT JOIN
detalle_asignacion d
on a.asignacion_id=d.asignacion_id
WHERE a.activo=1) as g
                                                on a.activo_id=g.activo_id
                                                
                                                LEFT JOIN
                                                persona p
                                                on g.empleado_id=p.persona_id
                                                LEFT JOIN
                                                unidad u
                                                on u.unidad_id=p.unidad_id
                                                                                                
                                                                                                WHERE a.activo!=0 and YEAR(a.fecha_incorporacion)='$gest'")->result(); 
        $data['fecha']=$this->fecha_actual();
        $data['gest']=$gest;

        $data['encabezado']=$this->db->query("SELECT * from encabezado where activo=1 and nivel=1")->row();

        $data['firmas']=$this->db->query("SELECT f.firma_id,f.cargo as cargo_f,f.firma,f.nivel as nivel,CONCAT(p.grado,' ',p.nombres,' ',p.paterno,' ',p.materno) as nombre from firmas f
LEFT JOIN
persona p
on f.persona_id=p.persona_id
where f.activo=1 order by f.nivel")->result_array();




        //set_time_limit(-1);
        $this->load->view('reportes/cert_anio',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->set_option('isRemoteEnabled', TRUE);
        //numero de paginas
        $this->dompdf->set_option('isPhpEnabled', TRUE);  
        $this->dompdf->setPaper('letter', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("listado_gral_activos_fijos_gest_".$gest.".pdf", array("Attachment"=>0));         
        } else {
            redirect(base_url());
        }
    } 

     public function pdf_dep_fin()
    {
        if ($this->session->userdata("login")) {  

           
          $data['data_table_activos'] = $this->db->query("SELECT a.*,e.descripcion as est,d.*, (a.costo-(d.dep_dia)*DATEDIFF(now(),fecha_incorporacion)) as valor_actual from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id
                        LEFT JOIN
                        depreciacion d
                        on a.activo_id=d.activo_id
         where a.activo!=0 and DATEDIFF(d.fecha_fin,now())=1461")->result(); 
        $data['fecha']=date('d');
       

        $this->load->view('reportes/cert_dep_rest',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('letter', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));         
        } else {
            redirect(base_url());
        }
    } 

    public function pdf_lista_asign($id=null)
    {

        $data['data_user'] = $this->db->query("SELECT p.*,c.*,u.* from persona p
LEFT JOIN
cargos c
on p.cargo_id=c.cargo_id
LEFT JOIN 
unidad u
on p.unidad_id=u.unidad_id
WHERE persona_id=$id")->row(); 
        $data['data_table_activos'] = $this->db->query("SELECT a.*,e.descripcion as est,d.*, (a.costo-(d.dep_dia)*DATEDIFF(now(),fecha_incorporacion)) as valor_actual from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id
                        LEFT JOIN
                        depreciacion d
                        on a.activo_id=d.activo_id
                                                LEFT JOIN
                                                asignacion s
                                                on a.activo_id=s.activo_id
         where a.activo!=0 and s.empleado_id=$id")->result(); 
        $data['fecha']=date('d');

        $this->load->view('reportes/cert_asignacion_user',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('letter', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
    } 

    public function fecha_actual(){
        date_default_timezone_set('America/La_Paz');
        // Define key-value array
        $days_dias = array(
        'Monday'=>'Lunes',
        'Tuesday'=>'Martes',
        'Wednesday'=>'Miércoles',
        'Thursday'=>'Jueves',
        'Friday'=>'Viernes',
        'Saturday'=>'Sábado',
        'Sunday'=>'Domingo'
        );
        $mes=date('F');

        if ($mes == "January") $mes = "Enero";
        if ($mes == "February") $mes = "Febrero";
        if ($mes == "March") $mes = "Marzo";
        if ($mes == "April") $mes = "Abril";
        if ($mes == "May") $mes = "Mayo";
        if ($mes == "June") $mes = "Junio";
        if ($mes == "July") $mes = "Julio";
        if ($mes == "August") $mes = "Agosto";
        if ($mes == "September") $mes = "Septiembre";
        if ($mes == "October") $mes = "Octubre";
        if ($mes == "November") $mes = "Noviembre";
        if ($mes == "December") $mes = "Diciembre";

        $data['dia']=date('d');
        $data['dia_l']=$days_dias[date('l')];
        $data['mes']=  date('m');
        $data['mes_l']= $mes;
        $data['anio']=date('Y');   

        $fecha = $days_dias[date('l')].' '.date('d').' de '.$mes.' de '.date('Y');   
        return $fecha;

    }

    //optimizacion de carga de los 1000 activos
       public function activosList()
    {

        $usuario_id= $this->session->userdata("usuario_id");
      
        $nombre_vista='vista_activos';

        $list = $this->activos->get_datatables($nombre_vista);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            /*<th>Nro</th>                                                
                                                <th>Codigo-SIAF</th> 
                                                <th>Fecha</th> 
                                                <th>Descripcion</th>
                                                <th>Costo</th>                                                
                                                <th>Estado</th>
                                                <th>Imagen</th>                                               
                                                <th></th> 
                                                <th>Acciones</th>*/
            // $row[] = $customers->activo_id;
            
            $row[] = $customers->codigo;
            $row[] = $customers->fecha_incorporacion;
              $row[] = $customers->auxiliar;
            $row[] = $customers->descripcion;
            
          
            $row[] = $customers->cantidad;
            $row[] = $customers->est;
            
            $rutaimagen=base_url().$customers->url.'/'.$customers->imagen;
            $row[] ='
              <div class="row el-element-overlay" >                                                             
                                                            <div class="col-lg-12 col-md-12" >
                                                                <div class="el-card-item">
                                                                    <div class="el-card-avatar el-overlay-1"> 
                                                                        <img src="'.$rutaimagen.'" alt="user" />
                                                                        <div class="el-overlay">
                                                                            <ul class="el-info">
                                                                                <li><a class="btn default btn-outline image-popup-vertical-fit" href="'.$rutaimagen.'" target="_blank"><i class="icon-magnifier"></i></a></li>              
                                                                            </ul>
                                                                        </div>
                                                                    </div>                                                                          
                                                                </div>
                                                            </div>
                                                        </div>

            ';

         
            // if (($customers->estado_act)==1){
            //     $row[] = '<div class="label label-table label-warning">En almacen</div>';
            // }
                
            
//             if (($customers->estado_act)==2){
//                  $row[] = '
//                 <a href="'.site_url("activos/desvincular").'/'.$customers->activo_id.'" class="desPersona btn-sm btn-danger btn" title="Eliminar" data-toggle="tooltip" id="desPersona">Desvincular </a>
//                   <script type="text/javascript">
//     $(".desPersona").on("click", function(e) {
//         e.preventDefault();
//         var url = $(this).attr("href");
//         Swal({
//         title: "Está seguro de Desvincular?",
//         text: "Se desvinculara el activo!",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor:"#d33",
//         cancelButtonColor: "#3085d6",
//         cancelButtonText: "Cancelar!",
//         confirmButtonText: "Si, Eliminar!"
//         }).then((result) => {
//             if (result.value) {
//                 window.location.replace(url);
//                 swal("Eliminado!", "Su información ha sido eliminada!", "success");
//             }else{
//                 swal("Cancelado", "Su información está a salvo!", "error");
//             }
//         });
//     });
// </script>
//                 ';               
//             }
             $row[] = '
            <a href="'.site_url("Activos/detalleActivos").'/'.$customers->activo_id.'" class="btn btn-info btn-sm" title="Activos" data-toggle="tooltip" > <i class="fas fa-info-circle"></i></a>

                                                
            ';
            
         

            $row[] = '
            <a href="'.site_url("Activos/editar").'/'.$customers->activo_id.'" class="btn btn-warning btn-sm" title="Editar" data-toggle="tooltip" > <i class="far fa-edit"></i></a>

                                                    <a href="'.site_url("Reportes/alta").'/'.$customers->activo_id.'" class="btn btn-success btn-sm" title="Reporte" data-toggle="tooltip"  target="_blank"><i class="fas fa-file-pdf"></i></a>
            ';
             if (($customers->estado_act)==1){
                $row[] = '
                <a href="'.site_url("Activos/delete").'/'.$customers->activo_id.'" class="eliminarPersona btn btn-danger btn-sm" title="Eliminar" data-toggle="tooltip" id="eliminarPersona"><i class="fa fa-trash"></i></a>
                  <script type="text/javascript">
    $(".eliminarPersona").on("click", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        Swal({
        title: "Está seguro?",
        text: "No podrá recuperar la información una vez sea eliminado!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor:"#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "Cancelar!",
        confirmButtonText: "Si, Eliminar!"
        }).then((result) => {
            if (result.value) {
                window.location.replace(url);
                swal("Eliminado!", "Su información ha sido eliminada!", "success");
            }else{
                swal("Cancelado", "Su información está a salvo!", "error");
            }
        });
    });
</script>
                ';

             } else{
                $row[] = '';
             }
                                                        
                                                     
            
          
           

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->activos->count_all($nombre_vista),
                        "recordsFiltered" => $this->activos->count_filtered($nombre_vista),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    } 

    // activos sin asignar

    public function activos_sa()
    {
        $data['data_table_activos'] = $this->db->query("SELECT a.*,e.descripcion as est 
from activos a
LEFT JOIN
estado e
on a.estado_id=e.estado_id
WHERE a.activo=1 
                                                
         ")->result(); 
        $data['firmas']=$this->db->query("SELECT f.firma_id,f.cargo as cargo_f,f.firma,f.nivel as nivel,CONCAT(p.grado,' ',p.nombres,' ',p.paterno,' ',p.materno) as nombre from firmas f
LEFT JOIN
persona p
on f.persona_id=p.persona_id
where f.activo=1 order by f.nivel")->result_array();

        $data['fecha']=$this->fecha_actual();
        $data['encabezado']=$this->db->query("SELECT * from encabezado where activo=1 and nivel=1")->row();
        //set_time_limit(-1);
        // $this->load->view('reportes/cert_listado',$data);
        $this->load->view('reportes/cert_sin_asignar',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->set_option('isRemoteEnabled', TRUE);   
        //numero de paginas
        $this->dompdf->set_option('isPhpEnabled', TRUE);
        $this->dompdf->setPaper('letter', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("listado_gral_activos_fijos.pdf", array("Attachment"=>0));
    }

    //combo listado auxiliares
    public function apiAuxiliares()
{   
    $grupoId=$this->input->post('grupoId');
    

    $contenido['datosAuxiliares'] = $this->Activos_model->getAuxiliarId($grupoId);

    $response=$this->load->view('activos/auxiliarList',$contenido,TRUE);    
    

    echo $response; 
    
}

    public function camposGrupo()
{   
    $grupoId=$this->input->post('grupoId');
    $response='';

    // $resultado= $this->Activos_model->getGrupoId($grupoId);
    
    $contenido['datosidgrupo'] = $grupoId;
    switch ($grupoId) {
    case 1:
            $response=$this->load->view('camposgrupo/ed',$contenido,TRUE);
        break;
    case 2:
            $response=$this->load->view('camposgrupo/me',$contenido,TRUE);
        break;
    case 8:
           $response=$this->load->view('camposgrupo/ve',$contenido,TRUE);
        break;
    case 15:
            $response=$this->load->view('camposgrupo/eqc',$contenido,TRUE);
        break;
    case 35:
            $response=$this->load->view('camposgrupo/ot',$contenido,TRUE);
        break;
    case 42:
           $response=$this->load->view('camposgrupo/eqo',$contenido,TRUE);
        break;
}
    
    

    echo $response; 
    
}

//cambio ubicacion del subactivo
public function editarSubactivo()
    {
        if ($this->session->userdata("login")) {

          $idsubactivo = $this->input->post('idsubactivo');

          $data['getOficinaList'] = $this->Activos_model->getOficinaList();       
          $data['DataSubactivo'] = $this->Activos_model->getDataCodAsign($idsubactivo); 
          $data['idsubactivo'] = $idsubactivo;
          $data['idactivo'] = $this->input->post('id_activo');

          $response=$this->load->view('activos/edicionSubactivo',$data,TRUE);
          echo $response;

        } else {
            redirect(base_url());
        }
    }
    //actualizacion del subactivo
public function updateSubactivos()
    {
        if ($this->session->userdata("login")) {

          $idactivo = $this->input->post('idactivo');

              $this->db->set('observaciones', $this->input->post('observaciones'));
           $this->db->set('oficina_id', $this->input->post('oficina'));
            $this->db->where('codigoAsign_id', $this->input->post('idsubactivo'));
            $this->db->update('actcodasign');  

              //generacion del qr            
                    $codigoAsignId = $this->input->post('idsubactivo');
                    $datos = $this->Asignacion_model->get_activo($codigoAsignId);
                    // var_dump($codigoAsignId);exit();
                    $codigoGen = $datos->codigoGen;                  
                    $estado_q = $datos->estado;                        
                    $descripcion_qr = strtoupper($datos->descripcion);
                    $responsable = 'NO ASIGNADO';  
                    $this->qrcodeGenerator($codigoAsignId,$codigoGen,$datos->codigoAsign,$datos->grupo,$datos->auxiliar,$descripcion_qr,$datos->oficina,$responsable,$estado_q);
                    //fin de qr        
            redirect(base_url() . 'activos/detalleActivos/'.$idactivo);

        } else {
            redirect(base_url());
        }
    }

        //combo listado auxiliares
    public function apiListadoActivos()
    {   
    $grupoId=$this->input->post('grupoId');
    

    $data['data_table_activos'] = $this->Activos_model->getActivosGrupo($grupoId); 

    $response=$this->load->view('activos/listadoActivosApi',$data,TRUE);    
    

    echo $response; 
    
    }






    


}


