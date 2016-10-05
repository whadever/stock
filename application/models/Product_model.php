<?php 
	
class Product_model extends CI_Model{

	function getAllProducts(){
		$this->db->select('products.*,category.name AS category');
		$this->db->from('products');
		$this->db->join('category','category.id = products.category');
		$this->db->order_by('products.name','asc');
		return $this->db->get()->result();
	}

}

?>