<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Selling extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->id = $this->session->userdata('is_active');
		$this->user_role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role');
		if($this->user_role == 'admin'){
			redirect('main');
		}
	}

	public function index(){
		$this->sell_product();
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
			// if($product->quantity != 0){

			// 	echo '<tr><td style="width:10%"><p class="bebas">Pembeli</p></td>';

			// 	echo '<td id="customer" style="width:25%"><select class="form-control" id="customer_name" name="customer_name">';
			// 	foreach ($customers as $customer) {
			// 		echo '<option value='.$customer->id.'>'.$customer->name.'</option>';
			// 	}
			// 	echo '<option value="others" id="others">Others</option>';
			// 	echo '</td></tr>';


				// echo '<td style="width:25%">';
				// echo '<input type="text" class="form-control" required="1" name="customer_name">';
			
				// echo '<tr><td><p class="bebas">Discount</p></td>';
				// echo '<td><div class="input-group"><span class="input-group-addon">Rp</span><input type="text" name="discount" placeholder="Discount" class="form-control"></div></td></tr>';

				echo '<tr><td><p class="bebas">Harga Jual</p></td>';
				echo '<td> <p class="bebas">$&nbsp;'.$product->selling_price.'</p></td></tr>';
//			}
			
			
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
			
			if($this->db->get_where('cart',array('product_code'=>$barcode))->num_rows() > 0){
				echo 'added';
			}else{
				$this->db->insert('cart',array('product_code' => $barcode, 'quantity' => 1,'outlet_id' => $this->id,'transaction_type' => 1));
					if($product->quantity>0){
					echo json_encode($product);

				}
			}
			
		}
	}

	public function remove($code){
		$this->db->delete('cart',array('product_code' => $code));
	}

	public function sell_product(){
		if($this->input->post('next')){
			// echo "<pre>";
			// print_r($this->input->post());
			// echo "</pre>";
			// exit;
			$data['transaction_code'] = $this->input->post('transaction_code');
			$data['product_id'] = $this->input->post('id');
			$data['disc_price'] = $this->input->post('disc_price');
			$data['total_price'] = $this->input->post('total_harga');

			$this->finish_transaction($data);
		}
		else{
			$this->db->empty_table('cart');
			$data['code'] = '';
			$data['title'] = 'Penjualan';
			$data['subtitle'] = 'PENJUALAN';
			$this->template->load('default','selling/sell_item',$data);
		}
	}

	public function print_receipt($code){
		$data['title'] = 'Transaksi';
		$data['subtitle'] = 'TRANSAKSI';
		$data['transaction']=$this->crud_model->get_by_condition('transaction',array('code' => $code))->row();
		$this->db->select('transaction_detail.*,products.name,products.selling_price as real_price');
		$this->db->from('transaction_detail');
		$this->db->join('products','transaction_detail.product_code=products.code');
		$this->db->where('transaction_detail.transaction_code',$code);

		$data['products']=$this->db->get()->result();
		$data['customer']=$this->crud_model->get_by_condition('customers',array('id'=>$data['transaction']->to_client_id))->row();
		$this->load->view('selling/sell_receipt',$data);
	}

	public function finish_transaction($data= ''){
		$data['customers'] = $this->crud_model->get_data('customers')->result();
		if ($this->input->post('save')) {
			$transaction = array(

					'transaction_type_id' => 1,
					'transaction_date' => date('Y-m-d H:i:s'),
					'detail' => 'unknown',
					'total_price' => $this->input->post('total_harga')
				);

			$this->crud_model->insert_data('transaction',$transaction);
			$id = $this->db->insert_id();
			$code = $this->input->post('transaction_code'). $id;
			$this->crud_model->update_data('transaction',array('code' => $code),array('id' => $id ));

			if($this->input->post('customer_name')=='others'){
						$new_customer = array(
							'name'=>$this->input->post('new_customer_name'),
							'email'=>$this->input->post('new_customer_email'),
							'phone'=>$this->input->post('new_customer_phone'),
							'address'=>$this->input->post('new_customer_address')
						);
						$this->crud_model->insert_data('customers',$new_customer);
						$customer_id = $this->db->insert_id();
			}
			else{
				$customer_id = $this->input->post('customer_name');
			}

			for($i = 0; $i < count($this->input->post('product_id')); $i++){
				$product_code = $this->input->post('product_id')[$i];
				$product = $this->crud_model->get_by_condition('products',array('code'=>$product_code))->row();
				
				$transaction_detail = array(
						'transaction_code'	=> $code,
						'product_code'		=> $product_code,
						'quantity'			=> 1,
						'selling_price'		=> $this->input->post('disc_price')[$i]
					);
			
				$from_client_id = $this->id;
				$to_client_id = $customer_id;
				$this->crud_model->update_data('transaction',array('from_client_id' => $from_client_id,'to_client_id'=>$to_client_id),array('code'=>$code));
				$this->db->insert('transaction_detail',$transaction_detail);

				if($product->quantity>0){
					$quantity = $product->quantity - 1;	
					$this->crud_model->update_data('products',array('quantity' => $quantity),array('code'=>$product_code));
					
					
				}
				
			}

			$this->db->empty_table('cart');
			$data['code'] = $code;
			$data['title'] = 'Penjualan';
			$data['subtitle'] = 'PENJUALAN';
			$this->template->load('default','selling/sell_item',$data);
		
		}else{

			$data['title'] = 'Penjualan';
			$data['subtitle'] = 'PENJUALAN';
			$this->template->load('default','selling/customer',$data);

		}
		
	
		
	}

}

 ?>