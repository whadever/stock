<?php 
	
class Product_model extends CI_Model{

	function getAllProducts($id = ''){
		$this->db->select('products.*,category.name AS category');
		$this->db->from('products');
		$this->db->join('category','category.id = products.category');
		$this->db->where('products.outlet_id',$id);
		$this->db->order_by('products.name','asc');
		return $this->db->get()->result();
	}
	function getAdminProducts(){
		$this->db->select('products.*,category.name AS category,outlets.name AS outlet_name');
		$this->db->from('products');
		$this->db->join('category','category.id = products.category');
		$this->db->join('outlets','outlets.id = products.outlet_id');
		$this->db->order_by('products.name','asc');
		return $this->db->get()->result();
	}

}

?>