<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ttraining_model extends CI_Model
{

    public $table = 'ttraining';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
		if ($this->session->userdata('role')=='User'){
			$this->datatables->select('ttraining.id as id ,mtraining.nama as idtraining,user.nama as iduser,kehadiran');
		}else {
			$this->datatables->select('ttraining.id as id ,mtraining.nama as idtraining,user.nama as iduser,kehadiran,nilai,evaluasi');
		}

        $this->datatables->from('ttraining');
        //add this line for join
        $this->datatables->join('mtraining', 'ttraining.idtraining = mtraining.idtraining');
		$this->datatables->join('user', 'ttraining.iduser = user.id');
        $this->datatables->add_column('action', anchor(site_url('ttraining/read/$1'),'Read')." | ".anchor(site_url('ttraining/update/$1'),'Update')." | ".anchor(site_url('ttraining/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

	function mtrain($id){
		$this->db->select('tanggal, tempat, nama, jam, trainer, kapasitas, tersedia, terisi');
    //$this->db->from('mtraining');
		$this->db->where('idtraining',$id);

		return $this->db->get('mtraining')->result_array();
    //return $id;
	}

  function ttrain($id){
    $this->db->select('ttraining.id as id, mtraining.nama as training, user.nama as user, ttraining.kehadiran as kehadiran, ttraining.nilai as nilai, ttraining.evaluasi as evaluasi');
    $this->db->from('ttraining');
    $this->db->join('mtraining','mtraining.idtraining = ttraining.idtraining' );
    $this->db->join('user','user.id = ttraining.iduser' );
    $this->db->where('ttraining.idtraining',$id);
    return $this->db->get()->result_array();
    //return $id;
  }

  function dt_ttrain($id){
    $this->datatables->select('mtraining.nama as training, user.nama as user, ttraining.kehadiran as kehadiran, ttraining.nilai as nilai, ttraining.evaluasi as evaluasi');
    $this->datatables->from('ttraining');
    $this->datatables->join('mtraining','mtraining.idtraining = ttraining.idtraining' );
    $this->datatables->join('user','user.id = ttraining.iduser' );
    $this->datatables->where('ttraining.idtraining',$id);
    return $this->datatables->generate();
//    return $this->db->get()->result_array();
    //return $id;
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
	$this->db->or_like('idtraining', $q);
	$this->db->or_like('iduser', $q);
	$this->db->or_like('kehadiran', $q);
	$this->db->or_like('nilai', $q);
	$this->db->or_like('evaluasi', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('idtraining', $q);
	$this->db->or_like('iduser', $q);
	$this->db->or_like('kehadiran', $q);
	$this->db->or_like('nilai', $q);
	$this->db->or_like('evaluasi', $q);
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

/* End of file Ttraining_model.php */
/* Location: ./application/models/Ttraining_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-28 04:18:57 */
/* http://harviacode.com */
