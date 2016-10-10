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
	.table .table{
		background-color: transparent;
	}
	.input-group-addon{
		background-color: #2c3e50;
		color: #fff;
		border-radius: 10px;
		border-color: #2c3e50;
	}

</style>
<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">INPUT PRODUCT</p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
		<?php echo form_open_multipart('products/add_product') ?>
			<table class="table product-table">
				<tbody>
				<tr>
					<td class="table_detail"><p class="bebas">NAMA BARANG</p></td>
					<td style="padding-right: 9%;"><input type="text" name="item_name" required="1" placeholder="Nama Barang" class="form-control"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">JUMLAH BARANG</p></td>
					<td style="padding-right: 9%;"><input type="text" pattern="\d*" required="1" name="item_quantity" placeholder="Jumlah Barang" class="form-control"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">KODE MODEL</p></td>
					<td style="padding-right: 9%;"><input type="text" pattern="^\S{1,20}" title="Kode Model tidak boleh mengandung spasi dan panjang maksimal 20 karakter" name="item_model" placeholder="Kode Model" class="form-control" required="1"></td>
					
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">KATEGORI BARANG</p></td>
					<td style="padding-right: 9%;"><select name="item_category" required="1" class="form-control" id="">
						<option value="">--Pilih Kategori--</option>
						<?php foreach($categories as $category): ?>
							<option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
						<?php endforeach; ?>
					</select></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">UPLOAD FOTO BARANG</p></td>
					<td style="padding-right: 9%;"><div class="fileUpload btn btn-primary">
													    <span>Upload</span>
													    <input type="file" id="photo" class="upload" name="photo" />
													</div></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">KODE BARANG</p></td>
					<td style="padding-right: 9%;"><input type="text" pattern="^\S{1,20}" title="Kode Barang tidak boleh mengandung spasi dan panjang maksimal 20 karakter" id="item_code" onblur="generate_barcode()" name="item_code" placeholder="Kode Barang" class="form-control" required="1"></td>
					
				</tr>				
				<tr>
					<td class="table_detail"><p class="bebas">BARCODE</p></td>
					<td style="padding-right: 9%;"><canvas id="barcode" width=1 height=1 style="border:1px solid #fff"></canvas>
					<div><a id="saveas" class="btn btn-primary" href="javascript:saveCanvas('image/png','.png')" style="display: none">Save As PNG</a></div>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom: 0px !important;"><p class="bebas" style="margin-bottom: 0px;">SPESIFIKASI</p></td>
				</tr>
					<td colspan="2" style="padding-top: 0px;">
						<table class="table spec-table" style="margin-bottom: 0px; margin-left: 20px; width: 80%">
							<tr>
								<td colspan="3" style="padding-bottom: 0px;"><p class="bebas" style="font-size: 20px;"> Emas Putih</p></td>
							</tr>
							<tr>
								<td style="padding-top: 0px;">
								<div class="input-group">
									<input type="number" name="w_amount" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" placeholder="Jumlah Emas Putih">
									<span class="input-group-addon">w</span>
								</div>
								</td>
							</tr>
							<tr>
								<td colspan="3" style="padding-bottom: 0px;"><p class="bebas" style="font-size: 20px;"> Emas</p></td>
							</tr>
							<tr>
								<td style="padding-top: 0px;">
								<div class="input-group">
									<input type="number" name="g_amount" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" placeholder="Jumlah Emas">
									<span class="input-group-addon">g</span>
								</div>
								</td>
							</tr>
							<tr>
								<td colspan="3" style="padding-bottom: 0px;"><p class="bebas" style="font-size: 20px;"> Diamond</p></td>
							</tr>
							<tr>
								<td style="padding-top: 0px;">
								<div class="input-group">
									<input type="number" name="diamond_amount[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" placeholder="Jumlah Diamond">
									<span class="input-group-addon">rd</span>
								</div>
								</td>
								<td style="padding-top: 0px;">
								<div class="input-group">
									<input type="number" name="diamond_carat[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" placeholder="Ct.">
									<span class="input-group-addon">ct.</span>	
								</div>
								</td>
								<td style="padding-top: 0px;"><a href="#" class="btn btn-primary spec-add">Tambah Spesifikasi Diamond</a></td>
							</tr>
							
						</table>
					</td>
				</tr>
				<tr>
								<td colspan="2" style="padding-top: 0px;padding-bottom: 20px;">
									
								</td>
							</tr>
				<tr>
					<td class="table_detail"><p class="bebas">HARGA BELI</p></td>
					<td style="padding-right: 9%;"><input type="text" pattern="\d*" required="1" onkeyup="sell_price()" id="buy" name="item_buy" placeholder="Harga Beli" class="form-control"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">MARGIN</p></td>
					<td style="padding-right: 9%;"><input type="text" pattern="\d*" required="1" onkeyup="sell_price()" id="margin" placeholder="Margin" class="form-control"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">HARGA JUAL</p></td>
					<td style="padding-right: 9%;"><input type="text" pattern="\d*" id="sell" required="1" readonly="readonly" name="item_sell" placeholder="Harga Jual" class="form-control"></td>
				</tr>
				</tbody>
			</table>
		</div>
		
		<div class="row text-center">
			<input type="submit" class="btn btn-default btn-custom" value="SAVE" name="save">
		</div>	
		<?php echo form_close(); ?>
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

	function sell_price(){
		if (!$('#margin').val() || !$('#buy').val()) {
			$('#sell').val(0);
			
		}else{
			$('#sell').val(+$('#margin').val() / +100 * +$('#buy').val() + +$('#buy').val());
		}
	}

</script>
<script>
	jQuery(function(){
    	var counter = 1;
    	jQuery('a.spec-add').click(function(event){
	        event.preventDefault();

	        var newRow = jQuery('<tr><td><div class="input-group"><input type="number" name="diamond_amount[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" placeholder="Jumlah Diamond"><span class="input-group-addon">rd</span></div></td><td><div class="input-group"><input type="number" name="diamond_carat[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" placeholder="Ct."><span class="input-group-addon">ct.</span></div></tr>');
	        jQuery('table.spec-table').append(newRow);

    	});
	});
</script>

