<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mantablas extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        if (!isset($_SESSION['logueado'])) {
            redirect(base_url());
        }
    }
    function causas()
    {
        try {
            /* Creamos el objeto */
            $crud = new grocery_CRUD();
            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');
            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('causas');
            /* Le asignamos un nombre */
            $crud->set_subject('Causas');
            /* Asignamos el idioma español */
            $crud->set_language('spanish');
            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
                'codigo',
                'descripcion'
            );
            /* Aqui le indicamos que campos deseamos mostrar */
            $crud->columns(
                'codigo',
                'descripcion'

            );
            /* Generamos la tabla */
            $output = $crud->render();
            $output->titulo = "Causas";
            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
            //$output->contenido="mantablas_v";
            $this->load->view('mantablas_v', $output);
            //$this->load->view('vmantablas', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function cursos()
    {
        try {
            /* Creamos el objeto */
            $crud = new grocery_CRUD();
            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');
            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('cursos');
            /* Le asignamos un nombre */
            $crud->set_subject('Cursos');
            /* Asignamos el idioma español */
            $crud->set_language('spanish');
            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
                'Codigo',
                'Descripcion'
            );
            /* Aqui le indicamos que campos deseamos mostrar */
            $crud->columns(
                'Codigo',
                'Descripcion'
            );
            /* Generamos la tabla */
            $output = $crud->render();
            $output->titulo = "Cursos";
            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
            //$output->contenido="mantablas_v";
            $this->load->view('mantablas_v', $output);
            //$this->load->view('vmantablas', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function aulas()
    {
        try {
            /* Creamos el objeto */
            $crud = new grocery_CRUD();
            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');
            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('dependencias');
            /* Le asignamos un nombre */
            $crud->set_subject('Aulas');
            /* Asignamos el idioma español */
            $crud->set_language('spanish');
            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
                'Codigo',
                'Descripcion'
            );
            /* Aqui le indicamos que campos deseamos mostrar */
            $crud->columns(
                'Codigo',
                'Descripcion'
            );
            /* Generamos la tabla */
            $output = $crud->render();
            $output->titulo = "Aulas";
            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
            //$output->contenido="mantablas_v";
            $this->load->view('mantablas_v', $output);
            //$this->load->view('vmantablas', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function grupos()
    {
        try {
            /* Creamos el objeto */
            $crud = new grocery_CRUD();
            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');
            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('unidades');
            /* Le asignamos un nombre */
            $crud->set_subject('Grupos');
            /* Asignamos el idioma español */
            $crud->set_language('spanish');
            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
                'Codigo',
                'Descripcion',
                'Curso',
                'Aula'
            );
            /* Aqui le indicamos que campos deseamos mostrar */
            $crud->columns(
                'Codigo',
                'Descripcion',
                'Curso',
                'Aula'
            );
            $crud->set_relation('Curso', 'cursos', 'Descripcion');
            $crud->set_relation('Aula', 'dependencias', 'Descripcion');
            /* Generamos la tabla */
            $output = $crud->render();
            $output->titulo = "Grupos";
            $output->cargar = 'mantablas_v_grupos';
            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
            //$output->contenido="mantablas_v";
            $this->load->view('mantablas_v', $output);

            //$this->load->view('vmantablas', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function materias()
    {
        try {
            /* Creamos el objeto */
            $crud = new grocery_CRUD();
            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');
            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('materias');
            /* Le asignamos un nombre */
            $crud->set_subject('Materias');
            /* Asignamos el idioma español */
            $crud->set_language('spanish');
            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
                'Codigo',
                'Descripcion',
                'Curso'
            );
            /* Aqui le indicamos que campos deseamos mostrar */
            $crud->columns(
                'Codigo',
                'Descripcion',
                'Curso'
            );
            /* Generamos la tabla */
            $crud->set_relation('Curso', 'cursos', 'Descripcion');
            $output = $crud->render();
            $output->titulo = "Materias";
            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
            //$output->contenido="mantablas_v";
            $this->load->view('mantablas_v', $output);
            //$this->load->view('vmantablas', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function actividades()
    {
        try {
            /* Creamos el objeto */
            $crud = new grocery_CRUD();
            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');
            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('actividades');
            /* Le asignamos un nombre */
            $crud->set_subject('Actividades');
            /* Asignamos el idioma español */
            $crud->set_language('spanish');
            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
                'Codigo',
                'Descripcion',
                'Mostrar_en_listas'
            );
            /* Aqui le indicamos que campos deseamos mostrar */
            $crud->columns(
                'Codigo',
                'Descripcion',
                'Mostrar_en_listas'
            );
            $crud->field_type('Mostrar_en_listas', 'dropdown', array('1' => 'Si', '0' => 'No'));
            /* Generamos la tabla */
            $output = $crud->render();
            $output->titulo = "Actividades";
            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
            //$output->contenido="mantablas_v";
            $this->load->view('mantablas_v', $output);
            //$this->load->view('vmantablas', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function tramos()
    {
        try {
            /* Creamos el objeto */
            $crud = new grocery_CRUD();
            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');
            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('tramos_horarios');
            /* Le asignamos un nombre */
            $crud->set_subject('Tramos Horarios');
            /* Asignamos el idioma español */
            $crud->set_language('spanish');
            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
                'Codigo',
                'Tramo',
                'Inicio',
                'Fin'
            );
            /* Aqui le indicamos que campos deseamos mostrar */
            $crud->columns(
                'Codigo',
                'Tramo',
                'Inicio',
                'Fin',
                'Jornada'
            );
            $crud->field_type('Jornada', 'dropdown', [
                "M" => "Mañana", "V" => "Verpertino"
            ]);
            /* Generamos la tabla */
            $output = $crud->render();
            $output->titulo = "Tramos Horarios";

            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
            //$output->contenido="mantablas_v";
            $this->load->view('mantablas_v', $output);
            //$this->load->view('vmantablas', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function registro()
    {
        try {
            /* Creamos el objeto */
            $crud = new grocery_CRUD();
            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');
            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('registro_guardias');
            /* Le asignamos un nombre */
            $crud->set_subject('Registro de Guardias');
            /* Asignamos el idioma español */
            $crud->set_language('spanish');
            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
                'Fecha',
                'Profesor',
                'Dia',
                'Tramo'
            );
            /* Aqui le indicamos que campos deseamos mostrar */
            $crud->columns(
                'Fecha',
                'Profesor',
                'Dia',
                'Tramo'
            );
            /* Generamos la tabla */
            $crud->set_relation('Profesor', 'profesores', '{Apellido1} {Apellido2}, {Nombre}');
            $crud->display_as('Profesor', 'Apellidos y Nombre');
            $crud->field_type('Dia', 'dropdown', [
                1 => "1", 2 => "2", 3 => "3", 4 => "4", 5 => "5"
            ]);
            $crud->field_type('Tramo', 'dropdown', [
                "1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6"
            ]);
            $output = $crud->render();
            $output->titulo = "Registro de Guardias";
            /* La cargamos en la vista situada en
            /applications/views/productos/administracion.php */
            //$output->contenido="mantablas_v";
            $this->load->view('mantablas_v', $output);
            //$this->load->view('vmantablas', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function usuarios()
    {
        try {
            /* Creamos el objeto */
            $crud = new grocery_CRUD();
            /* Seleccionamos el tema */
            $crud->set_theme('flexigrid');
            /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
            $crud->set_table('usuarios');
            /* Le asignamos un nombre */
            $crud->set_subject('Usuarios');
            /* Asignamos el idioma español */
            $crud->set_language('spanish');
            /* Aqui le decimos a grocery que estos campos son obligatorios */
            $crud->required_fields(
                'usuario',
                'apenom',
                'tipo_usuario'
            );
            /* Aqui le indicamos que campos deseamos mostrar */
            $crud->columns(
                'usuario',
                'apenom',
                'email',
                'movil',
                'tipo_usuario'
            );
            $crud->display_as('apenom', 'Apellidos y nombre');
            $crud->display_as('tipo_usuario', 'Rol');
            $crud->change_field_type('clave', 'password');

            $crud->callback_before_insert(array($this, 'encrypt_password_callback'));
            $crud->callback_before_update(array($this, 'encrypt_password_callback'));


            /* Generamos la tabla */
            $crud->field_type('tipo_usuario', 'dropdown', [
                "admin" => "admin", "Profesor" => "Profesor"
            ]);
            $output = $crud->render();
            $output->titulo = "Usuarios";

            $this->load->view('mantablas_v', $output);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function encrypt_password_callback($post_array, $primary_key = null)
    {
        $post_array['clave'] = md5($post_array['clave']);
        return $post_array;
    }
}
