<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		if(SITE_STATUS == 'offline')
		{
			redirect('/offline');exit;
		}

		if(SITE_STATUS == 'maintanance')
		{
			if(!$this->session->userdata('MAINTAINANCE_KEY') OR $this->session->userdata('MAINTAINANCE_KEY')!='YES'){
				redirect('/maintanance');exit;
			}
			// redirect($this->general->lang_uri('/maintanance'));exit;
		}
				
		//check banned IP address
		$this->general->check_banned_ip();

		$this->load->library('form_validation');	
		//load module
		$this->load->model('home_module');
		
		$this->load->helper('text');
		$this->load->library('pagination');
		$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
	}
	
	public function index()
	{
		$this->data = [];
		
		$this->data['data_serve'] = $this->home_module->get_cms_bytype(1);
		$this->data['data_condition'] = $this->home_module->get_cms_bytype(2);
		$this->data['data_whoare'] = $this->home_module->get_cms_bytype(3);
		$this->data['data_team'] = $this->home_module->get_cms_bytype(4);
		$this->data['data_banner'] = $this->home_module->get_banner();
		
		
		$seo_data = $this->general->get_seo(1);
        if ($seo_data) {
            //set SEO data
            $this->page_title = $seo_data->page_title . ' | ' . SITE_NAME;
            $this->data['meta_keys'] =  $seo_data->meta_key;
            $this->data['meta_desc'] = $seo_data->meta_description;
        } else {
            //set SEO data
            $this->page_title = "Nepal Medical House | ".SITE_NAME;
            $this->data['meta_keys'] =  SITE_NAME;
            $this->data['meta_desc'] = SITE_NAME;
        }
		
		
		$this->template
		->set_layout('general')
		->enable_parser(FALSE)
		->title($this->page_title)		
		->build('body', $this->data);
	}

	public function test()
	{
		$this->page_title = "Nepal Medical House | ".SITE_NAME;
        $this->data['meta_keys'] =  SITE_NAME;
        $this->data['meta_desc'] = SITE_NAME;
		$this->template
			->set_layout('general')
			->enable_parser(FALSE)
			->title('Test Payment')		
			->build('test',$this->data);
	}
	
	public function cms($slug){
		$this->data = [];
		
		$this->data['data_cms'] = $this->home_module->get_cms_byslug($slug);		
		if($this->data['data_cms'] == false)
		{
			redirect(site_url(''),'refresh');exit;
		}
		
        //set SEO data
        $this->page_title = $this->data['data_cms']->name." | ".SITE_NAME;
        $this->data['meta_keys'] =  $this->data['data_cms']->name;
        $this->data['meta_desc'] = $this->data['data_cms']->name;
        				
		$this->template
		->set_layout('general')
		->enable_parser(FALSE)
		->title($this->page_title)		
		->build('cms', $this->data);
	}
	public function blog(){
		$this->data = [];
		
		$this->data['data_blog'] = $this->home_module->get_blog();		
				
        //set SEO data
        $this->page_title = "Blog - Nepal Medical House Call and Telemedicine | ".SITE_NAME;
        $this->data['meta_keys'] =  "";
        $this->data['meta_desc'] = "";
        				
		$this->template
		->set_layout('general')
		->enable_parser(FALSE)
		->title($this->page_title)		
		->build('blog', $this->data);
	}
	
	public function blogDetails($slug){
		$this->data = [];
		
		$this->data['data_cms'] = $this->home_module->get_blog_by($slug);
		$this->data['data_other'] = $this->home_module->get_blog_other($slug);		
		if($this->data['data_cms'] == false)
		{
			redirect(site_url(''),'refresh');exit;
		}
		
        //set SEO data
        $this->page_title = $this->data['data_cms']->name." | ".SITE_NAME;
        $this->data['meta_keys'] =  $this->data['data_cms']->name;
        $this->data['meta_desc'] = $this->data['data_cms']->name;
        				
		$this->template
		->set_layout('general')
		->enable_parser(FALSE)
		->title($this->page_title)		
		->build('blog_details', $this->data);
	}
	
	public function book_appointment(){
		$this->data = [];
		// $this->form_validation->set_rules($this->home_module->validate_patient);
		// if ($this->form_validation->run() == true) 
		// {
		// 	$this->home_module->add_patient(); 
		// 	$this->session->set_flashdata('message','Appointment submitted successfully.');
		// 	redirect(base_url('book-appointment-now'),'refresh');
		// }
		
		
        //set SEO data
        $this->page_title = "Book Appointment | ".SITE_NAME;
        $this->data['meta_keys'] =  "";
        $this->data['meta_desc'] = "";
        				
		$this->data['covid_test_type'] = $this->general->covid_test_type();
		$this->data['house_call_visit'] = $this->general->house_call_visit();
		
		$this->template
		->set_layout('general')
		->enable_parser(FALSE)
		->title($this->page_title)		
		->build('book_appointment', $this->data);
	}

	public function schedule(){
		$this->data = [];
		
        //set SEO data
        $this->page_title = "Schedule Appointment | ".SITE_NAME;
        $this->data['meta_keys'] =  "";
        $this->data['meta_desc'] = "";
        				
		
		$this->template
		->set_layout('general')
		->enable_parser(FALSE)
		->title($this->page_title)		
		->build('book_appointment_company', $this->data);
	}

	public function reset_password()
	{
		$code = urldecode($this->input->get('key'));
        $email = (urldecode(base64_decode($this->input->get('auth'))));
		$user = $this->home_module->is_user_ready_reset_password($email,$code);

		if($user)
		{ 

			//set SEO data
	        $this->page_title = "Reset Password | ".SITE_NAME;
	        $this->data['meta_keys'] =  "";
	        $this->data['meta_desc'] = "";
	        
			$this->form_validation->set_rules($this->home_module->validate_resetpw);
			if($this->form_validation->run()==TRUE)
			{
				$this->home_module->reset_password($user);
				$this->session->set_flashdata('message',"Password changed successfully. Login to continue.");
				$this->page_title = "Reset Password | ".SITE_NAME;
		        $this->data['meta_keys'] =  "";
		        $this->data['meta_desc'] = "";

		        $this->template
						->set_layout('general')
						->enable_parser(FALSE)
						->title($this->page_title)			
						->build('message', $this->data);
			}else{
				$this->data['meta_keys']= '';
			    $this->data['meta_desc']= '';
				$this->page_title = SITE_NAME.' - Reset Password';
				$this->template
					->set_layout('general')
					->enable_parser(FALSE)
					->title($this->page_title)			
					->build('reset_pw', $this->data);
			}
			
		}
		else
		{
			$this->session->set_flashdata('error_msg',"Enter your Email");
			redirect(site_url(''));
		}	
	}

	public function email_taken()
	{
   		$email = trim($this->input->post('email'));
   		$result=$this->home_module->email_exists($email);
		if ( $result ) {
			echo 'taken';exit;
		} else {
			echo 'available';exit;
		}
	}

	public function activation($code='',$id='')
	{
		 $query = $this->db->get_where('members',array('activation_code'=>$code,'id'=>$id));
		 if($query->num_rows()>0)
         {
			 	$data=array('id'=>$id);
                $this->db->where('id',$id);
                $this->db->update('members',array('status' => '1'));
				$this->session->set_flashdata('message', 'Your account has been activated. Login to continue.');
		 }
		 else
		 {
		 		$this->session->set_flashdata('error', 'Failed to activate your account.');
		 }

		$this->page_title = "Account Activation | ".SITE_NAME;
        $this->data['meta_keys'] =  "";
        $this->data['meta_desc'] = "";

        $this->template
				->set_layout('general')
				->enable_parser(FALSE)
				->title($this->page_title)			
				->build('message', $this->data);

	}

	public function verify_newemail()
	{
		$this->data[''] = '';
		$new_email= urldecode(base64_decode($this->input->get('key')));
		$res = $this->home_module->verify_newemail();
		if($res == TRUE){
			$this->session->set_flashdata('message', 'Your new email '.$new_email.' has been verified successfully. Now use this email to login.');
		}else{
			$this->session->set_flashdata('message', 'Oops!! Something went wrong.');
		}
		
		$this->page_title = "Verify New Email | ".SITE_NAME;
        $this->data['meta_keys'] =  "";
        $this->data['meta_desc'] = "";

        $this->template
				->set_layout('general')
				->enable_parser(FALSE)
				->title($this->page_title)			
				->build('message', $this->data);

	}

	public function booking_success()
	{
		$details = $this->home_module->get_cms_byId(24);
		$this->data['title'] = 'Appointment Booking';
		$this->session->set_flashdata('message', strip_tags($details->content));
		$this->page_title = "Appoint Booking Success | ".SITE_NAME;
        $this->data['meta_keys'] =  "";
        $this->data['meta_desc'] = "";

        $this->template
				->set_layout('general')
				->enable_parser(FALSE)
				->title($this->page_title)			
				->build('message', $this->data);

	}

	public function patient($status,$id)
	{
		$this->load->model('my-account/provider_module');
		$patient_id = base64_decode($id);
		$patient_info = $this->provider_module->get_patient_byid($patient_id);
		if(empty($patient_info) || $patient_info->visit_status > '0'){
			redirect(base_url(),'refresh');
			exit;
		}
		if($status == 'accept'){
			$this->home_module->accept_patient($patient_id);
			$this->provider_module->patient_accepted($patient_id);
			$this->data['title'] = 'Patient Accepted';
			$this->session->set_flashdata('message', 'Patient request accepted successfully.');
		}elseif($status == 'reject'){
			$this->home_module->reject_patient($patient_id);
			$this->provider_module->send_decline_notification($patient_id);
			$this->data['title'] = 'Patient Declined';
			$this->session->set_flashdata('message', 'Patient request rejected.');
		}
		$this->page_title = "".SITE_NAME;
        $this->data['meta_keys'] =  "";
        $this->data['meta_desc'] = "";

        $this->template
				->set_layout('general')
				->enable_parser(FALSE)
				->title($this->page_title)			
				->build('home/message', $this->data);
	}

	function checkMail(){
		mail("sujit2039@gmail.com", "Direct PHP mail","Hi message");
				$config['protocol']    = 'mail';
		$config['mailpath']    = '/usr/sbin/sendmail';  // Path to sendmail (adjust if needed)
		$config['mailtype']    = 'html';  // Or 'text' for plain text emails
		$config['charset']     = 'utf-8';
		$config['wordwrap']    = TRUE;
		$config['newline']     = "\r\n";  // Set the correct newline character
		$this->load->library('email', $config);
		// $this->email->set_debug(TRUE);  // Enable email debugging

		$this->load->library('email');
		$this->email->from('noreply@nepaimpressions.com', 'Your Name');
		$this->email->to('sujit2039@gmail.com');
		$this->email->subject('Test Email CodeIgniter');
		$this->email->message('This is a test email sent using sendmail protocol.');

		if ($this->email->send()) {
			echo "Email sent successfully.";
		} else {
			echo "Failed to send email.";
		}
		echo $this->email->print_debugger();  // Print debugging information
	}
}