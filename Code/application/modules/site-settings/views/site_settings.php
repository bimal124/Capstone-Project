<div class="content-wrapper">


 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1>
    <?php echo $modules_name; ?>
  </h1>      
  <?php echo $this->breadcrumb->output(); ?>
</section>

<!-- Main content -->
<section class="content">

  <?php if ($this->session->flashdata('message')) { ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('message'); ?></h4>
  </div>
  <?php } ?>

<form name="sitesetting" method="post" action="" accept-charset="utf-8" id="siteSettingsForm" enctype="multipart/form-data">
  <div class="box">
   <div class="box-header with-border">
    <h3 class="box-title">System General Settings</h3>
  </div>
  <div class="box-body" >
    
      <div class="container-fluid">


        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Website Name <span class="text-red">*</span></label>
              <input type=text name="site_name" class="form-control" size=45 value="<?php echo set_value('site_name',$site_set['site_name']);?>">
              <?=form_error('site_name')?>
            </div>
          </div>
		  
          <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Default Time Zone <span class="text-red">*</span></label>
              <?php
                   
                        $default_timezone = set_value('timezone',$site_set['timezone']);                    
                        echo $this->general->timezone_list('timezone', $default_timezone);
                        echo form_error('timezone');
                    ?>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Currency Code <span class="text-red">*</span></label>
              <input name="currency_code" type=text class="form-control" id="currency_code" value="<?php echo set_value('currency_code',$site_set['currency_code']);?>" size=45><?=form_error('currency_code')?>
            </div>
          </div>
          
          <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Currency Sign <span class="text-red">*</span></label>
              <input name="currency_sign" type=text class="form-control" id="currency_sign" value="<?php echo set_value('currency_sign',$site_set['currency_sign']);?>" size=45><?=form_error('currency_sign')?>
            </div>
          </div>
          
        
          
          </div>
          
        
        
        <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Contact Email <span class="text-red">*</span></label>
              <input name="contact_email" type=text class="form-control" id="contact_email" value="<?php echo set_value('contact_email',$site_set['contact_email']);?>" size=45><?=form_error('contact_email')?>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Website Status <span class="text-red">*</span></label>
              <select name="site_status" id="site_status" class="form-control">
					<option value="offline" <?php if($site_set['site_status'] == 'offline'){ echo 'selected="selected"';}?>>Offline</option> 
					<option value="online" <?php if($site_set['site_status'] == 'online'){ echo 'selected="selected"';}?> >Online</option>
                    <option value="maintanance" <?php if($site_set['site_status'] == 'maintanance'){ echo 'selected="selected"';}?>>Maintenance</option>                 
                   </select>
              
            </div>
          </div>

          <div class="col-sm-3" id="maintainance_key" <?php if($site_set['site_status'] != 'maintanance'){ echo 'style="display:none"';}?>>
            <div class="form-group">
              <label class="hmenu_font">Maintanance Key </label>
              <input type="text" name="maintainance_key" class="form-control" size=45 value="<?php echo set_value('maintainance_key',$site_set['maintainance_key']);?>">
              <?=form_error('maintainance_key')?>
            </div>
          </div>

          
        </div>
        
      </div>
    
  </div>
  </div>
  
  
  
  
  <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">System E-Mail Settings</h3>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
          	<div class="col-md-12">           
            <div class="col-md-3">
              <div class="form-group">
                <label>Choose Mailer </label>                
                <select name="mailing_type" id="mailing_type"  class="form-control">
					<option value="1" <?php if($site_set['mailing_type'] == '1'){ echo 'selected="selected"'; } ?>>PHP Mail</option> 
					<option value="2" <?php if($site_set['mailing_type'] == '2'){ echo 'selected="selected"'; } ?>>Sendmail</option>
                    <option value="3" <?php if($site_set['mailing_type'] == '3'){ echo 'selected="selected"'; } ?>>SMTP</option>
                    </select>
                <?php echo form_error('mailing_type'); ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>System Email Name</label>                
                <input type="text" name="system_email_name" id="system_email_name" value="<?php echo set_value('system_email_name',$site_set['system_email_name']);?>" class="form-control">
					
                <?php echo form_error('system_email_name'); ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email Address</label>
                <input type="text" name="system_email" id="system_email" value="<?php echo set_value('system_email',$site_set['system_email']);?>" class="form-control">
                <?php echo form_error('system_email'); ?>
              </div>
              
            </div>
            
            <div class="col-md-3 smtp" <?php if($this->input->post('mailing_type')==3 || $site_set['mailing_type'] == '3'){echo 'style="display:block;"';}?>>
              <div class="form-group">
                <label>SMTP Host</label>
                <input type="text" name="smtp_host" id="smtp_host" value="<?php echo set_value('smtp_host',$site_set['smtp_host']);?>" class="form-control">
                <?php echo form_error('smtp_host'); ?>
              </div>
              
            </div>
           
            
            </div>
            
          </div>
          
          <div class="row">
          	<div class="col-md-12 smtp" <?php if($this->input->post('mailing_type')==3 || $site_set['mailing_type'] == '3'){echo 'style="display:block;"';}?>>           
            <div class="col-md-3">
              <div class="form-group">          
                <label>SMTP Port</label>                
                <input type="text" name="smtp_port" id="smtp_port" value="<?php echo set_value('smtp_port',$site_set['smtp_port']);?>" class="form-control">
                <?php echo form_error('smtp_port'); ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>SMTP Username</label>                
                <input type="text" name="smtp_username" id="smtp_username" value="<?php echo set_value('smtp_username',$site_set['smtp_username']);?>" class="form-control">
					
                <?php echo form_error('smtp_username'); ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>SMTP Password</label>
                <input type="password" name="smtp_password" id="smtp_password" value="<?php echo set_value('smtp_password',$site_set['smtp_password']);?>" class="form-control">
                <?php echo form_error('smtp_password'); ?>
              </div>
              
            </div>
            
            
           
            
            </div>
            
          </div>
        </div>
       
      </div>
      
  <div class="box">
   <div class="box-header with-border">
    <h3 class="box-title">Social Settings</h3>
  </div>
  <div class="box-body" >
    
      <div class="container-fluid">


        
        
        
        <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Facebook Page URL </label>
              <input type="text" name="facebook_url" class="form-control" size="45" value="<?php echo set_value('facebook_url',$site_set['facebook_url']);?>" />
              (Ex.:http://www.facebook.com)
            </div>
          </div>
          <?php /*?><div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Facebook App ID </label>
              <input type="text" name="facebook_id" class="form-control" size="45" value="<?php echo set_value('facebook_id',$site_set['facebook_id']);?>" />

            </div>
          </div><?php */?>
          
          <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Instagram Page URL </label>
              <input type="text" name="instagram_url" class="form-control" size="45" value="<?php echo set_value('instagram_url',$site_set['instagram_url']);?>" />
              (Ex.:http://www.instagram.com)
            </div>
          </div>
          
         <?php /*?> <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Twitter Page URL </label>
              <input type="text" name="twitter_url" class="form-control" size="45" value="<?php echo set_value('twitter_url',$site_set['twitter_url']);?>" />
              (Ex.:http://www.twitter.com)
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Linkedin Page URL </label>
              <input type="text" name="linkedin_url" class="form-control" size="45" value="<?php echo set_value('linkedin_url',$site_set['linkedin_url']);?>" />
              (Ex.:http://www.linkedin.com)
            </div>
          </div><?php */?>
        </div>
        
        
      </div>
            
  </div>
  </div>

  <div class="box">
   <div class="box-header with-border">
    <h3 class="box-title">Payment Gateway Setting</h3>
  </div>
  <div class="box-body" >
    
      <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Login Id </label>
              <input type="text" name="login_id" class="form-control" value="<?php echo set_value('login_id',$site_set['login_id']);?>" />
            </div>
          </div>
          
          <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Transaction Key</label>
              <input type="text" name="transaction_key" class="form-control" size="45" value="<?php echo set_value('transaction_key',$site_set['transaction_key']);?>" />
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">Environment</label>
              <select name="transaction_env" class="form-control">
                <option value="SANDBOX">Test</option>
                <option value="PRODUCTION" <?=($site_set['transaction_env'] == 'PRODUCTION')?'selected':''?>>Live</option>
              </select>
            </div>
          </div>
          
        </div>
        
        
      </div>
            
  </div>
  </div>
  
  <div class="box">
   <div class="box-header with-border">
    <h3 class="box-title">Others Setting</h3>
  </div>
  <div class="box-body" >
    
      <div class="container-fluid">


        
        
        
        
        <div class="row">
          

          

          <div class="col-sm-3">
            <div class="form-group">
              <label class="hmenu_font">HTML Tracking Codes </label>
              <textarea class="form-control" name="html_tracking_code" rows="5" id="html_tracking_code"><?php echo set_value('html_tracking_code',$site_set['html_tracking_code']);?></textarea>
            </div>
          </div>
          
          
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <input class="bttn btn btn-primary" type="submit" name="Submit" value="Update" />  
          </div>
        </div>
      </div>
    
  </div>
  </div>
  </form>
</section>
</div>