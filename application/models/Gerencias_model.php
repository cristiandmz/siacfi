<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gerencias_model extends CI_Model {

	public function __construct() {
        $this->load->database();
    }   
    function get_data_table() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * from gerencia WHERE activo=1 ");
        return $query->result();
    }
    function get_data_porid($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT x.unidad_id,x.nombre_unidad,x.padre_id,y.nombre_unidad as padre_unidad,x.activo,x.nivel from unidad x
            LEFT JOIN  
            unidad y
            on x.padre_id=y.unidad_id
            WHERE x.activo=1 and x.unidad_id=$id");
        return $query->row();
    }
     function get_oficina() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * from oficina where activo=1');
        return $query->result();
    }

    function getDataGerencias($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * from gerencia where gerencia_id=$id");
        return $query->row();
    }

    function get_unidad($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * from oficina where oficina_id=$id");
        return $query->row();
    }
    // function get_oficina($id) {//obtiene los datos de la tabla tipo_documento en array result
    //     $query = $this->db->query("SELECT * from unidad where unidad_id=$id");
    //     return $query->row();
    // }
     function get_jefe($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT CONCAT(p.grado,' ', p.nombres,' ',p.paterno,' ',p.materno) as nombre,p.grado,u.encargado_id FROM unidad u
LEFT JOIN
persona p
on u.encargado_id=p.persona_id

WHERE u.unidad_id=$id");
        return $query->row();
    }
    function get_personal(){
        $query = $this->db->query("SELECT CONCAT( p.grado,' ',p.nombres,' ',p.paterno,' ',p.materno, ' -- ',c.descripcion) as nombre,p.grado,p.persona_id FROM 
persona p
LEFT JOIN 
cargos c
on p.cargo_id=c.cargo_id
WHERE p.activo=1 




");
        return $query->result();
    }
    function get_auxiliar($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT CONCAT(p.grado,' ', p.nombres,' ',p.paterno,' ',p.materno) as nombre,p.grado,u.auxiliar_id FROM unidad u
LEFT JOIN
persona p
on u.auxiliar_id=p.persona_id

WHERE u.unidad_id=$id");
        return $query->row();
    }


}
