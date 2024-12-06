<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_site_settings extends CI_Model 
{

	public function __construct() 
	{
		parent::__construct();
		
	}
	// modified by manish
	public $validate_site_settings =  array(
			array('field' => 'site_name', 'label' => 'Website Name', 'rules' => 'required'),
			array('field' => 'currency_code', 'label' => 'Currency Code', 'rules' => 'required'),
			array('field' => 'currency_sign', 'label' => 'Currency Sign', 'rules' => 'required'),
			array('field' => 'contact_email', 'label' => 'Contact Email', 'rules' => 'required|valid_email'),
			
			array('field' => 'system_email', 'label' => 'system email address', 'rules' => 'required|valid_email'),
	        array('field' => 'system_email_name', 'label' => 'system email name', 'rules' => 'required|min_length[2]|max_length[100]'),
		);
	
	public $validate_site_settings_smtp = array(
        array('field' => 'smtp_host', 'label' => 'smtp host', 'rules' => 'required|trim'),
        array('field' => 'smtp_port', 'label' => 'smtp port', 'rules' => 'required|trim'),
        array('field' => 'smtp_username', 'label' => 'smtp username', 'rules' => 'required|trim'),
        array('field' => 'smtp_password', 'label' => 'smtp password', 'rules' => 'required|trim'),
    );	
		
	public function get_site_setting()
	{		
		$query = $this->db->get('site_settings');

		if ($query->num_rows() > 0)
		{
		   return $query->row_array();
		} 

		return false;
	}
	
	public function update_site_settings()
	{
		$data = array(
               'site_name' => $this->input->post('site_name', TRUE),
               'contact_email' => $this->input->post('contact_email', TRUE),
			   'currency_code' => $this->input->post('currency_code', TRUE),
			   'currency_sign' => $this->input->post('currency_sign', TRUE),
               
			   'site_status' => $this->input->post('site_status', TRUE),
			   'maintainance_key'=>$this->input->post('maintainance_key', TRUE),
			   
			   'facebook_url' => $this->input->post('facebook_url', TRUE),
			   //'facebook_id' => $this->input->post('facebook_id', TRUE),
			   'instagram_url' => $this->input->post('instagram_url', TRUE),
			   //'twitter_url' => $this->input->post('twitter_url', TRUE),
			   //'linkedin_url' => $this->input->post('linkedin_url', TRUE),			   
			   
			    'mailing_type' => $this->input->post('mailing_type', TRUE),
				'system_email_name' => $this->input->post('system_email_name', TRUE),
				'system_email' => $this->input->post('system_email', TRUE),
				'smtp_host' => $this->input->post('smtp_host', TRUE),
				'smtp_port' => $this->input->post('smtp_port', TRUE),
				'smtp_username' => $this->input->post('smtp_username', TRUE),
				'smtp_password' => $this->input->post('smtp_password', TRUE),
			   
			   'html_tracking_code' => $this->input->post('html_tracking_code'),
				
			   'timezone' => $this->input->post('timezone', TRUE),
			   'login_id' => $this->input->post('login_id', TRUE),
			   'transaction_key' => $this->input->post('transaction_key', TRUE),
			   'transaction_env' => $this->input->post('transaction_env', TRUE)
            );

		$this->db->update('site_settings', $data); 

	}
	
	

}
