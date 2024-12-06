	<div class="FormPart p-3">
		<h4>
			<?php 
		  	echo ($this->session->userdata(SESSION.'member_type') == '3')?"All Orders":"Transaction History";
		  	?>
		</h4>

	<div class="mt-3 bg-light">
		<?php if($this->session->flashdata('message')){?>
      <div class="alert alert-primary">
        <?php echo $this->session->flashdata('message');?>
      </div>
      <?php }?>
      	<div class="table-responsive">
		<table class="table mb-0">
		  <thead>
		  	<?php 
		  	if($this->session->userdata(SESSION.'member_type') == '3'){
		  		?>
		    <tr>       
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Symtopms</th>
		      <th scope="col">Location</th>
		      <th scope="col">DOB</th>
		      <th scope="col">Date</th>
		      <th scope="col">Payment</th>
		    </tr>
		<?php }else{ ?>
			<tr>       
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Amount</th>
		      <th scope="col">Reference Number</th>
		      <th scope="col">Payment Mode</th>
		      <th scope="col">Date</th>
		      <th scope="col">Status</th>
		      <th scope="col">Action</th>
		    </tr>
		<?php } ?>
		  </thead>
		  <tbody>
		  	<?php 
		  	if(!empty($result_data)){
		  		foreach ($result_data as $key => $value) {
		  		if($this->session->userdata(SESSION.'member_type') == '3'){
		  		?>
		    <tr>
		     <td><?=$key+1?></td>
		      <td scope="row"><?php echo $value->name.' '.$value->last_name?></td>
		      <td><?php echo $value->symptoms?></td>
		      <td><?php echo $value->address?></td>
		      <td><?php echo the_date($value->dob)?></td>
		      <td><?php echo the_time($value->post_date).' '.the_date($value->post_date)?></td>
		      <td><?php echo CURRENCY_SIGN.$value->total_amount?></td>
		    </tr>
		<?php }else{ ?>
			<tr>
		     <td><?=$key+1?></td>
		      <td scope="row"><?php echo $value->name.' '.$value->last_name?></td>
		      <td><?php echo CURRENCY_SIGN.$value->total_amount?></td>
		      <td><?php echo $value->reference_num?></td>
		      <td>Credit Card</td>
		      <td><?php echo the_date($value->post_date)?></td>
		      <td><?php if($value->visit_status == '0'){
		      	echo 'Pending';
		      }else if($value->visit_status == '1'){
		      	echo 'Accepted';
		      }else if($value->visit_status == '2'){
		      	echo 'Success';
		      }else{
		      	echo 'Declined';
		      } ?></td>
		      <td>
		      	<?php if($value->visit_status == 2){ ?>
		      	<a href="<?php the_permalink('my-account/user/report/'.$value->id)?>" class="btn btn-primary btn-sm">View Report</a>
		      <?php }else echo '-';?>
		      </td>
		    </tr>
		<?php } } }else{
			echo "<tr><td>No any data found</tr></tr>";
		?>
	<?php } ?>
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
</div>

