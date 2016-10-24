<style type="text/css">
	.small{
		font-size: 20px;
	}
</style>
<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px; margin-bottom: :0px;"><?php echo $subtitle ?> </p>
			<p>Status User:</p>
		</div>

		<div class="row" style="margin-top: 20px; padding-bottom: 0px !important;">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<?php echo form_open('selling/finish_transaction') ?>
					<table class="table">
						<tbody id="transaction-table">
							<tr>
								<td>
									<p class="bebas">TRANSACTION CODE</p>
								</td>
								<td>
									<input type="text" class="form-control" name="transaction_code" value="<?php echo $transaction_code ?>" readonly="readonly">
								</td>
							</tr>
							<tr>
								<td>
									<p class="bebas">TOTAL HARGA</p>
								</td>
								<td>
									<input type="text" name="total_harga" class="form-control" value="<?php echo $total_harga; ?>" readonly="readonly">
								</td>
							</tr>
							<tr>
								<td>
									<p class="bebas">CUSTOMER</p>
								</td>
								<td><select class="form-control" id="customer_name" name="customer_name">';
									<option value="others" id="others">Others</option>';
									<?php foreach ($customers as $customer):?>
										<option value="<?php echo $customer->id ?>"><?php echo $customer->name ?></option>
									<?php endforeach; ?>
									
									</select>
								</td>
							</tr>
							<tr id="customer-row">
								<td colspan="2" style="padding-left: 40px;padding-right: 20px;">
								<table width="100%">
									<tr>
										<td><p class="bebas small">Nama Customer</p></td>
										<td><input type="text" class="form-control" name="new_customer_name" placeholder="Name" required=1 ></td>
									</tr>
									<tr>
										<td><p class="bebas small">E-Mail</p></td>
										<td><input type="text" class="form-control" name="new_customer_email" placeholder="Email" required=1></td></td>
									</tr>
									<tr>
										<td><p class="bebas small">Telp.</p></td>
										<td><input type="text" class="form-control" name="new_customer_phone" placeholder="Phone" required=1></td>
									</tr>
									<tr>
										<td><p class="bebas small">Alamat</p></td>
										<td><input type="text" class="form-control" name="new_customer_address" placeholder="Address" required=1></td>
									</tr>
								</table>
								</td>
							</tr>
							
							<?php for($i = 0; $i< count($product_id); $i++): ?>
								
									<input type="hidden" name="product_id[]" value="<?php echo $product_id[$i] ?>"></td>
									<input type="hidden" name="disc_price[]" value="<?php echo $disc_price[$i] ?>"></td>
			
							<?php endfor; ?>
								
							
						</tbody>
						<tfoot>
							<tr>
								<td class="text-center" colspan="2"><input type="submit" name="save" class="btn btn-primary" value="Save"></td>
							</tr>	
						</tfoot>		
					</table>
					
				<?php echo form_close() ?>

			</div>
			<div class="col-md-2"></div>
				
			</div>
	</div>
</div>
<script>
	$('#customer_name').change(function(){
		if($(this).val()=='others'){
			$('#transaction-table').append('<tr id="customer-row"><td colspan="2" style="padding-left: 40px;padding-right: 20px;"><table width="100%">			<tr><td><p class="bebas small">Nama Customer</p></td><td><input type="text" class="form-control" name="new_customer_name" placeholder="Name" required=1 ></td></tr><tr><td><p class="bebas small">E-Mail</p></td><td><input type="text" class="form-control" name="new_customer_email" placeholder="Email" required=1></td></td></tr><tr><td><p class="bebas small">Telp.</p></td><td><input type="text" class="form-control" name="new_customer_phone" placeholder="Phone" required=1></td></tr><tr><td><p class="bebas small">Alamat</p></td><td><input type="text" class="form-control" name="new_customer_address" placeholder="Address" required=1></td></tr></table></td></tr>")');
		}
		else{
			$('#customer-row').remove();
		}
		
	});
</script>

