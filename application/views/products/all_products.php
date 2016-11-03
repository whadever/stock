
<script src="<?php echo base_url() ?>js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/canvas-toblob.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/filesaver.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() ?>fancybox/source/jquery.fancybox.pack.js"></script>

<style>
	#filter,#filter_all{
		width: 25%;
		display: inline-block;
	}
	.nostock{
		color: red;
	}

</style>
<?php $active_user = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row();?>
<?php $role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role'); ?>
<div class="row">
	<div class="col-md-12 content-wrap">
		<?php if($role!='admin'):?>
			<div class="row" style="border-bottom: 2px solid #2c3e50">
				<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">DAFTAR PRODUK</p>
				<p>Status User:</p>
			</div>
			<div class="row" style="margin-top: 20px;">
				<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">PRODUK <?php echo $active_user->name ?></p>
				<div class="form-group" style="margin-bottom: 20px">
					<label for="">Search :</label>
					<input type="search" class="form-control" id="filter">
					<!-- <?php #if($role == 'admin'): ?>
						<a href="<?php #echo base_url('products/add') ?>" class="btn btn-primary pull-right">Add Product</a>
					<?php #endif; ?> -->
				</div>
				<div class="table-responsive toggle-circle-filled">
				<table class="table table-condensed table_product" data-filter="#filter" data-page-size="10">
					<thead>
						 <tr>
						 	<th data-type="numeric" data-sort-initial="true">No</th>
						 	<th data-hide="phone">Kode</th>
						 	<th data-toggle="true">Name</th>
						 	<th data-type="numeric">Model</th>
						 	<th data-hide="phone">Kategori</th>
						 	<th data-type="numeric" data-hide="phone">Harga Beli</th>
						 	<th data-type="numeric" data-hide="phone">Harga Jual</th>
							<th data-hide="phone">Status</th>
						 	<!-- <th data-hide="phone">Gambar</th> -->
						 	<?php if($role != 'admin'): ?>
						 		<th data-hide="phone">Tindakan</th>
							<?php else: ?>
							 	<th data-hide="phone">Lokasi</th>
							<?php endif; ?>
						 </tr>
					</thead>
					<tbody>
						<?php $i=1; foreach($products as $product): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $product->code ?></td>
								<td><a class="fancybox" rel="group" href="<?php echo base_url().$product->photo ?>"><?php echo $product->name ?></a></td>
								<td><?php echo $product->model ?></td>
								<td><?php echo $product->category ?></td>
								<td><?php echo rupiah($product->buying_price) ?></td>
								<td><?php echo rupiah($product->selling_price) ?></td>
								<td>
								<?php if($product->active==1): ?> 
								<?php echo ($product->quantity==0)? '<p class="nostock">Out of stock</p>':'Available' ?>
								<?php else: ?>
								<p class="nostock">Deactivated</p>	
								<?php endif; ?>
								</td>
								<!-- <td><a class="fancybox" rel="group" href="<?php //echo base_url().$product->photo ?>"><img src="<?php //echo base_url().$product->thumb ?>" alt="<?php //echo $product->name ?>" width="40"/></a></td> -->
								<?php if($role != 'admin'): ?>
							 		<td><a href="<?php echo base_url('products/edit_product').'/'.$product->code?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> | <a onclick="deactivate_product('<?php echo $product->code ?>')"><i class="fa fa-trash" aria-hidden="true"></i></a> | <a target="_blank" href="<?php echo base_url('products/print_product').'/'.$product->code ?>"><i class="fa fa-print" aria-hidden="true"></i></a></td>
								<?php else: ?>
								 	<td><?php echo $product->outlet_name ?></td>
								<?php endif; ?>
								
							</tr>
						<?php $i++; endforeach; ?>
					</tbody>
					<tfoot class="hide-if-no-paging">
						<td colspan="9">
							<div class="pagination"></div>
						</td>
						
					</tfoot>
				</table>
			</div>
		</div>
	<?php endif?>
	<div class="row" style="margin-top: 20px;">
		<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">PRODUK SEMUA OUTLET</p>
		<div class="form-group" style="margin-bottom: 20px">
				<label for="filter_all">Search :</label>
				<input type="search" class="form-control" id="filter_all">
		</div>
		<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed table_product" data-filter="#filter_all" data-page-size="10">
				<thead>
					 <tr>
					 	<th data-type="numeric" data-sort-initial="true">No</th>
					 	<th data-hide="phone">Kode</th>
					 	<th data-toggle="true">Name</th>
					 	<th data-type="numeric">Model</th>
					 	<th data-hide="phone">Kategori</th>
					 	<th data-type="numeric" data-hide="phone">Harga Beli</th>
					 	<th data-type="numeric" data-hide="phone">Harga Jual</th>
						<th data-hide="phone">Status</th>
					 	<!-- <th data-hide="phone">Gambar</th> -->
						<th data-hide="phone">Lokasi</th>
						<?php if($role == 'admin'): ?>
					 		<th data-hide="phone">Tindakan</th>
					 	<?php endif; ?>
						
					 </tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($allproducts as $allproduct): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $allproduct->code ?></td>
							<td><a class="fancybox" rel="group" href="<?php echo base_url().$allproduct->photo ?>"><?php echo $allproduct->name ?></a></td>
							<td><?php echo $allproduct->model ?></td>
							<td><?php echo $allproduct->category ?></td>
							<td><?php echo rupiah($allproduct->buying_price) ?></td>
							<td><?php echo rupiah($allproduct->selling_price) ?></td>
							<td>
							<?php if($allproduct->active==1): ?> 
							<?php echo ($allproduct->quantity==0)? '<p class="nostock">Out of stock</p>':'Available' ?>
							<?php else: ?>
							<p class="nostock">Deactivated</p>	
							<?php endif; ?>
							</td>
							<!-- <td><a class="fancybox" rel="group" href="<?php //echo base_url().$product->photo ?>"><img src="<?php //echo base_url().$product->thumb ?>" alt="<?php //echo $product->name ?>" width="40"/></a></td> -->
							 <td><?php echo $allproduct->outlet_name ?></td>
							 <?php if($role == 'admin'): ?>
						 		<td><a href="<?php echo base_url('products/edit_product').'/'.$allproduct->code?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> | <a onclick="deactivate_product('<?php echo $allproduct->code ?>')"><i class="fa fa-trash" aria-hidden="true"></i></a> | <a target="_blank" href="<?php echo base_url('products/print_product').'/'.$allproduct->code ?>"><i class="fa fa-print" aria-hidden="true"></i></a></td>
							<?php endif; ?>
							
							
						</tr>
					<?php $i++; endforeach; ?>
				</tbody>
				<tfoot class="hide-if-no-paging">
					<td colspan="10">
						<div class="pagination"></div>
					</td>
					
				</tfoot>
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
   	 $('.table_product').footable();
   	 $(".fancybox").fancybox();
   	 <?php if($this->session->flashdata('success')): ?>
   	 <?php echo $this->session->flashdata('success') ?>
   	 <?php endif; ?>
	} );

	function deactivate_product(code){
		alertify.confirm("Are you sure?", function (e) {
	    if (e) {
	        location.replace("<?php echo base_url() ?>" + "products/deactivate_product/" + code);
	    } else {
	        // user clicked "cancel"
	    }
	});
	}
</script>



