<table class="table">
		<tr><td>Gambar Buku</td><td><img src="<?php echo base_url();?>assets/buku/<?php echo $gambar; ?>" width="400" height="400"></td></tr>
		<tr><td>Nama Buku</td><td><?php echo $gambar; ?></td></tr>
	    <tr><td>Kode Buku</td><td><?php echo $kode_buku; ?></td></tr>
	    <tr><td>ISBN</td><td><?php echo $ISBN; ?></td></tr>
	    <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
	    <tr><td>Pengarang</td><td><?php echo $pengarang; ?></td></tr>
	    <tr><td>Penerbit</td><td><?php echo $penerbit; ?></td></tr>
	    <tr><td>Tahun Terbit</td><td><?php echo $tahun_terbit; ?></td></tr>
	    <tr><td>Stok</td><td><?php echo $stok; ?></td></tr>
	    <tr><td>Kode Rak</td><td><?php echo $kode_rak; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td>Updated At</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('panelib/buku') ?>" class="btn btn-danger">Kembali</a></td></tr>
	   </table>