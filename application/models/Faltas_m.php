<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faltas_m  extends CI_Model
{
    // leer clientes
    function __construct()
    {

        parent::__construct();
    }

    public function total_filas($filtro)
    {
        $this->db->like('profesor', $filtro);
        $consulta = $this->db->get('faltas');
        return  $consulta->num_rows();
    }
    public function get_clasificacion_faltas()
    {
        $query = $this->db->query("Select * from consulta_clasificacion_faltas;");
        return $query->result_array();
    }
    public function get_faltas()
    {
        $query = $this->db->query("Select * from faltas order by fecha;");
        return $query->result_array();
    }
    //obtenemos todas las provincias a paginar con la función
    //total_posts_paginados pasando la cantidad por página y el segmento
    //como parámetros de la misma
    function get_faltas_pag($por_pagina, $segmento, $filtro, $causaex)
    {
        $this->db->order_by("fecha", "desc");
        $this->db->where('causa !=', $causaex);
        $this->db->group_start();
        $this->db->like('profesor', $filtro);
        $this->db->group_end();
        $consulta = $this->db->get('faltas', $por_pagina, $segmento);
        if ($consulta->num_rows() > 0) {
            return $consulta->result_array();
        }
    }
    public function insertar($datos)
    {
        $this->db->insert('faltas', $datos);
    }

    public function actualizar($id, $datos)
    {
        $this->db->where('id', $id);
        $this->db->update('faltas', $datos);
    }
    public function borrar($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('faltas');
    }
    public function get_faltas_dia()
    {
        $this->db->where("guardiaSN", TRUE);
        $consulta = $this->db->get('consulta_faltas');
        return  $consulta->result_array();
    }
    public function contar_faltas_dia()
    {
        $this->db->select('COUNT(fecha) as nfaltas');
        $this->db->where("fecha", date("Y-m-d"));
        $this->db->where("guardiaSN", TRUE);

        $consulta = $this->db->get('faltas');
        return  $consulta->result_array();
    }
    public function get_faltas_diasel($fecha)
    {
        $sqlStr = "select consulta_horarios.CodigoProf AS CodigoProf,consulta_horarios.Apenom AS Apenom,consulta_horarios.Sustituto AS Sustituto,consulta_horarios.DiaSem AS DiaSem,consulta_horarios.Tramo AS Tramo,consulta_horarios.Aula AS Aula,consulta_horarios.Unidad AS Unidad,consulta_horarios.Curso AS Curso,consulta_horarios.Materia AS Materia,consulta_horarios.Inicio AS Inicio,consulta_horarios.Fin AS Fin,consulta_horarios.Actividad AS Actividad,faltas.fecha AS fecha,faltas.profesor AS profesor,faltas.tramos AS tramos,faltas.causa AS causa,faltas.anotacion1 AS anotacion1,faltas.anotacion2 AS anotacion2,faltas.anotacion3 AS anotacion3,faltas.anotacion4 AS anotacion4,faltas.anotacion5 AS anotacion5,faltas.anotacion6 AS anotacion6,faltas.anotacion7 AS anotacion7,faltas.id AS id from (consulta_horarios join faltas on((consulta_horarios.CodigoProf = faltas.profesor))) where guardiaSN=1 and ((faltas.fecha = ?) and (cast(consulta_horarios.DiaSem as unsigned) = date_format(?,'%w'))) order by consulta_horarios.CodigoProf,consulta_horarios.DiaSem,consulta_horarios.Tramo";
        $consulta = $this->db->query($sqlStr, array($fecha, $fecha));
        if ($consulta->num_rows()) {
            return $consulta->result_array();
        } else {
            return false;
        }
    }
    public function contar_faltas_diasel($fecha)
    {
        $this->db->select('COUNT(fecha) as nfaltas');
        $this->db->where("fecha", $fecha);
        $this->db->where("guardiaSN", TRUE);

        $consulta = $this->db->get('faltas');
        return  $consulta->result_array();
    }
    public function get_faltas_fechasprofe($desdefecha, $hastafecha, $profe, $causa)
    {
        $sqlStr = "SELECT faltas.*,causas.descripcion,concat(profesores.Apellido1,' ',profesores.Apellido2,',',profesores.Nombre) AS apenom,profesores.sustituto from faltas inner join causas on faltas.causa=causas.codigo inner join profesores on faltas.profesor=profesores.Codigo where faltas.fecha between ? and ? and faltas.profesor like ? and faltas.causa like ? order by faltas.fecha,faltas.profesor";
        $consulta = $this->db->query($sqlStr, array($desdefecha, $hastafecha, $profe, $causa));
        if ($consulta->num_rows()) {
            return $consulta->result_array();
        } else {
            return false;
        }
    }
    public function leerTodasPorFecha($fdesde, $fhasta, $causa)
    {
        $sqlStr = "SELECT fecha as start,count(*) as title FROM faltas WHERE causa like ? and fecha between ? and ? GROUP BY fecha";
        $consulta = $this->db->query($sqlStr, array($causa, $fdesde, $fhasta));
        if ($consulta->num_rows()) {
            return $consulta->result_array();
        } else {
            return false;
        }
    }
    public function vaciar()
    {
        $this->db->truncate('faltas');
    }
}
