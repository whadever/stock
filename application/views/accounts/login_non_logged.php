
<!-- <div class="row" style="margin-top:10%;" >

<?php
	$exception=$this->session->userdata('exception');
    if(isset($exception)) {
       $exception1 = $exception;
		$this->session->unset_userdata('exception');
    }
?>
	<div class="col-md-6" id="logo-login" style="border-right: 2px solid #FFF">
		<img src="<?php echo base_url().'assets/logo.png' ?>" class="img img-responsive" id="logo" width="400" style="margin:auto" alt="Williams Platform">
	</div>
	<div class="col-md-6" style="padding: 10% 2%">
			<?php if(isset($exception1)){ ?>
							<div id="error-wrapper" class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<i class="glyphicon glyphicon-exclamation-sign" style="color: #c0392b;font-weight: bold;font-size: 15px;"></i>&nbsp;&nbsp;<?php echo $exception1 ?>
							</div>
				<?php } ?>
		<div style="background: padding: 6% 2%; border-radius: 4px">

			<form action="<?php echo base_url('accounts/login') ?>" method="post">
				<div class="form-group">
					<div class="input-group">
						
						<span class="input-group-addon" id="username-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
						<input type="text" name="username" placeholder="Username" class="form-control" aria-describedby="username-addon">

					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						
						<span class="input-group-addon" id="username-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
						<input type="password" name="password" placeholder="Password" class="form-control" aria-describedby="username-addon">

					</div>
				</div>
				

				<div class="form-group">
					<input type="submit" class="btn btn-default form-control" name="login" value="LOGIN">
				</div>

			</form>

			<a class="pull-right" href="">Forgot password?</a>
		</div>
	</div>
</div> -->


<div class="row" id="login_wrapper">
	<div class="col-md-4"></div>
	<div class="col-md-4" id="login_box">
		<img src="<?php echo base_url() ?>assets/logo1.png" width="200" id="hassee_logo" class="img img-responsive" alt="Hassee Logo">

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
	<div class="col-md-4"></div>
</div>
<script type="text/javascript">
	<?php if($this->session->flashdata('fail')): ?>
   		<?php echo $this->session->flashdata('fail') ?>
   	<?php endif; ?>
</script>