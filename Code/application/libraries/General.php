<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General {
	/**
	 * CodeIgniter global
	 *
	 * @var string
	 **/
	protected $ci;

	/**
	 * account status ('not_activated', etc ...)
	 *
	 * @var string
	 **/
	protected $status;

	/**
	 * error message (uses lang file)
	 *
	 * @var string
	 **/
	protected $errors = array();

	public $languages = array();

	public $languages_code = array();

	public $default_lang_info = array();


	public function __construct() {
		
		$this->ci = & get_instance();
		
			//define site settings info
		$site_info = $this->get_site_settings_info();
		
		if ( function_exists( 'date_default_timezone_set' ) ) { 	
			date_default_timezone_set('US/Eastern');		
			// date_default_timezone_set($site_info['timezone']); 
		}

		define('SITE_NAME',$site_info['site_name']);
		define('CONTACT_EMAIL',$site_info['contact_email']);
		define('CURRENCY_CODE',$site_info['currency_code']);
		define('CURRENCY_SIGN',$site_info['currency_sign']);
		
		define('SITE_STATUS',$site_info['site_status']);
		
		define('FACEBOOK_URL',$site_info['facebook_url']);
		define('FACEBOOK_APP_ID',$site_info['facebook_id']);
		define('TWITTER_URL',$site_info['twitter_url']);
		define('INSTAGRAM_URL',$site_info['instagram_url']);
		define('LINKEDIN_URL',$site_info['linkedin_url']);
		define('HTML_TRACKING_CODE',$site_info['html_tracking_code']);
				
		define('DEFAULT_HOUSE_VISIT_COST',1500);
		define('ADDITIONAL_HOUSE_VISIT_COST', 1250);
		define('TELEMEDICINE',1150);
		
		//System email settings
        define('MAILING_TYPE', $site_info['mailing_type']);
        define('SYSTEM_NAME', $site_info['system_email_name']);
        define('SYSTEM_EMAIL', $site_info['system_email']);
        define('SMTP_HOST', $site_info['smtp_host']);
        define('SMTP_PORT', $site_info['smtp_port']);
        define('SMTP_USERNAME', $site_info['smtp_username']);
        define('SMTP_PASSWORD', $site_info['smtp_password']);
		define('CLOSED_AUCTION_BIDDERS', $site_info['closed_auction_bidders']);
		
			
			$site_user_id = $this->ci->session->userdata(SESSION.'user_id');
			
		}

		
	//function to check admin logged in
    public function admin_logged_in() {
    	return $this->ci->session->userdata(ADMIN_LOGIN_ID);
    }
    
	//function to admin logout
    public function admin_logout(){
    	$this->ci->session->unset_userdata(ADMIN_LOGIN_ID);
    	return true;
    }
   
    
	//find user real ip address
    public function get_real_ipaddr()
    {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		$ip=$_SERVER['HTTP_CLIENT_IP'];
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$ip=$_SERVER['REMOTE_ADDR'];

		return $ip;
	}
	
	
	//Change & Get Time Zone based on settings
	function get_local_time($time="none"){
		
	if($time!='none')
		return date("Y-m-d H:i:s");
	else
		return date("Y-m-d");
}

	//date format only
function date_formate($date)
{
	$str_date=strtotime($date);
	$dt_frmt=date("m/d/Y",$str_date);
	
	return $dt_frmt;
}

	//date & time format only
function date_time_formate($str)
{
	$str_date=strtotime($str);
	$dt_frmt=date("m/d/Y h:i A",$str_date);
	
	return $dt_frmt;
}
	//date & time format only
function full_date_time_formate($str)
{
	return date("d M Y H:i:s", strtotime($str));
}

function get_local_time_clock()
{
		/*$gmt_info=$this->get_gmt_info();
		$gmt_time=explode(':',$gmt_info);		
		$hour_delay=$gmt_time[0];
		$minute_delay=$gmt_time[1];	
		
		$time=date("H:i:s",mktime(gmdate("H")+$hour_delay,gmdate("i")+$minute_delay,gmdate("s")));*/
		$time=date("H:i:s");
		
		$piece = explode(":",$time);
		return $piece[0]*60*60+$piece[1]*60+$piece[2];
	}


	public function get_site_settings_info(){
		
		$this->ci->db->from('site_settings SETT');
		$this->ci->db->select("SETT.*",false);
		$query = $this->ci->db->get();

		if ($query->num_rows() > 0) 
		{
			$data=$query->row_array();				
		}		
		$query->free_result();
		return $data;
	}
	
	
	
	function random_number() 
	{
		return mt_rand(100, 999) . mt_rand(100,999) . mt_rand(11, 99);
	} 
	
	function clean_url($str, $replace=array(), $delimiter='-') 
	{
		if( !empty($replace) ) {$str = str_replace((array)$replace, ' ', $str);}
		
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
		
		return $clean;
	}
	
	function check_block_ip($ip_address)
	{
		$this->ci->db->select('ip_address ');
		$query = $this->ci->db->get_where("block_ips",array("ip_address"=>$ip_address));
		return $query->num_rows();
	}
	
	public function formate_amount($val)
	{		
		$formate = CURRENCY_SIGN.' '.number_format($val,'2','.','');
		return $formate;
	}
	
	function check_float_vlaue($str) 
	{
		if (preg_match("/^[0-9]+(\.[0-9]{1,2})?$/",$str)) 
			{return true;} 
		else 
			{return false;}	
	}
	function check_int_vlaue($str) 
	{
		
		if (preg_match("/^[0-9]+$/",$str)) 
			{return true;} 
		else 
			{return false;}	

	}
	
	
	public function salt() 
	{
		return substr(md5(uniqid(rand(), true)), 0, '10');
	}
	
	public function hash_password($password, $salt) 
	{
		
		return  sha1($salt.sha1($salt.sha1($password)));
		
	}
	public function new_user_token() 
	{
		$salt = $this->salt();
		return  sha1($salt.sha1($salt.sha1(md5(uniqid()))));
		
	}
	
	function create_password($length=8,$use_upper=1,$use_lower=1,$use_number=1,$use_custom="")
	{
		$upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$lower = "abcdefghijklmnopqrstuvwxyz";
		$number = "0123456789";
		$seed_length = 0;
		$seed = '';
		$password = '';
		
		if($use_upper)
		{
			$seed_length += 26;
			$seed .= $upper;
		}
		if($use_lower)
		{
			$seed_length += 26;
			$seed .= $lower;
		}
		if($use_number)
		{
			$seed_length += 10;
			$seed .= $number;
		}
		if($use_custom)
		{
			$seed_length +=strlen($use_custom);
			$seed .= $use_custom;
		}
		
		for($x=1;$x<=$length;$x++)
		{
			$password .= $seed[rand(0,$seed_length-1)];
		}
		
		return $password;
	}
	
	public function check_banned_ip()
	{
		//get user ip and check with banned IP address lists.
		$user_ip = $this->get_real_ipaddr();
		
		if($this->check_block_ip($user_ip)!==0)
		{			
			redirect($this->lang_uri('/ipbanned'), 'refresh');exit;
		}
	}
	
	
	public function assign_key_to_array($array, $key_name) {
		$return_array = array();
		foreach ($array as $key => $value) {
			if (isset($value->$key_name)) {
				$return_array[$value->$key_name] = $value;
			} elseif (isset($value[$key_name])) {
				$return_array[$value[$key_name]] = $value;
			} else {
				exit('invalid key');
			}
		}
		return $return_array;
	}

	
	public function get_captcha($img_width, $img_height) {

        // load codeigniter captcha helper			
        $this->ci->load->helper('captcha');
        $this->ci->load->helper('string');
        $this->ci->load->library('antispam');

        //delete old captcha images
        $this->delete_old_captcha();


        $configs = array(
            'word' => strtolower(random_string('alnum', 8)),
            'img_path' => './' . CAPTCHA_PATH,
            'img_url' => base_url() . CAPTCHA_PATH,
            'img_width' => $img_width,
            'img_height' => $img_height,
            'char_set' => "ABCDEFGHJKLMNPQRSTUVWXYZ2345689",
            'char_color' => "#000000",
            'expiration' => 60
        );
       // print_r($configs);exit;
        $captcha = $this->ci->antispam->get_antispam_image($configs);
        return $captcha;
    }
    private function delete_old_captcha() {

        /** define the captcha directory * */
        $dir = './' . CAPTCHA_PATH;

        /*         * * cycle through all files in the directory ** */
        foreach (glob($dir . "*.jpg") as $file) {

            /*             * * if file is 24 hours (86400 seconds) old then delete it ** */
            if (filemtime($file) < time() - 60) {
                @unlink($file);
            }
        }
    }
    
	
	// Get list of all timezonees
	public function timezone_list($name, $default='') {
		static $timezones = null;

		if ($timezones === null) {
			$timezones = [];
			$offsets = [];
			$now = new DateTime();

			foreach (DateTimeZone::listIdentifiers() as $timezone) {
				$now->setTimezone(new DateTimeZone($timezone));
				$offsets[] = $offset = $now->getOffset();
				
				$hours = intval($offset / 3600);
				$minutes = abs(intval($offset % 3600 / 60));
				$gmt_ofset = 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');

				$timezone_name = str_replace('/', ', ', $timezone);
				$timezone_name = str_replace('_', ' ', $timezone_name);
				$timezone_name = str_replace('St ', 'St. ', $timezone_name);

				$timezones[$timezone] = $timezone_name.' (' . $gmt_ofset . ')';
				
			}

			array_multisort($offsets, $timezones);
		}

		$formdropdown = form_dropdown($name, $timezones, trim($default),'class="form-control"');
		
		return $formdropdown;
	}
	public function get_days($date)
	{
		$today = time(); // or your date as well
		$end_date = strtotime($date);
		$datediff = $end_date - $today;

		$result = round($datediff / (60 * 60 * 24));
		if($result >0)
		 return 'Open After '.$result.' Days';
		 else return 'Open Today '.date('H:i',strtotime($date));
	}
	public function get_seo($pages_id) {
        $this->ci->db->select('page_title, meta_key, meta_description');
        $this->ci->db->from('seo');
        $this->ci->db->where('seo_pages_id', $pages_id);
        $this->ci->db->limit(1);
        $query = $this->ci->db->get();
        // echo $this->ci->db->last_query(); exit;
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return false;
    }
	
	
	
	function get_online_members() {
        $query = $this->ci->db->get_where('members', array("mem_login_state" => '1'));
        return $query->num_rows();
    }
	public function updateOnlineMemberByTime() {

        $options = array('mem_login_state' => '1');
        $this->ci->db->select('id,mem_login_state,last_login_date');
        $query = $this->ci->db->get_where('members', $options);

        if ($query->num_rows() > 0) {
            $record = $query->result();
            //print_r($record);exit;

            foreach ($record as $result) {
                $time_now = strtotime($this->get_local_time('time'));
                $login_time = strtotime($result->last_login_date);
                $time_diff = $time_now - $login_time;
                $time_diff = ($time_diff / 60);

                if ($time_diff > 3) {
								
                    $this->ci->db->update('members', array('mem_login_state' => '0'), array('id' => $result->id));
                }
            }
        }
    }

    public function updateOnlineMembers() {
				
        $time_now = $this->get_local_time('time');

        $data = array(
            'mem_login_state' => '1',
            'last_login_date' => $time_now
        );
        //print_r($data);
        $this->ci->db->where('id', $this->ci->session->userdata(SESSION . 'user_id'));
        $this->ci->db->update('members', $data);
    }
	
	public function member_status($status = ''){
		$data = array('0'=>'Inactive', '1'=>'Active', '2'=>'Suspended', '3'=>'Closed', '4'=>'Deleted');
		if($status || $status == '0')
			return $data[$status];
		else
			return $data;
	}
	public function provider_visit_status($status){
		$v_status = array("0" => '<div class="label label-danger">Pending</div>', "1" => '<div class="label label-warning">In progress</div>', "2" => '<div class="label label-success">Completed</div>', "3" => '<div class="label label-secondary">Abandoned</div>');
		return $v_status[$status];
		
	}
	
	public function calculate_age($urdate){
		$date = new DateTime($urdate);
	    $now = new DateTime();
	    $interval = $now->diff($date);
	    return $interval->y;
	}
	 public function get_country()
    {
                 $this->ci->db->order_by('country','asc');
        $query = $this->ci->db->get_where('country',array('is_display' => 1));

        if ($query->num_rows() > 0) {
            $result = $query->result();
            $query->free_result();
            return $result;
        }
        return false;
    }
	
	public function covid_test_type(){
		return array('1'=>array('id'=>1,'name'=>'PCR Nasal Swab Test', 'price' => '300','additional'=>'125'), '2'=>array('id'=>2,'name'=>'Rapid Antigen Test', 'price' => '350','additional'=>'150'), '3'=>array('id'=>3,'name'=>'Serum Antibodies Test', 'price' => '350','additional'=>'125'));
	}
	
	public function house_call_visit(){
		return array('1'=>array('id'=>1,'name'=>'Kathmandu (60-90 minutes)', 'price' => '1500','additional'=>ADDITIONAL_HOUSE_VISIT_COST), '2'=>array('id'=>2,'name'=>'Outside of Kathmandu (90 minutes)', 'price' => '2350','additional'=>ADDITIONAL_HOUSE_VISIT_COST));
	}

	public function get_past_history($patient_id,$user_id)
	{
		$this->ci->db->select('p.*,pr.report_details');
        $this->ci->db->from('patient p');
        $this->ci->db->join('patient_reports pr', 'p.id = pr.patient_id', 'left');
        $this->ci->db->join('members m', 'p.user_id = m.id', 'left');
        $this->ci->db->where('m.id', $user_id);
        $this->ci->db->where('p.id <', $patient_id);
        $this->ci->db->where('m.member_type', '1');
        $query = $this->ci->db->get();
        // echo $this->ci->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
	}

	function lang_uri($path)
	{	
		if(isset($this->languages_code[$this->ci->uri->segment(1)])){
			return site_url($this->ci->uri->segment(1).$path);
		}	

		// return site_url(DEFAULT_LANG_CODE.$path);
		return site_url($path);
	}
	
}