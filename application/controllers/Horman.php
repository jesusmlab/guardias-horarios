<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Horman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
        $this->load->model('Horman_m');
        $this->load->model('actividades_m');
        $this->load->model('profesores_m');
        $this->load->model('tramos_horarios_m');
        $this->load->model('cursos_m');
        $this->load->model('materias_m');
        $this->load->model('grupos_m');
        $this->load->model('aulas_m');
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
        
        $start = intval($this->uri->segment(3,0));
        $_SESSION['start']=$start;
        $config['base_url'] = base_url() . 'horman/index';
        $config['first_url'] = base_url() . 'horman/index';
    
        $config["uri_segment"] = 3;//el segmento de la paginación
        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Horman_m->total_rows($q);
        $horman = $this->Horman_m->get_limit_data($config['per_page'], $start, $q);


        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'horman_data' => $horman,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $data['cursos']=$this->cursos_m->get_cursos();
        $data['aulas']=$this->aulas_m->get_aulas();
        $data['grupos']=$this->grupos_m->get_grupos();
        $data['materias']=$this->materias_m->get_materias();
        $data['tramos_horarios']=$this->tramos_horarios_m->get_tramos();
        $data['profesores']=$this->profesores_m->get_profesores();
        $data['actividades']=$this->actividades_m->get_actividades();
        $data['contenido']="horman/horarios_list";
        $data['titulo']="Horarios - List";
        $this->load->view('plantilla/plantilla',$data);
        
        //$this->load->view('horman/horarios_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Horman_m->get_by_id($id);
        if ($row) {
            $data = array(
		'CodigoProf' => $row->CodigoProf,
		'DiaSem' => $row->DiaSem,
        'Tramo' => $row->Tramo,
        'Actividad' => $row->Actividad,
		'Aula' => $row->Aula,
		'Unidad' => $row->Unidad,
		'Curso' => $row->Curso,
		'Materia' => $row->Materia,
		'Id' => $row->Id,
	    );
            $this->load->view('horman/horarios_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('horman/index/'.$_SESSION['start']));
        }
    }

    public function create() 
    {
        $data = array(
        'button' => 'Crear',
        'action' => site_url('horman/create_action'),
	    'CodigoProf' => set_value('CodigoProf'),
	    'DiaSem' => set_value('DiaSem'),
	    'Tramo' => set_value('Tramo'),
	    'Aula' => set_value('Aula'),
	    'Unidad' => set_value('Unidad'),
	    'Curso' => set_value('Curso'),
	    'Materia' => set_value('Materia'),
	    'Hinicio' => set_value('Hinicio'),
	    'Hfin' => set_value('Hfin'),
	    'Actividad' => set_value('Actividad'),
	    'Id' => set_value('Id'),
	);
        
        $data['cursos']=$this->cursos_m->get_cursos();
        $data['aulas']=$this->aulas_m->get_aulas();
        $data['grupos']=$this->grupos_m->get_grupos();
        $data['materias']=$this->materias_m->get_materias();
        $data['tramos_horarios']=$this->tramos_horarios_m->get_tramos();
        $data['profesores']=$this->profesores_m->get_profesores();
        $data['actividades']=$this->actividades_m->get_actividades();
        $data['contenido']="horman/horarios_form";
        $data['titulo']="Horarios - Crear";
        $this->load->view('plantilla/plantilla',$data);    
    
        //$this->load->view('horman/horarios_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'CodigoProf' => $this->input->post('CodigoProf',TRUE),
		'DiaSem' => $this->input->post('DiaSem',TRUE),
		'Tramo' => $this->input->post('Tramo',TRUE),
		'Aula' => $this->input->post('Aula',TRUE),
		'Unidad' => $this->input->post('Unidad',TRUE),
		'Curso' => $this->input->post('Curso',TRUE),
		'Materia' => $this->input->post('Materia',TRUE),
		'Hinicio' => $this->sacar_horas_tramos($this->input->post('Tramo'),'Inicio'),
		'Hfin' => $this->sacar_horas_tramos($this->input->post('Tramo'),'Fin'),
        'Actividad' => $this->input->post('Actividad',TRUE)
	    );

            $this->Horman_m->insert($data);
            $this->session->set_flashdata('message', 'Registro Creado');
            redirect(site_url('horman/index/'.$_SESSION['start']));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Horman_m->get_by_id($id);

        if ($row) {
        $data = array(
        'button' => 'Actualizar',
        'action' => site_url('horman/update_action'),
		'CodigoProf' => set_value('CodigoProf', $row->CodigoProf),
		'DiaSem' => set_value('DiaSem', $row->DiaSem),
		'Tramo' => set_value('Tramo', $row->Tramo),
		'Aula' => set_value('Aula', $row->Aula),
		'Unidad' => set_value('Unidad', $row->Unidad),
		'Curso' => set_value('Curso', $row->Curso),
		'Materia' => set_value('Materia', $row->Materia),
		'Hinicio' => set_value('Hinicio', $row->Hinicio),
		'Hfin' => set_value('Hfin', $row->Hfin),
		'Actividad' => set_value('Actividad', $row->Actividad),
		'Id' => set_value('Id', $row->Id),
	    );
            $data['cursos']=$this->cursos_m->get_cursos();
            $data['aulas']=$this->aulas_m->get_aulas();
            $data['grupos']=$this->grupos_m->get_grupos();
            $data['materias']=$this->materias_m->get_materias();
            $data['tramos_horarios']=$this->tramos_horarios_m->get_tramos();
            $data['profesores']=$this->profesores_m->get_profesores();
            $data['actividades']=$this->actividades_m->get_actividades();    
            
            $data['contenido']="horman/horarios_form";
            $data['titulo']="Horarios - Actualizar";
            $this->load->view('plantilla/plantilla',$data);
            
            //$this->load->view('horman/horarios_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('horman/index/'.$_SESSION['start']));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id', TRUE));
        } else {
            $data = array(
		'CodigoProf' => $this->input->post('CodigoProf',TRUE),
		'DiaSem' => $this->input->post('DiaSem',TRUE),
		'Tramo' => $this->input->post('Tramo',TRUE),
		'Aula' => $this->input->post('Aula',TRUE),
		'Unidad' => $this->input->post('Unidad',TRUE),
		'Curso' => $this->input->post('Curso',TRUE),
		'Materia' => $this->input->post('Materia',TRUE),
		'Hinicio' => $this->sacar_horas_tramos($this->input->post('Tramo'),'Inicio'),
		'Hfin' => $this->sacar_horas_tramos($this->input->post('Tramo'),'Fin'),
		'Actividad' => $this->input->post('Actividad',TRUE),
	    ); 

            $this->Horman_m->update($this->input->post('Id', TRUE), $data);
            $this->session->set_flashdata('message', 'Actualizado satisfactoriamente');
            redirect(site_url('horman/index/'.$_SESSION['start']));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Horman_m->get_by_id($id);

        if ($row) {
            $this->Horman_m->delete($id);
            $this->session->set_flashdata('message', 'Registro Borrado');
            redirect(site_url('horman/index/'.$_SESSION['start']));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('horman/index/'.$_SESSION['start']));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('CodigoProf', 'codigoprof', 'trim|required');
	$this->form_validation->set_rules('DiaSem', 'diasem', 'trim|required');
	$this->form_validation->set_rules('Tramo', 'tramo', 'trim|required');
	//$this->form_validation->set_rules('Aula', 'aula', 'trim|required');
	//$this->form_validation->set_rules('Unidad', 'unidad', 'trim|required');
	//$this->form_validation->set_rules('Curso', 'curso', 'trim|required');
	//$this->form_validation->set_rules('Materia', 'materia', 'trim|required');
	/* $this->form_validation->set_rules('Hinicio', 'hinicio', 'trim|required');
	$this->form_validation->set_rules('Hfin', 'hfin', 'trim|required'); */
	$this->form_validation->set_rules('Actividad', 'actividad', 'trim|required');

    $this->form_validation->set_rules('Id', 'Id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    private function sacar_horas_tramos($tramo,$cual){
        $mitramo=$this->tramos_horarios_m->get_tramo($tramo);
        return $mitramo[0][$cual];
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "horarios.xls";
        $judul = "horarios";
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
	xlsWriteLabel($tablehead, $kolomhead++, "CodigoProf");
	xlsWriteLabel($tablehead, $kolomhead++, "DiaSem");
	xlsWriteLabel($tablehead, $kolomhead++, "Tramo");
	xlsWriteLabel($tablehead, $kolomhead++, "Aula");
	xlsWriteLabel($tablehead, $kolomhead++, "Unidad");
	xlsWriteLabel($tablehead, $kolomhead++, "Curso");
	xlsWriteLabel($tablehead, $kolomhead++, "Materia");
	xlsWriteLabel($tablehead, $kolomhead++, "Hinicio");
	xlsWriteLabel($tablehead, $kolomhead++, "Hfin");
	xlsWriteLabel($tablehead, $kolomhead++, "Actividad");

	foreach ($this->Horman_m->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->CodigoProf);
	    xlsWriteLabel($tablebody, $kolombody++, $data->DiaSem);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Tramo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Aula);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Unidad);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Curso);
	    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Materia));
	    xlsWriteLabel($tablebody, $kolombody++, $data->Hinicio);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Hfin);
	    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Actividad));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=horarios.doc");

        $data = array(
            'horarios_data' => $this->Horman_m->get_all(),
            'start' => 0
        );
        
        $this->load->view('horman/horarios_doc',$data);
    }

}

/* End of file Horman.php */
/* Location: ./application/controllers/Horman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-25 11:15:46 */
/* http://harviacode.com */