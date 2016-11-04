<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller
{
	public function index ()
	{
		if($this->session->userdata('user_logged') == NULL)
		{
			$this->login();
		}
	}

	public function login ()
	{
		$data['title'] = "User Login";

		if($this->input->post())
		{
			$username = $this->input->post('username');
			$password = hash_password($this->input->post('password'));

			//Check for username and password validness
			if($userdata = $this->db->get_where('outlets', array('username' => $username, 'password' => $password))->row())
			{
				//Set The Session with no one logged
				if($this->session->userdata('user_logged') == NULL)
				{
					$session = array(
						
						'user_logged'				=> 1,
						'is_active'					=> $userdata->id,
						'id_' . $userdata->id 		=> array(

							'user_id' 	=> $userdata->id,
							'username'	=> $userdata->username,
							

							)

						);

					$this->session->set_userdata($session);

					redirect('main');

				
				}
				//check if this user is logged or not

				//Set The Session with someone one logged
				else
				{
					$i = 0;
                    foreach ($this->session->userdata as $user => $value)
                    { 

	                    //Skip the first 4 keys

	                    if($i < 3)
	                    {
	                        $i++;
	                        continue;
	                    }else
	                    {
	                      $i++;
	                    }
	                   $user= explode('_',$user);
                   
	                   if($userdata->id == $user[1]){
	                  		$this->switch_account($userdata->id);
	                   }
                    }

					$session = array(

						'user_logged'				=> $this->session->userdata('user_logged') + 1,
						'is_active'					=> $userdata->id,
						'id_' . $userdata->id 		=> array(

							'user_id' 	=> $userdata->id,
							'username'	=> $userdata->username

							)

						);

					$this->session->set_userdata($session);
					redirect('main');

				}

			}
			//Username Is not found
			else
			{
				$this->session->set_flashdata('fail',"alertify.error('Username atau password salah')");
			}
		}


		//If not post
		if($this->session->userdata('user_logged') == NULL)
		{
			//If there is no one logged in
			$this->template->load('default_login', 'accounts/login_non_logged', $data);
		}else
		{
			//If there is a person logged in
			$this->template->load('default_login', 'accounts/login_others_logged', $data);
		}
	}

	public function logout ()
	{
		if($this->session->userdata('user_logged') > 1){
			$active_user = $this->session->userdata('is_active');
			$user_logged = $this->session->userdata('user_logged') - 1;
			$this->session->unset_userdata('id_' . $active_user);
			$this->session->set_userdata(array('is_active' => NULL,'user_logged' => $user_logged));

			redirect('accounts/login');
		}else{
			$this->session->sess_destroy();
			redirect('accounts/login');
		}
		

		
	}

	public function select_account($id = ''){
		if($id != ''){
			$this->session->set_userdata('is_active',$id);
			redirect('main');
		}else{
			$data['title'] = 'User Selection';

			$this->template->load('default','accounts/select_account', $data);
		}
	}

	public function switch_account ($id = '')
	{
		if($id == '')
		{
			redirect('main');
		}else{

			$this->session->set_userdata('is_active',$id);
			redirect('main');
			
		}

	}


}

?>