<?php
    $tgl_pinjam = date("Y-m-d");
    $tujuh_hari = mktime(0,0,0, date("n"), date("j")+7, date("Y"));
    $tgl_kembali = date("Y-m-d", $tujuh_hari);
?>

<?php if ($this->session->flashdata('message')): ?>
<div class="alert bg-primary alert-right">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
    <span class="text-semibold"><?php echo $this->session->flashdata('message');?></span>
</div>
<?php endif; ?>
<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Judul <?php echo form_error('id_buku') ?></label>
            <!-- <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" /> -->
            <select name="id_buku" id="id_buku" class="form-control">
                <option disabled selected>--Pilih Judul--</option>
                    <?php
                        foreach ($buku as $key) {
                    ?>
                <option value="<?php echo $key->id_buku;?>"><?php echo $key->judul;?></option>
                    <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('kode_anggota') ?></label>
            <!-- <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" /> -->
            <select name="kode_anggota" id="kode_anggota" class="form-control">
                <option disabled selected>--Nama--</option>
                    <?php
                        foreach ($anggota as $key) {
                    ?>
                <option value="<?php echo $key->kode_anggota;?>"><?php echo $key->NISP;?> - <?php echo $key->nama_anggota;?></option>
                    <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Tgl Pinjam <?php echo form_error('tgl_pinjam') ?></label>
            <input type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam" placeholder="Tgl Pinjam" value="<?php echo $tgl_pinjam; ?>" readonly/>
        </div>
        <div class="form-group">
            <label for="date">Tgl Kembali <?php echo form_error('tgl_kembali') ?></label>
            <input type="date" class="form-control" name="tgl_kembali" id="tgl_kembali" placeholder="Tgl Kembali" value="<?php echo $tgl_kembali; ?>" readonly/>
        </div>
        <!-- <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div> -->
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('panelib/transaksi') ?>" class="btn btn-default">Cancel</a>
    </form>
