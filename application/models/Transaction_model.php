<?php 
	
class Product_model extends CI_Model{

	function getAllTransactions(){
		$this->db->select('transaction.*,transaction_detail.*');
		$this->db->from('transaction');
		$this->db->join('transaction_detail','transaction_detail.transaction_code=transaction.code');
		$this->db->order_by('transaction.code','asc');
		return $this->db->get()->result();
	}

}

?>