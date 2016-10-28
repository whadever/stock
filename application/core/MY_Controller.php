<?php  

	class MY_Controller extends CI_Controller
	{
		private $id;
		private $user_role;

		function __construct ()
		{
			parent::__construct ();
			date_default_timezone_set('Asia/Jakarta');
			if($this->session->userdata('user_logged') == NULL)
			{
				redirect('accounts/login');
			}elseif($this->session->userdata('is_active') == ''){
				redirect('accounts/login');
			}
			$this->id = $this->session->userdata('is_active');
			$this->user_role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role');
		}

	}

?>
