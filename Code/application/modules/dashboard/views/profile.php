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
    <h3 class="box-title">Admin Profile</h3>
  </div>
  <div class="box-body" >
    
      <div class="container-fluid">


        <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Username <span class="text-red">*</span></label>
                                                        <input type="text" value="<?=$profile_data->user_name?>" class="form-control" placeholder="Enter Username" name="user_name">
                                                        <?=form_error('user_name')?>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email<span class="text-red">*</span> </label>
                                                        <input type="text" value="<?=$profile_data->email?>" class="form-control" placeholder="Enter Email Address" name="email">
                                                        <?=form_error('email')?>

                                                    </div>
                                                </div>
                                                
                                               
          
          <div class="col-md-6 " id="passfield">
                                                    <div class="form-group">
                                                        <label>Password <span class="text-red">*</span></label>
                                                        <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password">
                                                        <?=form_error('password')?></div>
                                                </div>
                                                <div class="col-md-6" id="confield">
                                                    <div class="form-group">
                                                        <label>Confirm Password<span class="text-red">*</span> </label>
                                                        <input type="password" class="form-control" placeholder="Retype Password" name="conf" id="conf">
                                                        <?=form_error('conf')?></div>
                                                </div>
          

                                                
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="img_sec">
                                                <?php if($profile_data->image){?>
                                                    <img class="img-responsive" src="<?=ADMIN_IMG_DIR_FULL_PATH.$profile_data->image?>" id="img_pic">
                                                 <?php }else{?>
                                                 <img class="img-responsive" src="<?=ADMIN_PROFILE_DEFAULT_IMG?>" id="img_pic">
                                                 <?php }?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Select File</label>
                                                    <input type="file" name="image" id="img">
                                                    <?=form_error('image')?>
                                                   <p class="text-info">Recommended (140X140)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
          
        
        
        
        
      </div>
    
  </div>
  </div>
  
  
  
  
  
  <div class="box">
   
  <div class="box-body" >
    
      <div class="container-fluid">


        
        
        
        
        
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
