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
    
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $modules_heading; ?></h3>
      </div><!-- /.box-header -->
      <div class="box-body" >
        <form name="sitesetting" method="post" action=""  enctype="multipart/form-data" accept-charset="utf-8" class="edit_banner_form">
          <div class="container-fluid">
            <?php if(count($lang_details)==1){?>
            <input type="hidden" name="lang" value="<?php echo $lang_details[0]->id?>" />
            <?php }else{?>
            <div class="row form-group">
              <div class="col-sm-3 text-right">
                <label>Language<span class="error text-danger">*</span></label>
              </div>
              <div class="col-sm-6">
                <select class="form-control" name="lang" onchange="redirect_lang_cms()" id="lang" style="width:142px; padding:2px 0px 2px 5px;">
                  <option value="">Select Language</option>
                  <?php foreach($lang_details as $ln_data){?>
                  <option value="<?php echo $ln_data->id;?>" <?php if($ln_data->id == $this->uri->segment(5)){echo 'selected="selected"';}?>><?php echo $ln_data->lang_name;?></option>
                  <?php }?>
                </select>
                <?=form_error('lang')?>
              </div>
            </div><!-- /row -->
            <?php }?>
            
            <div class="row form-group">
              <div class="col-sm-3 text-right">
                <label class="hmenu_font">URL</label>
              </div>
              <div class="col-sm-6">
                <input class="form-control" type="text" name="url" id="url" value="<?php echo $result_data->url;?>" />(Ex.: http://www.example.com)
              </div>
            </div><!-- /row -->

            <div class="row form-group">
              <div class="col-sm-3 text-right">
                <label class="hmenu_font">&nbsp</label>
              </div>

              <div class="col-sm-6">
                <figure>
                   <img src="<?php print(site_url($result_data->banner));?>" width="300" height="100" />
                </figure>
              </div>                
            </div><!-- /row -->

            <div class="row form-group">
              <div class="col-sm-3 text-right">
                <label class="hmenu_font">Banner<span class="error text-danger">*</span></label>
              </div>

              <div class="col-sm-6">
                <input name="banner" type="file" id="banner" />(Size 920px X 180px)
                <?=$this->upload->display_errors('<div class="error text-danger">', '</div>');?>
              </div>                
            </div><!-- /row -->

            <div class="row form-group">
              <div class="col-sm-3 text-right">
                <label class="hmenu_font">Is Display?</label>
              </div>

              <div class="col-sm-6 radio-group">
                <label>
                  <input name="is_display" type="radio" value="Yes" checked="checked" />
                  Yes
                </label> &nbsp
                <label>
                  <input name="is_display" type="radio" value="No" <?php if($result_data->is_display == 'No'){ echo 'checked="checked"';}?> />
                  No
                </label> &nbsp
              </div>                
            </div><!-- /row -->

            <div class="row form-group">
              <input type="hidden" name="old_file" value="<?php echo $result_data->banner;?>" />
              <div class="col-sm-offset-3 col-sm-6"><input class="bttn btn btn-primary" type="submit" name="Submit" value="Submit" /></div>
            </div><!-- /row -->
          </div>
        </form>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </section><!-- /Main content -->
</div>