<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $image_name = '';
	
	function __construct() {
		parent::__construct();
		
		// Check if User has logged in
		if (!$this->general->admin_logged_in())			
		{
			redirect(ADMIN_LOGIN_PATH, 'refresh');exit;
		}
		
		$this->load->model('admin_dashboard');	
		$this->load->library('upload');
	}
	
	public function index()
	{
		$this->data['total_active_patient'] = $this->admin_dashboard->total_active_patient();
		$this->data['total_patient'] = $this->admin_dashboard->total_active_patient();		
		$this->data['total_providers'] = $this->admin_dashboard->total_members(2);
		$this->data['total_companies'] = $this->admin_dashboard->total_members(3);
		$this->data['patients_lists'] = $this->admin_dashboard->get_patients_details(5);
		
		$this->data['active_menu'] = 'dashboard';
        $this->data['active_submenu'] = '';
		$this->template
			->set_layout('dashboard')
			->enable_parser(FALSE)
			->title('Dashboard | '.SITE_NAME)
			->build('dashboard_body', $this->data);	
		
	}
	public function profile()
	{
		 $this->load->library('form_validation');
		 $this->data['profile_data'] = $this->admin_dashboard->get_data_byid();
		 //Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
		$this->form_validation->set_rules($this->admin_dashboard->validate_administrator);
		if ($this->form_validation->run() == TRUE) {
			//update site setting
			$this->admin_dashboard->update_data($this->data['profile_data']->id,$this->image_name);
			$this->session->set_flashdata('message','The admin profile update successful.');
			redirect(ADMIN_DASHBOARD_PATH.'/profile','refresh');
			exit;
		}
		
		$this->data['profile_data'] = $this->admin_dashboard->get_data_byid();
		
		$this->load->library('breadcrumb');
		$this->data['active_menu'] = 'dashboard';
        $this->data['active_submenu'] = '';
		$this->data['modules_name'] = 'Admin Profile';
		
		$this->breadcrumb->populate(
        	array(
        		'ADMIN' => ADMIN_DASHBOARD_PATH,
        		'Administration Profile' => '#'
        	)
        );
		
		$this->template
			->set_layout('dashboard')
			->enable_parser(FALSE)
			->title('Dashboard | '.SITE_NAME)
			->build('profile', $this->data);
	}
	public function get_members_data()
	{

		$total_active_members=$this->admin_dashboard->get_total_members('active');
		$total_inactive_members=$this->admin_dashboard->get_total_members('inactive');
		$total_closed_members=$this->admin_dashboard->get_total_members('closed');
		$total_suspended_members=$this->admin_dashboard->get_total_members('suspended');
		$total_members=$total_active_members+$total_inactive_members+$total_closed_members+$total_suspended_members;
			$chart_array=array(
							// 'Total members'=>$total_members,
							'Total Completed'=>$total_active_members,
							'Total Inprogress'=>$total_inactive_members,
							'Total Abandoned'=>$total_closed_members,
							'Total Cancel'=>$total_suspended_members
							);
		echo json_encode($chart_array);
	}
	
	public function image_validation() {

        if ($_FILES['image']['name'] == '') {
            return true;
        }
        $result = $this->admin_dashboard->validate_upload_file('image');

        if ($result['status'] == 'success') {
            $this->image_name = $result['file_name'];
            return true;
        } else {
			$this->image_name = '';
            $this->form_validation->set_message('image_validation', $result['message']);
            return false;
        }
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */