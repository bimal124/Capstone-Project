<b>Patient Info</b>

<p>Name : <?php echo $patient_info->name.' '.$patient_info->last_name; ?></p>
<p>Phone : <?php echo the_date($patient_info->dob); ?></p>
<p>Date of Birth : <?php echo the_date($patient_info->dob); ?></p>
<p>Address : <?php echo $patient_info->address; ?></p>

<p>Date of Report : <?php echo the_date($patient_info->post_date)?></p>
<p>Checkin Time : <?php echo $patient_info->check_in_date.', '.the_date($patient_info->appointment_date)?></p>
<p>Checkout Time : <?php echo $patient_info->check_out_date.', '.the_date($patient_info->appointment_date)?></p>
<p>Reported Symptoms : <?php echo $patient_info->symptoms?></p>
<br/>
<b>Doctor's Report</b>
<?php 
	$report_details = json_decode($patient_info->report_details);
	$age = ($report_details && $report_details->age)?$report_details->age:'';
	$gender = ($report_details && $report_details->gender)?$report_details->gender:'';
	$symptoms = ($report_details && $report_details->symptoms)?$report_details->symptoms:'';
	$past_medical_history = ($report_details && $report_details->past_medical_history)?$report_details->past_medical_history:'None';
	$past_surgical_history = ($report_details && $report_details->past_surgical_history)?$report_details->past_surgical_history:'None';
	$medications = ($report_details && $report_details->medications)?$report_details->medications:'None';
	$allergies = ($report_details && $report_details->allergies)?$report_details->allergies:'Not Known';
	$social_history = ($report_details && $report_details->social_history)?$report_details->social_history:'None';
	$family_history = ($report_details && $report_details->family_history)?$report_details->family_history:'None';
	$vs = ($report_details && $report_details->vs)?$report_details->vs:'';
	$bh = ($report_details && $report_details->bh)?$report_details->bh:'';
	$hr = ($report_details && $report_details->hr)?$report_details->hr:'';
	$t = ($report_details && $report_details->t)?$report_details->t:'';
	$rr = ($report_details && $report_details->rr)?$report_details->rr:'';
	$sats = ($report_details && $report_details->sats)?$report_details->sats:'';
	$head = ($report_details && $report_details->head)?$report_details->head:'';
	$eyes = ($report_details && $report_details->eyes)?$report_details->eyes:'';
	$ears = ($report_details && $report_details->ears)?$report_details->ears:'';
	$pharynx = ($report_details && $report_details->pharynx)?$report_details->pharynx:'';
	$neck = ($report_details && $report_details->neck)?$report_details->neck:'';
	$heart = ($report_details && $report_details->heart)?$report_details->heart:'';
	$lungs = ($report_details && $report_details->lungs)?$report_details->lungs:'';
	$abdomen = ($report_details && $report_details->abdomen)?$report_details->abdomen:'';
	$ext = ($report_details && $report_details->ext)?$report_details->ext:'';
	$back = ($report_details && $report_details->back)?$report_details->back:'';
	$neuro = ($report_details && $report_details->neuro)?$report_details->neuro:'';
	$diagnosis = ($report_details && $report_details->diagnosis)?$report_details->diagnosis:'';
	$plan = ($report_details && $report_details->plan)?$report_details->plan:'';
	$rx = ($report_details && $report_details->rx)?$report_details->rx:'';
					?>
					<p><b>HPI</b> : This is a <?php echo $age?> years old <?php echo $gender?> complaining of <br>

					<?php echo $symptoms?></p>
					<p><b>Past Medical History</b> : <?php echo $past_medical_history?> </p>
					<p><b>Past Surgical History</b> : <?php echo $past_surgical_history?></p>
					<p><b>Medications</b> : <?php echo $medications?> </p>
					<p><b>Allergies</b> : <?php echo $allergies?> </p>
					<p><b>Social History</b> : <?php echo $allergies?> </p>
					<p><b>Family History</b> : <?php echo $family_history; ?></p>
					
					<p><b>Physcal Exam</b> </p>
					<p class="shortInput">
						<span><b>VS</b> : <?php echo $vs?></span>
						<span><b>BH</b> : <?php echo $bh?></span>
						<span><b>HR</b> : <?php echo $hr?></span>
						<span><b>T</b> : <?php echo $t?></span>
						<span><b>RR</b> : <?=$rr?></span>
						<span><b>Sats</b> : <?=$sats?></span>
					</p>
					<p><b>Head</b> : <?=$head?></p>
					<p><b>Eyes</b> : <?=$eyes?></p>
					<p><b>Ears</b> : <?=$ears?></p>
					<p><b>Pharynx</b> : <?=$pharynx?></p>
					<p><b>Neck</b> : <?=$neck?></p>
					<p><b>Heart</b> : <?=$heart?></p>
					<p><b>Lungs</b> : <?=$lungs?></p>
					<p><b>Abdomen</b> : <?=$abdomen?></p>
					<p><b>Ext</b> : <?=$ext?></p>
					<p><b>Back</b> : <?=$back?></p>
					<p><b>Neuro</b> : <?=$neuro?></p>
					<p><b>Diagnosis</b> : <?=$diagnosis?></p>
					<p><b>Plan</b> : <?=$plan?></p>
					<p><b>RX</b> : <?=$rx?></p>
					
