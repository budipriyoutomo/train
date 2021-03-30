<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mtraining extends MY_Controller {
	
	protected $access = array('SuperAdmin','Admin', 'User');
	
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mtraining_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
	    $mtraining = $this->Mtraining_model->get_all();

        $data = array(
            'mtraining_data' => $mtraining
        );
		$this->load->view('header');
        $this->load->view('mtraining/mtraining_list', $data);
        $this->load->view('footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Mtraining_model->json();
    }

    public function read($id) 
    {
        $row = $this->Mtraining_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idtraining' => $row->idtraining,
		'nama' => $row->nama,
		'tempat' => $row->tempat,
		'tanggal' => $row->tanggal,
		'jam' => $row->jam,
		'trainer' => $row->trainer,
		'kapasitas' => $row->kapasitas,
		'tersedia' => $row->tersedia,
		'terisi' => $row->terisi,
	    );
            
			$this->load->view('header');
            $this->load->view('mtraining/mtraining_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mtraining'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('mtraining/create_action'),
	    'idtraining' => set_value('idtraining'),
	    'nama' => set_value('nama'),
	    'tempat' => set_value('tempat'),
	    'tanggal' => set_value('tanggal'),
	    'jam' => set_value('jam'),
	    'trainer' => set_value('trainer'),
	    'kapasitas' => set_value('kapasitas'),
	    
	    
	);

		$this->load->view('header');
		$this->load->view('mtraining/mtraining_form', $data);
        $this->load->view('footer');
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'tempat' => $this->input->post('tempat',TRUE),
		'tanggal' => date("Y-m-d",strtotime($this->input->post('tanggal',TRUE))),
		'jam' => date("H:i",strtotime($this->input->post('jam',TRUE))),
		'trainer' => $this->input->post('trainer',TRUE),
		'kapasitas' => $this->input->post('kapasitas',TRUE),
		'tersedia' => $this->input->post('kapasitas',TRUE),
		'terisi' => 0,
	    );

            $this->Mtraining_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mtraining'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mtraining_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mtraining/update_action'),
		'idtraining' => set_value('idtraining', $row->idtraining),
		'nama' => set_value('nama', $row->nama),
		'tempat' => set_value('tempat', $row->tempat),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'jam' => set_value('jam', $row->jam),
		'trainer' => set_value('trainer', $row->trainer),
		'kapasitas' => set_value('kapasitas', $row->kapasitas),
		'tersedia' => set_value('tersedia', $row->tersedia),
		'terisi' => set_value('terisi', $row->terisi),
	    );
			$this->load->view('header');
			$this->load->view('mtraining/mtraining_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mtraining'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idtraining', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'tempat' => $this->input->post('tempat',TRUE),
		'tanggal' =>  date("Y-m-d",strtotime($this->input->post('tanggal',TRUE))),
		'jam' => date("H:i",strtotime($this->input->post('jam',TRUE))),
		'trainer' => $this->input->post('trainer',TRUE),
		'kapasitas' => $this->input->post('kapasitas',TRUE),
		'tersedia' => $this->input->post('tersedia',TRUE),
		'terisi' => $this->input->post('terisi',TRUE),
	    );

            $this->Mtraining_model->update($this->input->post('idtraining', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mtraining'));
        }
    }
    
    public function delete($id) 
    {
     	$level = $this->session->userdata('role') ; 
	
		if ($level!='User') 
		{
			$row = $this->Mtraining_model->get_by_id($id);

			if ($row) {
				$this->Mtraining_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('mtraining'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('mtraining'));
			}
		}else{
			$this->session->set_flashdata('message', 'Access Denied');
			redirect(site_url('mtraining'));
			
		}
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('tempat', 'tempat', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('jam', 'jam', 'trim|required');
	$this->form_validation->set_rules('trainer', 'trainer', 'trim|required');
	$this->form_validation->set_rules('kapasitas', 'kapasitas', 'trim|required');
	
	$this->form_validation->set_rules('idtraining', 'idtraining', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mtraining.xls";
        $judul = "mtraining";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam");
	xlsWriteLabel($tablehead, $kolomhead++, "Trainer");
	xlsWriteLabel($tablehead, $kolomhead++, "Kapasitas");
	xlsWriteLabel($tablehead, $kolomhead++, "Tersedia");
	xlsWriteLabel($tablehead, $kolomhead++, "Terisi");

	foreach ($this->Mtraining_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam);
	    xlsWriteLabel($tablebody, $kolombody++, $data->trainer);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kapasitas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tersedia);
	    xlsWriteLabel($tablebody, $kolombody++, $data->terisi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mtraining.doc");

        $data = array(
            'mtraining_data' => $this->Mtraining_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('mtraining/mtraining_doc',$data);
    }

}

/* End of file Mtraining.php */
/* Location: ./application/controllers/Mtraining.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-05 06:31:09 */
/* http://harviacode.com */