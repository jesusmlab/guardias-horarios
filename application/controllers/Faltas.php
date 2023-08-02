<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faltas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("faltas_m");
        $this->load->model("guardias_m");
        $this->load->model("profesores_m");
        $this->load->model("causas_m");
    }
    public function index()
    {
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }

        if (isset($_REQUEST['cmbfiltro'])) {
            $filtro = $_REQUEST['cmbfiltro'];
            $this->session->set_flashdata('cmbfiltro', $filtro);
        } else {
            if (isset($_SESSION['cmbfiltro'])) {
                $filtro = $_SESSION['cmbfiltro'];
            } else {
                $filtro = "";
            }
        }


        $regPerPag = 8; //Número de registros mostrados por páginas
        $this->load->library('pagination'); //Cargamos la librería de paginación

        $config['total_rows'] = $this->faltas_m->total_filas($filtro); //calcula el número de filas  
        $config['per_page'] = $regPerPag; //Número de registros mostrados por páginas
        $config['num_links'] = 20; //Número de links mostrados en la paginación
        $config['base_url'] = base_url() . 'faltas/index/';
        $config['first_link'] = 'Primera'; //primer link
        $config['last_link'] = 'Última'; //último link
        $config["uri_segment"] = 3; //el segmento de la paginación
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['prev_link'] = 'Anterior'; //anterior link
        $this->pagination->initialize($config); //inicializamos la paginación 
        //$data["provincias"] = $this->provincia_model->total_paginados($config['per_page'],$this->uri->segment(3)); 

        //cargamos la vista y el array data
        //$this->load->view('provincia_view', $data);
        $datos['profesores'] = $this->profesores_m->get_profesores();
        $datos['faltas'] = $this->faltas_m->get_faltas_pag($config['per_page'], $this->uri->segment(3), $filtro);
        $datos['causas'] = $this->causas_m->get_causas();
        $datos['contenido'] = "faltas_v";
        $datos['titulo'] = "Faltas";
        $this->load->view('plantilla/plantilla', $datos);
    }

    public function insertar()
    {
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        $tramos = implode(",", $this->input->post('tramos'));
        $datos = [
            "fecha" => $this->input->post('fecha'),
            "profesor" => $this->input->post('profesor'),
            "tramos" => $tramos,
            "causa" => $this->input->post('causa'),
            "anotacion1" => empty($this->input->post('anotacion1')) ? '' : $this->input->post('anotacion1'),
            "anotacion2" => empty($this->input->post('anotacion2')) ? '' : $this->input->post('anotacion2'),
            "anotacion3" => empty($this->input->post('anotacion3')) ? '' : $this->input->post('anotacion3'),
            "anotacion4" => empty($this->input->post('anotacion4')) ? '' : $this->input->post('anotacion4'),
            "anotacion5" => empty($this->input->post('anotacion5')) ? '' : $this->input->post('anotacion5'),
            "anotacion6" => empty($this->input->post('anotacion6')) ? '' : $this->input->post('anotacion6'),
            "anotacion7" => empty($this->input->post('anotacion7')) ? '' : $this->input->post('anotacion7'),
            "guardiaSN" => $this->input->post('guardiaSN')

        ];
        $this->faltas_m->insertar($datos);
        redirect("faltas");
    }

    public function borrar($id)
    {
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        $this->faltas_m->borrar($id);
        redirect("faltas");
    }

    public function editar()
    {
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        $tramos = implode(",", $this->input->post('tramos'));
        $datos = [
            "fecha" => $this->input->post('fecha'),
            "profesor" => $this->input->post('profesor'),
            "tramos" => $tramos,
            "causa" => $this->input->post('causa'),
            "anotacion1" => empty($this->input->post('anotacion1')) ? '' : $this->input->post('anotacion1'),
            "anotacion2" => empty($this->input->post('anotacion2')) ? '' : $this->input->post('anotacion2'),
            "anotacion3" => empty($this->input->post('anotacion3')) ? '' : $this->input->post('anotacion3'),
            "anotacion4" => empty($this->input->post('anotacion4')) ? '' : $this->input->post('anotacion4'),
            "anotacion5" => empty($this->input->post('anotacion5')) ? '' : $this->input->post('anotacion5'),
            "anotacion6" => empty($this->input->post('anotacion6')) ? '' : $this->input->post('anotacion6'),
            "anotacion7" => empty($this->input->post('anotacion7')) ? '' : $this->input->post('anotacion7'),
            "guardiaSN" => $this->input->post('guardiaSN')

        ];

        $this->faltas_m->actualizar($this->input->post('id', TRUE), $datos);
        $this->session->set_flashdata('message', 'Actualización correcta');
        redirect(site_url('faltas'));
    }
    public function informe_faltas()
    {
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        if ($this->input->post('desdefecha')) {
            $datos['faltas'] = $this->faltas_m->get_faltas_fechasprofe($this->input->post('desdefecha'), $this->input->post('hastafecha'), $this->input->post('profesor'), $this->input->post('causa'));
            $datos['contenido'] = "faltas_informe_v";
            $datos['titulo'] = "Informe de Faltas";
            $this->load->view('plantilla/plantilla', $datos);
        } else {
            $datos['profesores'] = $this->profesores_m->get_profesores();
            $datos['clasifguardias'] = $this->guardias_m->get_clasificacion_guardias();
            $datos['clasiffaltas'] = $this->faltas_m->get_clasificacion_faltas();
            $datos['causas'] = $this->causas_m->get_causas();
            $datos['contenido'] = "faltas_informe_dialogo_v";
            $datos['titulo'] = "Informe de Faltas";
            $this->load->view('plantilla/plantilla', $datos);
        }
    }
    public function calendario()
    {
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }

        $datos['causas'] = $this->causas_m->get_causas();
        $datos['contenido'] = "calendario_faltas_v";
        $datos['titulo'] = "Calendario de Faltas";
        $this->load->view('plantilla/plantilla', $datos);
    }
    public function leerTodasPorFecha()
    {
        echo json_encode($this->faltas_m->leerTodasPorFecha($_REQUEST['fdesde'], $_REQUEST['fhasta'], $_REQUEST['causa']));
    }
    public function excel($desdef, $hastaf, $prof = "%%")
    {
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        $this->load->helper('exportexcel');
        $namaFile = "informefaltas.xls";
        $judul = "Informe de Faltas";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Fecha");
        xlsWriteLabel($tablehead, $kolomhead++, "Profesor");
        xlsWriteLabel($tablehead, $kolomhead++, "Horas");
        xlsWriteLabel($tablehead, $kolomhead++, "Causa");

        $datos = $this->faltas_m->get_faltas_fechasprofe($desdef, $hastaf, $prof);

        foreach ($datos as $data) {
            $kolombody = 0;
            $date = new DateTime($data['fecha']);
            if ($data['sustituto'] == "") {
                $prof = $data['apenom'];
            } else {
                $prof = $data['sustituto'];
            }

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $date->format('d-m-Y'));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($prof));
            xlsWriteLabel($tablebody, $kolombody++, $data['tramos']);
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data['descripcion']));

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}
