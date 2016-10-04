<style type="text/css">
	.input-label{
		padding-right: 12px;
	}
	.table-bordered thead th,.table-bordered tbody td{
		border:1px solid #24082f !important;
		color: #fff;
	}
	thead{
		background-color: #2c3e50;
	}
	.btn-danger{
		border-radius: 10px;
		color: #fff !important;
	}
	.btn-success{
		border-radius: 10px;
		color: #fff !important;
	}
</style>
<div class="row">
	<div class="col-md-12 content-wrap">
		<div class="row">
			<p class="page_subtitle" style="font-size: 28px;margin-bottom: 0px;">SCAN ITEM</p>
			<p>Status User:</p>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="row">
				<table>
					<tr>
						<td class="input-label">Tanggal</td>
						<td><input type="text" name="date" placeholder="Tanggal" class="form-control"></td>
					</tr>
				</table>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<table>
						<tr>
							<td class="input-label">Waktu</td>
							<td><input type="text" name="time" placeholder="Waktu" class="form-control" disabled="true"></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<table>
						<tr>
							<td class="input-label">Jumlah Terima</td>
							<td><input type="text" name="total_amount" placeholder="Jumlah Terima" class="form-control"></td>
						</tr>
					</table>				
				</div>
			</div>
		</div>

		<div class="row" style="margin-top: 15px;">
			<div class="col-md-6">
				<div class="row">
					<table>
						<tr>
							<td class="input-label"><p class="btn btn-primary">Upload Surat Kerja</p></td>
							<td><input type="text" name="username" placeholder="loading bar" class="form-control" aria-describedby="username-addon"></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row"></div>
			</div>
		</div>

		<div class="row" style="margin-top: 15px;">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Nomor</th>
						<th>Nama Barang</th>
						<th>Tanggal dan Waktu Scan</th>
						<th>Kondisi Barang</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a class="btn btn-success" href="">Sempurna</a>
							<a class="btn btn-danger" href="">Rusak</a>
						</td>
					</tr>
				</tbody>
			</table>	
		</div>
	</div>
</div>




<script>
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>

