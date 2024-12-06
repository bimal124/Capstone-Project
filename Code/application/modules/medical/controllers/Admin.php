<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //error_reporting(0);



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
			$this->load->library('pagination');
			$this->load->library('breadcrumb');

		//load custom module
			$this->load->model('admin_medical');
		//Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

	}

	
	public function index()
	{

		if($this->uri->segment(4)) $status = $this->uri->segment(4); else $status = '1';

		//set pagination configuration			

		$config['base_url'] = site_url(ADMIN_DASHBOARD_PATH).'/providers/index/'.$status;

		$config['total_rows'] = $this->admin_medical->get_total_providers($status);

		$config['num_links'] = 5;

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

		$config['per_page'] = ADMIN_RECORDS_PER_PAGINATION; 

		$config['next_tag_open'] = '<li>';

		$config['next_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="#">';

		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li>';

		$config['num_tag_close'] = '</li>';		

		$config['uri_segment'] = '5';		

		$this->pagination->initialize($config); 

		$offset=$this->uri->segment(5,0);

			$this->data['links']=$this->pagination->create_links($config["per_page"], $offset);

		



		$this->data['result_data'] = $this->admin_medical->get_providers_details($this->uri->segment(4),$config['per_page'],$offset);

		$this->data['active_menu'] = 'member';

        $this->data['active_submenu'] = 'providers';

        $this->data['modules_name'] = 'Patients Management';

        $this->data['modules_heading'] = 'View Patients Detail';

        $this->breadcrumb->populate(

        	array(

        		'ADMIN' => ADMIN_DASHBOARD_PATH,

        		'Member Management' => '#',
				'Patients Management' => '#'

        	)

        );

		$this->template

			->set_layout('dashboard')

			->enable_parser(FALSE)

			->title('Patients View | '. SITE_NAME)

			->build('view', $this->data);	

		

	}
	
	/* New & old patient details*/
	public function patients($type)
	{
		$this->data = array();
		
		$this->data['active_menu'] = 'medical';
        $this->data['active_submenu'] = 'new_patient';
		$this->view_page = 'view';
		//Based on doctor assign we can find new
		//if provider or doctor assign = 0 mean new patients otherwise all are goes to patient history
		
		$assign_dr = '';
		$page_heading = 'New Patients Detail';
		if($type=='history')
		{
			$assign_dr = 1;
			$page_heading = 'Patient History';
			$this->data['active_submenu'] = 'patient_history';
			$this->view_page = 'view_history';
		}
		
		//set pagination configuration			
		$config['base_url'] = site_url(ADMIN_DASHBOARD_PATH).'/medical/patients/'.$type;

		$config['total_rows'] = $this->admin_medical->get_total_patients($assign_dr);

		$config['num_links'] = 5;

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

		$config['per_page'] = ADMIN_RECORDS_PER_PAGINATION; 

		$config['next_tag_open'] = '<li>';

		$config['next_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="#">';

		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li>';

		$config['num_tag_close'] = '</li>';		

		$config['uri_segment'] = '5';		

		$this->pagination->initialize($config); 

		$offset=$this->uri->segment(5,0);

		$this->data['links']=$this->pagination->create_links($config["per_page"], $offset);
		$this->data['result_data'] = $this->admin_medical->get_patients_details($assign_dr,$config['per_page'],$offset);
		$this->data['providers_data'] = $this->admin_medical->get_all_provider();//provider=doctor
		//print_r($this->data['providers_data']);exit;

        $this->data['modules_name'] = 'Patients Management';

        $this->data['modules_heading'] = $page_heading;

        $this->breadcrumb->populate(

        	array(

        		'ADMIN' => ADMIN_DASHBOARD_PATH,
				'Patients Management' => '#'

        	)

        );

		$this->template

			->set_layout('dashboard')

			->enable_parser(FALSE)

			->title('Patients View | '. SITE_NAME)

			->build($this->view_page, $this->data);
			
	}

	public function rejected_patients()
	{
		$this->data = array();
		
		$this->data['active_menu'] = 'medical';
        $this->data['active_submenu'] = 'rejected_patient';
		$this->view_page = 'view_rejected';
		
		$page_heading = 'Rejected Patients Detail';
		
		//set pagination configuration			
		$config['base_url'] = site_url(ADMIN_DASHBOARD_PATH).'/medical/rejected_patients/';
		$config['total_rows'] = $this->admin_medical->get_rejected_patients(true);
		$config['num_links'] = 5;
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
		$config['per_page'] = ADMIN_RECORDS_PER_PAGINATION; 
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';		
		$config['uri_segment'] = '4';		
		$this->pagination->initialize($config); 
		$offset=$this->uri->segment(3,0);

		$this->data['links']=$this->pagination->create_links($config["per_page"], $offset);
		$this->data['result_data'] = $this->admin_medical->get_rejected_patients(false,$config['per_page'],$offset);
		$this->data['providers_data'] = $this->admin_medical->get_all_provider();//provider=doctor
        $this->data['modules_name'] = 'Patients Management';
        $this->data['modules_heading'] = $page_heading;
        $this->breadcrumb->populate(
        	array(
        		'ADMIN' => ADMIN_DASHBOARD_PATH,
				'Patients Management' => '#'
        	)
        );
		$this->template
			->set_layout('dashboard')
			->enable_parser(FALSE)
			->title('Rejected Patients View | '. SITE_NAME)
			->build($this->view_page, $this->data);
			
	}
	
	
	public function assign_provider(){
		$response = array();
        $response['message']='';
		$response['status'] = 'error';
		
        if($this->input->server('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules($this->admin_medical->validate_settings_provider);
            if($this->form_validation->run()==TRUE){
                $trans_stat = $this->admin_medical->add_provider();
                
				//Send email notification to provider
				$this->admin_medical->provider_notification();
				
				$response['status'] = 'success';
				$this->session->set_flashdata('message','Provider assigned sucessfully!!!');
				$response['message'] = 'Provider added sucessfully!!!';
				print_r(json_encode($response));exit;
				
            }

			$response['message'] = validation_errors();
			print_r(json_encode($response));exit;

        }
	}
	
	public function report($id){
		
		$this->data = array();		
		$this->data['active_menu'] = 'medical';
        $this->data['active_submenu'] = 'patient_history';			
        $this->data['modules_name'] = 'Patients Management';
        $this->data['modules_heading'] = "Medical Report";

        $this->breadcrumb->populate(
        	array(

        		'ADMIN' => ADMIN_DASHBOARD_PATH,
				'Patients History Management' => ADMIN_DASHBOARD_PATH.'/medical/patients/history',
				'Medical Reports' => '#'
        	)
        );

        // $this->admin_medical->update_patient_report();
        $this->data['covid_test_type'] = $this->general->covid_test_type();
		$this->data['house_call_visit'] = $this->general->house_call_visit();
		
        $this->data['patient_info'] = $this->admin_medical->getPatientDetails($id);
        $this->data['patient_report'] = $this->admin_medical->getPatientReport($id);
		$this->data['report_attachment'] = $this->admin_medical->getPatientReportAttachment($id);
		$this->data['transaction'] = $this->admin_medical->get_transaction_byuser($id);
		$this->data['past_history'] = $this->general->get_past_history($id,$this->data['patient_info']->user_id);
        // var_dump($this->data['past_history']);
        
       // print_r(($this->data['report_attachment']));exit;
		$this->template
			->set_layout('dashboard')
			->enable_parser(FALSE)
			->title('Patients View | '. SITE_NAME)
			->build('view_report', $this->data);
			
	
	}
	
	
	public function share($id){
		$patient_info = $this->admin_medical->get_patient_info($id);
		if(empty($patient_info->report_details))
		{
			
			$this->session->set_flashdata('message','There is no report uploaded yet.');
			redirect(ADMIN_DASHBOARD_PATH.'/medical/patients/history','refresh');
			exit;
		}
		$this->data['patient_info'] = $patient_info;
		// $this->response['share_html'] = $this->load->view('share_html', $this->data, TRUE);
		$this->load->library('notification');	
		$all_attachments = $this->admin_medical->getPatientReportAttachment($id);
		$attachments = array();
		$attachments[] = get_the_image('attachments',$id.'/PatientReport.pdf');

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

		// $patient_history = $this->admin_medical->getPatientDetails($id);
		
  //       //$this->data['patient_report'] = $this->admin_medical->getPatientReport($id);
		// $report_attachment = $this->admin_medical->getPatientReportAttachment($id);
		// $attachments = array();
		// if(!empty($report_attachment)){
		// 	foreach ($report_attachment as $key => $value) {
		// 		$attachments[] = get_the_image('attachments',$value->patient_id.'/'.$value->name);
		// 	}
		// }
		
		
		// $attachments = implode(",", array_column($report_attachment, "name"));
		
		// //load notification library
  //       $this->load->library('notification');

		// $parseElement=array(						
		// 				"SITENAME"=>SITE_NAME,
		// 				"TO"=>$patient_history->email,
		// 				"EMAIL"=>$patient_history->email,
		// 				"FIRSTNAME"=>$patient_history->name,
		// 				"FULLNAME"=>$patient_history->name,
		// 				"PATIENTNAME"=>$patient_history->name,
		// 				"ATTACHMENT" => $attachments,
		// 				"ATTACHMENT_PATH" => REPORTS_ATTACH_PATH
		// );
		
		if($this->notification->send_email_notification('share_report', $parseElement)){
			$this->session->set_flashdata('message','The report is successfully send.');
			redirect(ADMIN_DASHBOARD_PATH.'/medical/patients/history','refresh');
			exit;
		}
		
		$this->session->set_flashdata('message','The report is not send yet. There might be something problem. Please try latter.');
		redirect(ADMIN_DASHBOARD_PATH.'/medical/patients/history','refresh');
		exit;
	
	}
	
	public function download_report($id,$patient_id = 0)
	{
		$this->load->helper('download');
		$patient_info = $this->admin_medical->getPatientDetails($patient_id);
		$download_name = date('m-d-Y',strtotime($patient_info->appointment_date)).' Medical Report '.$patient_info->name.' '.$patient_info->last_name.'.pdf';
		$this->admin_medical->download_pdf($patient_id,$download = TRUE);
		if($id > 0){
			$report = $this->admin_medical->getPatientReportByid($id);
			$pth =  file_get_contents(base_url('upload_files/attachments/'.$patient_id.'/'.$report->name));
			$nme    =   $report->name;
			force_download($nme, $pth);
		}else{
			$pth =  file_get_contents(base_url('upload_files/attachments/'.$patient_id.'/PatientReport.pdf'));
			if(file_exists(FCPATH.'upload_files/attachments/'.$patient_id.'/PatientReport.pdf')){
				force_download($download_name,$pth);
			}else{
				$this->admin_medical->download_pdf($patient_id,$download = TRUE);
			}
		}

	}

	public function view($id){
		
		$this->data = array();		
		$this->data['active_menu'] = 'medical';
        $this->data['active_submenu'] = 'new_patient';			
        $this->data['modules_name'] = 'Booking Details';
        $this->data['modules_heading'] = "Patient Details";

        $this->breadcrumb->populate(
        	array(

        		'ADMIN' => ADMIN_DASHBOARD_PATH,
				'Patients Management' => ADMIN_DASHBOARD_PATH.'/medical/patients/new',
				'Appointment Details' => '#'
        	)
        );
        $this->data['covid_test_type'] = $this->general->covid_test_type();
		$this->data['house_call_visit'] = $this->general->house_call_visit();

        $this->data['details'] = $this->admin_medical->getPatientDetails($id);
		$this->template
			->set_layout('dashboard')
			->enable_parser(FALSE)
			->title('Patients View | '. SITE_NAME)
			->build('view_details', $this->data);
	}

	public function delete($id)
	{
		$query = $this->db->get_where('patient', array('id' => $id));
			if($query->num_rows() > 0) 
			{
				$this->db->where('id', $id);
				$this->db->update('patient', array('is_delete' => 1));
				$this->session->set_flashdata('message','The patient record delete successfull.');
				redirect(ADMIN_DASHBOARD_PATH.'/medical/patients/new','refresh');
				exit;
			}
			else
			{
				$this->session->set_flashdata('message','Sorry no record found.');
				redirect(ADMIN_DASHBOARD_PATH.'/medical/patients/new','refresh');
				exit;
			}
	}

	public function download_pdf($patient_id)
	{
		$this->admin_medical->download_pdf($patient_id);
	}

	/**
	* Get patient details before sending recipt to patient
	**/
	public function patient_details()
	{
		$response = array();
        $response['message']='';
		$response['status'] = 'success';
		$id = $this->input->post('id');
		$this->data['covid_test_type'] = $this->general->covid_test_type();
		$this->data['house_call_visit'] = $this->general->house_call_visit();

		$patient_info = $this->admin_medical->getPatientDetails($id);
		$this->data['patient_info'] = $this->admin_medical->getPatientDetails($id);
        $this->data['patient_report'] = $this->admin_medical->getPatientReport($id);
		$this->data['transaction'] = $this->admin_medical->get_transaction_byuser($id);
		if(empty($patient_info))
		{
			$response['message']='Some error occured.';
			$response['status'] = 'error';
		}
		$response['receipt_form'] = $this->load->view('send_receipt', $this->data, TRUE);

		print_r(json_encode($response));exit;
	}

	public function send_receipt()
	{
		$response = array();
        $response['message']='';
		$response['status'] = 'error';
		$patient_id = $this->input->post('patient_id');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$this->form_validation->set_rules($this->admin_medical->validate_receipt);
        if($this->form_validation->run()==TRUE){
            $trans_stat = $this->admin_medical->send_receipt();
            
			//Send email notification to provider
			if($trans_stat){
				$this->admin_medical->receipt_notification($patient_id);
			}
			
			$response['status'] = 'success';
			$this->session->set_flashdata('message','Receipt send sucessfully!!!');
			$response['message'] = 'Receipt send sucessfully!!!';
			
        }else{
        	$response['message'] = validation_errors();
        }

		print_r(json_encode($response));exit;
	}

	public function edit_booking($id){
		
		$this->data = array();		
		$this->data['active_menu'] = 'medical';
        $this->data['active_submenu'] = 'new_patient';			
        $this->data['modules_name'] = 'Booking Details';
        $this->data['modules_heading'] = "Patient Details";

        $this->breadcrumb->populate(
        	array(

        		'ADMIN' => ADMIN_DASHBOARD_PATH,
				'Patients Management' => ADMIN_DASHBOARD_PATH.'/medical/patients/new',
				'Appointment Details' => '#'
        	)
        );
        $this->form_validation->set_rules($this->admin_medical->validate_settings_edit);
		if($this->form_validation->run()==TRUE)
		{
			$this->admin_medical->edit_booking($id);
			$this->session->set_flashdata('message','The patient record update successfully.');
			redirect(ADMIN_DASHBOARD_PATH.'/medical/view/'.$id,'refresh');			
			exit;
		}

        $this->data['covid_test_type'] = $this->general->covid_test_type();
		$this->data['house_call_visit'] = $this->general->house_call_visit();

        $this->data['details'] = $this->admin_medical->getPatientDetails($id);
		$this->template
			->set_layout('dashboard')
			->enable_parser(FALSE)
			->title('Patients View | '. SITE_NAME)
			->build('edit_booking', $this->data);
	}
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */