<?php defined('BASEPATH') or exit('No direct script access allowed');
class Xml_doc extends CI_Controller
{
     function __construct()
     {
          parent::__construct();
     }

     public function xml()
     {

          $data   = [];
          $this->load->model("horarios_m");
          $horarios = $this->horarios_m->get_horarios_xml();

          /*  $this->db->select('name,email,phone');
		$query  =	$this->db->get('xml');
		$result	=	$query->result_array(); */


          if (isset($horarios)) {

               $config = array($config = array(
                    'root'     => 'root',
                    'element'  => 'element',
                    'newline' => "\n",
                    'tab' => "\t"
               ));
               $this->load->dbutil();
               $data = $this->dbutil->xml_from_result($horarios, $config);
               $this->output->set_content_type('text/xml');
               $this->output->set_output($data);
               $this->load->helper(['file', 'download']);
               write_file('download.xml', $data);
               force_download('download.xml', $data);
          }
     }

     public function leerxml()
     {

          $xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] . '/guardias/xml/horarios.xml');
          foreach ($xml->BLOQUE_DATOS->children() as $hijos) {
               foreach ($hijos as $hijos1) {
                    if (count($hijos1) > 0) {
                         foreach ($hijos1 as $clave2 => $valor2) {
                              echo "Subclave: " . $clave2 . " Valor:" . $valor2 . " nombre: " . $valor2['nombre_dato'] . "<br>";
                              if ($clave2 == "grupo_datos") {
                                   foreach ($valor2 as $clave3 => $valor3) {
                                        echo "Subclave: " . $clave3 . " Valor:" . $valor3 . "<br>";
                                   }
                              }
                         }
                    }
               }
               //echo $hijos->getName() . ": " . $hijos . "<br>" . "<br>";
          }

          /* foreach ($hijos as $clave=>$valor) {
                    print_r($hijos);
                    echo "<br>";
                    //echo "Clave: ".$clave." Valor:".$valor;

               } */
     }
     public function importarTAuxiliares($fichero)
     {
          // Cargar fichero xml
          $xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] . '/guardias/xml/' . $fichero);
          // array de tablas
          $tablas = array();
          foreach ($xml->BLOQUE_DATOS->children() as $elementos) {
               // primer nivel
               echo $elementos['seq'];
               echo "<br>";
               // si hay siguiente nivel
               if ($elementos['registros'] > 0) {
                    echo "Nº registros " . $elementos['registros'];
                    echo "<br>";
                    // se coge el nombre de la tabla
                    $nombretabla = trim($elementos['seq']);
                    foreach ($elementos->grupo_datos as $hijos) {
                         // indice de la tabla
                         $nombrereg = trim($hijos['seq']);
                         foreach ($hijos->dato as $hijo) {
                              // indice de los registros
                              $indice = trim($hijo['nombre_dato']);
                              $tablas[$nombretabla][$nombrereg][$indice] = trim($hijo);
                              //echo $elementos['seq']." ".$indice." ".$hijo;
                              //echo "<br>";
                         }
                    }
               } else {
                    foreach ($elementos->dato as $hijos) {
                         echo $hijos['nombre_dato'] . " " . $hijos;
                         echo "<br>";
                    }
               }
          }
          // importar en las tablas
          // vaciar tabla cursos del centro
          $this->load->model("cursos_m");
          $this->cursos_m->vaciar();
          // bucle por todos los cursos
          foreach ($tablas['CURSOS_DEL_CENTRO'] as $cursos) {
               $datos = array("Codigo" => $cursos['X_OFERTAMATRIG'], "Descripcion" => $cursos['D_OFERTAMATRIG']);
               $this->cursos_m->insertar($datos);
          }
          // vaciar tabla materias del centro
          $this->load->model("materias_m");
          $this->materias_m->vaciar();
          // bucle por todos los materias
          foreach ($tablas['MATERIAS'] as $materias) {
               $datos = array("Codigo" => $materias['X_MATERIAOMG'], "Descripcion" => $materias['D_MATERIAC'], "Curso" => $materias['X_OFERTAMATRIG']);
               $this->materias_m->insertar($datos);
          }
          // vaciar tabla actividades del centro
          $this->load->model("actividades_m");
          $this->actividades_m->vaciar();
          // bucle por todos los actividades
          foreach ($tablas['ACTIVIDADES'] as $actividades) {
               $datos = array("Codigo" => $actividades['X_ACTIVIDAD'], "Descripcion" => $actividades['D_ACTIVIDAD'], "Mostrar_en_listas" => 1);
               $this->actividades_m->insertar($datos);
          }
          // vaciar tabla dependencias del centro
          $this->load->model("aulas_m");
          $this->aulas_m->vaciar();
          // bucle por todos los dependencias
          foreach ($tablas['DEPENDENCIAS'] as $dependencias) {
               $datos = array("Codigo" => $dependencias['X_DEPENDENCIA'], "Descripcion" => $dependencias['D_DEPENDENCIA']);
               $this->aulas_m->insertar($datos);
          }
          // vaciar tabla tramos_horarios del centro
          $this->load->model("tramos_horarios_m");
          $this->tramos_horarios_m->vaciar();
          // bucle por todos los tramos
          foreach ($tablas['TRAMOS_HORARIOS'] as $tramos_horarios) {
               $tramonum = $tramos_horarios['T_HORCEN'];
               if (intval($tramonum) == 0 and strlen($tramonum) > 1) {
                    if (substr($tramonum, 0, 1) == "m") {
                         $tramonum = substr($tramonum, 1, 1);
                    } else {
                         $tramonum = intval(substr($tramonum, 1, 1)) + 8;
                    }
               }
               if (intval($tramos_horarios['X_TRAMO']) < 8) {
                    $jor = "M";
               } else {
                    $jor = "V";
               }
               $datos = array("Codigo" => $tramos_horarios['X_TRAMO'], "Tramo" => $tramonum, "Inicio" => $tramos_horarios['N_INICIO'], "Fin" => $tramos_horarios['N_FIN'], "Jornada" => $jor);
               $this->tramos_horarios_m->insertar($datos);
          }
          // vaciar tabla unidades del centro
          $this->load->model("grupos_m");
          $this->grupos_m->vaciar();
          // bucle por todos los unidades
          foreach ($tablas['UNIDADES'] as $unidades) {
               $datos = array("Codigo" => $unidades['X_UNIDAD'], "Descripcion" => $unidades['T_NOMBRE'], "Curso" => $unidades['X_OFERTAMATRIG']);
               // Ver si ya existe el codigo
               if (!$this->grupos_m->get_grupo_cod($unidades['X_UNIDAD'])) {
                    $this->grupos_m->insertar($datos);
               }
          }
          // vaciar tabla profesores del centro
          $this->load->model("profesores_m");
          $this->profesores_m->vaciar();
          // bucle por todos los profesores
          foreach ($tablas['EMPLEADOS'] as $profesores) {
               $datos = array("Codigo" => $profesores['X_EMPLEADO'], "TomaPosesion" => $profesores['F_TOMAPOS'], "Puesto" => $profesores['D_PUESTO'], "Apellido1" => $profesores['APELLIDO1'], "Apellido2" => $profesores['APELLIDO2'], "Nombre" => $profesores['NOMBRE'], "Sustituto" => '');
               $this->profesores_m->insertar($datos);
          }

          //redirect(base_url());
          $this->load->view("resumimpt_v");
     }

     public function importarHorarios($fichero, $flag = 0)
     {

          // Cargar fichero xml
          $xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] . '/guardias/xml/' . $fichero);
          // array de tablas
          $tablas = array();
          foreach ($xml->BLOQUE_DATOS->children() as $elementos) {
               // primer nivel
               echo $elementos['seq'];
               echo "<br>";
               // si hay siguiente nivel
               if ($elementos['registros'] > 0) {
                    echo "Nº registros " . $elementos['registros'];
                    echo "<br>";
                    // se coge el nombre de la tabla
                    $nombretabla = trim($elementos['seq']);
                    foreach ($elementos->grupo_datos as $hijos) {
                         // indice de la tabla
                         $nombrereg = trim($hijos['seq']);
                         foreach ($hijos->dato as $hijo) {
                              // indice de los registros
                              if ($indice = trim($hijo['nombre_dato']) == "X_EMPLEADO") {
                                   $indice = trim($hijo); // Codigo del profesor
                                   foreach ($hijos->grupo_datos as $hijo2) {
                                        // indice de los registros
                                        $indice2 = trim($hijo2['seq']); // Actividad
                                        foreach ($hijo2->dato as $hijo3) {
                                             // indice de los registros
                                             $indice3 = trim($hijo3['nombre_dato']); // Cada campo del horario
                                             $tablas[$nombretabla][$nombrereg][$indice][$indice2][$indice3] = trim($hijo3);
                                        }
                                   }
                              }
                         }
                    }
               } else {
                    foreach ($elementos->dato as $hijos) {
                         echo $hijos['nombre_dato'] . " " . $hijos;
                         echo "<br>";
                    }
               }
          }
          // importar en las tablas
          // vaciar tabla cursos del centro
          $this->load->model("horarios_m");
          if ($flag == 0) {
               $this->horarios_m->vaciar();
          }
          // bucle por todos los cursos
          foreach ($tablas['HORARIOS_REGULARES'] as $hor) {
               foreach ($hor as $clave => $valor) {
                    foreach ($valor as $actividades) {
                         $datos = array("CodigoProf" => $clave, "DiaSem" => $actividades['N_DIASEMANA'], "Tramo" => $actividades['X_TRAMO'], "Aula" => $actividades['X_DEPENDENCIA'], "Unidad" => $actividades['X_UNIDAD'], "Curso" => $actividades['X_OFERTAMATRIG'], "Materia" => $actividades['X_MATERIAOMG'], "Hinicio" => $actividades['N_HORINI'], "Hfin" => $actividades['N_HORFIN'], "Actividad" => $actividades['X_ACTIVIDAD']);
                         $this->horarios_m->insertar($datos);
                    }
               }
          }

          //redirect(base_url());
          $this->load->view("resumimpt_v");
     }
}
