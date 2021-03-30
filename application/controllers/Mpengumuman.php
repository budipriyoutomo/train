<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mpengumuman extends MY_Controller {
	
	protected $access = array('SuperAdmin','Admin', 'User');
	
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mpengumuman_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
	    $mpengumuman = $this->Mpengumuman_model->get_all();

        $data = array(
            'mpengumuman_data' => $mpengumuman
        );
		$this->load->view('header');
        $this->load->view('mpengumuman/mpengumuman_list', $data);
        $this->load->view('footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Mpengumuman_model->json();
    }

    public function read($id) 
    {
        $row = $this->Mpengumuman_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'pengumuman' => $row->pengumuman,
		'start' => $row->start,
		'end' => $row->end,
	    );
            
			$this->load->view('header');
            $this->load->view('mpengumuman/mpengumuman_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mpengumuman'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('mpengumuman/create_action'),
	    'id' => set_value('id'),
	    'pengumuman' => set_value('pengumuman'),
	    'start' => set_value('start'),
	    'end' => set_value('end'),
	);

		$this->load->view('header');
		$this->load->view('mpengumuman/mpengumuman_form', $data);
        $this->load->view('footer');
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'pengumuman' => $this->input->post('pengumuman',TRUE),
		'start' => date("Y-m-d",strtotime($this->input->post('start',TRUE))),
		'end' => date("Y-m-d",strtotime($this->input->post('end',TRUE))),
	    );

            $this->Mpengumuman_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mpengumuman'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mpengumuman_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mpengumuman/update_action'),
		'id' => set_value('id', $row->id),
		'pengumuman' => set_value('pengumuman', $row->pengumuman),
		'start' => set_value('start', $row->start),
		'end' => set_value('end', $row->end),
	    );
			$this->load->view('header');
			$this->load->view('mpengumuman/mpengumuman_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mpengumuman'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'pengumuman' => $this->input->post('pengumuman',TRUE),
		'start' => date("Y-m-d",strtotime($this->input->post('start',TRUE))),
		'end' => date("Y-m-d",strtotime($this->input->post('end',TRUE))),
	    );

            $this->Mpengumuman_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mpengumuman'));
        }
    }
    
    public function delete($id) 
    {
     	$level = $this->session->userdata('role') ; 
	
		if ($level!='User') 
		{
			$row = $this->Mpengumuman_model->get_by_id($id);

			if ($row) {
				$this->Mpengumuman_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('mpengumuman'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('mpengumuman'));
			}
		}else{
			$this->session->set_flashdata('message', 'Access Denied');
			redirect(site_url('mpengumuman'));
			
		}
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('pengumuman', 'pengumuman', 'trim|required');
	$this->form_validation->set_rules('start', 'start', 'trim|required');
	$this->form_validation->set_rules('end', 'end', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mpengumuman.xls";
        $judul = "mpengumuman";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Pengumuman");
	xlsWriteLabel($tablehead, $kolomhead++, "Start");
	xlsWriteLabel($tablehead, $kolomhead++, "End");

	foreach ($this->Mpengumuman_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pengumuman);
	    xlsWriteLabel($tablebody, $kolombody++, $data->start);
	    xlsWriteLabel($tablebody, $kolombody++, $data->end);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mpengumuman.doc");

        $data = array(
            'mpengumuman_data' => $this->Mpengumuman_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('mpengumuman/mpengumuman_doc',$data);
    }

}

/* End of file Mpengumuman.php */
/* Location: ./application/controllers/Mpengumuman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-27 07:41:02 */
/* http://harviacode.com */