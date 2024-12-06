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
          
			<input type="hidden" name="cms_id" value="<?=$cms_data->id?>" />
            <input type="hidden" name="img_old" value="<?=$cms_data->image?>" />
            <div class="row">
              <div class="col-sm-9">
                <div class="form-group">
                  <label class="hmenu_font">Title <span class="mandatory-field">*</span></label>
                  <input name="name" type="text" class="form-control form-control" id="name" value="<?php echo set_value('name',$cms_data->name);?>" size="15" />
                  <?=form_error('name')?>
                </div>
              </div>
                <div class="col-sm-3">
                                <div class="form-group">
                                <br />
                                  <label class="hmenu_font">Is Display? <span class="mandatory-field">*</span></label>
                                 
                                  <div class="radio-group">
                                    <label>
                                      <input name="is_display" type="radio" value="1" checked="checked" />
                                      Yes
                                    </label>&nbsp
                                    <label>
                                      <input name="is_display" type="radio" value="0"  <?php if((isset($_POST['is_display']) && $_POST['is_display'] == '0') || $cms_data->is_display == '0'){ echo 'checked="checked"';}?>  />
                                      No  </label>&nbsp
                                    </div>
                                     <?=form_error('is_display')?>
                                  
                                 
                                </div>
                              </div>
              

              

            </div>
            
            <div class="row">
            <?php if($type_id == 3 || $type_id == 4){?>
              <div class="col-sm-9">
                <div class="form-group">
                  <label class="hmenu_font">Position <span class="mandatory-field">*</span></label>
                  <input name="position" type="text" class="form-control" id="position" value="<?php echo set_value('position',$cms_data->position);?>" size="15" />
                  <?=form_error('position')?>
                </div>
              </div>
				<?php }?>
                <div class="col-sm-3">
                <div class="form-group">
                  <label class="hmenu_font">Image <span class="mandatory-field">*</span> <small style="font-weight:normal">(Recomended Size 800 x 600)</small></label>
                  <input name="image" type="file" class="form-control form-control" id="image" value="<?php echo set_value('image');?>" size="15" />
                  <?php echo $this->upload->display_errors('<div class="text-red">', '</div>');?>
                </div>
              </div>
            </div>
            
            <div class="row">
            
              <div class="col-sm-9">
                <div class="form-group">
                  <label class="hmenu_font">Description <span class="mandatory-field">*</span></label>
                  <textarea name="content" class="form-control text-editor" rows="4"><?php echo set_value('content',$cms_data->content);?></textarea>
                  <?=form_error('content')?>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
				<label class="hmenu_font">&nbsp;</label>
				<img src="<?php print(site_url(CMS_IMG_PATH.$cms_data->image));?>" style="max-width:250px;" />
                </div>
              </div>

              </div>


            <div class="row">
              <div class="col-md-12 text-center">
                <input class="bttn btn btn-primary" type="submit" name="Submit" value="SUBMIT" />  
              </div>
            </div>
         
        </form>        
      </div><!-- /.box-body -->

    </div><!-- /.box -->

  </section><!-- /Main content -->
</div>

<script src="<?php echo site_url(ASSETS_PATH."ckeditor/ckeditor.js");?>"></script>
<script src="<?php echo site_url(ASSETS_PATH."ckfinder/ckfinder.js");?>"></script>
<script>var  BASE_URL = "<?php echo base_url()?>";</script>
<script src="<?php echo site_url(ASSETS_PATH."ckeditor/ckeditor-toolbar-configure.js");?>"></script>
