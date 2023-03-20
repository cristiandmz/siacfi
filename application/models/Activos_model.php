<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activos_model extends CI_Model {

	public function __construct() {
        $this->load->database();
    }   
    function get_data_table() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * from activos');
        return $query->result();
    }

     function crear_vista() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("CREATE OR REPLACE VIEW vista_activos AS SELECT a.*,a.activo as estado_act,e.descripcion as est from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id                    
         where a.activo!=0");
    }
    function get_data_porid($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT y.nombre as grupo,z.nombre as auxiliar,e.descripcion as estado,o.oficina,x.*,s.sucursal FROM activos x
            LEFT JOIN
            grupo y
            on x.grupo_id=y.grupo_id
            left JOIN
            auxiliar z
            on x.auxiliar_id=z.auxiliar_id
                        LEFT JOIN
                        estado e
                        on x.estado_id=e.estado_id
            LEFT JOIN
                        oficina o
                        on x.oficina_id=o.oficina_id
                          LEFT JOIN
                        sucursal s
                        on s.sucursal_id=x.sucursal_id
            WHERE x.activo_id=$id");
        return $query->row();
    }
    function get_data_grupo() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM grupo WHERE activo=1 order by nombre asc');
        return $query->result();
    }
    function get_data_auxiliar() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM auxiliar WHERE activo=1 order by nombre asc');
        return $query->result();
    }
    function getAuxiliarId($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * FROM auxiliar WHERE activo=1 and grupo_id=$id order by nombre asc");
        return $query->result();
    }
    function getGrupoId($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * FROM grupo WHERE activo=1 and grupo_id=$id order by nombre asc");
        return $query->row();
    }
     function getOficinaList() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM oficina WHERE activo=1 ');
        return $query->result();
    }

     function getSucList() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * FROM sucursal WHERE activo=1 ');
        return $query->result();
    }

    function get_data_activos() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT a.*,e.descripcion as estado_act from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id
         where a.activo=1 or a.activo=2');
        return $query->result();
    }
    function get_data_inactivos() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT x.activo_id,x.descripcion,x.codigo,y.motivo,y.fecha_baja from activos x 
            left JOIN
            bajas y
            on x.activo_id=y.activo_id
            WHERE x.activo=0
            ');
        return $query->result();
    }
     function get_data_almacen() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * from activos where activo=2');
        return $query->result();
    }
     function get_data_estado() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT * from estado');
        return $query->result();
    }

    function get_activos_depreciacion() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT a.*,a.activo as estado_act,e.descripcion as est from activos a
            LEFT JOIN
            estado e
            on a.estado_id=e.estado_id
                    
         where a.activo!=0');
        return $query->result();
    }
    function get_unidades() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('SELECT DISTINCT( u.unidad_id) ,u.nombre_unidad FROM
persona p
left JOIN
unidad u
on p.unidad_id=u.unidad_id
JOIN
(SELECT * FROM asignacion WHERE activo=1) as a
on p.persona_id=a.empleado_id

');
        return $query->result();
    }
    function get_oficinas() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query('

SELECT o.* FROM
oficina o
LEFT JOIN
(SELECT DISTINCT u.padre_id FROM
unidad u
JOIN
(SELECT DISTINCT p.unidad_id FROM
persona p
LEFT JOIN
(SELECT * FROM asignacion WHERE activo=1) as a
on p.persona_id=a.empleado_id) as x
on x.unidad_id=u.unidad_id
WHERE u.activo=1) f
on f.padre_id=o.oficina_id
WHERE o.activo=1

');
        return $query->result();
    }
    function get_firmas() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT f.firma_id,f.cargo as cargo_f,f.firma,f.nivel as nivel,CONCAT(p.nombres,' ',p.paterno,' ',p.materno) as nombre from firmas f
LEFT JOIN
persona p
on f.persona_id=p.persona_id
where f.activo=1");
        return $query->result_array();
    }

    function get_detalle_firma($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT f.firma_id,f.cargo as cargo_f,f.firma,f.nivel as nivel,f.persona_id,CONCAT(p.nombres,' ',p.paterno,' ',p.materno) as nombre from firmas f
LEFT JOIN
persona p
on f.persona_id=p.persona_id
where f.firma_id=$id");
        return $query->row();
    }

    function get_encabezado() {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * from encabezado f where activo=1 and nivel=1");
        return $query->row();
    }

    function get_detalle_encabezado($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT * from encabezado f where encabezado_id=$id");
        return $query->row();
    }

    function get_personas(){
        $query = $this->db->query("SELECT p.persona_id,CONCAT(p.nombres,' ',p.paterno,' ',p.materno) as nombres from persona p where p.activo=1");
        return $query->result();
    }

    function getActviIdUser($id){
        $query = $this->db->query("SELECT * from activos where activo=1 and usu_creacion=$id order by activo_id desc limit 1");
        return $query->row();
    }

    function getSucId($id){
        $query = $this->db->query("SELECT * from sucursal where sucursal_id=$id ");
        return $query->row();
    }

     function getCodAsignId($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT o.*,x.oficina FROM actcodasign o
            LEFT JOIN
            oficina x 
            on 
            o.oficina_id=x.oficina_id           
            WHERE o.activo_id=$id");
        return $query->result();
    }

    function getDataCodAsign($id){
        $query = $this->db->query("SELECT * from actcodasign where codigoAsign_id=$id ");
        return $query->row();
    }
    function getListaActivos($id) {//obtiene los datos de la tabla tipo_documento en array result
        $query = $this->db->query("SELECT a.activo_id,s.*,o.oficina FROM activos a
LEFT JOIN 
actcodasign s
on a.activo_id=s.activo_id
LEFT JOIN
oficina o
on s.oficina_id=o.oficina_id
WHERE a.auxiliar_id=$id and s.asignado=1");
        return $query->result();
    }

    //conteo para los activos
    function getConteoActivos($id){
        $query = $this->db->query("SELECT COUNT(activo_id) as conteo FROM
activos
WHERE grupo_id=$id ");
        return $query->row();
    }

     function getDataOficina($id){
        $query = $this->db->query("SELECT * from oficina where oficina_id=$id");
        return $query->row();
    }

     function getActivosOficina($id){
        $query = $this->db->query("SELECT b.*,a.codigoAsign,a.codigoAsign_id,c.nombre as producto FROM  actcodasign a
LEFT JOIN 
activos  b
on a.activo_id=b.activo_id
LEFT JOIN
auxiliar c
on b.auxiliar_id=c.auxiliar_id
WHERE a.activo=1 and b.activo=1 and a.oficina_id=$id");
        return $query->result_array();
    }

    function getActivosTodos($id){
        $query = $this->db->query("SELECT b.*,a.codigoAsign,a.codigoAsign_id,c.nombre as producto FROM  actcodasign a
LEFT JOIN 
activos  b
on a.activo_id=b.activo_id
LEFT JOIN
auxiliar c
on b.auxiliar_id=c.auxiliar_id
WHERE a.activo=1 and b.activo=1 ");
        return $query->result_array();
    }

     function getActivosGrupo($id){
        $query = $this->db->query("SELECT a.activo_id AS activo_id,a.codigo AS codigo,a.descripcion AS descripcion,a.activo AS activo,a.costo AS costo,a.auxiliar_id AS auxiliar_id,a.grupo_id AS grupo_id,a.fecha_incorporacion AS fecha_incorporacion,a.estado_id AS estado_id,a.observaciones AS observaciones,a.imagen AS imagen,a.url AS url,a.usu_creacion AS usu_creacion,a.usu_modificacion AS usu_modificacion,a.usu_eliminacion AS usu_eliminacion,a.fecha_creacion AS fecha_creacion,a.fecha_modificacion AS fecha_modificacion,a.fecha_eliminacion AS fecha_eliminacion,a.asignado AS estado_act,e.descripcion AS est, o.oficina,a.cantidad,x.nombre as auxiliar from 
activos a 
left join estado e 
on
a.estado_id = e.estado_id
left join oficina o 
on
a.oficina_id = o.oficina_id
left join auxiliar x 
on
a.auxiliar_id = x.auxiliar_id

where a.activo!=0 and a.grupo_id=$id");
        return $query->result();
    }

}
