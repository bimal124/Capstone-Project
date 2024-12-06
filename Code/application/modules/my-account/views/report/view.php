<div class="FormPart p-3"><h4>Medical Report</h4>
<div class="card"><h6 class="card-header">Details </h6>

<div class="table-responsive">
    		<table class="table">
			  <thead>
			    <tr>       
			      <th scope="col">Patient Name</th>
			      <th scope="col">Phone</th>
			      <th scope="col">Date of Birth</th>
			      <th scope="col">Gender</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td><?php echo $patient_info->name.' '.$patient_info->last_name ?></td>
			      <td><?php echo $patient_info->phone?></td>
			      <td><?php echo the_date($patient_info->dob)?></td>
			      <td><?php echo $patient_info->gender?></td>
			    </tr>
			    <tr>
			      <th scope="col">Address</th>
			      <th scope="col">State</th>
			      <th scope="col">City</th>
			      <th scope="col">Zip/Postal</th>
			    </tr>

			    <tr>

			      <td><?php echo $patient_info->address ?></td>
			      <td><?php echo $patient_info->state?></td>
			      <td><?php echo $patient_info->city?></td>
			      <td><?php echo $patient_info->zip?></td>
			    </tr>

			    <tr>
			      <th scope="col">Date of Report</th>
			      <th scope="col">Checkin Time</th>
			      <th scope="col">Checkout Time</th>
			      <th scope="col">Reported Symptoms</th>
			    </tr>

			    <tr>
			    	<td><?php echo the_date($patient_info->post_date)?></td>
			    	<td><?php echo the_time($patient_info->check_in_date)?></td>
			    	<td><?php echo the_time($patient_info->check_out_date)?></td>
			    	<td><?php echo $patient_info->symptoms?></td>
			    </tr>
			  </tbody>
			</table>
    		</div>
    		</div>
			<div class="card"><h6 class="card-header">Other Details</h6>
			<div class="p-3">
				<p><b>Reference Number : </b><?php echo $patient_info->reference_num; ?></p>
				<p><b>Covid Test</b> : <?php echo ($patient_info->covid_test == '1')?'Yes':'No'; ?></p>
				<?php if($patient_info->covid_test == '1'){?>
				<p><b>Test Type</b> : <?php echo $covid_test_type[$patient_info->covid_test_type]["name"]?></p>
				<p><b>Number of Test : </b><?php echo $patient_info->covid_no_test?></p>
			<?php } ?>
				<p><b>Type of Appointment : </b><?php echo ($patient_info->appointment_type == '1')?'House Call':'Telemedicine'?></p>
				<?php if($patient_info->appointment_type == '1'){?>
				<p><b>House Call : </b><?php echo $house_call_visit[$patient_info->house_call_visit]["name"]?></p>
				<p><b>Additional family member : </b><?php echo $patient_info->house_call_additional_member?></p>
			<?php } ?>
			</div>

			<h6 class="card-header">Doctor's Report</h6>

			

	<?php 

	$report_details = json_decode($patient_info->report_details);
	$age = ($report_details && $report_details->age)?$report_details->age:'';
	$gender = ($report_details && $report_details->gender)?$report_details->gender:'';
	$symptoms = ($report_details && $report_details->symptoms)?$report_details->symptoms:'';
	$denies = ($report_details && isset($report_details->denies))?$report_details->denies:'';
	$past_medical_history = ($report_details && $report_details->past_medical_history)?$report_details->past_medical_history:'None';
	$past_surgical_history = ($report_details && $report_details->past_surgical_history)?$report_details->past_surgical_history:'None';
	$medications = ($report_details && $report_details->medications)?$report_details->medications:'None';
	$allergies = ($report_details && $report_details->allergies)?$report_details->allergies:'Not Known';
	$social_history = ($report_details && $report_details->social_history)?$report_details->social_history:'None';
	$family_history = ($report_details && $report_details->family_history)?$report_details->family_history:'None';
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
	$pharynx = ($report_details && $report_details->pharynx)?$report_details->pharynx:'';
	$neck = ($report_details && $report_details->neck)?$report_details->neck:'';
	$heart = ($report_details && $report_details->heart)?$report_details->heart:'';
	$lungs = ($report_details && $report_details->lungs)?$report_details->lungs:'';
	$abdomen = ($report_details && $report_details->abdomen)?$report_details->abdomen:'';
	$nose = ($report_details && isset($report_details->nose))?$report_details->nose:'';
	$back = ($report_details && $report_details->back)?$report_details->back:'';
	$neuro = ($report_details && $report_details->neuro)?$report_details->neuro:'';
	$diagnosis = ($report_details && $report_details->diagnosis)?$report_details->diagnosis:'';
	$plan = ($report_details && $report_details->plan)?$report_details->plan:'';
	$rx = ($report_details && $report_details->rx)?$report_details->rx:'';
	$extremities = ($report_details && isset($report_details->extremities))?$report_details->extremities:'';
  $breast = ($report_details && isset($report_details->breast))?$report_details->breast:'';
  $genitalia = ($report_details && isset($report_details->genitalia))?$report_details->genitalia:'';
  				?>
				<div class="card-body">
					<p><b>HPI</b> : This is a <?php echo $age?> years old <?php echo $gender?> complaining of <br>
					<?php echo $symptoms?></p>
					<p><b>Denies</b> : <?php echo $denies?></p>
					<p><b>Past Medical History</b> : <?php 
					if(!empty($past_history)){
						$count = 0;
			    		foreach ($past_history as $value) {
			    			$report_details = json_decode($value->report_details);
			    			$past_medical_history1 = ($report_details && $report_details->past_medical_history)?$report_details->past_medical_history:'None';
			    			if($past_medical_history1 != 'None' && $past_medical_history1 != 'none'){
			    				echo $past_medical_history1." ";
			    				$count++;
			    			}
			    		}
			    		if($count == 0){
		    				echo $past_medical_history;	
		    			}elseif($past_medical_history != 'None'){
		    				echo $past_medical_history;	
		    			}
			    	}else{
			    		echo $past_medical_history;		
			    	}
			    	?>
				    </p>
					<p><b>Past Surgical History</b> : 
						<?php 
					if(!empty($past_history)){
						$count = 0;
			    		foreach ($past_history as $value) {
			    			$report_details = json_decode($value->report_details);
			    			$past_medical_history1 = ($report_details && $report_details->past_surgical_history)?$report_details->past_surgical_history:'None';
			    			if($past_medical_history1 != 'None' && $past_medical_history1 != 'none'){
			    				echo $past_medical_history1." ";
			    				$count++;
			    			}		    			
			    		}
			    		if($count == 0){
		    				echo $past_surgical_history;	
		    			}elseif($past_surgical_history != 'None'){
		    				echo $past_surgical_history;	
		    			}
			    	}else{
			    		echo $past_surgical_history;		
			    	}
			    	?> 
			    </p>

					<p><b>Medications</b> : <?php echo $medications?> </p>
					<p><b>Allergies</b> : <?php echo $allergies?> </p>
					<p><b>Social History</b> : <?php echo $social_history?> </p>
					<p><b>Family History</b> : <?php echo $family_history; ?></p>
					<p><b>Physcal Exam</b> </p>
					<p class="shortInput">
						<span><b>Vital Signs :</b></span><br/>
						<span><b>BP</b> : <?php echo $bh?></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span><b>T</b> : <?php echo $t?></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span><b>HR</b> : <?php echo $hr?></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span><b>RR</b> : <?=$rr?></span>&nbsp;&nbsp;&nbsp;&nbsp;<br/>
						<span><b>O2 Sats</b> : <?=$sats?></span>
					</p>
					<p><b>Head</b> : <?=$head?></p>
					<p><b>Skin</b> : <?=$skin?></p>
					<p><b>Eyes</b> : <?=$eyes?></p>
					<p><b>Ears</b> : <?=$ears?></p>
					<p><b>Nose</b> : <?=$nose?></p>
					<p><b>Pharynx</b> : <?=$pharynx?></p>
					<p><b>Neck</b> : <?=$neck?></p>
					<p><b>Heart</b> : <?=$heart?></p>
					<p><b>Lungs</b> : <?=$lungs?></p>
					<p><b>Abdomen</b> : <?=$abdomen?></p>
					<p><b>Back</b> : <?=$back?></p>
					<p><b>Neuro</b> : <?=$neuro?></p>
					<?php if($extremities != ''){ ?>
					<p><b>Extremities</b> : <?=$extremities ?></p>
				<?php } ?>
				<?php if($breast != ''){?>
			          <p><b>Breast</b> : <?=$breast ?></p>
			      <?php } ?>
			      <?php if($genitalia != ''){?>
			          <p><b>Genitalia</b> : <?=$genitalia ?></p>
			      <?php } ?>
			      <?php if($diagnosis != ''){?>
					<p><b>Diagnosis</b> : <?=$diagnosis?></p>
				<?php } ?>
					<p><b>Plan</b> : <?=$plan?></p>
					<p><b>RX</b> : <?=$rx?></p>
				</div>
    		</div>
    		<div class="card"><h6 class="card-header">Attachments</h6>
				<div class="card-body">
				<ol><?php 
				if(!empty($attachments)){
					foreach ($attachments as $value) { ?>
					<li><a href="<?php echo get_the_image('attachments',$value->patient_id.'/'.$value->name)?>" target="_blank"><?php echo $value->name?></a></li>
				<?php } }else{
					echo "No files found";}?>
					</ol>
			</div>
    	</div>
</div>