		<div class="row content-wrap" style="margin-top: 20px;">
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