<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed
 * for all logged in users
 */
class rtraining extends MY_Controller {

  protected $access = array('SuperAdmin','Admin');

	function __construct()
    {
        parent::__construct();

		      $this->load->model('Master');
    }


	public function index()
	{


      $data = array(
          'idtraining' => $this->Master->gettraining()
      );

    $this->load->view('header');
    $this->load->view('rtraining/rtraining',$data);
    $this->load->view('footer');

	}
  public function generate($id)
  {
    		header('Content-Type: application/json');
    		$data = $this->Master->reporttraining($id);
    		echo json_encode($data);
  }




}
