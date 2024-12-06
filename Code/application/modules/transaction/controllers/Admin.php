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

			$this->load->model('admin_transaction');

		//Changing the Error Delimiters

		$this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

	}

	

	public function index()
	{

		//set pagination configuration			

		$config['base_url'] = site_url(ADMIN_DASHBOARD_PATH).'/transaction/index/';

		$config['total_rows'] = $this->admin_transaction->get_total_transaction();

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

		



		$this->data['result_data'] = $this->admin_transaction->get_transaction_details($config['per_page'],$offset);

		$this->data['patient_list'] = $this->admin_transaction->get_members_bytype(1);
		$this->data['provider_list'] = $this->admin_transaction->get_members_bytype(2);
		$this->data['company_list'] = $this->admin_transaction->get_members_bytype(3);

		$this->data['active_menu'] = '';
        $this->data['active_submenu'] = 'transaction';

        $this->data['modules_name'] = 'Transaction Management';

        $this->data['modules_heading'] = 'View Transaction Detail';

        $this->breadcrumb->populate(

        	array(

        		'ADMIN' => ADMIN_DASHBOARD_PATH,

        		
				'Transaction Management' => '#'

        	)

        );

		$this->template

			->set_layout('dashboard')

			->enable_parser(FALSE)

			->title('Transaction View | '. SITE_NAME)

			->build('view', $this->data);	

	}

	public function export()
	{
		$result = $this->admin_transaction->export();
		$filename = 'transaction'.date('Y-m-d').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Transfer-Encoding: UTF-8");
		header("Content-Type: application/csv; ");
		$file = fopen('php://output', 'w');
		$header = array(
			"No.","Service Provided","Patient Name","Amount","Reference Number","Payment Mode","Date","Status"
		); 
		fputcsv($file, $header);
		if(!empty($result)){
			foreach ($result as $key => $value) {
				$transaction = array(
					'key' => $key + 1,
					'Service Provided' => $value->transaction_name,
					'Patient' => $value->name.' '.$value->last_name,
					'Amount' => $this->general->formate_amount($value->amount),
					'Reference' => $value->reference_number,
					'Payment' => $value->payment_method,
					'date' => $this->general->date_time_formate($value->transaction_date),
					'status' => $value->transaction_status
				);
				fputcsv($file, $transaction);	
			}
		}
		fclose($file); 
		exit; 
	}

	

	

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */