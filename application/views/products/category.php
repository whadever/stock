
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
	.input-label{
		padding-right: 12px;
	}
	.table-bordered thead th,.table-bordered tbody td{
		border:1px solid #24082f !important;
		
	}
	thead{
		background-color: #2c3e50;
		color: #fff;
	}
</style>
<?php $role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role'); ?>

<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row" style="border-bottom: 2px solid #2c3e50">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">ALL CATEGORIES</p>
			<p>Status User:</p>
		</div>
		<div class="row" style="margin-top: 20px;">
			<div class="col-md-12">
			<div class="row">
			<div class="form-group" style="margin-bottom: 20px">
				<?php if($role != 'admin'): ?>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategory">
					  Add Category
					</button>
				<?php endif; ?>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Kategori</th>
						<th>Jumlah Barang</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach($categories as $category) : ?>
						<?php foreach ($category as $row): ?>

							<div class="row">
								<tr>
									<td><?php echo $row->name ?></td>
									<?php if ($row->quantity > 0): ?>
										<td><?php echo $row->quantity ?></td>
									<?php else: ?>
										<td>0</td>
									<?php endif ?>
									
								</tr>
								
							</div>
						<?php endforeach; ?>
						
					<?php endforeach; ?>
				</tbody>
				
			</table>
				
			</div>
		</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Category</h4>
      </div>
      <div class="modal-body">
      	<?php echo form_open('products/add_category') ?>
        <div class="form-group">
        	<label for="">Category Name:</label>
        	<input type="text" class="form-control" name="category_name" required="required">
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="save" class="btn btn-primary" value="Save">
      </div>
      	<?php echo form_close() ?>
    </div>
  </div>
</div>