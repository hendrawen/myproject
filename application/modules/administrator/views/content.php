              <div class="row">
                  <div class="col-lg-12 main-chart">
                    <div class="col-md-12 col-md-offset-0">
                    <div class="row mtbox">
                      <div class="col-md-3 col-sm-4 box0">
                          <div class="box1">
                            <?php
                               $jml = $this->db->query("SELECT * FROM buku")->num_rows();
                            ?>
                              <span class="li_news"></span>
                              <h5>Buku</h5>
                              <h3><?php echo $jml; ?></h3>
                          </div>
                      </div>
                      <div class="col-md-3 col-sm-4 box0">
                          <div class="box1">
                            <?php
                                $jml = $this->db->query("SELECT * FROM anggota")->num_rows();
                            ?>
                              <span class="li_cloud"></span>
                              <h5>Anggota</h5>
                              <h3><?php echo $jml; ?></h3>
                          </div>
                      </div>
                      <div class="col-md-3 col-sm-4 box0">
                          <div class="box1">
                            <?php
                                $pinjam = $this->db->query("SELECT * FROM transaksi WHERE status= 'pinjam'")->num_rows();
                              ?>
                              <span class="li_data"></span>
                              <h5>Peminjam</h5>
                              <h3><?php echo $pinjam; ?></h3>
                          </div>
                      </div>
                      <div class="col-md-3 col-sm-4 box0">
                          <div class="box1">
                            <?php
                                $kelas = $this->db->query("SELECT * FROM transaksi WHERE status= 'kembali'")->num_rows();
                              ?>
                              <span class="li_stack"></span>
                              <h5>Pengembalian</h5>
                              <h3><?php echo $kelas; ?></h3>
                          </div>
                      </div>
                    </div><!-- /row mt -->
                  </div>
                    <div class="row mt">
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                          <h3>VISITS</h3>
                      </div>
                      <div class="custom-bar-chart">
                          <ul class="y-axis">
                              <li><span>10.000</span></li>
                              <li><span>8.000</span></li>
                              <li><span>6.000</span></li>
                              <li><span>4.000</span></li>
                              <li><span>2.000</span></li>
                              <li><span>0</span></li>
                          </ul>
                          <div class="bar">
                              <div class="title">JAN</div>
                              <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">FEB</div>
                              <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">MAR</div>
                              <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">APR</div>
                              <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>
                          </div>
                          <div class="bar">
                              <div class="title">MAY</div>
                              <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">JUN</div>
                              <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>
                          </div>
                          <div class="bar">
                              <div class="title">JUL</div>
                              <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>
                          </div>
                      </div>
                      <!--custom chart end-->
                    </div><!-- /row -->

                  </div><!-- /col-lg-9 END SECTION MIDDLE -->


      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->


              </div><! --/row -->
          </section>
      </section>
