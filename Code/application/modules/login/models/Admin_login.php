<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_login extends CI_Model 
{

	public function __construct() 
	{
		parent::__construct();
		
	}

	public $validate_rules_login = array(
            array('field' => 'username', 'label' => 'Username', 'rules' => 'required|min_length[2]|max_length[12]'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'required|min_length[5]|max_length[12]'),
			array('field' => 'admin_captcha', 'label' => 'Verification code', 'rules' => 'required|callback__captcha_code')
        );

	public $validate_password_forget = array(
            array('field' => 'admin_username_email', 'label' => 'Username', 'rules' => 'required|min_length[6]|max_length[100]'),
            array('field' => 'admin_captcha', 'label' => 'Verification Code', 'rules' => 'required|callback__captcha_code_forget')
        );

    public $validate_password_reset = array(
        array('field' => 'admin_password', 'label' => 'new password', 'rules' => 'required|min_length[6]|max_length[20]'),
        array('field' => 'admin_confirm', 'label' => 'confirm password', 'rules' => 'required|matches[admin_password]')
    );
	
	public function admin_login()
	{		
		$login = $this->check_admin_login();
		if($login == 'success'){
			
			return true;
		}
		else {
			return false;
		}
		
	}
	
	/* admin login */
	private function check_admin_login() 
	{
			$uname = $this->input->post('username');
			
			$pass = md5($this->input->post('password'));
			
			
			$query = $this->db->select('*')
					  ->from('admin_users')					  
					  ->where('user_name',$uname)
					  ->where('password',$pass)					 
					  ->limit(1)
					  ->get();
			
			if($query->num_rows() == 1) 
			{
					$result = $query->row();
					
					if($result->user_name===$this->input->post('username') && $result->password===md5($this->input->post('password')))
					{
							//update admin last login date & time	
							$this->update_last_login($result->id);
							//store admin valuse is session
							$this->session->set_userdata(ADMIN_LOGIN_ID,$result->id);
                            $this->session->set_userdata('ADMIN_PROFILE_IMG',$result->image); 
							$this->session->set_userdata('ADMIN_USERNAME',$result->user_name); 
							return 'success';
					}
					else 
					{
						return 'failed';
					}
			}
			else
			{
				return 'failed';
			}
			
	}
	
	// update admin last login
	public function update_last_login($id)
	{
		$ip_addr = $this->general->get_real_ipaddr();
	    $this->db->update('admin_users', array('last_login' => date('Y-m-d H:i:s'),'ip_addr' =>$ip_addr ), array('id' => $id));
	    return $this->db->affected_rows() == 1;
	}

	 public function admin_send_reset_email(){

        $email_templates = $this->get_email_tpl('forgot_password_notification_admin');
        // print_r($email_templates);exit;

        $admin_info = $this->get_admin_by_username($this->input->post('admin_username_email'));

        if($email_templates && $admin_info){

            $activation_key = $this->generate_password_activation_code($admin_info->id,$admin_info->email);

            $encoded_user = base64_encode($admin_info->email);

            $this->load->library('email_template');

            /*

            $this->load->library('email');

            $this->email->from(SYSTEM_EMAIL, SYSTEM_ADMIN);

            $this->email->subject($email_template->subject);

            $this->email->to($admin_info->email,$admin_info->nickname);

            $patterns_string = array('/{}/','/{}/','/{}/');

            $replacement_string = array(,,);



            $compiled_email = preg_replace($patterns_string, $replacement_string, $email_template->email_body);

            $this->email->message($compiled_email);    



            $ok = $this->email->send();

            */

            $email_vars = array(

                'FIRSTNAME' => $admin_info->user_name,

                'EMAIL' => $admin_info->email,

                'RESET_LINK' => site_url(ADMIN_DASHBOARD_PATH.'/reset').'/?key='.urlencode($activation_key).'&auth='.urlencode($encoded_user)

            );

            $subject = $this->email_template->parse_email($email_vars,$email_templates->subject);

            $body = $this->email_template->parse_email($email_vars,$email_templates->email_body);
            // print_r($body);exit;
            $ok = $this->email_template->send_email(array(SYSTEM_EMAIL),array($admin_info->email),$subject,$body);                                    

            

            

            

            

            if($ok){

                return true;

            }

            else{

                return false;

            }

        }

        else{

            return FALSE;

        }

    }

    public function get_email_tpl($email_code){

        $query = $this->db->get_where('email_settings',array('email_code' => $email_code),1);

        if ($query->num_rows() > 0){

            return $query->row();

        }

        else

            return false;

    }

     public function get_admin_by_username($username){

       $this->db->where('email',$username);
       $this->db->or_where('user_name',$username);
       $query=$this->db->get('admin_users');

        if($query->num_rows()>0){

            return $query->row();

        }

        else{

            return FALSE;

        }

    }

      public function generate_password_activation_code($id, $email) {
        $this->load->helper('string');
        $current_date = $this->general->get_local_time('time');

        $data = array(
            'forgot_password_code' => random_string('unique'),
            'forgot_password_code_expire' => date('Y-m-d H:i:s', strtotime("+24 hours", strtotime($current_date)))
        );

        $res = $this->db->update('admin_users', $data, array('id' => $id, 'email' => $email));
        if ($res)
            return $data['forgot_password_code'];
        else
            false;
    }

     public function is_admin_ready_reset_password($email, $code) {

        $this->db->select('id,forgot_password_code_expire');
        $query = $this->db->get_where('admin_users', array('forgot_password_code' => $code, 'email' => $email));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

     public function change_admin_password($user_id) {

        // $secure_code = ADMIN_LOGIN_SECURE_CODE;
        $password_tmp = $this->input->post('admin_password');
        // Create a random salt
        // $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        // Create salted password (Careful not to over season)
        // $password = hash('sha512', $password_tmp . $secure_code . $random_salt);
        $password=md5($this->input->post('admin_password',true));
        $data = array(
            'password' => $password,
            // 'salt' => $random_salt,
            'forgot_password_code' => '',
            'forgot_password_code_expire' => '',
        );

        $this->db->update('admin_users', $data, array('id' => $user_id));
        return $this->db->affected_rows();
    }


}
