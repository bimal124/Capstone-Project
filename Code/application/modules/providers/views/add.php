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
                  <label class="hmenu_font">First Name <span class="mandatory-field">*</span></label>
                  <input name="first_name" type="text" class="form-control form-control" id="first_name" value="<?php echo set_value('first_name');?>" size="15" />
                  <?=form_error('first_name')?>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Last Name <span class="mandatory-field">*</span></label>
                  <input name="last_name" type="text" class="form-control form-control" id="last_name" value="<?php echo set_value('last_name');?>" size="15" />
                  <?=form_error('last_name')?>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Email <span class="mandatory-field">*</span></label>
                  <input name="email" type="text" class="form-control form-control" id="email" value="<?php echo set_value('email');?>" size="30" />
                  <?=form_error('email')?>
                </div>
              </div>

            </div>
			
            <div class="row">
            <!-- <div class="col-sm-4">              
              <label class="hmenu_font">DOB </label>
              <div class="input-group" id="start_datetimepicker">
                <input name="dob" type="text" class="form-control" id="dob" value="" size="20" autocomplete="off">
                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
                </span>
              </div>
            </div> -->
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Contact Phone No <span class="mandatory-field">*</span></label>
                  <input name="phone" type="text" class="form-control form-control" id="phone" value="<?php echo set_value('phone');?>" size="15" required="required" />
                  <?=form_error('phone')?>
                </div>
              </div>
              
              
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Address <span class="mandatory-field">*</span></label>
                  <input name="address" type="text" class="form-control form-control" id="address" value="<?php echo set_value('address');?>" size="15" required="required" />
                  <?=form_error('address')?>
                </div>
              </div>
              
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">City <span class="mandatory-field">*</span></label>
                  <input name="city" type="text" class="form-control form-control" id="city" value="<?php echo set_value('city');?>" size="15" required="required" />
                  <?=form_error('city')?>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Postal Code <span class="mandatory-field">*</span></label>
                  <input name="post_code" type="text" class="form-control form-control" id="post_code" value="<?php echo set_value('post_code');?>" size="15" required="required" />
                  <?=form_error('post_code')?>
                </div>
              </div>
<?php /*
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Country <span class="mandatory-field">*</span></label>
                  <select name="country" class="reg-sel-country form-control" id="country" required="required">
					<?php $post_country = set_value('country');?>
                    <option value="">Select Country</option>
                    <?php foreach($this->general->get_country() as $country){?>
                      <option value="<?php echo $country->id;?>" <?php if($post_country == $country->id) { echo 'selected="selected"';}?>><?php echo $country->country;?></option>
                    <?php } ?>
                  </select>
                  <?=form_error('country')?>
                </div>
              </div> */?>

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