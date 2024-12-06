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
      </div><!-- /box-header -->

      <div class="box-body">
        <div class="row">
          <form name="sitesetting" method="post" action="" class="change_password_form" accept-charset="utf-8">
            <input type="hidden" name="oldpass" id="oldpass" value="<?=$old_pass?>">
            <div class="container-fluid">
              <div class="row form-group">
                <div class="col-sm-3 text-right">
                  <label class="hmenu_font">Old Password </label>
                </div>
                <div class="col-sm-6">
                  <input class="form-control" name="old_password" type=text id="old_password" value="<?php echo set_value('old_password');?>" size=30>
                  <?=form_error('old_password')?>
                </div>
              </div><!-- /row -->
              <div class="row form-group">
                <div class="col-sm-3 text-right">
                  <label class="hmenu_font">New Password </label>
                </div>
                <div class="col-sm-6">
                  <input class="form-control" name="new_password" type=text id="new_password" value="<?php echo set_value('new_password');?>" size=30><?=form_error('new_password')?>
                </div>
              </div><!-- /row -->
              <div class="row form-group">
                <div class="col-sm-3 text-right">
                  <label class="hmenu_font">Confirm Password </label>
                </div>
                <div class="col-sm-6">
                  <input class="form-control" name="re_password" type=text id="re_password" value="<?php echo set_value('re_password');?>" size=30><?=form_error('re_password')?>
                </div>
              </div><!-- /row -->
              <div class="row form-group">                  
                <div class="col-sm-offset-3 col-sm-6"><input class="bttn btn btn-primary" type="submit" name="Submit" value="Update" /></div>
              </div><!-- /row -->
            </div><!-- /container -->
          </form>

        </div>
      </div><!-- /box-header -->
    </div><!-- /box -->
  </section>
</div>