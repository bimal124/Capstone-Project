<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_module extends CI_Model {

	public function get_patient_info($patient_id)
	{
		$this->db->select('p.*,pr.report_details');
		$this->db->from('patient p');
		$this->db->join('patient_reports pr', 'p.id = pr.patient_id', 'left');
		$this->db->where('p.id', $patient_id);
		$this->db->where('p.assign_dr', $this->session->userdata(SESSION.'user_id'));
		$this->db->where('p.visit_status !=', '3');
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		return false;
	}

	public function get_report_files($patient_id)
	{
		$this->db->select('pra.*');
		$this->db->from('patient_report_attachment pra');
		$this->db->where('pra.patient_id', $patient_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		return false;
	}

	public function checkin()
	{
		$this->db->where('id', $this->input->post('patient_id'));
		$this->db->update('patient', array(
			// 'check_in_date' => $this->input->post('checkinTime')
			'check_in_date' => date('H:i')
		));
		return true;
	}

	public function checkout()
	{
		$id = $this->input->post('patient_id');
		$patient_info = $this->get_patient_info($id);
		$checkoutTime = date('H:i');
		if($patient_info->check_in_date == '' || $patient_info->report_details == ''){
			return false;
		}
		$this->db->where('id', $id);
		$this->db->update('patient', array(
			// 'check_out_date' => $this->input->post('checkoutTime'),
			'check_out_date' => $checkoutTime,
			'visit_status' => '2'
		));
		return true;
	}

	public function update_report()
	{
		$patient_id = $this->input->post('patient_id');
		$data = array(
			'age' => $this->input->post('age', TRUE),
			'gender' => $this->input->post('gender', TRUE),
			'symptoms' => $this->input->post('symptoms', TRUE),
			'denies' => $this->input->post('denies', TRUE),
			'past_medical_history' => $this->input->post('past_medical_history', TRUE),
			'past_surgical_history' => $this->input->post('past_surgical_history', TRUE),
			'medications' => $this->input->post('medications', TRUE),
			'allergies' => $this->input->post('allergies', TRUE),
			'social_history' => $this->input->post('social_history', TRUE),
			'family_history' => $this->input->post('family_history', TRUE),
			// 'vs' => $this->input->post('vs', TRUE),
			'bh' => $this->input->post('bh', TRUE),
			'hr' => $this->input->post('hr', TRUE),
			't' => $this->input->post('t', TRUE),
			'rr' => $this->input->post('rr', TRUE),
			'sats' => $this->input->post('sats', TRUE),
			'head' => $this->input->post('head', TRUE),
			'skin' => $this->input->post('skin', TRUE),
			'eyes' => $this->input->post('eyes', TRUE),
			'ears' => $this->input->post('ears', TRUE),
			'pharynx' => $this->input->post('pharynx', TRUE),
			'neck' => $this->input->post('neck', TRUE),
			'heart' => $this->input->post('heart', TRUE),
			'lungs' => $this->input->post('lungs', TRUE),
			'abdomen' => $this->input->post('abdomen', TRUE),
			'nose' => $this->input->post('nose', TRUE),
			'back' => $this->input->post('back', TRUE),
			'neuro' => $this->input->post('neuro', TRUE),
			'diagnosis' => $this->input->post('diagnosis', TRUE),
			'plan' => $this->input->post('plan', TRUE),
			'rx' => $this->input->post('rx', TRUE),
			'extremities' => $this->input->post('extremities', TRUE),
			'breast' => $this->input->post('breast', TRUE),
			'genitalia' => $this->input->post('genitalia', TRUE),
		);
		$query = $this->db->get_where('patient_reports', array('patient_id' => $patient_id));
		if($query->num_rows() > 0){
			$this->db->where('patient_id', $patient_id);
			$this->db->update('patient_reports', array(
				'report_details' => json_encode($data),
				'post_date' => $this->general->get_local_time('time')
			));
		}else{
			$this->db->insert('patient_reports',array(
				'patient_id' => $patient_id,
				'report_details' => json_encode($data),
				'post_date' => $this->general->get_local_time('time')
			));
		}
		return TRUE;
	}

	public function upload_attachment()
	{
		$patient_id = $this->input->post('patient_id');
		$upload_path = './upload_files/attachments/'.$patient_id;
		if(!file_exists($upload_path)){
			mkdir($upload_path);
		}
		$config['upload_path']          = $upload_path.'/';
        $config['allowed_types']        = 'gif|jpg|png|doc|docx|ppt|jpeg|pptx|pdf';
        $config['max_size']             = 10000;
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('attachmentFile'))
        {
                return $this->upload->display_errors();
        }
        else
        {
        	$upload_data = $this->upload->data();
        	$file_name = $upload_data['file_name'];
        	$data = array(
        		'patient_id' => $patient_id,
        		'name' => $file_name
        	);
        	$this->db->insert('patient_report_attachment', $data);
        	return true;
        }
	}

	public function remove_attachment($attachment_id)
	{
		$query = $this->db->get_where('patient_report_attachment', array(
			'id' => $attachment_id
		));
		if($query->num_rows() > 0){
			$res = $query->row();
			$patient_id = $res->patient_id;
			if(file_exists('./upload_files/attachments/'.$patient_id.'/'.$res->name)){
				@unlink('./upload_files/attachments/'.$patient_id.'/'.$res->name);
			}
			$this->db->where('id', $attachment_id);
			$this->db->delete('patient_report_attachment');
			return $patient_id;
		}
		return false;
	}

	public function share_report($patient_id)
	{
		$this->db->where('id', $patient_id);
		$this->db->update('patient', array('send' => 1));
	}

	


}

/* End of file Report_module.php */
/* Location: ./application/modules/my-account/models/Report_module.php */