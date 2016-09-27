<?php  

	class MY_Controller extends CI_Controller
	{
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
		}

	}

?>