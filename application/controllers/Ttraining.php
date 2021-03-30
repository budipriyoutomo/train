<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ttraining extends MY_Controller {

	protected $access = array('SuperAdmin','Admin', 'User');

    function __construct()
    {
        parent::__construct();
		      $this->load->model('Master');
        $this->load->model('Ttraining_model');
        $this->load->model('Mtraining_model');
        $this->load->library('form_validation');
	       $this->load->library('datatables');
    }

    public function index()
    {
	    $ttraining = $this->Ttraining_model->get_all();

        $data = array(
            'ttraining_data' => $ttraining
        );
		$this->load->view('header');
        $this->load->view('ttraining/ttraining_list', $data);
        $this->load->view('footer');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Ttraining_model->json();
    }

    public function read($id)
    {
        $row = $this->Ttraining_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'idtraining' => $row->idtraining,
		'iduser' => $row->iduser,
		'kehadiran' => $row->kehadiran,
		'nilai' => $row->nilai,
		'evaluasi' => $row->evaluasi,
	    );

			$this->load->view('header');
            $this->load->view('ttraining/ttraining_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ttraining'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ttraining/create_action'),
	    'id' => set_value('id'),
	    'idtraining' => $this->Master->gettraining(),
	    'iduser' => set_value('iduser'),
	    'kehadiran' => 0,
	    'nilai' => set_value('nilai'),
	    'evaluasi' => set_value('evaluasi'),
	);

		$this->load->view('header');
		$this->load->view('ttraining/ttraining_form', $data);
        $this->load->view('footer');

    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idtraining' => $this->input->post('idtraining',TRUE),
		'iduser' => $this->input->post('iduser',TRUE),
		'kehadiran' => $this->input->post('kehadiran',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
		'evaluasi' => $this->input->post('evaluasi',TRUE),

	    );

            $this->Ttraining_model->insert($data);
            $this->updatemtraining($this->input->post('idtraining',TRUE));
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ttraining'));
        }
    }

  public function updatemtraining($id){

  $row = $this->Mtraining_model->get_by_id($id);

    if ($row){
      $data = array(
        'tersedia' => $row->tersedia -1 ,
        'terisi' => $row->terisi + 1
     );
    }
    $this->Mtraining_model->update($id,$data);

  }

	public function traincontrol($id){

		header('Content-Type: application/json');
		$data = $this->Ttraining_model->mtrain($id);
		echo json_encode($data);

	}
    public function update($id)
    {
        $row = $this->Ttraining_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ttraining/update_action'),
            		'id' => set_value('id', $row->id),
            		'idtraining' => set_value('idtraining', $row->idtraining),
            		'iduser' => set_value('iduser', $row->iduser),
            		'kehadiran' => set_value('kehadiran', $row->kehadiran),
            		'nilai' => set_value('nilai', $row->nilai),
            		'evaluasi' => set_value('evaluasi', $row->evaluasi),
            	    );
			$this->load->view('header');
			$this->load->view('ttraining/ttraining_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ttraining'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'idtraining' => $this->input->post('idtraining',TRUE),
		'iduser' => $this->input->post('iduser',TRUE),
		'kehadiran' => $this->input->post('kehadiran',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
		'evaluasi' => $this->input->post('evaluasi',TRUE),
	    );

            $this->Ttraining_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ttraining'));
        }
    }

    public function delete($id)
    {
     	$level = $this->session->userdata('role') ;

		if ($level!='User')
		{
			$row = $this->Ttraining_model->get_by_id($id);

			if ($row) {
				$this->Ttraining_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('ttraining'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('ttraining'));
			}
		}else{
			$this->session->set_flashdata('message', 'Access Denied');
			redirect(site_url('ttraining'));

		}
    }

    public function _rules()
    {
	$this->form_validation->set_rules('idtraining', 'idtraining', 'trim|required');
	$this->form_validation->set_rules('iduser', 'iduser', 'trim|required');
	$this->form_validation->set_rules('kehadiran', 'kehadiran', 'trim|required');
	//$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
	//$this->form_validation->set_rules('evaluasi', 'evaluasi', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "ttraining.xls";
        $judul = "ttraining";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Idtraining");
	xlsWriteLabel($tablehead, $kolomhead++, "Iduser");
	xlsWriteLabel($tablehead, $kolomhead++, "Kehadiran");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai");
	xlsWriteLabel($tablehead, $kolomhead++, "Evaluasi");

	foreach ($this->Ttraining_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->idtraining);
	    xlsWriteLabel($tablebody, $kolombody++, $data->iduser);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kehadiran);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->evaluasi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=ttraining.doc");

        $data = array(
            'ttraining_data' => $this->Ttraining_model->get_all(),
            'start' => 0
        );

        $this->load->view('ttraining/ttraining_doc',$data);
    }

}

/* End of file Ttraining.php */
/* Location: ./application/controllers/Ttraining.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-28 04:18:57 */
/* http://harviacode.com */
