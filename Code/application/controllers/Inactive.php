<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inactive extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		//load custom library
		$this->load->library('my_language');
	}
	
	public function index()
	{
		$this->data = array();
		
		
		//set SEO data
		$this->page_title = $this->lang->line('popup_inact_please_refresh');
		
		$this->load->view('inactive',$this->data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */