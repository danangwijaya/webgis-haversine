<?php
$id="";
$nama="";
$lokasi="";
$keterangan="";
$lat="";
$lng="";

if($parameter=='ubah' && $id!=''){
    $this->db->where('id',$id);
    $row=$this->Model->get()->row_array();
    extract($row);
}
?>


<?=content_open('Form Destinasi')?>
    <form method="post" action="<?=site_url($url.'/simpan')?>" enctype="multipart/form-data">
    	<?=input_hidden('id',$id)?>
        <?=input_hidden('parameter',$parameter)?>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
    		<label>Nama Destinasi</label>
    		<div class="row">
	    		<div class="col-md-12">
    				<?=input_text('nama',$nama)?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>Lokasi</label>
    		<div class="row">
	    		<div class="col-md-8">
	    			<?=input_text('lokasi',$lokasi)?>
		    	</div>
	    	</div>
    	</div>
    	<div class="form-group">
    		<label>Keterangan</label>
    		<div class="row">
	    		<div class="col-md-8">
				<select class="form-control" name="keterangan">
					<option value="Wisata" <?= ($keterangan == 'Wisata') ? 'selected' : '' ?>>Wisata</option>
					<option value="Hotel" <?= ($keterangan == 'Hotel') ? 'selected' : '' ?>>Hotel</option>
            	</select>
		    	</div>
	    	</div>
    	</div>
    	<div class="form-group">
    		<label>Titik Koordinat</label> 
    		<div class="row">
	    		<div class="col-md-6">
                    <label>Latitude</label>
	    			<?=input_text('lat',$lat)?>
	    		</div>
	    		<div class="col-md-6">
                    <label>Longitude</label>
	    			<?=input_text('lng',$lng)?>
	    		</div>
    		</div>
    	</div>
		<div class="form-group">
    		<label for="gambar">Gambar</label>
    		<input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
		</div>
		<div class="form-group">
		<button type="submit" name="simpan" value="true" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
		<a href="<?=site_url($url)?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Kembali</a>
		</div>
	  </div>
    </div>
</form>
<?=content_close()?>