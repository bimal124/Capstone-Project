<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            <?php echo $modules_name; ?>

        </h1>      

        <?php echo $this->breadcrumb->output(); ?>

    </section>

    <!-- Main content -->
        <section class="invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                     <?php echo $modules_heading;?> - Details
                     <?php 
                     if($patient_info->visit_status == '2'){
                     ?>
                    <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/medical/download_report/0/'.$patient_info->id)?>" class="btn btn-primary" style="float: right;">Download</a> 
                  <?php } ?>
                    <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/medical/edit_booking/<?=$patient_info->id?>" class="btn btn-primary" style="float: right; margin-right: 10px;">Edit</a>

                  </h2>

                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <?php 
              if($patient_info->company_name != ''){
              ?>
              <div class="row invoice-info">
              <div class="col-sm-3 invoice-col">
                  <address>
                  <b>Company Name</b><br>
                   <?php echo $patient_info->company_name?>
                 </address>
                </div>
              </div>
              <?php }?>
              <div class="row invoice-info">
                <?php /*
                <div class="col-sm-3">
                  <address>
                    <strong>Date of visit</strong><br>
                    <?php echo ($patient_info->appointment_date)?the_date($patient_info->appointment_date):'--'?>
                  </address>
                </div>
                <div class="col-sm-3">
                  <address>
                    <strong>Call Time</strong><br>
                    <?php echo ($patient_info->appointment_date)?the_time($patient_info->appointment_date):'--'?>
                  </address>
                </div>
                */?>
                <div class="col-sm-3 invoice-col">
                  
                  <address>
                    <strong>Check-in Time</strong><br>
                    <?php echo ($patient_info->check_in_date)?the_time($patient_info->check_in_date):'--:--'?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  <b>Check-Out Time</b><br>
                  <?php echo ($patient_info->check_out_date)?the_time($patient_info->check_out_date):'--:--'?>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Patient's Name</strong><br>
                    <?php echo $patient_info->name.' '.$patient_info->last_name?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Reference Number</strong><br>
                    <?php echo $patient_info->reference_num?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Date of Birth</strong><br>
                  <?php print($this->general->date_formate($patient_info->dob));?>
                  <?php echo '('.$this->general->calculate_age($patient_info->dob).')'?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Gender</strong><br>
                    <?php echo ($patient_info->gender)?$patient_info->gender:'-'?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Email</strong><br>
                    <?php echo $patient_info->email?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Phone</strong><br>
                    <?php echo $patient_info->phone?>
                  </address>
                </div>
                <!-- /.col -->
                
                
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong><?=($patient_info->company_name == '')?'Address':'Hotel Name' ?></strong><br>
                   <?php echo $patient_info->address;?>
                 </address>
                </div>
                
              </div>
              <?php 
              if($patient_info->company_name != ''){
              ?>
              <div class="row">
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>City</strong><br>
                    <?php echo ($patient_info->hotel_city != '')?$patient_info->hotel_city:'-' ?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>State</strong><br>
                    <?php echo ($patient_info->hotel_state != '')?$patient_info->hotel_state:'-' ?>
                  </address>
                </div>
                
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Zip/Postal</strong><br>
                    <?php echo ($patient_info->hotel_zip != '')?$patient_info->hotel_zip:'-' ?>
                  </address>
                </div>
              </div>
            <?php } ?>
              <div class="row">
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong><?=($patient_info->company_name == '')?'City':'Phone Number' ?></strong><br>
                    <?php echo $patient_info->state?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong><?=($patient_info->company_name == '')?'State':'Address' ?></strong><br>
                    <?php echo $patient_info->city?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong><?=($patient_info->company_name == '')?'Zip/Postal':'Room Number' ?></strong><br>
                    <?php echo $patient_info->zip?>
                  </address>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm-12 invoice-col">
                  <address>
                    <strong>Reported Symptoms</strong><br>
                    <?php echo $patient_info->symptoms?>
                  </address>
                </div>
              </div>
              <?php 
              if($patient_info->company_name ==''){?>
              <div class="row invoice-info" >

                <div class="col-sm-3" invoice-col>
                  <address>
                    <strong>Covid Test</strong><br>
                    <?php echo ($patient_info->covid_test == '1')?'Yes':'No'; ?>
                  </address>
                </div>
                <?php if($patient_info->covid_test == '1'){?>
                  <div class="col-sm-3">
                  <address>
                    <strong>Test Type</strong><br>
                    <?php echo $covid_test_type[$patient_info->covid_test_type]["name"]?>
                  </address>
                </div>
                  <div class="col-sm-3">
                  <address>
                    <strong>Number of Test </strong><br>
                    <?php echo $patient_info->covid_no_test?>
                  </address>
                </div>
                <?php } ?>
                 </div>
              <div class="row">
                <div class="col-sm-3">
                  <address>
                    <strong>Type of Appointment</strong><br>
                    <?php echo ($patient_info->appointment_type == '1')?'House Call':'Telemedicine'?>
                  </address>
                </div>
                <?php if($patient_info->appointment_type == '1'){?>
                  <div class="col-sm-3">
                  <address>
                    <strong>House Call</strong><br>
                    <?php echo $house_call_visit[$patient_info->house_call_visit]["name"]?>
                  </address>
                </div>
                <div class="col-sm-3">
                  <address>
                    <strong>Additional family member</strong><br>
                    <?php echo $patient_info->house_call_additional_member?>
                  </address>
                </div>
                <?php } ?>
                <!-- /.col -->
              </div>

              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Date of Report</strong><br>
                    <?php echo the_date($patient_info->post_date)?>
                  </address>
                </div>

                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Total Amount</strong><br>
                    <?php echo (!empty($transaction))?$this->general->formate_amount($transaction->amount):'--'?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Payment Date</strong><br>
                    <?php echo (!empty($transaction))?the_date($transaction->transaction_date):''?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Repeat</strong><br>
                    <?php echo ($patient_info->referal_firstname)?$patient_info->referal_firstname.' '.$patient_info->referal_lastname:'-'?>
                  </address>
                </div>
              </div>
              <?php } ?>
              <br/>
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                <strong>Last Update</strong><br />
                <?php print($this->general->date_formate($patient_info->updated_at));?>
                </div>
                <div class="col-sm-3">
                    <b>Update By</b><br/>
                    <?php echo ($patient_info->updated_by != '')?$patient_info->updated_by:'-' ?>
                  </div>
              </div>
              
              <!-- /.row -->
        
            </section>
            
            
            <section class="invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                    Doctor's Report
                    
                  </h2>
                </div>
                <!-- /.col -->
              </div>
              <!-- Table row -->
              <div class="row">
              
              <?php 
              if($patient_report){?>
                <?php 
  $report_details = json_decode($patient_report->report_details);
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
                <div class="col-xs-12 table-responsive">
                  <div class="card-body">
          <p><b>HPI</b> : This is a <?php echo $age?> years old <?php echo $gender?> complaining of <br>

          <?php echo $symptoms?></p>
          <p><b>Denies</b> : <?php echo $denies?></p>
          <p><b>Past Medical History</b> : 
            <?php 
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
            <span><b>BP</b> : <?php echo $bh?></span> &nbsp;&nbsp;&nbsp;&nbsp;
            <span><b>T</b> : <?php echo $t?></span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span><b>HR</b> : <?php echo $hr?></span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span><b>RR</b> : <?=$rr?></span><br/>
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
          <p><b>Extremities</b> : <?=$extremities ?></p>
          <p><b>Breast</b> : <?=$breast ?></p>
          <p><b>Genitalia</b> : <?=$genitalia ?></p>
          <br/>
          <p><b>Diagnosis</b> : <?=$diagnosis?></p>
          <br/>
          <p><b>Plan</b> : <?=$plan?></p>
          <br/>
          <p><b>RX</b> : <?=$rx?></p>
          
        </div>
                </div>
                <?php if($report_attachment){?>
                <div class="col-xs-12">
                	<h2 class="page-header">Attachment</h2>
                	<div class="row">

                    	<?php foreach($report_attachment as $report){?>
                    	<div class="col-xs-3">
                        <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/medical/download_report/'.$report->id.'/'.$report->patient_id)?>">
                        <span class="btn btn-primary btn-sm"><i class="fa fa-download"></i>&nbsp; <?php echo $report->name;?></span>
                        </a>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <?php }?>
                <?php }else{?>
                <div class="col-xs-12">
                	<div class="alert alert-info" role="alert" style="font-size:16px;">
                      There is no report uploaded by provider
                    </div>
                </div>
                <?php }?>
                <!-- /.col -->
              </div>
              <!-- /.row -->
        
              
              <!-- /.row -->
        
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                
              </div>
            </section>
    <br>

        <!-- /.content -->

    </div>

<!-- Small modal -->