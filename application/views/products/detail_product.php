<script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
<script src="<?php echo base_url() ?>js/JsBarcode.all.min.js"></script>
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
		
		<div class="row" style="margin-top: 20px;">
			<table class="table product-table">
				<tbody>
							
				<tr>
					<td class="table_detail"><canvas id="barcode" width=1 height=1 style="border:1px solid #fff"></canvas></td>
					<td style="padding-right: 9%;"
					<div><a id="saveas" class="btn btn-primary" href="javascript:saveCanvas('image/png','.png')" style="display: none">Save As PNG</a></div>
					</td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">HARGA BELI</p></td>
					<td style="padding-right: 9%;"><input type="text" pattern="\d*" required="1" name="item_price" placeholder="Harga Barang" class="form-control" value="<?php echo $product->buying_price;?>"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">KATEGORI BARANG</p></td>
					<td style="padding-right: 9%;"><select name="item_category" required="1" class="form-control" id="">
						<option value="">--Pilih Kategori--</option>
						<?php foreach($categories as $category): ?>
							<option value="<?php echo $category->id ?>" <?php echo ($product->category==$category->id)?'selected="selected"' : '' ?> ><?php echo $category->name ?></option>
						<?php endforeach; ?>
					</select></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">KODE BARANG</p></td>
					<td style="padding-right: 9%;"><input type="text" pattern="^\S{1,20}" title="Kode Barang tidak boleh mengandung spasi dan panjang maksimal 20 karakter" id="item_code" onblur="generate_barcode()" name="item_code" placeholder="Kode Barang" class="form-control" required="1" value="<?php echo $product->code;?>" readonly="readonly"></td>
					
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">UBAH FOTO BARANG</p></td>
					<td style="padding-right: 9%;"><div class="fileUpload btn btn-primary">
						<img src="<?php echo base_url().$product->thumb ?>" alt="<?php echo $product->name ?>" width="90"/>
													    <span>Upload</span>
													    <input type="file" id="photo" class="upload" name="photo" />
													</div></td>
				</tr>
				<!-- <tr>
					<td class="table_detail"><p class="bebas">BARCODE</p></td>
					<td style="padding-right: 9%;"><canvas id="barcode" width=1 height=1 style="border:1px solid #fff"></canvas>
					<div><a id="saveas" class="btn btn-primary" href="javascript:saveCanvas('image/png','.png')" style="display: none">Save As PNG</a></div>
					</td>
				</tr> -->

				</tbody>
			</table>
		</div>
		
		<div class="row text-center">
			<input type="submit" class="btn btn-default btn-custom" value="SAVE" name="update">
		</div>	
		<?php echo form_close(); ?>
	</div>
</div>
<script>
	$(document).ready(function(){
		JsBarcode("#barcode", "<?php echo $product->code ?>");
	});
</script>


