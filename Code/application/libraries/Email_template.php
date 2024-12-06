<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_template {
	/**
	 * CodeIgniter global
	 *
	 * @var string
	 **/

         protected $ci;

	public function __construct() {
	
		$this->ci =& get_instance();
	}
	
        //to get email body and subject from the email template
        function get_email_template($mail_type)
        {                
                $query=$this->ci->db->get_where('email_settings',array('email_code'=>$mail_type),1);
				if ($query->num_rows() > 0){
					return $query->row();
				}
				else
					return false;
                
        }

        //to parse the the email which is available in the
        function parse_email($parseElement,$mail_body)
        {
            foreach($parseElement as $name=>$value)
                {
                        
                }
            
			$patterns_string = array();
			$replacement_string = array();
                foreach($parseElement as $name=>$value)
                {
                        $mail_body=str_replace("[$name]",$value,$mail_body);
                }
                return $mail_body;
        }
		
        function send_email($from,$to,$subject,$body, $attachments = array()){
                $this->ci->load->library('email');
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';
                //$config['protocol'] = 'sendmail';
                $this->ci->email->initialize($config); 
                // echo 'tester';
                // print_r($body);exit;
                $email_header = $this->get_email_header_general();
                $email_footer = $this->get_email_footer_general();
                if((is_array($from)) && (count($from)>0)){
                        $this->ci->email->from($from[0], $from[1]);
                }
                else{
                        $this->ci->email->from($from);
                }
                if((is_array($to)) && (count($to)>0)){
                        $this->ci->email->to($to);
                }
                else{
                        $this->ci->email->to($to);
                }
                
                //$message = $this->parse_email(array('email_header' => $email_header, 'email_footer' => $email_footer), $body);
                 $config['mailtype'] = 'html';
                $this->ci->email->subject($subject);
                $this->ci->email->message($email_header.$body.$email_footer); 
                if(count($attachments)>0){
                    foreach($attachments as $files){
                        $this->ci->email->attach($files->path, 'attachment', $files->name);
                    }
                }

                return $this->ci->email->send();
                
        }
        function send_email_bcc($from,$to=NULL,$cc=NULL,$bcc=NULL,$subject,$body){
                $this->ci->load->library('email');
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';
                //$config['protocol'] = 'sendmail';
                $this->ci->email->initialize($config); 
                $email_header = $this->get_email_header_general();
                $email_footer = $this->get_email_footer_general();
                
                if((is_array($from)) && (count($from)>0)){
                        $this->ci->email->from($from[0], $from[1]);
                }
                elseif($from){
                        $this->ci->email->from($from);
                } 
                
                if((is_array($to)) && (count($to)>0)){
                    $this->ci->email->to($to[0], $to[1]);
                }elseif($to != NULL){
                        $this->ci->email->to($to);
                }
                //Carbon Copy
                if($cc != NULL){
                        $this->ci->email->cc($cc);
                }
                //Black Carbon Copy
                if($bcc != NULL){
                        $this->ci->email->bcc($bcc);
                }
                $this->ci->email->subject($subject);
                $this->ci->email->message($email_header.$body.$email_footer); 
                return $this->ci->email->send();
                //echo $this->email->print_debugger();	
        }
        
        function get_email_header_general(){
            $query=$this->ci->db->get_where('email_settings',array('email_code'=>'email-header-general'),1);
            if($query->num_rows()>0){
                return $query->row()->email_body;
            }
            else{
                return '';
            }
        }
        function get_email_footer_general(){
            $query=$this->ci->db->get_where('email_settings',array('email_code'=>'email-footer-general'),1);
            if($query->num_rows()>0){
                return $query->row()->email_body;
            }
            else{
                return '';
            }
        }
		
}
?>