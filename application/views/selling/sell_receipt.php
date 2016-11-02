
<!DOCTYPE html>
<html>
<head>
<link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
<script src="<?php echo base_url() ?>js/JsBarcode.min.js"></script>
<script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
<style>
	p{
		margin:0;
		font-size: 8px;
	}

	.content{
		padding-left: 0;
	}

</style>
	<title>print</title>
</head>
<body>
	<div class="container-fluid content">
		<div class="row content">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div class="row">
					
				</div>
			</div>
			<div class="col-lg-4"></div>
			<div id="wrapper">
				
				
			</div>
				
		</div>
	</div>
	<script>
		$(document).ready(function(){
			window.print();
		});
	</script>
</body>
</html>



