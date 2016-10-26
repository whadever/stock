<style>
	.avatar{
	  border-radius: 10px;
	  border: 1px solid black;
	  height:60px; 
	  width:60px; 
	  background-size:cover;
	  background-position: center center; 
	}

	#fields .form-control{
		width: 60%;
		display: inline-block;
		border:1px solid black;
		border-radius: 10px;
	}

	#fields label{
		width: 25%;
	}
</style>

<div class="row" style="padding:15px 10px">
	<div class="col-xs-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">USER SETTINGS</p>
		</div>
		<?php echo form_open_multipart('user/save_settings/'.$outlets->id) ?>
		<div class="row" style="margin-top: 20px">
			<div class="col-sm-2 col-md-1">
				<div class="avatar" style="background-image : url('<?php echo base_url().$outlets->photo ?>'); ">
				</div>
				
			</div>
			<div class="col-sm-10 col-md-11">
				<strong><p>Change Profile Picture</p>
				<input type="file" name="photo"></strong>
			</div>
		</div>
		
		<div class="row" id="fields" style="padding-top:20px">	
			
			<div class="col-md-6">
				<input type="hidden" name="id" id="id" value="<?php echo $outlets->id ?>">
				<div class="form-group">	
					<label for="">Name</label>
					<input type="text" class="form-control" name="name" value="<?php echo $outlets->name ?>">
				</div>
				<div class="form-group">	
					<label for="">Address</label>
					<input type="text" class="form-control" name="address" value="<?php echo $outlets->address ?>">
				</div>
				<div class="form-group">	
					<label for="">Phone No.</label>
					<input type="text" class="form-control" name="phone_number" value="<?php echo $outlets->phone_number ?>">
				</div>
				<div class="form-group">	
					<label for="">Mobile No.</label>
					<input type="text" class="form-control" name="mobile_number" value="<?php echo $outlets->mobile_number ?>">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">	
					<label for="">Username</label>
					<input type="text" class="form-control" name="username" value="<?php echo $outlets->username ?>" readonly="readonly">
				</div>
				<div id="changepassword">	
					<a onclick="change_password()" style="cursor:pointer;">Change Password</a>
				</div>
			</div>


		</div>
		<div class="row" style="padding-top:20px;">	
			<div class="col-md-4">	</div>
			<div class="col-md-4">
				<div class="row">	
					<div class="col-md-12 text-center">	
						<input type="submit" name="save" id="btnSubmit" value="SAVE" class="btn btn-default btn-custom" style="border-radius:10px;">
					</div>
				</div>
			</div>
			<div class="col-md-4">	</div>
		</div>
		<?php echo form_close() ?>
			
	
	</div>
</div>
<script>
	function change_password(){
		
		$('#changepassword').empty();
		$('#changepassword').append('<div class="form-group"><label for="old_pass">Old Password</label> <input type="password" class="form-control" name="old_pass" id="old_pass" required="required" onblur="check_password()" ><div id="old_pass_error" style="margin-top:5px;"></div></div>');
		$('#changepassword').append('<div class="form-group"><label for="new_pass">New Password</label> <input type="password" name="new_pass" id="new_pass" required="required" class="form-control" onblur="match_password()"></div>');
		$('#changepassword').append('<div class="form-group"><label for="re_pass">Re-Type Password</label> <input type="password" class="form-control" name="re_pass" id="re_pass" required="required" onblur="match_password()"><div id="re_pass_error" style="margin-top:5px;color:red;"></div></div>');
		$('#changepassword').append('<div class="form-group"><a onclick=collapsePassword() style="cursor:pointer" id="backToggle">Back</a></div>');
		$('#btnSubmit').attr("disabled","disabled");
	}
</script>

<script>
	function collapsePassword(){
		$('#changepassword').empty();
		$('#changepassword').append('<a onclick="change_password()" style="cursor:pointer;">Change Password</a>');
		$('#btnSubmit').removeAttr("disabled");
	}
</script>

<script>
	function check_password(){

		var password = $("#old_pass").val();
		if(password!=''){
			$.ajax({
	          url: "<?php echo base_url('user/check_password/')?>",
	          data: {old_pass:password},
	          type: 'POST',
	          cache : false,
	          success: function(result){
	          	alert(result);
	            if(result == 'mismatch'){
	              $('#old_pass_error').empty();
	              $('#old_pass_error').append('<p style="color:red"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Password that you type is wrong</p>');
	              $('#btnSubmit').attr("disabled","disabled");
	            }else if(result == 'match'){
	              $('#old_pass_error').empty();
	              
	            } 
          }
        });
      }else{
	      $('#old_pass_error').empty();
      }
	}
</script>
<script>
	function match_password(){
		var new_password=$('#new_pass').val();
		var re_password=$('#re_pass').val();
		if(new_password!=re_password){
			$('#re_pass_error').empty();
			$('#re_pass_error').append('<i class="fa fa-times-circle-o" aria-hidden="true"></i>Password doesn\'t match');
			$('#btnSubmit').attr("disabled","disabled");
		}
		else{
			$('#re_pass_error').empty();
		}
	}
</script>



