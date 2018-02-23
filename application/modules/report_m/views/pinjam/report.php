<?php echo $this->load->view('panelib/template/header'); ?>

  <section id="container" >
      <!--header start-->
            <?php echo $this->load->view('panelib/template/navbar'); ?>
      <!--header end-->
            
      <!--sidebar start-->
            <?php echo $this->load->view('panelib/template/sidebar'); ?>
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
                  <h3><i class="fa fa-angle-right"></i> <?php echo $judul_menu;?> <i class="fa fa-angle-right"></i> <?php echo $sub_judul;?></h3>
                  <br>

        <div class="panel panel-default">
          <div class="panel-heading" align="center">
            <h5 class="panel-title"><i class="icon-calendar52 position-left"></i> Laporan Peminjaman Buku <!-- <?php echo $this->session->userdata('company'); ?> --></h5>
          </div>
        </div>
        
        <!-- /default alerts -->
                    <div class="row">
                        <div class="col-lg-6">
                       <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Peminjaman Periode</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                              </ul>
                          </div>
                                </div>

                     <div class="panel-body">
                        <?php echo form_open("report_m/peminjaman/periode"); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <div class="date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                     <input class="form-control datepicker"  data-date-format="yyyy-mm-dd" type="text" name="date_from" placeholder="Dari Tanggal" required>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <div class="date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                     <input class="form-control datepicker"  data-date-format="yyyy-mm-dd" type="text" name="date_to" placeholder="Hingga Tanggal" required>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                          <div class="form-group has-feedback">
                            
                              <button type="submit" name="proses" value="proses" class="btn btn-danger"><i class="glyphicon glyphicon-check"></i> Proses </button> <button type="submit" name="cetak" value="cetak" class="btn btn-danger"><i class="glyphicon glyphicon-print"></i> Print</button>
                            
                          </div>
                        </div>
                          </form>
                          </div>
                       </div>
                        </div>

            <div class="col-lg-6">
                       <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Peminjaman Bulanan</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                  <li><a data-action="collapse"></a></li>
                                  <li><a data-action="reload"></a></li>
                                  <li><a data-action="close"></a></li>
                              </ul>
                          </div>
                                </div>
                <div class="panel-body">
                  <?php echo form_open("report_m/peminjaman/bulanan"); ?>
                <div class="row">
                 <div class="col-md-6">
                    <div class="form-group">
                    <!-- <input type="text" class="form-control" placeholder="Bulan"> -->
                     <select class="form-control select2" data-width="100%" name="bulan" id="bulan" required>
                        <option disabled selected>--Bulan--</option>
                        <option value="1">Januari</option>
                        <option value="2">Pebruari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                </div>

                <div class="col-md-6">
                   <div class="form-group">
                    <select name="tahun" class="form-control" required>
                      <option disabled selected>--Tahun--</option>
                      <?php
                        for($i=date('Y'); $i>=date('Y')-32; $i-=1){
                            echo"<option value='$i'> $i </option>";
                         }
                      ?>
                      </select>
                   </div>
                </div>
                </div>
              <div class="text-right">
                <div class="form-group has-feedback">
                    <button type="submit" name="proses" value="proses" class="btn btn-danger"><i class="glyphicon glyphicon-check"></i> Proses </button> 
                    <button type="submit" name="cetak" value="cetak" class="btn btn-danger" target="_blank"><i class="glyphicon glyphicon-print"></i> Print</button>
                </div>
              </div>
              </form>
                      </div>
                     </div>
                        </div>
                    </div>

                <div class="message">
                  <?php
                $date1 = tgl_indo($this->input->post('date_from'));
                $date2 = tgl_indo($this->input->post('date_to'));
                $date3 = getBulan($this->input->post('bulan'));
                $date4 = $this->input->post('tahun');
                  if (isset($result_display)) {
                  echo "";
                  if ($result_display == 'No record found !') {
                  echo $result_display;
                  } else {
                  echo "<div class='panel panel-default'  id='printTable'>
                                    <div class='panel-heading'>
                                        <h5 class='panel-title'>Data Peminjaman Buku $date1 - $date2 $date3 $date4</h5>
                                    </div>
                  <div class='table-responsive'>
                                    <table class='table table-togglable table-hover'>";
                  echo "<thead>
                                        <tr>
                                            <th data-toggle='true'>Kode Anggota</th>
                                            <th data-hide='phone'>Nama Anggota</th>
                                            <th data-toggle='true'>Kode Buku</th>
                                            <th data-toggle='true'>Judul Buku</th>
                                            <th data-hide='phone'>Tanggal Pinjam</th>
                                            <th data-hide='phone'>Tanggal Kembali</th>
                                            <th data-hide='phone'>Status</th>
                                        </tr>
                                    </thead>";
                  foreach ($result_display as $value) {
                  echo '<tbody>
                        <tr>' . '<td>' . $value->kode_anggota . '</td>' 
                              . '<td>' . $value->nama_anggota . '</td>'
                              . '<td>' . $value->kode_buku . '</td>' 
                              . '<td>' . $value->judul . '</td>'  
                              . '<td>' . $value->tgl_pinjam . '</td>' 
                              . '<td>' . $value->tgl_kembali . '</td>' 
                              . '<td>' . $value->status . '</td>' . 
                        '<tr/>
                        </tbody>';
                                    
                  }

                  echo '</table></div>';
                  echo "</div>

                                    ";
                  }
                  }
                  ?>

         </div>

            <script>
            function printData()
            {
               var divToPrint=document.getElementById("printTable");
               newWin= window.open("");
               newWin.document.write(divToPrint.outerHTML);
               newWin.print();
               newWin.close();
            }

            </script>
      </section>
        </section>
      <!--main content end-->



      <!--footer start-->
            <?php echo $this->load->view('panelib/template/footer'); ?>
      <!--footer end-->
