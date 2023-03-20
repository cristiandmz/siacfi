<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct() {
        $this->load->database();
    }   

     function get_rest_count($dias) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT COUNT(depreciacion_id)  as total FROM depreciacion
            WHERE DATEDIFF(fecha_fin,now())=$dias");
        return $query->row();
    }

    function get_count_act() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT COUNT(activo_id) as total FROM activos
WHERE activo!=0
");
        return $query->row();
    }

    function get_count_asign() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT COUNT(asignacion_id) as total FROM asignacion
WHERE activo=1
");
        return $query->row();
    }

     function get_count_pers() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT COUNT(persona_id) as total FROM persona
WHERE activo=1
");
        return $query->row();
    }

}
