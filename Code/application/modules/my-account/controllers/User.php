<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata(SESSION.'user_id');
		$this->load->model('account_module');
	}

	//user dashboard after login
	public function index()
	{
		if($this->session->userdata(SESSION.'member_type') == '2'){
			redirect(base_url('my-account/provider'),'refresh');
			exit;
		}
		if($this->session->userdata(SESSION.'first_name') == '')
		{
			$this->session->set_flashdata('message', 'Complete your profile to continue.');
			redirect(base_url('my-account/user/profile'),'refresh');
		}
		$config['base_url'] = site_url('my-account/user/index/');
		$config['total_rows'] = $this->account_module->get_orders(TRUE);
		$config['num_links'] = 5;
		$config['attributes'] = array('class' => 'page-link');
		$config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '<li>';
		$config['per_page'] = 20; 
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';		
		$config['uri_segment'] = '4';		
		$this->pagination->initialize($config); 
		$offset=$this->uri->segment(4,0);
		$this->data['links']=$this->pagination->create_links($config["per_page"], $offset);
		$this->data['page_name'] = 'patient-request';

		$this->data['result_data'] = $this->account_module->get_orders(FALSE,$config['per_page'],$offset);

		$this->page_title = "Nepal Medical House | ".SITE_NAME;
        $this->data['meta_keys'] =  SITE_NAME;
        $this->data['meta_desc'] = SITE_NAME;

        $this->template
			->set_layout('my_account')
			->enable_parser(FALSE)
			->title($this->page_title)		
			->build('orders', $this->data);
	}

	public function profile()
	{
		$this->data['profile'] = $this->account_module->get_user_details();
		$this->data['countries'] = $this->general->get_country();
		$this->data['account_menu_active'] = 'profile';
		// Set the validation rules
		
		$this->page_title = "My Profile | ".SITE_NAME;
        $this->data['meta_keys'] =  SITE_NAME;
        $this->data['meta_desc'] = SITE_NAME;

		$this->template
			->set_layout('my_account')
			->enable_parser(FALSE)
			->title($this->page_title)
			->build('profile', $this->data);
	}

	/**
	* Check email unique validation
	**/
	public function check_email()
	{
		if(!empty($this->account_module->check_email())) 
		{
			$this->form_validation->set_message('check_email',"The email address is already in use.");
			return false;
		}
		return true;

	}

	public function email_taken()
	{
   		$result=$this->account_module->check_email();
		if ( $result ) {
			echo 'taken';exit;
		} else {
			echo 'available';exit;
		}
	}

	public function update_userinfo()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		$this->form_validation->set_rules($this->account_module->validate_settings);
		if($this->form_validation->run()==TRUE)
		{
			$this->account_module->update_profile();
			$this->response['status'] = 'success';
			if($this->input->post('email') == $this->session->userdata(SESSION.'email')){
				$this->response['message'] = 'User info updated.';
			}else{
				$this->response['message'] = 'User info updated. Please verify your new email.';
			}
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function update_useraddress()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		if($this->form_validation->run()==TRUE)
		{
			$this->account_module->update_profile_contact();
			$this->response['status'] = 'success';
			$this->response['message'] = 'Contact info updated.';
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function update_companyinfo()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		if($this->form_validation->run()==TRUE)
		{
			$this->account_module->update_profile_company();
			$this->response['status'] = 'success';
			$this->response['message'] = 'Company info updated.';
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function update_password()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		$this->form_validation->set_rules('old_password', 'Old password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'New password', 'trim|required');
		$this->form_validation->set_rules('re_password', 'Confirm Password', 'trim|required|matches[new_password]');
		if($this->form_validation->run()==TRUE)
		{
			//check current password with previous password
			if($this->account_module->check_old_password() == TRUE)
			{
				//change new password
				$activation_code = $this->account_module->change_password();
				//unset all session variable
				
				$this->session->unset_userdata(SESSION.'user_id');
				$this->session->unset_userdata(SESSION.'first_name');
				$this->session->unset_userdata(SESSION.'email');
				$this->session->unset_userdata(SESSION.'last_name');
				$this->session->unset_userdata(SESSION.'member_type');
				$this->response['status'] = 'success';
				$this->response['message'] = 'Password changed successfully';
			}
			else
			{
				$this->response['status'] = 'error';
				$this->response['message'] = 'Old password did not match.';
			}
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	/**
	* Book a new appointment
	*/
	public function appointment()
	{
		if($this->session->userdata(SESSION.'first_name') == '')
		{
			$this->session->set_flashdata('message', 'Complete your profile to continue.');
			redirect(base_url('my-account/user/profile'),'refresh');
		}
		$this->data[''] = 'profile';
		$this->load->model('home/home_module');
		// Set the validation rules
		// $this->form_validation->set_rules($this->home_module->validate_patient);
		// if ($this->form_validation->run() == true) 
		// {
		// 	$this->home_module->add_patient($this->user_id); 
		// 	$this->session->set_flashdata('message','Appointment submitted successfully.');
		// 	redirect(base_url('my-account/user'),'refresh');
		// }
		$this->data['covid_test_type'] = $this->general->covid_test_type();
		$this->data['house_call_visit'] = $this->general->house_call_visit();

		$this->data['user_info'] = $this->account_module->get_user_details();

		$this->page_title = "New Appointment | ".SITE_NAME;
        $this->data['meta_keys'] =  SITE_NAME;
        $this->data['meta_desc'] = SITE_NAME;

		$this->template
			->set_layout('my_account')
			->enable_parser(FALSE)
			->title($this->page_title)
			->build('appointment', $this->data);
	}

	public function report($patient_id)
	{
		$this->load->model('report_module');
		$this->data['patient_info'] = $this->account_module->get_patient_info($patient_id);
		if(!$this->data['patient_info']){
			redirect(base_url(),'refresh');
		}
		$this->data['covid_test_type'] = $this->general->covid_test_type();
		$this->data['house_call_visit'] = $this->general->house_call_visit();
		$this->data['attachments'] = $this->report_module->get_report_files($patient_id);
		$this->page_title = "View Report Details | ".SITE_NAME;
        $this->data['meta_keys'] =  SITE_NAME;
        $this->data['meta_desc'] = SITE_NAME;

        $this->template
			->set_layout('my_account')
			->enable_parser(FALSE)
			->title($this->page_title)		
			->build('report/view', $this->data);
	}

	/**
	* Book a new appointment by company
	*/
	public function schedule()
	{
		if($this->session->userdata(SESSION.'first_name') == '')
		{
			$this->session->set_flashdata('message', 'Complete your profile to continue.');
			redirect(base_url('my-account/user/profile'),'refresh');
		}
		$this->data[''] = 'profile';
		$this->load->model('home/home_module');
		
		$this->data['user_info'] = $this->account_module->get_user_details();

		$this->page_title = "New Appointment | ".SITE_NAME;
        $this->data['meta_keys'] =  SITE_NAME;
        $this->data['meta_desc'] = SITE_NAME;

		$this->template
			->set_layout('my_account')
			->enable_parser(FALSE)
			->title($this->page_title)
			->build('appointment-company', $this->data);
	}



}

