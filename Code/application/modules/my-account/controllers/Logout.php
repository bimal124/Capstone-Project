<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Logout extends CI_Controller {



	function __construct() {

		parent::__construct();

		

		if(!$this->session->userdata(SESSION.'user_id'))

         {

          	redirect(site_url(''),'refresh');exit;

         }

	}

	

	public function index()
	{
		$this->session->unset_userdata(SESSION.'user_id');
		$this->session->unset_userdata(SESSION.'first_name');
		$this->session->unset_userdata(SESSION.'email');
		$this->session->unset_userdata(SESSION.'last_name');
		$this->session->unset_userdata(SESSION.'member_type');
		
		redirect(base_url(),'refresh');
		exit;

	}

	

	

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */