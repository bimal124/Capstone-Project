<div class="FormPart p-3"><h4>New Appoinment</h4>
		<fieldset class="card mt-3">
			<div class="card-body bg-light">
				<div class="form-group col-sm-6">
<div class="profileInfo">
	<input type="checkbox" name="" id="profileInfo">
	<label class="form-check-label" for="profileInfo">Use from profile</label>
</div>
				</div>
		<?php
		$this->load->view('common/appointment-form');
		?>
	</div>
</fieldset>
	</div>
	<script>
		var user_info = {
			email: '<?php echo $user_info->email?>',
			first_name: '<?php echo $user_info->first_name?>',
			last_name: '<?php echo $user_info->last_name?>',
			phone: '<?php echo $user_info->phone?>',
			address: '<?php echo $user_info->address?>',
			city: '<?php echo $user_info->city?>',
			state: '<?php echo $user_info->state?>',
			post_code: '<?php echo $user_info->post_code?>',
			day: '<?php echo ltrim(date("d",strtotime($user_info->dob)),0);?>',
			month: '<?php echo ltrim(date("m",strtotime($user_info->dob)),0);?>',
			year: '<?php echo date("Y",strtotime($user_info->dob));?>',
		};
	</script>