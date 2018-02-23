
              <div class="col-lg-9">

            <div class="showback">
							<div class="alert alert-success"><h4><strong>Selamat Datang!</strong> <?php echo $sambutan; ?></h4></div><br>
              <h5><b>Silakan masukkan data kunjungan Anda, sebelum masuk ke perpustakaan. Terima kasih ...</b></h5><br>
 <?php
      if ($this->session->flashdata('msg')): ?>
         <small>
           <script type="text/javascript">
              swal({
                   title: "Done",
                   text: "<?php echo $this->session->flashdata('msg'); ?>",
                    timer: 3500,
                   showConfirmButton: true,
                   type: 'success'
               });
           </script>
         </small>
    <?php endif; ?>

    <form action="<?php echo base_url();?>depan/insert" method="POST">
      <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required />
        </div>
      <div class="form-group">
            <label for="enum">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
              <option disabled selected>--Pilih--</option>
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
        </div>
      <div class="form-group">
            <label for="enum">Jenis <?php echo form_error('jenis') ?></label>
            <select name="jenis" id="jenis" class="form-control" required>
              <option disabled selected>--Pilih--</option>
              <option value="Siswa">Siswa</option>
              <option value="Guru">Guru</option>
              <option value="Staff">Staff</option>
            </select>
        </div>
      <div class="form-group">
        <label for="varchar">Keperluan <?php echo form_error('perlu') ?></label><br />
        <div class="col-sm-4">
            <label class="radio-inline">
                <input type="checkbox" name="perlu[]" id="perlu" class="styled" value="Baca Buku"> Baca Buku
            </label>
        </div>
        <div class="col-sm-4">
            <label class="radio-inline">
                <input type="checkbox" name="perlu[]" id="perlu" class="styled" value="Pinjam Buku"> Pinjam Buku
            </label>
        </div>
        <div class="col-sm-4">
            <label class="radio-inline">
                <input type="checkbox" name="perlu[]" id="perlu" class="styled" value="Kembalikan Buku"> Kembalikan Buku
            </label>
        </div>
        <div class="col-sm-4">
            <label class="radio-inline">
                <input type="checkbox" name="perlu[]" id="perlu" class="styled" value="Baca Koran"> Baca Koran
            </label>
        </div>
        <div class="col-sm-4">
            <label class="radio-inline">
                <input type="checkbox" name="perlu[]" id="perlu" class="styled" value="Lainnya"> Lainnya
            </label>
        </div>
      </div><br /><br />
      <div class="form-group">
            <label for="saran">Kritik & Saran <?php echo form_error('saran') ?></label>
            <textarea class="form-control" rows="3" name="saran" id="saran" placeholder="Kritik & Saran" required></textarea>
        </div>
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
      <button type="submit" class="btn btn-primary">Simpan</button> 
  </form>

      			</div><!-- /showback -->
      		  
      		</div>

          <?php 
          $q_terakhir = $this->db->query("SELECT COUNT(id) AS terakhir FROM pengunjung WHERE LEFT(tgl, 10) = DATE(NOW())")->row();
          $q_hari_ini = $this->db->query("SELECT COUNT(id) AS terakhir FROM pengunjung WHERE LEFT(tgl, 10) = DATE(NOW())")->row();
          $q_bulan_ini = $this->db->query("SELECT COUNT(id) AS terakhir FROM pengunjung WHERE MID(tgl, 6, 2) = MONTH(NOW())")->row();
        ?>

      		<div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
						<h3>NOTIFIKASI</h3>
                                        
                      <!-- First Action -->
                      <div class="desc">
                      	
                      		<center style="margin-top: 5px">Anda pengunjung ke :</center>
                          <center style="font-size: 35px; margin-top: 20px; font-weight: bold"><?=($q_terakhir->terakhir + 1)?></center>
                          <center style="margin-top: 20px">Total Hari Ini : <?=$q_hari_ini->terakhir?></center>
                          <center style="margin-top: 0px; margin-bottom: 10px">Total Bulan Ini : <?=$q_bulan_ini->terakhir?></center>
                      	
                      </div>
                      <!-- Second Action -->
                      
                      <!-- Fourth Action -->
                     

                       <!-- USERS ONLINE SECTION -->
						<h3>KALENDER</h3>
                       <!-- CALENDAR-->
                        <div class="desc">
                              <?php
                              $month= date ("m");
                              $year=date("Y");
                              $day=date("d");
                              $endDate=date("t",mktime(0,0,0,$month,$day,$year));
                              echo '<font face="arial" size="3">';
                              echo '<table align="center" border="0" cellpadding=5 cellspacing=5 style=""><tr><td align=center>';
                              echo "Today : ".date("F, d Y ",mktime(0,0,0,$month,$day,$year));
                              echo '</td></tr></table>';
                              echo '<table align="center" border="0" cellpadding=20 cellspacing=20>
                              <tr>
                              <td>Mon</td>
                              <td>Sun</td>
                              <td>Tue</td>
                              <td>Wed</td>
                              <td>Thu</td>
                              <td>Fri</td>
                              <td>Sat</td>
                              </tr>';
                              $s=date ("w", mktime (0,0,0,$month,1,$year));
                              for ($ds=1;$ds<=$s;$ds++) {
                              echo "<td style=\"font-family:arial;color:#B3D9FF\" align=center valign=middle bgcolor=\"#FFFFFF\">
                              </td>";}
                              for ($d=1;$d<=$endDate;$d++) {
                              if (date("w",mktime (0,0,0,$month,$d,$year)) == 0) { echo "<tr>"; }
                              $fontColor="#000000";
                              if (date("D",mktime (0,0,0,$month,$d,$year)) == "Sun") { $fontColor="red"; }
                              echo "<td style=\"font-family:arial;color:#333333\" align=center valign=middle> <span style=\"color:$fontColor\">$d</span></td>";
                              if (date("w",mktime (0,0,0,$month,$d,$year)) == 6) { echo "</tr>"; }}
                              echo '</table>'; 
                              ?>
                        </div>
                      
                  </div><!-- /col-lg-3 -->


                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
          </section>
      </section>