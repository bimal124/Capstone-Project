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
          <?php if ($this->session->flashdata('message')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('message'); ?></h4>
      </div>
    <?php } ?>
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                     <?php echo $modules_heading;?>
                    <small class="pull-right">Booking Date: <?php echo the_date($details->post_date)?>
                      <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/medical/edit_booking/<?=$details->id?>" class="btn btn-primary">Edit</a>
                    </small><br/>
                    
                  </h2>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <?php 
              if($details->company_name != ''){
              ?>
              <div class="row invoice-info">
              <div class="col-sm-3 invoice-col">
                  <address>
                  <b>Company Name</b><br>
                   <?php echo $details->company_name?>
                 </address>
                </div>

                <div class="col-sm-6 invoice-col">
                  <address>
                  <b>Needs medical clearance to take flight</b><br>
                   <?php echo ($details->need_flight == 1)?"Yes":"No"?>
                 </address>
                </div>
              </div>
              <?php }?>
              
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  
                  <address>
                    <strong>Patient's Name</strong><br>
                    <?php echo $details->name.' '.$details->last_name?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Reference Number</strong><br>
                    <?php echo $details->reference_num?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Gender</strong><br>
                    <?php echo $details->gender?>
                  </address>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3 invoice-col">
                  <b>Date of Birth</b><br>
                  <?php print($this->general->date_formate($details->dob));?>
                </div>
                
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                   <address>
                    <strong>Email</strong><br>
                    <?php echo $details->email?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  
                  <address>
                    <strong>Phone</strong><br>
                    <?php echo $details->phone?>
                  </address>
                </div>
                <!-- /.col -->
              </div>

              <div class="row">
                <div class="col-sm-3 invoice-col">
                  <b><?=($details->company_name == '')?'Address':'Hotel Name' ?></b><br>
                   <?php echo $details->address?>
                </div>
                <div class="col-sm-3 invoice-col">
                  <b><?=($details->company_name == '')?'State':'Address' ?></b><br>
                   <?php echo $details->state?>
                </div>
                <?php 
              if($details->company_name != ''){
              ?>
              <div class="col-sm-3 invoice-col">
                  <b>City</b><br>
                   <?php echo ($details->hotel_city != '')?$details->hotel_city:'-'?>
                </div>
              <div class="col-sm-3 invoice-col">
                  <b>State</b><br>
                   <?php echo ($details->hotel_state != '')?$details->hotel_state:'-'; ?>
                </div>
                <br/>
                <div class="col-sm-3 invoice-col">
                  <b>Zip/Postal</b><br>
                   <?php echo ($details->hotel_zip != '')?$details->hotel_zip:'-' ?>
                </div>
            <?php } ?>
                <div class="col-sm-3 invoice-col">
                  <b><?=($details->company_name == '')?'City':'Phone Number' ?></b><br>
                   <?php echo $details->city?>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                  <b><?=($details->company_name == '')?'Zip/Postal':'Room Number' ?></b><br>
                   <?php echo $details->zip?>
                 </address>
                </div>
                <!-- /.col -->
              </div>
              
              <?php 
              if($details->company_name ==''){?>
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  
                  <address>
                    <strong>Covid Test</strong><br>
                    <?php echo ($details->covid_test == '1')?'Yes':'No'; ?>
                  </address>
                </div>
                <?php if($details->covid_test == '1'){?>
                  <div class="col-sm-3">
                    <address>
                    <b>Test Type</b><br/>
                    <?php echo $covid_test_type[$details->covid_test_type]["name"]?>
                  </address>
                  </div>
                  <div class="col-sm-3">
                    <b>Number of Test</b><br/>
                    <?php echo $details->covid_no_test?>
                  </div>
                <?php } ?>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <address>
                  <b>Type of Appointment</b><br/>
                  <?php echo ($details->appointment_type == '1')?'House Call':'Telemedicine'?>
                </address>
                </div>
                <?php if($details->appointment_type == '1'){?>
                  <div class="col-sm-3">
                    <address>
                    <b>House Call</b><br/>
                    <?php echo $house_call_visit[$details->house_call_visit]["name"]?>
                  </address>
                  </div>
                  <div class="col-sm-3">
                    <b>Additional family member</b><br/>
                    <?php echo $details->house_call_additional_member?>
                  </div>
                <?php } ?>
                <!-- /.col -->
              </div>
            <?php } ?>
              
              <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                <strong>Reported Symptoms</strong><br />
                <?php echo $details->symptoms?>
                </div>
              </div>
              <br>
              <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                <strong>Repeat</strong><br />
                <?php echo ($details->referal_firstname)?$details->referal_firstname.' '.$details->referal_lastname:'-'?>
                </div>
              </div>
              <br/>
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                <strong>Last Update</strong><br />
                <?php print($this->general->date_time_formate($details->updated_at));?>
                </div>
                <div class="col-sm-3">
                    <b>Update By</b><br/>
                    <?php echo ($details->updated_by != '')?$details->updated_by:'-' ?>
                  </div>
              </div>
              <!-- /.row -->
        
            </section>
    <br>

        <!-- /.content -->

    </div>

<!-- Small modal -->