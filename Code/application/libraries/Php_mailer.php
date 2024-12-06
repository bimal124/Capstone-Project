<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Php_mailer {
    protected $ci;
    public function __construct() {
        
        $this->ci = & get_instance();
    }
    function send($to,$subject,$message) {
         
        ob_start();
        require_once APPPATH . 'third_party/PHPMailer-5.2/PHPMailerAutoload.php';
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = trim(SYSTEM_EMAIL);                 // SMTP username
            $mail->Password = trim(SMTP_PASSWORD);                           // SMTP password
            $mail->SMTPSecure = SMTP_CRYPTO;                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = SMTP_PORT; 
            // TCP port to connect to
           
            //Recipients
            $mail->addAddress($to);     // Add a recipient            
            $mail->addReplyTo(CONTACT_EMAIL, 'Information');
            
            $mail->setFrom(CONTACT_EMAIL, SITE_NAME);        
            
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            $mail->send();
            $result = true;
            
        } catch (Exception $e) {
            
//            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
//            exit;
            $result = false;
        }
        ob_clean();
        return $result;
    }

}
