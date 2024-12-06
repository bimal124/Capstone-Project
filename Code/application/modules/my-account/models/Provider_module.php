<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provider_module extends CI_Model {

	public function get_patient_request($count = true, $limit = NULL, $offset = NULL)
	{
		$this->db->select('m.*');
		$this->db->from('patient m');
		$this->db->where('m.visit_status', '0');
		$this->db->where('m.payment_status', '1');
		$this->db->where('m.assign_dr', $this->session->userdata(SESSION.'user_id'));
		if($limit)
			$this->db->limit($limit, $offset);
		$this->db->order_by('post_date', 'asc');
		$query = $this->db->get();

		if($count == true)
			return $query->num_rows();
		
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}

	public function get_scheduled_patient($count = true, $limit = NULL, $offset = NULL)
	{
		$this->db->select('p.*, pr.report_details,m.member_type');
		$this->db->from('patient p');
		$this->db->join('patient_reports pr', 'p.id = pr.patient_id', 'left');
		$this->db->join('members m', 'p.user_id = m.id', 'left');
		$this->db->where('p.visit_status !=', '0');
		$this->db->where('p.payment_status', '1');
		$this->db->where('p.assign_dr', $this->session->userdata(SESSION.'user_id'));
		if($limit)
			$this->db->limit($limit, $offset);
		$this->db->group_by('p.id');
		// $this->db->order_by('p.visit_status', 'asc');
		$this->db->order_by('p.appointment_date', 'desc');
		$query = $this->db->get();

		if($count == true)
			return $query->num_rows();
		
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}

	public function schedule_patient()
	{
		$patient_id = $this->input->post('patient_id');
		$appointment_date = $this->input->post('appointment_date');
		$this->db->where('id', $patient_id);
		$this->db->update('patient', array(
			// 'appointment_date' => date('Y-m-d H:i', strtotime($appointment_date)),
			'appointment_date' => date('Y-m-d H:i'),
			'visit_status' => '1'
		));
		
		$this->patient_accepted($patient_id);
		return true;
	}

	public function patient_accepted($patient_id)
	{
		$patient_info = $this->get_patient_byid($patient_id);
		$this->load->library('notification');	
		$estimated_time = 'none';
		if($patient_info->appointment_type == '1'){
			if($patient_info->house_call_visit == 1){
				$estimated_time = '60-90 minutes';
			}else{
				$estimated_time = '2 hours';
			}
		}
		$parseElement=array(
					"TO"=> $patient_info->email,
					"FIRSTNAME" => $patient_info->name.' '.$patient_info->last_name,
					"SITENAME"=>SITE_NAME,
					  "ESTIMATED_TIME"=> $estimated_time,
					  "EMAIL"=>$patient_info->email
					);
								
		$this->notification->send_email_notification('patient_request_accepted', $parseElement);

		$this->notify_admin_accept($patient_id);
		return true;
	}

	public function notify_admin_accept($patient_id)
	{
		$this->db->select('p.name,p.appointment_type, p.house_call_visit, p.last_name,p.assign_dr,m.id, m.first_name,m.last_name as provider_last_name');
		$this->db->from('patient p');
		$this->db->join('members m', 'p.assign_dr = m.id', 'left');
		$this->db->where('p.id', $patient_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$patient_info = $query->row();
			$this->load->library('notification');	
			$estimated_time = 'none';
			if($patient_info->appointment_type == '1'){
				if($patient_info->house_call_visit == 1){
					$estimated_time = '60-90 minutes';
				}else{
					$estimated_time = '2 hours';
				}
			}
			$parseElement=array(
				"TO"=> CONTACT_EMAIL,
				"EMAIL"=>CONTACT_EMAIL,
				"PATIENT_NAME" => $patient_info->name.' '.$patient_info->last_name,
				"PROVIDER_NAME" => $patient_info->first_name .' ' .$patient_info->provider_last_name,
				"SITENAME"=>SITE_NAME,
				"DATE"=> $this->general->get_local_time('time'),
				"ESTIMATED_TIME"=> $estimated_time,
			);
								
			return $this->notification->send_email_notification('patient_request_accepted_admin', $parseElement);

		}
	}

	public function get_patient_byid($patient_id)
	{
		$query = $this->db->get_where('patient', array('id' => $patient_id));
		if($query->num_rows() > 0)
			return $query->row();
	}

	public function decline_patient()
	{
		$patient_id = $this->input->post('patient_id');
		$this->db->where('id', $patient_id);
		$this->db->update('patient', array(
			'visit_status' => '3'
		));
		$this->send_decline_notification($patient_id);

		return true;
	}

	public function send_decline_notification($patient_id)
	{
		$this->db->select('p.name, p.last_name,p.assign_dr,m.id, m.first_name,m.last_name as provider_last_name');
		$this->db->from('patient p');
		$this->db->join('members m', 'p.assign_dr = m.id', 'left');
		$this->db->where('p.id', $patient_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$patient_info = $query->row();
			$this->load->library('notification');	
			$parseElement=array(
				"TO"=> CONTACT_EMAIL,
				"EMAIL"=>CONTACT_EMAIL,
				"PATIENT_NAME" => $patient_info->name.' '.$patient_info->last_name,
				"PROVIDER_NAME" => $patient_info->first_name .' ' .$patient_info->provider_last_name,
				"SITENAME"=>SITE_NAME,
				"DECLINE_DATE"=> $this->general->get_local_time('time'),
			);
								
			return $this->notification->send_email_notification('patient_request_rejected', $parseElement);

		}
		return true;
	}
	

}

/* End of file Provider_module.php */
/* Location: ./application/modules/my-account/models/Provider_module.php */