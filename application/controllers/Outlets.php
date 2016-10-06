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
			$name = $this->input->post('outlet_name');
			$pic = $this->input->post('outlet_pic');
			$address = $this->input->post('outlet_address');
			$data=array(
				'username'=> $name,
				'pic'=>$pic,
				'address'=>$address
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



}



 ?>