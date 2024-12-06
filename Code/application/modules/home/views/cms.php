<section class="serve text-center">
<h3 class="mb-4 text-uppercase"><?php echo $data_cms->name;?></h3>
<figure><img src="<?php echo site_url(CMS_IMG_PATH.$data_cms->image);?>"></figure>

		<a class="btn btn-secondary mt-4 mb-4" href="javascript:window.history.back();<?php //echo site_url('');?>">Back to Conditions</a>

<p><?php echo $data_cms->content;?></p>

</section>