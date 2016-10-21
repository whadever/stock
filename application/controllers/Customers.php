<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends MY_Controller
{
	
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Customers';
		$data['subtitle'] = 'CUSTOMERS';
		$data['customers'] = $this->crud_model->get_data('customers')->result();
		$this->template->load('default','customers/all_customers',$data);
	}

	public function add_customer(){
		if($this->input->post('save')){
			
			// $customer = array(
			// 	'name' => $this->input->post('customer_name'),
			// 	'address' => $this->input->post('customer_address'),
			// 	'phone' => $this->input->post('customer_telp'),
			// 	'email' => $this->input->post('customer_mail'),
			// );
			// $this->crud_model->insert_data('customers',$customer);
			// redirect('customers');
			echo "<pre>";
			print_r($this->input->post());
			echo "</pre>";
		}
		else{
			$data['title'] = 'Customers';
			$data['subtitle'] = 'CUSTOMERS';
			$this->template->load('default','customers/add_customer',$data);		
		}

	}

	public function edit_customer($id){
		if($this->input->post('update')){
			$customer=array(
				'name' => $this->input->post('customer_name'),
				'address' => $this->input->post('customer_address'),
				'phone' => $this->input->post('customer_telp'),
				'email' => $this->input->post('customer_mail'),
			);
			$this->crud_model->update_data('customers',$customer,array('id'=>$id));
			redirect('customers');
		}
		else{
			$data['title'] = 'Customers';
			$data['subtitle'] = 'CUSTOMERS';
			$data['customer'] = $this->crud_model->get_by_condition('customers',array('id'=>$id))->row();
			$this->template->load('default','customers/edit_customer',$data);	
		}
		
	}

	
}
?>