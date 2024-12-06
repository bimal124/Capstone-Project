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



		//load custom module

			$this->load->model('admin_providers');

		//Changing the Error Delimiters

		$this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

	}

	

	public function index()
	{

		if($this->uri->segment(4)) $status = $this->uri->segment(4); else $status = '1';

		//set pagination configuration			

		$config['base_url'] = site_url(ADMIN_DASHBOARD_PATH).'/providers/index/'.$status;

		$config['total_rows'] = $this->admin_providers->get_total_providers($status);

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

		$config['uri_segment'] = '5';		

		$this->pagination->initialize($config); 

		$offset=$this->uri->segment(5,0);

			$this->data['links']=$this->pagination->create_links($config["per_page"], $offset);

		



		$this->data['result_data'] = $this->admin_providers->get_providers_details($this->uri->segment(4),$config['per_page'],$offset);

		$this->data['active_menu'] = 'member';

        $this->data['active_submenu'] = 'providers';

        $this->data['modules_name'] = 'Providers Management';

        $this->data['modules_heading'] = 'View Providers Detail';

        $this->breadcrumb->populate(

        	array(

        		'ADMIN' => ADMIN_DASHBOARD_PATH,

        		'Member Management' => '#',
				'Providers Management' => '#'

        	)

        );

		$this->template

			->set_layout('dashboard')

			->enable_parser(FALSE)

			->title('Providers View | '. SITE_NAME)

			->build('view', $this->data);	

		

	}

	

	public function edit($status,$id)

	{

		//check id, if it is not set then redirect to view page

		if(!isset($id)){redirect(ADMIN_DASHBOARD_PATH.'/providers/index/'.$status,'refresh');exit;}

		

		$this->data['profile'] = $this->admin_providers->get_provider_byid($id);
		

		//check data, if it is not set then redirect to view page

		if($this->data['profile'] == false){redirect(ADMIN_DASHBOARD_PATH.'/providers/index/'.$status,'refresh');exit;}


		//Set the validation rules

		$this->form_validation->set_rules($this->admin_providers->validate_settings_edit);

		

		if($this->form_validation->run()==TRUE)

		{

			//Insert Lang Settings

			$this->admin_providers->update_record($id);

			$this->session->set_flashdata('message','The patient records are update successful.');

			redirect(ADMIN_DASHBOARD_PATH.'/providers/index/'.$status,'refresh');			

			exit;

		}



		$this->data['active_menu'] = 'member';

        $this->data['active_submenu'] = 'providers';

        $this->data['modules_name'] = 'Member Management';

        $this->data['modules_heading'] = 'Edit Providers';

        $this->breadcrumb->populate(

        	array(

        		'ADMIN' =>ADMIN_DASHBOARD_PATH,

        		'Member Management' => '#'

        	)

        );

		

		$this->template

			->set_layout('dashboard')

			->enable_parser(FALSE)

			->title('Providers Edit | '. SITE_NAME)

			->build('edit', $this->data);

	}

	

	public function delete($status,$id)

	{

		$query = $this->db->get_where('members', array('id' => $id));



			if($query->num_rows() > 0) 

			{

				$this->db->delete('members', array('id' => $id));				

				$this->session->set_flashdata('message','The member record delete successful.');

				redirect(ADMIN_DASHBOARD_PATH.'/providers/index/'.$status,'refresh');

				exit;

			}

			else

				{

					$this->session->set_flashdata('message','Sorry no record found.');

					redirect(ADMIN_DASHBOARD_PATH.'/providers/index/'.$status,'refresh');

					exit;

				}

	}

	

	public function check_email()

	{

		

		$user_id = $this->input->post('user_id');

		$email = $this->input->post('email');

		$query = $this->db->get_where('members', array('id !=' => $user_id, 'email'=>$email));

		if($query->num_rows() > 0) 

		{

			$this->form_validation->set_message('check_email',"The email address is already in used.");

			return false;

		}
		return true;
	}


	public function change_user_password()

	{

		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|max_length[12]');

		if($this->form_validation->run()==TRUE)

		{

			//echo $this->admin_providers->change_provider_password();		

			$res = array(

				'status'=>'success',

				'message'=>$this->admin_providers->change_provider_password()

			);

		}

		else

		{

			//echo '<input name="password" type="text" class="form-control" id="password" size="30" /> <input class="bttn" type="button" name="Submit" value="Changed" id="changed"  onclick="changedpassword(this.value)" />'.form_error('password');

			//echo '<input name="password" type="text" class="form-control form-control" id="password" size="30" />'.form_error('password');

			$res = array(

				'status'=>'error',

				'message'=>'<input name="password" type="text" class="form-control form-control" id="password" size="30" />'.form_error('password')

			);

		}

		echo json_encode($res);

	}



	/**

	*	2015-11-25

	*	add member for auto bid from admin

	*

	**/

	public function add()

	{

		if ($this->input->server('REQUEST_METHOD')=== 'POST')

		{

			$this->form_validation->set_rules($this->admin_providers->validate_settings_add);

			if($this->form_validation->run() === TRUE)
			{
				//generate password
				$salt = $this->general->salt();
				$rand_password = $this->general->create_password(8);
				$password = $this->general->hash_password($rand_password,$salt);

				$member_id = $this->admin_providers->insert_provider($salt, $password);

				if($member_id)
				{

					//send email notification about create your account.
					
					$this->admin_providers->register_notification($member_id, $rand_password);

					$this->session->set_flashdata('message','Provider added successfully');

					redirect(ADMIN_DASHBOARD_PATH.'/providers/index/1', 'refresh');

				}

				else

				{

					$this->session->set_flashdata('message', 'Provider add failed');

				}

			}

		}

		



		$this->data['active_menu'] = 'member';

        $this->data['active_submenu'] = 'providers';

        $this->data['modules_name'] = 'Providers Management';

        $this->data['modules_heading'] = 'Add Provider';

        $this->breadcrumb->populate(

        	array(

        		'ADMIN' => ADMIN_DASHBOARD_PATH,

        		'Provider Management' => '#'

        	)

        );

		$this->template

			->set_layout('dashboard')

			->enable_parser(FALSE)

			->title('Providers Add | '. SITE_NAME)

			->build('add', $this->data);



	}
	
	public function member_activation_mail($user_id)
	{
		
		$member_activation_mail_status = $this->admin_providers->reg_confirmation_email($user_id);
		///var_dump($member_activation_mail_status);exit;
		if($member_activation_mail_status)
		{
			$this->session->set_flashdata('message','Member activation mail send');
			
		}
		redirect(ADMIN_DASHBOARD_PATH.'/providers/index/0', 'refresh');
	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */