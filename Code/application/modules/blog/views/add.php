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
          

            <div class="row">
              <div class="col-sm-8">
                <div class="form-group">
                  <label class="hmenu_font">Title <span class="mandatory-field">*</span></label>
                  <input name="name" type="text" class="form-control form-control" id="name" value="<?php echo set_value('name');?>" size="15" />
                  <?=form_error('name')?>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Image <span class="mandatory-field">*</span> <small style="font-weight:normal">(Recomended Size 800 x 600)</small></label>
                  <input name="image" type="file" class="form-control form-control" id="image" value="<?php echo set_value('image');?>" size="15" />
                  <?php echo $this->upload->display_errors('<div class="text-red">', '</div>');?>
                </div>
              </div>

              

            </div>
            
            
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Author <span class="mandatory-field">*</span></label>
                  <input name="blogger_name" type="text" class="form-control" id="blogger_name" value="<?php echo set_value('blogger_name');?>" size="15" />
                  <?=form_error('blogger_name')?>
                </div>
              </div>
              
              <div class="col-sm-4">              
              <label class="hmenu_font">Post Date <span class="mandatory-field">*</span></label>
              <div class="input-group" id="datetime_picker">
                <input name="post_date" type="text" class="form-control" id="post_date" value="<?php echo set_value('post_date');?>" size="20" autocomplete="off">
                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
                </span>
              </div>
               <?=form_error('post_date')?>
            </div>
            
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="hmenu_font">Is Display? <span class="mandatory-field">*</span></label>
                  <div class="row">
                  <div class="col-sm-12 radio-group">
                    <label>
                      <input name="is_display" type="radio" value="1" checked="checked" />
                      Yes
                    </label>&nbsp
                    <label>
                      <input name="is_display" type="radio" value="0"  <?php if(isset($_POST['is_display']) && $_POST['is_display'] == '0'){ echo 'checked="checked"';}?>  />
                      No  </label>&nbsp
                    </div>
                     <?=form_error('is_display')?>
                  </div>
                 
                </div>
              </div>

            </div>
           
            
            <div class="row">
            
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="hmenu_font">Description <span class="mandatory-field">*</span></label>
                  <textarea name="content" class="form-control text-editor" rows="4"><?php echo set_value('content');?></textarea>
                  <?=form_error('content')?>
                </div>
              </div>
              

              </div>


            <div class="row">
              <div class="col-md-12 text-center">
                <input class="bttn btn btn-primary" type="submit" name="Submit" value="SUBMIT" />  
              </div>
            </div>
         
        </form>        
      </div>

    </div>

  </section><!-- /Main content -->
</div>

<script src="<?php echo site_url(ASSETS_PATH."ckeditor/ckeditor.js");?>"></script>
<script src="<?php echo site_url(ASSETS_PATH."ckfinder/ckfinder.js");?>"></script>
<script>var  BASE_URL = "<?php echo base_url()?>";</script>
<script src="<?php echo site_url(ASSETS_PATH."ckeditor/ckeditor-toolbar-configure.js");?>"></script>
