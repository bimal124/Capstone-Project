<?php 
$report_details = json_decode($patient_info->report_details);
$age = ($report_details && $report_details->age)?$report_details->age:$this->general->calculate_age($patient_info->dob);
$gender = ($report_details && $report_details->gender)?$report_details->gender:$patient_info->gender;
$symptoms = ($report_details && $report_details->symptoms)?$report_details->symptoms:'';
$denies = ($report_details && isset($report_details->denies))?$report_details->denies:'Denies fever or chills, generalized weakness, fatigue, sore throat, difficulty swallowing, nasal congestion, SOB, cough, chest congestion, CP, palpitations, nausea, vomiting, diarrhea, constipation, abdominal pain.';
$past_medical_history = ($report_details && $report_details->past_medical_history)?$report_details->past_medical_history:'None';
$past_surgical_history = ($report_details && $report_details->past_surgical_history)?$report_details->past_surgical_history:'None';
$medications = ($report_details && $report_details->medications)?$report_details->medications:'None';
$allergies = ($report_details && $report_details->allergies)?$report_details->allergies:'NKDA';
$social_history = ($report_details && $report_details->social_history)?$report_details->social_history:'Denies cigarette smoking, alcohol consumption or drug abuse';
$family_history = ($report_details && $report_details->family_history)?$report_details->family_history:'None';
// $vs = ($report_details && $report_details->vs)?$report_details->vs:'';
$bh = ($report_details && $report_details->bh)?$report_details->bh:'';
$hr = ($report_details && $report_details->hr)?$report_details->hr:'';
$t = ($report_details && $report_details->t)?$report_details->t:'';
$rr = ($report_details && $report_details->rr)?$report_details->rr:'';
$sats = ($report_details && $report_details->sats)?$report_details->sats:'';
$head = ($report_details && $report_details->head)?$report_details->head:'NCAT';
$skin = ($report_details && isset($report_details->skin))?$report_details->skin:'';
$eyes = ($report_details && $report_details->eyes)?$report_details->eyes:'PERRLA, EOMI; no conjunctival erythema. No orbital erythema or edema. No lid erythema or edema';
$ears = ($report_details && $report_details->ears)?$report_details->ears:'No pinna tenderness. No erythema to the external ear canal. Tympanic membrane intact bilaterally; no drainage bilaterally';
$nose = ($report_details && isset($report_details->nose))?$report_details->nose:'Nares patent; no erythema or edema. No paranasal tenderness. No rhinorrhea';
$pharynx = ($report_details && $report_details->pharynx)?$report_details->pharynx:'non-injected; no erythema, edema or exudate bilaterally. Oral mucosa is moist without lesionsd.';
$neck = ($report_details && $report_details->neck)?$report_details->neck:'supple; no cervical lymphadenopathy bilaterally';
$heart = ($report_details && $report_details->heart)?$report_details->heart:'s1 s2 regular; no murmurs';
$lungs = ($report_details && $report_details->lungs)?$report_details->lungs:'clear bilaterally; no wheezing, rales, or rhonchi; no use of accessory muscles; no intercostal retractions';
$abdomen = ($report_details && $report_details->abdomen)?$report_details->abdomen:'';
$back = ($report_details && $report_details->back)?$report_details->back:'';
$neuro = ($report_details && $report_details->neuro)?$report_details->neuro:'';
$diagnosis = ($report_details && $report_details->diagnosis)?$report_details->diagnosis:'';
$plan = ($report_details && $report_details->plan)?$report_details->plan:'Augmentin 875mg PO       
BID x 10 days
Increase PO Fluids
Nasal douching
Patient advised to call if symptoms persist or worsen 
Follow up with patient within 24 hours ';
$rx = ($report_details && $report_details->rx)?$report_details->rx:'';
$extremities = ($report_details && isset($report_details->extremities))?$report_details->extremities:'';
  $breast = ($report_details && isset($report_details->breast))?$report_details->breast:'';
  $genitalia = ($report_details && isset($report_details->genitalia))?$report_details->genitalia:'';
?>
	<div class="FormPart p-3"><h4>Patient Medical Report Update</h4>

