<table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		      <th>Kode Rak</th>
		      <th>Lokasi</th>
              <th>Bagian</th>
            </tr><?php
            foreach ($rak_buku_data as $rak_buku)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $rak_buku->kode_rak ?></td>	
              <td><?php echo $rak_buku->lokasi ?></td>
              <td><?php echo $rak_buku->bagian ?></td>
                </tr>
                <?php
            }
            ?>
        </table>