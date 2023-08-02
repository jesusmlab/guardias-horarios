<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Correo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("profesores_m");
    }

    public function index()
    {

        $datos['profesores'] = $this->profesores_m->get_profesores();
        $datos['contenido'] = "selcorreo_v";
        $datos['titulo'] = "Correo";
        $this->load->view('plantilla/plantilla', $datos);
    }
    public function enviar()
    {
        /*
         * Cuando cargamos una librería
         * es similar a hacer en PHP puro esto:
         * require_once("libreria.php");
         * $lib=new Libreria();
         */

        //Cargamos la librería email
        $this->load->library('email');

        /*
          * Configuramos los parámetros para enviar el email,
          * las siguientes configuraciones es recomendable
          * hacerlas en el fichero email.php dentro del directorio config,
          * en este caso para hacer un ejemplo rápido lo hacemos
          * en el propio controlador
          */

        //Indicamos el protocolo a utilizar
        $config['protocol'] = 'smtp';

        //El servidor de correo que utilizaremos
        $config["smtp_host"] = 'ssl://smtp.gmail.com';

        //Nuestro usuario
        $config["smtp_user"] = '';

        //Nuestra contraseña
        $config["smtp_pass"] = '';

        //El puerto que utilizará el servidor smtp
        $config["smtp_port"] = 465;

        //El juego de caracteres a utilizar
        $config['charset'] = 'utf-8';

        //Permitimos que se puedan cortar palabras
        $config['wordwrap'] = TRUE;

        //El email debe ser valido 
        $config['validate'] = true;

        $config['mailtype']  = 'html';

        $config['newline']   = "\r\n";
        //Establecemos esta configuración
        $this->email->initialize($config);
        $salida = "";
        if (isset($_POST['email_data'])) {
            foreach ($_POST['email_data'] as $row) {

                //Ponemos la dirección de correo que enviará el email y un nombre
                $this->email->from('jesusmlab@gmail.com', 'Jesus M. Labrador');

                /*
                * Ponemos el o los destinatarios para los que va el email
                * en este caso al ser un formulario de contacto te lo enviarás a ti
                * mismo
                */
                $this->email->to($row["email"], $row["nombre"]);

                //Definimos el asunto del mensaje
                $this->email->subject($row['asunto']);

                //Definimos el mensaje a enviar
                $this->email->message($row['mensaje']);

                //Enviamos el email y si se produce bien o mal que avise con una flasdata
                if ($this->email->send()) {
                    $salida = "ok";
                } else {
                    $salida = $this->email->print_debugger(array('headers'));
                }
            }
            echo $salida;
        }
    }
}
