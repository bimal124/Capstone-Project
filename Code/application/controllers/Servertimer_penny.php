<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Servertimer_penny extends CI_Controller {

    function __construct()
	{
        parent::__construct();		
    }

    public function index()
	{
       //echo $this->get_local_time_clock();
	   if(is_ajax())
	   {
	   echo strtotime($this->general->get_local_time('time'));
		// echo date('Y-m-d H:m:s', strtotime($this->general->get_local_time('time')));
	   }
	}
	
	public function hours()
	{
       //echo $this->get_local_time_clock();
	   if(is_ajax())
	   {
	   	$hours = date('H',strtotime($this->general->get_local_time('time')));
		$min = date('i',strtotime($this->general->get_local_time('time')));
		echo $hours*60+$min;
		// echo date('Y-m-d H:m:s', strtotime($this->general->get_local_time('time')));
	   }
	}
	


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
