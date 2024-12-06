<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
    }
	 	
    function index()
    {

		echo '<p align="center">Welcome to Sickday Website.</p>';

	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */