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
	@media only screen and (max-device-width: 767px){
		#detailrow{
			border-left: none !important;
		}
	}
	

</style>
<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;"><?php echo $subtitle?></p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;padding-bottom: 0px!important;">
		<?php echo form_open('selling/sell_product') ?>
			<table class="table product-table" style="margin-bottom: 0px;">
				<tbody>
				<tr>
					<td class="table_detail"><p class="bebas">KODE BARANG</p></td>
					<td style="padding-right: 9%;"><input type="text" title="Kode Barang tidak boleh mengandung spasi dan panjang maksimal 20 karakter" id="item_code" name="item_code" onblur="get_barcode()" placeholder="Kode Barang" class="form-control" required="1"></td>
				</tr>
				<tr id="found">
					<td colspan="2" id="found-row"></td>
				</tr>
				</tbody>
			</table>

				<!-- <tr>
					<td id="detail">		
					</td>
					<td id="bon">
					</td>
				</tr>
				
				
				</tbody>
			</table> -->
		</div>		
		<!-- <div class="row">
			<div class="col-md-6">
				<div class="row"  style="margin-left: -23px!important;"></div>
			</div>
			<div class="col-md-6">
				<div class="row"  style="padding-left: 10px;">
					
				</div>
			</div>
		</div> -->	
		<?php echo form_close(); ?>
	</div>
</div>
<div class="row content-wrap" style="margin-top: 10px;margin-bottom:10px;padding: 0px 5px 0px 5px;">
	<div class="col-md-6" style="border-right:8px solid #e8ecf0;margin-bottom: 0px;padding-bottom: 10px;min-height: 220px" id="detailrow">
		<div class="row text-center">
			<P class="bebas" style="margin-top: 10px">DETAIL PRODUK</P>
		</div>
		<div class="row text-center no-item" style="margin-top: 20PX;">
			<P class="bebas" style="color:red">BELUM ADA BARANG</P>
		</div>
		<div class="row" id="detail"></div>
	</div>
	<div class="col-md-6" style="margin-bottom: 0px;" id="buyrow">
		<div class="row text-center">
			<P class="bebas" style="margin-top: 10px"> PRODUK YANG DIBELI</P>
		</div>
		<table class="table table-striped" >
			<thead><tr>
				<th width="22%">Nama Barang</th>
				<th width="12%">Qty.</th>
				<th>Harga</th>
				<th width="18%">Disc.</th>
				<th>Total</th>
				<th></th>
			</tr></thead>
			<?php $i=1;?>
			<tbody id="item_list"><tr class="no-item">
				<td colspan="6" class="text-center"><P class="bebas" style="color:red">BELUM ADA BARANG</P></td>
			</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4"><strong>Total Price</strong></td>
					<td colspan="2" id="total_price">$ &nbsp; 0</td>
				</tr>
				<tr>
					<td colspan="6" class="text-center"><input type="submit" name="save" class="btn btn-primary" value="Save"></td>
				</tr>	
			</tfoot>			
		</table>
	</div>
</div>

<script>

	$(document).ready(function(){

		$('#item_code').focus();

	});
	var total_price=0;
	function list_item(){
		var disc = $('')
		var barcode = $('#item_code').val();
		if(barcode==''){

		}
		else{
			$.ajax({
				url:"<?php echo base_url('selling/list_item')?>"+'/'+ barcode,
				type:"GET",
				success : function(result){
						var test = JSON.parse(result);
						var price = test.selling_price;
						total_price = +total_price + +price;
						$('#item_list').append("<tr><td>"+test.name+"</td><td>1</td><td id='harga_"+test.code+"'>Rp "+test.selling_price+"</td><td> <div class='input-group'><input type='number' class='form-control' onblur='disc("+"\""+test.code+"\""+",this)' name='disc'><span class='input-group-addon'>%</span></div></td><td id='harga_disc_"+test.code+"'>$ "+total_price+"</td><td><a onclick='"+test.code+"' style='cursor: pointer'>&times;</a></td></tr>");
						$('#total_price').empty();
						$('#total_price').append('$&nbsp;'+total_price);

				}
			})
		}
		
	}

	function disc(code,el){
		var harga = $('#harga_'+code).html();
		harga = harga.replace(/[^0-9.]/g, "");
		var disc = $(el).val();		
		disc = harga * disc / 100;
		harga -= disc;
		harga = harga.toFixed(2);
		
		 $('#harga_disc_'+code).empty();
		 $('#harga_disc_'+code).append("$. "+harga);

		
	}

	function get_barcode(){
		list_item();
		var barcode = $('#item_code').val();
		if (barcode == '') {	
			
			
		}else{
			
			$('#found').remove();
			$('#detail').empty();
			$.ajax({
				url:"<?php echo base_url('selling/get_barcode')?>" +'/'+ barcode,
				type: "GET",
				success : function(result){

					$('#detail').append(result);
					$('#customer_name').change(function(){
						if($(this).val()=='others'){
							$('#customer').append('<table><tbody><tr><td><input type="text" class="form-control" name="new_customer_name" placeholder="Name" required=1 ></td></tr><tr><td><input type="text" class="form-control" name="new_customer_email" placeholder="Email" required=1></td></tr><tr><td><input type="text" class="form-control" name="new_customer_phone" placeholder="Phone" required=1></td></tr><tr><td><input type="text" class="form-control" name="new_customer_address" placeholder="Address" required=1></td></tr></tbody></table>');	
						}
						
					});

					$('#item_code').val('');
					$('#item_code').focus();

				}
			});

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
	$("#item_code").keypress(function(event){
	    if (event.which == '10' || event.which == '13') {
	        event.preventDefault();
	        $('#item_code').blur();
	    }
	});
</script>

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

