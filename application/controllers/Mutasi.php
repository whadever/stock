<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends MY_Controller
{
	private $id;
	private $user_role;

	function __construct(){
		parent::__construct();
		$this->load->model('product_model');
		$this->id = $this->session->userdata('is_active');
		$this->user_role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role');
	}

	public function index(){
		$data = array(
				'title' => 'Mutasi Barang',
				'subtitle' => 'MUTASI BARANG',
			);

		$data['products'] = $this->product_model->getAllProducts($this->id);
		$data['outlets'] = $this->crud_model->get_data('outlets')->result();
		$data['drivers'] = $this->crud_model->get_data('drivers')->result();
		$this->template->load('default','products/mutasi',$data);

	}

	public function send(){
		$data = array(
				'title' => 'Mutasi Barang',
				'subtitle' => 'MUTASI BARANG',
			);

		$data['products'] = $this->product_model->getAllProducts($this->id);
		$data['outlets'] = $this->crud_model->get_data('outlets')->result();
		$data['drivers'] = $this->crud_model->get_data('drivers')->result();
		$this->template->load('default','mutasi/kirim',$data);		
	}
}


?>