<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $template['title']; ?></title>
  <link rel="shortcut icon" href="<?php echo site_url('favicon.png');?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- favicon -->
  <?php /* ?><link rel="icon" type="image/png"  href="<?php echo base_url() . DEFAULT_IMG_DIR; ?>favicon.png"/><?php */ ?>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo  site_url(ADMIN_CSS_DIR_FULL_PATH); ?>bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo  site_url(ASSETS_PATH); ?>bootstrap/css/bootstrap-datetimepicker.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo  site_url(ASSETS_PATH); ?>font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="<?php echo  site_url(ADMIN_CSS_DIR_FULL_PATH); ?>select2.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo  site_url(ADMIN_CSS_DIR_FULL_PATH); ?>AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo  site_url(ADMIN_CSS_DIR_FULL_PATH); ?>_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo site_url(ADMIN_CSS_DIR_FULL_PATH); ?>blue.css">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo  site_url(ADMIN_CSS_DIR_FULL_PATH); ?>emts.css">
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo site_url(ASSETS_PATH); ?>js/jqueryui/jquery-ui.min.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo site_url(ASSETS_PATH); ?>js/jqueryui/jquery-ui-timepicker-addon.css" />

  <link rel="stylesheet" href="<?php echo  site_url(ADMIN_CSS_DIR_FULL_PATH); ?>bootstrap-multiselect.css">
  <link rel="stylesheet" href="<?php echo  site_url(ADMIN_CSS_DIR_FULL_PATH); ?>style_new.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<?php
$profile_img = '';

if($this->session->userdata('ADMIN_PROFILE_IMG'))
$profile_img = site_url(ADMIN_IMG_DIR_FULL_PATH).$this->session->userdata('ADMIN_PROFILE_IMG');

if($profile_img==''){
  $profile_img = site_url(ADMIN_IMG_DIR_FULL_PATH).'admin_default_image.png';
}
?>
<body class="sidebar-mini skin-green">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?= site_url(ADMIN_DASHBOARD_PATH)?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>R</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin </b><?php echo SITE_NAME; ?></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">



            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="min-height: 50px;">
               <img src="<?php echo $profile_img; ?>" class="user-image" alt="User Image">
               <span class="hidden-xs"></span>
             </a>
             <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $profile_img; ?>" class="img-circle" alt="User Image">

                <p></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/profile');?>" name="" class="btn btn-default btn-flat update_admindata">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
            <?php /* ?><li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li><?php */ ?>
            </ul>
          </div>

          <div style=" float:right; padding:8px; color:#000000; text-align:right; line-height: 16px;" >
           <span id="clock" style=" font-family:Verdana, Geneva, sans-serif; font-size:18px; color:#FFF;"></span>
           <br><span style="font-weight:bolder; ">
             <?php echo $this->general->date_formate($this->general->get_local_time('none'));?>
           </span>
         </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview <?php echo ($active_menu == 'dashboard')?'active':'';?>">
              <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>            
              </a>          
            </li>

            <li class="active">
              <a href="javascript:void(0);">
                <i class="fa fa-user"></i> <span>Member Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              
              <ul class="treeview-menu">
                <li class="<?php echo ($active_submenu == 'patients')?'active':'';?>"><?php echo anchor(ADMIN_DASHBOARD_PATH.'/members/index/1', '<i class="fa fa-circle-o"></i> Private Patients', 'title="Patients"');?></li>
                <li class="<?php echo ($active_submenu == 'providers')?'active':'';?>"><?php echo anchor(ADMIN_DASHBOARD_PATH.'/providers/index/1', '<i class="fa fa-circle-o"></i> Providers', 'title="Providers"');?></li>
                <li class="<?php echo ($active_submenu == 'companies')?'active':'';?>"><?php echo anchor(ADMIN_DASHBOARD_PATH.'/companies/index/1', '<i class="fa fa-circle-o"></i> Companies', 'title="Companies Members"');?></li>
              </ul>
            </li>
            
            
            <li class="active">
              <a href="javascript:void(0);">
                <i class="fa fa-medkit"></i> <span>Medical Requests</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              
              <ul class="treeview-menu">
                <li class="<?php echo ($active_submenu == 'new_patient')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/medical/patients/new')?>"><i class="fa fa-circle-o"></i> New Patients </a></li>
                <li class="<?php echo ($active_submenu == 'rejected_patient')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/medical/rejected_patients')?>"><i class="fa fa-circle-o"></i> Rejected Patients </a></li>
                <li class="<?php echo ($active_submenu == 'patient_history')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/medical/patients/history')?>"><i class="fa fa-circle-o"></i> Patients History </a></li>
               
              </ul>
            </li>

            <li class="active">
              <a href="javascript:void(0);">
                <i class="fa fa-cog"></i> <span>Others Menu</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">                
              	
              	<li class="<?php echo ($active_submenu == 'transaction')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/transaction/index')?>"><i class="fa fa-circle-o"></i> Transaction History </a></li>
                <!-- <li class="<?php echo ($active_submenu == 'payment_settings')?'active':'';?>"><a href="#<?php echo site_url(ADMIN_DASHBOARD_PATH.'/payment/index')?>"><i class="fa fa-circle-o"></i> Payment Gateway </a></li> -->
                <li class="<?php echo ($active_submenu == 'site-settings')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/site-settings/index')?>"><i class="fa fa-circle-o"></i> Site Settings</a></li>
                <li class="<?php echo ($active_submenu == 'email-settings')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/email-settings/index/register_notification')?>"><i class="fa fa-circle-o"></i> E-mail Settings</a></li>                
