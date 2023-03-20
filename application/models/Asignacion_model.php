<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignacion_model extends CI_Model {

	public function __construct() {
        $this->load->database();
    }   
    function get_data_table() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT x.asignacion_id,y.persona_id,y.nombres,y.paterno,y.materno,x.fecha_asign from asignacion x
            LEFT JOIN
            persona y
            on y.persona_id=x.empleado_id
            WHERE x.activo=1
            ');
        return $query->result();
        
    }
    function get_data_porid($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT x.asignacion_id,y.persona_id, CONCAT(y.nombres,' ',y.paterno,' ',y.materno) as nombre from asignacion x
            LEFT JOIN
            persona y
            on y.persona_id=x.empleado_id                        
            WHERE x.asignacion_id=$id");
        return $query->row();
    }
    function get_data_activo() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * from actcodasign ');
        return $query->result();
    }
    
    function get_data_persona() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM persona WHERE activo=1');
        return $query->result();
    }

       function get_idpersona($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT x.*,y.persona_id, CONCAT(y.nombres,' ',y.paterno,' ',y.materno) as nombre from asignacion x
            LEFT JOIN
            persona y
            on y.persona_id=x.empleado_id                        
            WHERE x.activo=1 and y.persona_id=$id");
        return $query->result();
    }

    function getDetalleAsignacion($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT s.codigoAsign,d.codigoAsign_id,d.detalle_id,a.*,o.oficina,u.nombre as auxiliar FROM detalle_asignacion d
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

    function get_activo($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT x.*,a.*,e.descripcion as estado,g.nombre as grupo,r.nombre as auxiliar,o.oficina FROM activos a
LEFT JOIN 
estado e
on a.estado_id=e.estado_id
LEFT JOIN 
grupo g
on a.grupo_id=g.grupo_id
LEFT JOIN 
auxiliar r
on a.auxiliar_id=r.auxiliar_id
LEFT JOIN 
actcodasign x
on a.activo_id=x.activo_id
LEFT JOIN 
oficina o
on x.oficina_id=o.oficina_id
WHERE codigoAsign_id=$id");
        return $query->row();
    }

    function get_empleado($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT CONCAT(y.nombres,' ',y.paterno,' ',y.materno) as nombre FROM
persona y

 WHERE y.persona_id=$id");
        return $query->row();
    }
    function get_asignacion($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * FROM asignacion WHERE asignacion_id=$id");
        return $query->row();
    }

    function getIdActivo($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * from actcodasign where codigoAsign_id=$id");
        return $query->row();
    }
    //para la regeneracion de los qr
    function getActivosList() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * from actcodasign where activo=1 and asignado=1');
        return $query->result_array();
    }
    function getActivosAsignadosList() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM detalle_asignacion  WHERE activo=1');
        return $query->result_array();
    }
    function getActivosAsignadosDato($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT k.empleado_id,y.*,CONCAT(p.nombres,' ',p.paterno,' ',p.materno) as nombres,e.descripcion as estado,g.nombre as grupo,r.nombre as auxiliar,o.oficina,a.descripcion,x.codigoAsign,x.codigoGen  FROM
asignacion k
LEFT JOIN 
detalle_asignacion y
on k.asignacion_id=y.asignacion_id
LEFT JOIN
actcodasign x
on x.codigoAsign_id=y.codigoAsign_id
LEFT JOIN
activos a
on x.activo_id=a.activo_id
LEFT JOIN 
estado e
on a.estado_id=e.estado_id
LEFT JOIN 
grupo g
on a.grupo_id=g.grupo_id
LEFT JOIN 
auxiliar r
on a.auxiliar_id=r.auxiliar_id
LEFT JOIN 
oficina o
on x.oficina_id=o.oficina_id
LEFT JOIN
persona p
on p.persona_id=k.empleado_id
WHERE k.activo=1 and y.activo=1 and x.codigoAsign_id=$id");
        return $query->row();
    }
}
