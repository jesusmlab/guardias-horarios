<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tramos_horarios_m  extends CI_Model
{
    // leer clientes
    function __construct()
    {

        parent::__construct();
    }

    public function get_tramos()
    {
        $query = $this->db->query("Select * from tramos_horarios order by Codigo;");
        return $query->result_array();
    }
    public function get_tramos_j($jornada)
    {
        $query = $this->db->query("Select * from tramos_horarios where Jornada='" . $jornada . "' order by Codigo;");
        return $query->result_array();
    }
    public function get_tramo($tramo)
    {
        $query = $this->db->query("Select * from tramos_horarios where Codigo='" . $tramo . "';");
        return $query->result_array();
    }
    public function get_tramo_tramo($tramo)
    {
        $query = $this->db->query("Select * from tramos_horarios where Tramo='" . $tramo . "';");
        return $query->row();
    }
    public function get_consulta_tramos()
    {
        $query = $this->db->query("Select * from consulta_tramos_horarios;");
        return $query->result_array();
    }
    public function vaciar()
    {
        $this->db->truncate('tramos_horarios');
    }
    public function insertar($datos)
    {
        $this->db->insert('tramos_horarios', $datos);
    }
}
