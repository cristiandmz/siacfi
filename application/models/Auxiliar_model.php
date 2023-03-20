<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auxiliar_model extends CI_Model {

	public function __construct() {
        $this->load->database();
    }   
    function get_data_table() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT x.auxiliar_id,x.nombre as auxiliar,y.grupo_id,y.nombre as grupo ,x.activo  FROM auxiliar x
            LEFT JOIN
            grupo y
            on x.grupo_id=y.grupo_id WHERE x.activo=1 order  by y.grupo_id');
        return $query->result();
    }
    function get_data_porid($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT x.auxiliar_id,x.nombre as auxiliar,y.grupo_id,y.nombre as grupo FROM auxiliar x
            LEFT JOIN
            grupo y
            on x.grupo_id=y.grupo_id
            WHERE auxiliar_id=$id");
        return $query->row();
    }
     function get_data_grupo() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM grupo WHERE activo=1 order by nombre asc');
        return $query->result();
    }

}
