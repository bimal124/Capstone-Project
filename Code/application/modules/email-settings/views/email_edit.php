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
    <div class="alert alert-success alert-dismissible" id="msgSuccess" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> <span id="successMsg"></span></h4>
    </div>
    <div class="alert alert-danger alert-dismissible" id="msgError" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> <span id="errorMsg"></span></h4>
    </div>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $modules_heading; ?></h3>
      </div>

      <div class="box-body" >
        

        <div class="row">
          <div class="col-lg-12">
            <form name="sitesetting" method="post" action="" accept-charset="utf-8" class="email_settings_add_form">
              <div class="container-fluid">
                
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="hmenu_font">Subject</label>
                      <input size="50" class="form-control" type="text" id="subject" name="subject" value="<?php echo $email_data['subject'];?>">
                      <?=form_error('subject')?>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="hmenu_font">Email Body</label>
                      <textarea name="content" class="form-control text-editor" rows="4"><?php echo set_value('content',$email_data['email_body']);?></textarea>
                      
                      <?=form_error('content')?>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 text-center">
                    <input class="bttn btn btn-primary" type="submit" name="Submit" value="Submit" />  
                  </div>
                </div>
              </div>
            </form>
          </div>
          
        </div>
        <br>
        <div class="row">          
          <div class="col-lg-12">
            <div class="container-fluid">
              <div class="well">
                <div class="row">
                  <div class="col-md-12">
                    <strong class="text-danger">Legends (For the Dyanamic Content) </strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <strong>[SITENAME] </strong>
                  </div>
                  <div class="col-md-3">
                    Display Website Name
                  </div>
                  

                  <div class="col-md-3">
                    <strong>[CONFIRM] </strong>
                  </div>
                  <div class="col-md-3">
                    Registration confirm link
                  </div>
                  <div class="col-md-3">
                    <strong>[AMOUNT] </strong>
                  </div>
                  <div class="col-md-3">
                    Amount
                  </div>
                  <div class="col-md-3">
                    <strong>[DATE] </strong>
                  </div>
                  <div class="col-md-3">
                    Date and Time
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="clear"></div>
</div>

<script src="<?php echo site_url(ASSETS_PATH."ckeditor/ckeditor.js");?>"></script>
<script src="<?php echo site_url(ASSETS_PATH."ckfinder/ckfinder.js");?>"></script>
<script>var  BASE_URL = "<?php echo base_url()?>";</script>
<script src="<?php echo site_url(ASSETS_PATH."ckeditor/ckeditor-toolbar-configure.js");?>"></script>
