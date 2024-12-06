

	<div class="FormPart p-3"><h4>My Profile</h4>
		<?php if($this->session->flashdata('message')){?>
      <div class="alert alert-primary">
        <?php echo $this->session->flashdata('message');?>
      </div>
      <?php }?>
		<input type="hidden" name="USER_DASHBOARD_PATH" value="<?php echo base_url().USER_DASHBOARD_PATH?>">
		<?php
		if($this->session->userdata(SESSION.'member_type') == '3'){
			?>
		<form method="post" id="companyProfileForm"> 
		<fieldset class="card mt-3"><h6 class="card-header">Company Details</h6>
				<div class="card-body bg-light">
					<div class="alert alert-success success-message" style="display: none;">
					</div>
					<div class="row">
						<div class="form-group col-sm-12"><label>Company Name<span class="text-danger">*</span></label>
							<input type="text" name="company_name" class="form-control"  value="<?=set_value('company_name',$profile->company_name);?>">
						</div>
						<?php /*
						<div class="form-group col-sm-6"><label>Case ID<span class="text-danger">*</span></label>
							<input type="text" name="company_reg_no" class="form-control"  value="<?=set_value('company_reg_no',$profile->company_reg_no);?>">
						</div> */?>
						<div class="form-group col-sm-6"><label>Address<span class="text-danger">*</span></label>
							<input type="text" name="company_addr" class="form-control"  value="<?=set_value('company_addr',$profile->company_addr);?>">
						</div>
						<div class="form-group col-sm-6"><label>State<span class="text-danger">*</span></label>
							<input type="text" name="company_state" class="form-control"  value="<?=set_value('company_state',$profile->company_state);?>">
						</div>
						<div class="form-group col-sm-6"><label>City<span class="text-danger">*</span></label>
							<input type="text" name="company_city" class="form-control"  value="<?=set_value('company_city',$profile->company_city);?>">
						</div>
						<div class="form-group col-sm-6"><label>Postal Code<span class="text-danger">*</span></label>
							<input type="text" name="company_postal_code" class="form-control"  value="<?=set_value('company_postal_code',$profile->company_postal_code);?>">
						</div>
						<div class="form-group col-sm-6"><label>Country<span class="text-danger">*</span></label>
							<select name="company_country" class="form-control" id="country">
								<option value="">Select Country </option>
	                      <?php foreach($countries as $country){?>
	                      <option value="<?php echo $country->id;?>" <?php echo ($country->id == $profile->company_country)?'selected':''; ?>><?php echo $country->country;?></option>
	                      <?php } ?>

	                    </select>
	                	</div>
						
					</div>
					<button class="btn btn-primary mt-2">Save Setting</button>
					<i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>

				</div>
			</fieldset>
		</form>
	<?php } //company details?>


		<form method="post" action="" id="profileForm">

			<fieldset class="card mt-3"><h6 class="card-header">User Setting</h6>
				<div class="card-body bg-light">
					<div class="alert alert-success success-message"  style="display: none;">
					</div>
					<div class="row">
					<div class="form-group col-sm-12">
						<label>Email Address<span class="text-danger">*</span></label>
						<input type="text" name="email" class="form-control" value="<?=set_value('email',$profile->email);?>">
						<?php echo form_error('email')?>
					</div>
					<?php /*
					<div class="col-md-5">
			<div class="form-group"><label>Date of Birth<span class="text-danger">*</span></label>
			<div class="row">
			<div class="col-sm-3 pr-0">
            		<select class="form-control" name="month" id="month">
                    	<option value="">Month</option>
                        <?php  for ($m=1; $m<=12; $m++) {
							 $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
							?>
							 <option value="<?=$m?>" <?=(date('m',strtotime($profile->dob))== $m)?'selected':''?>><?=$month?></option>
							 <?php }?>
                    </select>
            </div>
			<div class="col-sm-3 pr-0">
            	<select class="form-control" name="day" id="day">
                	<option value="">Day</option>
                    
                    	<?php  for ($val=1; $val<=31; $val++) {	?>						 
							 <option value="<?=$val;?>" <?=(date('d',strtotime($profile->dob)) == $val)?'selected':''?>><?=sprintf('%02d', $val);?></option>';
							 <?php }?>
                </select>
            </div>
			<div class="col-sm-3 pr-0">
            	<select class="form-control" name="year" id="year">
                	<option value="">Year</option>
                    	<?php for ($val=0; $val<=100; $val++) {?>
							 <option value="<?=(date('Y')-$val)?>" <?=(date('Y',strtotime($profile->dob)) == (date('Y')-$val))?'selected':''?>><?=(date('Y')-$val)?></option>';
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
				*/?>
				</div>




					<div class="row">
						<div class="form-group col-sm-6"><label>First Name<span class="text-danger">*</span></label>
							<input type="text" name="first_name" class="form-control"  value="<?=set_value('first_name',$profile->first_name);?>">
							<?php echo form_error('first_name')?>
						</div>
						<div class="form-group col-sm-6"><label>Last Name<span class="text-danger">*</span></label><input type="text" name="last_name" class="form-control" value="<?=set_value('last_name',$profile->last_name);?>"></div>
						<?php echo form_error('first_name')?>
					</div>
					<button class="btn btn-primary mt-2">Save Setting</button>
					<i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>

				</div>
			</fieldset>
		</form>		

		<form method="post" action="" id="profileAddressForm">
			<fieldset class="card mt-4"><h6 class="card-header">Contact Setting</h6>
				<div class="card-body bg-light">

					<div class="alert alert-success success-message"  style="display: none;">
					</div>
					<div class="form-group"><label>Phone No<span class="text-danger">*</span></label>
						<input type="text" name="phone" class="form-control" value="<?=set_value('phone',$profile->phone);?>">
					<?php echo form_error('phone')?>
				</div>

				<div class="row">
					<div class="form-group col-sm-6"><label>Address<span class="text-danger">*</span></label>
						<input type="text" name="address" class="form-control" value="<?=set_value('address',$profile->address);?>">
					</div>
					<div class="form-group col-sm-6"><label>Country<span class="text-danger">*</span></label>
							<select name="country" class="form-control" id="country">
								<option value="">Select Country </option>
	                      <?php foreach($countries as $country){?>
	                      <option value="<?php echo $country->id;?>" <?php echo ($country->id == $profile->country)?'selected':''; ?>><?php echo $country->country;?></option>
	                      <?php } ?>

	                    </select>
	                	</div>
				</div>
					
					<div class="row">
						<div class="form-group col-sm-4"><label>State<span class="text-danger">*</span></label>
							<input type="text" name="state" class="form-control" value="<?=set_value('city',$profile->state);?>">
						</div>
						<div class="form-group col-sm-4"><label>City<span class="text-danger">*</span></label>
							<input type="text" name="city" class="form-control" value="<?=set_value('city',$profile->city);?>">
						</div>
						<div class="form-group col-sm-4"><label>Zip/Postal<span class="text-danger">*</span></label>
							<input type="text" name="post_code" class="form-control" value="<?=set_value('post_code',$profile->post_code);?>">
						</div>
						
					</div>
					<button class="btn btn-primary mt-2">Save Setting</button>
					<i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
				</div>
			</fieldset>

			<fieldset class="card"><h6 class="card-header"><a href="" data-toggle="modal" data-target="#changePassword"> Change Password</a></h6>
				
			</fieldset>
			
		</form>

	</div>


<!-- Modal -->
				<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePassword" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-body">
				        <form class="p-4" id="updatePasswordForm">
				        	<h5 class="mt-0 mb-4">Change Password</h5>
				        	<div class="alert alert-success success-message"  style="display: none;">
							</div>
							<div class="alert alert-danger error-message" style="display: none;">
							</div>
				          <div class="form-group">
				          	<input type="password" name="old_password" placeholder="Old Password" class="form-control">
				          </div>
				          <div class="form-group">
				          	<input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
				          </div>
				          <div class="form-group mb-4">
				          	<input type="password" name="re_password" placeholder="Confirm New Password" class="form-control">
				          </div>
				          <button class="btn btn-primary"> Submit</button>
				          <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
				        </form>
				      </div>
				    </div>
				  </div>
				</div>

<script type="text/javascript">
    var urlCheckDuplicateEmail='<?php echo base_url('my-account/user/email_taken') ?>';
</script>
