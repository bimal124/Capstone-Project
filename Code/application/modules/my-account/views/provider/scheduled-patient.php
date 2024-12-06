	<div class="FormPart p-3">
		<h4>All Request</h4>
	<div class="mt-3 bg-light">
		<?php if($this->session->flashdata('message')){?>
      <div class="alert alert-primary">
        <?php echo $this->session->flashdata('message');?>
      </div>
      <?php }?>
		<table class="table mb-0">
		  <thead>
		    <tr>       
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Symtopms</th>
		      <th scope="col">Location</th>
		      <th scope="col">DOB</th>
		      <th scope="col">Date</th>
		      <th scope="col">Status</th>
		      <th scope="col" width="20%">Action</th>
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
		      <td><?php echo the_time($value->appointment_date).'<br/> '.the_date($value->appointment_date)?></td>
		      <td><?php 
		      if($value->visit_status == 1){
		      	echo '<span class="badge badge-warning">Ongoing</span>';
		      }else if($value->visit_status == 2){
		      	echo '<span class="badge badge-success">Success</span>';
		      }else{
		      	echo '<span class="badge badge-danger">Declined</span>';
		      }
		      ?></td>
		      <td>
		      	<?php 
		      if($value->visit_status != 3){?>
		      	<a href="<?php the_permalink('my-account/report/update/'.$value->id)?>" class="btn btn-primary btn-sm">Update</a>
		      	<?php if($value->report_details && !empty($value->report_details)){ ?>
		      	<a href="<?php the_permalink('my-account/report/download_report/'.$value->id)?>" class="btn btn-primary btn-sm" title="Download"><i class="fa fa-download"></i></a>

		      	<a href="<?php the_permalink('my-account/report/view/'.$value->id)?>" class="btn btn-success btn-sm">View</a>
		      <?php } ?>
		      <?php 
		      if($value->visit_status == 2 && $value->member_type == 3){
		      	?>
		      	<a href="" class="btn btn-warning text-blue btn-sm share-report" title="<?=($value->send == 1)?'Share Again':'Share Report'?>" data-patient_id="<?php echo $value->id?>"><i class="fa fa-share-square-o"></i></a>
		      <?php } ?>

		      <?php }?>
		    </tr>
		<?php } }else{
			echo "<tr><td>No any data found</tr></tr>";
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
<input type="hidden" name="base_url" value="<?php echo base_url()?>">
