<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oficina_model extends CI_Model {

	public function __construct() {
        $this->load->database();
    }   
    function get_data_table() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * FROM oficina WHERE activo=1");
        return $query->result();
    }
    function get_data_porid($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * FROM oficina WHERE oficina_id=$id");
        return $query->row();
    }
    

    
    


}
