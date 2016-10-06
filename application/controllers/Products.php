<?php 

class Products extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('product_model');
	}

	public function index(){
		$this->all_products();
	}

	public function add(){
		$data['title'] = 'Products';
		$data['subtitle'] = 'PRODUCTS';
		$data['categories'] = $this->crud_model->get_data('category')->result();
		$this->template->load('default','products/input_product',$data);
	}

	public function all_products(){
		$data['title'] = 'Products';
		$data['subtitle'] = 'PRODUCTS';
		$data['products'] = $this->product_model->getAllProducts();
		$this->template->load('default','products/all_products',$data);
	}

	public function edit_product($code){
		$data['product']=$this->crud_model->get_by_condition('products',array('code'=>$code) )->row();

		if ($this->input->post('update')) {
			$config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 5000;			
			$config['upload_path']          = 'uploads/'.$this->input->post('item_code');
			$config['overwrite']			= true;
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
                $photo = $config ['upload_path'] . '/' . $image['file_name'];
                $thumb = $config ['upload_path'] . '/' . $image['raw_name'].'_thumb'.$image['file_ext'];

               //image_moo
				$this->image_moo
					->load($config ['upload_path'] . '/' . $image['file_name'])
					->resize_crop(300,300)
					->save_pa('','_thumb');

				$this->image_moo
					->load($config ['upload_path'] . '/' . $image['file_name'])
					->resize_crop(800,600)
					->save($config ['upload_path'] . '/' . $image['file_name'],TRUE);

            }
            else{
            	$photo = $data['product']->photo;
            	$thumb = $data['product']->thumb;
            }

			
			$data= array(

					'code' 			=> $this->input->post('item_code'),
					'name' 			=> $this->input->post('item_name'),
					'buying_price' 	=> $this->input->post('item_price'),
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

	public function add_product(){
		if ($this->input->post('save')) {
			$config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 5000;			
			$config['upload_path']          = 'uploads/'.$this->input->post('item_code');
			$config['overwrite']			= true;
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
                $photo = $config ['upload_path'] . '/' . $image['file_name'];
                $thumb = $config ['upload_path'] . '/' . $image['raw_name'].'_thumb'.$image['file_ext'];

               //image_moo
				$this->image_moo
					->load($config ['upload_path'] . '/' . $image['file_name'])
					->resize_crop(300,300)
					->save_pa('','_thumb');

				$this->image_moo
					->load($config ['upload_path'] . '/' . $image['file_name'])
					->resize_crop(800,600)
					->save($config ['upload_path'] . '/' . $image['file_name'],TRUE);

            }
            else{
            	$photo = '';
            	$thumb = '';
            }

			
			$data_insert = array(

					'code' 			=> $this->input->post('item_code'),
					'name' 			=> $this->input->post('item_name'),
					'buying_price' 	=> $this->input->post('item_price'),
					'category' 		=> $this->input->post('item_category'),
					'photo' 		=> $photo,
					'thumb' 		=> $thumb,

				);
			$this->crud_model->insert_data('products',$data_insert);

			redirect('products');
		}
	}


}

 ?>