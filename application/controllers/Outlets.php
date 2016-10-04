<?php 

class Outlets extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Outlets';
		$data['subtitle'] = 'OUTLETS';
		$this->template->load('default','outlets/add_outlet',$data);
	}



}

 ?>