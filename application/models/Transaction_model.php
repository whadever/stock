<?php 
	
class Transaction_model extends CI_Model{

	function getAllTransactions($type_code){
		$this->db->select('transaction.*,transaction_detail.transaction_code,transaction_detail.product_code,transaction_detail.quantity,transaction_detail.from_client_id,transaction_detail.to_client_id,products.name as product_name,customers.name as customer_name');
		$this->db->from('transaction');
		$this->db->join('transaction_detail','transaction_detail.transaction_code=transaction.code','left');
		$this->db->join('products','products.code=transaction_detail.product_code');
		$this->db->join('customers','customers.id=transaction_detail.to_client_id');
		$this->db->where('transaction.transaction_type_id',$type_code);
		$this->db->order_by('transaction.code','asc');

		return $this->db->get()->result();
	}

}

?>