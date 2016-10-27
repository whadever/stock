<?php 

class Transaction extends MY_Controller{

	private $id;
	private $user_role;

	function __construct(){
		parent::__construct();
		$this->load->model('transaction_model');
		$this->id = $this->session->userdata('is_active');
		$this->user_role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role');
	}

	public function index(){
		$data['title'] = 'Transaksi';
		$data['subtitle'] = 'DAFTAR TRANSAKSI';
		$data['sellings']=$this->transaction_model->getAllTransactions('1');
		$data['purchasing']=$this->transaction_model->getAllTransactions('2');
		$data['mutations']=$this->transaction_model->getAllTransactions('3');

		$this->template->load('default','transaction/all_transactions',$data);
	}

}

 ?>