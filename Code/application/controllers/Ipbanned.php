<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ipbanned extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
 
      //load custom library
		$this->load->library('my_language');
		
		if(SITE_STATUS == 'offline')
		{
			redirect($this->general->lang_uri('/offline'),'refresh');
			exit;
		}
    }
 
    function index()
    {
		$this->data = array();
		//set SEO data
		$this->page_title = "BIBID";
		$this->data['meta_keys'] = "BIBID";
		$this->data['meta_desc'] = "BIBID";
					
		//get user IP address
		$user_ip = $this->general->get_real_ipaddr();
		$query = $this->db->get_where("block_ips",array("ip_address"=>$user_ip));
						
		if($query->num_rows() > 0)
		{
			$banned_data = $query->row();

			$this->data['content'] = nl2br($banned_data->message);
			$this->load->view('ipban',$this->data);	
		}
		else
		{
			redirect($this->general->lang_uri(''), 'refresh');exit;
		}
				
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */