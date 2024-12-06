<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            <?php echo $modules_name; ?>

        </h1>      

        <?php echo $this->breadcrumb->output(); ?>

    </section>

    <!-- Main content -->

    <section class="content">

        <?php if ($this->session->flashdata('message')) { ?>

            <div class="alert alert-success alert-dismissible">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('message'); ?></h4>

            </div>

        <?php } ?>

        <div class="alert alert-success alert-dismissible" id="msgSuccess" style="display:none;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4><i class="icon fa fa-check"></i> <span id="successMsg"></span></h4>

        </div>

        <div class="alert alert-danger alert-dismissible" id="msgError" style="display:none;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4><i class="icon fa fa-check"></i> <span id="errorMsg"></span></h4>

        </div>

        <div class="box">

            <div class="box-header with-border">

                <h3 class="box-title"><?php echo $modules_heading; ?></h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body no-padding" >
                 <div class="row">

                <form id="form1" name="form1" method="post" action="">

                    <div class="col-lg-12 data-search-inputs" style="padding-top:10px">

                        <div class="col-lg-12" >

                            <div class="col-lg-5 search-box" >

                                <div class="row">

                                    <div class="col-md-12">

                                        Search

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-9">

                                        <div class="form-group">

                                            <input type="text" class="form-control" name="srch" id="srch" placeholder="Search by Name/Contact/Email">

                                        </div>

                                    </div>
                                    
                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <input type="submit" class="btn btn-primary" name="Search" id="search" value="Search">

                                        </div>

                                    </div>

                                </div>

                            </div>                            

                        </div>

                    </div>

                </form>

            </div>
                

            <div class="row" >

                <div class="col-lg-12">

                    <div class="col-lg-12">

                        <table class="table table-striped">

                            <thead>

                                <tr>

                                    <th align="left"><div align="left">Date</div></th>

                                    <th align="left"><div align="left">Name</div></th>

                                    <th align="center"><div align="left">Symptoms</div></th>

                                    <th align="center"><div align="left">Location </div></th>
                                    
                                    <th align="center"><div align="center">Age</div></th>
                                    <th align="center"><div align="center">Company</div></th>
                                    <th align="center"><div align="center">Referral</div></th>

                                    <th colspan="2" align="center" style="border-right:none;" width="10%"><div align="center">Options</div></th>

                                </tr>



                            </thead>

                            <tbody class="item-display-container">

                                <?php

										$i = 1;
		
										if($result_data)
										{
											foreach($result_data as $data)
											{
                                 ?>

                                        <tr> 

                                            <td align="left"><div align="left"><?php print($this->general->date_time_formate($data->post_date));?></div></td>

                                            <td align="left"><div align="left"><?php print($data->name.' '.$data->last_name);?></div></td>

                                            <td align="left"><div align="left"><?php print($data->symptoms);?></div></td>

                                            <td align="left"><div align="left"><?php echo $data->address; if($data->address2){ echo ','.$data->address2;} echo ', '.$data->city.', '.$data->state.', '.$data->zip?></div></td>

                                            <td align="left"><div align="center"><?php print($this->general->date_formate($data->dob)); echo ' ('.$this->general->calculate_age($data->dob).')';?></div></td>
                                            <td align="center"><?php if($data->company_name!=''){?><i class="fa fa-check"></i> <?php } ?></td>
                                            <td align="left"><div align="center">
                                                <?php echo $data->how_find_us?>
                                                </div></td>

                                            <td colspan="2" align="center" style="border-right:none; font-size:20px;">
                                                <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/medical/view/<?php echo $data->id?>" title="View Details"><i class="fa fa-eye"></i></a>

                                                <a href="javascript: void(0);" class="assignProvider" data-id="<?php print($data->id);?>" title="Assign Provider"><i class="fa fa-user-md"></i></a>
                                                  <a  style="margin-left:5px;" href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/medical/delete/<?=$data->id?>" class="text-red" onClick="return doconfirm();" title="Delete"><i class="fa fa-times"></i></a>
                                                  
                                                  
                                                  </td>

                                              </tr>

                                              <?php

                                          }

                                          $i++;

                                      }else{

                                        ?>

                                        <tr> 

                                            <td colspan="7" align="center" style="border-right:none;"> (0) Zero Record Found </td>

                                        </tr>

                                        <?php

                                      }

                                      ?>

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

                </div>

                <!-- /.box-body -->        

            </div>

        </section>

        <!-- /.content -->

    </div>

<!-- Small modal -->

<div class="modal fade" tabindex="-1" id="assignProviderModal" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><b> Assign a provider </b></h4>
                </div>
                <div class="modal-body admin_01 admin_sub">
                	<div id="ProviderErrorAlert" class="alert alert-danger alert-dismissible" style="display:none;">
	                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                    <h4><i class="icon fa fa-ban"></i> Please correct following errors:</h4>
	                    <div id="providerFormValidationErrors"></div>
	                </div>
                    <div class="fill-up supper_admin">
                        <form id="providerForm" autocomplete="off">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Providers <span class="text-red">*</span></label>
                                <select name="provider" class="form-control" required>
                                	<option value="">Select Provider</option>
                                    <?php if($providers_data){ foreach($providers_data as $provider){?>
                                    <option value="<?php echo $provider->id;?>"><?php echo $provider->first_name.' '.$provider->last_name; if($provider->title){ echo ', '.$provider->title;}?></option>
                                    <?php }}?>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                            <input type="hidden" name="patient_id" id="patient_id" value="" />
                            <button type="submit" class="btn btn-primary btn-block" id="submit_provider">SUBMIT</button>
                            </div>
                            <div class="form-group col-md-12">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">CANCEL</button>
                            </div>
                            
                        </div>
                        </form>
                    </div>
                </div>
                
            </div>
  </div>
</div>

    <script type="text/javascript">

        function doconfirm()

        {

            job=confirm("Are you sure to delete permanently?");

            if(job!=true)

            {

                return false;

            }

        }
		
		var assign_provider_url = '<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/medical/assign_provider';
		var patients_history_url = '<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/medical/patients/history';
    </script>