<div class="content-wrapper"><!-- Content Header (Page header) -->
   <section class="content-header">
        <h1><?php echo $modules_name; ?></h1>      
        <?php echo $this->breadcrumb->output(); ?>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="alert alert-success alert-dismissible" id="msgSuccess" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> <span id="successMsg"></span></h4>
    </div>

<div class="alert alert-danger alert-dismissible" id="msgError" style="display:none;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> <span id="errorMsg"></span></h4>
</div>


<div class="box">
    <div class="box-header with-border"><h3 class="box-title"><?php echo $modules_heading; ?></h3></div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="row">
                <form id="form1" name="form1" method="post" action="">
                    <div class="col-lg-12 data-search-inputs" style="padding-top:10px">
                        <div class="col-lg-12">
                            <div class="col-lg-12 search-box" >
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Search by Patient</label>
                                            <select class="form-control select2" name="patient_id">
                                                <option value="">Select Patient</option>
                                                <?php if($patient_list){ foreach($patient_list as $value){?>
                                                <option value="<?php echo $value->id;?>" <?=($value->id == set_value('patient_id'))?'selected':''?> ><?php echo $value->first_name.' '.$value->last_name; if($value->title){ echo ', '.$value->title;}?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Seacrh by Provider</label>
                                            <select class="form-control select2" name="provider_id">
                                                <option value="">Select Patient</option>
                                                <?php if($provider_list){ foreach($provider_list as $value){?>
                                                <option value="<?php echo $value->id;?>" <?=($value->id == set_value('provider_id'))?'selected':''?> ><?php echo $value->first_name.' '.$value->last_name; if($value->title){ echo ', '.$value->title;}?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Search by Company</label>
                                            <select class="form-control select2" name="company_id">
                                                <option value="">Select Patient</option>
                                                <?php if($company_list){ foreach($company_list as $value){?>
                                                <option value="<?php echo $value->id;?>" <?=($value->id == set_value('company_id'))?'selected':''?> ><?php echo $value->first_name.' '.$value->last_name; if($value->title){ echo ', '.$value->title;}?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <br/>
                                            <input type="submit" class="btn btn-primary" name="Search" id="search" value="Search">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <br/>
                                            <button class="btn btn-success exportAll" type="button">Export</button>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </form>
            </div>

                <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>							
                                    <th align="left"><div align="left">#</div></th>
                                    <th align="left"><div align="left">Service Provided</div></th>
                                    <th align="left"><div align="left">Patient</div></th>
                                    <th align="center"><div align="left">Amount</div></th>
                                    <th align="center"><div align="left">Reference Number </div></th>
                                    <th align="center"><div align="center">Payment Mode</div></th>
                                    <th align="center"><div align="center">Date</div></th>
                                    <th align="center"><div align="center">Status</div></th>
                                </tr>
                            </thead>
                            <tbody class="item-display-container">
                                <?php
								if($this->uri->segment(4,0))
								$i = $this->uri->segment(4,0)+1;
								else
                                $i = 1;
                                if($result_data)
                                {
                                    foreach($result_data as $data)
                                    {
                                    ?>
                                        <tr> 
                                            <td align="left"><div align="left"><?php print($i);?></div></td>
                                            <td align="left"><div align="left"><?php print($data->transaction_name);?></div></td>
                                            <td align="left"><div align="left"><?php print($data->name.' '.$data->last_name);?></div></td>
                                            <td align="left"><div align="left"><?php print($this->general->formate_amount($data->amount));?></div></td>
                                            <td align="left"><div align="left"><?php print($data->reference_number);?></div></td>
                                            <td align="left"><div align="center"><?php print($data->payment_method);?></div></td>
                                            <td align="left"><div align="center"><?php print($this->general->date_time_formate($data->transaction_date));?></div></td>
                                            <td align="left"><div align="center"><?php echo ($data->transaction_status == 'Completed')?'Captured':'';?></div></td>
                                        </tr>
                                        <?php  $i++;} }
                                        else{  ?>
                                        <tr> 
                                            <td colspan="7" align="center" style="border-right:none;"> (0) Zero Record Found </td>
                                        </tr>
                                        <?php } ?>
                                  </tbody>
                                </table>
                                <?php
                                if($links) {
                                    echo $links;
                                }
                                ?>
                            </div>
                        </div>
                </div> <!-- /.box-body -->        
            </div>
        </section><!-- /.content -->
    </div>
    <script type="text/javascript">
        function doconfirm() {
            job=confirm("Are you sure to delete permanently?");
            if(job!=true){
                return false;
            }
        }
    </script>

    <form action="<?php echo base_url(ADMIN_DASHBOARD_PATH.'/transaction/export')?>" id="exportTransaction" method="post">
        <input type="hidden" name="export_patient">
        <input type="hidden" name="export_provider">
        <input type="hidden" name="export_company">
    </form>