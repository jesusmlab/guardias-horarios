<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Turman_m extends CI_Model
{

    public $table = 'turnos';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('profesor', $q);
	$this->db->or_like('dia', $q);
	$this->db->or_like('tramo', $q);
	$this->db->or_like('turno', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL,$di = NULL, $tr = NULL) {
        if (empty($di)) {
            $this->db->order_by("dia,tramo,turno,profesor");
            $this->db->like('id', $q);
            $this->db->or_like('profesor', $q);
            $this->db->or_like('dia', $q);
            $this->db->or_like('tramo', $q);
            $this->db->or_like('turno', $q);
            $this->db->limit($limit, $start);
                return $this->db->get($this->table)->result();
        } else {
            $this->db->order_by("dia,tramo,turno,profesor");
            $this->db->like('dia', $di);
            $this->db->like('tramo', $tr);
            $this->db->limit($limit, $start);
                return $this->db->get($this->table)->result();
         
        }
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Turman_m.php */
/* Location: ./application/models/Turman_m.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-26 19:37:21 */
/* http://harviacode.com */