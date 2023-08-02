<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horarios_m  extends CI_Model  {
// leer clientes
    public function __construct() {

        parent::__construct();
    }

    public function get_horarios_prof($profesor="*") {

        $this->db->like("CodigoProf",$profesor);
        $this->db->order_by("CodigoProf,Tramo,DiaSem","asc");
        $fila=$this->db->get("consulta_horarios");
        return $fila->result_array();
    }
    public function get_horarios_grupo($unidad="*") {

        $this->db->like("Unidad",$unidad);
        $this->db->order_by("Tramo,DiaSem","asc");
        $fila=$this->db->get("consulta_horarios");
        return $fila->result_array();
    }
    public function get_horarios_aula($aula="*") {

        $this->db->like("Aula",$aula);
        $this->db->order_by("Tramo,DiaSem","asc");
        $fila=$this->db->get("consulta_horarios");
        return $fila->result_array();
    }

    public function get_horarios_vista()  {
    
        $query = $this->db->query("Select * from consulta_horarios order by CodigoProf,DiaSem,Tramo;");
        return $query->result_array();

    }
    public function get_horarios()  {
    
        $query = $this->db->query("Select * from horarios order by CodigoProf,DiaSem,Tramo;");
        return $query->result_array();

    }
    public function get_horarios_id($id) {
        // leer linea de horario mediante el ID
        $sqlStr="Select * from horarios WHERE Id = ?";
        $consulta=$this->db->query($sqlStr,array($id));
        if ($consulta->num_rows()) {
            return $consulta->row_array();
        } else {
            return false;
        }

    }

    function acthorarios($data) {
        $this->db->update('horarios', $data, array('Id' => $data['Id']));
    }


    public function get_horarios_v_prof_dia($prof,$dia)  {
    
        $this->db->where("CodigoProf",$prof);
        $this->db->where("DiaSem",$dia);
        $this->db->order_by("CodigoProf,Tramo,DiaSem","asc");
        $fila=$this->db->get("consulta_horarios");
        return $fila->result_array();

    }
    public function get_horario_prof_dia_tramo($prof,$dia,$tramo)  {
    
        $this->db->where("CodigoProf",$prof);
        $this->db->where("DiaSem",$dia);
        $this->db->where("Tramo",$tramo);
        $fila=$this->db->get("horarios");
        return $fila->row_array();

    }
    public function get_horario_grupo_dia_tramo($grupo,$dia,$tramo)  {
    
        $this->db->where("Unidad",$grupo);
        $this->db->where("DiaSem",$dia);
        $this->db->where("Tramo",$tramo);
        $fila=$this->db->get("horarios");
        return $fila->row_array();

    }
    public function insertar($datos){
        $this->db->insert('horarios', $datos);
    }

    public function actualizar($prof,$dias,$tramo,$datos){
        $this->db->where('CodigoProf', $prof);
        $this->db->where('Tramo', $tramo);
        $this->db->where('DiaSem', $dias);
        $this->db->update('horarios', $datos); 
    }
    public function actualizar_g($grupo,$dias,$tramo,$datos){
        $this->db->where('Unidad', $grupo);
        $this->db->where('Tramo', $tramo);
        $this->db->where('DiaSem', $dias);
        $this->db->update('horarios', $datos); 
    }
    public function cambiarAula($grupo,$origen,$destino){
        $this->db->where('Unidad', $grupo);
        $this->db->where('Aula', $origen);
        $this->db->update('horarios', ['Aula'=>$destino]); 
    }
    public function borrar($prof,$dias,$tramo){
        $this->db->where('CodigoProf', $prof);
        $this->db->where('Tramo', $tramo);
        $this->db->where('DiaSem', $dias);
		$celda=array('Actividad' => '001',
                     'Aula' => null,
                     'Unidad' => null,
                     'Curso' => null,
                     'Materia' => null);
		$this->db->update('horarios', $celda); 
        //$this->db->delete('horarios'); 
    }
    public function borrar_g($grupo,$dias,$tramo){
        $this->db->where('Unidad', $grupo);
        $this->db->where('Tramo', $tramo);
        $this->db->where('DiaSem', $dias);
        $this->db->delete('horarios'); 
    }
    public function borrarhorarioprof($prof){

        $this->db->where('CodigoProf', $prof);
        $this->db->delete('horarios'); 

    }
    public function estadisActividad($prof){

        $sql="select Actividad,Count(*) as numero from consulta_horarios where CodigoProf='".$prof."' group by Actividad";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function estadisMateria($prof){

        $sql="select Materia,Count(*) as numero from consulta_horarios where CodigoProf='".$prof."' group by Materia";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function estadisMateriaGrupos($grupo){

        $sql="select Materia,Count(*) as numero from consulta_horarios where Unidad='".$grupo."' group by Materia";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function get_horarios_xml() {
        $query = $this->db->query("Select * from horarios order by CodigoProf,Tramo,DiaSem;");
        return $query;
        
    }
    public function vaciar(){
        $this->db->truncate('horarios');
    }

}