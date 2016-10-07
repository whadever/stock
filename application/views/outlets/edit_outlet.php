<style type="text/css">
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
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">EDIT OUTLET</p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
			<?php echo form_open_multipart('outlets/edit_outlet/'.$outlet->id)?>
			<table class="table product-table">
				<tbody>
				<tr>
					<td class="table_detail"><p class="bebas">NAMA OUTLET</p></td>
					<td style="padding-right: 9%;"><input type="text" name="outlet_name" placeholder="Nama Outlet" class="form-control" value="<?php echo $outlet->username?>"></td>
				</tr>
				<!-- <tr>
					<td class="table_detail"><p class="bebas">HARGA OUTLET</p></td>
					<td style="padding-right: 9%;"><input type="text" name="outlet_price" placeholder="Harga Outlet" class="form-control"></td>
				</tr> -->
				<!-- <tr>
					<td class="table_detail"><p class="bebas">KATEGORI OUTLET</p></td>
					<td style="padding-right: 9%;"><input type="text" name="outlet_category" placeholder="Kategori Outlet" class="form-control"></td>
				</tr> -->
				<tr>
					<td class="table_detail"><p class="bebas">ALAMAT OUTLET</p></td>
					<td style="padding-right: 9%;"><input type="text" name="outlet_address" placeholder="Alamat Outlet" class="form-control" value="<?php echo $outlet->address?>"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">PIC OUTLET</p></td>
					<td style="padding-right: 9%;"><input type="text" name="outlet_pic" placeholder="Penanggungjawab Outlet" class="form-control" value="<?php echo $outlet->pic?>"></td>
				</tr>
				<tr>
					<td class="table_detail"><p class="bebas">UPLOAD FOTO BARANG</p></td>
					<td style="padding-right: 9%;"><div class="fileUpload btn btn-primary">
						<img src="<?php echo base_url().$outlet->photo ?>" alt="<?php echo $outlet->username ?>" width="60"/>
					    <span>Upload</span>
					    <input type="file" id="photo" class="upload" name="photo" />
					</div></td>
				</tr>
				
				<!-- <tr>
					<td class="table_detail"><p class="bebas">UPLOAD FOTO OUTLET</p></td>
					<td style="padding-right: 9%;"><a class="btn btn-primary">Upload</a></td>
				</tr> -->

				</tbody>
			</table>

		</div>
		<div class="row text-center">
			<input type="submit" name="edit" value="Save" class="btn btn-default btn-custom">
		</div>	
		<?php echo form_close()?>
	</div>
</div>
