<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personas_model extends CI_Model {

	public function __construct() {
        $this->load->database();
    }   
    function get_data_table() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT p.persona_id,p.nombres,p.paterno,p.materno,p.ci,p.fec_nacimiento,p.fec_incorporacion,p.cargo_id,p.activo,r.rol,g.usuario,g.activo,c.descripcion as cargo,r.rol, g.activo as validar,e.gerencia,p.codAsignGer from persona p
                        LEFT JOIN
                        credencial g
                        on g.persona_id=p.persona_id
                         LEFT JOIN
                        cargos c
                        on c.cargo_id=p.cargo_id
                        LEFT JOIN
                        gerencia e
                        on e.gerencia_id=p.gerencia_id

                        LEFT JOIN rol r
                        on r.rol_id=g.rol_id WHERE p.activo=1
            ");
        return $query->result();
    }
    function get_data_porid($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT p.*,g.descripcion,o.gerencia,r.rol,r.rol_id,c.img FROM
            persona p
            LEFT JOIN
            cargos g
            on p.cargo_id=g.cargo_id
            LEFT JOIN
            gerencia o
            on p.gerencia_id=o.gerencia_id
                        LEFT JOIN
                        credencial c
                        on c.persona_id=p.persona_id
                        left JOIN
                        rol r
                        on c.rol_id=r.rol_id                        
            WHERE p.persona_id=$id");
        return $query->row();
    }
    function get_data_cargo() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * from cargos WHERE activo=1');
        return $query->result();
    }
    function get_data_unidad() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM unidad WHERE activo=1');
        return $query->result();
    }

    function getRol() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM rol WHERE activo=1');
        return $query->result();
    }

    function getOficinas() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM oficina WHERE activo=1');
        return $query->result();
    }
    function getSucursal() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM sucursal WHERE activo=1');
        return $query->result();
    }
    function getGerencias() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM gerencia WHERE activo=1');
        return $query->result();
    }
    function getUltimoId($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * FROM persona WHERE user_creacion=$id");
        return $query->result();
    }

    function getCodGerencia($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * FROM gerencia WHERE gerencia_id=$id");
        return $query->row();
    }

    function getConteo($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT COUNT(persona_id) as total FROM persona WHERE gerencia_id=$id and activo=1");
        return $query->row();
    }
}
