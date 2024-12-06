<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Password extends CI_Controller {



	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/login

	 *	- or -  

	 * 		http://example.com/index.php/login/index

	 */

    function __construct()

    {

        parent::__construct();        

        $this->admin_logged = $this->general->admin_logged_in();

        if($this->admin_logged){

            redirect(ADMIN_DASHBOARD_PATH.'/dashboard'); 

        }

        $this->load->model('admin_login');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // $this->lang->load('investor');

    }

    public function index(){

        $this->forget();

    }

    public function forget(){

        $data = array();

        

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules($this->admin_login->validate_password_forget);

            if($this->form_validation->run()==TRUE){

                $trans_info = $this->admin_login->admin_send_reset_email($this->input->post('seller_email'));

                if($trans_info){

                    $this->session->set_flashdata('password_success', 'Mail sent Successfully');

                }else{

                    $this->session->set_flashdata('login_message', 'Invalid Username');

                }

                redirect(ADMIN_DASHBOARD_PATH.'/forgot');

            }

        }

        if($this->session->flashdata('password_success')){
// print_r($this->session->flashdata('password_success'));exit;
            $data['message'] = $this->session->flashdata('password_success');
             $cap = $this->general->get_captcha(125,32);        
             $data['admin_captcha'] = $cap['image'];
             $this->session->set_userdata('admin_captcha', $cap['word']);
            $this->template
			->set_layout('admin_login')
            ->enable_parser(FALSE)
            ->title('Admin Login | '. SITE_NAME)
			->build('forget-success', $data);

        }else{

// print_r($this->session->flashdata('login_message'));exit;
            $data['message'] = $this->session->flashdata('login_message');

            $cap = $this->general->get_captcha(125,32);        
             $data['admin_captcha'] = $cap['image'];
             $this->session->set_userdata('admin_captcha', $cap['word']);
            // print_r($data['admin_captcha']);
            $this->template

			->set_layout('admin_login')
            ->enable_parser(FALSE)
            ->title('Admin Login | '. SITE_NAME)
			->build('forget', $data);

        }

        

    }

    public function reset(){

        $data = null;

        $code = urldecode($this->input->get('key'));        

        $user = (base64_decode(urldecode($this->input->get('auth'))));

        $admin_info = $this->admin_login->is_admin_ready_reset_password($user,$code);

        if($admin_info):

            

            if ($this->input->server('REQUEST_METHOD') === 'POST'){

                

                $this->form_validation->set_rules($this->admin_login->validate_password_reset);

                if($this->form_validation->run()==TRUE){

                    $trans_stat = $this->admin_login->change_password($admin_info->admin_id);

                    if($trans_stat){

                        $this->session->set_flashdata('login_message', 'Password Changed Successfully');

                        redirect(ADMIN_DASHBOARD_PATH);

                    }else{

                        redirect(ADMIN_DASHBOARD_PATH.'/reset/?key='.$code.'&auth='.base64_encode($admin_info->username));

                    }

                }

            }

            $data['message'] = null;

            $data['activation_key'] = $code;

            $data['encoded_user'] = base64_encode($admin_info->username);

            $this->template

		->set_layout('admin_login')
            ->enable_parser(FALSE)
            ->title('Admin Login | '. SITE_NAME)

			->build('reset', $data);

            

        else:

            redirect(ADMIN_DASHBOARD_PATH.'/password/forget');

        endif;

    }



    public function reload(){

        if($this->input->is_ajax_request()){

            echo $this->general->get_captcha(125,32);

        }

        else{

            return $this->general->get_captcha(125,32);

        }

    }

    

    public function _captcha_code_forget($code){

        if (strcasecmp($code,$this->session->userdata('admin_captcha')) == 0)

        {            

            return TRUE;

        }        

        else

        {

	    $this->form_validation->set_message('_captcha_code_forget', 'Verificationssss Code doesnot match');            

            return FALSE;

        }

    }

	

}