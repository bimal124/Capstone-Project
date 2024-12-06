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

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $modules_heading; ?></h3>
      </div><!-- /box-header -->
      <div class="box-body">
        <div class="row">
          <form name="sitesetting" method="post" action="" class="edit_blockip_form"  enctype="multipart/form-data">
            <div class="container-fluid">
              <div class="row form-group">
                <div class="col-sm-3 text-right">
                  <label class="hmenu_font">IP Address</label>
                </div>
                <div class="col-sm-6">
                  <input name="ip_address" type="text" class="form-control" id="ip_address" value="<?php echo set_value('ip_address',$data_ip->ip_address);?>" size="30" />
                  <?=form_error('ip_address')?>
                </div>
              </div><!-- /row -->
              <div class="row form-group">
                <div class="col-sm-3 text-right">
                  <label class="hmenu_font">Message</label>
                </div>
                <div class="col-sm-6">
                  <textarea name="message" cols="50" class="form-control" id="message"><?php echo set_value('message',$data_ip->message);?></textarea>
                  <?=form_error('message')?>
                </div>
              </div><!-- /row -->
              <div class="row form-group">                  
                <div class="col-sm-offset-3 col-sm-6"><input class="bttn btn btn-primary" type="submit" name="Submit" value="Submit" /></div>
              </div><!-- /row -->
            </div><!-- /container -->
          </form>
        </div><!-- /row -->
      </div><!-- box-body -->
    </div><!-- /box -->
  </section>
</div><!-- /content-wrapper -->