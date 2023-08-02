<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->helper("form");
        $this->load->view("plantilla/cabecera");
        $this->load->view("login_v");
        $this->load->view("plantilla/pie");

    }
	function login() {
		$this->load->library('form_validation');
        $this->form_validation->set_rules('usuario', 'Nombre de Usuario', 'required');
        $this->form_validation->set_rules('clave', 'Clave de Acceso', 'required|callback_validarUsuario');

        if ($this->form_validation->run() == FALSE)
        {
            
            /* $datos['contenido']="loginerror_v";
            $datos['titulo']="Login";
            $this->load->view('plantilla/plantilla',$datos); */
            $this->load->helper("form");
            $this->load->view("plantilla/cabecera");
            $this->load->view("login_v");
            $this->load->view("plantilla/pie");
            
        }
        else
        {
            redirect('inicio');
        }
    }

    function validarUsuario($clave) {
        // Aqui deberiamos acceder a la BBDD con el usuario y clave y validar
        $usuario=$this->input->post('usuario');
        $this->load->model('usuarios_m');
        $socio=$this->usuarios_m->autUsuario($usuario,$clave);
        if ($socio) {
            // poner tipo de usuario, id usuario y mas cosas en sessions
            $newdata = array(
            'usuario'  => $socio->usuario,
            'email' => $socio->email,
            'roll' => $socio->tipo_usuario,
            'logueado' => TRUE
            );
            $this->session->set_userdata($newdata);
            return TRUE;
        } else {
             $this->form_validation->set_message('validarUsuario', 'El Usuario o la Clave no son validas');
            return FALSE;
        }
    }
    public function logout(){

        session_destroy();
        redirect("inicio");

    }
    public function ver_perfil(){
        $this->load->helper("form");
        $this->load->library("form_validation");

        $this->load->model('usuarios_m');

        $datos['usuario']=$this->usuarios_m->leerUsuario($_SESSION['usuario']);
              
        $datos['contenido']="perfil_v";
        $datos['titulo']="Perfil";
        $this->load->view('plantilla/plantilla',$datos);
    }

    function cambiar_clave() {

        if ($_POST['clave']!=$_POST['claverep'])
        {
            echo "Las claves no coinciden. Clave no cambiada";
            echo "Pulse <a href='".base_url()."inicio'>aqui para seguir</a>";
            //$this->load->view('vperfil');

        }
        else
        {
            $this->load->model('usuarios_m');
            $this->load->helper('security');
            $_POST['clave'] = do_hash($_POST['clave'], 'md5');
            $this->usuarios_m->actperfil(array('usuario'=>$_POST['usuario'],'clave'=>$_POST['clave']));
            redirect("inicio");
        }

    }

    function cambiar_perfil() {
        $this->load->model('usuarios_m');
        $this->usuarios_m->actperfil($_POST);
        redirect("inicio");
    }

}