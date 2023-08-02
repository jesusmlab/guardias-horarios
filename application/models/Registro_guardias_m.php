<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_guardias_m  extends CI_Model  {
// leer clientes
function __construct() {

        parent::__construct();
    }

    public function get_registro_guardias()  {
        $query = $this->db->query("Select * from registro_guardias order by 1;");
        return $query->result_array();
    }
    public function get_registro_guardias_dia($fecha="")  {
        if ($fecha==""){
            $fecha=date("Y-m-d");
        }
        $query = $this->db->query("Select * from registro_guardias where Fecha='$fecha' order by 1,4;");
        return $query->result_array();
    }
    public function vaciar(){
        $this->db->truncate('registro_guardias');
    }
    public function insertar($datos){
        $this->db->insert('registro_guardias', $datos);
    }
    public function get_registro_guardias_pdt($prof,$dia,$tramo)  {
    
        $this->db->where("Profesor",$prof);
        $this->db->where("Fecha",$dia);
        $this->db->where("Tramo",$tramo);
        $fila=$this->db->get("registro_guardias");
        return $fila->row_array();
    }
}