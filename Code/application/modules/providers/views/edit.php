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
        <?php //$this->load->view('menu');?>

        <form name="member" method="post" action="" enctype="multipart/form-data" accept-charset="utf-8" id="uprofile" class="edit_member_form">
          <input name="user_id" type="hidden" class="form-control" id="user_id" value="<?php echo $profile->id;?>" size="15" />
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <legend>Personal Detail</legend>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">First Name</label>
                  <input name="first_name" type="text" class="form-control form-control" id="first_name" value="<?php echo set_value('first_name',$profile->first_name);?>" size="15" />
                  <?=form_error('first_name')?>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Last Name</label>
                  <input name="last_name" type="text" class="form-control form-control" id="last_name" value="<?php echo set_value('last_name',$profile->last_name);?>" size="15" />
                  <?=form_error('last_name')?>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Email</label>
                  <input name="email" type="text" class="form-control form-control" id="email" value="<?php echo set_value('email',$profile->email);?>" size="30" />
                  <?=form_error('email')?>
                </div>
              </div>
              </div>
			
            <div class="row">
            <!-- <div class="col-sm-4">              
              <label class="hmenu_font">DOB </label>
              <div class='input-group' id='start_datetimepicker'>
                <input name="dob" type="text" class="form-control" id="dob" value="<?php echo set_value('dob',$profile->dob);?>" size="20" autocomplete="off"/>
                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
                </span>
              </div>
              <?=form_error('dob')?>
            </div> -->
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Contact Phone No</label>
                  <input name="phone" type="text" class="form-control form-control" id="phone" value="<?php echo set_value('phone',$profile->phone);?>" size="15" required="required" />
                  <?=form_error('phone')?>
                </div>
              </div>
              
              
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Address </label>
                  <input name="address" type="text" class="form-control form-control" id="address" value="<?php echo set_value('address',$profile->address);?>" size="15" required="required" />
                  <?=form_error('address')?>
                </div>
              </div>
              
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">City</label>
                  <input name="city" type="text" class="form-control form-control" id="city" value="<?php echo set_value('city',$profile->city);?>" size="15" required="required" />
                  <?=form_error('city')?>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Postal Code</label>
                  <input name="post_code" type="text" class="form-control form-control" id="post_code" value="<?php echo set_value('post_code',$profile->post_code);?>" size="15" required="required" />
                  <?=form_error('post_code')?>
                </div>
              </div>
<?php /*
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Country </label>
                  <select name="country" class="reg-sel-country form-control" id="country" required="required">
					<?php $post_country = set_value('company_country',$profile->country);?>
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

            
              
              

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Password</label>
                  <div id="change_password">
                    <p class="form-control-disabled">**********</p>
                  </div>
                  
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">&nbsp</label>
                  <div id="btn_change_password">
                    <p><a href="#" id="chang_pass">Change Password</a></p>
                  </div>
                </div>
              </div> 
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">User Type</label>
                  <select class="form-control" name="member_type">
                    <option value="1" <?=($profile->member_type == 1)?'selected':''?>>Patient</option>
                    <option value="2" <?=($profile->member_type == 2)?'selected':''?>>Provider</option>
                    <option value="3" <?=($profile->member_type == 3)?'selected':''?>>Company</option>
                  </select>
                  <?=form_error('re_password')?>
                </div>
              </div>                
            </div>
            <br />
			
            <div class="row">
              

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Registered Date</label>
                  <p class="form-control-disabled"><?php echo $this->general->date_time_formate($profile->reg_date);?></p>                  
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Registered IP</label>
                  <p class="form-control-disabled"><?php echo $profile->reg_ip_address;?></p>                  
                </div>
              </div>
            
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Last Login Date</label>
                  <p class="form-control-disabled"><?php echo $this->general->date_time_formate($profile->last_login_date);?> </p>                  
                </div>
              </div>
			</div>

            <div class="row">
            
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Last Login IP</label>
                  <p class="form-control-disabled"><?php echo $profile->last_ip_address;?></p>                  
                </div>
              </div>
            
				
              
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Status</label>
                  <div class="row">
                    <div class="col-sm-12 radio-group">
                      <label>
                        <input name="status" type="radio" value="1" checked="checked" />
                        Active 
                      </label>&nbsp
                      <label>
                        <input name="status" type="radio" value="0" <?php if($profile->status == '0'){ echo 'checked="checked"';}?> />
                        Inactive 
                      </label>&nbsp
                      <label>
                        <input name="status" type="radio" value="2" <?php if($profile->status == '2'){ echo 'checked="checked"';}?> />
                        Suspended 
                      </label>&nbsp
                      
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-sm-12 reasonDiv" <?php if($profile->status == '1'){?>style="display: none;"<?php }?>>
                <div class="form-group">
                  <label class="hmenu_font">Inactive/Suspend Reason</label>
                  <textarea class="form-control" name="admin_note"><?php echo $profile->admin_note?></textarea>

                </div>
              </div>

              
              
            </div>

            

            


            

            

            <div class="row">
              <div class="col-md-12 text-center">
                <input class="bttn btn btn-primary" type="submit" name="Submit" value="Update" />  
              </div>
            </div>
          </div>
        </form>        
      </div><!-- /.box-body -->

    </div><!-- /.box -->

  </section><!-- /Main content -->
</div>

<script type="text/javascript">  
  var changepassword_url = '<?=site_url(ADMIN_DASHBOARD_PATH).'/members/change_user_password'?>';
</script>