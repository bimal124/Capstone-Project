<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_module extends CI_Model {

	public $validate_settings =  array(
			array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'),
			array('field' => 'last_name', 'label' => 'last Name', 'rules' => 'trim|required'),
			array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|callback_check_email')
		);

	public function get_user_details()
	{
		$this->db->select('m.*');
		$this->db->from('members m');
		$this->db->where('m.id', $this->session->userdata(SESSION.'user_id'));
		$this->db->where('m.status', '1');
		$this->db->group_by('m.id');
		$query = $this->db->get();
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		return false;
	}

	public function check_email()
	{
		$email = $this->input->post('email');
		$query = $this->db->get_where('members', array('id !=' => $this->user_id, 'email'=>$email));

		if($query->num_rows() > 0) {
			return $query->row();
		}
		return false;
	}

	public function update_profile()
	{
		$new_email = $this->input->post('email');
		$month = $this->input->post('month');
		$day = $this->input->post('day');
		$year = $this->input->post('year');
		$dob_ts = strtotime("$year-$month-$day");
		$dob = date("Y-m-d",$dob_ts);
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			// 'dob' => $dob,
			// 'address' => $this->input->post('address'),
			// 'city' => $this->input->post('city'),
			// 'country' => $this->input->post('country')
		);
		if($new_email != $this->session->userdata(SESSION.'email')){
			$data['new_email'] = $new_email;
		}
		$this->db->where('id', $this->session->userdata(SESSION.'user_id'));
		$this->db->update('members', $data);
		$this->session->set_userdata(array(SESSION.'first_name' => $this->input->post('first_name')));
		$this->session->set_userdata(array(SESSION.'first_name' => $this->input->post('last_name')));

		if($new_email != $this->session->userdata(SESSION.'email')){
			$this->load->library('notification');	
			$key = urlencode(base64_encode($new_email));
			$encoded_email = urlencode(base64_encode($this->session->userdata(SESSION.'email')));
			$reset_link = "<a href='".site_url('/home/verify_newemail').'/?key='.$key.'&auth='.$encoded_email."'>".site_url('/home/verify_newemail').'/?key='.$key.'&auth='.$encoded_email."</a>";

			$parseElement=array("TO"=> $new_email,
							"FIRSTNAME" => $this->input->post('first_name'),
							"SITENAME"=>SITE_NAME,
							  "CONFIRM"=>$reset_link,
							  "EMAIL"=>$this->input->post('email')
						);
									
			$this->notification->send_email_notification('verify_email_change', $parseElement);
		}
	}

	public function update_profile_contact()
	{
		$data = array(
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'post_code' => $this->input->post('post_code'),
			'country' => $this->input->post('country')
		);
		$this->db->where('id', $this->session->userdata(SESSION.'user_id'));
		$this->db->update('members', $data);
		
		return true;
	}

	public function update_profile_company()
	{
		$data = array(
			'company_name' => $this->input->post('company_name'),
			// 'company_reg_no' => $this->input->post('company_reg_no'),
			'company_addr' => $this->input->post('company_addr'),
			'company_state' => $this->input->post('company_state'),
			'company_city' => $this->input->post('company_city'),
			'company_postal_code' => $this->input->post('company_postal_code'),
			'company_country' => $this->input->post('company_country')
		);
		$this->db->where('id', $this->session->userdata(SESSION.'user_id'));
		$this->db->update('members', $data);
		
		return true;
	}

	public function check_old_password(){
		$user_id = $this->session->userdata(SESSION.'user_id');
		$option = array('id'=>$user_id);
		$query = $this->db->get_where('members',$option);
		if($query->num_rows() > 0){
			$user_data = $query->row();
			$user_password = $user_data->password;
			$salt = $user_data->salt;
			$password = $this->general->hash_password($this->input->post('old_password',TRUE),$salt);
			if($user_password === $password)
			{
				return TRUE;
			}
		}
		return false;		
	}

	public function change_password(){
		$user_id = $this->session->userdata(SESSION.'user_id');
		//generate password
		$salt = $this->general->salt();		
		$password = $this->general->hash_password($this->input->post('new_password',TRUE),$salt);
		//set member info
		$data = array(
			   'password' => $password,
			   'salt' => $salt,
			   'last_modify_date' => $this->general->get_local_time('time')
            );
		 $this->db->where('id', $user_id);

		 $this->db->update('members',$data);

	}

	public function get_orders($count = true, $limit = NULL, $offset = NULL)
	{
		$this->db->select('p.*');
		$this->db->from('patient p');
		$this->db->where('p.payment_status', '1');
		$this->db->where('p.user_id', $this->session->userdata(SESSION.'user_id'));
		if($limit)
			$this->db->limit($limit, $offset);
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get();

		if($count == true)
			return $query->num_rows();
		
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}

	public function get_patient_info($patient_id)
	{
		$this->db->select('p.*,pr.report_details');
		$this->db->from('patient p');
		$this->db->join('patient_reports pr', 'p.id = pr.patient_id', 'left');
		$this->db->where('p.id', $patient_id);
		$this->db->where('p.user_id', $this->session->userdata(SESSION.'user_id'));
		$this->db->where('p.visit_status !=', '3');
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		return false;
	}


}

/* End of file Account_module.php */
/* Location: ./application/modules/my-account/models/Account_module.php */