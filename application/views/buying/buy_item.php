<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom:2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px; margin-bottom: :0px; "><?php echo $subtitle ?></p>
			<p>Status User:</p>
		</div>
		
		<div class="row" style="margin-top: 20px; padding-bottom: 0px !important;">

			<?php echo form_open() ?>

			<table class="table">
				<tbody>
					<tr>
						<td>
							<p class="bebas">KODE BARANG:</p>
						</td>
						<td>
							<input type="text" class="form-control" name="item_name" required="1">
						</td>
					</tr>
				</tbody>
			</table>

			<?php echo form_close() ?>

		</div>
	</div>
</div>