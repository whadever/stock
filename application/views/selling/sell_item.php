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
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;"><?php echo $subtitle?></p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
		<?php echo form_open('selling/sell_product', array('onsubmit' => 'return(p)')) ?>
			<table class="table product-table">
				<tbody>
				<tr>
					<td class="table_detail"><p class="bebas">KODE BARANG</p></td>
					<td style="padding-right: 9%;"><input type="text" title="Kode Barang tidak boleh mengandung spasi dan panjang maksimal 20 karakter" id="item_code"  id="item_code" name="item_code" onkeyup="get_barcode()" placeholder="Kode Barang" class="form-control" required="1"></td>
				</tr>
				<tr>
					<td colspan="2" id="felita">
						
					</td>
				</tr>
				
				
				</tbody>
			</table>
		</div>		
		<div class="row text-center">
			
		</div>	
		<?php echo form_close(); ?>
	</div>
</div>

<script>

	function get_barcode(){
		var barcode = $('#item_code').val();
		if (barcode == '') {	
			$('#felita').empty();
			alert('Kode Barang Harus diisi');
		}else{
			$.ajax({
				url:"<?php echo base_url('selling/get_barcode')?>" +'/'+ barcode,
				type: "GET",
				success : function(result){
					$('#felita').empty();
					$('#felita').append(result);
				}
			})
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
<script language="javascript">var p = false;</script>

<script>
	jQuery(function(){
    	var counter = 1;
    	jQuery('a.spec-add').click(function(event){
	        event.preventDefault();

	        // var newRow = jQuery('<tr><td><div class="input-group"><input type="number" name="diamond_amount[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" placeholder="Jumlah Diamond"><span class="input-group-addon">rd</span></div></td><td><div class="input-group"><input type="number" name="diamond_carat[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" placeholder="Ct."><span class="input-group-addon">ct.</span></div></tr>');
	        var newRow = jQuery('<tr><td style="padding-top: 0px;"><input type="text" name="spec[]" class="form-control" placeholder="Keterangan Spesifikasi"></td></tr>');
	        jQuery('table.spec-table').append(newRow);

    	});
	});
</script>

