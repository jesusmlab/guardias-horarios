<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Turman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        $this->load->model('Turman_m');
        $this->load->model('profesores_m');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (isset($_REQUEST['q'])) {
            $q = urldecode($this->input->post('q', TRUE));
            $_SESSION['q']=$q;
        } else {
            if (isset($_SESSION['q'])) {
                $q=$_SESSION['q'];
            } else {
                $q="";
            }
        }

        if (isset($_REQUEST['di'])) {
            $di = urldecode($this->input->post('di', TRUE));
            $tr = urldecode($this->input->post('tr', TRUE));
            $_SESSION['di']=$di;
            $_SESSION['tr']=$tr;
        } else {
            if (isset($_SESSION['di'])) {
                $di=$_SESSION['di'];
                $tr=$_SESSION['tr'];
            } else {
                $tr="";
                $di="";
            }
        }
        //$this->output->enable_profiler(TRUE);
        $start = intval($this->uri->segment(3,0));
        $_SESSION['start']=$start;
        $config['base_url'] = base_url() . 'turman/index';
        $config['first_url'] = base_url() . 'turman/index';
    
        $config["uri_segment"] = 3;//el segmento de la paginación
        $config['per_page'] = 18;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Turman_m->total_rows($q);
        $turman = $this->Turman_m->get_limit_data($config['per_page'], $start, $q,$di,$tr);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'turman_data' => $turman,
            'q' => $q,
            'di' => $di,
            'ti' => $tr,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $data['profesores']=$this->profesores_m->get_profesores();
        $data['contenido']="turman/turnos_list";
        $data['titulo']="Turnos - Lista";
        $this->load->view('plantilla/plantilla',$data);
        
    }

    public function read($id) 
    {
        $row = $this->Turman_m->get_by_id($id);
        if ($row) {
            $data = array(
		'profesor' => $row->profesor,
		'dia' => $row->dia,
		'tramo' => $row->tramo,
		'turno' => $row->turno,
		'id' => $row->id,
	    );
            $this->load->view('turman/turnos_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('turman/index/'.$_SESSION['start']));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Crear',
            'action' => site_url('turman/create_action'),
	    'profesor' => set_value('profesor'),
	    'dia' => set_value('dia'),
	    'tramo' => set_value('tramo'),
	    'turno' => set_value('turno'),
	    'id' => set_value('id'),
	);
        
        $data['profesores']=$this->profesores_m->get_profesores();
        $data['contenido']="turman/turnos_form";
        $data['titulo']="Turnos - Lista";
        $this->load->view('plantilla/plantilla',$data);    
   
    }
    
    public function subir($id,$t){
        if (intval($t)>1){
            $t=strval(intval($t)-1);

            $this->Turman_m->update($id, ['turno'=>$t]);
            redirect(site_url('turman/index/'.$_SESSION['start']));
        }
    }

    public function bajar($id,$t){
            $t=strval(intval($t)+1);

            $this->Turman_m->update($id, ['turno'=>$t]);
            redirect(site_url('turman/index/'.$_SESSION['start']));
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'profesor' => $this->input->post('profesor',TRUE),
		'dia' => $this->input->post('dia',TRUE),
		'tramo' => $this->input->post('tramo',TRUE),
		'turno' => $this->input->post('turno',TRUE),
	    );

            $this->Turman_m->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('turman/index/'.$_SESSION['start']));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Turman_m->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Actualizar',
                'action' => site_url('turman/update_action'),
		'profesor' => set_value('profesor', $row->profesor),
		'dia' => set_value('dia', $row->dia),
		'tramo' => set_value('tramo', $row->tramo),
		'turno' => set_value('turno', $row->turno),
		'id' => set_value('id', $row->id),
        );
            $data['profesores']=$this->profesores_m->get_profesores();
            $data['contenido']="turman/turnos_form";
            $data['titulo']="Turnos - Lista";
            $this->load->view('plantilla/plantilla',$data);    
           
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('turman/index/'.$_SESSION['start']));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'profesor' => $this->input->post('profesor',TRUE),
		'dia' => $this->input->post('dia',TRUE),
		'tramo' => $this->input->post('tramo',TRUE),
		'turno' => $this->input->post('turno',TRUE),
	    );

            $this->Turman_m->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Actualización correcta');
            redirect(site_url('turman/index/'.$_SESSION['start']));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Turman_m->get_by_id($id);

        if ($row) {
            $this->Turman_m->delete($id);
            $this->session->set_flashdata('message', 'Borrado correcto');
            redirect(site_url('turman/index/'.$_SESSION['start']));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('turman/index/'.$_SESSION['start']));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('profesor', 'profesor', 'trim|required');
	$this->form_validation->set_rules('dia', 'dia', 'trim|required');
	$this->form_validation->set_rules('tramo', 'tramo', 'trim|required');
	$this->form_validation->set_rules('turno', 'turno', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "turnos.xls";
        $judul = "turnos";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Profesor");
	xlsWriteLabel($tablehead, $kolomhead++, "Dia");
	xlsWriteLabel($tablehead, $kolomhead++, "Tramo");
	xlsWriteLabel($tablehead, $kolomhead++, "Turno");

	foreach ($this->Turman_m->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->profesor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dia);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tramo);
	    xlsWriteNumber($tablebody, $kolombody++, $data->turno);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=turnos.doc");

        $data = array(
            'turnos_data' => $this->Turman_m->get_all(),
            'start' => 0
        );
        
        $this->load->view('turman/turnos_doc',$data);
    }

}

/* End of file Turman.php */
/* Location: ./application/controllers/Turman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-26 19:37:21 */
/* http://harviacode.com */