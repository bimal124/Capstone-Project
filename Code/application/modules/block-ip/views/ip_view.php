<script type="text/javascript">
function doconfirm()
{
	job=confirm("Are you sure to delete permanently?");
	if(job!=true)
	{
		return false;
	}
}
</script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?php echo $modules_name; ?>
    </h1>      
    <?php echo $this->breadcrumb->output(); ?>
  </section><!-- /content-wrapper -->
  <section class="content">
    <?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('message'); ?></h4>
    </div>
    <?php } ?>

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $modules_heading; ?></h3>
      </div><!-- box-header -->
      <div class="box-body no-padding" >
        <div class="row filter-sec" >
          <div class="col-lg-12 data-search-inputs" style="padding-top:10px">
            <div class="col-md-6 form-group ">
              <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/block-ip/add_ip" class="btn btn-sm btn-success" title="Add Block IP"><i class="fa fa-list"></i> Add Block IP</a>
            </div>
          </div>
        </div><!-- /row -->

        <div class="row" >
          <div class="col-lg-12">
            <div class="col-lg-12">
              <table class="table table-striped contentbl">
                <tr> 
                  <th width="50" align="center">S. No. </th>
                  <th align="left">IP Address </th>
                  <th align="left">Date</th>
                  <th width="10" align="center"><div align="center">Edit</div></th>
                  <th width="10" align="center" style="border-right:none;"><div align="center">Delete</div></th>
                </tr>
                <?php
                if($ip_data){
                  foreach($ip_data as $ip_val){
                    ?>
                    <tr> 
                      <td align="left"><div align="center"><?php print($ip_val->id);?></div></td>
                      <td align="left"><div align="left"><?php print($ip_val->ip_address);?></div></td>
                      <td align="left"><div align="left"><?php print($ip_val->last_update);?></div></td>
                      <td align="center">
                        <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/block-ip/edit_ip/<?php print($ip_val->id);?>">
                          <img src='<?php print(ADMIN_IMG_DIR_FULL_PATH);?>/edit.gif' title="Edit">
                        </a> 
                      </td>
                      <td align="center" style="border-right:none;">
                        <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/block-ip/delete_ip/<?php print($ip_val->id);?>"> 
                          <img src='<?php print(ADMIN_IMG_DIR_FULL_PATH);?>/delete.gif' title="Delete" onClick="return doconfirm();" >
                        </a>
                      </td>
                    </tr>
                    <?php
                  }
                }else{
                  ?>
                  <tr> 
                    <td colspan="4" align="center" style="border-right:none;"> (0) Zero Record Found </td>
                  </tr>
                  <?php
                }
                ?>
              </table>
            </div>
          </div>
        </div><!-- /row -->
      </div><!-- box-body -->
    </div><!-- box -->
    
  </section><!-- content -->
</div>
