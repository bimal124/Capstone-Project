<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            <?php echo $modules_name; ?>

        </h1>      

        <?php echo $this->breadcrumb->output(); ?>

    </section>

    <!-- Main content -->
   
    <form method="post">
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
                    <small class="pull-right">Booking Date: <?php echo the_date($details->post_date)?></small><br/>
                    
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
                   <input type="text" name="company_name" value="<?php echo $details->company_name?>" class="form-control">
                 </address>
                 <?=form_error('company_name')?>
                </div>

                <div class="col-sm-6 invoice-col">
                  <address>
                  <b>Needs medical clearance to take flight</b><br>
                  <select name="need_flight" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0" <?php echo ($details->need_flight != 1)?'selected':''?>>No</option>
                  </select>
                 </address>
                </div>
              </div>
              <?php }?>
              
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  
                  <address>
                    <strong>Patient's First Name</strong><br>
                    <input type="text" class="form-control" name="name" value="<?php echo $details->name?>">
                    <?=form_error('name')?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  
                  <address>
                    <strong>Last Name</strong><br>
                    <input type="text" class="form-control" name="last_name" value="<?php echo $details->last_name?>">
                    <?=form_error('last_name')?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Reference Number</strong><br>
                    <input type="text" class="form-control" name="reference_num" value="<?php echo $details->reference_num?>">
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <strong>Gender</strong><br>
                    <select class="form-control" name="gender">
                      <option value="Male">Male</option>
                      <option value="Female" <?=($details->gender == 'Female')?'selected':''?>>Female</option>
                      <option value="Other" <?=($details->gender == 'Other')?'selected':''?>>Other</option>
                    </select>
                  </address>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3 invoice-col">
                  <b>Date of Birth</b><br>
                  <div class="input-group" id="start_datetimepicker">
                                        <input name="dob" type="text" class="form-control" value="<?=set_value('dob',$details->dob)?>" size="20" autocomplete="off">
                                        <span class="input-group-addon">
                                          <span class="fa fa-calendar"></span>
                                        </span>
                                      </div>
                </div>
                
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                   <address>
                    <strong>Email</strong><br>
                    <input type="text" name="email" class="form-control" value="<?=$details->email?>">
                    <?=form_error('email')?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  
                  <address>
                    <strong>Phone</strong><br>
                    <input type="text" name="phone" class="form-control" value="<?=$details->phone?>">
                  <?=form_error('phone')?>

                  </address>
                </div>
                <!-- /.col -->
              </div>

              <div class="row">
                <div class="col-sm-3 invoice-col">
                  <b><?=($details->company_name == '')?'Address':'Hotel Name' ?></b><br>
                    <input type="text" name="address" class="form-control" value="<?=$details->address?>" required>
                   
                </div>
                <div class="col-sm-3 invoice-col">
                  <b><?=($details->company_name == '')?'State':'Hotel Address' ?></b><br>
                    <input type="text" name="state" class="form-control" value="<?=$details->state?>" required>
                </div>
                <div class="col-sm-3 invoice-col">
                  <b><?=($details->company_name == '')?'City':'Phone Number' ?></b><br>
                    <input type="text" name="city" class="form-control" value="<?=$details->city?>" required>
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                  <b><?=($details->company_name == '')?'Zip/Postal':'Room Number' ?></b><br>
                    <input type="text" name="zip" class="form-control" value="<?=$details->zip?>" required>
                  
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
                    <select class="form-control" name="covid_test">
                      <option value="1">Yes</option>
                      <option value="0" <?=($details->covid_test == "0")?'selected':''?>>No</option>
                    </select>

                  </address>
                </div>
                <?php if($details->covid_test == '1'){?>
                  <div class="col-sm-3">
                    <address>
                    <b>Test Type</b><br/>
                    <select name="covid_test_type" id="covid_test_type" class="form-control">
                    <option value="">Select Test Type</option>
                            <?php if($covid_test_type){ foreach($covid_test_type as $type){?>
                    <option value="<?php echo $type['id'];?>" data-price="<?php echo $type['price'];?>" data-additional="<?php echo $type['additional'];?>" <?=($type['id'] == $details->covid_test_type)?'selected':''?>>
                      <?php echo $type['name'].' ('.CURRENCY_SIGN.$type['price'].')';?></option>
                            <?php }}?>
                  </select>
                    <?php //echo $covid_test_type[$details->covid_test_type]["name"]?>
                  </address>
                  </div>
                  <div class="col-sm-3">
                    <b>Number of Test</b><br/>
                    <input type="text" class="form-control" value="<?php echo $details->covid_no_test?>" name="covid_no_test">
                    
                  </div>
                <?php } ?>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <address>
                  <b>Type of Appointment</b><br/>
                  <select class="form-control" name="appointment_type">
                    <option value="1">House Call</option>
                    <option value="2" <?=($details->appointment_type == '2')?'selected':''?>>Telemedicine</option>
                  </select>
                </address>
                </div>
                <?php if($details->appointment_type == '1'){?>
                  <div class="col-sm-3">
                    <address>
                    <b>House Call</b><br/>
                    <select class="form-control" name="house_call_visit">
                    <?php if($house_call_visit){foreach($house_call_visit as $house_visit){?>
                      <option value="<?php echo $house_visit['id'];?>" <?=($house_visit['id'] == $details->house_call_visit)?'selected':''?>><?php echo $house_visit['name'].' ('.CURRENCY_SIGN.$house_visit['price'].')';?></option>
  
    <?php }}?>
  </select>
                   
                  </address>
                  </div>
                  <div class="col-sm-3">
                    <b>Additional family member</b><br/>
                    <input type="text" class="form-control" name="house_call_additional_member" value="<?php echo $details->house_call_additional_member?>">
                    <?php //echo $details->house_call_additional_member?>
                  </div>
                <?php } ?>
                <!-- /.col -->
              </div>
            <?php } ?>
              
              <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                <strong>Reported Symptoms</strong><br />
                <textarea class="form-control" required><?php echo $details->symptoms?></textarea>
                
                </div>
              </div>
              <br>
              <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                <strong>Repeat</strong><br />
                <?php echo ($details->referal_firstname)?$details->referal_firstname.' '.$details->referal_lastname:'-'?>
                </div>
              </div>
              <!-- /.row -->
              <div class="row">
              <div class="col-md-12 text-center">
                <input class="bttn btn btn-primary" type="submit" name="Submit" value="Update" />  
              </div>
            </div>
        
            </section>
          </form>
    <br>

        <!-- /.content -->

    </div>
