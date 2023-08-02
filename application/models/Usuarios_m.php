<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function leerUsuarios() {
        // leer socios para control de aistencia
        $sqlStr="Select * from usuarios where order by 1";
        $consulta=$this->db->query($sqlStr);
        if ($consulta->num_rows()) {
            return $consulta->result_array();
        } else {
            return false;
        }

    }
    function leerUsuario($usu) {
        // leer socio para perfil
        $sqlStr="Select * from usuarios WHERE usuario = ?";
        $consulta=$this->db->query($sqlStr,array($usu));
        if ($consulta->num_rows()) {
            return $consulta->row();
        } else {
            return false;
        }

    }
    function actperfil($data) {
        $this->db->update('usuarios', $data, array('usuario' => $data['usuario']));

    }

    function autUsuario($usu,$pass) {

        $sqlStr="Select * from usuarios WHERE usuario = ? AND clave= ?";
        $consulta=$this->db->query($sqlStr,array($usu,md5($pass)));
        if ($consulta->num_rows()) {
            return $consulta->row();
        } else {
            return false;
        }
    }

}