<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MY_Controller{

	
	function __construct(){
		parent::__construct();
		$this->id = $this->session->userdata('is_active');
		$this->user_role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role');
	}

	public function index(){
		$data['title'] = 'Transaksi';
		$data['subtitle'] = 'DAFTAR TRANSAKSI';
		$data['sellings']=$this->transaction_model->getSelling();
		$data['mutations']=$this->crud_model->get_data('mutation')->result();
		$data['purchasings']=$this->transaction_model->getPurchasing();

		$this->template->load('default','transaction/all_transactions',$data);
	}

}

 ?>