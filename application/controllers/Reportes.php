<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        $this->load->model("Activos_model");
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

    public function pdf_asignacion_oficinas()
    {
        $id=$this->input->post('oficina');
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
        $this->dompdf->setPaper('letter', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("listado_".$unidad.".pdf", array("Attachment"=>0));
    } 

    public function alta($id=null)
    {
        $data['tabla'] = $this->db->query("SELECT a.*,e.descripcion as estado,g.nombre as grupo,s.nombre as auxiliar,c.sucursal,DATE(a.fecha_creacion) as fecha_asign  from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id
            LEFT JOIN grupo g
            on g.grupo_id=a.grupo_id
            LEFT JOIN
            auxiliar s
            on s.auxiliar_id=a.auxiliar_id
            LEFT JOIN
            sucursal c
            on c.sucursal_id=a.sucursal_id
            where a.activo_id=$id")->row();

        $data['subActivos'] = $this->db->query("SELECT b.*,o.oficina FROM activos a
            LEFT JOIN 
            actcodasign b
            on 
            a.activo_id=b.activo_id
            LEFT JOIN 
            oficina o
            on 
            b.oficina_id=o.oficina_id
            WHERE a.activo_id=$id")->result();

        // $data['fecha']=$this->fecha_actual();
        $codigoAsign=$data['tabla'];
          $fecha_asign=$codigoAsign->fecha_asign;
        $codigoAsign=$codigoAsign->codigo;
    
        $res = preg_replace('/[\/\;]+/', '_', $codigoAsign);
        
        $nombrePdf= $fecha_asign.'_'.$res; 
        $data['fecha']=date('d').'-'.date('m').'-'.date('Y');
        $data['firmas']=$this->db->query("SELECT f.firma_id,f.cargo as cargo_f,f.firma,f.nivel as nivel,CONCAT(p.nombres,' ',p.paterno,' ',p.materno) as nombre from firmas f
            LEFT JOIN
            persona p
            on f.persona_id=p.persona_id
            where f.activo=1 order by f.nivel")->result_array();

        $data['encabezado']=$this->db->query("SELECT * from encabezado where encabezado_id=2")->row();

        // set_time_limit(-1);
        $this->load->view('reportes/cert_alta_pdf',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->setPaper('letter', 'portrait');
        $this->dompdf->set_option('isRemoteEnabled', TRUE);  
        //numero de paginas
        $this->dompdf->set_option('isPhpEnabled', TRUE); 
        $this->dompdf->render();
        $this->dompdf->stream($nombrePdf, array("Attachment"=>0));
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

    public function actaAsignacion($id=null)
    {
        $data['tabla'] = $this->db->query("SELECT s.codigoAsign,a.*,o.oficina,u.nombre as auxiliar,e.descripcion as estado,g.nombre as grupo,s.observaciones as obsubactivo,DATE(d.fecha_creacion) as fecha_asign FROM detalle_asignacion d
            LEFT JOIN 
            actcodasign s 
            on d.codigoAsign_id=s.codigoAsign_id 
            LEFT JOIN 
            activos a 
            on d.activo_id=a.activo_id
            LEFT JOIN 
            oficina o
            on s.oficina_id=o.oficina_id
            LEFT JOIN 
            auxiliar u
            on a.auxiliar_id=u.auxiliar_id
            LEFT JOIN 
            grupo g
            on a.grupo_id=g.grupo_id
            LEFT JOIN 
            estado e
            on e.estado_id=a.estado_id
            where d.detalle_id=$id")->row();      

             // nombre del pdf
        $codigoAsign=$data['tabla'];
        // var_dump($codigoAsign->codigoAsign);exit();
        $fecha_asign=$codigoAsign->fecha_asign;
        $codigoAsign=$codigoAsign->codigoAsign;
        
        $res = preg_replace('/[\/\;]+/', '_', $codigoAsign);
        // echo $res;exit();
    
             // $nombrePdf= date('Y').'_'.date('m').'_'.date('d').'_'.$res; 
        $nombrePdf= $fecha_asign.'_'.$res; 
             // var_dump($fecha_asign);exit();


        $data['empleado'] = $this->db->query("SELECT CONCAT( y.nombres,' ',y.paterno,' ',y.materno) as empleado,x.fecha_asign,c.descripcion as cargo from asignacion x
            LEFT JOIN
            persona y
            on y.persona_id=x.empleado_id
            
            LEFT JOIN
            cargos c
            on y.cargo_id=c.cargo_id
            LEFT JOIN
            detalle_asignacion d
            on x.asignacion_id=d.asignacion_id
            WHERE d.detalle_id=$id")->row();

        // $data['fecha']=$this->fecha_actual();
        $data['fecha']=date('d').'-'.date('m').'-'.date('Y');

       

        $data['encabezado']=$this->db->query("SELECT * from encabezado where activo=1 and nivel=1")->row();

        $data['firmas']=$this->db->query("SELECT f.firma_id,f.cargo as cargo_f,f.firma,f.nivel as nivel,CONCAT(p.nombres,' ',p.paterno,' ',p.materno) as nombre from firmas f
            LEFT JOIN
            persona p
            on f.persona_id=p.persona_id
            where f.activo=1 order by f.nivel")->result_array();
        //set_time_limit(-1);
        // var_dump($data['tabla']);exit();
        $this->load->view('reportes/certAsignacion',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->set_option('isRemoteEnabled', TRUE); 

        //numero de paginas
        $this->dompdf->set_option('isPhpEnabled', TRUE);        

        $this->dompdf->setPaper('letter', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream($nombrePdf, array("Attachment"=>0));
    }

    public function actaDevolucion($detalledev_id=null)
    {
        $data['tabla'] = $this->db->query("SELECT s.codigoAsign,a.*,o.oficina,u.nombre as auxiliar,e.descripcion as estado,g.nombre as grupo,s.observaciones as obsubactivo,y.observacion,DATE(d.fecha_creacion) as fecha_asign FROM             
            detalle_devolucion d
            LEFT JOIN 
            devolucion y
            on d.devolucion_id=y.devolucion_id
            LEFT JOIN
            actcodasign s 
            on d.codigoAsign_id=s.codigoAsign_id 
            LEFT JOIN 
            activos a 
            on d.activo_id=a.activo_id
            LEFT JOIN 
            oficina o
            on s.oficina_id=o.oficina_id
            LEFT JOIN 
            auxiliar u
            on a.auxiliar_id=u.auxiliar_id
            LEFT JOIN 
            grupo g
            on a.grupo_id=g.grupo_id
            LEFT JOIN 
            estado e
            on e.estado_id=a.estado_id
            where d.detalledev_id=$detalledev_id")->row();        

        $data['empleado'] = $this->db->query("SELECT CONCAT( y.nombres,' ',y.paterno,' ',y.materno) as empleado,c.descripcion as cargo from devolucion x
            LEFT JOIN
            persona y
            on y.persona_id=x.empleado_id
            
            LEFT JOIN
            cargos c
            on y.cargo_id=c.cargo_id
            LEFT JOIN
            detalle_devolucion d
            on x.devolucion_id=d.devolucion_id

            WHERE d.detalledev_id=$detalledev_id")->row();

        // $data['fecha']=$this->fecha_actual();

        $codigoAsign=$data['tabla'];
        $fecha_asign=$codigoAsign->fecha_asign;
        $codigoAsign=$codigoAsign->codigoAsign;
        
        $res = preg_replace('/[\/\;]+/', '_', $codigoAsign);
        
        $nombrePdf= $fecha_asign.'_'.$res; 
        $data['fecha']=date('d').'-'.date('m').'-'.date('Y');
        $data['encabezado']=$this->db->query("SELECT * from encabezado where activo=1 and nivel=1")->row();

        $data['firmas']=$this->db->query("SELECT f.firma_id,f.cargo as cargo_f,f.firma,f.nivel as nivel,CONCAT(p.nombres,' ',p.paterno,' ',p.materno) as nombre from firmas f
            LEFT JOIN
            persona p
            on f.persona_id=p.persona_id
            where f.activo=1 order by f.nivel")->result_array();
        //set_time_limit(-1);
        // var_dump($data['tabla']);exit();
        $this->load->view('reportes/certDevolucion',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->set_option('isRemoteEnabled', TRUE); 

        //numero de paginas
        $this->dompdf->set_option('isPhpEnabled', TRUE);        

        $this->dompdf->setPaper('letter', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream($nombrePdf, array("Attachment"=>0));
    }
    

    public function listadoActivos()
    {

        $id=$this->input->post('grupo_id');

        if ($id=='todos') {
            $data['nombregrupo']="";
        $data['datosListaActivos'] = $this->db->query("
            SELECT a.*,b.*,o.oficina,k.nombre as auxiliar,e.descripcion as estado,CASE WHEN p.nombres is NULL THEN
            'No asignado'
            ELSE
            CONCAT(p.nombres,' ',p.paterno,' ',p.materno)
            END  as nombre FROM activos a
            LEFT JOIN 
            actcodasign b
            on 
            a.activo_id=b.activo_id
            LEFT JOIN 
            oficina o
            on 
            b.oficina_id=o.oficina_id
            LEFT JOIN 
            estado e
            on 
            a.estado_id=e.estado_id
            LEFT JOIN 
            auxiliar k
            on 
            k.auxiliar_id=a.auxiliar_id
            LEFT JOIN
            (SELECT d.codigoAsign_id,a.empleado_id FROM
                asignacion a
                LEFT JOIN
                detalle_asignacion d
                on a.asignacion_id=d.asignacion_id
                WHERE a.activo=1) as g
            on b.codigoAsign_id=g.codigoAsign_id
            LEFT JOIN
            persona p
            on g.empleado_id=p.persona_id
            WHERE a.activo=1
            ")->result(); 
        }else{
            $gruponombre=$this->Activos_model->getGrupoId($id); 
            $data['nombregrupo']='DEL GRUPO: '.$gruponombre->nombre;
        $data['datosListaActivos'] = $this->db->query("
            SELECT a.*,b.*,o.oficina,k.nombre as auxiliar,e.descripcion as estado,CASE WHEN p.nombres is NULL THEN
            'No asignado'
            ELSE
            CONCAT(p.nombres,' ',p.paterno,' ',p.materno)
            END  as nombre FROM activos a
            LEFT JOIN 
            actcodasign b
            on 
            a.activo_id=b.activo_id
            LEFT JOIN 
            oficina o
            on 
            b.oficina_id=o.oficina_id
            LEFT JOIN 
            estado e
            on 
            a.estado_id=e.estado_id
            LEFT JOIN 
            auxiliar k
            on 
            k.auxiliar_id=a.auxiliar_id
            LEFT JOIN
            (SELECT d.codigoAsign_id,a.empleado_id FROM
                asignacion a
                LEFT JOIN
                detalle_asignacion d
                on a.asignacion_id=d.asignacion_id
                WHERE a.activo=1) as g
            on b.codigoAsign_id=g.codigoAsign_id
            LEFT JOIN
            persona p
            on g.empleado_id=p.persona_id
            WHERE a.activo=1 and a.grupo_id=$id
            ")->result(); 
        }


        $data['firmas']=$this->db->query("SELECT f.firma_id,f.cargo as cargo_f,f.firma,f.nivel as nivel,CONCAT(p.nombres,' ',p.paterno,' ',p.materno) as nombre from firmas f
            LEFT JOIN
            persona p
            on f.persona_id=p.persona_id
            where f.activo=1 order by f.nivel")->result_array();

        $data['fecha']=$this->fecha_actual();
        $data['encabezado']=$this->db->query("SELECT * from encabezado where activo=1 and nivel=1")->row();
        //set_time_limit(-1);
        $this->load->view('reportes/cert_listadoActivos',$data);
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

    public function asignados($id=null)
    {
        $data['datosListaAsignados'] = $this->db->query("
            SELECT a.*,b.*,o.oficina,k.nombre as auxiliar,e.descripcion as estado,CASE WHEN p.nombres is NULL THEN
            'No asignado'
            ELSE
            CONCAT(p.nombres,' ',p.paterno,' ',p.materno)
            END  as nombre FROM activos a
            LEFT JOIN 
            actcodasign b
            on 
            a.activo_id=b.activo_id
            LEFT JOIN 
            oficina o
            on 
            b.oficina_id=o.oficina_id
            LEFT JOIN 
            estado e
            on 
            a.estado_id=e.estado_id
            LEFT JOIN 
            auxiliar k
            on 
            k.auxiliar_id=a.auxiliar_id
            LEFT JOIN
            (SELECT d.codigoAsign_id,a.empleado_id FROM
                asignacion a
                LEFT JOIN
                detalle_asignacion d
                on a.asignacion_id=d.asignacion_id
                WHERE a.activo=1) as g
            on b.codigoAsign_id=g.codigoAsign_id
            LEFT JOIN
            persona p
            on g.empleado_id=p.persona_id
            WHERE a.activo=1 and b.asignado=2")->result(); 

        $data['firmas']=$this->db->query("SELECT f.firma_id,f.cargo as cargo_f,f.firma,f.nivel as nivel,CONCAT(p.nombres,' ',p.paterno,' ',p.materno) as nombre from firmas f
            LEFT JOIN
            persona p
            on f.persona_id=p.persona_id
            where f.activo=1 order by f.nivel")->result_array();
        $data['fecha']=$this->fecha_actual();

        $data['encabezado']=$this->db->query("SELECT * from encabezado where activo=1 and nivel=1")->row();

        //set_time_limit(-1);
        $this->load->view('reportes/cert_ActivosAsignados',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->set_option('isRemoteEnabled', TRUE);
        //numero de paginas   
        $this->dompdf->set_option('isPhpEnabled', TRUE);
        $this->dompdf->setPaper('letter', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("listado_asignaciones.pdf", array("Attachment"=>0));
    }

    public function etiquetasQr()
    {
        $oficina=$this->input->post('oficina');
        $valores=array();
        $cantidad=array();
        $codigo=array();

        // var_dump($this->input->post('total'));exit();
        $total=$this->input->post('total');
         for ($i=0; $i <$total ; $i++) { 
            $datoact=$this->input->post('a'.$i);
            if (isset($datoact)) {
                $cant=$this->input->post('c'.$i);
                $codigos=$this->input->post('code'.$i);
                for ($j=0; $j <$cant ; $j++) {                     
                    array_push($valores, $datoact);
                    array_push($codigo, $codigos);
                }
                
                array_push($cantidad, $cant);
                
            }             
         }
         // var_dump($cantidad);
         // exit();
       
        $data['cantidad'] = $cantidad;
        $data['dta'] = $valores;
        $data['codigos'] = $codigo;

        $data['fecha']=$this->fecha_actual();
        $data['oficina']=$oficina;

        $data['encabezado']=$this->db->query("SELECT * from encabezado where activo=1 and nivel=1")->row();
        //set_time_limit(-1);
        $this->load->view('reportes/etiquetasQrCarta',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->set_option('isRemoteEnabled', TRUE);  
        //numero de paginas
        $this->dompdf->set_option('isPhpEnabled', TRUE);


        $this->dompdf->setPaper('letter', 'portrait');
        // $this->dompdf->setPaper(array(0,0,315,621), 'portrait');
        // $this->dompdf->setPaper(array(0,0,213,600), 'portrait');

        $this->dompdf->render();
        $this->dompdf->stream("etiquetas_qr.pdf", array("Attachment"=>0));
    }
     public function listadoQr()
    {
        $id=$this->input->post('oficina_id');

        if ($id=='todos') {
            // redirect(base_url());

            echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";

        }

        $data['dta'] = $this->db->query("SELECT a.*,b.*,o.oficina,k.nombre as auxiliar,e.descripcion as estado FROM activos a
            LEFT JOIN 
            actcodasign b
            on 
            a.activo_id=b.activo_id
            LEFT JOIN 
            oficina o
            on 
            b.oficina_id=o.oficina_id
            LEFT JOIN 
            estado e
            on 
            a.estado_id=e.estado_id
            LEFT JOIN 
            auxiliar k
            on 
            k.auxiliar_id=a.auxiliar_id
          
           
            WHERE a.activo=1 and b.oficina_id=$id")->result_array(); 

        $data['fecha']=$this->fecha_actual();
        $data['oficina']=$this->db->query("SELECT * from oficina where oficina_id=$id")->row();

        $data['encabezado']=$this->db->query("SELECT * from encabezado where activo=1 and nivel=1")->row();


        //set_time_limit(-1);
        $this->load->view('reportes/etiquetasQrCartaAll',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->set_option('isRemoteEnabled', TRUE);  
        //numero de paginas
        $this->dompdf->set_option('isPhpEnabled', TRUE);


        $this->dompdf->setPaper('letter', 'portrait');
        // $this->dompdf->setPaper(array(0,0,315,621), 'portrait');
        // $this->dompdf->setPaper(array(0,0,213,600), 'portrait');

        $this->dompdf->render();
        $this->dompdf->stream("etiquetas_qr.pdf", array("Attachment"=>0));
    }

    public function etiquetasQr_old()
    {
        $id=$this->input->post('oficina');

        $data['data_table_activos'] = $this->db->query("SELECT a.*,b.*,o.oficina,k.nombre as auxiliar,e.descripcion as estado,CASE WHEN p.nombres is NULL THEN
            'No asignado'
            ELSE
            CONCAT(p.nombres,' ',p.paterno,' ',p.materno)
            END  as nombre FROM activos a
            LEFT JOIN 
            actcodasign b
            on 
            a.activo_id=b.activo_id
            LEFT JOIN 
            oficina o
            on 
            b.oficina_id=o.oficina_id
            LEFT JOIN 
            estado e
            on 
            a.estado_id=e.estado_id
            LEFT JOIN 
            auxiliar k
            on 
            k.auxiliar_id=a.auxiliar_id
            LEFT JOIN
            (SELECT d.codigoAsign_id,a.empleado_id FROM
                asignacion a
                LEFT JOIN
                detalle_asignacion d
                on a.asignacion_id=d.asignacion_id
                WHERE a.activo=1) as g
            on b.codigoAsign_id=g.codigoAsign_id
            LEFT JOIN
            persona p
            on g.empleado_id=p.persona_id
            WHERE a.activo=1 and b.oficina_id=$id")->result(); 

        $data['fecha']=$this->fecha_actual();
        $data['oficina']=$this->db->query("SELECT * from oficina where oficina_id=$id")->row();

        $data['encabezado']=$this->db->query("SELECT * from encabezado where activo=1 and nivel=1")->row();


        //set_time_limit(-1);
        $this->load->view('reportes/etiquetas_qr',$data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html,'UTF-8');
        $this->dompdf->set_option('isRemoteEnabled', TRUE);  
        //numero de paginas
        $this->dompdf->set_option('isPhpEnabled', TRUE);


        //$this->dompdf->setPaper('letter', 'portrait');
        // $this->dompdf->setPaper(array(0,0,315,621), 'portrait');
        $this->dompdf->setPaper(array(0,0,213,600), 'portrait');

        $this->dompdf->render();
        $this->dompdf->stream("etiquetas_qr.pdf", array("Attachment"=>0));
    }

     public function grupo()
    {
        if ($this->session->userdata("login")) {  
            $data['grupos'] = $this->Activos_model->get_data_grupo(); 
            $this->load->view('datatable/header');
            $this->load->view('admin/menu');
            $this->load->view('reportes/listadogrupos',$data);
            // $this->load->view('datatable/footer');            
        } else {
            redirect(base_url());
        }
    }
    







}


