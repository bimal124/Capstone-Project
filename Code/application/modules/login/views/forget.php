<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->
<?php if($this->session->flashdata('forgot_message_success')){?>
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                
  <?php echo $this->session->flashdata('forgot_message_success');?>
</div>
<?php }?>

<?php if($message){?>
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                
  <?php echo $message;?>
</div>
<?php }?>
<div class="login-box-body">

  <p class="login-box-msg">Forgot Your Password?</p>

  <?php echo form_open(site_url(ADMIN_DASHBOARD_PATH.'/forgot'),array('id' => 'adminForgotForm','autocomplete' => 'off'));  ?>
    <div class="form-group has-feedback">
      <input type="text" name="admin_username_email" class="form-control" placeholder="Username or Email">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
      <?php echo form_error('admin_username_email'); ?>
    </div>
    
    <div class="row">
      <div class="col-xs-6">        
          <label>
            <input name="admin_captcha" type="text" class="form-control" placeholder="Captcha Code">            
          </label>    
              
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <span id="admin_captcha_container"><?php echo $admin_captcha; ?></span>
    <span id="new_captcha_button" class="load_new_captcha"><i class="fa fa-refresh"></i></span> 
      </div>
      <!-- /.col -->
      <div class="col-xs-12">
      <div id="admincapcha_error_container" class="pull-left"></div>
    <?php echo form_error('admin_captcha'); ?>
        </div>
    </div>
    <div class="row">
      <div class="col-xs-8"> 
          <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>">I REMEMBER NOW!</a>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">SUBMIT</button>
      </div>
      <!-- /.col -->
    </div>
  <?php echo form_close(); ?>
  
</div>