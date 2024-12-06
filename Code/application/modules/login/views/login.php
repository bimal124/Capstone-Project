

<?php

if(isset($message) && $message){

    ?>

    <div class="alert alert-danger alert-dismissible">

      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                

      <?php echo $message;?>

  </div>

  <?php

}

?>

<div class="login-box-body">



    <p class="login-box-msg">Log in to Admin Panel</p>

    <div style="color:red;" align="center">

        <?php echo validation_errors(); ?>

        <?php if($this->session->flashdata('message')) echo $this->session->flashdata('message');?>

    </div>



    <form name="admin_login" action="" method="post" id="adminLoginForm" accept-charset="utf-8">

        <div class="form-group has-feedback">

          <input type="text" name="username" class="form-control" placeholder="Username" value="">

          <span class="glyphicon glyphicon-user form-control-feedback"></span>

          <?php echo form_error('username'); ?>

      </div>

      <div class="form-group has-feedback">

          <input type="password" name="password" class="form-control" placeholder="Password" value="">

          <span class="glyphicon glyphicon-lock form-control-feedback"></span>

          <?php echo form_error('password'); ?>

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

        <div class="checkbox icheck">

          <label>

            <input type="checkbox" name="rememberme" value="yes"> Remember Me

          </label>

        </div>

        

      </div>

      <!-- /.col -->

      <div class="col-xs-4">

        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>

      </div>

      <!-- /.col -->

    </div>

</form>

  <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/forgot');?>">I forgot my password</a><br>

  <!-- <a href="#">I forgot my password</a><br> -->

</div>

<p>&nbsp;</p>





<script type="text/javascript">

  var reload_captcha_url = '<?php echo site_url(ADMIN_DASHBOARD_PATH.'/reload');?>'; 

</script>



