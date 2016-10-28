<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Home';
		$data['subtitle'] = 'HOME';
		$this->template->load('default','main/dashboard',$data);
	}

	public function scan_item(){
		$data['title'] = 'Scan Items';
		$data['subtitle'] = 'SCAN ITEMS';
		$this->template->load('default','main/scan_item',$data);
	}



}

 ?>