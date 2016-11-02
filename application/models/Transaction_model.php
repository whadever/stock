<?php 
	
class Transaction_model extends CI_Model{

	function getSelling(){
		$this->db->select('transaction.*,customers.name');
		$this->db->from('transaction');
		$this->db->join('customers','customers.id=transaction.to_client_id');
		$this->db->where('transaction.transaction_type_id',1);
		$this->db->order_by('transaction.transaction_date','desc');

		return $this->db->get()->result();
	}

	function getPurchasing(){
		$this->db->select('transaction.*,supplier.name');
		$this->db->from('transaction');
		$this->db->join('customers','customers.id=transaction.to_client_id');
		$this->db->where('transaction.transaction_type_id',1);
		$this->db->order_by('transaction.transaction_date','desc');

		return $this->db->get()->result();	
	}
}

?>