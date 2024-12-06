<form action="" method="post" name="bookAppoint" id="bookAppoint" class="p-3">
	<?php if($this->session->flashdata('message')){?>
      <div class="alert alert-primary">
        <?php echo $this->session->flashdata('message');?>
      </div>
      <?php }?>
      <div class="alert alert-primary success-message" style="display: none;"></div>
      <div class="alert alert-danger error-message" style="display: none;"></div>
	<div class="section-1">
	<hr class="hr-big mt-0">
	<label>Patient Name<span class="text-danger">*</span></label>
	<div class="row">
	<div class="form-group col-sm-6">
		<input type="text" name="name"  class="form-control" placeholder="First Name" value="<?php echo set_value('name');?>" required>
		<?php echo form_error('name'); ?>
	</div>
	<div class="form-group col-sm-6">
		<input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo set_value('last_name');?>">
		<?php echo form_error('last_name'); ?>
	</div>
	<div class="form-group col-sm-6"><label>Phone number<span class="text-danger">*</span></label>
		<input type="text" name="phone" value="<?php echo set_value('phone')?>" class="form-control">
		<?php echo form_error('phone'); ?>
	</div>
	<div class="form-group col-sm-6">
		<label>Gender</label><br>
		<input type="radio" name="gender" id="male" checked value="Male"> <label for="male">Male</label>
		<input type="radio" name="gender" id="female" value="Female"> <label for="female">Female</label>
		<input type="radio" name="gender" id="other" value="Other"> <label for="other">Other</label>
	</div>
	</div>

	<div class="form-group"><label>Email<span class="text-danger">*</span></label>
		<input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email')?>">
		<?php echo form_error('email'); ?>
	</div>

	<div class="form-group"><label>Confirm Email<span class="text-danger">*</span></label>
		<input type="email" name="cemail" id="cemail" class="form-control" value="<?php echo set_value('cemail')?>">
		<?php echo form_error('cemail'); ?>
	</div>

	<div class="row">
		<div class="col-lg-7">		
		<div class="form-group"><label>Condition/ Reason for appointment<span class="text-danger">*</span></label>
		<textarea name="symptoms" rows="5" class="form-control"><?php echo set_value('symptoms')?></textarea>
		</div>
	</div>
		<div class="col-lg-5">
			<div class="form-group"><label>Date of Birth<span class="text-danger">*</span></label>
			<div class="row dateList">
			<div class="col-sm-3 pr-0">
            		<select class="form-control" name="month" id="month">
                    	<option value="">Month</option>
                        <?php  for ($m=1; $m<=12; $m++) {
							 $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
							?>
							 <option value="<?=$m?>" <?=(set_value('month') == $m)?'selected':''?>><?=$month?></option>
							 <?php }?>
                    </select>
            </div>
			<div class="col-sm-3 pr-0">
            	<select class="form-control" name="day" id="day">
                	<option value="">Day</option>
                    	<?php  for ($val=1; $val<=31; $val++) {	?>						 
							 <option value="<?=$val;?>" <?=(set_value('day') == $val)?'selected':''?>><?=sprintf('%02d', $val);?></option>';
							 <?php }?>
                </select>
            </div>

			<div class="col-sm-3 pr-0">
            	<select class="form-control" name="year" id="year">
                	<option value="">Year</option>
                    	<?php for ($val=0; $val<=100; $val++) {?>
							 <option value="<?=(date('Y')-$val)?>" <?=(set_value('year') == (date('Y')-$val))?'selected':''?>><?=(date('Y')-$val)?></option>';
							<?php  }
						?>
                 </select></div>
			<div class="col-sm-3"><div class="input-group datePicker" id="date_picker">
                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
                </span>
                <input name="dob" id="datepicker" type="hidden" class="form-control valid" value="" size="20" autocomplete="off">
              </div></div>
			</div>
			</div>
		</div>
	</div>


	<div class="form-group">
		<div><label>DO YOU REQUIRE COVID TESTING? <span class="text-danger">*</span></label></div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input covid_test" type="radio" name="covid_test" id="inlineRadio1" value="1" <?=(set_value('covid_test') == 1)?'checked':''?>>
		  <label class="form-check-label" for="inlineRadio1">Yes</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input covid_test" type="radio" name="covid_test" id="inlineRadio2" value="0" <?=(set_value('covid_test') != 1)?'checked':''?>>
		  <label class="form-check-label" for="inlineRadio2">No</label>
		</div>
	</div>

		<div class="row" style="<?=(set_value('covid_test') == 1)?'':'display:none'?>;" id="covid_test_form">
			<div class="col-md-6"><label>Test Type<span class="text-danger">*</span></label>
			<select name="covid_test_type" id="covid_test_type" class="form-control"  required="required">
				<option value="">Select Test Type</option>
                <?php if($covid_test_type){ foreach($covid_test_type as $type){?>
				<option value="<?php echo $type['id'];?>" data-price="<?php echo $type['price'];?>" data-additional="<?php echo $type['additional'];?>" <?=set_value('covid_test_type') == $type['id']?'selected':''?>>
					<?php echo $type['name'].' ('.CURRENCY_SIGN.$type['price'].')';?></option>
                <?php }}?>
			</select>
			</div>

			<div class="col-md-3 col-sm-6"><label>Number of Test</label>			
            <select name="covid_no_test" id="covid_no_test" class="form-control"  required="required">
				<option value="1">1</option>
                <option value="2" <?=set_value('covid_no_test') == '2'?'selected':''?>>2</option>
                <option value="3" <?=set_value('covid_no_test') == 3?'selected':''?>>3</option>
                <option value="4" <?=set_value('covid_no_test') == 4?'selected':''?>>4</option>
            </select>
			</div>
			<div class="col-md-3 col-sm-6"><label>Price ($)</label>
			<input type="text" name="covid_test_price" id="covid_test_price" class="form-control mb-3"  required="required" readonly="readonly" value="<?php echo set_value('covid_test_price',0)?>">
			</div>
		</div>

