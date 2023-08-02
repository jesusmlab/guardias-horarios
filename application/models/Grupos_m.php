<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos_m  extends CI_Model  {
// leer clientes
function __construct() {

        parent::__construct();
    }

    public function get_grupos()  {
        $query = $this->db->query("Select * from unidades order by Codigo;");
        return $query->result_array();
    }
    function get_grupo_cod($codigo) {

        $this->db->where("Codigo",$codigo);
        $fila=$this->db->get("unidades");
        return $fila->row_array();
    }
    public function vaciar(){
        $this->db->truncate('unidades');
    }
    public function insertar($datos){
        $this->db->insert('unidades', $datos);
    }
}