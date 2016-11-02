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
			</div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed table_product" data-filter="#filter" data-page-size="10" >
				<thead>
					 <tr>
					 	<th data-type="numeric" data-sort-initial="true">No</th>
					 	<th data-hide="phone">Kode</th>
					 	<th data-toggle="true">Tanggal</th>
					 	<th data-type="numeric" data-hide="phone">Customer</th>
					 	<th data-type="numeric" data-hide="phone">Outlet</th>
					 	<th data-type="numeric" data-hide="phone">Total Transaksi</th>
					 </tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($sellings as $selling): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $selling->code ?></td>
							<?php $date = strtotime($selling->transaction_date)?>
							<td><?php echo date('d-M-Y H:i',$date) ?></td>
							<td><?php echo $selling->customer_name ?></td>
							<td><?php echo $selling->outlet_name ?></td>
							<td>$ <?php echo $selling->total_price ?></td>
							
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
			</div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed table_product" data-filter="#filter" data-page-size="10" >
				<thead>
					 <tr>
					 	<th data-type="numeric" data-sort-initial="true">No</th>
					 	<th data-hide="phone">Kode</th>
					 	<th data-toggle="true">Tanggal</th>
					 	
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
					<?php $i=1; foreach($purchasing as $row): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $row->transaction_code ?></td>
							<?php $date = strtotime($row->transaction_date) ?>
							<td><?php echo date('d-M-Y H:i:s',$date) ?></td>
							
							<td><?php echo $row->customer_name ?></td>
							<td><?php echo rupiah($row->selling_price) ?></td>
							
							
							<?php if($role != 'admin'): ?>
						 		<td><a href="<?php echo base_url('products/edit_product').'/'.$row->product_code?>">edit</a> | delete</td>
							<?php else: ?>
							 	<td><?php echo $row->outlet_name ?></td>
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
			</div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed table_product" data-filter="#filter" data-page-size="10">
				<thead>
					 <tr>
					 	<th data-type="numeric" data-sort-initial="true">No</th>
					 	<th data-hide="phone">Kode</th>
					 	<th data-toggle="true">Tanggal</th>
					 	<th data-type="numeric">Outlet Pengirim</th>
					 	<th data-type="numeric">Outlet Penerima</th>
					 </tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($mutations as $mutation): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $mutation->code ?></td>
							<?php $date = strtotime($mutation->date)?>
							<td><?php echo date('d-M-Y H:i',$date) ?></td>
							<td><?php echo $this->crud_model->get_by_condition('outlets',array('id'=>$mutation->from_id))->row('name'); ?></td>
							<td><?php echo $this->crud_model->get_by_condition('outlets',array('id'=>$mutation->to_id))->row('name'); ?></td>
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


<script>
	$(document).ready(function() {
   	 $('.table_product').footable();
   	 $(".fancybox").fancybox();
   	 <?php if($this->session->flashdata('success')): ?>
   	 <?php echo $this->session->flashdata('success') ?>
   	 <?php endif; ?>
	} );
</script>



