<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends MY_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->id = $this->session->userdata('is_active');
		$this->user_role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role');
	}

	public function index(){
		$data['title'] = 'Drivers';
		$data['subtitle'] = 'DRIVERS';
		$data['drivers'] = $this->crud_model->get_data('drivers')->result();
		$this->db->select('drivers.*, outlets.name as outlet_name');
		$this->db->from('drivers');
		$this->db->join('outlets','drivers.outlet_id = outlets.id');
		$data['drivers'] = $this->db->get()->result();
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
				'name' => $this->input->post('driver_name'),
				'address' => $this->input->post('driver_address'),
				'photo' => $photo,
				'outlet_id' => $this->id
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

	public function edit_driver($id){

		$data['drivers'] = $this->crud_model->get_by_condition('drivers',array('id' => $id))->row();

		if($this->input->post('save')){
			$config['allowed_types']        = 'jpg|png|jpeg';
		    $config['max_size']             = 2000;
		    // $config['max_width']            = 1000;
		    // $config['max_height']           = 768;

		    
								
			$config['upload_path']          = 'uploads/driver/' . $this->input->post('driver_name');
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
				'name' => $this->input->post('driver_name'),
				'address' => $this->input->post('driver_address'),
				'photo' => $photo
				);

			$this->crud_model->update_data('drivers',$data,array('id' => $id));
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
		$id = $this->input->post('id');
		$this->crud_model->delete_data('drivers',array('id' => $id));
		redirect('drivers');
	}
}
?>