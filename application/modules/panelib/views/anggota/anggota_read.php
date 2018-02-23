<table class="table">
		<tr><td>Foto</td><td><img src="<?php echo base_url();?>assets/anggota/<?php echo $foto; ?>" width="250" height="250"></td></tr>
		<tr><td>Format Foto</td><td><?php echo $foto; ?></td></tr>
	    <tr><td>Kode Anggota</td><td><?php echo $kode_anggota; ?></td></tr>
	    <tr><td>NISP</td><td><?php echo $NISP; ?></td></tr>
	    <tr><td>Id Kelas</td><td><?php echo $id_kelas; ?></td></tr>
	    <tr><td>Nama Anggota</td><td><?php echo $nama_anggota; ?></td></tr>
	    <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
	    <tr><td>Tempat Lahir</td><td><?php echo $tempat_lahir; ?></td></tr>
	    <tr><td>Tgl Lahir</td><td><?php echo $tgl_lahir; ?></td></tr>
	    <tr><td>Telepon</td><td><?php echo $telepon; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('panelib/anggota') ?>" class="btn btn-danger">Kembali</a></td></tr>
	</table>