<?php 

class Outlets extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->all_outlets();
	}

	public function all_outlets(){
		$data['title'] = 'Outlets';
		$data['subtitle'] = 'OUTLETS';
		$data['outlets']=$this->crud_model->get_by_condition('outlets',array('role' => 'outlet'))->result();
		$this->template->load('default','outlets/all_outlet',$data);
	}



}



 ?>