<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mjabatan_model extends CI_Model
{

    public $table = 'mjabatan';
    public $id = 'idjabatan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('idjabatan,mdept.nama as iddept,namajabatan');
        $this->datatables->from('mjabatan');
		$this->datatables->join('mdept', 'mjabatan.iddept=mdept.iddept');
        //add this line for join
        //$this->datatables->join('table2', 'mjabatan.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('mjabatan/read/$1'),'Read')." | ".anchor(site_url('mjabatan/update/$1'),'Update')." | ".anchor(site_url('mjabatan/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'idjabatan');
        return $this->datatables->generate();
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
		$this->db->select('idjabatan,mdept.iddept,namajabatan, mdept.nama as namadept');
		$this->db->from($this->table);
		$this->db->join('mdept', 'mjabatan.iddept = mdept.iddept');
		//$query = $this->db->get();
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
		
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('idjabatan', $q);
	$this->db->or_like('iddept', $q);
	$this->db->or_like('namajabatan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idjabatan', $q);
	$this->db->or_like('iddept', $q);
	$this->db->or_like('namajabatan', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

/* End of file Mjabatan_model.php */
/* Location: ./application/models/Mjabatan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-05 06:31:09 */
/* http://harviacode.com */