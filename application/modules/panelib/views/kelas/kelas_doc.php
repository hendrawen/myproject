<table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kelas</th>
		<th>Jurusan</th>
		<!-- <th>Keberapa</th> -->
		
            </tr><?php
            foreach ($kelas_data as $kelas)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kelas->kelas ?></td>
		      <td><?php echo $kelas->jurusan ?></td>
		      <!-- <td><?php echo $kelas->keberapa ?></td> -->	
                </tr>
                <?php
            }
            ?>
        </table>