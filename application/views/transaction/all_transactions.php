
<!-- <script src="<?php echo base_url() ?>js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/canvas-toblob.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/filesaver.js"></script> -->
<link rel="stylesheet" href="<?php echo base_url() ?>fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() ?>fancybox/source/jquery.fancybox.pack.js"></script>

<style>
	#filter{
		width: 25%;
		display: inline-block;
	}
	.nostock{
		color: red;
	}

</style>
<?php $role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role'); ?>
<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;"><?php echo $subtitle?></p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
		<p class="bebas">PENJUALAN</p>
			<div class="form-group" style="margin-bottom: 20px">
				<label for="">Search :</label>
				<input type="text" class="form-control" id="filter">
				<?php if($role != 'admin'): ?>
					<a href="<?php echo base_url('selling') ?>" class="btn btn-primary pull-right">Transaksi Baru</a>
				<?php endif; ?>
			</div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed table_product" data-filter="#filter" data-page-size="10" >
				<thead>
					 <tr>
					 	<th data-type="numeric" data-sort-initial="true">No</th>
					 	<th data-hide="phone">Kode</th>
					 	<th data-toggle="true">Tanggal</th>
					 	<th data-type="numeric">Nama Barang</th>
					 	<th data-hide="phone">Kuantitas</th>
					 	<th data-type="numeric" data-hide="phone">Customer</th>
					 	<th data-type="numeric" data-hide="phone">Detail</th>
					 	<?php if($role != 'admin'): ?>
					 		<th data-hide="phone">Tindakan</th>
						<?php else: ?>
						 	<th data-hide="phone">Lokasi</th>
						<?php endif; ?>
					 </tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($sellings as $selling): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $selling->code ?></td>
							<td><?php echo $selling->name ?></td>
							<td><?php echo $product->model ?></td>
							<td><?php echo $product->category ?></td>
							<td><?php echo rupiah($product->buying_price) ?></td>
							<td><?php echo rupiah($product->selling_price) ?></td>
							<td>
							<?php echo ($product->quantity==0)? '<p class="nostock">Out of stock</p>':'Available' ?>	
							</td>
							<td><a class="fancybox" rel="group" href="<?php echo base_url().$product->photo ?>"><img src="<?php echo base_url().$product->thumb ?>" alt="<?php echo $product->name ?>" width="40"/></a></td>
							<?php if($role != 'admin'): ?>
						 		<td><a href="<?php echo base_url('products/edit_product').'/'.$product->code?>">edit</a> | delete</td>
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
	<div class="row" style="margin-top: 20px;">
		<p class="bebas">PEMBELIAN</p>
			<div class="form-group" style="margin-bottom: 20px">
				<label for="">Search :</label>
				<input type="text" class="form-control" id="filter">
				<?php if($role != 'admin'): ?>
					<a href="<?php echo base_url('purchase') ?>" class="btn btn-primary pull-right">Transaksi Baru</a>
				<?php endif; ?>
			</div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed table_product" data-filter="#filter" data-page-size="10" >
				<thead>
					 <tr>
					 	<th data-type="numeric" data-sort-initial="true">No</th>
					 	<th data-hide="phone">Kode</th>
					 	<th data-toggle="true">Tanggal</th>
					 	<th data-type="numeric">Nama Barang</th>
					 	<th data-hide="phone">Kuantitas</th>
					 	<th data-type="numeric" data-hide="phone">Supplier</th>
					 	<th data-type="numeric" data-hide="phone">Detail</th>
					 	<?php if($role != 'admin'): ?>
					 		<th data-hide="phone">Tindakan</th>
						<?php else: ?>
						 	<th data-hide="phone">Lokasi</th>
						<?php endif; ?>
					 </tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($sellings as $selling): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $selling->code ?></td>
							<td><?php echo $selling->name ?></td>
							<td><?php echo $product->model ?></td>
							<td><?php echo $product->category ?></td>
							<td><?php echo rupiah($product->buying_price) ?></td>
							<td><?php echo rupiah($product->selling_price) ?></td>
							<td>
							<?php echo ($product->quantity==0)? '<p class="nostock">Out of stock</p>':'Available' ?>	
							</td>
							<td><a class="fancybox" rel="group" href="<?php echo base_url().$product->photo ?>"><img src="<?php echo base_url().$product->thumb ?>" alt="<?php echo $product->name ?>" width="40"/></a></td>
							<?php if($role != 'admin'): ?>
						 		<td><a href="<?php echo base_url('products/edit_product').'/'.$product->code?>">edit</a> | delete</td>
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
	<div class="row" style="margin-top: 20px;">
		<p class="bebas">MUTASI</p>
			<div class="form-group" style="margin-bottom: 20px">
				<label for="">Search :</label>
				<input type="text" class="form-control" id="filter">
				<?php if($role != 'admin'): ?>
					<a href="<?php echo base_url('selling') ?>" class="btn btn-primary pull-right">Transaksi Baru</a>
				<?php endif; ?>
			</div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed table_product" data-filter="#filter" data-page-size="10">
				<thead>
					 <tr>
					 	<th data-type="numeric" data-sort-initial="true">No</th>
					 	<th data-hide="phone">Kode</th>
					 	<th data-toggle="true">Tanggal</th>
					 	<th data-type="numeric">Nama Barang</th>
					 	<th data-hide="phone">Kuantitas</th>
					 	<th data-type="numeric" data-hide="phone">Outlet</th>
					 	<th data-type="numeric" data-hide="phone">Detail</th>
					 	<?php if($role != 'admin'): ?>
					 		<th data-hide="phone">Tindakan</th>
						<?php else: ?>
						 	<th data-hide="phone">Lokasi</th>
						<?php endif; ?>
					 </tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($sellings as $selling): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $selling->code ?></td>
							<td><?php echo $selling->name ?></td>
							<td><?php echo $product->model ?></td>
							<td><?php echo $product->category ?></td>
							<td><?php echo rupiah($product->buying_price) ?></td>
							<td><?php echo rupiah($product->selling_price) ?></td>
							<td>
							<?php echo ($product->quantity==0)? '<p class="nostock">Out of stock</p>':'Available' ?>	
							</td>
							<td><a class="fancybox" rel="group" href="<?php echo base_url().$product->photo ?>"><img src="<?php echo base_url().$product->thumb ?>" alt="<?php echo $product->name ?>" width="40"/></a></td>
							<?php if($role != 'admin'): ?>
						 		<td><a href="<?php echo base_url('products/edit_product').'/'.$product->code?>">edit</a> | delete</td>
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
	$(document).ready(function() {
   	 $('.table_product').footable();
   	 $(".fancybox").fancybox();
	} );
</script>



