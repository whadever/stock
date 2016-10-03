<?php 

class Products extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Products';
		$data['subtitle'] = 'PRODUCTS';
		$this->template->load('default','products/input_product',$data);
	}



}

 ?>