<?php 
	
class Transaction_model extends CI_Model{

	function getAllTransactions($type_code){
		$this->db->select('transaction.*,transaction_detail.*');
		$this->db->from('transaction');
		$this->db->join('transaction_detail','transaction_detail.transaction_code=transaction.code','left');
		$this->db->where('transaction.code',$type_code);
		$this->db->order_by('transaction.code','asc');

		return $this->db->get()->result();
	}

}

?>