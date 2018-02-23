<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

                  <p class="centered"><a href="<?php echo base_url('administrator')?>"><img src="<?php echo base_url('assets/img/ui-sam.jpg')?>" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $this->session->userdata('username');?></h5>

                  <li class="mt">
                      <a <?php echo ($aktif == 'Dashboard')?'class="active"':"";?> href="<?php echo base_url('administrator')?>">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a <?php echo ($aktif == 'Laporan')?'class="active"':"";?> href="javascript:;">
                          <i class="fa fa-desktop"></i>
                          <span>Laporan</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url('report/peminjaman')?>">Peminjaman</a></li>
                          <li><a  href="<?php echo base_url('report/pengembalian')?>">Pengembalian & Denda</a></li>
                          <!-- <li><a  href="<?php echo base_url('report/denda')?>">Denda</a></li> -->
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a <?php echo ($aktif == 'User')?'class="active"':"";?> href="<?php echo base_url('users')?>">
                          <i class="fa fa-desktop"></i>
                          <span>Data User</span>
                      </a>
                       <!-- <ul class="sub">
                          <li><a  href="<?php echo base_url('users')?>">User</a></li>
                          <li><a  href="">Buttons</a></li>
                          <li><a  href="">Panels</a></li>
                      </ul> -->
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