<div class="card"><h6 class="card-header">Patient Detail</h6>
		<div class="row">
			<div class="col-sm-8 pr-0">
			<div class="p-3">
				<p><b>Patient Name</b>: <?php echo $patient_info->name.' '.$patient_info->last_name?></p>
				<p><b>Reference Number: </b> <?php echo $patient_info->reference_num; ?></p>
				<p><b>Age</b>: <?php echo $this->general->calculate_age($patient_info->dob)?> Years</p>
				<p><b>Gender</b>: <?php echo $patient_info->gender ?></p>
				<p><b>Report Symptoms</b>: <?php echo $patient_info->symptoms; ?></p>
				</div>
			<h6 class="card-header">Address Detail</h6>
			<div class="p-3">
				<p><b>Contact No</b>: <?php echo $patient_info->phone; ?></p>
				<p><b>Email</b>: <?php echo $patient_info->email; ?></p>
				<p><b>Address</b>: <?php echo $patient_info->address.' '.$patient_info->address2;?>
				<p><b>State: </b><?php echo $patient_info->state?></p>
				<p><b>City: </b><?php echo $patient_info->city?></p>
				<p><b>Zip/Postal: </b><?php echo $patient_info->zip?></p>

				<input type="hidden" name="patient_id" value="<?php echo $patient_info->id?>">
				<input type="hidden" name="base_url" value="<?php echo base_url()?>">

				</div>
			</div>
			<div class="col-sm-4 pl-0">
				<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=<?php echo $patient_info->address?>,%20<?php echo $patient_info->state?>,%20<?php echo $patient_info->city?>)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
			</div>
			</div>
			<h6 class="card-header">Other Details</h6>
			<div class="p-3">
				<p><b>Covid Test</b>: <?php echo ($patient_info->covid_test == '1')?'Yes':'No'; ?></p>
				<?php if($patient_info->covid_test == '1'){?>
				<p><b>Test Type</b>: <?php echo $covid_test_type[$patient_info->covid_test_type]["name"]?></p>
				<p><b>Number of Test: </b><?php echo $patient_info->covid_no_test?></p>
			<?php } ?>
				<p><b>Type of Appointment: </b><?php echo ($patient_info->appointment_type == '1')?'House Call':'Telemedicine'?></p>
				<?php if($patient_info->appointment_type == '1'){?>
				<p><b>House Call: </b><?php echo $house_call_visit[$patient_info->house_call_visit]["name"]?></p>
				<p><b>Additional family member: </b><?php echo $patient_info->house_call_additional_member?></p>
			<?php } ?>
			</div>

    	</div>
    	<div class="card">
				<h6 class="card-header">  
					<span>
					<?php /*<input type="text" class="bs-timepicker" name="checkin" value="<?php echo $patient_info->check_in_date?>">
					*/?>
					<button type="button" class="btn btn-primary btn-sm ml-3 checkin-btn" <?php echo ($patient_info->check_in_date)?'disabled':''?>>Check in</button> 
					<?php echo ($patient_info->check_in_date)?the_time($patient_info->check_in_date):''?>
					<div class="alert alert-success checkin-success-message" style="display: none;">
							</div>
							<div class="alert alert-danger checkin-error-message" style="display: none;">
							</div>
						</span> 
					
				</h6>
				</div>

			<div class="card"><h6 class="card-header">Medical Report</h6>
				<div class="card-body reportCreaete">
				<form id="reportForm">
					<fieldset class="mb-5">
					<p><b>HPI:</b> This is a 
						<input type="number" placeholder="age" name="age" value="<?php echo set_value('age',$age)?>"> years old 
						<input type="text" placeholder="gender" name="gender" value="<?php echo set_value('gender',$gender)?>"> complaining of </p>
					<p><textarea class="form-control" name="symptoms" placeholder="symptoms"><?php echo set_value('symptoms',$symptoms)?></textarea></p>
					<p><b>Denies:</b><textarea class="form-control" name="denies" placeholder="Denies" rows="3"><?php echo set_value('denies',$denies)?></textarea></p>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Past Medical History:</b><br/>
					    	<?php 
					    	if(!empty($past_history)){
					    		foreach ($past_history as $value) {
					    			$report_details = json_decode($value->report_details);
					    			$past_medical_history1 = ($report_details && $report_details->past_medical_history)?$report_details->past_medical_history:'None';
					    			if($past_medical_history1 != 'None' && $past_medical_history1 != 'none'){
					    				echo $past_medical_history1."<br/> ";
					    			}
					    		}
					    	}
					    	?>
					    </label>
					    <div class="col-sm-9">
					      <input type="text" placeholder="Enter Medical History" name="past_medical_history" class="form-control" value="<?php echo set_value('past_medical_history',$past_medical_history)?>"> 
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Past Surgery History:</b><br/>
					    	<?php 
					    	if(!empty($past_history)){
					    		foreach ($past_history as $value) {
					    			$report_details = json_decode($value->report_details);
					    			$past_medical_history1 = ($report_details && $report_details->past_surgical_history)?$report_details->past_surgical_history:'None';
					    			if($past_medical_history1 != 'None' && $past_medical_history1 != 'none'){
					    				echo $past_medical_history1."<br/> ";
					    			}
					    		}
					    	}
					    	?>

					    </label>
					    <div class="col-sm-9">
					      <input type="text" placeholder="Enter Surgerical History" name="past_surgical_history" class="form-control" value="<?php echo set_value('past_surgical_history',$past_surgical_history)?>">  
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Medications:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Medications" name="medications" class="form-control" value="<?php echo set_value('medications',$medications)?>">  
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Allergies:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Allergies" name="allergies" class="form-control" value="<?php echo set_value('allergies',$allergies)?>">  
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Social History:</b><br/>
					    	<?php 
					    	if(!empty($past_history)){
					    		foreach ($past_history as $value) {
					    			$report_details = json_decode($value->report_details);
					    			$past_medical_history1 = ($report_details && $report_details->social_history)?$report_details->social_history:'None';
					    			if($past_medical_history1 != 'None' && $past_medical_history1 != 'none' ){
					    				echo $past_medical_history1."<br/> ";
					    			}
					    		}
					    	}
					    	?>
					    </label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Social History" name="social_history" class="form-control" value="<?php echo set_value('social_history',$social_history)?>">  

					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Family History:</b><br/>
					    <?php 
					    	if(!empty($past_history)){
					    		foreach ($past_history as $value) {
					    			$report_details = json_decode($value->report_details);
					    			$past_medical_history1 = ($report_details && $report_details->family_history)?$report_details->family_history:'None';
					    			if($past_medical_history1 != 'None' && $past_medical_history1 != 'none'){
					    				echo $past_medical_history1."<br/> ";
					    			}
					    		}
					    	}
					    	?>
					    </label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Family History" name="family_history" class="form-control" value="<?php echo set_value('family_history',$family_history)?>">  
					    </div>
					</div>
					
				<div class="mt-5">
					<h6>Physical Exam:</h6>
					<p class="shortInput">
						<span>VS: <?php /*<input type="number" placeholder="00" width="20" name="vs" value="<?php echo set_value('vs',$vs)?>">*/?></span>
						<span>BP: <input type="text" placeholder="00" name="bh" value="<?php echo set_value('bh',$bh)?>"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span>T: <input type="text" placeholder="00" name="t" value="<?php echo set_value('t',$t)?>"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span>HR: <input type="text" placeholder="00" name="hr" value="<?php echo set_value('hr',$hr)?>"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span>RR: <input type="text" placeholder="00" name="rr" value="<?php echo set_value('rr',$rr)?>"></span><br/><br/>
						<span>O2 Sats: <input type="text" placeholder="00" name="sats" value="<?php echo set_value('sats',$sats)?>"></span>
					</p>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Head:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Details" name="head" class="form-control" value="<?php echo set_value('head',$head)?>">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Skin:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Details" name="skin" class="form-control" value="<?php echo set_value('skin',$skin)?>">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Eyes:</b></label>
					    <div class="col-sm-9">
					    	<textarea class="form-control" name="eyes" placeholder="Enter Details" rows="2" class="form-control"><?php echo set_value('eyes',$eyes)?></textarea>
						<!-- <input type="text" placeholder="Enter Details" name="eyes" class="form-control" value="<?php echo set_value('eyes',$eyes)?>"> -->
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Ears:</b></label>
					    <div class="col-sm-9">
					    <textarea class="form-control" name="ears" placeholder="Enter Details" rows="3" class="form-control"><?php echo set_value('ears',$ears)?></textarea>

						<!-- <input type="text" placeholder="Enter Details" name="ears" class="form-control" value="<?php echo set_value('ears',$ears)?>"> -->
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Nose:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Details" name="nose" class="form-control" value="<?php echo set_value('nose',$nose)?>">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Pharynx:</b></label>
					    <div class="col-sm-9">
					    	<textarea class="form-control" name="pharynx" placeholder="Enter Details" rows="2" class="form-control"><?php echo set_value('pharynx',$pharynx)?></textarea>
						<!-- <input type="text" placeholder="Enter Details" name="pharynx" class="form-control" value="<?php echo set_value('pharynx',$pharynx)?>"> -->
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Neck:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Details" name="neck" class="form-control" value="<?php echo set_value('neck',$neck)?>">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Heart:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Details" name="heart" class="form-control" value="<?php echo set_value('heart',$heart)?>">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Lungs:</b></label>
					    <div class="col-sm-9">
					    	<textarea class="form-control" name="lungs" placeholder="Enter Details" rows="2" class="form-control"><?php echo set_value('lungs',$lungs)?></textarea>
						<!-- <input type="text" placeholder="Enter Details" name="lungs" class="form-control" value="<?php echo set_value('lungs',$lungs)?>"> -->
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Adbomen:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Details" name="abdomen" class="form-control" value="<?php echo set_value('abdomen',$abdomen)?>">
					    </div>
					</div>
					
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Back:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Details" name="back" class="form-control" value="<?php echo set_value('back',$back)?>">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Neuro:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Details" name="neuro" class="form-control" value="<?php echo set_value('neuro',$neuro)?>">
					    </div>
					</div>

					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Extremities:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Details" name="extremities" class="form-control" value="<?php echo set_value('extremities',$extremities)?>">
					    </div>
					</div>

					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Breast:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Details" name="breast" class="form-control" value="<?php echo set_value('breast',$breast)?>">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Genitalia:</b></label>
					    <div class="col-sm-9">
						<input type="text" placeholder="Enter Details" name="genitalia" class="form-control" value="<?php echo set_value('genitalia',$genitalia)?>">
					    </div>
					</div>
					<br/>
					<div class="form-group row">
						<div class="col-sm-3">
							<h6>Diagnosis:</h6>
						</div>
						<div class="col-sm-9">
							<textarea class="form-control" name="diagnosis" placeholder="Enter diagnosis details" rows="3" class="form-control"><?php echo set_value('diagnosis',$diagnosis)?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-3">
							<h6>Plan:</h6>
						</div>
						<div class="col-sm-9">
							<textarea class="form-control" name="plan" placeholder="Plan details" class="form-control" rows="10"><?php echo set_value('plan',$plan)?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-3">
							<h6>RX:</h6>
						</div>
						<div class="col-sm-9">
							<textarea class="form-control" name="rx" placeholder="RX details" class="form-control" rows="3"><?php echo set_value('rx',$rx)?></textarea>
						</div>
					</div>
					<?php /*
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Diagnosis:</b></label>
					    <div class="col-sm-9">
						<textarea class="form-control" name="diagnosis" placeholder="Enter diagnosis details" class="form-control"><?php echo set_value('diagnosis',$diagnosis)?></textarea>
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>Plan:</b></label>
					    <div class="col-sm-9">
						<textarea class="form-control" name="plan" placeholder="Plan details" class="form-control"><?php echo set_value('plan',$plan)?></textarea>
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-3 col-form-label"><b>RX:</b></label>
					    <div class="col-sm-9">
						<textarea class="form-control" name="rx" placeholder="RX details" class="form-control"><?php echo set_value('rx',$rx)?></textarea>
					    </div>
					</div>	
					*/?>
					<div class="form-group row">
					    <div class="col-sm-3">
					    	<button class="btn btn-primary">Save Information</button>
							<i class="fa fa fa-spinner fa-spin" style="display: none;"></i>
					    </div>
					    <div class="col-sm-4">
						    <div class="alert alert-success success-message" style="display: none;">
							</div>
					    </div>
					</div>				
				</div>
				</fieldset>
				
				
				<input type="hidden" name="patient_id" value="<?php echo $patient_info->id?>">

				</form>
				</div>
    		</div>

			
    		<div class="card"><h6 class="card-header">Attachments</h6>
				<div class="card-body">
				<div id="attachmentList">
					<ol><?php 
				if(!empty($attachments)){
					foreach ($attachments as $value) { ?>
					<li><a href="<?php echo get_the_image('attachments',$value->patient_id.'/'.$value->name)?>" target="_blank"><?php echo $value->name?></a> 
						<a href="" class="remove-attachment" style="color: red;" title="Remove" data-attachment_id="<?php echo $value->id?>">X</a></li>
				<?php } }else{
					echo "No files found";}?>
					</ol>
				</div>
					<div>
						<form name="attachmentForm" id="attachmentForm">
						<div class="custom-file col-sm-3">
						  <input type="file" name="attachmentFile" class="custom-file-input" id="attachmentFile">
						  <label class="custom-file-label" for="customFile">Upload Attachment</label>
						</div>
						<i class="fa fa fa-spinner fa-spin" style="display: none;"></i>
						  <input type="hidden" name="patient_id" value="<?php echo $patient_info->id?>">
						</form>
					</div>
			</div>

			<div class="card">
				<h6 class="card-header">  
					<?php /*<input type="text" class="bs-timepicker" name="checkout" value="<?php echo $patient_info->check_out_date?>"> */?>
					<button type="button" class="btn btn-primary btn-sm ml-3 checkout-btn" <?php echo ($patient_info->check_out_date)?'disabled':''?>>Check out</button> 
					<?php 
					if($patient_info->check_out_date){
						 echo the_time($patient_info->check_out_date);
						} ?>
					<span>
				<!-- You can check out only after completing checkup.	 -->
						</span> 
						<div class="alert alert-success checkout-success-message" style="display: none;"></div>
						<div class="alert alert-danger checkout-error-message" style="display: none;"></div>
				</h6>
			</div>



    	</div>

</div>


<script>
  $(function () {
    $('.bs-timepicker').timepicker();
  });
</script>