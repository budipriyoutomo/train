<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdept extends MY_Controller {
	
	protected $access = array('SuperAdmin','Admin');
	
    function __construct()
    {
        parent::__construct();
		$this->load->model('Master');
        $this->load->model('Mdept_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
	    $mdept = $this->Mdept_model->get_all();

        $data = array(
            'mdept_data' => $mdept
        );
		$this->load->view('header');
        $this->load->view('mdept/mdept_list', $data);
        $this->load->view('footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Mdept_model->json();
    }

    public function read($id) 
    {
        $row = $this->Mdept_model->get_by_id($id);
        if ($row) {
            $data = array(
		'iddept' => $row->iddept,
		'nama' => $row->nama,
	    );
            
			$this->load->view('header');
            $this->load->view('mdept/mdept_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mdept'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('mdept/create_action'),
	    'iddept' => set_value('iddept'),
	    'nama' => set_value('nama'),
	);

	
	$this->load->view('header');
	
		$this->load->view('mdept/mdept_form', $data);
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
	    );

            $this->Mdept_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mdept'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mdept_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mdept/update_action'),
		'iddept' => set_value('iddept', $row->iddept),
		'nama' => set_value('nama', $row->nama),
	    );
			$this->load->view('header');
			$this->load->view('mdept/mdept_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mdept'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('iddept', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->Mdept_model->update($this->input->post('iddept', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mdept'));
        }
    }
    
    public function delete($id) 
    {
     	$level = $this->session->userdata('role') ; 
	
		if ($level!='User') 
		{
			$row = $this->Mdept_model->get_by_id($id);

			if ($row) {
				$this->Mdept_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('mdept'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('mdept'));
			}
		}else{
			$this->session->set_flashdata('message', 'Access Denied');
			redirect(site_url('mdept'));
			
		}
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');

	$this->form_validation->set_rules('iddept', 'iddept', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mdept.xls";
        $judul = "mdept";
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

	foreach ($this->Mdept_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mdept.doc");

        $data = array(
            'mdept_data' => $this->Mdept_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('mdept/mdept_doc',$data);
    }

}

/* End of file Mdept.php */
/* Location: ./application/controllers/Mdept.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-05 06:31:09 */
/* http://harviacode.com */