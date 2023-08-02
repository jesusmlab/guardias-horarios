<?php
class Imppdf extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
    }
    function index()
    {
        $datos['contenido'] = "verpdfs_v";
        $datos['titulo'] = "Ver PDFS";
        $this->load->view('plantilla/plantilla', $datos);
    }
    function impHprofes()
    {
        // Obtener el HTML para crear PDF en content
        $this->load->model("horarios_m");
        $this->load->model("profesores_m");
        $this->load->model("tramos_horarios_m");

        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores'] = $this->profesores_m->get_profesores();

        $this->load->library('Pdf');

        foreach ($datos['profesores'] as $profe) {
            $datos['horario'] = $this->horarios_m->get_horarios_prof($profe['Codigo']);
            if (isset($datos['horario'])) {
                $datos['estadisA'] = $this->horarios_m->estadisActividad($profe['Codigo']);
                $datos['estadisM'] = $this->horarios_m->estadisMateria($profe['Codigo']);
                $datos['prof_corr'] = $profe['Codigo'];
                ob_start();
                //$this->load->view('plantilla/cabecera_ventana');
                $this->load->view('pdf/horarios_v_pdf', $datos);
                $content = ob_get_clean();
                try {

                    $pdf = new Pdf('L', "mm", 'A4', true, 'UTF-8', false);
                    $pdf->SetFont('', '', 10, '', 'false');
                    $pdf->SetTitle('Horarios de Profesores');
                    // remove default header/footer 
                    $pdf->setPrintHeader(false);
                    $pdf->setPrintFooter(false);
                    $pdf->SetAutoPageBreak(true);
                    $pdf->SetMargins(5, 5, 0, true);
                    $pdf->SetAuthor('JML');
                    $pdf->SetDisplayMode('real', 'default');
                    $pdf->AddPage('L');
                    //$pdf->Write(5, 'CodeIgniter TCPDF Integration');

                    // convert
                    $pdf->writeHTML($content, false);
                    $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'guardias/pdf/profesores/horario' . $profe['Codigo'] . '-' . $profe['Apellido1'] . '_' . $profe['Apellido2'] . '_' . $profe['Nombre'] . '.pdf', 'F');
                } catch (\Throwable $e) {
                    echo $e;
                    exit;
                }
            }
        }
        redirect(base_url() . "imppdf");
    }

    function impHgrupos()
    {
        // Obtener el HTML para crear PDF en content
        $this->load->model("horarios_m");
        $this->load->model("grupos_m");
        $this->load->model("tramos_horarios_m");
        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['grupos'] = $this->grupos_m->get_grupos();

        $this->load->library('Pdf');

        foreach ($datos['grupos'] as $grupo) {
            $datos['horario'] = $this->horarios_m->get_horarios_grupo($grupo['Descripcion']);
            if (isset($datos['horario'])) {
                //$datos['estadisA']=$this->horarios_m->estadisActividad($profe['Codigo']);
                $datos['estadisM'] = $this->horarios_m->estadisMateriaGrupos($grupo['Descripcion']);
                $datos['grupo_corr'] = $grupo['Descripcion'];
                ob_start();
                //$this->load->view('plantilla/cabecera_ventana');
                $this->load->view('pdf/horarios_g_v_pdf', $datos);
                $content = ob_get_clean();
                try {

                    $pdf = new Pdf('L', "mm", 'A4', true, 'UTF-8', false);
                    $pdf->SetFont('', '', 10, '', 'false');
                    $pdf->SetTitle('Horarios de Grupos');
                    // remove default header/footer 
                    $pdf->setPrintHeader(false);
                    $pdf->setPrintFooter(false);
                    $pdf->SetAutoPageBreak(true);
                    $pdf->SetMargins(5, 5, 0, true);
                    $pdf->SetAuthor('JML');
                    $pdf->SetDisplayMode('real', 'default');
                    $pdf->AddPage('L');
                    //$pdf->Write(5, 'CodeIgniter TCPDF Integration');

                    // convert
                    $pdf->writeHTML($content, false);
                    $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'guardias/pdf/grupos/horario' . $grupo['Descripcion'] . '.pdf', 'F');
                } catch (\Throwable $e) {
                    echo $e;
                    exit;
                }
            }
        }
        redirect(base_url() . "imppdf");
    }
    function impHaulas()
    {
        // Obtener el HTML para crear PDF en content
        $this->load->model("horarios_m");
        $this->load->model("aulas_m");
        $this->load->model("tramos_horarios_m");
        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['aulas'] = $this->aulas_m->get_aulas();

        $this->load->library('Pdf');

        foreach ($datos['aulas'] as $aula) {
            $datos['horario'] = $this->horarios_m->get_horarios_aula($aula['Descripcion']);
            if (isset($datos['horario'])) {

                $datos['aula_corr'] = $aula['Descripcion'];
                ob_start();
                //$this->load->view('plantilla/cabecera_ventana');
                $this->load->view('pdf/horarios_a_v_pdf', $datos);
                $content = ob_get_clean();
                try {

                    $pdf = new Pdf('L', "mm", 'A4', true, 'UTF-8', false);
                    $pdf->SetFont('', '', 10, '', 'false');
                    $pdf->SetTitle('Horarios de Grupos');
                    // remove default header/footer 
                    $pdf->setPrintHeader(false);
                    $pdf->setPrintFooter(false);
                    $pdf->SetAutoPageBreak(true);
                    $pdf->SetMargins(5, 5, 0, true);
                    $pdf->SetAuthor('JML');
                    $pdf->SetDisplayMode('real', 'default');
                    $pdf->AddPage('L');
                    //$pdf->Write(5, 'CodeIgniter TCPDF Integration');

                    // convert
                    $pdf->writeHTML($content, false);
                    $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'guardias/pdf/aulas/horario' . $aula['Descripcion'] . '.pdf', 'F');
                } catch (\Throwable $e) {
                    echo $e;
                    exit;
                }
            }
        }
        redirect(base_url() . "imppdf");
    }
    function impHprofesTodo()
    {
        // Obtener el HTML para crear PDF en content
        $this->load->model("horarios_m");
        $this->load->model("profesores_m");
        $this->load->model("tramos_horarios_m");

        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['profesores'] = $this->profesores_m->get_profesores();
        $this->load->library('Pdf');
        $pdf = new Pdf('L', "mm", 'A4', true, 'UTF-8', false);
        $pdf->SetFont('', '', 10, '', 'false');
        $pdf->SetTitle('Horarios de Profesores');
        // remove default header/footer 
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetMargins(5, 5, 0, true);
        $pdf->SetAuthor('JML');
        $pdf->SetDisplayMode('real', 'default');
        foreach ($datos['profesores'] as $profe) {
            $datos['horario'] = $this->horarios_m->get_horarios_prof($profe['Codigo']);
            if (isset($datos['horario'])) {
                $datos['estadisA'] = $this->horarios_m->estadisActividad($profe['Codigo']);
                $datos['estadisM'] = $this->horarios_m->estadisMateria($profe['Codigo']);
                $datos['prof_corr'] = $profe['Codigo'];
                ob_start();
                //$this->load->view('plantilla/cabecera_ventana');
                $this->load->view('pdf/horarios_v_pdf', $datos);
                $content = ob_get_clean();
                try {

                    $pdf->AddPage('L');
                    // convert
                    $pdf->writeHTML($content, false);
                } catch (\Throwable $e) {
                    echo $e;
                    exit;
                }
            }
        }
        $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'guardias/pdf/profesores/horariosTodosProfesores.pdf', 'F');
        redirect(base_url() . "imppdf");
    }
    function impHgruposTodo()
    {
        // Obtener el HTML para crear PDF en content
        $this->load->model("horarios_m");
        $this->load->model("grupos_m");
        $this->load->model("tramos_horarios_m");
        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['grupos'] = $this->grupos_m->get_grupos();
        $this->load->library('Pdf');
        $pdf = new Pdf('L', "mm", 'A4', true, 'UTF-8', false);
        $pdf->SetFont('', '', 10, '', 'false');
        $pdf->SetTitle('Horarios de Grupos');
        // remove default header/footer 
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetMargins(5, 5, 0, true);
        $pdf->SetAuthor('JML');
        $pdf->SetDisplayMode('real', 'default');
        foreach ($datos['grupos'] as $grupo) {
            $datos['horario'] = $this->horarios_m->get_horarios_grupo($grupo['Descripcion']);
            if (isset($datos['horario'])) {
                //$datos['estadisA']=$this->horarios_m->estadisActividad($profe['Codigo']);
                $datos['estadisM'] = $this->horarios_m->estadisMateriaGrupos($grupo['Descripcion']);
                $datos['grupo_corr'] = $grupo['Descripcion'];
                ob_start();
                //$this->load->view('plantilla/cabecera_ventana');
                $this->load->view('pdf/horarios_g_v_pdf', $datos);
                $content = ob_get_clean();
                try {

                    $pdf->AddPage('L');

                    // convert
                    $pdf->writeHTML($content, false);
                } catch (\Throwable $e) {
                    echo $e;
                    exit;
                }
            }
        }
        $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'guardias/pdf/grupos/horariosTodosGrupos.pdf', 'F');
        redirect(base_url() . "imppdf");
    }
    function impHaulasTodo()
    {
        // Obtener el HTML para crear PDF en content
        $this->load->model("horarios_m");
        $this->load->model("aulas_m");
        $this->load->model("tramos_horarios_m");
        $datos['tramosHorarios'] = $this->tramos_horarios_m->get_consulta_tramos();
        $datos['aulas'] = $this->aulas_m->get_aulas();
        $this->load->library('Pdf');
        $pdf = new Pdf('L', "mm", 'A4', true, 'UTF-8', false);
        $pdf->SetFont('', '', 10, '', 'false');
        $pdf->SetTitle('Horarios de Aulas');
        // remove default header/footer 
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetMargins(5, 5, 0, true);
        $pdf->SetAuthor('JML');
        $pdf->SetDisplayMode('real', 'default');
        foreach ($datos['aulas'] as $aula) {
            $datos['horario'] = $this->horarios_m->get_horarios_aula($aula['Descripcion']);
            if (isset($datos['horario'])) {
                $datos['aula_corr'] = $aula['Descripcion'];
                ob_start();
                //$this->load->view('plantilla/cabecera_ventana');
                $this->load->view('pdf/horarios_a_v_pdf', $datos);
                $content = ob_get_clean();
                try {

                    $pdf->AddPage('L');

                    // convert
                    $pdf->writeHTML($content, false);
                } catch (\Throwable $e) {
                    echo $e;
                    exit;
                }
            }
        }
        $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'guardias/pdf/aulas/horariosTodosAulas.pdf', 'F');
        redirect(base_url() . "imppdf");
    }

    function pruebafirmas($fecha)
    {
        // Obtener el HTML para crear PDF en content
        $this->load->model("profesores_m");
        $this->load->model("turnos_m");

        $datos['profGuardias'] = $this->turnos_m->get_turnos_dia_new($fecha);
        $datos['profesores'] = $this->profesores_m->get_profesores();
        $this->load->view('pdf/firmas_guardias_v_pdf', $datos);
    }

    function impGFirmas($fecha)
    {
        // Obtener el HTML para crear PDF en content
        $this->load->model("profesores_m");
        $this->load->model("turnos_m");

        $datos['profGuardias'] = $this->turnos_m->get_turnos_dia_new($fecha);
        $datos['profesores'] = $this->profesores_m->get_profesores();

        $this->load->library('Pdf');



        if (isset($datos['profGuardias'])) {
            ob_start();
            //$this->load->view('plantilla/cabecera_ventana');
            $this->load->view('pdf/firmas_guardias_v_pdf', $datos);
            $content = ob_get_clean();
            try {

                $pdf = new Pdf('L', "mm", 'A4', true, 'UTF-8', false);
                $pdf->SetFont('', '', 10, '', 'false');
                $pdf->SetTitle('Firmas Guardias');
                // remove default header/footer 
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);
                $pdf->SetAutoPageBreak(true);
                $pdf->SetMargins(5, 5, 0, true);
                $pdf->SetAuthor('JML');
                $pdf->SetDisplayMode('real', 'default');
                $pdf->AddPage('L');
                //$pdf->Write(5, 'CodeIgniter TCPDF Integration');

                // convert
                $pdf->writeHTML($content, false);
                $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'guardias/pdf/FirmasGuardias' . $fecha . '.pdf', 'F');
                //$pdf->Output("firmasGuardias.pdf");
            } catch (\Throwable $e) {
                echo $e;
                exit;
            }
        }

        redirect(base_url() . "imppdf");
    }
}
