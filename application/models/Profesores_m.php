<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profesores_m  extends CI_Model
{
    // leer clientes
    function __construct()
    {

        parent::__construct();
    }

    function get_profesores_cod($codigo = "*")
    {

        $this->db->like("Codigo", $codigo);
        $fila = $this->db->get("profesores");
        return $fila->result_array();
    }
    function get_profesores()
    {

        $query = $this->db->query("Select * from profesores order by 4;");
        return $query->result_array();
    }
    public function vaciar()
    {
        $this->db->truncate('profesores');
    }
    public function insertar($datos)
    {
        $this->db->insert('profesores', $datos);
    }
}
