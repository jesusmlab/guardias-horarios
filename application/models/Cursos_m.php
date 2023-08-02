<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos_m  extends CI_Model  {
// leer clientes
function __construct() {

        parent::__construct();
    }

    public function get_cursos()  {
        $query = $this->db->query("Select * from cursos order by 1;");
        return $query->result_array();
    }
    public function vaciar(){
        $this->db->truncate('cursos');
    }
    public function insertar($datos){
        $this->db->insert('cursos', $datos);
    }
}