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
                <legend>Company Detail</legend>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Company Name</label>
                  <input name="company_name" type="text" class="form-control form-control" id="company_name" value="<?php echo set_value('company_name');?>" size="15" required="required" />
                  <?=form_error('company_name')?>
                </div>
              </div>

              <?php /*<div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Case ID</label>
                  <input name="company_reg_no" type="text" class="form-control form-control" id="company_reg_no" value="<?php echo set_value('company_reg_no');?>" size="15" required="required" />
                  <?=form_error('company_reg_no')?>
                </div>
              </div>
              */?>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Address</label>
                  <input name="company_addr" type="text" class="form-control form-control" id="company_addr" value="<?php echo set_value('company_addr');?>" size="30" required="required" />
                  <?=form_error('company_addr')?>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">City</label>
                  <input name="company_city" type="text" class="form-control form-control" id="company_city" value="<?php echo set_value('company_city');?>" size="15" required="required" />
                  <?=form_error('company_city')?>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Postal Code</label>
                  <input name="company_postal_code" type="text" class="form-control form-control" id="company_postal_code" value="<?php echo set_value('company_postal_code');?>" size="15" required="required" />
                  <?=form_error('company_postal_code')?>
                </div>
              </div>
<?php /*
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Country </label>
                  <select name="company_country" class="reg-sel-country form-control" id="company_country" required="required">
					<?php $post_company_country = set_value('company_country');?>
                    <option value="">Select Country</option>
                    <?php foreach($this->general->get_country() as $country){?>
                      <option value="<?php echo $country->id;?>" <?php if($post_company_country == $country->id) { echo 'selected="selected"';}?> ><?php echo $country->country;?></option>
                    <?php } ?>
                  </select>
                  <?=form_error('company_country')?>
                </div>
              </div>
              */?>

            </div>
            
            
             <div class="row">
              <div class="col-md-12">
                <legend>Contact Person Detail</legend>
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
            
            <?php /*
            <div class="col-sm-4">              
              <label class="hmenu_font">DOB </label>
              <div class="input-group" id="start_datetimepicker">
                <input name="dob" type="text" class="form-control" id="dob" value="" size="20" autocomplete="off">
                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
                </span>
              </div>
            </div>
            */?>
                          
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Contact Phone No</label>
                  <input name="phone" type="text" class="form-control form-control" id="phone" value="<?php echo set_value('phone');?>" size="15" required="required" />
                  <?=form_error('phone')?>
                </div>
              </div>
              
              
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Address </label>
                  <input name="address" type="text" class="form-control form-control" id="address" value="<?php echo set_value('address');?>" size="15" required="required" />
                  <?=form_error('address')?>
                </div>
              </div>
              
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">City</label>
                  <input name="city" type="text" class="form-control form-control" id="city" value="<?php echo set_value('city');?>" size="15" required="required" />
                  <?=form_error('city')?>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Postal Code</label>
                  <input name="post_code" type="text" class="form-control form-control" id="post_code" value="<?php echo set_value('post_code');?>" size="15" required="required" />
                  <?=form_error('post_code')?>
                </div>
              </div>
<?php /*
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Country </label>
                  <select name="country" class="reg-sel-country form-control" id="country" required="required">
					<?php $post_country = set_value('country');?>
                    <option value="">Select Country</option>
                    <?php foreach($this->general->get_country() as $country){?>
                      <option value="<?php echo $country->id;?>" <?php if($post_country == $country->id) { echo 'selected="selected"';}?>><?php echo $country->country;?></option>
                    <?php } ?>
                  </select>
                  <?=form_error('country')?>
                </div>
              </div>
*/?>
            </div>


            <div class="row">
              <div class="col-md-12 text-center">
                <input class="bttn btn btn-primary" type="submit" name="Submit" value="Add Company" />  
              </div>
            </div>
          </div>
        </form>        
      </div>

    </div>

  </section><!-- /Main content -->
</div>