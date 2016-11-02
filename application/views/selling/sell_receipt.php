
<!DOCTYPE html>
<html>
<head>
<link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
<script src="<?php echo base_url() ?>js/JsBarcode.min.js"></script>
<script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
<title>Receipt</title>
</head>
<style type="text/css">
	#transaction_detail>tbody>tr>td, #transaction_detail>tbody>tr>th, #transaction_detail>tfoot>tr>td, #transaction_detail>tfoot>tr>th, #transaction_detail>thead>tr>td, #transaction_detail>thead>tr>th{
		border-top: none !important;
	}
</style>
<body>
	<?php 
	    $active_user = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row();    
   ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="row text-center">
					<p><strong><?php echo $active_user->name ?></strong></p>
					<p><?php echo $active_user->address?></p>
				</div>
				<div class="row">
					<table class="table" style="width: 50%;" id="transaction_detail">
						<tr>
							<td>Kode Transaksi</td>
							<td><?php echo $transaction->code?></td>
						</tr>
						<?php $date = strtotime($transaction->transaction_date) ?>
						<tr>
							<td>Tanggal Transaksi</td>
							<td><?php echo date('d-M-Y H:i:s',$date) ?></td>
						</tr>
						<tr>
							<td>Nama Customer</td>
							<td><?php echo $customer->name ?></td>
						</tr>
					</table>
					<table class="table">
						<thead>
						<tr>
							<th>No.</th>
							<th>Nama Barang</th>
							<th>Harga</th>
							<th>Disc</th>
							<th>Total</th>
						</tr>
						</thead>

						<?php $i=1; ?>
						<?php foreach($products as $product): ?>
						<tbody>
						<tr>
							<td><?php echo $i++ ?></td>
							<td><?php echo $product->name?></td>
							<td>Rp <?php echo $product->real_price?></td>
							<td>
								<?php
								$disc = (($product->real_price-$product->selling_price)/$product->real_price)*100;
								echo $disc
								?>%
							</td>
							<td>Rp <?php echo $product->selling_price?></td>
						</tr>
						<?php endforeach?>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="4">Total Harga</td>
							<td>Rp <?php echo $transaction->total_price?></td>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
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



