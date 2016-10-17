<?php 

class Selling extends MY_Controller{

	private $id;
	private $user_role;

	function __construct(){
		parent::__construct();
		$this->load->model('product_model');
		$this->id = $this->session->userdata('is_active');
		$this->user_role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role');
	}

	public function index(){
		$data['title'] = 'Penjualan';
		$data['subtitle'] = 'PENJUALAN';
		$this->template->load('default','selling/sell_item',$data);
	}

	public function get_barcode($barcode){
		if($this->db->get_where('products',array('code'=>$barcode))->num_rows() > 0){
			$products = $this->db->get_where('products',array('code'=>$barcode))->row();
			$category = $this->crud_model->get_by_condition('category',array('id'=>$products->category))->row();
			$specifications = $this->crud_model->get_by_condition('spesifikasi',array('kode_barang'=>$products->code))->result();
			echo '<table class="table" style="width:47%"><tr><td><p class="bebas">Nama Barang</p></td>';
			echo '<td><p class="bebas">'.$products->name.'</p></td></tr>';
			echo '<tr><td><p class="bebas">Kategori</p></td>';
			echo '<td> <p class="bebas">'.$category->name.'</p></td></tr>';
			echo '<tr><td><p class="bebas">Kode Model</p></td>';
			echo '<td> <p class="bebas">'.$products->model.'</p></td></tr>';
			echo '<tr><td><p class="bebas">Harga Jual</p></td>';
			echo '<td> <p class="bebas">Rp&nbsp;'.$products->selling_price.'</p></td></tr>';
			echo '<tr><td><p class="bebas">Customer</p></td>';
			echo '<td> <p class="bebas">Rp&nbsp;'.$products->selling_price.'</p></td></tr>';
			echo '<tr><td><p class="bebas">Spesifikasi</p></td><td><ul>';
			foreach ($specifications as $specification) {
				echo '<li> <p class="bebas">'.$specification->spec.'</p></li>';
			}
			echo '</ul></td></tr></table>';

		}
		else{
			echo '<table><tr><td></td><td><p class="bebas">Item not found</p></td></tr></table>';
		}
	}

	

}

 ?>