<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Base Controller
* @version 1.0
* @author EMTS ghalerosn
* @date 01/04/2021
*/

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load custom library
		if(SITE_STATUS == 'offline')
		{
			redirect($this->general->lang_uri('/offline'));exit;
		}
		if(!$this->session->userdata(SESSION.'user_id'))
		{
			redirect(base_url(),'refresh');
		}
		

		
		//check banned IP address
		$this->general->check_banned_ip();
		$this->load->helper('text');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<label class="error">', '</label>');

	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
