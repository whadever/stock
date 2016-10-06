<script src="<?php echo base_url() ?>js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/canvas-toblob.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/filesaver.js"></script>
<style type="text/css">
	.product-table td{
		padding-left: 0px !important;
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
		border-top: none !important;
	}
	.table_detail{
		width: 24% !important;
	}

	.fileUpload {
	    position: relative;
	    overflow: hidden;
	}
	.fileUpload input.upload {
	    position: absolute;
	    top: 0;
	    right: 0;
	    margin: 0;
	    padding: 0;
	    font-size: 20px;
	    cursor: pointer;
	    opacity: 0;
	    filter: alpha(opacity=0);
	}

	#filter{
		width: 25%;
		display: inline-block;
	}

</style>
<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">DRIVERS</p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
			<div class="form-group" style="margin-bottom: 20px">
				<label for="">Search :</label>
				<input type="text" class="form-control" id="filter">
				<a href="<?php echo base_url('drivers/input_driver') ?>" class="btn btn-primary pull-right">Input Driver</a>
			</div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed" data-filter="#filter" data-page-size="10" id="table_product">
				<thead>
					 <tr>
					 	<th data-type="numeric" data-sort-initial="true">No</th>
					 	<th data-hide="phone">Code</th>
					 	<th data-toggle="true">Name</th>
					 	<th data-hide="phone">Address</th>
					 	<th data-hide="phone">Gambar</th>
					 	<th data-hide="phone">Tindakan</th>
					 </tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($drivers as $driver): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $driver->code ?></td>
							<td><?php echo $driver->name ?></td>
							<td><?php echo $driver->address ?></td>
							<td><img src="<?php echo base_url().$driver->photo ?>" alt="<?php echo $driver->name ?>" width="40"/></td>
							<td>edit | delete</td>
						</tr>
					<?php $i++; endforeach; ?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

<script>
	function generate_barcode(){

		if (!$('#item_code').val()) {
			
			alert('Kode Barang Harus diisi');
		}else{
			$('#saveas').show();
			JsBarcode("#barcode", $('#item_code').val());
		}
		
		
	}

	function saveCanvas(type, ext) {
		var canvas = document.getElementById('barcode');
		canvas.toBlob(function (blob) {
						  saveAs(blob, $('#item_code').val() + ext);
					  }, type, 1);
		
	}

</script>



<script>
	$(document).ready(function() {
   	 $('#table_product').footable();
	} );
</script>



