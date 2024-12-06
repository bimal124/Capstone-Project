<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_transaction extends CI_Model 
{

	public function __construct() 
	{
		parent::__construct();
		
			
	}
	
	
	
	public function get_total_transaction()
	{	
		$this->db->select('t.*, p.name, p.last_name');
		$this->db->from('transaction t');
		$this->db->join('patient p', 't.user_id = p.id', 'left');

		if($this->input->post('patient_id')!="")
		{
			$this->db->where('p.user_id',$this->input->post('patient_id'));
		}

		if($this->input->post('provider_id')!="")
		{
			$this->db->where('p.assign_dr',$this->input->post('provider_id'));
		}

		if($this->input->post('company_id')!="")
		{
			$this->db->where('p.user_id',$this->input->post('company_id'));
		}
		$this->db->where('t.transaction_status', 'Completed');
		$this->db->order_by("t.invoice_id", "desc");
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function get_transaction_details($perpage,$offset)
	{
		$this->db->select('t.*, p.name, p.last_name');
		$this->db->from('transaction t');
		$this->db->join('patient p', 't.user_id = p.id', 'left');

		$where = '(';
		if($this->input->post('patient_id')!="")
		{
			$where.=" p.user_id=".$this->input->post('patient_id');
			// $this->db->where('p.user_id',$this->input->post('patient_id'));
		}

		if($this->input->post('provider_id')!="")
		{
			if(strlen($where) > 3){
				$where.=" OR ";
			}
			$where.=" p.assign_dr=".$this->input->post('provider_id');
			// $this->db->where('p.assign_dr',$this->input->post('provider_id'));
		}

		if($this->input->post('company_id')!="")
		{
			if(strlen($where) > 3){
				$where.=" OR ";
			}
			$where.=" p.user_id=".$this->input->post('company_id');

			// $this->db->where('p.user_id',$this->input->post('company_id'));
		}
		$where.=")";
		if(strlen($where) > 3){
			$this->db->where($where);
		}
		$this->db->where('t.transaction_status', 'Completed');
		$this->db->order_by("t.invoice_id", "desc");
		$this->db->limit($perpage, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}

	public function get_members_bytype($member_type){
		$this->db->select('id, title, first_name, last_name');
		$this->db->from('members');		
		$this->db->where('status','1');		
		$this->db->where('member_type', $member_type);		
		$this->db->order_by("first_name", "asc");
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}

	public function export()
	{
		$this->db->select('t.*, p.name, p.last_name');
		$this->db->from('transaction t');
		$this->db->join('patient p', 't.user_id = p.id', 'left');
		$where = '(';
		if($this->input->post('export_patient')!="")
		{
			$where.=" p.user_id=".$this->input->post('export_patient');
		}

		if($this->input->post('export_provider')!="")
		{
			if(strlen($where) > 3){
				$where.=" OR ";
			}
			$where.=" p.assign_dr=".$this->input->post('export_provider');
		}

		if($this->input->post('export_company')!="")
		{
			if(strlen($where) > 3){
				$where.=" OR ";
			}
			$where.=" p.user_id=".$this->input->post('export_company');
		}
		$where.=")";
		if(strlen($where) > 3){
			$this->db->where($where);
		}
		$this->db->where('t.transaction_status', 'Completed');
		$this->db->order_by("t.invoice_id", "desc");
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}
	
	
	
}
