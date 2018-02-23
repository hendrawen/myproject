<!-- <form action="<?php echo $action; ?>" method="post"> -->
<?php echo form_open_multipart($action);?>
	    <div class="form-group">
            <label for="gambar">Upload Gambar <?php echo form_error('gambar') ?></label>
            <?php
                    if ($button == 'Create') {
                ?>
                    <input type="file" class="form-control" name="gambar" id="gambar"/>
                <?php } elseif ($button == 'Update') {
                ?>  
                    <div class="">
                        <a href="" target="_blank"><img src="<?=base_url();?>assets/buku/<?=$gambar;?>" style="width: 200px; height: 180px; margin-bottom: 5px;" class="img-rounded" alt=""></a><br /><p><?php echo $gambar; ?></p>
                    </div>
                    <input type="file" class="form-control" name="gambar" id="gambar"/>
                <?php } ?>
            <span class="help-block">Format Foto : gif, png, jpg, jpeg, bmp. Max file size 50Mb</span>
        </div>
        <div class="form-group">
            <label for="varchar">Kode Buku <?php echo form_error('kode_buku') ?></label>
            <input type="text" class="form-control" name="kode_buku" id="kode_buku" placeholder="Kode Buku" value="<?php echo $kode_buku; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">ISBN <?php echo form_error('ISBN') ?></label>
            <input type="text" class="form-control" name="ISBN" id="ISBN" placeholder="ISBN" value="<?php echo $ISBN; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Judul <?php echo form_error('judul') ?></label>
            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Pengarang <?php echo form_error('pengarang') ?></label>
            <input type="text" class="form-control" name="pengarang" id="pengarang" placeholder="Pengarang" value="<?php echo $pengarang; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Penerbit <?php echo form_error('penerbit') ?></label>
            <input type="text" class="form-control" name="penerbit" id="penerbit" placeholder="Penerbit" value="<?php echo $penerbit; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tahun Terbit <?php echo form_error('tahun_terbit') ?></label>
            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" name="tahun_terbit" id="tahun_terbit" placeholder="Tahun Terbit" value="<?php echo $tahun_terbit; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Stok <?php echo form_error('stok') ?></label>
            <input type="number" class="form-control" name="stok" id="stok" min="0" placeholder="Stok" value="<?php echo $stok; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Rak Buku <?php echo form_error('kode_rak') ?></label>
                <select name="kode_rak" class="form-control">
                <option disabled selected>--Pilih Rak--</option>}
                     <?php 
                        $kode = $this->db->query("SELECT * FROM rak_buku");
                        foreach ($kode->result() as $key){
                     ?>
                    <option <?php echo ($kode_rak==$key->kode_rak) ? 'selected=""':""; ?> value="<?php echo $key->kode_rak; ?>"><?php echo $key->lokasi;?> - <?php echo $key->bagian;?></option>
                     <?php } ?>
                </select>
        </div>
	    <!-- <div class="form-group">
            <label for="timestamp">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Updated At <?php echo form_error('updated_at') ?></label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
        </div> -->
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
	    <input type="hidden" name="id_buku" value="<?php echo $id_buku; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('panelib/buku') ?>" class="btn btn-default">Cancel</a>
	</form>