<?php /*?>                <li class="<?php echo ($active_submenu == 'blockip_management')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/block-ip/index')?>"><i class="fa fa-circle-o"></i> Blocked IP Management</a></li>                <?php */?>
                <li class="<?php echo ($active_submenu == 'change-password')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/change-password/index')?>"><i class="fa fa-circle-o"></i> Change Password</a></li>
               
              </ul>
            </li>
			
            <li class="active">
              <a href="javascript:void(0);">
                <i class="fa fa-medkit"></i> <span>Content Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              
              <ul class="treeview-menu">
                <li class="<?php echo ($active_submenu == 'who-we-serve')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/cms/who-we-serve')?>"><i class="fa fa-circle-o"></i> Who We Serve </a></li>
                <li class="<?php echo ($active_submenu == 'conditions')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/cms/conditions')?>"><i class="fa fa-circle-o"></i> Conditions </a></li>
                <li class="<?php echo ($active_submenu == 'who-we-are')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/cms/who-we-are')?>"><i class="fa fa-circle-o"></i> Who We Are </a></li>
                <li class="<?php echo ($active_submenu == 'medical-team')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/cms/medical-team')?>"><i class="fa fa-circle-o"></i> Medical Team </a></li>
                <li class="<?php echo ($active_submenu == 'others-cms')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/cms/others-cms')?>"><i class="fa fa-circle-o"></i> Others CMS </a></li>
                <li class="<?php echo ($active_submenu == 'blog')?'active':'';?>"><a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/blog/index')?>"><i class="fa fa-circle-o"></i> Blog </a></li>
               
              </ul>
            </li>
            
          </ul>
        </section><!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <?php echo $template['body']; ?>
      <!-- /.content-wrapper -->

      <footer class="main-footer">

        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.emultitechsolution.com">E-multiechsolution Pvt. Ltd.</a>.</strong> All rights
        reserved.
      </footer>

    </div><!-- ./wrapper -->
    <script>
    var csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrf_token_value = '<?php echo $this->security->get_csrf_hash(); ?>';
    var siteurl='<?php echo base_url();?>';
    var baseUrl='<?=base_url()?>'
	var admindata_limit = '<?php echo ADMIN_RECORDS_PER_PAGINATION; ?>';
    var admindata_offset = 0;
    </script>
  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>jquery-2.2.3.min.js"></script>
  <script src="<?php echo site_url(ASSETS_PATH); ?>js/jqueryui/jquery-ui.min.js"></script>
  <script src="<?php echo  site_url(MAIN_JS_DIR_FULL_PATH); ?>moment.min.js"></script>
  <script src="<?php echo  site_url(MAIN_JS_DIR_FULL_PATH); ?>moment-timezone.min.js"></script>
  <script src="<?php echo site_url(ADMIN_JS_DIR_FULL_PATH);?>timer.js"></script>  
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>bootstrap.min.js"></script>
  
  <script src="<?php echo  site_url(ASSETS_PATH); ?>bootstrap/js/bootstrap-datetimepicker.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>fastclick.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>demo.js"></script>

  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>jquery.validate-1.11.1.min.js" ></script>

  <!-- iCheck -->
  <script src="<?php echo site_url(ADMIN_JS_DIR_FULL_PATH); ?>icheck.min.js"></script>

  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>select2.full.min.js"></script>
  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>bootstrap-multiselect.js"></script>

  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>additional-methods.js" ></script>
  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>admin-common.js"></script>
  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>validation-forms.js"></script>
  <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>admin-administration.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  
  <!-- Load Page JS -->

  <?php $module = $this->router->fetch_module();?>
  <?php
  if ($module == 'members' || $module == 'providers' || $module == 'companies') { 
    ?>
    <script src="<?php echo site_url(ADMIN_JS_DIR_FULL_PATH); ?>admin-member.js"></script>
    <?php
  }
  ?>
  
  <?php
  if ($module == 'email-settings') { 
    ?>
   <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>admin.add.edit.emailsettings.js"></script>
    <?php
  }
  ?>
  
  
  <?php
  if ($module == 'block-ip') { 
    ?>
   <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>admin.add.edit.blockedip.js"></script>
    <?php
  }
  ?>
  <?php
  if ($module == 'change-password') { 
    ?>
   <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>admin.change.password.js"></script>
    <?php
  }
  ?>
 
  <?php
  if ($module == 'site-settings') { 
    ?>
   <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>site_settings.js"></script>
    <?php
  }
  ?>
  

  <?php
  if ($module == 'dashboard') { 
    ?>
   <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>admin.dashboard.js"></script>
   
     <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js'></script>
    
  <?php

  }
  ?>

  <?php
  if ($module == 'payment') { 
    ?>
   <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>admin-paymentgateway.js"></script>    
  <?php

  }
  ?>
  <?php
  if ($module == 'medical' || $module == 'transaction') { 
    ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('.select2').select2();
});
</script>  

   <script src="<?php echo  site_url(ADMIN_JS_DIR_FULL_PATH); ?>admin-transaction.js"></script>    

<?php

  }
  ?>
 

</body>
</html>
