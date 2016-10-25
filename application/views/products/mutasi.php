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
	
</style>

<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;"> BARANG</p>
			<p>Status User:</p>
		</div>

		
		<div class="row text-center">
			<input type="submit" class="btn btn-default btn-custom" value="SAVE" name="update">
		</div>	
		<?php echo form_close(); ?>
	</div>
</div>
		<div class="row" style="margin-top: 20px;">
		<?php echo form_open_multipart('products/distribute') ?>
			<table class="table distribute-table">
				<tbody>
				<tr>
					<td><p class="bebas">PILIH OUTLET</p></td>
					<td><p class="bebas">PILIH DRIVER</p></td>
				</tr>
				<tr>
					<td style="padding-right: 5%;">
						<select required="1" class="form-control" id="" name="outlet_distribute">
						<option value="">--Pilih Outlet--</option>
						<?php foreach($outlets as $outlet): ?>
							<option value="<?php echo $outlet->id ?>"><?php echo $outlet->username ?></option>
						<?php endforeach; ?>
						</select>
					</td>
					<td>
						<select required="1" class="form-control" id="" name="outlet_distribute">
						<option value="">--Pilih Driver--</option>
						<?php foreach($drivers as $driver): ?>
							<option value="<?php echo $driver->code ?>"><?php echo $driver->name ?></option>
						<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="table_detail" colspan="2" style="padding-bottom: 0px;"><p class="bebas">PRODUK YANG DIKIRIM</p></td>
				</tr>
				<tr>
					<td colspan="2">
					<table class="table product-table" id="product_table" style="background: transparent;margin-bottom: 0px;">
						<tbody>
							<tr>
							<td>
								<select required="1" class="form-control" id="" name="product_distribute[]">
									<option value="">--Pilih Produk--</option>
									<?php foreach($products as $product): ?>
										<option value="<?php echo $product->code ?>"><?php echo $product->name ?></option>
									<?php endforeach; ?>
								</select>
							</td>
							<td><input type="text" name="product_quantity[]" placeholder="Jumlah Barang" class="form-control" required="1"></td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
				<tr>
					<td>
						<a href="#" class="btn btn-primary product-add">Tambah Barang</a>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		
		
<script>
	jQuery(function(){
    	var counter = 1;
    	jQuery('a.product-add').click(function(event){
	        event.preventDefault();

	        var newRow = jQuery('<tr><td><select required="1" class="form-control" id="" name="product_distribute[]"><option>--Pilih Barang--</option></select></td><td><input name="product_quantity[]" placeholder="Jumlah Barang" class="form-control" required="1"/></td></tr>');
	        jQuery('table#product_table').append(newRow);

    	});
	});
</script>