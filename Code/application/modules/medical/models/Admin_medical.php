<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_medical extends CI_Model 
{

	public function __construct() 
	{
		parent::__construct();
				
			
	}
	
	public $validate_settings_provider =  array(	
			array('field' => 'provider', 'label' => 'provider', 'rules' => 'trim|required'),
			array('field' => 'patient_id', 'label' => 'patient', 'rules' => 'trim|required'),			
		);

	public $validate_receipt =  array(	
			array('field' => 'patient_id', 'label' => 'Patient id', 'rules' => 'trim|required'),
			array('field' => 'physician', 'label' => 'Physician', 'rules' => 'trim|required'),
			array('field' => 'tax_id', 'label' => 'Tax ID', 'rules' => 'trim|required'),
			array('field' => 'patient_name', 'label' => 'Patient Name', 'rules' => 'trim|required'),
			array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
			array('field' => 'appointment_type', 'label' => 'Medical Service', 'rules' => 'trim|required'),
			array('field' => 'diagnosis', 'label' => 'diagnosis', 'rules' => 'trim|required'),
			array('field' => 'amount', 'label' => 'amount', 'rules' => 'trim|required'),

		);
	
	public $validate_settings_edit =  array(	
			array('field' => 'name', 'label' => 'First Name', 'rules' => 'trim|required'),
			array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required'),
			array('field' => 'dob', 'label' => 'dob', 'rules' => 'trim'),
			array('field' => 'phone', 'label' => 'contact phone', 'rules' => 'required'),
			array('field' => 'address', 'label' => 'Address1', 'rules' => 'trim|required'),
			array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required'),
		);
	
	
	
	public function get_total_patients($assign_dr)
	{	
		if($this->input->post('srch')!="")
		{
			$where = "(name LIKE '%".$this->input->post('srch')."%' OR phone LIKE '%".$this->input->post('srch')."%' OR email LIKE '%".$this->input->post('srch')."%')";
			$this->db->where($where);
		}

		if($this->input->post('assign_dr')!="")
		{
			$this->db->where('assign_dr', $this->input->post('assign_dr'));

		}else{
			if($assign_dr)
			$this->db->where('assign_dr !=','0');
			else
			$this->db->where('assign_dr','0');
		}
		
		$this->db->where('is_delete !=', '1');
		
		$this->db->where('payment_status','1');
		
		$query = $this->db->get('patient');

		return $query->num_rows();
	}
	
	public function get_patients_details($assign_dr,$perpage,$offset)
	{		
		$this->db->from('patient');
		
		if($this->input->post('assign_dr')!="")
		{
			$this->db->where('assign_dr', $this->input->post('assign_dr'));

		}else{
			if($assign_dr)
			$this->db->where('assign_dr !=','0');
			else
			$this->db->where('assign_dr','0');
		}
		
		
		// $this->db->where('payment_status','1');
		$this->db->where('visit_status !=', '3');
		if($this->input->post('srch')!="")
		{
			$where = "(concat(name,' ',last_name) LIKE '%".$this->input->post('srch')."%' OR phone LIKE '%".$this->input->post('srch')."%' OR email LIKE '%".$this->input->post('srch')."%')";
			$this->db->where($where);
		}
		$this->db->where('is_delete !=', '1');
		
		$this->db->order_by("id", "desc");
		$this->db->limit($perpage, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}
	
	
	public function get_all_provider(){
		$this->db->select('id, title, first_name, last_name');
		$this->db->from('members');		
		$this->db->where('status','1');		
		$this->db->where('member_type','2');		
		$this->db->order_by("first_name", "asc");
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}
	
	public function add_provider(){
		$data = array(
			'assign_dr' => $this->input->post('provider'),
			'visit_status' => '0'
		);
		$this->db->update('patient', $data, array('id' => $this->input->post('patient_id')));
		return $this->db->affected_rows();
	}

	public function getPatientDetails($id){
		$this->db->select('p.*, m.first_name as referal_firstname, m.last_name as referal_lastname');
		$this->db->from('patient p');
		$this->db->join('members m', 'p.user_id = m.id', 'left');
		$this->db->where('p.id',$id);
		
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
		   return $query->row();

		} 

		return false;
	}

	public function getPatientReport($id){

		$this->db->from('patient_reports');		
		$this->db->where('patient_id',$id);		
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}

		return false;
	}
	public function getPatientReportAttachment($id){
		
		$this->db->from('patient_report_attachment');				
		$this->db->where('patient_id',$id);		
		$this->db->order_by("id", "asc");
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;	
	}
	public function getPatientReportByid($id){
		
		$this->db->from('patient_report_attachment');				
		$this->db->where('id',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0)
		{
		   return $query->row();
		} 

		return false;	
	}
	
	public function get_member_byid($id)
	{			
				 $this->db->select('m.email, m.first_name, m.last_name');
				 $this->db->from('members m');				 
		$query = $this->db->get_where('members',array('m.id'=>$id));

		if ($query->num_rows() > 0)
		{
		   return $query->row();
		} 

		return false;
	}
	
	public function provider_notification()
    {		
		

		$provider_id = $this->input->post('provider');		
		//get provider details
		$provider_detials = $this->get_member_byid($provider_id);
		
		$patient_id = $this->input->post('patient_id');
		//get patient details
		$patient_details = $this->getPatientDetails($patient_id);
		
		$email = $provider_detials->email;
		$provider_name = $provider_detials->first_name.' '.$provider_detials->last_name;
		//load notification library
        $this->load->library('notification');
        $accept = "<a href='".base_url('home/patient/accept/'.base64_encode($patient_id))."' class='accept-request'>Accept</a>";
		$reject = "<a href='".base_url('home/patient/reject/'.base64_encode($patient_id))."' class='accept-request'>Decline</a>";

		if($patient_details->user_id > 0){ //for company
			$parseElement=array(						
						"SITENAME"=>SITE_NAME,
						"TO"=>$email,
						"EMAIL"=>$email,
						"PATIENTNAME"=>$patient_details->name.' '.$patient_details->last_name,
						"ADDRESS" => $patient_details->city,	
						"CITY" => $patient_details->hotel_city,	
						"STATE" => $patient_details->hotel_state,	
						"ZIP" => $patient_details->hotel_zip,	
						"PHONE" => $patient_details->phone,	
						"AGE" => $this->general->calculate_age($patient_details->dob),	
						"GENDER" => $patient_details->gender,	
						"SYMPTOMS" => $patient_details->symptoms,	
						"HOTEL_NAME" => $patient_details->address,
						"ACCEPT" => $accept,
						"REJECT" => $reject 
			);		
			
			return $this->notification->send_email_notification('provider_notification_company', $parseElement);
		}else{
			$parseElement=array(						
						"SITENAME"=>SITE_NAME,
						"TO"=>$email,
						"EMAIL"=>$email,
						"FIRSTNAME"=>$provider_detials->first_name,
						"FULLNAME"=>$provider_name,
						"PATIENTNAME"=>$patient_details->name.' '.$patient_details->last_name,
						"ADDRESS" => $patient_details->address,	
						"CITY" => $patient_details->city,	
						"STATE" => $patient_details->state,	
						"ZIP" => $patient_details->zip,	
						"PHONE" => $patient_details->phone,	
						"AGE" => $this->general->calculate_age($patient_details->dob),	
						"GENDER" => $patient_details->gender,	
						"SYMPTOMS" => $patient_details->symptoms,	
						"ADDRESS" => $patient_details->address,
						"ACCEPT" => $accept,
						"REJECT" => $reject 
			);		
			
			return $this->notification->send_email_notification('provider_notification', $parseElement);
		}
		
    }
	
	public function update_patient_report() {
        $data = array(
            	'hpi'=>'This is a 35 year old female complaning of fever, chills, muscle aches, cough, congestion, runny nose, headaches and fatigue for 10 days',
            	'past_medical_history'=>'N/A',
            	'past_surgical_history'=>'N/A',
            	'medications'=>'N/A',
            	'allergies'=>'Not known',
            	'social_history'=>'denies cigarette smoking, alcohol consumption or drug abuse',
            	'family_history'=>'N/A',
            	'general'=>'patient or child appears comfortable NAD',
            	'vs'=>'N/A',
            	'bp'=>'120/80',
            	'hr'=>'78',
            	't'=>'97',
            	'pr'=>'02',
            	'sats'=>'N/A',
            	'head'=>'NCAT no Frontal or Maxillary sinus tenderness',
            	'eyes'=>'PERRLA: EOM; no conjunctival erythema or dema. No orbital tenderness',
            	'ears'=>'no Tragus tenderness, No erythems or edema of EACs bilaterally. TMs intact bilaterally; no buldging or drainage',
            	'pharynx'=>'non injected; no Tonsilar erythems, edema, or exudate bilaterally, buccal mucosa is moist; no lesions',
            	'nose'=>'Nares paent; no erythema or edema. No para-nasal tenderness',
            	'neck'=>'supple; no lymphadenopathy',
            	'heart'=>'s1 se regular, no murmurs',
            	'breast'=>'N/A',
            	'lungs'=>'clear bilaterally, no wheezing, rales, or rhonchi',
            	'abdomen'=>'soft, non-tender, non-distended. No rebound or guarding. No McBurneys tenderness. Negative Murphy sing. Negative Obturator sign. Bowel sound normal. No organomegaly. No CVA tenderness',
            	'ext'=>'no erythema or edema',
            	'back'=>'tenderness to + SLR',            	
            	'neuro'=>'alert and oriented x 3, CN 2-12 grossly intact, No sensory or motor deficit',
            	'skin'=>'N/A',
            	'genetalia'=>'N/A',
            	'dx'=>'N/A',
            	'plan'=>'N/A',
            	'rx'=>'Increase PO fluids <br> Rest <br> Contact information provided and advised to call if symtptoms presist or worsen Rest <br> Follow up with patient by phone within 24h'
        	);
        
            //$this->db->where('id', '1');
            //$this->db->update('patient_reports', array('report_details' => serialize($data)));
			
			$this->db->insert('patient_reports', array('patient_id'=>'2','report_details' => serialize($data)));
    }

    /**
    * Get all rejected patients
    */
    public function get_rejected_patients($count = true, $limit = NULL, $offset = NULL)
	{
		$this->db->select('p.*,m.first_name as doctor_name,m.last_name as doctor_last_name');
		$this->db->from('patient p');
		$this->db->join('members m', 'p.assign_dr = m.id', 'left');
		$this->db->where('p.visit_status', '3');
		$this->db->where('p.payment_status', '1');
		if($limit)
			$this->db->limit($limit, $offset);
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get();

		if($count == true)
			return $query->num_rows();
		
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		} 

		return false;
	}

	public function get_patient_info($patient_id)
	{
		$this->db->select('p.*,pr.report_details');
		$this->db->from('patient p');
		$this->db->join('patient_reports pr', 'p.id = pr.patient_id', 'left');
		$this->db->where('p.id', $patient_id);
		$this->db->where('p.visit_status !=', '3');
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		return false;
	}

	public function get_transaction_byuser($id)
	{
		$this->db->select('t.*');
		$this->db->from('transaction t');
		$this->db->where('t.user_id', $id);
		$this->db->where('t.transaction_status', 'Completed');
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		return false;
	}

	public function download_pdf($patient_id,$download = FALSE)
	{
		$patient_info = $this->getPatientDetails($patient_id);
		$upload_path = './upload_files/attachments/'.$patient_id;
		if(!file_exists($upload_path)){
			mkdir($upload_path);
		}
		$past_history = $this->general->get_past_history($patient_id,$patient_info->user_id);

		$covid_test_type = $this->general->covid_test_type();
		$house_call_visit = $this->general->house_call_visit();
		$report = $this->getPatientReport($patient_id);
		$report_details = !empty($report)?json_decode($report->report_details):'';
		$age = ($report_details && $report_details->age)?$report_details->age:'';
		$gender = ($report_details && $report_details->gender)?$report_details->gender:'';
		$symptoms = ($report_details && $report_details->symptoms)?$report_details->symptoms:'';
		$denies = ($report_details && isset($report_details->denies))?$report_details->denies:'';
		$past_medical_history = ($report_details && $report_details->past_medical_history)?$report_details->past_medical_history:'';
		$past_surgical_history = ($report_details && $report_details->past_surgical_history)?$report_details->past_surgical_history:'';
		$medications = ($report_details && $report_details->medications)?$report_details->medications:'';
		$allergies = ($report_details && $report_details->allergies)?$report_details->allergies:'';
		$social_history = ($report_details && $report_details->social_history)?$report_details->social_history:'--';
		$family_history = ($report_details && $report_details->family_history)?$report_details->family_history:'--';
		// $vs = ($report_details && $report_details->vs)?$report_details->vs:'';
		$bh = ($report_details && $report_details->bh)?$report_details->bh:'';
		$hr = ($report_details && $report_details->hr)?$report_details->hr:'';
		$t = ($report_details && $report_details->t)?$report_details->t:'';
		$rr = ($report_details && $report_details->rr)?$report_details->rr:'';
		$sats = ($report_details && $report_details->sats)?$report_details->sats:'';
		$head = ($report_details && $report_details->head)?$report_details->head:'';
		$skin = ($report_details && isset($report_details->skin))?$report_details->skin:'';
		$eyes = ($report_details && $report_details->eyes)?$report_details->eyes:'';
		$ears = ($report_details && $report_details->ears)?$report_details->ears:'';
		$nose = ($report_details && isset($report_details->nose))?$report_details->nose:'';
		$pharynx = ($report_details && $report_details->pharynx)?$report_details->pharynx:'';
		$neck = ($report_details && $report_details->neck)?$report_details->neck:'';
		$heart = ($report_details && $report_details->heart)?$report_details->heart:'';
		$lungs = ($report_details && $report_details->lungs)?$report_details->lungs:'';
		$abdomen = ($report_details && $report_details->abdomen)?$report_details->abdomen:'';
		$back = ($report_details && $report_details->back)?$report_details->back:'';
		$neuro = ($report_details && $report_details->neuro)?$report_details->neuro:'';
		$diagnosis = ($report_details && $report_details->diagnosis)?$report_details->diagnosis:'';
		$plan = ($report_details && $report_details->plan)?$report_details->plan:'';
		$rx = ($report_details && $report_details->rx)?$report_details->rx:'';
		$extremities = ($report_details && isset($report_details->extremities))?$report_details->extremities:'';
		$breast = ($report_details && isset($report_details->breast))?$report_details->breast:'';
		$genitalia = ($report_details && isset($report_details->genitalia))?$report_details->genitalia:'';
		$this->load->library('fpdf');
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->Image(site_url(MAIN_IMG_DIR_FULL_PATH.'drlogo.png'), 10, 10,60);
		// $pdf->SetFont('Arial','B',16);
		// $pdf->Cell(80);
		// $pdf->Cell(30,10,'Patient Report');
		$pdf->Ln(19);
		$pdf->SetFont('Arial');
		$pdf->SetFontSize(12);
		$pdf->Cell(50,10, ($patient_info->post_date)?date('F d, Y',strtotime($patient_info->post_date)):'--');
		$pdf->Ln(8);
		$pdf->Cell(50,10, $patient_info->name.' '.$patient_info->last_name );
		$pdf->Ln(5);
		$add = $patient_info->address;
		// $pdf->Cell(50,10, $patient_info->address);
		// $pdf->Ln(5);
		if($patient_info->address2 != ''){
			// $pdf->Cell(50,10, $patient_info->address2);
			$add.=' '.$patient_info->address2;
			// $pdf->Ln(5);
		}
		// $add.=', '.$patient_info->city;
		// $pdf->Cell(50,10, $patient_info->city);
		// $pdf->Ln(5);
		// $pdf->Cell(50,10, $patient_info->state);
		// $pdf->Ln(5);
		// $pdf->Cell(50,10, $patient_info->zip);
		$pdf->Cell(50,10, $add);
		$pdf->Ln(5);
		$pdf->Cell(50,10, $patient_info->city.', '.$patient_info->state.' '.$patient_info->zip);
		$pdf->Ln(5);
		$pdf->Cell(50,10, $patient_info->phone);
		$pdf->Ln(10);

		$pdf->Cell(45,10, 'Date of Birth: '.date('j.n.y',strtotime($patient_info->dob)));
		// $pdf->Cell(10,10, date('j.n.Y',strtotime($patient_info->dob)));
		$pdf->Ln(10);
		$pdf->SetFontSize(12);
		$pdf->Cell(10,10,'HPI:');
		$arr_str = explode(" ", $symptoms);
		$first_part = implode(" ", array_splice($arr_str, 0,6));
		$pdf->Cell(1,10,'This is a '.$age.' years old '.$gender.' complaining of '.$first_part);
		$pdf->Ln(6);
		while ( !empty($arr_str)) {
			$second_part = implode(" ", array_splice($arr_str, 0,12));
			// $pdf->Cell(20); //increase space in line
			$pdf->Cell(10,10, $second_part);
			$pdf->Ln(6);
		}
		$pdf->Ln(8);
		if($denies != ''){
			$arr_str = explode(" ", $denies);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Denies: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		$pdf->Ln(8);
		$temp_medical_history = '';
		if(!empty($past_history)){
			$count = 0;
    		foreach ($past_history as $value) {
    			$report_details = json_decode($value->report_details);

    			$past_medical_history1 = ($report_details && $report_details->past_medical_history)?$report_details->past_medical_history:'None';
    			if($past_medical_history1 != 'None' && $past_medical_history1 != 'none'){
    				$temp_medical_history.=$past_medical_history1." ";
    				$count++;
    			}
    			
    		}
    		if($count == 0){
				$temp_medical_history = $past_medical_history;	
			}elseif($past_medical_history != 'None' && $past_medical_history != 'none'){
				$temp_medical_history.= $past_medical_history;	
			}
    	}else{
    		$temp_medical_history = $past_medical_history;		
    	}
		$arr_str = explode(" ", $temp_medical_history);	
		$first_part = implode(" ", array_splice($arr_str, 0,10));	
		$pdf->Cell(45,10,'Past Medical History: '.$first_part);
		// $pdf->Cell(10,10, $first_part);
		$pdf->Ln(6);
		while ( !empty($arr_str)) {
			$second_part = implode(" ", array_splice($arr_str, 0,10));
			// $pdf->Cell(45);
			$pdf->Cell(5,10, $second_part);
			$pdf->Ln(6);
		}
		$temp_surgical_history = '';
		if(!empty($past_history)){
			$count = 0;
    		foreach ($past_history as $value) {
    			$report_details = json_decode($value->report_details);

    			$past_medical_history1 = ($report_details && $report_details->past_surgical_history)?$report_details->past_surgical_history:'None';
    			if($past_medical_history1 != 'None' && $past_medical_history1 != 'none'){
    				$temp_surgical_history.=$past_medical_history1." ";
    				$count++;
    			}
    			
    		}
    		if($count == 0){
				$temp_surgical_history = $past_surgical_history;	
			}elseif($past_surgical_history != 'None' && $past_surgical_history != 'none'){
				$temp_surgical_history.= $past_surgical_history;	
			}
    	}else{
    		$temp_surgical_history = $past_surgical_history;		
    	}
		$arr_str = explode(" ", $temp_surgical_history);	
		$first_part = implode(" ", array_splice($arr_str, 0,10));	
		$pdf->Cell(45,10,'Past Surgical History: '.$first_part);
		// $pdf->Cell(10,10, $first_part);
		$pdf->Ln(6);
		while ( !empty($arr_str)) {
			$second_part = implode(" ", array_splice($arr_str, 0,10));
			// $pdf->Cell(45);
			$pdf->Cell(5,10, $second_part);
			$pdf->Ln(6);
		}
		$arr_str = explode(" ", $medications);	
		$first_part = implode(" ", array_splice($arr_str, 0,10));	
		$pdf->Cell(45,10,'Medications: '.$first_part);
		// $pdf->Cell(10,10, $first_part);
		$pdf->Ln(6);
		while ( !empty($arr_str)) {
			$second_part = implode(" ", array_splice($arr_str, 0,10));
			// $pdf->Cell(45);
			$pdf->Cell(5,10, $second_part);
			$pdf->Ln(6);
		}
		$arr_str = explode(" ", $allergies);	
		$first_part = implode(" ", array_splice($arr_str, 0,10));	
		$pdf->Cell(45,10,'Allergies: '.$first_part);
		// $pdf->Cell(10,10, $first_part);
		$pdf->Ln(6);
		while ( !empty($arr_str)) {
			$second_part = implode(" ", array_splice($arr_str, 0,10));
			// $pdf->Cell(45);
			$pdf->Cell(5,10, $second_part);
			$pdf->Ln(6);
		}
		$arr_str = explode(" ", $social_history);	
		$first_part = implode(" ", array_splice($arr_str, 0,10));	
		$pdf->Cell(45,10,'Social History: '.$first_part);
		// $pdf->Cell(10,10, $first_part);
		$pdf->Ln(6);
		while ( !empty($arr_str)) {
			$second_part = implode(" ", array_splice($arr_str, 0,10));
			// $pdf->Cell(45);
			$pdf->Cell(5,10, $second_part);
			$pdf->Ln(6);
		}
		$arr_str = explode(" ", $family_history);	
		$first_part = implode(" ", array_splice($arr_str, 0,10));	
		$pdf->Cell(45,10,'Family History: '.$first_part);
		// $pdf->Cell(10,10, $first_part);
		$pdf->Ln(6);
		while ( !empty($arr_str)) {
			$second_part = implode(" ", array_splice($arr_str, 0,10));
			// $pdf->Cell(45);
			$pdf->Cell(5,10, $second_part);
			$pdf->Ln(6);
		}
		$pdf->Ln(8);
		$pdf->Cell(45,10,'Physical Exam');
		$pdf->Ln(8);
		$pdf->Cell(10,10,'VS: ');
		// if($vs != ''){
		// 	$pdf->Cell(10,10,'VS:');
		// 	$pdf->Cell(10,10, $vs);	
		// }
		if($bh != ''){
			$pdf->Cell(10,10,'BP:');
			$pdf->Cell(25,10, $bh);
		}
		// $pdf->Ln(6);
		if($t != ''){
			$pdf->Cell(5,10,'T:');
			$pdf->Cell(25,10, $t);
		}
		// $pdf->Ln(6);
		if($hr != ''){
			$pdf->Cell(10,10,'HR:');
			$pdf->Cell(35,10, $hr);
		}
		// $pdf->Ln(6);
		if($rr != ''){
			$pdf->Cell(10,10,'RR: '.$rr);
			$pdf->Cell(25,10, $rr);
		}
		$pdf->Ln(6);
		if($sats != ''){
			$pdf->Cell(25,10,'O2 Sats: '.$sats);
			// $pdf->Cell(15,10, $sats);
		}
		$pdf->Ln(10);
		if($head != ''){
			$arr_str = explode(" ", $head);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Head: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		if($skin != ''){
			$arr_str = explode(" ", $skin);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Skin: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		if($eyes != ''){
			$arr_str = explode(" ", $eyes);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Eyes: '. $first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		if($ears != ''){
			$arr_str = explode(" ", $ears);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Ears: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		if($nose != ''){
			$arr_str = explode(" ", $nose);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Nose: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		if($pharynx != ''){
			$arr_str = explode(" ", $pharynx);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Pharynx: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
			
		}
		if($neck != ''){
			$arr_str = explode(" ", $neck);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Neck: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		if($heart != ''){
			$arr_str = explode(" ", $heart);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Heart: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
			
		}
		if($lungs != ''){
			$arr_str = explode(" ", $lungs);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Lungs: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
			
		}
		if($abdomen){
			$arr_str = explode(" ", $abdomen);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Abdomen: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}			
		}
		if($back != ''){
			$arr_str = explode(" ", $back);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Back: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
			
		}
		if($neuro != ''){
			$arr_str = explode(" ", $neuro);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Neuro: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		if($extremities != ''){
			$arr_str = explode(" ", $extremities);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Extremities: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		if($breast != ''){
			$arr_str = explode(" ", $breast);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Breast:'.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		if($genitalia != ''){
			$arr_str = explode(" ", $genitalia);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'Genitalia: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		if($diagnosis != ''){
			$pdf->Ln(6);
			$arr_str = explode("\n", $diagnosis);	
			// $first_part = implode(" ", array_splice($arr_str, 0,10));	
			for ($i=0; $i < count($arr_str) ; $i++) { 
				if($i == 0){
					$pdf->Cell(25,10,'Diagnosis: '.$arr_str[$i]);
				}else{
					$pdf->Cell(5,10, $arr_str[$i]);
				}
					$pdf->Ln(6);
				
			}
			
			// while ( !empty($arr_str)) {
			// 	$second_part = implode(" ", array_splice($arr_str, 0,10));
			// 	$pdf->Cell(5,10, $second_part);
			// 	$pdf->Ln(6);
			// }
		}
		// if($diagnosis != ''){
		// 	$pdf->Ln(6);
		// 	$arr_str = explode(" ", $diagnosis);	
		// 	$first_part = implode(" ", array_splice($arr_str, 0,10));	
		// 	$pdf->Cell(25,10,'Diagnosis: '.$first_part);
		// 	// $pdf->Cell(10,10, $first_part);
		// 	$pdf->Ln(6);
		// 	while ( !empty($arr_str)) {
		// 		$second_part = implode(" ", array_splice($arr_str, 0,10));
		// 		$pdf->Cell(25);
		// 		$pdf->Cell(5,10, $second_part);
		// 		$pdf->Ln(6);
		// 	}
		// }
		if($plan != ''){
			$pdf->Ln(6);
			$arr_str = explode("\n", $plan);	
			for ($i=0; $i < count($arr_str) ; $i++) { 
				if($i == 0){
					$pdf->Cell(25,10,'Plan: '.$arr_str[$i]);
				}else{
					$pdf->Cell(5,10, $arr_str[$i]);
				}
					$pdf->Ln(6);
			}
		}
		if($rx != ''){
			$pdf->Ln(6);
			$arr_str = explode(" ", $rx);	
			$first_part = implode(" ", array_splice($arr_str, 0,10));	
			$pdf->Cell(25,10,'RX: '.$first_part);
			// $pdf->Cell(10,10, $first_part);
			$pdf->Ln(6);
			while ( !empty($arr_str)) {
				$second_part = implode(" ", array_splice($arr_str, 0,10));
				// $pdf->Cell(25);
				$pdf->Cell(5,10, $second_part);
				$pdf->Ln(6);
			}
		}
		

		$pdf->Output('upload_files/attachments/'.$patient_id.'/PatientReport.pdf','F');
		if($download == TRUE){
			$pdf->Output('PatientReport.pdf','D');
		}
		// $pdf->Output('PatientReport-'.$patient_info->name.' '.$patient_info->last_name .'.pdf', 'I');
	}

	public function send_receipt()
	{
		$physician = $this->input->post('physician');
		$tax_id = $this->input->post('tax_id');
		$patient_name = $this->input->post('patient_name');
		$address = $this->input->post('address');
		$appointment_type = $this->input->post('appointment_type');
		$post_date = $this->input->post('post_date');
		$diagnosis = $this->input->post('diagnosis');
		$amount = $this->input->post('amount');
		$patient_id = $this->input->post('patient_id');
		// $patient_info = $this->getPatientDetails($patient_id);
		$upload_path = './upload_files/receipt/'.$patient_id;
		if(!file_exists($upload_path)){
			mkdir($upload_path);
		}
		$this->load->library('fpdf');
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->Image(site_url(MAIN_IMG_DIR_FULL_PATH.'drlogo.png'), 10, 10,60);
		$pdf->SetFont('Arial','B',16);
		$pdf->Ln(8);
		$pdf->Cell(50);
		$pdf->Cell(20,50,'RECEIPT FOR MEDICAL SERVICES');
		$pdf->SetFont('Arial');
		$pdf->SetFontSize(14);
		$pdf->Ln(40);
		if($physician != ''){
			$arr_str = explode("\n", $physician);	
			// $first_part = implode(" ", array_splice($arr_str, 0,10));	
			for ($i=0; $i < count($arr_str) ; $i++) { 
				if($i == 0){
					$pdf->Cell(25,10,'Physician: '.$arr_str[$i]);
				}else{
					$pdf->Cell(5,10, $arr_str[$i]);
				}
					$pdf->Ln(6);
				
			}
		}
		$pdf->Ln(4);
		$pdf->Cell(45,10, 'Tax ID: '.$tax_id);

		$pdf->Ln(10);
		$pdf->Cell(45,10, 'Name of Patient: '.$patient_name);

		$pdf->Ln(10);
		if($address != ''){
			$arr_str = explode("\n", $address);	
			// $first_part = implode(" ", array_splice($arr_str, 0,10));	
			for ($i=0; $i < count($arr_str) ; $i++) { 
				if($i == 0){
					$pdf->Cell(25,10,'Address: '.$arr_str[$i]);
				}else{
					$pdf->Cell(5,10, $arr_str[$i]);
				}
					$pdf->Ln(6);
				
			}
		}
		// $pdf->Cell(45,10, 'Address: '.$address);
		$pdf->Ln(4);
		if($appointment_type != ''){
			$arr_str = explode("\n", $appointment_type);	
			// $first_part = implode(" ", array_splice($arr_str, 0,10));	
			for ($i=0; $i < count($arr_str) ; $i++) { 
				if($i == 0){
					$pdf->Cell(25,10,'Medical Services: '.$arr_str[$i]);
				}else{
					$pdf->Cell(5,10, $arr_str[$i]);
				}
					$pdf->Ln(6);
				
			}
		}
		// $pdf->Cell(45,10, 'Medical Services: '.$appointment_type);
		$pdf->Ln(4);
		$pdf->Cell(45,10, 'Date of Service: '.$post_date);
		$pdf->Ln(10);
		if($diagnosis != ''){
			$arr_str = explode("\n", $diagnosis);	
			// $first_part = implode(" ", array_splice($arr_str, 0,10));	
			for ($i=0; $i < count($arr_str) ; $i++) { 
				if($i == 0){
					$pdf->Cell(25,10,'Diagnosis: '.$arr_str[$i]);
				}else{
					$pdf->Cell(5,10, $arr_str[$i]);
				}
					$pdf->Ln(6);
				
			}
		}
		$pdf->Ln(4);
		$pdf->Cell(45,10, 'Amount: '.$amount);
		$pdf->Output('upload_files/receipt/'.$patient_id.'/Receipt.pdf','F');
		return TRUE;
	}

	public function receipt_notification($patient_id)
	{
		$patient_info = $this->getPatientDetails($patient_id);
		$this->load->library('notification');	
		$attachments = array();
		$attachments[] = get_the_image('receipt',$patient_id.'/Receipt.pdf');
		
		$parseElement=array(
					"TO"=> $patient_info->email,
					"PATIENT_NAME" => $patient_info->name.' '.$patient_info->last_name ,
					"SITENAME"=>SITE_NAME,
					"EMAIL"=>$patient_info->email,
					"ATTACHMENT" => $attachments
					);
		$this->notification->send_email_notification('patient_receipt', $parseElement);
	}

	public function edit_booking($id)
	{
		//set  info
		$data_profile = $this->input->post();
		unset($data_profile['Submit']);
		$data_profile['updated_at'] = $this->general->get_local_time('time');
		$data_profile['updated_by'] = $this->session->userdata('ADMIN_USERNAME');
		$this->db->where('id', $id);
		$this->db->update('patient', $data_profile);
		
	}
}
