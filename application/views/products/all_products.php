
<script src="<?php echo base_url() ?>js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/canvas-toblob.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/filesaver.js"></script>

<style>
	#filter{
		width: 25%;
		display: inline-block;
	}

</style>

<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">ALL PRODUCTS</p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
			<div class="form-group" style="margin-bottom: 20px">
				<label for="">Search :</label>
				<input type="text" class="form-control" id="filter">
				<a href="<?php echo base_url('products/add') ?>" class="btn btn-primary pull-right">Add Product</a>
			</div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed" data-filter="#filter" data-page-size="10" id="table_product">
				<thead>
					 <tr>
					 	<th data-type="numeric" data-sort-initial="true">No</th>
					 	<th data-hide="phone">Code</th>
					 	<th data-toggle="true">Name</th>
					 	<th data-hide="phone">Category</th>
					 	<th data-type="numeric" data-hide="phone">Harga Beli</th>
					 	<th data-type="numeric" data-hide="phone">Harga Jual</th>
					 	<th data-hide="phone">Gambar</th>
					 	<th data-hide="phone">Tindakan</th>
					 </tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($products as $product): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $product->code ?></td>
							<td><?php echo $product->name ?></td>
							<td><?php echo $product->category ?></td>
							<td><?php echo rupiah($product->buying_price) ?></td>
							<td><?php echo rupiah($product->selling_price) ?></td>
							<td><img src="<?php echo base_url().$product->thumb ?>" alt="<?php echo $product->name ?>" width="40"/></td>
							<td><a href="<?php echo base_url('products/edit_product').'/'.$product->code?>">edit</a> | delete</td>
						</tr>
					<?php $i++; endforeach; ?>
				</tbody>
			</table>
		</div>
		
		
	
	</div>
</div>
<!-- <div class="modal fade" id="delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				Delete Product
			</div>
			<?php //echo form_open('products/delete_product')?>
			<div class="modal-body">Delete this data?</div>
			<div class="modal-footer">
				<
			</div>
			<?php //echo form_close()?>
		</div>
	</div>
</div> -->
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


