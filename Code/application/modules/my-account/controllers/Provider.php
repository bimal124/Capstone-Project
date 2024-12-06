<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Provider extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata(SESSION.'user_id');

		if($this->session->userdata(SESSION.'member_type') != '2'){
			redirect(base_url('my-account/user'),'refresh');
			exit;
		}
		$this->load->model('account_module');
		$this->load->model('provider_module');
	}

	//user dashboard after login
	public function index()
	{
		$config['base_url'] = site_url('my-account/provider/index/');
		$config['total_rows'] = $this->provider_module->get_patient_request(TRUE);
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

		$this->data['result_data'] = $this->provider_module->get_patient_request(FALSE,$config['per_page'],$offset);
		$this->page_title = "Patient Request | ".SITE_NAME;
        $this->data['meta_keys'] =  SITE_NAME;
        $this->data['meta_desc'] = SITE_NAME;

        $this->template
			->set_layout('my_account')
			->enable_parser(FALSE)
			->title($this->page_title)		
			->build('provider/patient-request', $this->data);
	}

	/**
	* Schedule appointment datetime of patient
	*/
	public function schedule_patient()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		$this->form_validation->set_rules('patient_id', 'Patient', 'required');
		// $this->form_validation->set_rules('appointment_date', 'Appointment date', 'required');
		if($this->form_validation->run()==TRUE)
		{
			$this->provider_module->schedule_patient();
			$this->response['status'] = 'success';
			$this->response['message'] = 'Request Accepted.';
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function decline_patient()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		$this->form_validation->set_rules('patient_id', 'Patient', 'required');
		if($this->form_validation->run()==TRUE)
		{
			$this->provider_module->decline_patient();
			$this->response['status'] = 'success';
			$this->response['message'] = 'Request Rejected.';
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	/**
	* All scheduled patient
	*/
	public function schedule()
	{
		$config['base_url'] = site_url('my-account/provider/schedule/');
		$config['total_rows'] = $this->provider_module->get_scheduled_patient(TRUE);
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

		$this->data['result_data'] = $this->provider_module->get_scheduled_patient(FALSE,$config['per_page'],$offset);
		$this->page_title = "Scheduled Patient | ".SITE_NAME;
        $this->data['meta_keys'] =  SITE_NAME;
        $this->data['meta_desc'] = SITE_NAME;

        $this->template
			->set_layout('my_account')
			->enable_parser(FALSE)
			->title($this->page_title)		
			->build('provider/scheduled-patient', $this->data);
	}

	/**
	* Patient report
	* @param int patient id
	*/
	public function report($patient_id)
	{
		$this->page_title = "Patient Report | ".SITE_NAME;
        $this->data['meta_keys'] =  SITE_NAME;
        $this->data['meta_desc'] = SITE_NAME;

        $this->template
			->set_layout('my_account')
			->enable_parser(FALSE)
			->title($this->page_title)		
			->build('provider/report', $this->data);
	}



}

