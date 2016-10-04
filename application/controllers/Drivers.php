<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Drivers';
		$data['subtitle'] = 'DRIVERS';
		$this->template->load('default','drivers/add_driver',$data);
	}
}
?>