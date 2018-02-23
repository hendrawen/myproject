<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="<?php echo base_url('panelib')?>"><img src="<?php echo base_url('assets/img/ui-sam.jpg')?>" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $this->session->userdata('username');?></h5>
                    
                  <li class="mt">
                      <a <?php echo ($aktif == 'Dashboard')?'class="active"':"";?> href="<?php echo base_url('panelib')?>">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a <?php echo ($aktif == 'Laporan')?'class="active"':"";?> href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Laporan</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url('report_m/peminjaman')?>">Peminjaman</a></li>
                          <li><a  href="<?php echo base_url('report_m/pengembalian')?>">Pengembalian & Denda</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Master</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url('panelib/rak_buku')?>">Rak Buku</a></li>
                          <li><a  href="<?php echo base_url('panelib/buku')?>">Buku</a></li>
                          <li><a  href="<?php echo base_url('panelib/kelas')?>">Kelas</a></li>
                          <li><a  href="<?php echo base_url('panelib/anggota')?>">Anggota</a></li>
                          <li><a  href="<?php echo base_url('panelib/denda')?>">Denda</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a <?php echo ($aktif == 'Transaksi')?'class="active"':"";?> href="<?php echo base_url('panelib/transaksi')?>">
                          <i class="fa fa-cogs"></i>
                          <span>Transaksi</span>
                      </a>
                      <!-- <ul class="sub">
                          <li><a  href="">Peminjaman</a></li>
                          <li><a  href="">Pengembalian</a></li>
                      </ul> -->
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>