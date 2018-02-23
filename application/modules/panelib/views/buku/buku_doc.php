<table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode Buku</th>
		<th>ISBN</th>
		<th>Judul</th>
		<th>Pengarang</th>
		<th>Penerbit</th>
		<th>Tahun Terbit</th>
		<th>Stok</th>
		<th>Created At</th>
		<th>Updated At</th>
		
            </tr><?php
            foreach ($buku_data as $buku)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $buku->kode_buku ?></td>
		      <td><?php echo $buku->ISBN ?></td>
		      <td><?php echo $buku->judul ?></td>
		      <td><?php echo $buku->pengarang ?></td>
		      <td><?php echo $buku->penerbit ?></td>
		      <td><?php echo $buku->tahun_terbit ?></td>
		      <td><?php echo $buku->stok ?></td>
		      <td><?php echo $buku->created_at ?></td>
		      <td><?php echo $buku->updated_at ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>