<hr class="hr-big">
	<label>Type of Appointment<span class="text-danger">*</span></label>
	<div class="row mb-3">
		<div class="col-sm-6">
			<div class="form-check">
			  <input class="form-check-input appointment_type" type="radio" name="appointment_type" data-price="<?php echo DEFAULT_HOUSE_VISIT_COST;?>" id="exampleRadios1" value="1" checked>
			  <label class="form-check-label fs-large" for="exampleRadios1">House Call</label>
			</div>
		</div>
		<!-- <div class="col-sm-6">
			<div class="form-check">
			  <input class="form-check-input appointment_type" type="radio" name="appointment_type" data-price="<?php echo TELEMEDICINE;?>" id="exampleRadios2" value="2" <?php echo (set_value('appointment_type') == 2)?'checked':''?>>
			  <label class="form-check-label fs-large" for="exampleRadios2">Telemedicine</label>
			</div>
		</div> -->
	</div>
<div class="first appointment_type_option" style="<?=set_value('appointment_type') == 2?'display:none':''?>">
	<h5>House Calls</h5>
    <?php if($house_call_visit){foreach($house_call_visit as $house_visit){?>
	<div class="form-check">
	  <input class="form-check-input house_call_visit" data-price="<?php echo $house_visit['price'];?>" data-additional="<?php echo $house_visit['additional'];?>" type="radio" name="house_call_visit" value="<?php echo $house_visit['id'];?>" <?php if($house_visit['id'] == set_value('house_call_visit') || $house_visit['id'] == 1){ echo 'checked';}?>>
	  <label class="form-check-label"><?php echo $house_visit['name'].' ('.CURRENCY_SIGN.$house_visit['price'].')';?></label>
	</div>
    <?php }}?>
	
	<div class="form-check">
	<span class="small">For Outside of Kathmandu; please call +977-1-554756</span>
	</div>
</div>

