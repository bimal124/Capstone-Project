<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function the_permalink($link=NULL,$param1 = NULL, $param2 = NULL, $param3 = NULL)
{
	if($param3 != NULL){
		echo base_url($link.'/'.$param1.'/'.$param2.'/'.$param3);
	}else if($param2 != NULL){
		echo base_url($link.'/'.$param1.'/'.$param2);
	}else if($param1 != NULL){
		echo base_url($link.'/'.$param1);
	}else{
		echo base_url($link);
	}
	return false;
}

function the_date($date = NULL)
{
	return date('m.d.y', strtotime($date));
}

function the_time($date = NULL)
{
	return date('h:i A', strtotime($date));
}

function get_the_image($folder = NULL,$file = NULL)
{
	return base_url().UPLOAD_BASE_PATH.$folder.'/'.$file;
}