<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends MY_Controller
{

	function __construct(){
		parent::__construct();
		$this->id = $this->session->userdata('is_active');
		$this->user_role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role');
	}

	public function index(){
		$data = array(
				'title' => 'Mutasi Barang',
				'subtitle' => 'MUTASI BARANG',
			);

		
		$this->template->load('default','mutasi/main',$data);

	}

	public function send(){
		if($this->input->post('send')){
			$data_mutasi = array(
				'code' => $this->input->post('transaction_code'),
				'date' => date('Y-m-d H:i:s'),
				'total_qty' => count($this->input->post('id')),
				'from_id' => $this->id,
				'to_id'	=> $this->input->post('outlet_distribute'),
				'driver_id' => $this->input->post('select-driver'),
				'notes'	=> $this->input->post('notes')
				);
			$this->crud_model->insert_data('mutation',$data_mutasi);

			for($i = 0; $i < count($this->input->post('id')); $i++){
				$data_detail = array(
					'mutation_code' => $this->input->post('transaction_code'),
					'product_code'	=> $this->input->post('id')[$i],
					'qty'			=> 1,

					);

				$this->crud_model->insert_data('mutation_detail',$data_detail);
			}
			$this->session->set_flashdata('success',"alertify.success('Data has been recorded')");
			redirect('transaction');
		}else{
			$this->db->empty_table('cart');
			
			$data = array(
				'title' => 'Mutasi Barang',
				'subtitle' => 'Kirim BARANG',
			);	
			$data['products'] = $this->product_model->getAllProducts($this->id);
			$data['outlets'] = $this->crud_model->get_by_condition('outlets',array('role' => 'outlet','id !=' => $this->id))->result();
			$data['drivers'] = $this->crud_model->get_data('drivers')->result();
			$this->template->load('default','mutasi/send',$data);		
		}
		

		
	}

	public function get_barcode($barcode){
		if($this->db->get_where('products',array('code'=>$barcode,'outlet_id' => $this->id))->num_rows() > 0){

			echo '<script>$(".no-item").remove()</script>';
			$product = $this->db->get_where('products',array('code'=>$barcode))->row();
			$category = $this->crud_model->get_by_condition('category',array('id'=>$product->category))->row();
			$specifications = $this->crud_model->get_by_condition('specification',array('product_code'=>$product->code))->result();
			//$customers = $this->crud_model->get_data('customers')->result();
			echo ($product->quantity == 0)? '<div class="text-center"><p class="bebas" style="color:red">Out of Stock</p></div>': null;
			echo '<style>#table-detail>tbody>tr>th, #table-detail>tfoot>tr>td, #table-detail>tfoot>tr>th, #table-detail>thead>tr>td, #table-detail>thead>tr>th {padding-left: 0px !important;}</style>';
			echo '<table class="table" id="table-detail"><tbody><tr><td class="tabhead"><p class="bebas">Nama Barang</p></td>';
			echo '<td><p class="bebas">'.$product->name.'</p></td</tr>';
			
			
			
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

	public function get_detail($barcode){
		if($this->db->get_where('products',array('code'=>$barcode))->num_rows() > 0){

			echo '<script>$(".no-item").remove()</script>';
			$product = $this->db->get_where('products',array('code'=>$barcode))->row();
			$category = $this->crud_model->get_by_condition('category',array('id'=>$product->category))->row();
			$specifications = $this->crud_model->get_by_condition('specification',array('product_code'=>$product->code))->result();
			//$customers = $this->crud_model->get_data('customers')->result();
			echo ($product->quantity == 0)? '<div class="text-center"><p class="bebas" style="color:red">Out of Stock</p></div>': null;
			echo '<style>#table-detail>tbody>tr>th, #table-detail>tfoot>tr>td, #table-detail>tfoot>tr>th, #table-detail>thead>tr>td, #table-detail>thead>tr>th {padding-left: 0px !important;}</style>';
			echo '<table class="table" id="table-detail"><tbody><tr><td class="tabhead"><p class="bebas">Nama Barang</p></td>';
			echo '<td><p class="bebas">'.$product->name.'</p></td</tr>';
			
			
			
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
		if($this->db->get_where('products',array('code'=>$barcode,'outlet_id' => $this->id))->num_rows() > 0){
			$product = $this->db->get_where('products',array('code'=>$barcode))->row();
			$customers = $this->crud_model->get_data('customers')->result();
			
			if($this->db->get_where('cart',array('product_code'=>$barcode, 'transaction_type'=>3, 'outlet_id' => $this->id))->num_rows() > 0){
				echo 'added';

			}else{
				
				if($product->quantity>0){
					$this->db->insert('cart',array('product_code' => $barcode, 'transaction_type'=>3, 'quantity' => 1,'outlet_id' => $this->id));
					echo json_encode($product);

				}
			}
			
		}
	}

	public function list_item_receive($barcode){
		if($this->db->get_where('products',array('code'=>$barcode))->num_rows() > 0){
			$product = $this->db->get_where('products',array('code'=>$barcode))->row();
			$customers = $this->crud_model->get_data('customers')->result();
			
			// if($this->db->get_where('cart',array('product_code'=>$barcode, 'transaction_type'=>3, 'outlet_id' => $this->id))->num_rows() > 0){
			// 	echo 'added';

			// }else{
				
			// 	if($product->quantity>0){
			// 		$this->db->insert('cart',array('product_code' => $barcode, 'transaction_type'=>3, 'quantity' => 1,'outlet_id' => $this->id));
			// 		echo json_encode($product);

			// 	}
			// }
			echo json_encode($product);
		}
	}

	public function remove($code){
		$this->db->delete('cart',array('product_code' => $code));
		if($this->db->get_where('cart',array('transaction_type'=>3, 'outlet_id' => $this->id))->num_rows() > 0){
			echo 'available';

		}
		else{
			echo 'empty';
		}
	}

	public function receive(){

		if($this->input->post('accept')){
			$this->crud_model->update_data('mutation',array('status'=>1),array('code'=>$this->input->post('transaction_code')));
			$this->crud_model->update_data('products',array('outlet_id'=>$this->id),array('code'=>$this->input->post('item_code')));
			$this->session->set_flashdata('success',"alertify.success('Data has been recorded')");
			redirect('transaction');
		}
		else{
			$data = array(
					'title' => 'Mutasi Barang',
					'subtitle' => 'MUTASI BARANG',
				);

			$data['products'] = $this->crud_model->get_data('products')->result();
			$data['outlets'] = $this->crud_model->get_data('outlets')->result();
			$data['drivers'] = $this->crud_model->get_data('drivers')->result();
			$this->template->load('default','mutasi/receive',$data);
		}

		
	}

	public function get_transaction_detail($transaction_code){
		if($this->db->get_where('mutation',array('code'=>$transaction_code, 'to_id'=>$this->id, 'status'=>0))->num_rows()>0){
			$mutasi = $this->db->get_where('mutation',array('code'=>$transaction_code, 'to_id'=>$this->id))->row();
			$mutasi_detail = $this->db->get_where('mutation_detail',array('mutation_code'=>$transaction_code))->row();
			$sender = $this->db->get_where('outlets',array('id'=>$mutasi->from_id))->row();
			$recipient = $this->db->get_where('outlets',array('id'=>$mutasi->to_id))->row();
			$driver = $this->db->get_where('drivers',array('id'=>$mutasi->driver_id))->row();
			echo '<table class="table" id="table-detail" style="width:60% !important;margin-left:8px;">';
			echo 	'<tbody>';
			echo 		'<tr>';
			echo 			'<td><p class="bebas">KODE TRANSAKSI</p></td>';
			echo 			'<td><p class="bebas">'.$mutasi->code.'</p></td>';
			echo 		'</tr>';
			echo 		'<tr>';
			echo 			'<td><p class="bebas">DARI</p></td>';
			echo 			'<td><p class="bebas">'.$sender->name.'</p></td>';
			echo 		'</tr>';
			echo 		'<tr>';
			echo 			'<td><p class="bebas">UNTUK</p></td>';
			echo 			'<td><p class="bebas">'.$recipient->name.'</p></td>';
			echo 		'</tr>';
			echo 		'<tr>';
			echo 			'<td><p class="bebas">KURIR</p></td>';
			echo 			'<td><p class="bebas">'.$driver->name.'</p></td>';
			echo 		'</tr>';
			echo 		'<tr>';
			echo 			'<td><p class="bebas">KETERANGAN</p></td>';
			echo 			'<td><p class="bebas">'.$mutasi->notes.'</p></td>';
			echo 		'</tr>';
			echo 		'<tr>';
			echo 			'<td><p class="bebas">JUMLAH BARANG</p></td>';
			echo 			'<td><p class="bebas">'.$mutasi->total_qty.'</p></td>';
			echo 		'</tr>';
			echo 		'<tr>';
			echo 			'<td><p class="bebas">DETAIL BARANG</p></td>';
			echo 			'<td><p class="bebas">'.$mutasi_detail->product_code.'</p></td>';
			echo 		'</tr>';
			echo 	'</tbody>';
			echo '</table>';

			
		}
	}
}


?>