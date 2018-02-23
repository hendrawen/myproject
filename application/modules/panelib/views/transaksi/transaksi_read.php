    <table class="table">
        <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
        <tr><td>Nama</td><td><?php echo $nama_anggota; ?></td></tr>
        <tr><td>Tgl Pinjam</td><td><?php echo $tgl_pinjam; ?></td></tr>
        <tr><td>Tgl Kembali</td><td><?php echo $tgl_kembali; ?></td></tr>
        <tr><td>Status</td><td><?php echo $status; ?></td></tr>
        <tr><td></td><td><a href="<?php echo site_url('panelib/transaksi') ?>" class="btn btn-default">Cancel</a></td></tr>
    </table>