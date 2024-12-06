<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //error_reporting(0);

class Admin extends CI_Controller {



	function __construct() {

		parent::__construct();

		

		// Check if User has logged in

		if (!$this->general->admin_logged_in())			

		{

			redirect(ADMIN_LOGIN_PATH, 'refresh');exit;

		}

			

		//load CI library

			$this->load->library('form_validation');
			$this->load->library('pagination');
			$this->load->library('breadcrumb');
			$this->load->library('upload');
			$this->load->library('image_lib');


		//load custom module

			$this->load->model('admin_blog');

		//Changing the Error Delimiters

		$this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

	}

	

	public function index()
	{		
		$this->data = [];
		
		//set pagination configuration			
		$config['base_url'] = site_url(ADMIN_DASHBOARD_PATH).'/blog/index';

		$config['total_rows'] = $this->admin_blog->get_total_data();

		$config['num_links'] = 5;

		$config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';

		$config['full_tag_close'] = '</ul></nav>';

		$config['first_tag_open'] = '<li>';

		$config['first_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li>';

		$config['last_tag_close'] = '</li>';

		$config['prev_link'] = 'Prev';

		$config['prev_tag_open'] = '<li>';

		$config['prev_tag_close'] = '<li>';

		$config['next_link'] = 'Next';

		$config['next_tag_open'] = '<li>';

		$config['next_tag_close'] = '<li>';

		$config['per_page'] = ADMIN_RECORDS_PER_PAGINATION; 

		$config['next_tag_open'] = '<li>';

		$config['next_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="#">';

		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li>';

		$config['num_tag_close'] = '</li>';		

		$config['uri_segment'] = '4';		

		$this->pagination->initialize($config); 

		$offset=$this->uri->segment(4,0);

			$this->data['links']=$this->pagination->create_links($config["per_page"], $offset);

		



		$this->data['result_data'] = $this->admin_blog->get_data($config['per_page'],$offset);


		$this->data['active_menu'] = "blog";

        $this->data['active_submenu'] = "blog";

        $this->data['modules_name'] = 'Blog Management';

        $this->data['modules_heading'] = "Blog";

        $this->breadcrumb->populate(

        	array(

        		'ADMIN' => ADMIN_DASHBOARD_PATH,

        		'Blog Management' => '#'

        	)

        );

		$this->template

			->set_layout('dashboard')

			->enable_parser(FALSE)

			->title('Blog View | '. SITE_NAME)

			->build('view', $this->data);	

		

	}

	public function add()
	{
		$this->data['jobs'] = 'Add';
			
		if ($this->input->server('REQUEST_METHOD')=== 'POST')
		{

			$this->form_validation->set_rules($this->admin_blog->validate_add);

			if($this->form_validation->run() === TRUE)
			{
				//upload image
				$upload_result = $this->admin_blog->upload_images($this->data['jobs']);
				if($upload_result == FALSE){
					$insert_id = $this->admin_blog->insert_record();
					if($insert_id)
					{				
						$this->session->set_flashdata('message','Data added successfully');
						redirect(ADMIN_DASHBOARD_PATH.'/blog/index', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', 'Data add Failed');
					}
				}
				

			}

		}

		
		$this->data['active_menu'] = "Blog";

        $this->data['active_submenu'] = "Blog";

        $this->data['modules_name'] = 'Blog Management';

        $this->data['modules_heading'] = 'Add Blog';

        $this->breadcrumb->populate(

        	array(

        		'ADMIN' => ADMIN_DASHBOARD_PATH,

        		'Blog Management' => '#'

        	)

        );

		$this->template

			->set_layout('dashboard')

			->enable_parser(FALSE)

			->title('Blog Add | '. SITE_NAME)

			->build('add', $this->data);



	}

	public function edit($id)
	{
		$this->data['jobs'] = 'Edit';
		
		$this->data['cms_data'] = $this->admin_blog->get_cms_byid($id);		

		//check data, if it is not set then redirect to view page
		if($this->data['cms_data'] == false){redirect(ADMIN_DASHBOARD_PATH.'/blog/index','refresh');exit;}
		
		$this->form_validation->set_rules($this->admin_blog->validate_add);		

		if($this->form_validation->run()==TRUE)
		{
						
			//upload image
			$upload_result = $this->admin_blog->upload_images($this->data['jobs']);
			
			//Check wheter image uploaded or not
			if($upload_result == FALSE)
			{
				$this->admin_blog->update_record($id);
				$this->session->set_flashdata('message','The cms records are update successful.');
				redirect(ADMIN_DASHBOARD_PATH.'/blog/index','refresh');
				exit;
			}
			
			
		}

		$this->data['active_menu'] = "Blog";

        $this->data['active_submenu'] = "Blog";

        $this->data['modules_name'] = 'Blog Management';

        $this->data['modules_heading'] = 'Edit Blog';

        $this->breadcrumb->populate(

        	array(

        		'ADMIN' =>ADMIN_DASHBOARD_PATH,

        		'Blog Management' => '#'

        	)

        );

		

		$this->template

			->set_layout('dashboard')

			->enable_parser(FALSE)

			->title('Blog Edit | '. SITE_NAME)

			->build('edit', $this->data);

	}

	

	public function delete($id)
	{

		$query = $this->db->get_where('blog', array('id' => $id));

			if($query->num_rows() > 0) 
			{

				$this->db->delete('blog', array('id' => $id));
				
				$this->session->set_flashdata('message','The cms record delete successful.');
				redirect(ADMIN_DASHBOARD_PATH.'/blog/index','refresh');
				exit;

			}

			else
				{
					$this->session->set_flashdata('message','Sorry no record found.');
					redirect(ADMIN_DASHBOARD_PATH.'/blog/index','refresh');
					exit;
				}

	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */