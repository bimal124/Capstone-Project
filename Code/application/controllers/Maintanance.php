<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maintanance extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		if(SITE_STATUS == '1'){
			//redirect to live site
			redirect(site_url(''));
		}else if(SITE_STATUS == '2'){
			//redirect to offline page
			redirect(site_url('/offline'));
		}
	}
	
	public function index()
	{
		$this->data['title'] = 'Site Maintenance';
		$this->session->set_flashdata('message', 'This site is on Maintenance. Please try later.');
		if($this->input->server('REQUEST_METHOD')=='POST' && $this->input->post('key',TRUE))
		{
			//check whether key is matched with key or not
			$maintainance_key = $this->input->post('key',TRUE);
			
			$this->db->select('maintainance_key');
			$query = $this->db->get("site_settings");
			if($query->num_rows() > 0) 
			{
				$data=$query->row();
				
				if($maintainance_key===$data->maintainance_key)
				{
					//set session for maintainance
					$this->session->set_userdata('MAINTAINANCE_KEY','YES');
					//echo $this->session->userdata('MAINTAINANCE_KEY');exit;
					redirect(site_url(),'refresh'); exit;
				}else{
					$this->session->set_flashdata('message', 'Invalid Maintenance Key.');
				}
			}
		}
		$this->page_title = SITE_NAME;
        $this->data['meta_keys'] =  "";
        $this->data['meta_desc'] = "";

        $this->template
				->set_layout('general')
				->enable_parser(FALSE)
				->title($this->page_title)			
				->build('home/message', $this->data);
	}

	public function get_cms($parent_id)
	{
		//get language id from configure file
		$lang_id = $this->config->item('current_language_id');
		
		$data = array();
		$query = $this->db->get_where("cms",array("parent_id"=>$parent_id,"lang_id"=>$lang_id,"is_display"=>"Yes"));
		if ($query->num_rows() > 0) 
		{
			$data=$query->row();				
		}	
		else
			{
				$query = $this->db->get_where("cms",array("parent_id"=>$parent_id,"lang_id"=>DEFAULT_LANG_ID));
				if ($query->num_rows() > 0) 
				{
					$data=$query->row();				
				}
			}	
		$query->free_result();
		return $data;
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */