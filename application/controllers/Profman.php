<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        $this->load->model('Profman_m');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (isset($_REQUEST['q'])) {
            $q = urldecode($this->input->post('q', TRUE));
            $_SESSION['q'] = $q;
        } else {
            if (isset($_SESSION['q'])) {
                $q = $_SESSION['q'];
            } else {
                $q = "";
            }
        }

        $start = intval($this->uri->segment(3, 0));

        $_SESSION['start']=$start;

        $config['base_url'] = base_url() . 'profman/index';
        $config['first_url'] = base_url() . 'profman/index';

        $config["uri_segment"] = 3; //el segmento de la paginación
        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Profman_m->total_rows($q);
        $profman = $this->Profman_m->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'profman_data' => $profman,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['contenido'] = "profman/profesores_list";
        $data['titulo'] = "Profesores - Lista";
        $this->load->view('plantilla/plantilla', $data);
    }

    public function read($id)
    {
        $row = $this->Profman_m->get_by_id($id);
        if ($row) {
            $data = array(
                'Codigo' => $row->Codigo,
                'TomaPosesion' => $row->TomaPosesion,
                'Puesto' => $row->Puesto,
                'Apellido1' => $row->Apellido1,
                'Apellido2' => $row->Apellido2,
                'Nombre' => $row->Nombre,
                'Sustituto' => $row->Sustituto,
                'Email' => $row->Email,
            );
            $this->load->view('profman/profesores_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('profman/index/'.$_SESSION['start']));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Crear',
            'action' => site_url('profman/create_action'),
            'Codigo' => set_value('Codigo'),
            'TomaPosesion' => set_value('TomaPosesion'),
            'Puesto' => set_value('Puesto'),
            'Apellido1' => set_value('Apellido1'),
            'Apellido2' => set_value('Apellido2'),
            'Nombre' => set_value('Nombre'),
            'Sustituto' => set_value('Sustituto'),
            'Email' => set_value('Email'),
        );

        $data['contenido'] = "profman/profesores_form";
        $data['titulo'] = "Profesores - Crear";
        $this->load->view('plantilla/plantilla', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'Codigo' => $this->input->post('Codigo', TRUE),
                'TomaPosesion' => $this->input->post('TomaPosesion', TRUE),
                'Puesto' => $this->input->post('Puesto', TRUE),
                'Apellido1' => $this->input->post('Apellido1', TRUE),
                'Apellido2' => $this->input->post('Apellido2', TRUE),
                'Nombre' => $this->input->post('Nombre', TRUE),
                'Sustituto' => $this->input->post('Sustituto', TRUE),
                'Email' => $this->input->post('Email', TRUE),
            );

            $this->Profman_m->insert($data);
            $this->session->set_flashdata('message', 'Correcto');
            redirect(site_url('profman/index/'.$_SESSION['start']));
        }
    }

    public function update($id)
    {
        $row = $this->Profman_m->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Actualizar',
                'action' => site_url('profman/update_action'),
                'Codigo' => set_value('Codigo', $row->Codigo),
                'TomaPosesion' => set_value('TomaPosesion', $row->TomaPosesion),
                'Puesto' => set_value('Puesto', $row->Puesto),
                'Apellido1' => set_value('Apellido1', $row->Apellido1),
                'Apellido2' => set_value('Apellido2', $row->Apellido2),
                'Nombre' => set_value('Nombre', $row->Nombre),
                'Sustituto' => set_value('Sustituto', $row->Sustituto),
                'Email' => set_value('Email', $row->Email),
            );

            $data['contenido'] = "profman/profesores_form";
            $data['titulo'] = "Profesores - Modificar";
            $this->load->view('plantilla/plantilla', $data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('profman/index/'.$_SESSION['start']));
        }
    }

    public function update_action()
    {
        //$this->output->enable_profiler(TRUE);
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Codigo', TRUE));
        } else {
            $data = array(
                'TomaPosesion' => $this->input->post('TomaPosesion', TRUE),
                'Puesto' => $this->input->post('Puesto', TRUE),
                'Apellido1' => $this->input->post('Apellido1', TRUE),
                'Apellido2' => $this->input->post('Apellido2', TRUE),
                'Nombre' => $this->input->post('Nombre', TRUE),
                'Sustituto' => $this->input->post('Sustituto', TRUE),
                'Email' => $this->input->post('Email', TRUE),
            );

            $this->Profman_m->update($this->input->post('Codigo', TRUE), $data);
            $this->session->set_flashdata('message', 'Actualizacion correcta');

            redirect(site_url('profman/index/'.$_SESSION['start']));
        }
    }

    public function delete($id)
    {
        $row = $this->Profman_m->get_by_id($id);

        if ($row) {
            $this->Profman_m->delete($id);
            $this->session->set_flashdata('message', 'Borrado correcto');
            redirect(site_url('profman/index/'.$_SESSION['start']));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profman/index/'.$_SESSION['start']));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('TomaPosesion', 'tomaposesion', 'trim|required');
        $this->form_validation->set_rules('Puesto', 'puesto', 'trim|required');
        $this->form_validation->set_rules('Apellido1', 'apellido1', 'trim|required');
        $this->form_validation->set_rules('Apellido2', 'apellido2', 'trim|required');
        $this->form_validation->set_rules('Nombre', 'nombre', 'trim|required');
        //$this->form_validation->set_rules('Email', 'email', 'trim|email');
        //$this->form_validation->set_rules('Sustituto', 'sustituto', 'trim|required');

        $this->form_validation->set_rules('Codigo', 'Codigo', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "profesores.xls";
        $judul = "profesores";
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
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "TomaPosesion");
        xlsWriteLabel($tablehead, $kolomhead++, "Puesto");
        xlsWriteLabel($tablehead, $kolomhead++, "Apellido1");
        xlsWriteLabel($tablehead, $kolomhead++, "Apellido2");
        xlsWriteLabel($tablehead, $kolomhead++, "Nombre");
        xlsWriteLabel($tablehead, $kolomhead++, "Sustituto");
        xlsWriteLabel($tablehead, $kolomhead++, "Email");

        foreach ($this->Profman_m->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->TomaPosesion);
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Puesto));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Apellido1));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Apellido2));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Sustituto));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Email));

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=profesores.doc");

        $data = array(
            'profesores_data' => $this->Profman_m->get_all(),
            'start' => 0
        );

        $this->load->view('profman/profesores_doc', $data);
    }
}

/* End of file Profman.php */
/* Location: ./application/controllers/Profman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-26 09:47:05 */
/* http://harviacode.com */