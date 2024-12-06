<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offline extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		if(SITE_STATUS == 'online')
		{
			redirect(site_url(''));
		}
		
	}
	
	public function index()
	{
		$this->data['title'] = 'Site Offline';
		$this->session->set_flashdata('message', 'This site is offline. Please try later.');
		$this->page_title = "".SITE_NAME;
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