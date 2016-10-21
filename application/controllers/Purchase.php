<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Purchase extends CI_Controller{

		function __construct(){
			parent::__construct();
			$this->id = $this->session->userdata('is_active');
			$this->user_role = $this->crud_model->get_by_condition('outlets',array('id'=>$this->session->userdata('is_active')))->row('role');
		}

		function index(){
			$data['title'] = "Pembelian";
			$data['subtitle'] = "PEMBELIAN";
			$this->template->load('default','buying/buy_item',$data);
		}

		

	}

 ?>