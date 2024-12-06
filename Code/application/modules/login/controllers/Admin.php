<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		//load CI library
			$this->load->library('form_validation');		
		//load custom module
			$this->load->model('Admin_login');

	}


	


	public function index()


	{


		// die('test');


		// Check if User has logged in


		if ($this->general->admin_logged_in()){redirect(ADMIN_DASHBOARD_PATH, 'refresh');exit;}


		


		// $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');


		// $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');


		$this->form_validation->set_rules($this->Admin_login->validate_rules_login);


		//check the form validation


		if ($this->form_validation->run() == true) 


		{ 


			//if the login is successful


			if ($this->Admin_login->admin_login())


				{


					$remember_me = '';


					$remember_me = $this->input->post('rememberme',TRUE);


				


				if($remember_me=="yes"){





					$cookieControl = isset($_COOKIE['cookieControl'])?(boolean)$_COOKIE['cookieControl']:FALSE;


					$cookieControlPrefs = isset($_COOKIE['cookieControlPrefs'])?json_decode($_COOKIE['cookieControlPrefs']):array();


					//check cookies according to EU GDPR law


					if($cookieControl && in_array('preferences', $cookieControlPrefs)){


						setcookie('username', $this->input->post('username'), time()+3600*24*10);


						setcookie('password', $this->input->post('password'), time()+3600*24*10);


					}


					//echo "<pre>"; print_r($_COOKIE); echo "</pre>"; exit;


				}else{


					setcookie('username', '',0);


					setcookie('password', '',0);


				}


					redirect(ADMIN_DASHBOARD_PATH, 'refresh');exit;}


			else


				{


					$this->session->set_flashdata('message','Invalid Username/Password');


					redirect(ADMIN_LOGIN_PATH, 'refresh');exit;


				}


		}


			  


		$this->data = array();


		$cap = $this->general->get_captcha(125,32);		


		//print_r($cap);exit;


		$this->session->set_userdata('admin_captcha', $cap['word']);


        $this->data['admin_captcha'] = $cap['image'];


		$this->template


			->set_layout('admin_login')


			->enable_parser(FALSE)


			->title('Admin Login | '. SITE_NAME)


			->build('login', $this->data);	


		


	}


	


	


	public function logout()


	{


		if ($this->general->admin_logout())			


		{


			redirect(ADMIN_LOGIN_PATH, 'refresh');exit;


		}


	}





	public function reload(){





        if($this->input->is_ajax_request()){





           $cap = $this->general->get_captcha(125,32);		


			$this->session->set_userdata('admin_captcha', $cap['word']);


        	echo $cap['image'];





        }





        else{





            $cap = $this->general->get_captcha(125,32);		


			$this->session->set_userdata('admin_captcha', $cap['word']);


        	return $cap['image'];





        }





    }





    public function _captcha_code($code){





        if (strcasecmp($code,$this->session->userdata('admin_captcha')) == 0)


        {            


            return TRUE;


        }        


        else


        {


	    	$this->form_validation->set_message('_captcha_code', 'Verification Code doesnot match');            


            return FALSE;


        }


    }





        public function reset() {


        	// die('tesr');


        $code = urldecode($this->input->get('key'));


        $email = urldecode(base64_decode($this->input->get('auth')));


        // echo $code;


        // echo $email;exit;


        $user = $this->Admin_login->is_admin_ready_reset_password($email, $code);





        if ($user) {


            $current_time = $this->general->get_local_time('time');


            if (strtotime($user->forgot_password_code_expire) >= strtotime($current_time)) {


                $this->session->set_userdata('reset_password_admin_id', $user->id);


            } else {


                $this->session->set_userdata('forgot_message_error', 'Session has expired,Please request a new reset link');


                redirect(ADMIN_DASHBOARD_PATH . '/forgot', 'refresh');


                exit;


            }


        } else


            redirect(site_url(), 'refresh');





        if ($this->input->server('REQUEST_METHOD') === 'POST') {


            $this->form_validation->set_rules($this->Admin_login->validate_password_reset);





            if ($this->form_validation->run() == TRUE) {





                $trans_stat = $this->Admin_login->change_admin_password($user->id);


                $this->session->unset_userdata('reset_password_admin_id'); // remove session after password changed





                if ($trans_stat) {


                    $this->session->set_flashdata('message_success', 'Your password changed sccessfully.');


                    redirect(ADMIN_DASHBOARD_PATH, 'refresh');


                    exit;


                }


            }


        }


        $data = array();


        $data['activation_key'] = $this->input->get('key');


        $data['email'] = $this->input->get('auth');





        $this->template


               ->set_layout('admin_login')


			->enable_parser(FALSE)


			->title('Admin Login | '. SITE_NAME)


                ->build('reset', $data);


    }


	


}





/* End of file welcome.php */


/* Location: ./application/controllers/welcome.php */