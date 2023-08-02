<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_m  extends CI_Model  {
// leer clientes
function __construct() {

        parent::__construct();
    }

    public function get_config()  {
        $query = $this->db->query("Select * from config where id=1;");
        return $query->result_array();
    }
    public function insertar($datos){
        $this->db->insert('config', $datos);
    }
    public function actualizar($datos){
        $this->db->where('id', 1);
        $this->db->update('config', $datos); 
    }
}