<div class="row mt-4">
	<div class="col-md-6 form-group"><label>Total price for services and members booked :</label><input name="total_amount" value="<?php echo set_value('total_amount',DEFAULT_HOUSE_VISIT_COST);?>" id="total_amount" type="text" class="form-control" readonly="readonly"></div>
	<div class="col-md-6 form-group appointment_type_option" style="<?=set_value('appointment_type') == 2?'display:none':''?>">
		<label>Additional family member (Rs. 1250 each)</label>
    	<select name="house_call_additional_member" id="house_call_additional_member" class="form-control"  required="required">
				<option value="0">0</option>
                <option value="1" <?=set_value('house_call_additional_member') == 1?'selected':''?>>1</option>
                <option value="2" <?=set_value('house_call_additional_member') == 2?'selected':''?>>2</option>
                <option value="3" <?=set_value('house_call_additional_member') == 3?'selected':''?>>3</option>
                <option value="4" <?=set_value('house_call_additional_member') == 4?'selected':''?>>4</option>
            </select>
    </div>
	</div>

	<div class="row mt-3">
		<div class="col-md-7">		
			<div class=""><label>Appointment Address (please include apartment / office number or hotel room number when applicable)<span class="text-danger">*</span></label>
				<input type="text" name="address" class="form-control mb-3" placeholder="Address Line 1" value="<?=set_value('address')?>">
				<?php echo form_error('address')?>
				<input type="text" name="address2" class="form-control mb-3" placeholder="Address Line 2" value="<?=set_value('address2')?>">
				<?php echo form_error('address2')?>
			<div class="row">
				<div class="col-sm-5 form-group">
					<input type="text" name="city" class="form-control" placeholder="City" value="<?=set_value('city')?>">
					<?php echo form_error('city')?>
				</div>
				<div class="col-sm-4 form-group">
					<input type="text" name="state" class="form-control" placeholder="State/Province" value="<?php echo set_value('state')?>">
					<?php echo form_error('state')?>
				</div>
				<div class="col-sm-3 form-group">
					<input type="text" name="zip" class="form-control" placeholder="ZIP / Postal" value="<?php echo set_value('zip')?>">
					<?php echo form_error('zip')?>
				</div>
			</div>
			</div>
		</div>

		<div class="col-md-5">
			<div class="form-group"><label>How did you hear about us?<span class="text-danger">*</span></label>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="how_find_us" value="Google search" id="howfind1" checked="">
			  <label class="form-check-label" for="howfind1">Google search</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="how_find_us" value="Facebook/ referral" id="howfind2" <?=(set_value('how_find_us') == 'Facebook/ referral')?'checked':''?>>
			  <label class="form-check-label" for="howfind2">Facebook/ referral</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="how_find_us" value="Referral/ other" id="howfind3" <?=(set_value('how_find_us') == 'Referral/ other')?'checked':''?>>
			  <label class="form-check-label" for="howfind3">Referral/ other</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="how_find_us" value="Friend" id="howfind4" <?=(set_value('how_find_us') == 'Friend')?'checked':''?>>
			  <label class="form-check-label" for="howfind4">Friend</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="how_find_us" value="Repeat Patient" id="howfind5" <?=(set_value('how_find_us') == 'Repeat Patient')?'checked':''?>>
			  <label class="form-check-label" for="howfind5">Repeat Patient</label>
			</div>
				</div>
				<?php /*
				<label>Tell us your friend's name and they will get $30 off next time they book a DrSathi appointment</label>
				<input type="text" class="form-control" placeholder="" name="referral" value="<?=set_value('referral')?>">
				*/?>
		</div>
	</div>

<div class="button mt-5">
	<a class="btn btn-dark btn-sm float-right btn-next text-light">Next</a>
<div class="clearfix"></div>
</div>
<div class="progress mt-3">
  <div class="progress-bar" role="progressbar" style="width:50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Progress</div>
</div>
</div><!-- form section one -->

