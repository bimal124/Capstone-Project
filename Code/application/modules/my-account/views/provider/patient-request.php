	<div class="FormPart p-3"><h4>All Request</h4>

	<div class="mt-3 bg-light">
	<div class="table-responsive">
		<table class="table mb-0">
		  <thead>
		    <tr>      
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Symtopms</th>
		      <th scope="col">Location</th>
		      <th scope="col">DOB</th>
		      <th scope="col">Request Date</th>
		      <!-- <th scope="col" width="15%">Action</th> -->
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
		  	if(!empty($result_data)){
		  		foreach ($result_data as $key => $value) {
		  			?>
		    <tr>
		     <td><?=$key+1?></td>
		      <td scope="row"><?php echo $value->name.' '.$value->last_name?></td>
		      <td><?php echo $value->symptoms?></td>
		      <td><?php echo $value->address?></td>
		      <td><?php echo the_date($value->dob)?></td>
		      <td><?php echo the_time($value->created_at).'<br/> '.the_date($value->created_at)?></td>
		      <!-- <td><a href="" class="btn btn-primary btn-sm schedulePatient" data-patient_id="<?php echo $value->id?>">Accept</a>
		      <a href="" class="btn btn-danger btn-sm declinePatient" data-patient_id="<?php echo $value->id?>">Decline</a></td> -->
		    </tr>
		<?php } }else{
			echo "<tr><td colspan='6'>No any data found</tr></tr>";
		}?>
		  </tbody>
		</table>
		<?php
                if($links)
                {
                    echo $links;
                }
            ?>
	</div>
</div>

<input type="hidden" name="MY_ACCOUNT_URL" value="<?php echo base_url('my-account')?>">
<div class="modal fade" id="SchedulePop" tabindex="-1" role="dialog" aria-labelledby="Schedule" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form class="p-4" id="schedulePatientForm">
        	<input type="hidden" name="patient_id">
        	<h5 class="mt-0 mb-4">Schedule</h5>
        	<div class="alert alert-success success-message" style="display: none;">
			</div>
          <div class="form-group"><label>Select Date</label>
          	<input type="text" name="appointment_date" class="form-control" id='datetimepicker1'></div>
          <div class="form-group"><button class="btn btn-secondary btn-block btn-submit"> Confirm</button></div>
          <button class="btn btn-secondary btn-block" data-dismiss="modal" aria-label="Close" type="button"> Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>