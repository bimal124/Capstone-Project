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
		//load custom module
			$this->load->model('Admin_site_settings');
			$this->load->library('breadcrumb');
		
	}
	
	public function index()
	{
		$this->load->library('authorize');
		//Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
		
		//Validated if email sending type is SMTP
		  if ($this->input->post('mailing_type') == 3)
			  $this->form_validation->set_rules($this->Admin_site_settings->validate_site_settings_smtp);
					
		// Set the validation rules
		$this->form_validation->set_rules($this->Admin_site_settings->validate_site_settings);
		
		if($this->form_validation->run()==TRUE)
		{
			//update site setting
			$this->Admin_site_settings->update_site_settings();
			$this->session->set_flashdata('message','The site settings records are update successful.');
			redirect(ADMIN_DASHBOARD_PATH.'/site-settings/index','refresh');
			exit;
		}
		
		$this->data['site_set'] = $this->Admin_site_settings->get_site_setting();
		// print_r($this->data['site_set']);exit;
		$this->data['active_menu'] = 'admin-main-menu';
        $this->data['active_submenu'] = 'site-settings';
         $this->data['modules_name'] = 'Site Settings';
		 
        $this->breadcrumb->populate(
        	array(
        		'ADMIN' => ADMIN_DASHBOARD_PATH,
        		'Sitesetting  Management' => '#'
        	)
        );
		$this->template
			->set_layout('dashboard')
			->enable_parser(FALSE)
			->title('Site Settings | '.SITE_NAME)
			->build('site_settings', $this->data);	
		
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */