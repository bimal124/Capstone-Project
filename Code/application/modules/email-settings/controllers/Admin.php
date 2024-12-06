<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {


	function __construct() {

		parent::__construct();

		// Check if User has logged in
		if (!$this->general->admin_logged_in())			
		{
			redirect(ADMIN_LOGIN_PATH, 'refresh');exit;
		}

		//load CI library
			$this->load->library('form_validation');		
			$this->load->library('breadcrumb');
		//load custom module
			$this->load->model('admin_email_settings');

		//load custom helper
			$this->load->helper('editor_helper');


	}


	


	public function index()
	{
		
		$this->data['email_data'] = $this->admin_email_settings->get_email_setting();
		//print_r($this->data['email_data']);exit;

		$this->data['active_menu'] = 'admin-main-menu';
        $this->data['active_submenu'] = 'email-settings';
        $this->data['modules_name'] = 'Email Settings';


         $this->breadcrumb->populate(
        	array(
        		'ADMIN' => ADMIN_DASHBOARD_PATH,
        		'Email Settings' => '#'
        	)
        );

        $this->data['modules_heading'] = 'View Email Settings';

		$this->template
			->set_layout('dashboard')
			->enable_parser(FALSE)
			->title('Email Settings Management System | '. SITE_NAME)
			->build('email_view', $this->data);	

	}
	
	
	public function edit($id, $email_code)
	{


		//if parent id is blank then redirect to dashboard page


		if(!isset($email_code)){redirect(ADMIN_DASHBOARD_PATH,'refresh');exit;}


		//Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');


		// Set the validation rules
		$this->form_validation->set_rules($this->admin_email_settings->validate_settings);


		if($this->form_validation->run()==TRUE)
		{
			//update site setting
			$this->admin_email_settings->update_email_settings($id);
			$this->session->set_flashdata('message','The email settins are update successful.');
			redirect(ADMIN_DASHBOARD_PATH.'/email-settings/index/','refresh');
			exit;
		}


		


		$this->data['email_data'] = $this->admin_email_settings->get_email_setting_byemailcode($email_code);


		$this->data['active_menu'] = 'admin-main-menu';
        $this->data['active_submenu'] = 'email-settings';
        $this->data['modules_name'] = 'Email Settings';


         $this->breadcrumb->populate(
        	array(
        		'ADMIN' => ADMIN_DASHBOARD_PATH,
        		'Email Settings' => '#'
        	)


        );


        $this->data['modules_heading'] = 'Update Email Settings';


		$this->template


			->set_layout('dashboard')


			->enable_parser(FALSE)


			->title('Email Settings Management System | '. SITE_NAME)


			->build('email_edit', $this->data);	


		


	}
}





/* End of file welcome.php */


/* Location: ./application/controllers/welcome.php */