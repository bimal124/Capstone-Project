<?php if($this->session->flashdata('reset_message_success')){?>
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                
  <?php echo $this->session->flashdata('reset_message_success');?>
</div>
<?php }?>

<?php if(isset($message)){?>
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                
  <?php echo $message;?>
</div>
<?php }?>
<div class="login-box-body">

  <p class="login-box-msg">Change Your Password</p>

  <?php echo form_open(site_url(ADMIN_DASHBOARD_PATH.'//reset').'/?key='.$activation_key.'&auth='.$email,array('id' => 'adminResetForm','autocomplete' => 'off'));  ?>
    <div class="form-group has-feedback">
      <input type="text" name="admin_password" class="form-control" placeholder="New Password">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
      <?php echo form_error('admin_password'); ?>
    </div>
    
    <div class="form-group has-feedback">
      <input type="text" name="admin_confirm" class="form-control" placeholder="Confirm Password">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
      <?php echo form_error('admin_confirm'); ?>
    </div>
    
    <div class="row">
      
      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">SUBMIT</button>
      </div>
      <!-- /.col -->
    </div>
  <?php echo form_close(); ?>
  
</div>