<?php 

class Main extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Home';
		$data['subtitle'] = 'HOME';
		$this->template->load('default','main/dashboard',$data);
	}


}

 ?>