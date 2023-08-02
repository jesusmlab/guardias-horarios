<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aulas_m  extends CI_Model  {
// leer clientes
function __construct() {

        parent::__construct();
    }

    public function get_aulas()  {
        $query = $this->db->query("Select * from dependencias order by 1;");
        return $query->result_array();
    }
    public function vaciar(){
        $this->db->truncate('dependencias');
    }
    public function insertar($datos){
        $this->db->insert('dependencias', $datos);
    }
}