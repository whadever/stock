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

	#filter{
		width: 25%;
		display: inline-block;
	}

</style>
<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">DRIVERS</p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
			<div class="form-group" style="margin-bottom: 20px">
				<label for="">Search :</label>
				<input type="text" class="form-control" id="filter">
				<a href="<?php echo base_url('drivers/input_driver') ?>" class="btn btn-primary pull-right">Input Driver</a>
			</div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed" data-filter="#filter" data-page-size="10" id="table_product">
				<thead>
					 <tr>
					 	<th data-type="numeric" data-sort-initial="true">No</th>
					 	<!-- <th data-hide="phone">Code</th> -->
					 	<th data-toggle="true">Name</th>
					 	<th data-hide="phone">Address</th>
					 	<th data-hide="phone">Gambar</th>
					 	<th data-hide="phone">Lokasi</th>
					 	<th data-hide="phone">Tindakan</th>
					 </tr>
				</thead>
				<tbody>
					<?php foreach($drivers as $driver): ?>
						<tr>
							<td><?php echo $driver->id ?></td>
							<!-- <td><?php echo $driver->code ?></td> -->
							<td><?php echo $driver->name ?></td>
							<td><?php echo $driver->address ?></td>
							<td><img src="<?php echo base_url().$driver->photo ?>" alt="<?php echo $driver->name ?>" width="40"/></td>
							<td><?php echo $driver->outlet_name ?></td>
							<td>
								<a href="<?php echo base_url('drivers/edit_driver/'.$driver->id) ?>">Edit</a> | 
								<a href="" data-toggle="modal" data-target="#deleteDriver" data-id="<?php echo $driver->id?>">
								  Delete
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal delete user -->
<div id="deleteDriver" class="modal fade" role="dialog">
  <div class="modal-dialog">
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Driver</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('drivers/delete'); ?>
      <p>By doing so, driver will be deleted from database. Proceed?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" value="">
        <input type="submit" name="delete" value="Confirm" class="btn btn-danger">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div><!-- Modal delete user end -->

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

<script>
	$('#deleteDriver').on('show.bs.modal', function(e) {

	    //get data-id attribute of the clicked element

	    var code = $(e.relatedTarget).data('code');

	    //populate the textbox
	    $(e.currentTarget).find('input[name="code"]').val(code);

	});
</script>

<script>
	$(document).ready(function() {
   	 $('#table_product').footable();
	} );
</script>



