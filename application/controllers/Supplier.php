<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller
{
	
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Suppliers';
		$data['subtitle'] = 'SUPPLIERS';
		$data['suppliers'] = $this->crud_model->get_data('suppliers')->result();
		$this->template->load('default','suppliers/all_suppliers',$data);
	}

	public function add_supplier(){
		if($this->input->post('save')){
			
			$supplier = array(
				'name' => $this->input->post('supplier_name'),
				'address' => $this->input->post('supplier_address'),
				'phone' => $this->input->post('supplier_telp'),
				'email' => $this->input->post('supplier_mail'),
			);
			$this->crud_model->insert_data('suppliers',$supplier);
			redirect('suppliers');
			
		}
		else{
			$data['title'] = 'suppliers';
			$data['subtitle'] = 'SUPPLIERS';
			$this->template->load('default','suppliers/add_supplier',$data);		
		}

	}

	public function edit_supplier($id){
		if($this->input->post('update')){
			$supplier=array(
				'name' => $this->input->post('supplier_name'),
				'address' => $this->input->post('supplier_address'),
				'phone' => $this->input->post('supplier_telp'),
				'email' => $this->input->post('supplier_mail'),
			);
			$this->crud_model->update_data('suppliers',$supplier,array('id'=>$id));
			redirect('suppliers');
		}
		else{
			$data['title'] = 'suppliers';
			$data['subtitle'] = 'SUPPLIERS';
			$data['supplier'] = $this->crud_model->get_by_condition('suppliers',array('id'=>$id))->row();
			$this->template->load('default','suppliers/edit_supplier',$data);	
		}
		
	}

	public function delete_supplier($id){
		$this->crud_model->delete_data('suppliers',array('id' => $id));
		$this->session->set_flashdata('success',"alertify.success('Deleted successfully')");
		redirect('suppliers');
	}

	
}
?>