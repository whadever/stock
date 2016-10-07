
<script src="<?php echo base_url() ?>js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/canvas-toblob.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/filesaver.js"></script>

<style>
	#filter{
		width: 25%;
		display: inline-block;
	}

</style>

<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">ALL OUTLETS</p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
			<div class="form-group" style="margin-bottom: 20px">
				<label for="">Search :</label>
				<input type="text" class="form-control" id="filter">
				<a href="<?php echo base_url('outlets/add_outlet') ?>" class="btn btn-primary pull-right">Add Outlet</a>
			</div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed" data-filter="#filter" data-page-size="10" id="table_product">
				<thead>
					 <tr>
					 	
					 	<th data-hide="phone">Kode Outlet</th>
					 	<th data-toggle="true">Nama Outlet</th>
					 	<th data-hide="phone">Alamat</th>					 	
					 	<th data-hide="phone">PIC Outlet</th>
					 	<th data-hide="phone">Tindakan</th>
					 </tr>
				</thead>
				<tbody>
					<?php foreach($outlets as $outlet): ?>
						<tr>
							
							<td><?php echo $outlet->id ?></td>
							<td><?php echo $outlet->username ?></td>
							<td><?php echo $outlet->address ?></td>
							<td><?php echo $outlet->pic ?></td>
							<td><a href="<?php echo base_url('outlets/edit_outlet').'/'.$outlet->id?>">edit</a> | <a data-toggle="modal" data-target="#delete" style="cursor: pointer" data-id="<?php echo $outlet->id?>">delete</a></td>
						</tr>
					<?php  endforeach; ?>
				</tbody>
			</table>
		</div>
		
		
	
	</div>
</div>
<div class="modal fade" id="delete" style="border-radius:0px; ">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #2c3e50;color: #fff; ">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				Delete Product
			</div>
			<?php echo form_open('outlets/delete_outlet')?>
			<div class="modal-body">Delete this data?</div>
			<div class="modal-footer" style="padding: 6px; border-radius: 0px;">
				<input type="hidden" name="delete_id" value="">
		        <input type="submit" name="delete" value="Confirm" class="btn btn-danger">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
			<?php echo form_close()?>
		</div>
	</div>
</div>
<script>
	$('#delete').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element

    var id = $(e.relatedTarget).data('id');


    //populate the textbox
    $(e.currentTarget).find('input[name="delete_id"]').val(id);

	});
</script>
<script>
	$(document).ready(function() {
   	 $('#table_product').footable();
	} );
</script>


