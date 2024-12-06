<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata(SESSION.'user_id');

		if($this->session->userdata(SESSION.'member_type') != '2'){
			redirect(base_url('my-account/user'),'refresh');
			exit;
		}
		$this->load->library('upload');
		$this->load->model('report_module');
	}

	/**
	* Patient report
	* @param int patient id
	*/
	public function update($patient_id)
	{
		$this->data['patient_info'] = $this->report_module->get_patient_info($patient_id);
		if(!$this->data['patient_info']){
			redirect(base_url(),'refresh');
		}
		$this->data['covid_test_type'] = $this->general->covid_test_type();
		$this->data['house_call_visit'] = $this->general->house_call_visit();
		$this->data['past_history'] = $this->general->get_past_history($patient_id,$this->data['patient_info']->user_id);

		$this->data['attachments'] = $this->report_module->get_report_files($patient_id);
		$this->page_title = "Patient Report | ".SITE_NAME;
        $this->data['meta_keys'] =  SITE_NAME;
        $this->data['meta_desc'] = SITE_NAME;

        $this->template
			->set_layout('my_account')
			->enable_parser(FALSE)
			->title($this->page_title)		
			->build('report/create', $this->data);
	}

	public function checkin()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		$this->form_validation->set_rules('patient_id', 'Patient', 'required');
		// $this->form_validation->set_rules('checkinTime', 'Checkin time', 'required');
		if($this->form_validation->run()==TRUE)
		{
			$this->report_module->checkin();
			$this->response['status'] = 'success';
			$this->response['message'] = 'Checkin successfull.';
		}else{
			$this->response['status'] = 'error';
			$this->response['message'] = 'Please select time.';
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function checkout()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		$this->form_validation->set_rules('patient_id', 'Patient', 'required');
		// $this->form_validation->set_rules('checkoutTime', 'Checkout Time', 'required|callback_check_checkout');
		if($this->form_validation->run()==TRUE)
		{
			$res = $this->report_module->checkout();
			if($res == false){
				$this->response['status'] = 'error';
				$this->response['message'] = 'Please checkin and save report before checkout.';
			}else{
				$this->response['status'] = 'success';
				$this->response['message'] = 'Checkout successfully.';
			}
			
		}else{
			$this->response['message'] = 'Checkout time must be greater than checkin.';
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function check_checkout()
	{
		if(strtotime($this->input->post('checkinTime')) > strtotime($this->input->post('checkoutTime')) ) 
		{
			$this->form_validation->set_message('check_checkout',"Checkout time must be greater than checkin.");
			return false;
		}
		return true;

	}

	public function update_report()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		$patient_id = $this->input->post('patient_id');
		$this->form_validation->set_rules('patient_id', 'Patient', 'required');
		if($this->form_validation->run()==TRUE)
		{
			$res = $this->report_module->update_report();
			if($res == TRUE){
				$this->load->model('medical/admin_medical');
				$this->admin_medical->download_pdf($patient_id);
			}
			$this->response['status'] = 'success';
			$this->response['message'] = 'Report updated successfully.';
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;

	}

	public function upload_attachment()
	{
		$this->form_validation->set_rules('patient_id', 'Patient', 'required');
		if($this->form_validation->run()==TRUE)
		{
			if($res = $this->report_module->upload_attachment()){
				$this->response['status'] = 'success';
				$this->response['message'] = 'Attachment uploaded successfully.';
			}else{
				$this->response['status'] = 'error';
				$this->response['message'] = $res;
			}
		}
		$patient_id = $this->input->post('patient_id');
		$this->data['attachments'] = $this->report_module->get_report_files($patient_id);
		$this->response['attachment_html'] = $this->load->view('report/attachments', $this->data, TRUE);
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function remove_attachment()
	{
		$this->response = array(
			'status' => 'error',
			'message' => '',
			'attachment_html' => ''
		);
		$this->form_validation->set_rules('attachment_id', 'Attachment', 'required');
		if($this->form_validation->run()==TRUE)
		{
			$attachment_id = $this->input->post('attachment_id');
			$patient_id = $this->report_module->remove_attachment($attachment_id);
			if($patient_id){
				$this->response['status'] = 'success';
				$this->response['message'] = 'Report updated successfully.';
				$this->data['attachments'] = $this->report_module->get_report_files($patient_id);
				$this->response['attachment_html'] = $this->load->view('report/attachments', $this->data, TRUE);
			}
			
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function view($patient_id)
	{
		$this->data['patient_info'] = $this->report_module->get_patient_info($patient_id);
		if(!$this->data['patient_info']){
			redirect(base_url(),'refresh');
		}
		$this->data['past_history'] = $this->general->get_past_history($patient_id,$this->data['patient_info']->user_id);
		$this->data['covid_test_type'] = $this->general->covid_test_type();
		$this->data['house_call_visit'] = $this->general->house_call_visit();
		$this->data['attachments'] = $this->report_module->get_report_files($patient_id);
		$this->page_title = "Patient Report Details | ".SITE_NAME;
        $this->data['meta_keys'] =  SITE_NAME;
        $this->data['meta_desc'] = SITE_NAME;

        $this->template
			->set_layout('my_account')
			->enable_parser(FALSE)
			->title($this->page_title)		
			->build('report/view', $this->data);
	}

	/**
	* Share report to patient
	*/
	public function share()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		$this->form_validation->set_rules('patient_id', 'Patient Id', 'required');
		$patient_id = $this->input->post('patient_id');
		if($this->form_validation->run()==TRUE)
		{
			$patient_info = $this->report_module->get_patient_info($patient_id);
			if($patient_info){
				$this->response['status'] = 'success';
				$this->response['message'] = 'Report Shared successfully.';
				$this->data['patient_info'] = $this->report_module->get_patient_info($patient_id);
				// $this->response['share_html'] = $this->load->view('report/share', $this->data, TRUE);
				$this->load->library('notification');	
				$all_attachments = $this->report_module->get_report_files($patient_id);
				$attachments = array();
				$attachments[] = get_the_image('attachments',$patient_id.'/PatientReport.pdf');
				if(!empty($all_attachments)){
					foreach ($all_attachments as $key => $value) {
						$attachments[] = get_the_image('attachments',$value->patient_id.'/'.$value->name);
					}
				}
				
				$parseElement=array(
							"TO"=> $patient_info->email,
							"PATIENT_NAME" => $patient_info->name,
							"SITENAME"=>SITE_NAME,
							// "REPORT"=> $this->response['share_html'],
							"EMAIL"=>$patient_info->email,
							"ATTACHMENT" => $attachments
							);
				$this->notification->send_email_notification('share_report', $parseElement);
				$this->report_module->share_report($patient_id);

			}
			
		}
		$this->output->set_output(json_encode($this->response))->_display();
        exit;
	}

	public function download_report($patient_id)
	{
		$this->load->model('account_module');
		$this->load->helper('download');
		$pth =  file_get_contents(base_url('upload_files/attachments/'.$patient_id.'/PatientReport.pdf'));
		$patient_info = $this->report_module->get_patient_info($patient_id);
		$download_name = date('m-d-Y',strtotime($patient_info->appointment_date)).' Medical Report '.$patient_info->name.' '.$patient_info->last_name.'.pdf';

		if(file_exists(FCPATH.'upload_files/attachments/'.$patient_id.'/PatientReport.pdf')){
			force_download($download_name,$pth);
		}else{
			$this->session->set_flashdata('message', 'Report not found. Please try again.');
			redirect(base_url('my-account/provider/schedule'),'refresh');
		}
	}



}

