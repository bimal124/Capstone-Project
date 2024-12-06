<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_dashboard extends CI_Model 
{
	
	public $validate_administrator = array(
        array('field' => 'user_name', 'label' => 'Username', 'rules' => 'trim|required|min_length[5]'),
		array('field' => 'password' , 'label' => 'Password' , 'rules' => 'trim|min_length[6]|max_length[20]'),
		array('field' => 'conf' , 'label' => 'Confirm Password' , 'rules' => 'trim|matches[password]'),
        array('field' => 'email' , 'label' => 'Email' , 'rules' => 'required|valid_email'),
        array('field' => 'image' , 'label' => 'Image' , 'rules' => 'callback_image_validation'),  
    );

	public function __construct() 
	{
		parent::__construct();
		
	}
	
	public function total_active_patient()
	{
		$this->db->where('visit_status !=','3');
		$q=$this->db->get('patient');
		if($q->num_rows()>0)
		{
			return $q->num_rows();
		}
		
	}
	
	public function total_patient()
	{
		$this->db->where('visit_status','0');
		$this->db->or_where('visit_status','1');
		$q=$this->db->get('patient');
		if($q->num_rows()>0)
		{
			return $q->num_rows();
		}
		
	}
	
	public function total_members($member_type)
	{
		$this->db->where('member_type', $member_type);
		$this->db->where('status','1');
		$q=$this->db->get('members');
		if($q->num_rows()>0)
		{
			return $q->num_rows();
		}
		return '0';
	}
	
	public function get_patients_details($limit)
	{		
		$this->db->from('patient');		
		$this->db->where('assign_dr','0');		
		$this->db->where('payment_status','1');		
		$this->db->order_by("id", "desc");
		$this->db->limit($limit);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}
}
