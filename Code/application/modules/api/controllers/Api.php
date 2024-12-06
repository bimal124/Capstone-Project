<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('api_model');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

	}

	public function index()
	{
		
	}

	public function email_login()
	{
		$this->response = array(
			'email_error' => '',
			'password_error' => ''
		);
		$this->form_validation->set_rules($this->api_model->validate_patient);
		if ($this->form_validation->run() === FALSE) 
		{	
			$this->response["email_error"] = form_error('email');
			$this->response["password_error"] = form_error('password');
		}else{
			$login_status = $this->api_model->check_login();
			if($login_status==='unregistered')					
				 {	$this->response["email_error"] = "This email doesn't match any account. Try again.";}
			else if($login_status==='invalid')
				 {$this->response['email_error'] = 'Invalid email or password.';}
			else if($login_status==='suspended')
				 {$this->response['email_error'] = 'User suspended.';}
			else if($login_status==='closed')
				 {$this->response['email_error'] = 'User closed.';}
			else if($login_status==='deleted')
				{$this->response["email_error"] = 'User deleted.';}
			else if($login_status==='success')
				{$this->response["email_error"] = '';}
			else if($login_status==='inactive')
				{$this->response["email_error"] = 'User inactive.';}
		}
		
        $this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function forgot_password()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email');
		$this->response = array(
			'email_error' => ''
		);
		if ($this->form_validation->run() === FALSE) 
		{	
			$this->response["email_error"] = form_error('email');
		}else{
			$this->api_model->forget_password_reminder_email();
		}
		
        $this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function check_email()
	{
		$email = $this->input->post('email');
		if($this->api_model->check_valid_member($email) == TRUE){
			return TRUE;
		}
		$this->form_validation->set_message('check_email', "This email doesn't match any account. Try again.");
        return FALSE;
	}

	public function email_register()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->response = array(
			'status' => '',
			'message' => ''
		);
		if ($this->form_validation->run() === TRUE) 
		{	
			$res = $this->api_model->email_register();
			if($res > 0){
				$this->response['status'] = 'success';
				$this->response['message'] = 'User registration completed. Check your email to activate your account.';
			}
		}
		
        $this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function social_register_showform()
	{
		$email = $this->input->post('email');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$this->response = array(
			'status' => '',
			'message' => ''
		);
		
		$query = $this->db->get_where("members",array('email'=>$email));
		if ($query->num_rows() > 0) 
		{
			$this->response['status'] = 'error';
			$this->response['message'] = 'Email already exist.';

		}else{
			$this->response['status'] = 'success';
			$this->response['register_form'] = $this->load->view('register_form', array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email
			), TRUE);
		}
        $this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function social_register()
	{
		$this->response = array(
			'status' => '',
			'message' => ''
		);
		$this->form_validation->set_rules($this->api_model->validate_register);
		if ($this->form_validation->run() === TRUE) 
		{	
			if($this->api_model->social_register()){
				$this->response['status'] = 'success';
				$this->response['message'] = 'Email registration completed.';
				// $this->session->set_userdata(array(SESSION.'user_id' => $record->id));
				// $this->session->set_userdata(array(SESSION.'first_name' => $record->first_name));
				// $this->session->set_userdata(array(SESSION.'email' => $record->email));
				// $this->session->set_userdata(array(SESSION.'last_name' => $record->last_name));
				// $this->session->set_userdata(array(SESSION.'member_type' => $record->member_type));
			}
		}else{
			echo validation_errors();
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function social_login()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		$login_status = $this->api_model->check_social_login();
		if($login_status==='unregistered')					
			 {	$this->response["message"] = "This email doesn't match any account. Try again.";}
		else if($login_status==='suspended')
			 {$this->response['message'] = 'User suspended.';}
		else if($login_status==='closed')
			 {$this->response['message'] = 'User closed.';}
		else if($login_status==='deleted')
			{$this->response["message"] = 'User deleted.';}
		else if($login_status==='success')
			{$this->response["status"] = 'success';}
		else if($login_status==='inactive')
			{$this->response["message"] = 'User inactive.';}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function book_appointment()
	{
		$this->response = array(
			'status' => '',
			'message' => 'Please fill in a valid value for all required fields.'
		);
		$this->form_validation->set_rules($this->api_model->validate_patient_booking);
		if ($this->form_validation->run() == true) 
		{
			$this->response = $this->api_model->book_appointment(); 
			// $this->session->set_flashdata('message','Appointment submitted successfully.');
			// redirect(base_url('book-appointment-now'),'refresh');
		}
		$this->response['valid_error'] = validation_errors();
		$this->output->set_output(json_encode($this->response))->_display();
        exit;

		
	}
	public function schedule_appointment()
	{
		$this->response = array(
			'status' => 'error',
			'message' => 'Please fill in a valid value for all required fields.'
		);
		$this->form_validation->set_rules($this->api_model->validate_schedule_booking);
		if ($this->form_validation->run() == true) 
		{
			$this->api_model->schedule_appointment(); 
			$this->response["status"] = "success";
			$this->response["message"] = "This email doesn't match any account. Try again.";
			// $this->session->set_flashdata('message','Appointment submitted successfully.');
			// redirect(base_url('book-appointment-now'),'refresh');
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;

		
	}

}

/* End of file Api.php */
/* Location: ./application/modules/api/controllers/Api.php */