<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class User extends MY_Controller {

	private $id;
	function __construct(){
		parent::__construct();
		$this->id = $this->session->userdata('is_active');
	}

	public function index(){

	}

	public function settings(){
		$data['title'] = 'Settings';
		$data['users'] = $this->crud_model->get_by_condition('users',array('id'=>$this->id))->row();
		$this->template->load('default','user/settings',$data);
	}

	public function save_settings(){
		$data['users'] = $this->crud_model->get_by_condition('users',array('id' => $this->id))->row();
		if($this->input->post('save')){
			
			$config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 2000;
            // $config['max_width']            = 1000;
            // $config['max_height']           = 768;

            
								
			$config['upload_path']          = 'uploads/photos/' . $this->input->post('username');
			$config['overwrite']			= True;
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
                //Get the link for the database
                $photo = $config ['upload_path'] . '/' . $config ['file_name'];
            }else{
           		$photo = $data['users']->photo;
            }

			$data = array(

				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'phone_number' => $this->input->post('phone_number'),
				'mobile_number' => $this->input->post('mobile_number'),
				'photo' => $photo,
				'password'=>hash_password($this->input->post('new_pass'))

				);

		}
		else{
			$data = array(
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'phone_number' => $this->input->post('phone_number'),
				'mobile_number' => $this->input->post('mobile_number'),
				'photo' => $photo
			);
		}

		$this->crud_model->update_data('users',$data,array('id'=>$this->id));
		redirect('user/settings/');
		
	}
	function check_password(){
		$data['users'] = $this->crud_model->get_by_condition('users',array('id' => $this->id))->row();

		$password = $data['users']->password;

		if(hash_password($this->input->post('old_pass')) != $password){
			echo 'mismatch';
		}
		else{
			echo "match";
		}
	}

}


?>