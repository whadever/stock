<style type="text/css">
	.acc-photo{
		margin-right: 10px;
		display: inline-block;
		margin-top: -28px;
	}
	.acc-detail{
		display: inline-block;
		padding-top: 10px;
	}
	.profile-box{
		background: rgba(255,255,255,0.5);
		width: 100%;
		text-align: left;
		padding-bottom: 3px;
		padding-top: 0px;
		border-radius: 0px;
	}
	.choose{
		background: rgba(200,200,200,0.6);
        color: white;
        border: 1px solid #ccc;
        border-bottom: none;
        padding-top: 10px;
        padding-bottom: 10px;
        font-weight: bold;
	}
</style>
<div class="row">
	<img src="<?php echo base_url() ?>assets/logo1.png" width="110" id="hassee_logo" class="img img-responsive" alt="Hassee Logo">
</div>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4" style="min-height:400px;">
		<div class="row choose text-center">
			Choose an Account
		</div>
		<div class="row">
		<?php if($this->session->userdata('user_logged')){
                        $i = 0;
                        foreach ($this->session->userdata() as $user)
                        { 
                          //Skip the first 3 keys
                          if($i < 3)
                          {
                            $i++;
                            continue;
                          }else
                          {
                            $i++;
                          }
                          
                          $profile = $this->crud_model->get_by_condition('outlets',array('id' => $user['user_id']))->row();
                          //After 3 keys are bypassed user info are passed!
                          
                          
                          if($profile->photo == ''){
                            $photo = base_url()."uploads/photos/no-photo.png";
                          }else{
                            $photo = base_url().$profile->photo; 
                          }
                       


                            echo"<a href='".base_url('accounts/switch_account/'.$profile->id)."' class='profile-box btn btn-default'><img src='".$photo."' width='50' class='acc-photo'><div class='acc-detail'><p>".$profile->name."</p><p>".$profile->pic."</p> </div></a>";

                        
                        }

                      } ?>
         </div>
         <div class="row" id="login_wrapper">
         	<div id="login_box" style="background: padding: 6% 2%; border-radius: 4px">
				<form action="<?php echo base_url('accounts/login') ?>" method="post">
						<div class="form-group">

							<input type="text" name="username" placeholder="Username" class="form-control" aria-describedby="username-addon">
							
						</div>
						<div class="form-group">										
								
							<input type="password" name="password" placeholder="Password" class="form-control" aria-describedby="username-addon">
							
						</div>

						<table style="width: 100%">
							<tr>
								<td style="width:5%"><input type="radio" value="remember"></td>
								<td style="width:40%"><p id="remember">Remember Me</p></td>
								<td style="width:55%"><a href="" class="pull-right" id="forgotPass">Forgot Password ?</a></td>
							</tr>
						</table>
							 
							
						<div class="form-group">
						<table style="width:100%">
							<tr>
								<td style="width: 47%" class="text-center"><a class="btn btn-primary login-button" href="">Sign Up</a></td>
								<td style="width: 6%">&nbsp;</td>
								<td style="width: 47%" class="text-center"><input type="submit" class="btn btn-primary login-button" name="login" value="Log In"></td>

							</tr>
						</table>
							
							
						</div>

					</form>
			</div>
         </div>
                      
	</div>
	<div class="col-md-4">
		
	</div>
</div>