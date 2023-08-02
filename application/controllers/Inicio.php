<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if (!isset($_SESSION['logueado'])){
            redirect(base_url()."login/index");
        }
        
        $this->load->helper("form");
        $this->load->model("faltas_m");
        $this->load->model("turnos_m");
        $this->load->model("profesores_m");
        $this->load->model("tramos_horarios_m");
        $this->load->model("registro_guardias_m");
        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores'] = $this->profesores_m->get_profesores();
        $datos['faltasDia'] = $this->faltas_m->get_faltas_dia();
        $datos['nfaltasDia'] = $this->faltas_m->contar_faltas_dia();
        $datos['profGuardias'] = $this->turnos_m->get_turnos_dia_new();
        $datos['registro'] = $this->registro_guardias_m->get_registro_guardias_dia();

        $datos['contenido'] = "inicio_v";
        $datos['titulo'] = "Inicio";
        $this->load->view('plantilla/plantilla', $datos);
    }
	 public function index_m($tramoAct=0)
    {
        if (!isset($_SESSION['logueado'])){
            redirect(base_url()."login/index");
        }
        
        $this->load->helper("form");
        $this->load->model("faltas_m");
        $this->load->model("turnos_m");
        $this->load->model("profesores_m");
        $this->load->model("tramos_horarios_m");
        $this->load->model("registro_guardias_m");
        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores'] = $this->profesores_m->get_profesores();
        $datos['faltasDia'] = $this->faltas_m->get_faltas_dia();
        $datos['nfaltasDia'] = $this->faltas_m->contar_faltas_dia();
        $datos['profGuardias'] = $this->turnos_m->get_turnos_dia_new();
        $datos['registro'] = $this->registro_guardias_m->get_registro_guardias_dia();

        $datos['contenido'] = "inicio_m_v";
        $datos['titulo'] = "Inicio";
        $this->load->view('plantilla/plantilla', $datos);
    }
    public function tvSala()
    {
        $this->load->helper("form");
        $this->load->model("faltas_m");
        $this->load->model("turnos_m");
        $this->load->model("profesores_m");
        $this->load->model("tramos_horarios_m");
        $this->load->model("registro_guardias_m");
        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores'] = $this->profesores_m->get_profesores();
        $datos['faltasDia'] = $this->faltas_m->get_faltas_dia();
        $datos['nfaltasDia'] = $this->faltas_m->contar_faltas_dia();
        $datos['profGuardias'] = $this->turnos_m->get_turnos_dia_new();
        $datos['registro'] = $this->registro_guardias_m->get_registro_guardias_dia();

        //$datos['contenido']="inicio_v";
        //$datos['titulo']="Inicio";
        $this->load->view('inicio_vtvSala', $datos);
    }
    public function tvSala_dia($fecha)
    {
        $this->load->helper("form");
        $this->load->model("faltas_m");
        $this->load->model("turnos_m");
        $this->load->model("profesores_m");
        $this->load->model("tramos_horarios_m");
        $this->load->model("registro_guardias_m");
        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores'] = $this->profesores_m->get_profesores();
        $datos['faltasDia'] = $this->faltas_m->get_faltas_dia($fecha);
        $datos['nfaltasDia'] = $this->faltas_m->contar_faltas_diasel($fecha);
        $datos['profGuardias'] = $this->turnos_m->get_turnos_dia_new($fecha);
        $datos['registro'] = $this->registro_guardias_m->get_registro_guardias_dia($fecha);

        //$datos['contenido']="inicio_v";
        //$datos['titulo']="Inicio";
        $this->load->view('inicio_vtvSala', $datos);
    }
    public function verdia($fecha)
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->helper("form");
        $this->load->model("faltas_m");
        $this->load->model("turnos_m");
        $this->load->model("profesores_m");
        $this->load->model("tramos_horarios_m");
        $this->load->model("registro_guardias_m");
        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores'] = $this->profesores_m->get_profesores();
        $datos['faltasDia'] = $this->faltas_m->get_faltas_diasel($fecha);
        $datos['nfaltasDia'] = $this->faltas_m->contar_faltas_diasel($fecha);
        $datos['profGuardias'] = $this->turnos_m->get_turnos_dia_new($fecha);
        $datos['registro'] = $this->registro_guardias_m->get_registro_guardias_dia($fecha);

        $datos['contenido'] = "inicio_v";
        $datos['titulo'] = "Inicio";
        $this->load->view('plantilla/plantilla', $datos);
    }
    function firmasGuardias($fecha)
    {
        // Obtener el HTML para crear PDF en content
        $this->load->model("profesores_m");
        $this->load->model("turnos_m");

        $datos['profGuardias'] = $this->turnos_m->get_turnos_dia_new($fecha);
        $datos['profesores'] = $this->profesores_m->get_profesores();

        $datos['contenido'] = "firmas_guardias_v";
        $datos['titulo'] = "Firmas Guardias";
        $this->load->view('plantilla/plantilla', $datos);
    }
}
