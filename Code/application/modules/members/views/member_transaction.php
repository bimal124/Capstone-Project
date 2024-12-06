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
    </section>
    <section class="content">
  <!-- <h2>View <?php $check = $this->uri->segment(4); if($check) echo $this->uri->segment(4); else echo 'Live';?> Auction Details </h2> -->
    <?php if ($this->session->flashdata('message')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('message'); ?></h4>
      </div>
    <?php } ?>
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $modules_heading; ?></h3>
      </div>

   <!--  <div style="padding:3px 20px; float:right; width:80px; background:#202020; color:#ABABAB; line-height:18px;">
    <a href="javascript:history.go(-1)" style="text-decoration:none;">
    <img src="<?php print(ADMIN_IMG_DIR_FULL_PATH);?>/back.gif" width="18" height="18" alt="back" style="padding:0; margin:0; width:18px; height:18px;" align="right" />
    </a><span class="breed"><a href="javascript:history.go(-1)"> go Back</a></span></div> -->
    
    <div class="box-body" >
    
     <div><?php $this->load->view('menu');?></div>
  
<!-- <table width=100% align=center border=0 cellspacing=0 cellpadding=8 class="light"> -->
  <table class="table table-striped">
    
  
<tr style=" background-color:#FFFFFF;">
  <td height="30" bgcolor="#FFFFFF"><div style=" background-color:#FFFFFF; padding:5px 10px;">Member: <strong><?php echo $profile->first_name.' '.$profile->last_name;?></strong></div></td>
  <td bgcolor="#FFFFFF"><div style=" background-color:#FFFFFF; padding:5px 10px;">Current Balance:  <strong><?php echo $profile->balance;?> Credits </strong></div></td>
</tr>
</table>
<!-- <table width="100%" border="0" cellspacing="0" cellpadding="4" class="contentbl"> -->
  <table class="table table-striped">
  <tr> 
  	<th align="left"><div align="left">Invoice</div></th>
	<th align="left"><div align="left">Name</div></th>
    <th align="left"><div align="left">Txn Type </div></th>
    <th align="center"><div align="left">Bids</div></th>
	<th align="center"><div align="left">Bonus</div></th>
	<th align="center"><div align="left">Amount</div></th>
	<th align="center"><div align="center">Currency</div></th>
    <th align="center"><div align="left">Date </div></th>   
    
    
    <th colspan="2" align="center" style="border-right:none;"><div align="left">Status</div></th>
    </tr>
	<?php 
			if($this->uri->segment(4)) $status = $this->uri->segment(4); else $status = 'active';
			
			if($result_data)
			{
				foreach($result_data as $data)
				{
	?>
  <tr> 
    <td align="left"><div align="left"><?php print($data->invoice_id);?></div></td>
	<td align="left"><div align="left"><?php print($data->transaction_name);?></div></td>
    <td align="left"><div align="left"><?php print($data->transaction_type);?></div></td>
    <td align="left"><div align="left"><?php print($data->credit_get);?></div></td>
	<td align="left"><div align="left"><?php print($data->bonus_points);?></div></td>
	<td align="left"><div align="left"><?php print($data->amount);?></div></td>
    <td align="left"><div align="center"><?php print($data->mc_currency);?></div></td>
    <td align="left"><div align="left"><?php print($this->general->full_date_time_formate($data->transaction_date));?></div></td>
    <td colspan="2" align="left" style="border-right:none;"><?php print($data->transaction_status);?></td>
    </tr>
  <?php
  				}
				if($links)
				{
  ?>
   <tr> 
    <td colspan="8" align="center" style="border-right:none;" class="paging"><?php echo $links;?></td>
    </tr>
  <?php
  				}
			}
			else
			{
  ?>
   <tr> 
    <td colspan="8" align="center" style="border-right:none;"> (0) Zero Record Found </td>
    </tr>
  <?php
  			}
  ?>
</table>
</div>
    <div class="clear"></div>
</div>
</div>
</section>
</div>
