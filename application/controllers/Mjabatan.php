<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mjabatan extends MY_Controller {
	
	protected $access = array('SuperAdmin','Admin', 'User');
	
    function __construct()
    {
        parent::__construct();
		$this->load->model('Master');
        $this->load->model('Mjabatan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
	    $mjabatan = $this->Mjabatan_model->get_all();

        $data = array(
            'mjabatan_data' => $mjabatan
        );
		$this->load->view('header');
        $this->load->view('mjabatan/mjabatan_list', $data);
        $this->load->view('footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Mjabatan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Mjabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idjabatan' => $row->idjabatan,
		'iddept' => $row->iddept,
		'namajabatan' => $row->namajabatan,
	    );
            
			$this->load->view('header');
            $this->load->view('mjabatan/mjabatan_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mjabatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('mjabatan/create_action'),
	    'idjabatan' => set_value('idjabatan'),
	    'iddept' => set_value('iddept'),
	    'namajabatan' => set_value('namajabatan'),
	);
	
	
		$combo['query']= $this->Master->getdept("");
	
		$this->load->view('header',$combo);
		$this->load->view('mjabatan/mjabatan_form', $data);
        $this->load->view('footer');
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'iddept' => $this->input->post('iddept',TRUE),
		'namajabatan' => $this->input->post('namajabatan',TRUE),
	    );

            $this->Mjabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mjabatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mjabatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mjabatan/update_action'),
		'idjabatan' => set_value('idjabatan', $row->idjabatan),
		'iddept' => set_value('iddept', $row->iddept),
		'namadept' => set_value('iddept', $row->namadept),
		'namajabatan' => set_value('namajabatan', $row->namajabatan),
	    );
				$combo['query']= $this->Master->getdept($row->iddept);
	
		$this->load->view('header',$combo);
			
			$this->load->view('mjabatan/mjabatan_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mjabatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idjabatan', TRUE));
        } else {
            $data = array(
		'iddept' => $this->input->post('iddept',TRUE),
		'namajabatan' => $this->input->post('namajabatan',TRUE),
	    );

            $this->Mjabatan_model->update($this->input->post('idjabatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mjabatan'));
        }
    }
    
    public function delete($id) 
    {
     	$level = $this->session->userdata('role') ; 
	
		if ($level!='User') 
		{
			$row = $this->Mjabatan_model->get_by_id($id);

			if ($row) {
				$this->Mjabatan_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('mjabatan'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('mjabatan'));
			}
		}else{
			$this->session->set_flashdata('message', 'Access Denied');
			redirect(site_url('mjabatan'));
			
		}
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('iddept', 'iddept', 'trim|required');
	$this->form_validation->set_rules('namajabatan', 'namajabatan', 'trim|required');

	$this->form_validation->set_rules('idjabatan', 'idjabatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mjabatan.xls";
        $judul = "mjabatan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Iddept");
	xlsWriteLabel($tablehead, $kolomhead++, "Namajabatan");

	foreach ($this->Mjabatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->iddept);
	    xlsWriteLabel($tablebody, $kolombody++, $data->namajabatan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mjabatan.doc");

        $data = array(
            'mjabatan_data' => $this->Mjabatan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('mjabatan/mjabatan_doc',$data);
    }

}

/* End of file Mjabatan.php */
/* Location: ./application/controllers/Mjabatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-05 06:31:09 */
/* http://harviacode.com */