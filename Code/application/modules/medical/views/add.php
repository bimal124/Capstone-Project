	<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $modules_name; ?>
    </h1>      
    <?php echo $this->breadcrumb->output(); ?>
  </section><!-- /Content Header (Page header) -->

  <!-- Main content -->
  <section class="content">
    <?php if ($this->session->flashdata('message')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('message'); ?></h4>
      </div>
    <?php } ?>
    <div class="alert alert-success alert-dismissible" id="msgSuccess" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> <span id="successMsg"></span></h4>
    </div>
    <div class="alert alert-danger alert-dismissible" id="msgError" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> <span id="errorMsg"></span></h4>
    </div>
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $modules_heading; ?></h3>
      </div><!-- /.box-header -->
      
      <div class="box-body" >
        <form name="member" method="post" action="" enctype="multipart/form-data" accept-charset="utf-8" class="add_member_form" id="uprofile">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <legend>Provider Detail</legend>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">First Name</label>
                  <input name="first_name" type="text" class="form-control form-control" id="first_name" value="<?php echo set_value('first_name');?>" size="15" />
                  <?=form_error('first_name')?>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Last Name</label>
                  <input name="last_name" type="text" class="form-control form-control" id="last_name" value="<?php echo set_value('last_name');?>" size="15" />
                  <?=form_error('last_name')?>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Email</label>
                  <input name="email" type="text" class="form-control form-control" id="email" value="<?php echo set_value('email');?>" size="30" />
                  <?=form_error('email')?>
                </div>
              </div>

            </div>


            <div class="row">
              <div class="col-md-12 text-center">
                <input class="bttn btn btn-primary" type="submit" name="Submit" value="Add Provider" />  
              </div>
            </div>
          </div>
        </form>        
      </div>

    </div>

  </section><!-- /Main content -->
</div>