<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materias_m  extends CI_Model  {
// leer clientes
function __construct() {

        parent::__construct();
    }

    public function get_materias()  {
        $query = $this->db->query("Select * from materias order by 1;");
        return $query->result_array();
    }
    public function vaciar(){
        $this->db->truncate('materias');
    }
    public function insertar($datos){
        $this->db->insert('materias', $datos);
    }
}