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
	
</style>
<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">INPUT PRODUCT</p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
			<table class="table product-table">
				<tbody>
				<tr>
					<td class="table_detail"><p class="bebas">NAMA BARANG</p></td>
					<td style="padding-right: 9%;"><input type="text" name="item_name" placeholder="Nama Barang" class="form-control"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">HARGA BARANG</p></td>
					<td style="padding-right: 9%;"><input type="text" name="item_price" placeholder="Harga Barang" class="form-control"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">KATEGORI BARANG</p></td>
					<td style="padding-right: 9%;"><input type="text" name="item_category" placeholder="Kategori Barang" class="form-control"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">KODE BARANG</p></td>
					<td style="padding-right: 9%;"><input type="text" id="item_code" onblur="generate_barcode()" name="item_code" placeholder="Kode Barang" class="form-control" required="1"></td>
					
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">UPLOAD FOTO BARANG</p></td>
					<td style="padding-right: 9%;"><a class="btn btn-primary">Upload</a></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">BARCODE</p></td>
					<td style="padding-right: 9%;"><canvas id="barcode" width=1 height=1 style="border:1px solid #fff"></canvas>
					<div><a id="saveas" class="btn btn-primary" href="javascript:saveCanvas('image/png','.png')" style="display: none">Save As PNG</a></div>
					</td>
				</tr>

				</tbody>
			</table>
		</div>
		
		<div class="row text-center">
			<a class="btn btn-default btn-custom">Save</a>
		</div>	
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
</script>


