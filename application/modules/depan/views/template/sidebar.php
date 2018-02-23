<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="profile.html"><img src="<?php echo base_url('assets/img/ui-sam.jpg')?>" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $this->session->userdata('username');?></h5>
                    
                  <li class="mt">
                      <a <?php echo ($aktif == 'Dashboard')?'class="active"':"";?> href="<?php echo base_url('depan')?>">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a <?php echo ($aktif == 'Cari')?'class="active"':"";?> href="<?php echo base_url('depan/cari_buku')?>">
                          <i class="fa fa-cogs"></i>
                          <span>Cari Buku</span>
                      </a>
                      <!-- <ul class="sub">
                          <li><a  href="">Peminjaman</a></li>
                          <li><a  href="">Pengembalian</a></li>
                      </ul> -->
                  </li>

                  <li class="sub-menu">
                      <a href="<?php echo base_url('login')?>" >
                          <i class="fa fa-book"></i>
                          <span>Login Admin</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>