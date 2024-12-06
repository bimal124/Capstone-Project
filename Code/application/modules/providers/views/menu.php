<div class="row filter-sec" >

	<div class="col-lg-12 data-search-inputs" style="padding-top:10px">

		<div class="col-md-6">

			<a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/members/add_member'); ?>" id="select-all-mem" class="btn btn-sm btn-success" title="Add Patient">Add Patient</a>

		</div>



		<div class="col-md-6 form-group text-right">

			<?php

			if($this->uri->segment(3)=='edit_member'){

				?>

				<a href="#" class="btn btn-sm btn-default" title="Edit Member"><i class="fa fa-list"></i> Edit Member</a>

				<?php

			} else { 

				?>

				<a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/members/edit_member/active/'.$this->uri->segment(5));?>" class="btn btn-sm btn-primary" title="Edit Member"><i class="fa fa-list"></i> Edit Member</a>

				<?php

			}

			?>



			<?php

			if($this->uri->segment(3)=='transaction'){

				?>

				<a href="#" class="btn btn-sm btn-default" title="Transaction"><i class="fa fa-list"></i> Transaction</a>

				<?php

			} else { 

				?>

				<a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/members/transaction/active/'.$this->uri->segment(5));?>" class="btn btn-sm btn-primary" title="Transaction"><i class="fa fa-list"></i> Transaction</a>

				<?php

			}

			?>



			<?php

			if($this->uri->segment(3)=='bids'){

				?>

				<a href="#" class="btn btn-sm btn-default" title="Bidding Info"><i class="fa fa-list"></i> Bidding Info</a>

				<?php

			} else { 

				?>

				<a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/members/bids/active/'.$this->uri->segment(5));?>" class="btn btn-sm btn-primary" title="Bidding Info"><i class="fa fa-list"></i> Bidding Info</a>

				<?php

			}

			?>



			<?php

			if($this->uri->segment(3)=='add_balance'){

				?>

				<a href="#" class="btn btn-sm btn-default" title="Add Balance"><i class="fa fa-list"></i> Add Balance</a>

				<?php

			} else { 

				?>

				<a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/members/add_balance/active/'.$this->uri->segment(5));?>" class="btn btn-sm btn-primary" title="Add Balance"><i class="fa fa-list"></i> Add Balance</a>

				<?php

			}

			?>                            

		</div>    

	</div>

</div>