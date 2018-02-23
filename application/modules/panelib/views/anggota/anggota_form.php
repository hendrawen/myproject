<?php if ($this->session->flashdata('message')): ?>
<div class="alert bg-danger alert-right">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
    <span class="text-semibold"><?php echo $this->session->flashdata('message');?></span>
</div>
<?php endif; ?>
<!-- <form action="<?php echo $action; ?>" method="post"> -->
    <!-- <?php echo form_open($action);?> -->
    <?php echo form_open_multipart($action);?>
        <div class="form-group">
            <label for="bigint">NISP <?php echo form_error('NISP') ?></label>
                <?php
                    if ($button == 'Create') {
                ?>
                    <input type="text" class="form-control" name="NISP" id="NISP" placeholder="NISP" />
                <?php } elseif ($button == 'Update') {
                ?>
                    <input type="text" class="form-control" name="NISP" id="NISP" placeholder="NISP" value="<?php echo $NISP; ?>" readonly />
                <?php } ?>
        </div>
        <div class="form-group">
            <label for="int">Nama Anggota <?php echo form_error('nama_anggota') ?></label>
            <input type="text" class="form-control" name="nama_anggota" id="nama_anggota" placeholder="Nama Anggota" value="<?php echo $nama_anggota; ?>" />
        </div>
        <div class="form-group">
            <label for="gambar">Upload Foto <?php echo form_error('foto') ?></label>
            <?php
                    if ($button == 'Create') {
                ?>
                    <input type="file" class="form-control" name="foto" id="foto" required />
                <?php } elseif ($button == 'Update') {
                ?>  
                    <div class="">
                        <a href="" target="_blank"><img src="<?=base_url();?>assets/anggota/<?=$foto;?>" style="width: 200px; height: 180px; margin-bottom: 5px;" class="img-rounded" alt=""></a><br /><p><?php echo $foto; ?></p>
                    </div>
                    <input type="file" class="form-control" name="foto" id="foto"/>
                <?php } ?>
            <span class="help-block">Format Foto : gif, png, jpg, jpeg, bmp. Max file size 50Mb</span>
        </div>
        <div class="form-group">
            <label for="varchar">Kelas <?php echo form_error('id_kelas') ?></label>
             <select name="id_kelas" id="id_kelas" class="form-control">
                <option disabled selected>--Pilih Kelas--</option>
                    <?php
                        $query = $this->db->query("SELECT * FROM kelas");
                         foreach ($query->result() as $rows) {
                    ?>
                    <option <?php echo ($id_kelas==$rows->id_kelas) ? 'selected=""':""; ?> value="<?php echo $rows->id_kelas; ?>"><?php echo $rows->kelas; ?> - <?php echo $rows->jurusan; ?></option>
                <?php } ?>
             </select>
        </div>
        <div class="form-group">
            <label class="enum">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?> </label>
            <br />
            <div class="col-sm-4">
            <label class="radio-inline">
                <input type="radio" name="jenis_kelamin" class="styled" <?php if($jenis_kelamin == 'L'){ echo 'checked';} ?> value="L"> Laki-laki
            </label>
            <label class="radio-inline">
                <input type="radio" name="jenis_kelamin" class="styled" <?php if($jenis_kelamin == 'P'){ echo 'checked';} ?> value="P"> Perempuan
            </label>
            </div>
        </div><br>
        <div class="form-group">
            <label for="varchar">Tempat Lahir <?php echo form_error('tempat_lahir') ?></label>
            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" />
        </div>
        <div class="form-group">
            <label for="date">Tgl Lahir <?php echo form_error('tgl_lahir') ?></label>
            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" name="tgl_lahir" id="tgl_lahir" value="<?php echo $tgl_lahir; ?>" />
        </div>
        <div class="form-group">
            <label for="char">Telepon <?php echo form_error('telepon') ?></label>
            <input type="number" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="<?php echo $telepon; ?>" min="1" />
        </div>
        <div class="form-group">
            <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
        </div>
        <input type="hidden" name="kode_anggota" value="<?php echo $kode_anggota; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('panelib/anggota') ?>" class="btn btn-default">Cancel</a>
    </form>
    <!-- <?php echo form_close();?> -->
