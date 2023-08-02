<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Causas_m  extends CI_Model  {
// leer clientes
function __construct() {

        parent::__construct();
    }

    public function get_causas()  {
        $query = $this->db->query("Select * from causas order by 1;");
        return $query->result_array();
    }
    public function vaciar(){
        $this->db->truncate('causas');
    }
    public function insertar($datos){
        $this->db->insert('causas', $datos);
    }
}