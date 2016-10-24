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
		$this->sell_product();
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
		if($this->db->get_where('products',array('code'=>$barcode))->num_rows() > 0){
			$product = $this->db->get_where('products',array('code'=>$barcode))->row();
			$customers = $this->crud_model->get_data('customers')->result();
			
			if($this->db->get_where('cart',array('product_code'=>$barcode))->num_rows() > 0){
				echo 'added';
			}else{
				$this->db->insert('cart',array('product_code' => $barcode, 'quantity' => 1));
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
			$data['transaction_code'] = $this->input->post('transaction_code');
			$data['product_id'] = $this->input->post('id');
			$data['disc_price'] = $this->input->post('disc_price');
			$data['total_harga'] = $this->input->post('total_harga');

			$this->finish_transaction($data);
		}
		else{
			$this->db->empty_table('cart');
			$data['title'] = 'Penjualan';
			$data['subtitle'] = 'PENJUALAN';
			$this->template->load('default','selling/sell_item',$data);
		}
	}

	public function finish_transaction($data= ''){
		$data['customers'] = $this->crud_model->get_data('customers')->result();
		if ($this->input->post('save')) {
			$transaction = array(

					'transaction_type_id' => 1,
					'transaction_date' => date('Y-m-d H:i:s'),
					'detail' => 'unknown',
					'total_harga' => $this->input->post('total_harga')
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
						$customer_id = $this->db->insert_id;
				}
				else{
					$customer_id = $this->input->post('customer_id');
				}

			for($i = 0; $i < count($this->input->post('product_id')); $i++){
				$product_code = $this->input->post('product_id')[$i];
				$product = $this->crud_model->get_by_condition('products',array('code'=>$product_code))->row();
				
				$transaction_detail = array(
						'transaction_code'	=> $code,
						'product_code'		=> $product_code,
						'quantity'			=> 1,
						'from_client_id'	=> $this->id,
						'to_client_id'		=> $customer_id,
						'harga_jual'		=> $this->input->post('disc_price')[$i]
					);

				$this->db->insert('transaction_detail',$transaction_detail);

				if($product->quantity>0){
					$quantity = $product->quantity - 1;	
					$this->crud_model->update_data('products',array('quantity' => $quantity),array('code'=>$product_code));
					
					
				}
				
			}

			redirect('selling');
		
		}else{

			$data['title'] = 'Penjualan';
			$data['subtitle'] = 'PENJUALAN';
			$this->template->load('default','selling/customer',$data);

		}
		
	
		
	}

}

 ?>