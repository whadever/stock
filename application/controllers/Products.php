<?php 

class Products extends MY_Controller{

	private $id;
	private $user_role;

	function __construct(){
		parent::__construct();
		$this->load->model('product_model');
		$this->id = $this->session->userdata('is_active');
		$this->user_role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role');
	}

	public function index(){
		$data['title'] = 'Products';
		$data['subtitle'] = 'PRODUCTS';
		if($this->user_role != 'admin'){
			$data['products'] = $this->product_model->getAllProducts($this->id);
		}else{
			$data['products'] = $this->product_model->getAdminProducts();
		}
		$this->template->load('default','products/all_products',$data);
	}

	public function edit_product($code){
		$data['product']=$this->crud_model->get_by_condition('products',array('code'=>$code) )->row();

		if ($this->input->post('update')) {
			$config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 5000;			
			$config['upload_path']          = 'uploads/products/'.$this->input->post('item_code');
			$config['overwrite']			= true;
			$config['file_name']			= 'photo.jpg';
			$this->upload->initialize($config);

			//Check if the folder for the upload existed
			if(!file_exists($config['upload_path']))
			{
				//if not make the folder so the upload is possible
				mkdir($config['upload_path'], 0777, true);
			}

            if ($this->upload->do_upload('photo'))
            {	
            	$image = $this->upload->data();
                //Get the link for the database
                $photo = $config ['upload_path'] . '/' . $config['file_name'];
                $thumb = $config ['upload_path'] . '/' . 'photo_thumb'.$image['file_ext'];

               //image_moo
				$this->image_moo
					->load($config ['upload_path'] . '/' . $config['file_name'])
					->resize_crop(300,300)
					->save_pa('','_thumb');

				$this->image_moo
					->load($config ['upload_path'] . '/' . $config['file_name'])
					->resize_crop(800,600)
					->save($config ['upload_path'] . '/' . $config['file_name'],TRUE);

            }
            else{
            	$photo = $data['product']->photo;
            	$thumb = $data['product']->thumb;
            }

			
			$data= array(

					'code' 			=> $this->input->post('item_code'),
					'name' 			=> $this->input->post('item_name'),
					'buying_price' 	=> $this->input->post('item_price'),
					'quantity'		=> $this->input->post('item_quantity'),
					'category' 		=> $this->input->post('item_category'),
					'photo' 		=> $photo,
					'thumb' 		=> $thumb,

				);
			$this->crud_model->update_data('products',$data,array('code'=>$code));

			redirect('products');
		}else{
			$data['title'] = 'Products';
			$data['subtitle'] = 'PRODUCTS';
			
			$data['categories'] = $this->crud_model->get_data('category')->result();
			$this->template->load('default','products/edit_products',$data);
		}
	}	

	public function delete_product($code){
		$this->crud_model->delete_data('products',array('code'=>$code));
		$this->session->set_flashdata('success',"alertify.success('Deleted successfully')");
		redirect('products');
	}



	public function all_category(){
		$data['title'] = 'Categories';
		$data['subtitle'] = 'CATEGORIES';
		$data['categories'] = $this->product_model->getCategory(); #$this->crud_model->get_data('category')->result();
		$this->template->load('default','products/category',$data);
	}

	public function add_category(){
		if ($this->input->post('save')) {
			
			$data_insert = array(
					'name' 			=> $this->input->post('category_name'),
				);


			$this->crud_model->insert_data('category',$data_insert);

			redirect('products/all_category');
		}
	}

	public function print_product($code){
		$data['title'] = 'Products';
		$data['subtitle'] = 'PRODUCTS';
		$data['product'] = $this->crud_model->get_by_condition('products',array('code'=>$code))->row();
		$data['specs'] = $this->crud_model->get_by_condition('spesification',array('product_code' => $code))->result();
		$this->load->view('products/detail_product',$data);
	}

	public function deactivate_product($code){
		$this->crud_model->update_data('products',array('active'=>0),array('code'=>$code));
		$this->session->set_flashdata('success',"alertify.success('Deactivated successfully')");
		redirect('products');

	}


}

 ?>