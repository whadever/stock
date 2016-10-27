
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
		font-size: 10px;
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
			<div class="col-lg-4 content">
				<div class="row content">
					<div class="col-xs-3 text-center content">
						<svg id="barcode" width=1 height=1 style="border:1px solid #fff"></svg>
						<p><strong><?php echo $product->model ?></strong></p>
						<p><strong><?php echo rupiah($product->selling_price) ?></strong></p>			
					</div>
					<div class="col-xs-3 text-center" style="padding-top: 20px">
						<?php foreach ($specs as $spec):?>
							<p><strong><?php echo $spec->spec ?></strong></p>
						<?php endforeach; ?>
					</div>
					<div class="col-xs-3"></div>
				</div>
			</div>
			<div class="col-lg-4"></div>
			<div class="col-lg-4"></div>
			<div id="wrapper">
				
				
			</div>
				
		</div>
	</div>
	<script>
		$(document).ready(function(){
			JsBarcode("#barcode", "<?php echo $product->code ?>");
			window.print();
		});
	</script>
</body>
</html>



