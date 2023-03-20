<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargos_model extends CI_Model {

	public function __construct() {
        $this->load->database();
    }   
    function get_data_table() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * from cargos where activo=1');
        return $query->result();
    }
    function get_data_porid($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * FROM cargos
        WHERE cargo_id=$id");
        return $query->row();
    }
     function get_data_grupo() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * from unidad where activo=1');
        return $query->result();
    }

}
