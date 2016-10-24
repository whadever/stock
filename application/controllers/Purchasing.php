<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Purchasing extends MY_Controller{

		public function __construct(){
			parent::__construct();
			$this->id = $this->session->userdata('is_active');
			$this->user_role = $this->crud_model->get_by_condition('outlets',array('id'=>$this->session->userdata('is_active')))->row('role');
		}

		public function index(){
			
			$this->purchase_item();
		}

		public function purchase_item(){
			if($this->user_role == 'admin'){
				redirect('products');
			}
			else{
				if ($this->input->post('save')) {

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
		                $thumb = $config ['upload_path'] . '/' .'photo_thumb'.$image['file_ext'];

		               //image_moo
						$this->image_moo
							->load($config ['upload_path'] . '/' . $config['file_name'])
							->resize_crop(300,300)
							->save_pa('' ,'_thumb');

						$this->image_moo
							->load($config ['upload_path'] . '/' . $config['file_name'])
							->resize_crop(800,600)
							->save($config ['upload_path'] . '/' . $config['file_name'],TRUE);
						echo "success";

		            }
		            else{
		            	$photo = 'uploads/products/no-photo.png';
		            	$thumb = 'uploads/products/no-photo.png';
		            }

		            $code = $this->input->post('item_code');
					
					$data_insert = array(

							'code' 			=> $code,
							'name' 			=> $this->input->post('item_name'),
							'model'			=> $this->input->post('item_model'),
							'buying_price' 	=> $this->input->post('item_buy'),
							'selling_price'	=> $this->input->post('item_sell'),
							'category' 		=> $this->input->post('item_category'),
							'photo' 		=> $photo,
							'thumb' 		=> $thumb,
							'outlet_id'		=> $this->id

						);

					if($this->input->post('spec')){
						for($i = 0; $i < count($this->input->post('spec')); $i++){
							if($this->input->post('spec')[$i] != ''){
								$data_spec = array(
										'kode_barang' => $code,
										'spec'		  => $this->input->post('spec')[$i]

									);
								$this->crud_model->insert_data('spesifikasi',$data_spec);
							}
						}
						
					}

					$this->crud_model->insert_data('products',$data_insert);

					

					redirect('products');
				}
				else{
					$data['title'] = "Pembelian";
					$data['subtitle'] = "PEMBELIAN";
					$data['categories'] = $this->crud_model->get_data('category')->result();
					$this->template->load('default','purchasing/purchase_item',$data);
				}		
			}
			
		}

	}

 ?>