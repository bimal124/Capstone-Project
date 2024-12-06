<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notification
{
	protected $ci;
	
	private $tableEmailSettings = 'email_settings';
	
	function __construct($config = array()){
		$this->ci =& get_instance();
		
		$this->ci->load->library('email');
		
		if(MAILING_TYPE == 3){ //from general library
			
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = SMTP_HOST;
			$config['smtp_port'] = SMTP_PORT;
			$config['smtp_user'] = SMTP_USERNAME;
			$config['smtp_pass'] = SMTP_PASSWORD;
			
		}
		else if(MAILING_TYPE == 2) 
			$config['protocol'] = 'sendmail';
		else
			$config['protocol'] = 'mail';
		
		$config['smtp_crypto'] = 'ssl';
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n";
		$config['crlf'] = "\r\n";
				
		$this->ci->email->initialize($config);
			
	}
	
	public function send_email_notification($email_code,$data_array=array())
	{
		$data_template = $this->get_email_template($email_code);
		if($data_template)
		{
			                    
			@$this->send_email($data_template->email_body,$data_template->subject,$data_array,$data_template->email_code);			
			
		}
		return true;
	}
	
	public function get_email_template($email_code){
		
		$query = $this->ci->db->get_where($this->tableEmailSettings,array('email_code'=>$email_code));
		if( $query->num_rows() > 0 ){
			return $query->row();
		}else
		return false;
	}
	
	public function send_email($email_body,$subject,$data_array,$email_code = NULL)
	{
		$email_header = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!--[if !mso]><!-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--<![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title></title>
  <style type="text/css">
.ReadMsgBody { width: 100%; background-color: #ffffff; }
.ExternalClass { width: 100%; background-color: #ffffff; }
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
html { width: 100%; }
body { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }
table { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }
table table table { table-layout: auto; }
.yshortcuts a { border-bottom: none !important; }
img:hover { opacity: 0.9 !important; }
a { color: #FF632F; text-decoration: none; }
.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}
.btn-link a { color:#FFFFFF !important;}
.accept-request { color: #000 !important; padding: 10px; background-color: #D3D3D3;}

@media only screen and (max-width: 480px) {
body { width: auto !important; }
*[class="table-inner"] { width: 90% !important; text-align: center !important; }
*[class="table-full"] { width: 100% !important; text-align: center !important; }
/* image */
img[class="img1"] { width: 100% !important; height: auto !important; }
}
</style>
</head>

<body>
  <table bgcolor="#f2f2f2" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="50"></td>
    </tr>
    <tr>
      <td align="center" style="text-align:center;vertical-align:top;font-size:0;">
        <table align="center" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" width="600">';
              
              if($email_code != 'provider_notification'){
              	$email_header.='<table class="table-inner" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#628db7" style="border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;" align="center">
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="20"></td>
                      </tr>
                      <tr>
                        <td align="center" style="font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;">'.$subject.'</td>
                      </tr>
                      <tr>
                        <td height="20"></td>
                      </tr>
                    </table>';
                }
                $email_header.='</td>
                </tr>
              </table>
              ';

		$email_footer = '
              <table align="center" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="20"></td>
                </tr>               
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height="30"></td>
    </tr>
  </table>
</body>

</html>
';
	$img_src = ($email_code == 'provider_notification' || $email_code == 'patient_request_accepted')?'<div style="text-align: center;"></div>':'';

		$main_body = '<table class="table-inner" width="95%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td bgcolor="#FFFFFF" align="center" style="font-family: \'Open Sans\', Arial, sans-serif; color:#3b3b3b; font-size:14px; letter-spacing: 0.5px;"><table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>'.$img_src.$email_body.'</td>
                      </tr></table>
                  </td>
                </tr>
                <tr>
                  <td height="45" align="center" bgcolor="#f4f4f4" style="border-bottom-left-radius:6px;border-bottom-right-radius:6px;">
                    <table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="10"></td>
                      </tr>
                      <!--preference-->
                      <tr>
                        <td class="preference-link" align="center" style="font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:12px;font-style: italic;">
                          POWERED BY
                          <a href="'.site_url().'">'.SITE_NAME.'</a>
                        </td>
                      </tr>
                      <!--end preference-->
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>';

		$message = $email_header.$main_body.$email_footer;
  
		$parsed_message = $this->parse_message($data_array,$message);
		// echo MAILING_TYPE;exit;
		if(MAILING_TYPE == 1){
			// Define the email headers (important for HTML emails and sender identification)
			$headers = "MIME-Version: 1.0" . "\r\n"; // Set MIME version
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; // Set content type to HTML
			// $headers .= 'From: '.SYSTEM_EMAIL . "\r\n"; // Sender's email address
			$headers .= 'From: "DrSathi" <'.SYSTEM_EMAIL.'>' . "\r\n"; // "From" name and email address
			$headers .= 'Reply-To: '.CONTACT_EMAIL. "\r\n"; // Reply-to email address
			$headers .= 'X-Mailer: PHP/' . phpversion(); // Include PHP version in the mail headers

			$subject = $this->parse_message($data_array,$subject);
			// Send the email using PHP's mail() function
			if(mail($data_array['TO'], $subject, $parsed_message, $headers)) {
				return true;
			} else {
				return false;
			}
			
		}
		
		$this->ci->email->from(SYSTEM_EMAIL,SYSTEM_NAME);
		$this->ci->email->to($data_array['TO']);

		if(isset($data_array['CC']))
			$this->ci->email->cc($data_array['CC']);
		
		if(isset($data_array['BCC']))
			$this->ci->email->bcc($data_array['BCC']);
		$subject = $this->parse_message($data_array,$subject);			
		$this->ci->email->subject($subject);

		$this->ci->email->message($parsed_message);
		
		if(isset($data_array['ATTACHMENT'])){
			$this->ci->load->helper('path');
			$this->ci->load->helper('directory'); 
			//setting path to attach files 
			$path = set_realpath($data_array['ATTACHMENT_PATH']);
			$file_names = directory_map($path);
			$attachment =  explode(',',$data_array['ATTACHMENT']);
			foreach($data_array['ATTACHMENT'] as $file_name)
			{
			  $this->ci->email->attach($file_name);
			  // echo $file_name;
		
			}	
		}		
		
		$result = $this->ci->email->send();
		
		// var_dump($result);
		// echo '<br />';
		// echo $this->ci->email->print_debugger();
		// exit;
		if ($this->ci->email->send()){		
			return true;
		}
		else{
			return false;
		}
	}
	
	
	// to parse the the email which is available in the
	function parse_message($parseElement,$mail_body)
	{
		foreach($parseElement as $key=>$value)
		{
			$parserName=$key;
			$parseValue=$value;
			$mail_body=str_replace("[$parserName]",$parseValue,$mail_body);
		}

		return $mail_body;
	}
}

// END Template class