<div class="section-2" style="display: none;">
	 <div class="text-page">
		<hr class="hr-big">
		<!--<label>Credit Card<span class="text-danger">*</span></label>
			<div class="row form-group">
				<div class="col-sm-5">
					<img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 15 10'%3E%3Cg fill='%23CFD4D8'%3E%3Cpath d='M15 2v-.5c0-.85-.65-1.5-1.5-1.5h-12C.65 0 0 .65 0 1.5V2h15zM0 2.5h15v1H0zM0 4v4.5C0 9.35.65 10 1.5 10h12c.85 0 1.5-.95 1.5-1.75V4H0zm2.25 2.5h2.5c.15 0 .25.1.25.25S4.9 7 4.75 7h-2.5C2.1 7 2 6.9 2 6.75s.1-.25.25-.25zm4 1.5h-4C2.1 8 2 7.9 2 7.75s.1-.25.25-.25h4c.15 0 .25.1.25.25S6.4 8 6.25 8z'/%3E%3C/g%3E%3C/svg%3E" class="card-image" style="position:absolute;top:10px;width:25px;left:20px;height:15px; ">
					<input type="hidden" name="card_type">
					<input type="text" name="card_number" class="form-control card_number" placeholder="Card Number" required="required" value="<?=set_value('card_number')?>" style="padding-left: 35px;">
					<?=form_error('card_number')?>
				</div>
				<div class="col-sm-2">
					<select class="form-control" name="card_month" required="">
					<option value="">MM</option>
					<?php  for ($m=1; $m<=12; $m++) {
							?>
							 <option value="<?=$m?>" <?=set_value('card_month') == $m?'selected':''?>><?php echo sprintf("%02d", $m)?></option>
							 <?php }?>
					</select>
					<?=form_error('card_month')?>
				</div>
				<div class="col-sm-2"><select class="form-control" name="card_year" required="">
					<option value="">YY</option>
					<?php  
					$year = date('Y');
					for ($m=$year; $m<=$year+10; $m++) {
							?>
							 <option value="<?=$m?>" <?=set_value('card_year') == $m?'selected':''?>><?php echo sprintf("%02d", $m)?></option>
							 <?php }?>
					</select>
					<?=form_error('card_year')?>
				</div>
				<div class="col-sm-3">
					<input type="text" name="cvc" class="form-control cvc" placeholder="CVC" required="required" maxlength="4" minlength="3" pattern="\d{4}" value="<?=set_value('cvc')?>">
					<?=form_error('cvc')?>
				</div>
			</div>

		<label>Card Holder Name<span class="text-danger">*</span></label>
		<div class="row">
			<div class="form-group col-sm-6">
				<input type="text" name="billing_name" class="form-control" placeholder="First Name" required="required" value="<?=set_value('billing_name')?>">
				<?=form_error('billing_name')?>
			</div>
			<div class="form-group col-sm-6">
				<input type="text" name="billing_last_name" class="form-control" placeholder="Last Name" required="required" value="<?=set_value('billing_last_name')?>">
				<?=form_error('billing_last_name')?>
			</div>
		</div>-->

		<h4>Payment Method</h4>
		<p><strong>Payment will be collected after the service is completed.</strong></p>
	</div> 

		

	<div class="form-check mb-5">
	  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
	  <label class="form-check-label" for="defaultCheck1">Same as previous?</label>
	</div>

	<div class="row">
			<div class="form-group col-sm-6">
				<input type="text" name="billing_name" class="form-control" placeholder="First Name" required="required" value="<?=set_value('billing_name')?>">
				<?=form_error('billing_name')?>
			</div>
			<div class="form-group col-sm-6">
				<input type="text" name="billing_last_name" class="form-control" placeholder="Last Name" required="required" value="<?=set_value('billing_last_name')?>">
				<?=form_error('billing_last_name')?>
			</div>
		</div>	
	<div class="form-group"><label>Billing Address<span class="text-danger">*</span></label>
			<input type="text" class="form-control mb-3" placeholder="Address Line 1" name="billing_address" required="" value="<?=set_value('billing_address')?>">
			<?=form_error('billing_address')?>
			<input type="text" class="form-control mb-3" placeholder="Address Line 2" name="billing_address2" value="<?=set_value('billing_address2')?>">
			<?=form_error('billing_address2')?>
		<div class="row">
			<div class="col-sm-5 form-group">
				<input type="text" class="form-control" placeholder="City" name="billing_city" required="" value="<?=set_value('billing_city')?>">
				<?=form_error('billing_city')?>
			</div>
			<div class="col-sm-4 form-group">
				<input type="text" class="form-control" placeholder="State/Province" name="billing_state" required="" value="<?=set_value('billing_state')?>">
				<?=form_error('billing_state')?>
			</div>
			<div class="col-sm-3 form-group">
				<input type="text" class="form-control" placeholder="ZIP / Postal" name="billing_zip" required="" value="<?=set_value('billing_zip')?>">
				<?=form_error('billing_zip')?>
			</div>
		</div>
		</div>
		<input type="hidden" name="user_id" value="<?php echo ($this->uri->segment(1) == 'book-appointment-now')?'0':$this->session->userdata(SESSION.'user_id')?>">
	<div class="button mt-5">
		<a class="btn btn-dark btn-sm float-left text-light btn-prev">Go back</a>
		<button class="btn btn-dark btn-sm float-right btn-booking">Complete Booking</button>
	<div class="clearfix"></div>
	</div>
<input type="hidden" name="base_url" value="<?php echo base_url()?>">
	<div class="progress mt-3">
	  <div class="progress-bar" role="progressbar" style="width:100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Progress</div>
	</div>
</div><!-- Form section payment -->
</form>