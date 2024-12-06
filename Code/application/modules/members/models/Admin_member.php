<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_member extends CI_Model 
{

	public function __construct() 
	{
		parent::__construct();
		//load CI library
			$this->load->library('form_validation');
			
			
	}
	
	public $validate_settings_edit =  array(	
			array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'),
			array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required'),
			array('field' => 'dob', 'label' => 'dob', 'rules' => 'trim'),
			array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|callback_check_email'),	
			
			array('field' => 'phone', 'label' => 'contact phone', 'rules' => 'required'),
			array('field' => 'address', 'label' => 'Address1', 'rules' => 'trim|required'),
			array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required'),
			array('field' => 'post_code', 'label' => 'Post Code/ Zip Code', 'rules' => 'trim|required'),
		);
	
	public $validate_settings_add = array(

		array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'),
		array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required'),
		array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|is_unique[members.email]'),
		array('field' => 'dob', 'label' => 'dob', 'rules' => 'trim'),
		
		array('field' => 'phone', 'label' => 'contact phone', 'rules' => 'required'),
		array('field' => 'address', 'label' => 'Address1', 'rules' => 'trim|required'),
		array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required'),
		array('field' => 'post_code', 'label' => 'Post Code/ Zip Code', 'rules' => 'trim|required'),
	
	);
	
	public function get_total_members($status)
	{		
		if($status) $status = $status; else $status = '0';
		
		if($status == 'online')
		$this->db->where('mem_login_state',1);
		else
		$this->db->where('status',$status);
		
		if($this->input->post('srch')!="")
		{
			$where = "(first_name LIKE '%".$this->input->post('srch')."%' OR phone LIKE '%".$this->input->post('srch')."%' OR email LIKE '%".$this->input->post('srch')."%')";
			$this->db->where($where);
		}
		$this->db->where('member_type' , '1');
		$query = $this->db->get('members');

		return $query->num_rows();
	}
	
	public function get_members_details($status,$perpage,$offset)
	{
		if($status) $status = $status; else $status = '0';
		
		$this->db->from('members');
		
		if($status == 'online')
		$this->db->where('mem_login_state',1);
		else
		$this->db->where('status',$status);
		
		if($this->input->post('srch')!="")
		{
			$where = "(first_name LIKE '%".$this->input->post('srch')."%' OR phone LIKE '%".$this->input->post('srch')."%' OR email LIKE '%".$this->input->post('srch')."%')";
			$this->db->where($where);
		}
		if($this->input->post('from')!="")
		{
			$this->db->where('reg_date >=', $this->input->post('from'));
		}
		if($this->input->post('to')!="")
		{
			$this->db->where('reg_date <=', $this->input->post('to'));
		}
		
		$this->db->where('member_type' , '1');
		$this->db->order_by("id", "asc");
		$this->db->limit($perpage, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}
	
	
	
	public function get_member_byid($id)
	{			
				 $this->db->select('m.*');
				 $this->db->from('members m');				 
		$query = $this->db->get_where('members',array('m.id'=>$id));

		if ($query->num_rows() > 0)
		{
		   return $query->row();
		} 

		return false;
	}
	
	
	public function update_record($id)
	{
		//set  info
		$data_profile = $this->input->post();
						unset($data_profile['Submit']);
						unset($data_profile['user_id']);
						// print_r($data_profile);exit;
		$this->db->where('id', $this->input->post('user_id', TRUE));
		$this->db->update('members', $data_profile);
		
	}
	
	public function count_member_transaction($user_id)
	{
		$option = array('user_id'=>$user_id,'transaction_status'=>'Completed');
		$query = $this->db->get_where('transaction',$option);
		return $query->num_rows();
	}
	public function get_member_transaction($user_id,$perpage,$offset)
	{
		$option = array('user_id'=>$user_id,'transaction_status'=>'Completed');
				 $this->db->order_by("invoice_id", "desc");
				 $this->db->limit($perpage, $offset);
		$query = $this->db->get_where('transaction',$option);
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
	
	
	function change_member_password()
	{		
		$user_id = $this->input->post('user_id', TRUE);
		
		//generate password
		$salt = $this->general->salt();		
		$password = $this->general->hash_password($this->input->post('password',TRUE),$salt);
		
		$data_profile = array('salt' => $salt,'password' => $password);
		
		$this->db->where('id', $user_id);
		$this->db->update('members', $data_profile);
		
		//Send notification email to user		
		$user_data = $this->get_member_byid($user_id);
		$user_name = $user_data->user_name;
		$email = $user_data->email;
		
		//load notification library
        	$this->load->library('notification');
					
		//parse email	
			$parseElement=array("USERNAME"=>$user_name,
								"TO"=>$email,								
								"SITENAME"=>SITE_NAME,
								"EMAIL"=>$email,	
								"PASSWORD"=>$this->input->post('password'));

			$this->notification->send_email_notification('change_password_user', $parseElement);
			
			return 'Password Changed!!!';
		
	}

	/**
	*	2015-11-25
	*	insert admin user record
	*
	**/
	public function insert_member($salt, $password)
	{
		$ip_address = $this->general->get_real_ipaddr();
		
		$data = array(               
			   'salt' => $salt,
			   'password' => $password,
			   'reg_ip_address' => $ip_address,			  
			   'reg_date' => $this->general->get_local_time('time'),			   
			   'status' => '1',
			   'member_type' => '1',
            );

		$data = array_merge($data,$this->input->post());
        unset($data['Submit']);
        
		// print_r($data);exit;
		 $this->db->insert('members', $data);
		 
		return $this->db->insert_id();
	}
	
	
	public function register_notification($user_id, $password)
    {		
		$user_data = $this->get_member_byid($user_id);
				
		$email = $user_data->email;
		$first_name = $user_data->first_name;
		//load notification library
        $this->load->library('notification');

		$parseElement=array(						
						"SITENAME"=>SITE_NAME,
						"TO"=>$email,
						"EMAIL"=>$email,
						"FIRSTNAME"=>$first_name,
						"PASSWORD"=>$password,
						"CONFIRM" => ''
		);		
		
		return $this->notification->send_email_notification('register_notification', $parseElement);
		
    }
	
	public function reg_confirmation_email($user_id)
    {		
		$user_data = $this->get_member_byid($user_id);
				
		$activation_code = $user_data->activation_code;
		$email = $user_data->email;
		$user_name = $user_data->user_name;
		$first_name = $user_data->first_name;
		//load notification library
        $this->load->library('notification');

		$confirm="<a href='".$this->general->lang_uri('/users/register/activation/'.$activation_code.'/'.$user_id)."'>".$this->general->lang_uri('/users/register/activation/'.$activation_code.'/'.$user_id)."</a>";

		$parseElement=array(
						"USERNAME"=>$user_name,
						"CONFIRM"=>$confirm,
						"SITENAME"=>SITE_NAME,
						"TO"=>$email,
						"EMAIL"=>$email,
						"FIRSTNAME"=>$first_name,
						"PASSWORD"=>'******'
		);		
		
		return $this->notification->send_email_notification('register_notification', $parseElement);
		
    }
	
}
