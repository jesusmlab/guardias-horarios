<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horarios extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		
		if (!isset($_SESSION['logueado'])){
            redirect(base_url()."login/index");
        }
		
        $this->load->model("horarios_m");
        $this->load->model("profesores_m");
		
    }

    public function index(){
        // Cargar Datos
        
        $datos['profesores']=$this->profesores_m->get_profesores();
        $datos['contenido']="horarios_v";
        $datos['titulo']="Horarios";
        $this->load->view('plantilla/plantilla',$datos);
    }
    public function index_m(){
        // Cargar Datos
        
        $datos['profesores']=$this->profesores_m->get_profesores();
        $datos['contenido']="horarios_m_v";
        $datos['titulo']="Horarios";
        $this->load->view('plantilla/plantilla',$datos);
    }
    public function mostrar($prof){
        // Cargar Datos
        $this->load->model("tramos_horarios_m");
        $datos['tramosHorarios']=$this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores']=$this->profesores_m->get_profesores();
        $datos['horario']=$this->horarios_m->get_horarios_prof($prof);
        $datos['estadisA']=$this->horarios_m->estadisActividad($prof);
        $datos['estadisM']=$this->horarios_m->estadisMateria($prof);
        $datos['contenido']="horarios_v";
        $datos['titulo']="Horarios";
        $this->load->view('plantilla/plantilla',$datos);
    }
    public function mostrar_grupo($grupo=""){
        // Cargar Datos
        $this->load->model("tramos_horarios_m");
        $this->load->model("grupos_m");
        $datos['tramosHorarios']=$this->tramos_horarios_m->get_consulta_tramos();
        $datos['grupos']=$this->grupos_m->get_grupos();
        $datos['horario']=$this->horarios_m->get_horarios_grupo($grupo);
        //$datos['estadisA']=$this->horarios_m->estadisActividad($prof);
        //$datos['estadisM']=$this->horarios_m->estadisMateria($prof);
        $datos['contenido']="horarios_g_v";
        $datos['titulo']="Horarios Grupo";
        $this->load->view('plantilla/plantilla',$datos);
    }
    public function mostrar_aula($aulacod=""){
        $aula=urldecode($aulacod);
        // Cargar Datos
        $this->load->model("tramos_horarios_m");
        $this->load->model("aulas_m");
        $datos['tramosHorarios']=$this->tramos_horarios_m->get_consulta_tramos();
        $datos['aulas']=$this->aulas_m->get_aulas();
        $datos['horario']=$this->horarios_m->get_horarios_aula($aula);
        //$datos['estadisA']=$this->horarios_m->estadisActividad($prof);
        //$datos['estadisM']=$this->horarios_m->estadisMateria($prof);
        $datos['contenido']="horarios_a_v";
        $datos['titulo']="Horarios Aula";
        $this->load->view('plantilla/plantilla',$datos);
    }
    public function mostrarman($prof=""){
        // Cargar Datos
        $this->load->model("tramos_horarios_m");
        $this->load->model("actividades_m");
        $this->load->model("aulas_m");
        $this->load->model("cursos_m");
        $this->load->model("materias_m");
        $this->load->model("grupos_m");
        $datos['tramosHorarios']=$this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores']=$this->profesores_m->get_profesores();
        $datos['horario']=$this->horarios_m->get_horarios_prof($prof);
        $datos['actividades']=$this->actividades_m->get_actividades_lista();
        $datos['aulas']=$this->aulas_m->get_aulas();
        $datos['cursos']=$this->cursos_m->get_cursos();
        $datos['materias']=$this->materias_m->get_materias();
        $datos['grupos']=$this->grupos_m->get_grupos();
        //$datos['contenido']="manhorarios_v";
        $datos['titulo']="Horarios";
        $this->load->view('plantilla/cabecera_ventana');
        $this->load->view('manhorarios_v',$datos);
    }
    public function mostrarman_g($grupo=""){
        // Cargar Datos
        $this->load->model("tramos_horarios_m");
        $this->load->model("actividades_m");
        $this->load->model("aulas_m");
        $this->load->model("cursos_m");
        $this->load->model("materias_m");
        $this->load->model("grupos_m");
        $datos['tramosHorarios']=$this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores']=$this->profesores_m->get_profesores();
        $datos['horario']=$this->horarios_m->get_horarios_grupo($grupo);
        $datos['actividades']=$this->actividades_m->get_actividades_lista();
        $datos['aulas']=$this->aulas_m->get_aulas();
        $datos['cursos']=$this->cursos_m->get_cursos();
        $datos['materias']=$this->materias_m->get_materias();
        $datos['grupos']=$this->grupos_m->get_grupos();
        //$datos['contenido']="manhorarios_v";
        $datos['titulo']="Horarios";
        $this->load->view('plantilla/cabecera_ventana');
        $this->load->view('manhorarios_g_v',$datos);
    }
    public function mostrar_ventana($prof){
        // Cargar Datos
        $this->load->model("tramos_horarios_m");
        $datos['tramosHorarios']=$this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores']=$this->profesores_m->get_profesores();
        $datos['horario']=$this->horarios_m->get_horarios_prof($prof);
        
        //$datos['contenido']="horarios_v";
        $datos['titulo']="Horarios";
        $this->load->view('plantilla/cabecera_ventana');
        $this->load->view('horarios_v',$datos);
    }
    public function movil($prof){
        // Cargar Datos
        $this->load->model("tramos_horarios_m");
        $datos['tramosHorarios']=$this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores']=$this->profesores_m->get_profesores();
        $datos['horario']=$this->horarios_m->get_horarios_prof($prof);
        $datos['contenido']="horarios_m_v";
        $datos['titulo']="Horarios Movil";
        $this->load->view('plantilla/plantilla',$datos);
    }
    public function turnos(){
        $this->load->model("turnos_m");
        $datos['tunos']=$this->turnos_m->get_turnos();
        $datos['contenido']="turnos_v";
        $datos['titulo']="Turnos";
        $this->load->view('plantilla/plantilla',$datos);
    }

    public function crear_turnos(){
        //$this->output->enable_profiler(TRUE);
        if ($this->uri->segment(3)!=""){
            $this->cargar_turnos_hor($this->uri->segment(3));
            redirect("horarios/turnos");
        } else {
        $this->load->model("actividades_m");
        $datos['actividades']=$this->actividades_m->get_actividades();
        $datos['contenido']="crear_turnos_v";
        $datos['titulo']="Crear Turnos";
        $this->load->view('plantilla/plantilla',$datos);
        }
    }

    private function cargar_turnos_hor($codg){
        $this->load->model("turnos_m");
        
        $horarios=$this->horarios_m->get_horarios();
        
        // vaciar tabla turnos
        $this->turnos_m->vaciar_turnos();

        foreach ($horarios as $hor){
            if (intval($hor['Actividad'])==intval($codg)) {
                $turno=["profesor" => $hor['CodigoProf'],
                    "dia" => $hor['DiaSem'],
                    "tramo" => $hor['Tramo'],
                    "turno" => 0];
                $this->turnos_m->insertar_turnos($turno);
            }
        }
    }
    public function manhorarios(){
        //Este metodo será llamado por AJAX. Envia todos los datos de una celda de horario
        //Tipo (Actividad,Materia,Curso,Aula), codigo Profesor, dia de la Semana y tramo Horario
        // Si se recibe una Actividad <> de la docente, se borran los datos de Materia,Curso,y Aula
        // Si el registro no existe, insertar.
        // Si existe, leer y cambiar el dato.
        // Si es para borrar, borrarlo
        
        if (isset($_REQUEST['datos'])){
            $datos=json_decode($_REQUEST['datos']);
            // leer codigo de tramo
            $this->load->model("tramos_horarios_m");
            $tramo=$this->tramos_horarios_m->get_tramo($datos->tramo);
            //$tramo=$datos->tramo;
			// Ver si el registro existe
            //$registro=$this->horarios_m->get_horario_prof_dia_tramo($datos->prof,$datos->diasem,$tramo->Codigo);
            $registro=$this->horarios_m->get_horario_prof_dia_tramo($datos->prof,$datos->diasem,$datos->tramo);
            
            if ($registro){
                // registro existe
                if ($datos->tipo=="Actividad" and $datos->codigo!="1"){
                    // Machacar actividad
                    $celda=array("$datos->tipo" => "$datos->codigo",
                                'Aula' => null,
                                'Unidad' => null,
                                'Curso' => null,
                                'Materia' => null);
                    //$this->horarios_m->actualizar($datos->prof,$datos->diasem,$tramo->Codigo,$celda);
					$this->horarios_m->actualizar($datos->prof,$datos->diasem,$datos->tramo,$celda);
                   echo "ok";
                } else {
                    // Si no es actividad
                    // Si la celda donde se quiere soltar es docente
                    if ($registro['Actividad']=="1") {
                        $celda=array("$datos->tipo" => "$datos->codigo");
                        // Si el tipo es grupo leer el Curso y Aula al que pertenece para ponerselo automaticamente
                        if ($datos->tipo=="Unidad"){
                            $this->load->model("grupos_m");
                            $grupo=$this->grupos_m->get_grupo_cod($datos->codigo);
                            $celda["Curso"]=$grupo['Curso'];
                            $celda["Aula"]=$grupo['Aula'];
                        }
                        $this->horarios_m->actualizar($datos->prof,$datos->diasem,$datos->tramo,$celda);
                        echo "ok";
                    } else {
                        echo "La actividad no es Docente";
                    }
                }

            } else {
                if ($datos->tipo!="Actividad"){
                    echo "Debe indicar primero la Actividad";
                    return;
                }
                // registro no existe, insertar
                $celda=array(   "CodigoProf" => $datos->prof,
                                "DiaSem" => $datos->diasem,
                                "Tramo" => $tramo[0]['Codigo'],
                                "$datos->tipo" => "$datos->codigo",
                                'Aula' => null,
                                'Unidad' => null,
                                'Curso' => null,
                                'Materia' => null,
                                "Hinicio" => $tramo[0]['Inicio'],
                                "Hfin" => $tramo[0]['Fin']);
                    $this->horarios_m->insertar($celda);
                   echo "ok";
            }
        }


    }

    public function manhorarios_g(){
        //Este metodo será llamado por AJAX. Envia todos los datos de una celda de horario
        //Tipo (Actividad,Materia,Curso,Aula), codigo Unidad (grupo), dia de la Semana y tramo Horario
        // Si se recibe una Actividad <> de la docente, se borran los datos de Materia,Curso,y Aula
        // Si el registro no existe, insertar.
        // Si existe, leer y cambiar el dato.
        // Si es para borrar, borrarlo
        
        if (isset($_REQUEST['datos'])){
            $this->load->model("grupos_m");
            $datos=json_decode($_REQUEST['datos']);
            // Ver si el registro existe
            $registro=$this->horarios_m->get_horario_grupo_dia_tramo($datos->grupo,$datos->diasem,$datos->tramo);
            if ($registro){
                // registro existe
                if ($datos->tipo=="Actividad" and $datos->codigo!="1"){
                    // Machacar actividad
                    
                    $grupo=$this->grupos_m->get_grupo_cod($datos->grupo);
                    $celda["Curso"]=$grupo['Curso'];
                    $celda["Aula"]=$grupo['Aula'];
                    $celda=array("$datos->tipo" => "$datos->codigo",
                                'Curso' => $grupo['Curso'],
                                'Aula' => $grupo['Aula'],
                                'Unidad' =>$datos->grupo,
                                'CodigoProf' => null,
                                'Materia' => null);
                    $this->horarios_m->actualizar_g($datos->grupo,$datos->diasem,$datos->tramo,$celda);
                   echo "ok";
                } else {
                    // Si no es actividad
                    // Si la celda donde se quiere soltar es docente
                    if ($registro['Actividad']=="1") {
                        $celda=array("$datos->tipo" => "$datos->codigo");
                        // Si el tipo es grupo leer el Curso y Aula al que pertenece para ponerselo automaticamente
                       
                            $grupo=$this->grupos_m->get_grupo_cod($datos->grupo);
                            $celda["Curso"]=$grupo['Curso'];
                            $celda["Aula"]=$grupo['Aula'];
                       
                        $this->horarios_m->actualizar_g($datos->grupo,$datos->diasem,$datos->tramo,$celda);
                        echo "ok";
                    } else {
                        echo "La actividad no es Docente";
                    }
                }

            } else {
                // No existe registro
                if ($datos->tipo!="Actividad"){
                    echo json_encode($registro);
                    echo "Debe indicar primero la Actividad";
                    return;
                }
                // registro no existe, insertar
                $celda=array(   "CodigoProf" => null,
                                "DiaSem" => $datos->diasem,
                                "Tramo" => $datos->tramo,
                                "$datos->tipo" => "$datos->codigo",
                                'Aula' => null,
                                'Unidad' => $datos->grupo,
                                'Curso' => null,
                                'Materia' => null);
                    $this->horarios_m->insertar($celda);
                   echo "ok";
            }
        }


    }

    public function generarhorario(){
        if (isset($_REQUEST['profesor'])){
            // Borrar horario
            $this->horarios_m->borrarhorarioprof($_REQUEST['profesor']);
            // Crear Horario vacio
            $this->load->model("tramos_horarios_m");
            $tramos=$this->tramos_horarios_m->get_tramos_j($_REQUEST['jornada']);
            for ($ind=1;$ind<6;$ind++){
                foreach($tramos as $tramo){
                    $datos=array("CodigoProf" => $_REQUEST['profesor'],
                            "DiaSem" => $ind,
                            "Tramo" => $tramo['Codigo'],
                            "Hinicio" => $tramo['Inicio'],
                            "Hfin" => $tramo['Fin'],
                            "Actividad" => $_REQUEST['actividad'],
                            "Unidad" => $_REQUEST['unidad'],
                            "Curso" => $_REQUEST['curso'],
                            "Materia" => $_REQUEST['materia'],
                            "Aula" => $_REQUEST['aula']);
                            
                            // Insertar en horarios
                $this->horarios_m->insertar($datos);
                }
            }
        }
        echo "ok";
    }
    public function vaciarcelda(){
        if (isset($_REQUEST['prof'])){
            //$this->load->model("tramos_horarios_m");
            //$tramo=$this->tramos_horarios_m->get_tramo($_REQUEST['tramo']);
            // Borrar horario
            $this->horarios_m->borrar($_REQUEST['prof'],$_REQUEST['diasem'],$_REQUEST['tramo']); 
            echo "ok";
        }
        
    }
    public function vaciarcelda_g(){
        if (isset($_REQUEST['grupo'])){
            $this->load->model("tramos_horarios_m");
            $tramo=$this->tramos_horarios_m->get_tramo_tramo($_REQUEST['tramo']);
            // Borrar horario
            $this->horarios_m->borrar_g($_REQUEST['grupo'],$_REQUEST['diasem'],$tramo->Codigo); 
            echo "ok";
        }
        
    }
    public function cambiocelda(){
        // Intercambiar celda AJAX
        if (isset($_REQUEST['idorigen']) and isset($_REQUEST['iddestino'])) {
            $filaOrigen=$this->horarios_m->get_horarios_id($_REQUEST['idorigen']);
            $filaDestino=$this->horarios_m->get_horarios_id($_REQUEST['iddestino']);
            //Salvar campos del destino
            //$copiaDestino = $filaDestino->getArrayCopy();
            $copiaDestino = $filaDestino;
            // Igualar campos destino
            $filaDestino['DiaSem']=$filaOrigen['DiaSem'];
            $filaDestino['Tramo']=$filaOrigen['Tramo'];
            $filaDestino['Hinicio']=$filaOrigen['Hinicio'];
            $filaDestino['Hfin']=$filaOrigen['Hfin'];
            /* $filaDestino['Aula']=$filaOrigen['Aula'];
            $filaDestino['Unidad']=$filaOrigen['Unidad'];
            $filaDestino['Curso']=$filaOrigen['Curso'];
            $filaDestino['Materia']=$filaOrigen['Materia'];
            $filaDestino['Actividad']=$filaOrigen['Actividad']; */
            // Igualar campos de fila Origen con los que tenia el destino
            $filaOrigen['DiaSem']=$copiaDestino['DiaSem'];
            $filaOrigen['Tramo']=$copiaDestino['Tramo'];
            $filaOrigen['Hinicio']=$copiaDestino['Hinicio'];
            $filaOrigen['Hfin']=$copiaDestino['Hfin'];
            /* $filaOrigen['Aula']=$copiaDestino['Aula'];
            $filaOrigen['Unidad']=$copiaDestino['Unidad'];
            $filaOrigen['Curso']=$copiaDestino['Curso'];
            $filaOrigen['Materia']=$copiaDestino['Materia'];
            $filaOrigen['Actividad']=$copiaDestino['Actividad']; */
            // Actualizar  ambas filas
            $this->horarios_m->acthorarios($filaOrigen);
            $this->horarios_m->acthorarios($filaDestino);
            echo "ok";
        }

    }
    public function cambioAula(){
        // Intercambiar celda AJAX
        if (isset($_REQUEST['grupo']) and isset($_REQUEST['origen']) and isset($_REQUEST['destino'])) {
            $this->horarios_m->cambiarAula($_REQUEST['grupo'],$_REQUEST['origen'],$_REQUEST['destino']);
            echo "ok";
        }

    }
}