<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rraport extends MY_Controller {

  protected $access = array('SuperAdmin','Admin');

	function __construct()
    {
        parent::__construct();

		      $this->load->model('Master');
    }


	public function index()
	{
      $data = array(
          'iduser' => $this->Master->getuser()
      );

    $this->load->view('header');
    $this->load->view('rraport/rraport',$data);
    $this->load->view('footer');

	}
  public function generate($id)
  {
    		header('Content-Type: application/json');
    		$data = $this->Master->getraport($id);
    		echo json_encode($data);
  }


}
