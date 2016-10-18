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
			$product = $this->db->get_where('products',array('code'=>$barcode))->row();
			$category = $this->crud_model->get_by_condition('category',array('id'=>$product->category))->row();
			$specifications = $this->crud_model->get_by_condition('spesifikasi',array('kode_barang'=>$product->code))->result();
			$customers = $this->crud_model->get_data('customers')->result();
			echo '<table class="table" style="width:83%"><tr><td><p class="bebas">Nama Barang</p></td>';
			echo '<td><p class="bebas">'.$product->name.'</p></td>';
			if($product->quantity != 0){
				echo '<td><p class="bebas">Pembeli</p></td>';

				echo '<td><select class="form-control" name="">';
				foreach ($customers as $customer) {
					echo '<option value='.$customer->id.'>'.$customer->name.'</option>';
				}	
			}
			else{
				echo '<td colspan="2"><p class="bebas" style="color:red">OUT OF STOCK</p></td>';
			}
			
			echo '</select></td></tr>';
			echo '<tr><td><p class="bebas">Kategori</p></td>';
			echo '<td> <p class="bebas">'.$category->name.'</p></td></tr>';
			echo '<tr><td><p class="bebas">Kode Model</p></td>';
			echo '<td> <p class="bebas">'.$product->model.'</p></td></tr>';
			echo '<tr><td><p class="bebas">Harga Jual</p></td>';
			echo '<td> <p class="bebas">Rp&nbsp;'.$product->selling_price.'</p></td></tr>';
			echo '<tr><td><p class="bebas">Customer</p></td>';
			echo '<td> <p class="bebas">Rp&nbsp;'.$product->selling_price.'</p></td></tr>';
			echo '<tr><td><p class="bebas">Spesifikasi</p></td><td><ul>';

			foreach ($specifications as $specification) {
				echo '<li> <p class="bebas">'.$specification->spec.'</p></li>';
			}
			echo '</ul></td></tr></table>';
			if($product->quantity != 0){
				echo '<div class="text-center"><input type="submit" onClick = "javascript: p=true;" class="btn btn-default btn-custom" value="SAVE" name="save"></div>';
			}

		}
		else{
			echo '<div class="text-center"><p class="bebas">Item not found</p></div>';
		}
	}

	public function sell_product(){
		if($this->input->post('save')){
			$code = $this->input->post('item_code');
			$product = $this->crud_model->get_by_condition('products',array('code'=>$code))->row();
			if($product->quantity>0){
				$data['quantity'] = $product->quantity - 1;	
				$this->crud_model->update_data('products',$data,array('code'=>$code));
			}			
			redirect('selling');
		}
		else{
			$data['title'] = 'Penjualan';
			$data['subtitle'] = 'PENJUALAN';
			$this->template->load('default','selling/sell_item',$data);
		}
	}

	

}

 ?>