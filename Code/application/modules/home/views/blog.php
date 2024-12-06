<section class="serve">
<h2 class="mb-4 text-center text-uppercase">The SickDay Blog</h2>
<?php if($data_blog){ foreach($data_blog as $data){?>
<div class="blogBg mb-5"> 
<a class="row" href="<?php echo site_url('blog/'.$data->slug);?>">
	<div class="col-md-5">
		<figure class="mb-0"><img src="<?php echo site_url(BLOG_IMG_PATH.$data->image);?>" width="100%"></figure>
	</div>
	<div class="col-md-7 pt-4">
		<h4><?php echo $data->name;?></h4>
		<p><?php echo character_limiter(strip_tags($data->content),100);?></p>
		</div>	
	</a>
</div>
<?php }}?>
</section>