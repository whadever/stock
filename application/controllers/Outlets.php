<?php 

class Outlets extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->all_outlets();
	}

	public function all_outlets(){
		$data['title'] = 'Outlets';
		$data['subtitle'] = 'OUTLETS';
		$data['outlets']=$this->crud_model->get_by_condition('outlets',array('role' => 'outlet'))->result();
		$this->template->load('default','outlets/all_outlet',$data);
	}

	public function add_outlet(){
		if($this->input->post('save')){
			$config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 5000;			
			$config['upload_path']          = 'uploads/photos/'.$this->input->post('outlet_name');
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
			$name = $this->input->post('outlet_name');
			$pic = $this->input->post('outlet_pic');
			$address = $this->input->post('outlet_address');
			$data=array(
				'username'	=> $name,
				'name' 		=> $name,
				'pic'		=> $pic,
				'address'	=> $address,
				'photo' 		=> $photo,
				'password'	=> hash_password($this->input->post('outlet_password'))
				);
			$this->crud_model->insert_data('outlets',$data);
			redirect('outlets');
		}
		else{
			$data['title']='Outlets';
			$data['subtitle']='OUTLETS';
			$this->template->load('default','outlets/add_outlet',$data);	
		}
	}

	public function edit_outlet($id){
		$data['outlet']=$this->crud_model->get_by_condition('outlets',array('id' => $id))->row();
		if($this->input->post('edit')){
			$config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 5000;			
			$config['upload_path']          = 'uploads/photos/'.$this->input->post('outlet_name');
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
            	$photo = $data['outlet']->photo;
            	$thumb = $data['outlet']->photo;
            }
			$name = $this->input->post('outlet_name');
			$pic = $this->input->post('outlet_pic');
			$address = $this->input->post('outlet_address');
			$data=array(
				'username'	=> $name,
				'name' 		=> $name,
				'pic'		=> $pic,
				'address'	=> $address,
				'photo'		=> $photo
				);
			$this->crud_model->update_data('outlets',$data,array('id'=>$id));
			redirect('outlets');
		}
		else{
			$data['title']='Outlets';
			$data['subtitle']='OUTLETS';
			
			$this->template->load('default','outlets/edit_outlet',$data);
		}
	}

	public function delete_outlet(){
		if($this->input->post('delete')){
			$id=$this->input->post('delete_id');
			$outlet=$this->crud_model->get_by_condition('outlets',array('id'=>$id))->row();
			unlink($outlet->pic);
			unlink($outlet->photo);
			$this->crud_model->delete_data('outlets',array('id'=>$id));
			redirect('outlets');
		}
	}

}



 ?>