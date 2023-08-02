<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guardias_m  extends CI_Model  {
// leer clientes
function __construct() {

        parent::__construct();
    }

    public function get_clasificacion_guardias()  {
        $query = $this->db->query("Select * from consulta_clasificacion_guardias;");
        return $query->result_array();
    }
   
}