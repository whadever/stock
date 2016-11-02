
<script src="<?php echo base_url() ?>js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/canvas-toblob.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/filesaver.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() ?>fancybox/source/jquery.fancybox.pack.js"></script>

<style>
	#filter{
		width: 25%;
		display: inline-block;
	}

</style>
<?php $role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role'); ?>


<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">ALL CUSTOMERS</p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
			<div class="form-group" style="margin-bottom: 20px">
				<label for="">Search :</label>
				<input type="text" class="form-control" id="filter">
				<?php if($role != 'admin'): ?>
					<a href="<?php echo base_url('customers/add_customer') ?>" class="btn btn-primary pull-right">Add Customer</a>
				<?php endif; ?>
			</div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-condensed" data-filter="#filter" data-page-size="10" id="table_product">
				<thead>
					 <tr>
					 	<th data-type="numeric" data-sort-initial="true">No</th>
					 	
					 	<th data-toggle="true">Nama</th>
					 	<th data-type="numeric" data-hide="phone">No.Telp</th>
					 	<th data-hide="phone">E-mail</th>
					 	<th data-type="numeric" data-hide="phone">Alamat</th>
					 	<th data-hide="phone">Outlet</th>
					 	<th data-hide="phone">Tindakan</th>
						
					 </tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($customers as $customer): ?>
						<tr>
							<td><?php echo $i ?></td>
						
							<td><?php echo $customer->name ?></td>
							<td><?php echo $customer->phone ?></td>
							<td><?php echo $customer->email ?></td>
							<td><?php echo $customer->address ?></td>
							<td><?php echo $customer->outlet_name ?></td>
						 	<td><a href="<?php echo base_url('customers/edit_customer').'/'.$customer->id?>">Edit</a> | <a onclick="delete_cust(<?php echo $customer->id ?>)">Delete</a></td>
							
						</tr>
					<?php $i++; endforeach; ?>
				</tbody>
				<tfoot class="hide-if-no-paging">
					<td colspan="9">
						<div class="pagination"></div>
					</td>
					
				</tfoot>
			</table>
		</div>
		
		
	
	</div>
</div>
<!-- <div class="modal fade" id="delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				Delete Product
			</div>
			<?php //echo form_open('products/delete_product')?>
			<div class="modal-body">Delete this data?</div>
			<div class="modal-footer">
				<
			</div>
			<?php //echo form_close()?>
		</div>
	</div>
</div> -->

<script>
	$(document).ready(function() {
   	 $('#table_product').footable();
   	 $(".fancybox").fancybox();
   	 <?php if($this->session->flashdata('success')): ?>
   	 <?php echo $this->session->flashdata('success') ?>
   	 <?php endif; ?>
	} );

	function delete_cust(id){
		alertify.confirm("Message", function (e) {
	    if (e) {
	        location.replace("<?php echo base_url() ?>" + "customers/delete_customer/" + id);
	    } else {
	        // user clicked "cancel"
	    }
	});
	}
</script>



