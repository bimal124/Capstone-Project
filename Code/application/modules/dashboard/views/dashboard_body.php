<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=($total_active_patient>0)?$total_active_patient:0;?></h3>

              <p>Active Patients</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=($total_patient)?$total_patient:0?></h3>

              <p>Total Patients</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$total_providers?></h3>

              <p>Total Providers</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-md"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
              <h3><?=$total_companies?></h3>

              <p>Total Companies</p>
            </div>
            <div class="icon">
              <i class="fa fa-building-o"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Active Patients</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Symptoms</th>
                    <th>Location</th>
                    <th>Age</th>                    
                  </tr>
                  </thead>
                  <tbody>
                    
                    <?php if($patients_lists){ foreach($patients_lists as $data){?>
                    <tr>
                    <td align="left"><div align="left"><?php print($this->general->date_time_formate($data->post_date));?></div></td>

                                            <td align="left"><div align="left"><?php print($data->name.' '.$data->last_name);?></div></td>

                                            <td align="left"><div align="left"><?php print($data->symptoms);?></div></td>

                                            <td align="left"><div align="left"><?php echo $data->address; if($data->address2){ echo ','.$data->address2;} echo ', '.$data->city.', '.$data->state.', '.$data->zip?></div></td>

                                            <td align="left"><div align="left">
											
											<?php 
													 print($this->general->date_formate($data->dob));											 
													 echo ' ('.$this->general->calculate_age($data->dob).')';
											?>
                                            
                                            </div></td>                  	
                  </tr>
                  <?php }}else {?>
                  <tr>
                    <td colspan="5" align="center"><strong>:: Zero (0) records found ::</strong></td>               	
                  </tr>
                <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
         <!--    <div class="box-footer clearfix">
              
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View</a>
            </div> -->
            <!-- /.box-footer -->
          </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
		        
</div>

      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">New Patient Info</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <canvas id="reg_per_day" style="display: block; width: 770px; height: 385px;"></canvas>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
         <!--    <div class="box-footer clearfix">
              
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View</a>
            </div> -->
            <!-- /.box-footer -->
         

        </section>
        <section class="col-lg-6 connectedSortable">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Patients Data</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <canvas id="members" style="display: block; width: 770px; height: 385px;"></canvas>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
         <!--    <div class="box-footer clearfix">
              
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View</a>
            </div> -->
            <!-- /.box-footer -->
         

        </section>
        
        <section class="col-lg-6 connectedSortable">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Transaction</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <canvas id="published" style="display: block; width: 770px; height: 385px;"></canvas>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
         <!--    <div class="box-footer clearfix">
              
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View</a>
            </div> -->
            <!-- /.box-footer -->
         

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
    var s_url="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/reports/get_total_data');?>";
    var ss_url="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/dashboard/get_members_data');?>";

  </script>