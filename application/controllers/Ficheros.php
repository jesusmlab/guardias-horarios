<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ficheros extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $datos['contenido'] = "subirfichero_v";
        $datos['titulo'] = "Tablas Auxiliares";
        $this->load->view('plantilla/plantilla', $datos);
    }
    public function subirTAuxiliares()
    {
        $datos['contenido'] = "subirfichero_v";
        $datos['titulo'] = "Tablas Auxiliares";
        $datos['tipo'] = "T";
        $datos['error'] = "Esta operación vaciará todas las tablas auxiliares e importara en ellas el fichero XML elegido. El nombre no podrá contener espacios ni caracteres especiales";
        $this->load->view('plantilla/plantilla', $datos);
    }
    public function subirHorarios()
    {
        $datos['contenido'] = "subirfichero_v";
        $datos['titulo'] = "Horarios";
        $datos['tipo'] = "H";
        $datos['error'] = "Esta operación vaciará todos los horarios e importara el fichero XML elegido. El nombre no podrá contener espacios ni caracteres especiales";
        $this->load->view('plantilla/plantilla', $datos);
    }

    public function subir($tipo)
    {
        //Ruta donde se guardan los ficheros
        $config['upload_path'] = './xml/';

        //Tipos de ficheros permitidos
        $config['allowed_types'] = 'xml';

		//Sobreescribir
        $config['overwrite'] = TRUE;


        //Se pueden configurar aun mas parámetros.
        //Cargamos la librería de subida y le pasamos la configuración
        $this->load->library('upload', $config);

        $datos['contenido'] = "subirfichero_v";
        $datos['titulo'] = "Tablas Auxiliares";


        if (!$this->upload->do_upload('fichero')) {
            /*Si al subirse hay algún error lo meto en un array para pasárselo a la vista*/
            $datos['tipo'] = $tipo;
            $datos['error'] = $this->upload->display_errors();
            $this->load->view('plantilla/plantilla', $datos);
        } else {
            //Datos del fichero subido
            $fichero = $this->upload->data('client_name');
            if ($tipo == "T") {
                redirect(base_url() . "xml_doc/importarTAuxiliares/" . $fichero);
            } else {
                redirect(base_url() . "xml_doc/importarHorarios/" . $fichero . "/" . $_REQUEST['aniadir']);
            }
        }
    }
}
