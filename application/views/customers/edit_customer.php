<style type="text/css">
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
</style>
<div class="row">
	<?php if($this->session->flashdata('success')): ?>
		<div class="alert alert-success alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong><?php echo $this->session->flashdata('success') ?></strong>
		</div>
		
	<?php endif ?>
</div>
<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">EDIT CUSTOMER</p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
			<?php echo form_open('customers/edit_customer/'.$customer->id) ?>
			<table class="table product-table">
				<tbody>
				<tr>
					<td class="table_detail"><p class="bebas">NAMA</p></td>
					<td style="padding-right: 9%;"><input type="text" name="customer_name" placeholder="Nama Customer" class="form-control" value="<?php echo $customer->name?>"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">ALAMAT</p></td>
					<td style="padding-right: 9%;"><input type="text" name="customer_address" placeholder="Alamat Customer" class="form-control" value="<?php echo $customer->address?>"></td>
				</tr>
				<!-- <tr>
					<td class="table_detail"><p class="bebas">DRIVER UNTUK OUTLET</p></td>
					<td style="padding-right: 9%;"><input type="text" name="driver_outlet" placeholder="Outlet" class="form-control"></td>
				</tr> -->
				<tr>
					<td class="table_detail"><p class="bebas">NO.TELP</p></td>
					<td style="padding-right: 9%;"><input type="text" name="customer_telp" placeholder="Nomor Telepon" class="form-control" value="<?php echo $customer->phone?>"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">EMAIL</p></td>
					<td style="padding-right: 9%;"><input type="email" name="customer_mail" placeholder="Email Customer" class="form-control" value="<?php echo $customer->email?>"></td>
				</tr>
				</tbody>
			</table>
			
		</div>
		<div class="row text-center">
			<input type="submit" class="btn btn-default btn-custom" name="update" value="UPDATE">
		</div>
		<?php echo form_close(); ?>	
	</div>
</div>
