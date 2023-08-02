<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividades_m  extends CI_Model  {
// leer clientes
function __construct() {

        parent::__construct();
    }

    public function get_actividades()  {
        $query = $this->db->query("Select * from actividades order by 1;");
        return $query->result_array();
    }
    public function get_actividades_lista()  {
        $query = $this->db->query("Select * from actividades where Mostrar_en_listas = True order by 1;");
        return $query->result_array();
    }
    public function vaciar(){
        $this->db->truncate('actividades');
    }
    public function insertar($datos){
        $this->db->insert('actividades', $datos);
    }
}