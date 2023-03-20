<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devolucion_model extends CI_Model {

	public function __construct() {
        $this->load->database();
    }   
    function get_data_table() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT x.asignacion_id,y.persona_id,CONCAT(y.nombres,' ',y.paterno,' ',y.materno) as nombre,x.fecha_asign,x.activo from asignacion x
            LEFT JOIN
            persona y
            on y.persona_id=x.empleado_id            
            WHERE x.activo=1");
        return $query->result();
    }
    function get_data_porid($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT x.asignacion_id,y.persona_id,CONCAT(y.nombres,' ',y.paterno,' ',y.materno) as nombre,x.fecha_asign,x.activo from asignacion x
            LEFT JOIN
            persona y
            on y.persona_id=x.empleado_id            
            WHERE x.asignacion_id=$id");
        return $query->row();
    }
    function get_data_activo() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * from activos WHERE activo=1');
        return $query->result();
    }
    function get_data_persona() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM persona WHERE activo=1');
        return $query->result();
    }

    function get_data_histo() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT x.devolucion_id,x.asignacion_id,y.persona_id,CONCAT(y.nombres,' ',y.paterno,' ',y.materno)as nombre,x.motivo,x.activo,x.fecha_devolucion from devolucion x
            LEFT JOIN
            persona y
            on y.persona_id=x.empleado_id            
            WHERE x.activo=1
            ");
        return $query->result();
    }
    function getDetalleAsignacion($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT s.codigoAsign,a.*,o.oficina,u.nombre as auxiliar FROM detalle_asignacion d
LEFT JOIN 
actcodasign s 
on d.codigoAsign_id=s.codigoAsign_id 
LEFT JOIN 
activos a 
on s.activo_id=a.activo_id
LEFT JOIN 
oficina o
on s.oficina_id=o.oficina_id
LEFT JOIN 
auxiliar u
on a.auxiliar_id=u.auxiliar_id
where d.asignacion_id=$id and d.activo=1");
        return $query->result();
    }
     function getDetalleAsignacionID($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * FROM detalle_asignacion d where d.detalle_id=$id");
        return $query->row();
    }

    function getDetalleDevolucion($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT s.codigoAsign,d.detalledev_id,d.codigoAsign_id,d.devolucion_id,a.*,o.oficina,u.nombre as auxiliar FROM detalle_devolucion d
LEFT JOIN 
actcodasign s 
on d.codigoAsign_id=s.codigoAsign_id 
LEFT JOIN 
activos a 
on s.activo_id=a.activo_id
LEFT JOIN 
oficina o
on s.oficina_id=o.oficina_id
LEFT JOIN 
auxiliar u
on a.auxiliar_id=u.auxiliar_id
where d.devolucion_id=$id ");
        return $query->result();
    }
    function getMotivos() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * FROM motivos ");
        return $query->result();
    }
}
