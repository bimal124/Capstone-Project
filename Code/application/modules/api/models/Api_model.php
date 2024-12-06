<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

	public $validate_patient = array(
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'required')

        );

	public $validate_register = array(
            array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
            array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|is_unique[members.email]'),

        );

	public $validate_patient_booking = array(
            array('field' => 'name', 'label' => 'First Name', 'rules' => 'required'),
            array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
            array('field' => 'phone', 'label' => 'phone', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
            array('field' => 'cemail', 'label' => 'Confirm email', 'rules' => 'required|matches[email]'),
            array('field' => 'symptoms', 'label' => 'Symptoms', 'rules' => 'required'),
            array('field' => 'month', 'label' => 'Month', 'rules' => 'required'),
            array('field' => 'day', 'label' => 'Day', 'rules' => 'required'),
            array('field' => 'year', 'label' => 'year', 'rules' => 'required'),
            array('field' => 'covid_test', 'label' => 'Covid Test', 'rules' => 'required'),
            array('field' => 'address', 'label' => 'Address', 'rules' => 'required'),
            array('field' => 'city', 'label' => 'City', 'rules' => 'required'),
            array('field' => 'state', 'label' => 'State', 'rules' => 'required'),
            array('field' => 'zip', 'label' => 'Zip', 'rules' => 'required'),
            // array('field' => 'card_number', 'label' => 'Card Number', 'rules' => 'required'),
            // array('field' => 'card_month', 'label' => 'Card Expiry Month', 'rules' => 'required'),
            // array('field' => 'card_year', 'label' => 'Card Expiry Year', 'rules' => 'required'),
            // array('field' => 'cvc', 'label' => 'CVC', 'rules' => 'required'),
            array('field' => 'billing_name', 'label' => 'Billing Name', 'rules' => 'required'),
            array('field' => 'billing_last_name', 'label' => 'Last Name', 'rules' => 'required'),
            array('field' => 'billing_address', 'label' => 'Billing Address', 'rules' => 'required'),
            array('field' => 'billing_city', 'label' => 'Billing City', 'rules' => 'required'),
            array('field' => 'billing_state', 'label' => 'Billing State', 'rules' => 'required'),
            array('field' => 'billing_zip', 'label' => 'Billing Zip', 'rules' => 'required'),
        );

	public $validate_schedule_booking = array(
            array('field' => 'name', 'label' => 'First Name', 'rules' => 'required'),
            array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
            // array('field' => 'phone', 'label' => 'phone', 'rules' => 'required'),
            // array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
            // array('field' => 'address', 'label' => 'Address', 'rules' => 'required'),
            // array('field' => 'city', 'label' => 'City', 'rules' => 'required'),
            // array('field' => 'state', 'label' => 'State', 'rules' => 'required'),
            // array('field' => 'zip', 'label' => 'Zip', 'rules' => 'required'),
            
        );

	public function check_login()
	{
		$options = array('email'=>$this->input->post('email',TRUE));
        $query = $this->db->get_where('members',$options);

		if($query->num_rows()>0)
		{
			$record = $query->row();
			//checl active user
			if($record->status==='1')
			{
			if($record->email===$this->input->post('email') && $record->password === $this->general->hash_password($this->input->post('password',TRUE),$record->salt))
				{
					$this->session->set_userdata(array(SESSION.'user_id' => $record->id));
					$this->session->set_userdata(array(SESSION.'first_name' => $record->first_name));
					$this->session->set_userdata(array(SESSION.'email' => $record->email));
					$this->session->set_userdata(array(SESSION.'last_name' => $record->last_name));
					$this->session->set_userdata(array(SESSION.'member_type' => $record->member_type));
					return 'success';
				}else{
					return 'invalid';
				}
			}else if($record->status == '2')
			 {
			 	return 'suspended';
			 }
			 else if($record->status==='3')
			 {
			 	return 'closed';
			 }
			 else if($record->status==='4')
			 {
			 	return 'deleted';
			 }else if($record->status == '0')
			 {
			 	return 'inactive';
			 }
		}else{
			return "unregistered";
		}
	}

	public function check_social_login()
	{
		$email = $this->input->post('email',TRUE);
		$options = array('email'=>$email);
        $query = $this->db->get_where('members',$options);

		if($query->num_rows()>0)
		{
			$record = $query->row();
			//checl active user
			if($record->status==='1' || $record->status == '0')
			{
				$this->db->where('email', $email);
			 	$this->db->update('members', array('status' => '1'));
				$this->session->set_userdata(array(SESSION.'user_id' => $record->id));
				$this->session->set_userdata(array(SESSION.'first_name' => $record->first_name));
				$this->session->set_userdata(array(SESSION.'email' => $record->email));
				$this->session->set_userdata(array(SESSION.'last_name' => $record->last_name));
				$this->session->set_userdata(array(SESSION.'member_type' => $record->member_type));
				return 'success';
			}else if($record->status == '2')
			{
			 	return 'suspended';
			 }
			 else if($record->status==='3')
			 {
			 	return 'closed';
			 }else if($record->status == '0')
			 {
			 	
			 	return 'success';
			 }
		}else{
			return "unregistered";
		}
	}

	public function check_valid_member($email)
	{
        $query = $this->db->get_where('members',array('email' => $email ));
        if($query->num_rows()>0)
		{
			return TRUE;
		}
		return FALSE;
	}

	public function forget_password_reminder_email()
	{
		$options = array('email'=>$this->input->post('email',TRUE));
        $query = $this->db->get_where('members',$options);
		$row = $query->row();
		
		$forgot_password_code=random_string('unique');
		$key = urlencode($forgot_password_code);
		$encoded_email = urlencode(base64_encode($row->email));
		$reset_link = "<a href='".site_url('/reset_password').'/?key='.$key.'&auth='.$encoded_email."'>".site_url('/reset_password').'/?key='.$key.'&auth='.$encoded_email."</a>";
		$this->db->where('id', $row->id);
		$this->db->update('members', array('forgot_password_code' => $forgot_password_code));
		//load notification library
        	$this->load->library('notification');	

			  $parseElement=array("TO"=>$this->input->post('email', TRUE),
			  					   "PATIENTNAME"=>$row->first_name,
								  "SITENAME"=>SITE_NAME,
								  "CONFIRM"=>$reset_link,
								  "EMAIL"=>$this->input->post('email')
							);
										
			return $this->notification->send_email_notification('forgot_password_notification', $parseElement);
	}

	public function email_register()
	{
		$salt = $this->general->salt();		
		$password = $this->general->hash_password($this->input->post('password',TRUE),$salt);
		$user_ip = $this->general->get_real_ipaddr();
		$email = $this->input->post('email');
		$activation_code = $this->general->random_number();
		$data = array(
			'member_type' => $this->input->post('member_type'),
			'email' => $email,
			'salt' => $salt,
			'password' => $password,
			'first_name' => '',
			'last_name' => '',
			'status' => '0',
			'last_ip_address' => $user_ip,
			'reg_ip_address' => $user_ip,
			'reg_date' => $this->general->get_local_time('time'),
			'referral' => 0,
			'activation_code' => $activation_code
		);
		$this->db->insert('members', $data);
		$user_id = $this->db->insert_id();

		$this->load->library('notification');	
		$confirm="<a href='".base_url('home/activation/'.$activation_code.'/'.$user_id)."'>".base_url('home/activation/'.$activation_code.'/'.$user_id)."</a>";

		  $parseElement=array(
		  		"SITENAME"=>SITE_NAME,
				"TO"=>$email,
				"EMAIL"=>$email,
				"FIRSTNAME"=>'User',
				"PASSWORD"=>$this->input->post('password'),
				"CONFIRM" => $confirm
			);
								
		$this->notification->send_email_notification('register_notification', $parseElement);
		return $user_id;
	}

	public function social_register()
	{
		$salt = $this->general->salt();
		$rand_password = $this->general->create_password(8);
		$password = $this->general->hash_password($rand_password,$salt);

		$user_ip = $this->general->get_real_ipaddr();
		$email = $this->input->post('email');
		$data = array(
			'member_type' => $this->input->post('member_type'),
			'email' => $email,
			'salt' => $salt,
			'password' => $password,
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'status' => '1',
			'last_ip_address' => $user_ip,
			'reg_ip_address' => $user_ip,
			'reg_date' => $this->general->get_local_time('time'),
			'referral' => 0,
			'activation_code' => ''
		);
		$this->db->insert('members', $data);
		$user_id = $this->db->insert_id();

		$this->load->library('notification');	

		  $parseElement=array(
		  		"SITENAME"=>SITE_NAME,
				"TO"=>$email,
				"EMAIL"=>$email,
				"FIRSTNAME"=> $this->input->post('first_name'),
				"PASSWORD"=>$rand_password
			);
								
		$this->notification->send_email_notification('social_registration', $parseElement);
		$this->session->set_userdata(array(SESSION.'user_id' => $user_id));
		$this->session->set_userdata(array(SESSION.'first_name' => $this->input->post('first_name')));
		$this->session->set_userdata(array(SESSION.'email' => $email));
		$this->session->set_userdata(array(SESSION.'last_name' => $this->input->post('last_name')));
		$this->session->set_userdata(array(SESSION.'member_type' => $this->input->post('member_type')));
		return $user_id;
	}

	public function book_appointment()
	{
		$this->response = array(
			'status' => 'error',
			'message' => ''
		);
		// $this->db->trans_start();
		$user_id = $this->input->post('user_id');
		$name = $this->input->post('name');
		$last_name = $this->input->post('last_name');
		$phone = $this->input->post('phone');
		$gender = $this->input->post('gender');
		$email = $this->input->post('email');
		$symptoms = $this->input->post('symptoms');
		$address = $this->input->post('address');
		$month = $this->input->post('month');
		$day = $this->input->post('day');
		$year = $this->input->post('year');
		$dob_ts = strtotime("$year-$month-$day");
		$dob = date("Y-m-d",$dob_ts);
		$total_amount = $this->input->post('total_amount', TRUE);
		$covid_test = $this->input->post('covid_test');
		$covid_test_type = $this->input->post('covid_test_type', TRUE);
		$appointment_type = $this->input->post('appointment_type', TRUE);

		$reference_num = $this->general->random_number();
		$data = array(
			'user_id' => $user_id,
			'name' => $name,
			'last_name' => $last_name,
			'phone' => $phone,
			'gender' => $gender,
			'email' => $email,
			'dob' => $dob,
			'symptoms' => $symptoms,
			'covid_test' => $covid_test,
			'covid_test_type' => $covid_test_type,
			'covid_no_test' => $this->input->post('covid_no_test', TRUE),
			'covid_test_price' => $this->input->post('covid_test_price', TRUE),
			'appointment_type' => $appointment_type,
			'house_call_visit' => $this->input->post('house_call_visit', TRUE),
			'house_call_additional_member' => $this->input->post('house_call_additional_member', TRUE),
			'total_amount' => $total_amount,
			'address' => $this->input->post('address', TRUE),
			'address2' => $this->input->post('address2', TRUE),
			'city' => $this->input->post('city', TRUE),
			'state' => $this->input->post('state', TRUE),
			'zip' => $this->input->post('zip', TRUE),
			'how_find_us' => $this->input->post('how_find_us', TRUE),
			'created_at' => $this->general->get_local_time('time'),
			'post_date' => $this->general->get_local_time('time'),
			'payment_status' => 0,
			'reference_num' => $reference_num
		);
		$this->db->insert('patient',$data);
		$patient_id = $this->db->insert_id();
		$covid_test_name = $this->general->covid_test_type();
		$transaction_name = ($appointment_type == '1')?'House Call':'Telemedicine';
		$transaction_name.= ($covid_test == '1')?' - '.$covid_test_name[$covid_test_type]["name"]:'';
		if($patient_id){
			$trx = array(
				"user_id" => $patient_id,
				"amount" => $total_amount,
				"transaction_name" => $transaction_name,
				"transaction_date" => $this->general->get_local_time('time'),
				"transaction_status" => "Incomplete",
				"payment_method" => "Credit",
				"reference_number" => $reference_num
			);
			$this->db->insert('transaction',$trx);
			$transaction_id = $this->db->insert_id();
		}
		

		// $this->db->trans_complete();
		// if ($this->db->trans_status() === TRUE)
		// {
		// 	$card_details = array(
		// 			"amount" => $total_amount,
		// 			"card_number" => str_replace(' ', '', $this->input->post('card_number')),
		// 			"card_month" => $this->input->post('card_month'),
		// 			"card_year" => $this->input->post('card_year'),
		// 			"cvc" => $this->input->post('cvc'),
		// 			"billing_name" => $this->input->post('billing_name'),
		// 			"billing_last_name" => $this->input->post('billing_last_name'),
		// 			"billing_address" => $this->input->post('billing_address'),
		// 			"billing_city" => $this->input->post('billing_city'),
		// 			"billing_state" => $this->input->post('billing_state'),
		// 			"billing_zip" => $this->input->post('billing_zip'),
		// 			"patient_id" => $patient_id,
		// 			"transaction_id" => $transaction_id,
		// 			"email"=> $email
		// 		);
		// 	$this->load->library('authorize');
		// 	$authorizeNetPayment = new Authorize();
		// 	$response = $authorizeNetPayment->chargeCreditCard($card_details);
		// 	if ($response != null) {
		//         // Check to see if the API request was successfully received and acted upon
		//         if ($response->getMessages()->getResultCode() == "Ok") {
		//             // Since the API request was successful, look for a transaction response
		//             // and parse it to display the results of authorizing the card
		//             $tresponse = $response->getTransactionResponse();
		//         	// echo $tresponse->getResponseCode();
		//             if ($tresponse != null && $tresponse->getMessages() != null) {
		//             	//payment success
		//             	if($tresponse->getResponseCode() == 1 || $tresponse->getResponseCode() == 4){
		//             		$this->db->where('id',$tresponse->getUserFields()[0]->getValue());
		// 	            	$this->db->update('patient', array(
		// 	            		'payment_status' => '1'
		// 	               	));

		// 	               	$this->db->where('invoice_id',$tresponse->getUserFields()[1]->getValue());
		// 	            	$this->db->update('transaction', array(
		// 	            		'transaction_status' => 'Completed',
		// 	            		'payment_method' => $tresponse->getAccountType()
		// 	               	));

		// 	               	$this->load->library('notification');
		// 					$parseElement=array(
		// 									"USERNAME" => $name,
		// 									"PATIENTNAME"=> $name.' '. $last_name,
		// 									'PHONE' => $phone,
		// 									'EMAIL' => $email,
		// 									'SYMPTOMS' => $symptoms,
		// 									'ADDRESS' => $address,
		// 									"SITENAME"=>SITE_NAME,
		// 									"TO"=> CONTACT_EMAIL
		// 					);	
		// 					// $this->notification->send_email_notification('appointment_submitted_admin', $parseElement);
		// 					// $parseElement["TO"] = $email;
		// 					// $this->notification->send_email_notification('appointment_submitted', $parseElement);

		// 	               	$this->response["status"] = "success";
		// 	            	$this->response["message"] = "Appointment submitted successfully.";
		//             	}else{
		//             		$this->response["status"] = "error";
		// 	            	$this->response["message"] = $tresponse->getMessages()[0]->getDescription();
		//             	}
		            	

		//                 // echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
		//                 // echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
		//                 // echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
		//                 // echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
		//                 // echo " Account Type: " . $tresponse->getAccountType() . "\n";
		//                 // echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
		//                 // echo $tresponse->getUserFields()[0]->getValue();
		//             } else {
		//             	$this->response["status"] = "error";
		//                 // echo "Transaction Failed \n";
		//                 if ($tresponse->getMessages() != null) {
		//                     // echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
		//                     // echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
		//             		$this->response["message"] = $tresponse->getMessages()[0]->getDescription();
		//                 }else{
		//                 	$this->response['message'] = "This Transaction has been declined.";
		//                 }
		//             }
		//             // Or, print errors if the API request wasn't successful
		//         } else {
		//         	$this->response["status"] = "error";
		//             // echo "Transaction Failed \n";
		//             $tresponse = $response->getTransactionResponse();
		        
		//             if ($tresponse != null && $tresponse->getErrors() != null) {
		//             	$this->response["message"] = $tresponse->getErrors()[0]->getErrorText();

		//                 // echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
		//                 // echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
		//             } else {
		//             	$this->response["message"] = $response->getMessages()->getMessage()[0]->getText();
		//              //    echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
		//              //    echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
		//             }
		//             // $this->response['message'] = "Credit card not valid.";
		//         }
		//     } else {
		//     	$this->response["status"] = "error";
		//     	$this->response["message"] = "No reponse found.";
		//         // echo  "No response returned \n";
		//     }
		// }
			// The below code added because of cash on delivery and card option is disable
			$this->load->library('notification');
			$parseElement=array(
							"USERNAME" => $name,
							"PATIENTNAME"=> $name.' '. $last_name,
							'PHONE' => $phone,
							'EMAIL' => $email,
							'SYMPTOMS' => $symptoms,
							'ADDRESS' => $address,
							"SITENAME"=>SITE_NAME,
							"TO"=> CONTACT_EMAIL
			);	
			
			$parseElement["TO"] = $email;
			$this->notification->send_email_notification('appointment_submitted', $parseElement);

			$this->response["status"] = "success";
			$this->response["message"] = "Appointment submitted successfully.";
			// End cash on delivery

		return $this->response;

		
	}

	public function schedule_appointment()
	{
		$user_id = $this->input->post('user_id');
		$company_name = $this->input->post('company_name', TRUE);
		$name = $this->input->post('name');
		$last_name = $this->input->post('last_name');
		$phone = $this->input->post('phone');
		$gender = $this->input->post('gender');
		$email = ($this->input->post('email') !='')?$this->input->post('email'):$this->input->post('company_email');
		$symptoms = $this->input->post('symptoms');
		$address = $this->input->post('address');
		$hotel_state = $this->input->post('hotel_state');
		$hotel_city = $this->input->post('hotel_city');
		$hotel_zip = $this->input->post('hotel_zip');

		$month = $this->input->post('month');
		$day = $this->input->post('day');
		$year = $this->input->post('year');
		$dob_ts = strtotime("$year-$month-$day");
		$dob = date("Y-m-d",$dob_ts);
		$data = array(
			'user_id' => $user_id,
			'company_name' => $this->input->post('company_name', TRUE),
			'name' => $name,
			'last_name' => $last_name,
			'phone' => $phone,
			'gender' => $gender,
			'symptoms' => $symptoms,
			'email' => $email,
			'dob' => $dob,
			'address' => $address,
			'hotel_state' => $hotel_state,
			'hotel_city' => $hotel_city,
			'hotel_zip' => $hotel_zip,
			// 'address2' => $this->input->post('address2', TRUE),
			'city' => $this->input->post('city', TRUE),
			'state' => $this->input->post('state', TRUE),
			'zip' => $this->input->post('zip', TRUE),
			'created_at' => $this->general->get_local_time('time'),
			'post_date' => $this->general->get_local_time('time'),
			'payment_status' => 1,
			'reference_num' => $this->input->post('reference_num', TRUE),
			'need_flight' => $this->input->post('need_flight',TRUE)
		);
		$this->db->insert('patient',$data);
		$this->load->library('notification');
		$parseElement=array(
						"USERNAME"=> $company_name,
						"PATIENTNAME"=> $name.' '. $last_name,
						'PHONE' => $phone,
						'EMAIL' => $email,
						'SYMPTOMS' => $symptoms,
						'ADDRESS' => $address,
						"SITENAME"=>SITE_NAME,
						"TO"=> CONTACT_EMAIL
		);	
		$this->notification->send_email_notification('appointment_submitted_admin', $parseElement);
		$parseElement=array(
						"PATIENTNAME"=> $name.' '. $last_name,
						'EMAIL' => $email,
						'SYMPTOMS' => $symptoms,
						'ADDRESS' => $address,
						"SITENAME"=>SITE_NAME,
						"TO"=> $email
		);	
		$this->notification->send_email_notification('appointment_submitted', $parseElement);
		return TRUE;
	}

}

/* End of file Api_model.php */
/* Location: ./application/modules/api/models/Api_model.php */