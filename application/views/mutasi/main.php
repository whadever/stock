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
	.btn-default:hover,.btn-default:focus{
		background-color: #e8ecf0;
		border-color: #e8ecf0;
	}
	
</style>

<div class="row">
	<div class="col-md-12 content-wrap">

		<div class="row">
			<div class="col-xs-6 text-center">
				<a href="#" class="btn btn-default btn-lg">
					<div class="row">
						<div class="col-sm-6"><img class="img-responsive" src="<?php echo base_url('assets/receive.png')?>" style="max-height: 150px;"></div>
						<div class="col-sm-6"><p class="bebas" style="font-size: 50px;margin-top: 35%">TERIMA</p></div>
					</div>
				</a>
			</div>
			<div class="col-xs-6 text-center">
				<a href="<?php echo base_url('mutasi/send')?>" class="btn btn-default btn-lg">
					<div class="row">
						<div class="col-sm-6"><img class="img-responsive" src="<?php echo base_url('assets/send.png')?>" ></div>
						<div class="col-sm-6"><p class="bebas" style="font-size: 50px;margin-top: 35%">KIRIM</p></div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
		
