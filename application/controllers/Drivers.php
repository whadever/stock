<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Drivers';
		$data['subtitle'] = 'DRIVERS';
		$data['drivers'] = $this->crud_model->get_data('drivers')->result();
		$this->template->load('default','drivers/all_drivers',$data);
	}

	public function input_driver(){

		if($this->input->post()){
			$config['allowed_types']        = 'jpg|png|jpeg';
		    $config['max_size']             = 2000;
		    // $config['max_width']            = 1000;
		    // $config['max_height']           = 768;

		    
								
			$config['upload_path']          = 'uploads/driver/' . $this->input->post('driver_code');
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
		    	$image = $this->upload->data();
		        //Get the link for the database
		        $photo = $config ['upload_path'] . '/' . $config ['file_name'];
		    }else{
		    	$photo = 'uploads/driver/no-photo.png';
		    }

			$data = array(
				'code' =>$this->input->post('driver_code'),
				'name' => $this->input->post('driver_name'),
				'address' => $this->input->post('driver_address'),
				'photo' => $photo
				);

			$this->crud_model->insert_data('drivers',$data);
			$this->session->set_flashdata("success","Success");
			redirect('drivers');
		}
		else{
			$data['title'] = 'Input Drivers';
			$data['subtitle'] = 'DRIVERS';
			$this->template->load('default','drivers/add_driver',$data);
		}

		
	}

	public function edit_driver($code){

		$data['drivers'] = $this->crud_model->get_by_condition('drivers',array('code' => $code))->row();

		if($this->input->post('save')){
			$config['allowed_types']        = 'jpg|png|jpeg';
		    $config['max_size']             = 2000;
		    // $config['max_width']            = 1000;
		    // $config['max_height']           = 768;

		    
								
			$config['upload_path']          = 'uploads/driver/' . $this->input->post('driver_code');
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
		    	$image = $this->upload->data();
		        //Get the link for the database
		        $photo = $config ['upload_path'] . '/' . $config ['file_name'];
		    }else{
		    	$photo = $data['drivers']->photo;
		    }

			$data = array(
				'code' =>$this->input->post('driver_code'),
				'name' => $this->input->post('driver_name'),
				'address' => $this->input->post('driver_address'),
				'photo' => $photo
				);

			$this->crud_model->update_data('drivers',$data,array('code' => $code));
			$this->session->set_flashdata("success","Success");

			redirect('drivers');
		}
		else{
			
			$data['title'] = 'Input Drivers';
			$data['subtitle'] = 'DRIVERS';
			$this->template->load('default','drivers/edit_driver',$data);
		}

	}

	public function delete(){
		$code = $this->input->post('code');
		$this->crud_model->delete_data('drivers',array('code' => $code));
		redirect('drivers');
	}
}
?>