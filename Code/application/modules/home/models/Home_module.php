<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_module extends CI_Model 
{

	public function __construct() 
	{
		parent::__construct();
	}

	public $validate_resetpw =  array(				
		array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[4]'),
			array('field' => 're_password', 'label' => 'Confirm password', 'rules' => 'required|matches[password]'),
		);
	
	public function get_cms_bytype($type)
	{							 
		$query = $this->db->get_where('cms',array('type'=>$type, 'is_display'=>1));

		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}
	
	public function get_cms_byslug($slug)
	{							 
		$query = $this->db->get_where('cms',array('slug'=>$slug, 'is_display'=>1));

		if ($query->num_rows() > 0)
		{
		   return $query->row();
		} 

		return false;
	}

	public function get_cms_byId($id)
	{							 
		$query = $this->db->get_where('cms',array('id'=>$id, 'is_display'=>1));

		if ($query->num_rows() > 0)
		{
		   return $query->row();
		} 

		return false;
	}

	public function get_banner()
	{							 
		$query = $this->db->get_where('cms',array('type'=>5, 'id'=>22));

		if ($query->num_rows() > 0)
		{
		   return $query->row();
		} 

		return false;
	}
	
	public function get_blog()
	{							 
		$query = $this->db->get_where('blog',array('is_display'=>1));

		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}
	
	public function get_blog_by($slug)
	{							 
		$this->db->where('slug', $slug);
		$this->db->set('views', 'views + ' . (int)1, FALSE);
		$this->db->update('blog');
		$query = $this->db->get_where('blog',array('slug'=> $slug, 'is_display'=>1));

		if ($query->num_rows() > 0)
		{
		   return $query->row();
		} 

		return false;
	}
	
	public function get_blog_other($slug)
	{			
				 $this->db->limit(3);				 
		$query = $this->db->get_where('blog',array('slug !='=> $slug, 'is_display'=>1));

		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}

	// public function add_patient($user_id = '0')
	// {
	// 	$name = $this->input->post('name');
	// 	$last_name = $this->input->post('last_name');
	// 	$phone = $this->input->post('phone');
	// 	$email = $this->input->post('email');
	// 	$symptoms = $this->input->post('symptoms');
	// 	$address = $this->input->post('address');
	// 	$month = $this->input->post('month');
	// 	$day = $this->input->post('day');
	// 	$year = $this->input->post('year');
	// 	$dob_ts = strtotime("$year-$month-$day");
	// 	$dob = date("Y-m-d",$dob_ts);
	// 	$data = array(
	// 		'user_id' => $user_id,
	// 		'name' => $name,
	// 		'last_name' => $last_name,
	// 		'phone' => $phone,
	// 		'email' => $email,
	// 		'dob' => $dob,
	// 		'symptoms' => $symptoms,
	// 		'covid_test' => $this->input->post('covid_test'),
	// 		'covid_test_type' => $this->input->post('covid_test_type', TRUE),
	// 		'covid_no_test' => $this->input->post('covid_no_test', TRUE),
	// 		'covid_test_price' => $this->input->post('covid_test_price', TRUE),
	// 		'appointment_type' => $this->input->post('appointment_type', TRUE),
	// 		'house_call_visit' => $this->input->post('house_call_visit', TRUE),
	// 		'house_call_additional_member' => $this->input->post('house_call_additional_member', TRUE),
	// 		'total_amount' => $this->input->post('total_amount', TRUE),
	// 		'address' => $this->input->post('address', TRUE),
	// 		'address2' => $this->input->post('address2', TRUE),
	// 		'city' => $this->input->post('city', TRUE),
	// 		'state' => $this->input->post('state', TRUE),
	// 		'zip' => $this->input->post('zip', TRUE),
	// 		'how_find_us' => $this->input->post('how_find_us', TRUE),
	// 		'created_at' => $this->general->get_local_time('time'),
	// 		'post_date' => $this->general->get_local_time('time'),
	// 		'payment_status' => 1,
	// 		'reference_num' => $this->general->random_number()
	// 	);
	// 	$this->db->insert('patient',$data);
	// 	if($this->db->insert_id()){
	// 		$this->load->library('notification');
	// 		$parseElement=array(
	// 						"PATIENTNAME"=> $name.' '. $last_name,
	// 						'PHONE' => $phone,
	// 						'EMAIL' => $email,
	// 						'SYMPTOMS' => $symptoms,
	// 						'ADDRESS' => $address,
	// 						"SITENAME"=>SITE_NAME,
	// 						"TO"=> CONTACT_EMAIL
	// 		);	
	// 		$this->notification->send_email_notification('appointment_submitted_admin', $parseElement);
	// 		$parseElement["TO"] = $email;
	// 		$this->notification->send_email_notification('appointment_submitted', $parseElement);
	// 	}
	// }


	/**
	* Check valid email and reset token
	*/
	public function is_user_ready_reset_password($email,$code){
        $this->db->select('');
        $query = $this->db->get_where('members', array('forgot_password_code' => $code, 'email' => $email));
        if($query->num_rows()>0){
            return $query->row();
        }
        else{
            return false;
        }
    }

    /**
    * Change password of user
    */
    public function reset_password($user)
    {
    	$this->db->where('id', $user->id);
    	$salt = $this->general->salt();		
		$password = $this->general->hash_password($this->input->post('password',TRUE),$salt);
    	$this->db->update('members', array('salt' => $salt, 'password' => $password));
    }

    public function email_exists($email)
	{
		$data = array();
		$query = $this->db->get_where("members",array('email'=>$email));
		if ($query->num_rows() > 0) 
		{
			$data=$query->row();				
		}
		$query->free_result();	
		return $data;
	}

	public function verify_newemail()
	{
		$email= urldecode(base64_decode($this->input->get('auth')));
		$new_email= urldecode(base64_decode($this->input->get('key')));
		$query = $this->db->get_where('members', array(
			'email' => $email,
			'new_email' => $new_email
		));
		if($query->num_rows() > 0){
			$this->db->where('email', $email);
			$this->db->update('members', array('email' => $new_email, 'new_email' => ''));
			$this->session->unset_userdata(SESSION.'user_id');
			$this->session->unset_userdata(SESSION.'first_name');
			$this->session->unset_userdata(SESSION.'email');
			$this->session->unset_userdata(SESSION.'last_name');
			$this->session->unset_userdata(SESSION.'member_type');
			
			return TRUE;
		}
		return false;
	}

	public function accept_patient($patient_id)
	{
		$this->db->where('id', $patient_id);
		$this->db->update('patient', array(
			'appointment_date' => date('Y-m-d H:i'),
			'visit_status' => '1'
		));
		return true;
		
	}

	public function reject_patient($patient_id)
	{
		$this->db->where('id', $patient_id);
		$this->db->update('patient', array(
			'visit_status' => '3'
		));
		// echo $this->db->last_query();
		return true;
		
	}
	
	
}

