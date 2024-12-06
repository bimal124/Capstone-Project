<form action="" method="post" id="bookAppointCompany" class="p-3">
	
	<?php if($this->session->flashdata('message')){?>
      <div class="alert alert-primary">
        <?php echo $this->session->flashdata('message');?>
      </div>
      <?php }?>
      <div class="alert alert-primary success-message" style="display: none;">
      </div>
      <div class="alert alert-danger error-message" style="display: none;">
      </div>
	<div class="section-1">
	<hr class="hr-big mt-0">
	<?php 
	$company_name = isset($user_info->company_name)?$user_info->company_name:'';
	$company_email = isset($user_info->email)?$user_info->email:'';
	?>
	<input type="hidden" name="company_email" value="<?php echo $company_email?>">
	<div class="form-group"><label>Name of Company<span class="text-danger">*</span></label>
		<input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo set_value('company_name',$company_name)?>">
		<?php echo form_error('company_name'); ?>
	</div>
	
	<label>Name of Patient<span class="text-danger">*</span></label>
	<div class="row">
	
		<div class="form-group col-sm-6">
			<input type="text" name="name"  class="form-control" placeholder="First Name" value="<?php echo set_value('name');?>" required>
			<?php echo form_error('name'); ?>
		</div>
		<div class="form-group col-sm-6">
			<input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo set_value('last_name');?>">
			<?php echo form_error('last_name'); ?>
		</div>
	</div>
	<div class="form-group"><label>Reference Number<span class="text-danger">*</span></label>
		<input type="text" name="reference_num" id="reference_num" class="form-control" value="<?php echo set_value('reference_num')?>">
		<?php echo form_error('reference_num'); ?>
	</div>
	<!-- <hr class="hr-big mt-0">
	<label>Patient Information</label>
	<br/> -->
	<div class="row">
	
			<div class="form-group col-md-12"><label>Hotel Name (if this is a Hotel Name please type the name here)</label>
				<input type="text" name="address" class="form-control mb-3" placeholder="Hotel Name" value="<?=set_value('address')?>">
				<?php echo form_error('address')?>
				<!-- <input type="text" name="address2" class="form-control mb-3" placeholder="Hotel Address" value="<?=set_value('address2')?>">
				<?php echo form_error('address2')?> -->
			<div class="row">
				<div class="form-group col-sm-4">
					<input type="text" name="city" class="form-control" placeholder="Address" value="<?=set_value('city')?>">
					<?php echo form_error('city')?>
				</div>
				<div class="form-group col-sm-3">
					<input type="text" name="hotel_city" class="form-control" placeholder="City" value="<?=set_value('hotel_city')?>">
					<?php echo form_error('hotel_city')?>
				</div>
				<div class="form-group col-sm-3">
					<input type="text" name="hotel_state" class="form-control" placeholder="State" value="<?=set_value('hotel_state')?>">
					<?php echo form_error('hotel_state')?>
				</div>
				
				<div class="form-group col-sm-2">
					<input type="text" name="hotel_zip" class="form-control" placeholder="Zip / Postal" value="<?=set_value('hotel_zip')?>">
					<?php echo form_error('hotel_zip')?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<input type="text" name="state" class="form-control" placeholder="Phone Number" value="<?php echo set_value('state')?>">
					<?php echo form_error('state')?>
				</div>
				<div class="col-sm-3">
					<input type="text" name="zip" class="form-control" placeholder="Room Number" value="<?php echo set_value('zip')?>">
					<?php echo form_error('zip')?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-12"><label>Patient's Phone Number</label>
			<input type="text" name="phone" value="<?php echo set_value('phone')?>" class="form-control">
			<?php echo form_error('phone'); ?>
		</div>
		<div class="form-group col-sm-12"><label>Patient's Email</label>
			<input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email')?>">
			<?php echo form_error('email'); ?>
		</div>
		<div class="col-md-6">
			<div class="form-group"><label>Date of Birth<span class="text-danger">*</span></label>
			<div class="row">
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
		<div class="form-group col-sm-6">
			<label>Gender</label><br>
			<input type="radio" name="gender" id="male" checked value="Male"> <label for="male">Male</label>
			<input type="radio" name="gender" id="female" value="Female"> <label for="female">Female</label>
			<input type="radio" name="gender" id="other" value="Other"> <label for="other">Other</label>
		</div>
		<div class="form-group col-sm-12"><label>Condition/ Reason for appointment<span class="text-danger">*</span></label>
		<textarea name="symptoms" rows="5" class="form-control" required=""><?php echo set_value('symptoms')?></textarea>
		</div>
	</div>
	If patient needs medical clearance to take flight; check here: <input type="checkbox" name="need_flight" value="1"> 
	
	<input type="hidden" name="user_id" value="<?php echo ($this->uri->segment(1) == 'book-appointment-now')?'0':$this->session->userdata(SESSION.'user_id')?>">
		
	<input type="hidden" name="base_url" value="<?php echo base_url()?>">


<div class="button mt-5">
	<button class="btn btn-dark btn-sm float-right btn-booking">Complete Booking</button>
<div class="clearfix"></div>
</div>

</div><!-- form section one -->


</form>
