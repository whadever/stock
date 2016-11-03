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
		padding-left: 1px;
		padding-right: 1px;
	}
	#buyrow{
		min-height: 400px;
	}
	@media only screen and (max-device-width: 767px){
		#buyrow{
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
		
	</div>
</div>
<?php echo form_open('selling/sell_product') ?>
<div class="row content-wrap" style="margin-top: 10px;margin-bottom:10px;padding: 0px 5px 0px 5px;">
	<div class="col-md-6" style="margin-bottom: 0px;padding-bottom: 10px;" id="detailrow">
		<div class="row text-center">
			<P class="bebas" style="margin-top: 10px">DETAIL PRODUK</P>
		</div>
		<div class="row text-center no-item" style="margin-top: 20PX;">
			<P class="bebas" style="color:red">BELUM ADA BARANG</P>
		</div>
		<div class="row" id="detail"></div>
	</div>
	<div class="col-md-6" style="border-left:8px solid #e8ecf0;margin-bottom: 0px;" id="buyrow">
		<div class="row text-center">
			<P class="bebas" style="margin-top: 10px">PRODUK TERJUAL</P>
		</div>
		<div class="row" style="margin-bottom: 15px;">
			<div class="col-sm-5"><label>Kode Transaksi</label><input type="text" name="transaction_code" class="form-control" placeholder="Kode Transaksi" required="1"></div>
		</div>
	
		
		<div class="table-responsive toggle-circle-filled">
		<table class="table table-condensed table-sell" data-filter="#filter" id="sell" data-page-size="10" >

			<thead><tr>
				<th width="22%" data-sort-initial="true">Nama</th>
				<th width="12%" data-type="numeric">Qty.</th>
				<th data-type="numeric">Harga</th>
				<th width="18%"  data-type="numeric">Disc.</th>
				<th data-type="numeric">Total</th>
				<th></th>
			</tr></thead>
			<?php $i=1;?>
			<tbody id="item_list"><tr class="no-item">
				
	 			</tr>
			</tbody>
		</table>
		<p>

		
		<strong class="pull-right" id="total_price">$ 0</strong>	
		<strong class="pull-right" style="margin-right: 20px">Total Price</strong>
		</p>
		<input type="hidden" name="total_harga" id="total_harga" value="">
		
		</div>
		<div class="row">
			<input type="submit" name="next" class="btn btn-primary pull-right" value="Next" id="next" disabled="true" style="margin-right: 13px;margin-top: 15px; font-size: 17px;">
		</div>	
	</div>
	<?php echo form_close(); ?>
</div>

<script>

	$(document).ready(function(){
		<?php if ($code != ''): ?>
			window.open("<?php echo base_url() ?>" + 'selling/print_receipt' + '/' + "<?php echo $code ?>");
		<?php endif; ?>

		$('#item_code').focus();
		$('.table-sell').footable();
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
					if(result == 'added'){

					}else{
						var test = JSON.parse(result);
						var price = test.selling_price;
						total_price = +total_price + +price;
						total_price = total_price.toFixed(2);
						$('#item_list').append("<tr id='row_"+test.code+"' ><td>"+test.name+"</td><td>1</td><td id='harga_"+test.code+"'>Rp "+test.selling_price+"</td><td> <div class='input-group'><input type='number' class='form-control' onblur='get_discount("+"\""+test.code+"\""+",this)' max=100 min=0 name='disc'><span class='input-group-addon'>%</span></div></td><td id='harga_disc_"+test.code+"'>$ "+test.selling_price+"</td><td><a onclick='remove_item(\""+test.code+"\")' style='cursor: pointer'>&times;</a></td><input type='hidden' name='id[]' value='"+test.code+"'><input type='hidden' name='disc_price[]' id='disc_price_"+test.code+"' value='"+test.selling_price+"'></tr> ");
						$('#total_price').empty();
						$('#total_price').append('$&nbsp;'+total_price);
						$('#total_harga').val(total_price);
						$('.table-sell').footable();
						
						if(total_price != 0){
							$('#next').removeAttr("disabled");
							
						}
						
					}
						


				}
			})
		}
		
	}

	function get_discount(code,el){
		if($(el).val() >= 0 && $(el).val() <= 100){
			var harga = $('#harga_'+code).html();
			var disc_price = $('#harga_disc_'+code).html();
			harga = harga.replace(/[^0-9.]/g, "");
			disc_price = disc_price.replace(/[^0-9.]/g, "");
			var disc = $(el).val();	
			total_price = +total_price - +disc_price;
			disc = harga * disc / 100;
			harga -= disc;
			harga = harga.toFixed(2);
			total_price += +harga;
			total_price = Number(total_price).toFixed(2);

			$('#disc_price_'+code).val(harga);
			$('#harga_disc_'+code).empty();
			$('#harga_disc_'+code).append("$ "+harga);
			$('#total_price').empty();
			$('#total_price').append("$ "+total_price);
			$('#total_harga').val(total_price);
			
		}else{
			var harga = $('#harga_'+code).html();
			harga = harga.replace(/[^0-9.]/g, "");
			var disc_price = $('#harga_disc_'+code).html();
			disc_price = disc_price.replace(/[^0-9.]/g, "");
			total_price = +total_price - +disc_price;
			total_price += +harga;
			total_price = Number(total_price).toFixed(2);
			
			$('#disc_price_'+code).val(harga);
			$('#harga_disc_'+code).empty();
			$('#harga_disc_'+code).append("$ "+harga);
			$('#total_price').empty();
			$('#total_price').append("$ "+total_price);

			$('#total_harga').val(total_price);
			
		}
		
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
					
					$('#belum_ada').remove();
					$('#item_code').val('');
					$('#item_code').focus();

				}
			});

		}
	}

	function remove_item(code){
        
        var result = confirm('Hapus barang?');
        if(result){
            $.ajax({
              url: "<?php echo base_url('selling/remove')?>" + '/' + code,
              type: 'GET',

              success: function(result){
              	var harga = $('#harga_'+code).html();
				harga = harga.replace(/[^0-9.]/g, "");
				var disc_price = $('#harga_disc_'+code).html();
				disc_price = disc_price.replace(/[^0-9.]/g, "");
				total_price = +total_price - +disc_price;
				
				total_price = Number(total_price).toFixed(2);
				
				$('#total_price').empty();
				$('#total_price').append("$ "+total_price);

				$('#total_harga').val(total_price);
              	$('#row_'+code).remove();
                
                
                if(total_price == 0){
                	$('#next').attr("disabled", true);
                }

                
                
              } 
            });
        }
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

