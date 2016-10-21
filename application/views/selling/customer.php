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
						<tbody>
							<tr>
								<td>
									<p class="bebas">TRANSACTION CODE:</p>
								</td>
								<td>
									<input type="text" class="form-control" name="transaction_code" value="<?php echo $transaction_code ?>" readonly="readonly">
								</td>
							</tr>
							<tr>
								<td>
									<p class="bebas">TOTAL HARGA:</p>
								</td>
								<td>
									<input type="text" name="total_harga" class="form-control" value="<?php echo $total_harga; ?>" readonly="readonly">
								</td>
							</tr>
							<tr>
								<td>
									<p class="bebas">CUSTOMER:</p>
								</td>
								<td id="customer"><select class="form-control" id="customer_id" name="customer_id">';
									<?php foreach ($customers as $customer):?>
										<option value="<?php echo $customer->id ?>"><?php echo $customer->name ?></option>
									<?php endforeach; ?>
									<option value="others" id="others">Others</option>';
									</select>
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


