<section class="blogDetail">
<div class="row mb-4">
<h5 class="col-sm-6">All Posts</h5>
<form class="col-sm-6">
<div class="input-group">
  <input type="text" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
  <div class="input-group-append">
  	<button class="btn btn-info btn-sm">Search</button>
  </div>
</div>
</form>
</div>


<div class="blogd inn p-5">

<div class="titleSec">
	<div class="float-left">
	<p><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
	  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
	  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
	</svg></a>  March 8 2021 - 3 Min Read </p>
	</div>

	<div class="dropdown dropleft float-right">
	<a href="" class="" role="button" id="share" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
	  <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
	</svg>
	</a>
	<div class="dropdown-menu p-0" aria-labelledby="share">
	    <a class="dropdown-item" href="#">Share</a>
	  </div>
	</div>
	<div class="clearfix"></div>
</div>



<div class="MidBlog mb-5">
	<h4><?php echo $data_cms->name;?></h4>
	<figure class="mt-5 mb-2 text-center"><img src="<?php echo site_url(BLOG_IMG_PATH.$data_cms->image);?>"></figure>
	<p><?php echo $data_cms->content;?></p>
</div>



<div class="CommentSec">
	<hr>

	<a href="https://www.facebook.com/sickdayNYC" title="sickdayNYC" class="mr-2">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
				  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
				</svg>
				</a>
				<a href="https://www.instagram.com/sickdaynyc/" title="sickdaynyc"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16"><path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/></svg>
				</a>
	<hr>
	<p><span><?php echo $data_cms->views?> Views</span> <span class="fb-comments-count" data-href="<?php echo base_url('blog/'.$data_cms->slug)?>"></span> Comments
 	</p>	
<div class="fb-comments" data-href="<?php echo base_url('blog/'.$data_cms->slug)?>" data-width="100%" data-numposts="5"></div>

</div>
</div>


<div class="OtherPost mt-5">
	<h5>Recent Posts <a href="blog.php" class="small float-right">See All</a></h5>
	<div class="row mt-4">
	<?php if($data_other){foreach($data_other as $other_blog){?>
	<div class="col-sm-4">
		<div class="inn">
		<figure class="mb-3">
			<a href="<?php echo site_url('blog/'.$other_blog->slug);?>">
				<img src="<?php echo site_url(BLOG_IMG_PATH.'thumb_'.$other_blog->image);?>" width="100%"></a></figure>
		<h6><?php echo $other_blog->name;?></h6>
		<p><?php echo character_limiter(strip_tags($other_blog->content),100);?></p><hr>
		<span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
		  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
		  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
		</svg> <?php echo $other_blog->views?></span>

		<span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left" viewBox="0 0 16 16">
		  <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
		</svg> <span class="fb-comments-count" data-href="<?php echo base_url('blog/'.$other_blog->slug)?>"></span></span> 
	  </div>
	</div>
	<?php }}?>

	</div>
</div>



</section>