<?php
$id="";
$nm_user="";
$pwd="";
$level="";

if($parameter=='ubah' && $id!=''){
    $this->db->where('id_pengguna',$id);
    $row=$this->Model->get()->row_array();
    extract($row);
}
?>


<?=content_open('Form Destinasi')?>
    <form method="post" action="<?=site_url($url.'/simpan')?>" enctype="multipart/form-data">
    	<?=input_hidden('id_pengguna',$id)?>
        <?=input_hidden('parameter',$parameter)?>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
    		<label>Nama User</label>
    		<div class="row">
	    		<div class="col-md-12">
    				<?=input_text('nm_user',$nm_user)?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>Password</label>
    		<div class="row">
	    		<div class="col-md-8">
	    			<?=input_text('pwd',$pwd)?>
		    	</div>
	    	</div>
    	</div>
    	<div class="form-group">
    		<label>Level</label>
    		<div class="row">
	    		<div class="col-md-8">
				<select class="form-control" name="level">
					<option value="Admin" <?= ($level == 'Admin') ? 'selected' : '' ?>>Administrator</option>
					<option value="User" <?= ($level == 'Admin') ? 'selected' : '' ?>>User</option>
            	</select>
		    	</div>
	    	</div>
    	</div>
		<div class="form-group">
		<button type="submit" name="simpan" value="true" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
		<a href="<?=site_url($url)?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Kembali</a>
		</div>
	  </div>
    </div>
</form>
<?=content_close()?>