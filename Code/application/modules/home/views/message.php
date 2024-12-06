<section class="serve">
<h2 class="mb-4 text-center text-uppercase"><?=isset($title)?$title:'DrSathi'?> </h2>
<div class="blogBg mb-5"> 
	<?php if($this->session->flashdata('message')){?>
      <div class="alert alert-primary">
        <b>
        <?php echo $this->session->flashdata('message');?>
      </b>
      </div>
      <?php }?>
      <?php if($this->session->flashdata('error')){?>
      <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error');?>
      </div>
      <?php }?>
      <?php 
      if(SITE_STATUS == 'maintanance')
    {?>
      <form action="" method="post" class="login_panel">      
        <div class="form-group"><input type="text" value="" name="key" class=" form-control" placeholder="Enter Maintainance Key here ..." required></div>
                
        <div class="mb-25">
        <input type="submit" name="subit" class="btn btn-primary purple" value="SUBMIT">
        </div>        
      </form>
    <?php } ?>
</div>
</section>