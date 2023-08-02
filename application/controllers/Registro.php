<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $datos['contenido']="subirfichero_v";
        $datos['titulo']="Tablas Auxiliares";
        $this->load->view('plantilla/plantilla',$datos);
       
    }
    public function insertar(){
        if (isset($_SESSION['logueado']) && $_SESSION['roll']=="admin")
            {
            $this->load->model("registro_guardias_m");
            // Comprobar si ya existe la inserción
            $apunte=$this->registro_guardias_m->get_registro_guardias_pdt($_REQUEST['profesor'],$_REQUEST['fecha'],$_REQUEST['tramo']); 
            if (isset($apunte)){
                return "ko";
            } else {
            // Si no insertar
                $datos=["Fecha"=>$_REQUEST['fecha'],
                "Profesor"=>$_REQUEST['profesor'],
                "Dia"=>$_REQUEST['dia'],
                "Tramo"=>$_REQUEST['tramo']
                ];
                $this->registro_guardias_m->insertar($datos);
                echo "ok";
            }
        } else { echo "No permitido"; }
	}
}