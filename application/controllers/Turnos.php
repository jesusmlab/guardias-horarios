<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Turnos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->load->model("horarios_m");
        //$this->load->model("profesores_m");
    }

    public function index()
    {
        $this->load->model("turnos_m");
        $this->load->model("profesores_m");
        $this->load->model("tramos_horarios_m");
        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores'] = $this->profesores_m->get_profesores();
        $datos['turnos'] = $this->turnos_m->get_turnos();
        $datos['contenido'] = "turnos_v";
        $datos['titulo'] = "Turnos";
        $this->load->view('plantilla/plantilla', $datos);
    }
    public function index_m()
    {
        $this->load->model("turnos_m");
        $this->load->model("profesores_m");
        $this->load->model("tramos_horarios_m");
        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores'] = $this->profesores_m->get_profesores();
        $datos['turnos'] = $this->turnos_m->get_turnos();
        $datos['contenido'] = "turnos_m_v";
        $datos['titulo'] = "Turnos";
        $this->load->view('plantilla/plantilla', $datos);
    }

    public function crear_turnos()
    {
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        //$this->output->enable_profiler(TRUE);
        if ($this->uri->segment(3) != "") {
            $this->cargar_turnos_hor($this->uri->segment(3));
            redirect("turnos");
        } else {
            $this->load->model("actividades_m");
            $datos['actividades'] = $this->actividades_m->get_actividades();
            $datos['contenido'] = "crear_turnos_v";
            $datos['titulo'] = "Crear Turnos";
            $this->load->view('plantilla/plantilla', $datos);
        }
    }

    private function cargar_turnos_hor($codg)
    {
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        $this->load->model("turnos_m");
        $this->load->model("horarios_m");
        $this->load->model("tramos_horarios_m");

        $horarios = $this->horarios_m->get_horarios();
        $tramos_horarios = $this->tramos_horarios_m->get_tramos();

        // vaciar tabla turnos
        $this->turnos_m->vaciar_turnos();

        foreach ($horarios as $hor) {
            if (intval($hor['Actividad']) == intval($codg)) {
                $indice = array_search($hor['Tramo'], array_column($tramos_horarios, 'Codigo'));
                //error_log($hor['Tramo']." ".$indice);
                if ($tramos_horarios[$indice]['Tramo'] < 8) {
                    $turno = [
                        "profesor" => $hor['CodigoProf'],
                        "dia" => $hor['DiaSem'],
                        "tramo" => $tramos_horarios[$indice]['Tramo'],
                        "turno" => 0
                    ];
                    $this->turnos_m->insertar_turnos($turno);
                }
            }
        }
        $this->renumerarTurnos();
    }
    public function renumerarTurnos()
    {
        $this->load->model("turnos_m");
        // renumerar los turnos por orden
        $turnos = $this->turnos_m->get_turnos_renum();
        // bucle por los turnos
        $diaback = $turnos[0]['dia'];
        $tramoback = $turnos[0]['tramo'];
        $contador = 1;
        foreach ($turnos as $turno) {
            if ($diaback != $turno['dia']) {
                $contador = 1;
                $diaback = $turno['dia'];
            }
            if ($tramoback != $turno['tramo']) {
                $contador = 1;
                $tramoback = $turno['tramo'];
            }
            $this->turnos_m->modificar_turnos($turno['id'], ['turno' => $contador]);
            $contador++;
        }
        //redirect($_SERVER['HTTP_REFERER']);
		redirect("turnos");
    }
    public function confirmar_correr_turnos()
    {
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        $this->load->model("config_m");
        $confApli = $this->config_m->get_config();
        $datos['ultFecha'] = $confApli[0]['fecha_ult_camb_turno'];
        $datos['contenido'] = "correr_turnos_v";
        $datos['titulo'] = "Correr Turnos";
        $this->load->view('plantilla/plantilla', $datos);
    }

    public function correr_turnos()
    {
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        $this->load->model("turnos_m");
        $this->load->model("config_m");
        // renumerar los turnos por orden
        $turnos = $this->turnos_m->get_turnos_desc();
        // bucle por los turnos
        $diaback = $turnos[0]['dia'];;
        $tramoback = $turnos[0]['tramo'];
        $contador = 1;
        $turnoAnt = 1;
        foreach ($turnos as $turno) {
            if ($diaback != $turno['dia']) {
                $contador = 1;
                $turnoAnt = $turno['turno'];
                $diaback = $turno['dia'];
            }
            if ($tramoback != $turno['tramo']) {
                $contador = 1;
                $turnoAnt = $turno['turno'];
                $tramoback = $turno['tramo'];
            }
            $this->turnos_m->modificar_turnos($turno['id'], ['turno' => $contador]);
            if ($contador == 1) {
                $contador = $turnoAnt;
            } else {
                $contador--;
            }
        }
        // actualizar fecha de correr turnos
        $fecha = date("Y-m-d");
        $datos = ["fecha_ult_camb_turno" => $fecha];
        $this->config_m->actualizar($datos);
        redirect("inicio");
    }
}
