<table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>NISP</th>
		<th>Id Kelas</th>
		<th>Nama Anggota</th>
		<th>Jenis Kelamin</th>
		<th>Tempat Lahir</th>
		<th>Tgl Lahir</th>
		<th>Telepon</th>
		<th>Alamat</th>
		
            </tr><?php
            foreach ($anggota_data as $anggota)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $anggota->NISP ?></td>
		      <td><?php echo $anggota->id_kelas ?></td>
		      <td><?php echo $anggota->nama_anggota ?></td>
		      <td><?php echo $anggota->jenis_kelamin ?></td>
		      <td><?php echo $anggota->tempat_lahir ?></td>
		      <td><?php echo $anggota->tgl_lahir ?></td>
		      <td><?php echo $anggota->telepon ?></td>
		      <td><?php echo $anggota->alamat ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>