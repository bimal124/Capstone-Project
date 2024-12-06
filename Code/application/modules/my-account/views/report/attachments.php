<ol><?php 
if(!empty($attachments)){
	foreach ($attachments as $value) { ?>
	<li><a href="<?php echo get_the_image('attachments',$value->patient_id.'/'.$value->name)?>" target="_blank"><?php echo $value->name?></a> <a href="" class="remove-attachment" style="color: red;" title="Remove" data-attachment_id="<?php echo $value->id?>">X</a></li>
<?php } }else{
	echo "No files found";}?>
	</ol>