<section  id="mainB">
<h2 class="text-center pb-3"><?php echo $data_banner->name;?></h2>
  <div class="row">
	<figure class="col-md-7"><img src="<?php echo site_url(CMS_IMG_PATH.$data_banner->image);?>" width="100%"></figure>
	<div class="col-md-5 pt-5"><p class="h5 pt-5"><?php echo strip_tags($data_banner->content);?></p>
	<a class="btn btn-secondary btn-lg mt-4" href="<?php echo site_url('book-appointment-now');?>">Book Now</a></div>
  </div>
</section>

<?php if($data_serve){?>
<section class="serve text-center" id="whoWeare">
<h2 class="mt-5 mb-5 text-uppercase">Who We Serve</h2>
<div class="row whoWeAre">
	<?php foreach($data_serve as $serve){?>
	<div class="col-lg-3 col-sm-6">
		<div class="inn">
		<figure><img src="<?php echo site_url(CMS_IMG_PATH.'thumb_'.$serve->image);?>"></figure>
		<h5><?php echo $serve->name;?></h5>
		<p><?php echo $serve->content;?></p>
		</div>
	</div>
	<?php }?>
</div>
	<div class="text-center mt-5  mb-5"><a class="btn btn-secondary btn-lg" href="<?php echo site_url('book-appointment-now');?>">Book Now</a></div>	
</section>
<?php }?>


<?php if($data_condition){?>
<section class="serve text-center" id="Condition">
<h2 class="mt-5 mb-5 text-uppercase">CONDITIONS WE TREAT</h2>
<div class="row TreatCondition">
<?php foreach($data_condition as $condition){?>
	<div class="col-lg-3 col-md-4 col-sm-6"><a href="<?php echo site_url('cms/'.$condition->slug);?>" class="inn"><img src="<?php echo site_url(CMS_IMG_PATH.'thumb_'.$condition->image);?>"><p class="fs-large text-danger"><?php echo $condition->name;?></p></a></div>
    <?php }?>
</div>
</section>
<?php }?>

<?php if($data_whoare){?>
<section class="serve">
<h2 class="mt-5 mb-5 text-center text-uppercase">Who we are</h2>
<div class="row">
	<?php foreach($data_whoare as $whoare){?>
	<div class="col-md-6">
		<div class="inn p-4">
		<figure class="text-center"><img src="<?php echo site_url(CMS_IMG_PATH.'thumb_'.$whoare->image);?>"></figure>
		<h6 class="text-center mb-3 fc-blue"><?php echo $whoare->name;?><br>
		<?php echo $whoare->position;?><br>
        </h6>
		<p><?php echo $whoare->content;?></p>
		</div>
	</div>
	<?php }?>
</div>
</section>
<?php }?>

<?php if($data_team){?>
<section class="serve">
<h2 class="mt-5 mb-5 text-center">THE MEDICAL TEAM</h2>
		<div class="inn">
<div id="TeamM" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
<ol class="carousel-indicators">
<?php for($i=1; $i<=count($data_team); $i++){?>
    <li data-target="#TeamM" data-slide-to="0" class="<?php if($i==1){ echo 'active';}?>"></li>
<?php }?>
  </ol>

<?php $t=1;foreach($data_team as $data_team){?>
<div class="carousel-item <?php if($t==1){ echo 'active';}?>">			
<div class="row">
		<figure class="col-sm-5 text-center fc-blue"><img src="<?php echo site_url(CMS_IMG_PATH.$data_team->image);?>" width="100%"><figcaption class="mt-2">
		<b class="h5"><?php echo $data_team->name;?></b> <br>
		<i><?php echo $data_team->name;?></i></figcaption></figure>
		<div class="col-sm-7">
		<div class="fc-italic fc-blue testimonial"> "<?php echo $data_team->content;?>" </div>
		</div>
	</div>
</div>
 <?php $t++;}?>   
  </div>
  <a class="carousel-control-prev" href="#TeamM" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#TeamM" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
</section>

<?php }?>

<!-- <section class="review" id="reViews">
<h2 class="mt-5 mb-4 text-center text-uppercase">OUR REVIEWS</h2>
	<div class="inn p-2 pb-0">
	<iframe src="https://www-sickday-com.filesusr.com/html/b07a54_d212174289d93a5e17fabaf35fb3cd94.html" width="100%" height="400">
	</iframe>
	</div>
</section> -->