<script type="text/javascript">
function doconfirm()
{
	job=confirm("Are you still want to delete permanently?");
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
    </section>
    <section class="content">
    	<?php if ($this->session->flashdata('message')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('message'); ?></h4>
      </div>
      <?php } ?>
      <div class="box">
         <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $modules_heading; ?></h3>
              </div>
              <div class="box-body no-padding" >
               <div class="row filter-sec">
                <div class="col-lg-12 data-search-inputs" style="padding-top:10px">
                  <div class="col-md-6 form-group">
                    <?php
                    if($this->uri->segment(3) != 'add_auction'){
                      ?>
                      <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/banner/add_banner" class="btn btn-sm btn-success" title="Add Banner"><i class="fa fa-list"></i> Add Banner</a>
                      <?php
                    }
                    ?>

                    <?php
                    if(count($lang_details) !=1){
                      foreach($lang_details as $lang){
                        ?>
                        <?php if($lang_id != $lang->id){?><a class="btn btn-sm btn-success" href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/banner/index/<?php echo $lang->id;?>"><?php }?><?php echo $lang->lang_name;?></a>
                        <?php
                      }
                    }
                    ?>
                  </div> 
                </div> 
              </div>
		 
    <div class="row">
  <div class="col-lg-12">
  <div class="col-lg-12">

<table class="table table-striped">
  <tr> 
  <th align="center">Banner</th>
    <th align="">Is Display? </th>
    <th align="">Last Update </th>
    <th width="10" align="center"><div align="center">Edit</div></th>
    <th width="10" align="center" style="border-right:none;"><div align="center">Delete</div></th>
	</tr>
	<?php 
			if($result_data)
			{
				foreach($result_data as $data)
				{
	?>
  <tr> 
    <td align="left"><img src="<?php echo base_url().$data->banner;?>" width="400" height="100"></td>
    <td align=""><?php print($data->is_display);?></td>
    <td align=""><?php print($data->last_update);?></td>
    <td align="center"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/banner/edit_banner/<?php print($data->id);?>/<?php print($data->lang_id);?>">
      <img src='<?php print(ADMIN_IMG_DIR_FULL_PATH);?>/edit.gif' title="Edit"></a> </td>
    <td align="center" style="border-right:none;"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/banner/delete_banner/<?php print($data->id);?>"> 
      <img src='<?php print(ADMIN_IMG_DIR_FULL_PATH);?>/delete.gif' title="Delete" onClick="return doconfirm();" ></a>    </td>
  </tr>
  <?php
  				}
			}
			else
			{
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
</div></div></div></section>
    <div class="clear"></div>
</div>
