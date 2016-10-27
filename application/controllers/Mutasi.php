<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends MY_Controller
{
	private $id;
	private $user_role;

	function __construct(){
		parent::__construct();
		$this->load->model('product_model');
		$this->id = $this->session->userdata('is_active');
		$this->user_role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role');
	}

	public function index(){
		$data = array(
				'title' => 'Mutasi Barang',
				'subtitle' => 'MUTASI BARANG',
			);

		$data['products'] = $this->product_model->getAllProducts($this->id);
		$data['outlets'] = $this->crud_model->get_data('outlets')->result();
		$data['drivers'] = $this->crud_model->get_data('drivers')->result();
		$this->template->load('default','mutasi/main',$data);

	}

	public function send(){
		$this->db->empty_table('cart_mutasi');
		$data = array(
				'title' => 'Mutasi Barang',
				'subtitle' => 'MUTASI BARANG',
			);

		$data['products'] = $this->product_model->getAllProducts($this->id);
		$data['outlets'] = $this->crud_model->get_data('outlets')->result();
		$data['drivers'] = $this->crud_model->get_data('drivers')->result();
		$this->template->load('default','mutasi/send',$data);		
	}

	public function get_barcode($barcode){
		if($this->db->get_where('products',array('code'=>$barcode))->num_rows() > 0){

			echo '<script>$(".no-item").remove()</script>';
			$product = $this->db->get_where('products',array('code'=>$barcode))->row();
			$category = $this->crud_model->get_by_condition('category',array('id'=>$product->category))->row();
			$specifications = $this->crud_model->get_by_condition('spesifikasi',array('kode_barang'=>$product->code))->result();
			//$customers = $this->crud_model->get_data('customers')->result();
			echo ($product->quantity == 0)? '<div class="text-center"><p class="bebas" style="color:red">Out of Stock</p></div>': null;
			echo '<style>#table-detail>tbody>tr>th, #table-detail>tfoot>tr>td, #table-detail>tfoot>tr>th, #table-detail>thead>tr>td, #table-detail>thead>tr>th {padding-left: 0px !important;}</style>';
			echo '<table class="table" id="table-detail"><tbody><tr><td class="tabhead"><p class="bebas">Nama Barang</p></td>';
			echo '<td><p class="bebas">'.$product->name.'</p></td</tr>';
			
			
			echo '</select></td></tr>';
			echo '<tr><td class="tabhead"><p class="bebas">Kategori</p></td>';
			echo '<td> <p class="bebas">'.$category->name.'</p></td></tr>';
			echo '<tr><td class="tabhead"><p class="bebas">Kode Model</p></td>';
			echo '<td> <p class="bebas">'.$product->model.'</p></td></tr>';
			echo '<tr><td class="tabhead"><p class="bebas">Spesifikasi</p></td><td><ul  style="padding-left:6px;">';

			foreach ($specifications as $specification) {
				echo '<li> <p class="bebas">'.$specification->spec.'</p></li>';
			}
			echo '</ul></td></tr>';
			

			echo '<tr><td><p class="bebas">Harga Jual</p></td>';
			echo '<td> <p class="bebas">$&nbsp;'.$product->selling_price.'</p></td></tr>';

			
			
			echo '</tbody></table>';	


			

		}
		else{
			echo '<script>$(".no-item").remove()</script>';
			//echo '<div class="text-center"><p class="bebas">Item not found</p></div>';
			echo '<script>$(".product-table>tbody").append("<tr id=\"found\"><td colspan=\"2\"><div class=\"text-center\"><p class=\"bebas\" id=\"not_found\">Item not found</p></div></td></tr>")</script>';
			echo '<script>$("#detail").append("<div class=\"text-center no-item\" style=\"margin-top: 20PX;\"><P class=\"bebas\" style=\"color:red\">PRODUK TIDAK ADA</P></div>")</script>';
		}
	}
	public function list_item($barcode){
		if($this->db->get_where('products',array('code'=>$barcode))->num_rows() > 0){
			$product = $this->db->get_where('products',array('code'=>$barcode))->row();
			$customers = $this->crud_model->get_data('customers')->result();
			
			if($this->db->get_where('cart_mutasi',array('product_code'=>$barcode))->num_rows() > 0){
				echo 'added';
			}else{
				$this->db->insert('cart_mutasi',array('product_code' => $barcode, 'quantity' => 1,'outlet_id' => $this->id));
					if($product->quantity>0){
					echo json_encode($product);

				}
			}
			
		}
	}

	public function remove($code){
		$this->db->delete('cart_mutasi',array('product_code' => $code));
	}
}


?>