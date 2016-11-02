<style type="text/css">
	.table>tbody>tr>td{
		border:none !important;
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
<?php echo form_open('mutasi/receive') ?>
		<div class="row content-wrap" style="margin-top: 20px;">
			<div class="col-md-12">
				<div class="row">

				<p class="bebas">Kode Transaksi</p></td>

				<input type="text" name="transaction_code" id="transaction_code" placeholder="Kode Transaksi" class="form-control" required="1" onblur="get_transaction_detail()">
					
				<div class="row" id="transaction_detail" style="margin-top: 20px; background-color: ">
					
				</div>

				<p class="bebas" style="margin-top: 20px;">Kode Barang</p>
				<input type="text" name="item_code" disabled="disabled" id="item_code" placeholder="Kode Barang" class="form-control" onblur="get_barcode()">

				</div>
				<div class="row">
					
					<div class="col-md-6" id="detailrow">
						<div class="row text-center">
							<P class="bebas" style="margin-top: 10px">DETAIL PRODUK</P>
						</div>
						<div class="row text-center no-item" style="margin-top: 20PX;">
							<P class="bebas" style="color:red">BELUM ADA BARANG</P>
						</div>
						<div class="row" id="detail"></div>
					</div> 

					<div class="col-md-6" id="buyrow">
						<div class="row text-center">
							<P class="bebas" style="margin-top: 10px">PRODUK YANG DITERIMA</P>
						</div>
						
						<div class="table-responsive toggle-circle-filled">
						<table class="table table-condensed table-mutation" data-filter="#filter" data-page-size="10" >

							<thead><tr>
								<th data-sort-initial="true" data-toggle="true">Nama</th>
								<th data-type="numeric">Qty.</th>
								<th data-hide="phone"></th>
							</tr></thead>
							<?php $i=1;?>
							<tbody id="item_list">
								<tr class="no-item">
								
					 			</tr>
							</tbody>
						</table>
						<p>
						
						<!-- <a href="" data-toggle="modal" data-target="#product_info" data-firstname="<?php echo $order->firstname?>" data-lastname="<?php echo $order->lastname ?>" data-email="<?php echo $order->email?>" data-telephone="<?php echo $order->telephone?>" ><?php echo $order->firstname . ' ' . $order->lastname?></a> -->
						
						</p>
						
						
						</div>
											
					</div>

				</div>
				<div class="row">
					<div class="col-sm-6" style="padding: 20px 0">
						<textarea name="notes" id="" placeholder="Notes" class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="row text-center">
					<input type="submit" name="accept" class="btn btn-default btn-custom" id="continue" value="ACCEPT" disabled="disabled" style="display: none">
				</div>
					
			</div>
		</div>
<?php echo form_close() ?>
<script>
	// jQuery(function(){
 //    	var counter = 1;
 //    	jQuery('a.product-add').click(function(event){
	//         event.preventDefault();

	//         var newRow = jQuery('<tr><td style="padding-left: 0px;"><select required="1" class="form-control" id="" name="product_distribute[]"><option>--Pilih Barang--</option></select></td><td style="padding-right: 0px;"><input name="product_quantity[]" placeholder="Jumlah Barang" class="form-control" required="1"/></td></tr>');
	//         jQuery('table#product_table').append(newRow);

 //    	});
	// });


	$(document).ready(function(){
		$('.table-mutation').footable();
	});

	function remove_item(code){
        
        var result = confirm('Hapus barang?');
        if(result){
            $.ajax({
              url: "<?php echo base_url('mutasi/remove')?>" + '/' + code,
              type: 'GET',

              success: function(result){
 				if (result == 'empty') {
 					$('#continue').attr('disabled','disabled');
					$('#continue').hide();
 				}
              	$('#row_'+code).remove();
                
              } 
            });
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
				url:"<?php echo base_url('mutasi/get_detail')?>" +'/'+ barcode,
				type: "GET",
				success : function(result){
					$('#detail').append(result);
					// $('#item_code').val('');
					$('#item_code').focus();

				}
			});

		}
	}

	function get_transaction_detail(){
		var transaction_code = $('#transaction_code').val();
		if (transaction_code == '') {	
			
		}else{
			$('#found').remove();
			$('#transaction_detail').empty();
			$.ajax({
				url:"<?php echo base_url('mutasi/get_transaction_detail')?>" +'/'+ transaction_code,
				type: "GET",
				success : function(result){
					$('#transaction_detail').append(result);
					$('#item_code').removeAttr('disabled');

				}
			});

		}
	}

	function list_item(){
		
		var barcode = $('#item_code').val();
		if(barcode==''){

		}
		else{
			$.ajax({
				url:"<?php echo base_url('mutasi/list_item_receive')?>"+'/'+ barcode,
				type:"GET",
				success : function(result){

					if(result == 'added'){

					}else{

						var test = JSON.parse(result);
						var price = test.selling_price;
						$('#continue').removeAttr('disabled');
						$('#continue').show();
						
						$('#item_list').append("<tr id='row_"+test.code+"' ><td>"+test.name+"</td><td>1</td><td><a onclick='remove_item(\""+test.code+"\")' style='cursor: pointer'>&times;</a></td></tr><input type='hidden' name='id[]' value='"+test.code+"'>");

						// $('#total_price').empty();
						// $('#total_price').append('$&nbsp;'+total_price);
						// $('#total_harga').val(total_price);

					}
						


				}
			})
		}
		
	}

	$("#item_code").keypress(function(event){
	    if (event.which == '10' || event.which == '13') {
	        event.preventDefault();
	        $('#item_code').blur();
	    }
	});
	$('#select-driver').change(function(){
		if($(this).val()=='others'){
			$('#select-driver-row').append('<div id="new-driver"><p class="bebas" style="margin-top: 15px;">Data Driver Baru</p><input type="text" name="driver_name" placeholder="Nama Driver" class="form-control" required="1"><input type="text" name="driver_phone" placeholder="No.Telp Driver" class="form-control" required="1" style="margin-top: 5px;"><div class="fileUpload btn btn-primary" style="margin-top: 5px;"><span>Upload Foto Driver</span><input type="file" id="photo" class="upload" name="photo" /></div></div>');
			
		}
		else{
			$('#new-driver').remove();
			
		}
		

	});
</script>