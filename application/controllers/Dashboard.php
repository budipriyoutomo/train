<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for all logged in users
 */
class Dashboard extends MY_Controller {

    protected $access = array('SuperAdmin','Admin', 'User');
    
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('Master');
    }
	
	
	public function index()
	{
		$data = array(
			'start' => date("Y-m-d"),
			'end' => date("Y-m-d"),
			//'end' => date("Y-m-d",strtotime("+30 day")),
		);
		
		$jadwal['query']= $this->Master->getcalendar();
		$pengumuman['query']= $this->Master->getpengumuman($data);
		
		
        $this->load->view('header');
		$this->load->view('index',$pengumuman);
		$this->load->view('footer',$jadwal); 
        
	}
	

  

}