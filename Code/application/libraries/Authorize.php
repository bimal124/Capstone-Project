<?php
require 'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class Authorize
{
	protected $ci;

	public $site_info = array();

	public function __construct()
	{
		$this->ci = & get_instance();
		$this->site_info = $this->get_site_settings_info();
		// define('LOGIN_IDs',$site_info['login_id']);
		// define('TRANSACTION_KEY',$site_info['transaction_key']);
		// define('TRANSACTION_ENV',$site_info['transaction_env']);
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

	function chargeCreditCard($card)
	{

	    /* Create a merchantAuthenticationType object with authentication details
	       retrieved from the constants file */
	    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	    $merchantAuthentication->setName($this->site_info['login_id']);
	    $merchantAuthentication->setTransactionKey($this->site_info['transaction_key']);
	    
	    // Set the transaction's refId
	    $refId = 'ref' . time();

	    // Create the payment data for a credit card
	    $creditCard = new AnetAPI\CreditCardType();
	    $creditCard->setCardNumber($card["card_number"]);
	    $creditCard->setExpirationDate($card["card_year"]."-".$card["card_month"]);
	    $creditCard->setCardCode($card["cvc"]);

	    // Add the payment data to a paymentType object
	    $paymentOne = new AnetAPI\PaymentType();
	    $paymentOne->setCreditCard($creditCard);

	    // Create order information
	    $order = new AnetAPI\OrderType();
	    $order->setInvoiceNumber($card["transaction_id"]);
	    $order->setDescription("Transaction Invoice id");

	    // Set the customer's Bill To address
	    $customerAddress = new AnetAPI\CustomerAddressType();
	    $customerAddress->setFirstName($card["billing_name"]);
	    $customerAddress->setLastName($card["billing_last_name"]);
	    // $customerAddress->setCompany("Souveniropolis");
	    $customerAddress->setAddress($card["billing_address"]);
	    $customerAddress->setCity($card["billing_city"]);
	    $customerAddress->setState($card["billing_state"]);
	    $customerAddress->setZip($card["billing_zip"]);
	    $customerAddress->setCountry("USA");

	    // Set the customer's identifying information
	    $customerData = new AnetAPI\CustomerDataType();
	    $customerData->setType("individual");
	    $customerData->setId($card["patient_id"]);
	    $customerData->setEmail($card["email"]);

	    // Add values for transaction settings
	    $duplicateWindowSetting = new AnetAPI\SettingType();
	    $duplicateWindowSetting->setSettingName("duplicateWindow");
	    $duplicateWindowSetting->setSettingValue("60");

	    // Add some merchant defined fields. These fields won't be stored with the transaction,
	    // but will be echoed back in the response.
	    $merchantDefinedField1 = new AnetAPI\UserFieldType();
	    $merchantDefinedField1->setName("patient_id");
	    $merchantDefinedField1->setValue($card["patient_id"]);

	    $merchantDefinedField2 = new AnetAPI\UserFieldType();
	    $merchantDefinedField2->setName("transaction_id");
	    $merchantDefinedField2->setValue($card["transaction_id"]);

	    // Create a TransactionRequestType object and add the previous objects to it
	    $transactionRequestType = new AnetAPI\TransactionRequestType();
	    $transactionRequestType->setTransactionType("authCaptureTransaction");
	    $transactionRequestType->setAmount($card["amount"]);
	    $transactionRequestType->setOrder($order);
	    $transactionRequestType->setPayment($paymentOne);
	    $transactionRequestType->setBillTo($customerAddress);
	    $transactionRequestType->setCustomer($customerData);
	    $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
	    $transactionRequestType->addToUserFields($merchantDefinedField1);
	    $transactionRequestType->addToUserFields($merchantDefinedField2);

	    // Assemble the complete transaction request
	    $request = new AnetAPI\CreateTransactionRequest();
	    $request->setMerchantAuthentication($merchantAuthentication);
	    $request->setRefId($refId);
	    $request->setTransactionRequest($transactionRequestType);

	    // Create the controller and get the response
	    $controller = new AnetController\CreateTransactionController($request);
	    if($this->site_info['transaction_env'] == 'PRODUCTION'){
		    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

	    }else{
		    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
	    }


	    return $response;
	}
}