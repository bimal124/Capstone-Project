<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->page_title;?></title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<header>
  
  
  <nav class="navbar mb-0 radius-0  text-center">
    <div class="container">
      
      <h1 class="m-0 p-0"><a href="<?php echo site_url();?>"><img src="<?php echo MAIN_IMG_DIR_FULL_PATH;?>logo.png" alt="logo bidcoin" title="bidcoin.io"></a></h1>
      
      <!-- /.navbar-collapse --> 
    </div>
    <!-- /.container-fluid --> 
  </nav>
  
</header>

<section class="ptb-40 bg-gray cms-part">
    <div class="container text-center">
    	<div class="modal-dialog" role="document">  
  <div class="modal-content">
        
      <div class="modal-body">
      <h2><?php if(isset($offline_msg->heading))echo $offline_msg->heading;?></h2>
    	<p><?php if(isset($offline_msg->content))echo $offline_msg->content;?></p>
      
            
      
      </div>
    </div>
  </div>
       
    </div>
  </section>
  
</body>
</html>
