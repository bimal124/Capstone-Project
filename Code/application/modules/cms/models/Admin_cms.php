<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_cms extends CI_Model 
{

	public function __construct() 
	{
		parent::__construct();
		//load CI library
			$this->load->library('form_validation');
			
			
	}
	
	public $validate_settings_edit =  array(	
			array('field' => 'name', 'label' => 'Title', 'rules' => 'trim|required'),
			array('field' => 'content', 'label' => 'Description', 'rules' => 'trim|required'),			
		);
	
	public $validate_add = array(

		array('field' => 'name', 'label' => 'Title', 'rules' => 'trim|required'),
			array('field' => 'content', 'label' => 'Description', 'rules' => 'trim|required'),		
	
	);
	
	public function get_total_cms($type)
	{	
		$this->db->where('type',$type);	
		if($this->input->post('srch')!="")
		{
			$where = "(name LIKE '%".$this->input->post('srch')."%')";
			$this->db->where($where);
		}
			
		$query = $this->db->get('cms');

		return $query->num_rows();
	}
	
	public function get_cms($type,$perpage,$offset)
	{
		$this->db->from('cms');		
		$this->db->where('type',$type);	
		
		if($this->input->post('srch')!="")
		{
			$where = "(name LIKE '%".$this->input->post('srch')."%')";
			$this->db->where($where);
		}
		
		$this->db->order_by("name", "asc");
		$this->db->limit($perpage, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}
	
	
	
	public function get_cms_byid($id)
	{							 
		$query = $this->db->get_where('cms',array('id'=>$id));

		if ($query->num_rows() > 0)
		{
		   return $query->row();
		} 

		return false;
	}
		
	public function insert_record($type_id)
	{		
		$name = $this->input->post('name');
		$data = array(               
			   'post_date' => $this->general->get_local_time('time'),
			   'last_update' => $this->general->get_local_time('time'),			   
			   'type' => $type_id,	
			   'slug' => $this->general->clean_url($name),  		  
            );
		 
		 //only if new image is uploaded
		if(isset($this->image_name_path) && $this->image_name_path !="")
		{				
			$data['image'] = $this->image_name_path;           
		}
		
		 $data = array_merge($data,$this->input->post());
		
         unset($data['Submit']);
         
		 $this->db->insert('cms', $data);
		 		 
		return $this->db->insert_id();
	}
	
	public function update_record($id)
	{
		$name = $this->input->post('name');
		$data = array('last_update' => $this->general->get_local_time('time'), 'slug' => $this->general->clean_url($name));
		
		//only if new image is uploaded
		if(isset($this->image_name_path) && $this->image_name_path !="")
		{
			@unlink('./'.CMS_IMG_PATH.$this->input->post('img_old'));
			@unlink('./'.CMS_IMG_PATH.'thumb_'.$this->input->post('img_old'));
				
			$data['image'] = $this->image_name_path;           
		}
		
		$data = array_merge($data,$this->input->post());
		
						unset($data['Submit']);
						unset($data['cms_id']);
						unset($data['img_old']);
						
		$this->db->where('id', $this->input->post('cms_id', TRUE));
		$this->db->update('cms', $data);
		
	}
	
	//function to resize images
	public function resize_image($file_name,$thumb_name,$width,$height)
	{
        $config['image_library'] = 'gd2';
		$config['source_image'] = './'.CMS_IMG_PATH.$file_name;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$config['master_dim'] = 'width';
		$config['new_image'] = './'.CMS_IMG_PATH.$thumb_name;
		
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		// $this->image_lib->clear(); 
	}
		
	
	public function file_settings_do_upload($file, $max_width, $max_height)
	{
		$config['upload_path'] = './'.CMS_IMG_PATH;//defined in constants
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name'] = TRUE;		
		$config['max_width'] = $max_width;
		$config['max_height'] = $max_height;
		
		// load upload library and set config
		$this->upload->initialize($config);	
		$this->upload->do_upload($file);
		
		if($this->upload->display_errors())
		{
			$this->error_img = $this->upload->display_errors();
			//echo $this->upload->display_errors(); exit;
			return false;
		}
		else
		{
			$data = $this->upload->data();
			return $data;
		}	
	}
	
	
	public function upload_images($job)
	{
		$image_error = FALSE;
		$this->session->unset_userdata('error_img');
		
		// Upload image 1
		if(($_FILES && $job =='Add') || (!empty($_FILES['image']['name']) && $job =='Edit'))
		{
			//make file settins and do upload it
			$image_name = $this->file_settings_do_upload('image','2400','1800');
			
			
            if(isset($image_name['file_name']))
            {
				$this->image_name_path = $image_name['file_name'];
				//resize image
				$this->resize_image($this->image_name_path,'thumb_'.$image_name['raw_name'].$image_name['file_ext'],240,180); //55,74
            }
            else
            {
			   $image_error = TRUE;
               $this->session->set_userdata('error_img',$this->error_img);
            }
		}
			return $image_error;
	}
}
