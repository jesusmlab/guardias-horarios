<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turnos_m  extends CI_Model  {
    
    function __construct() {

        parent::__construct();
    }

    public function get_turnos()  {
        $query = $this->db->query("Select * from turnos where tramo<8 order by 2,3,1;");
        return $query->result_array();
    }
    public function get_turnos_renum()  {
        $query = $this->db->query("Select * from turnos where tramo<8 order by 2,3,4;");
        return $query->result_array();
    }
    public function get_turnos_desc()  {
        $query = $this->db->query("Select * from turnos where tramo<8 order by 2,3 ASC,4 DESC;");
        return $query->result_array();
    }
    public function get_turnos_dia($fecha="")  {
        if ($fecha==""){
            $fecha=date("Y-m-d");
        }
        $dia=getdate(strtotime($fecha))['wday'];
        $query = $this->db->query("Select * from turnos where dia=$dia and tramo<8 order by 2,3,4;");
        return $query->result_array();
    }
    public function get_turnos_dia_new($fecha="")  {
        if ($fecha==""){
            $fecha=date("Y-m-d");
        }
        $dia=getdate(strtotime($fecha))['wday'];
        $query = $this->db->query("select turnos.dia,turnos.tramo,turnos.profesor,turno,if(nguardias is null, 0, nguardias) as nguardias from turnos left join consulta_reguard on turnos.dia=consulta_reguard.dia and turnos.tramo=consulta_reguard.tramo and turnos.profesor=consulta_reguard.profesor where turnos.dia=$dia and turnos.tramo<8 order by 1,2,5,4;");
        return $query->result_array();
    }

    public function vaciar_turnos(){
        $this->db->truncate('turnos');
    }

    public function insertar_turnos($datos){
   
        $this->db->insert('turnos', $datos);

    }
    public function modificar_turnos($id,$datos){
   
        $this->db->where('id', $id);
        $this->db->update('turnos', $datos); 
    }

}