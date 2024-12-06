<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php echo $template['title']; ?></title>
<meta name="keywords" content="<?php echo $meta_keys;?>" />
<meta name="description" content="<?php echo $meta_desc;?>">
  <script src="https://apis.google.com/js/api:client.js"></script>

<link rel="shortcut icon" href="<?php echo base_url(MAIN_IMG_DIR_FULL_PATH.'fav.png');?>" type="image/x-icon">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- FOR DATE PICKER-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/Date-Time-Picker-Bootstrap-4/build/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="<?php echo site_url(MAIN_CSS_DIR_FULL_PATH.'style.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url(MAIN_CSS_DIR_FULL_PATH.'emts.css'); ?>">

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId=344490380534164&autoLogAppEvents=1" nonce="iNpmlsji"></script>

<header>
<nav class="navbar navbar-expand-lg fixed-top pt-0 navbar-light bg-white pb-0">
  <div class="container-fluid">
  <h1 title="DrSathi" class="mb-0" style="min-width:30%;"><a class="navbar-brand" href="<?php echo site_url();?>"><img src="<?php echo site_url(MAIN_IMG_DIR_FULL_PATH.'logo.jpg');?>" alt="drsathi" style="
    height: 80px;
"></a></h1>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active"><a class="nav-link" href="<?php echo site_url('');?>#whoWeare">WHO WE SERVE</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('');?>#Condition">CONDITIONS</a></li>
        <!-- <li class="nav-item"><a class="nav-link" href="<?php echo site_url('blog');?>">BLOG</a></li> -->
      <li class="nav-item"><a class="nav-link" href="<?php the_permalink('book-appointment-now')?>">BOOK NOW</a></li>

        <?php 
if(!$this->session->userdata(SESSION.'user_id')){?>
        <li class="nav-item"><a class="nav-link showLogin" href="">LOGIN</a></li>
      <?php }else{?>
        <li class="nav-item"><a class="nav-link showLogin" href="<?php the_permalink('my-account/user/profile')?>">MY PROFILE</a></li>
      <?php } ?>

        <!-- <li class="nav-item"><a class="nav-link fc-warning" href="<?php echo site_url('');?>#reViews">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
		  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
		  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
		  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
		  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
		  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
		</svg>
	5.0 Google Review</a></li> -->
    </ul>
  </div>
</div>
</nav>
</header>
