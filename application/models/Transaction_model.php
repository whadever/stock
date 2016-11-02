<?php 
	
class Transaction_model extends CI_Model{

	function getAllTransactions($type_code){
		$this->db->select('transaction.transaction_date,transaction_detail.*,products.name as product_name,customers.name as customer_name');
		$this->db->from('transaction_detail');
		$this->db->join('transaction','transaction_detail.transaction_code=transaction.code','left');
		$this->db->join('products','products.code=transaction_detail.product_code','left');
		$this->db->join('customers','customers.id=transaction_detail.to_client_id');
		$this->db->where('transaction.transaction_type_id',$type_code);
		$this->db->order_by('transaction.transaction_date','desc');

		return $this->db->get()->result();
	}	

}

?>