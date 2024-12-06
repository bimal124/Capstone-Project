<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin_email_settings extends CI_Model 

{



	public function __construct() 

	{

		parent::__construct();

		

	}

	

	public $validate_settings =  array(

			

			array('field' => 'subject', 'label' => 'Subject', 'rules' => 'required'),

			array('field' => 'content', 'label' => 'Email Body', 'rules' => 'required')

			);

	public function get_email_setting()
	{		
	
		$query = $this->db->get('email_settings');
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 
		return false;

	}
	
	public function get_email_setting_byemailcode($emailcode)

	{		

		$query = $this->db->get_where('email_settings',array("email_code "=>$emailcode,));



		if ($query->num_rows() > 0)

		{

		   return $query->row_array();

		} 



		return false;

	}

	

	public function update_email_settings($id)
	{

		$data = array(               

               'subject' => $this->input->post('subject', TRUE),               

			   'email_body' => $this->input->post('content'),			  

			   'last_update' => $this->general->get_local_time('time')

            );

			$email_code = $this->uri->segment(4);

			$this->db->where('id', $id);

			$this->db->update('email_settings', $data); 


	}

	

	



}

