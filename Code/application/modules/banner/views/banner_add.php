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
      </div><!-- /.box-header -->

      <div class="box-body" >
        <div class="row">

          <form name="sitesetting" method="post" action=""  enctype="multipart/form-data" accept-charset="utf-8" class="banner_add_form">
            <div class="container-fluid">

              <?php
              if(count($lang_details)==1){
                ?>
                <input type="hidden" name="lang" value="<?php echo $lang_details[0]->id?>" />
                <?php
              }else{
                ?>
                <div class="row form-group">
                  <div class="col-sm-3 text-right">
                    <label>Language<span class="error text-danger">*</span></label>
                  </div>
                  <div class="col-sm-6">
                    <select class="form-control" name="lang" onchange="redirect_lang_cms()" id="lang">
                      <option value="">Select Language</option>
                      <?php
                      foreach($lang_details as $ln_data){
                        ?>
                        <option value="<?php echo $ln_data->id;?>" <?php echo set_select('lang', $ln_data->id); ?> ><?php echo $ln_data->lang_name;?></option>
                        <?php
                      }
                      ?>
                    </select>
                    <?=form_error('lang')?>
                  </div>
                </div><!-- /row -->
                <?php
              }
              ?>
              <div class="row form-group">
                <div class="col-sm-3 text-right">
                  <label class="hmenu_font">URL</label>
                </div>
                <div class="col-sm-6">
                  <input class="form-control" type="text" name="url1" id="url1" />(Ex.: http://www.example.com)</div>
                </div><!-- /row -->

                <div class="row form-group">
                  <div class="col-sm-3 text-right">
                    <label class="hmenu_font">Banner Image1<span class="error text-danger">*</span> </label>
                  </div>

                  <div class="col-sm-6">
                    <input name="img1" type="file" id="img1" />
                    (Size 1920px X 600px)
                    <div class="error text-danger"><?=$this->session->userdata('error_img1');?></div>
                  </div>                
                </div><!-- /row -->

                <div class="row">
                  <div class="col-sm-12">
                    <hr>
                  </div>                
                </div><!-- /row -->

                <div class="row form-group">
                  <div class="col-sm-3 text-right">
                    <label class="hmenu_font">URL</label>
                  </div>                
                  <div class="col-sm-6">
                    <input class="form-control" type="text" name="url2" id="url2" />(Ex.: http://www.example.com)
                  </div>
                </div><!-- /row -->
                <div class="row form-group">
                  <div class="col-sm-3 text-right">
                    <label class="hmenu_font">Banner Image2</label>
                  </div>                
                  <div class="col-sm-6">                
                    <input name="img2" type="file" id="img2" />
                    (Size 1920px X 600px)
                    <div class="error text-danger"><?=$this->session->userdata('error_img2');?></div>                
                  </div>                
                </div><!-- /row -->

                <div class="row">
                  <div class="col-sm-12">
                    <hr>
                  </div>                
                </div><!-- /row -->

                <div class="row form-group">
                  <div class="col-sm-3 text-right">
                    <label class="hmenu_font">URL</label>
                  </div>                
                  <div class="col-sm-6">                
                    <input class="form-control" type="text" name="url3" id="url3" />(Ex.: http://www.example.com)
                  </div>                
                </div><!-- /row -->
                <div class="row form-group">
                  <div class="col-sm-3 text-right">
                    <label class="hmenu_font">Banner Image3</label>
                  </div>                
                  <div class="col-sm-6">
                    <input name="img3" type="file" id="img3" />
                    (Size 1920px X 600px)
                    <div class="error text-danger"><?=$this->session->userdata('error_img3');?></div>
                  </div>                
                </div><!-- /row -->

                <div class="row">
                  <div class="col-sm-12">
                    <hr>
                  </div>                
                </div><!-- /row -->

                <div class="row form-group">
                  <div class="col-sm-3 text-right">
                    <label class="hmenu_font">URL</label>
                  </div>                
                  <div class="col-sm-6">                
                    <input class="form-control" type="text" name="url4" id="url4" />(Ex.: http://www.example.com)
                  </div>                
                </div><!-- /row -->
                <div class="row form-group">
                  <div class="col-sm-3 text-right">
                    <label class="hmenu_font">Banner Image4</label>
                  </div>                
                  <div class="col-sm-6">    
                    <input name="img4" type="file" id="img4" />
                    (Size 1920px X 600px)
                    <div class="error text-danger"><?=$this->session->userdata('error_img4');?></div>
                  </div>                
                </div><!-- /row -->

                <div class="row form-group">                  
                  <div class="col-sm-offset-3 col-sm-6"><input class="bttn btn btn-primary" type="submit" name="Submit" value="Submit" /></div>
                </div><!-- /row -->
              </div><!-- /container -->

            </form>          
          </div>
        </div><!-- /.box-body -->

      </div>
    </section>
    <div class="clear"></div>
  </div>


