<?=content_open($title)?>
<a href="<?=site_url($url.'/form/tambah')?>" class="btn btn-success" ><i class="fa fa-plus"></i> Tambah</a>
<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
	<i class="fa fa-upload"></i> Import CSV
</button> -->
<hr>
<?=$this->session->flashdata('info')?>


<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pengguna</th>
			<th>Password</th>
			<th>Level</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			foreach ($datatable->result() as $row) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->nm_user?></td>
						<td><?=$row->pwd?></td>
						<td><?=$row->level?></td>					
						<td>
							<a href="<?=site_url($url.'/form/ubah/'.$row->id_pengguna)?>" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
							<a href="<?=site_url($url.'/hapus/'.$row->id_pengguna)?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
						</td>
					</tr>
				<?php
				$no++;
			}

		?>
	</tbody>
</table>
<?=content_close()?>

