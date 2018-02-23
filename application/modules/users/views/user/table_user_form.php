<?php echo $this->load->view('administrator/template/header'); ?>


  <section id="container" >
      <!--header start-->
            <?php echo $this->load->view('administrator/template/navbar'); ?>
      <!--header end-->

      <!--sidebar start-->
            <?php echo $this->load->view('administrator/template/sidebar'); ?>
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
                  <h3><i class="fa fa-angle-right"></i> <?php echo $judul_menu;?> <i class="fa fa-angle-right"></i> <?php echo $sub_judul;?></h3>
                  <br>

                <div class="panel panel-info">
        <div class="panel-heading">
        <h6 class="panel-title">Tambah User Baru</h6>   </div>
        <div class="panel panel-flat">
        <div class="panel-body">
        <?php echo form_open("users/auth/create_user");?>
         <div class="form-group">
            <label for="varchar">First name <?php echo form_error('first_name') ?></label>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" required="required"  />
        </div>
         <div class="form-group">
            <label for="varchar">Last Name <?php echo form_error('last_name') ?></label>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" required="required"  />
        </div>

        <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="required"  />
        </div>

         <div class="form-group">
            <label for="varchar">identity <?php echo form_error('identity') ?></label>
            <input type="text" class="form-control" name="identity" id="identity" placeholder="identity" required="required"  />
        </div>
        <div class="form-group">
            <label for="varchar">Company <?php echo form_error('company') ?></label>
            <input type="text" class="form-control" name="company" id="company" placeholder="company" required="required" />
        </div>

        <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="email" required="required"  />
        </div>
        <div class="form-group">
            <label for="varchar">Phone <?php echo form_error('phone') ?></label>
            <input type="number" class="form-control" name="phone" id="phone" min="1" maxlength="12" placeholder="phone"  required="required" />
        </div>
        <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password"  required="required" />
        </div>
         <div class="form-group">
            <label for="varchar">Password Confirm <?php echo form_error('password_confirm') ?></label>
            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="password_confirm"  required="required" />
        </div>
         <div class="text-right">
            <input type="hidden" name="id" id="id" />
                <!-- Id gambar kita hidden pada input field dimana berfungsi sebagai identitas yang dibawa untuk update -->
         <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
         <a href="<?php echo site_url('users') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
              <button type="submit" value="upload" class="btn btn-success"><i class="icon-floppy-disk"></i> Tambah</button>
        </div>

    <?php echo form_close(); ?>
</div>
</div>
</div>
</div>

            </section>
        </section>
      <!--main content end-->

      <!--footer start-->
            <?php echo $this->load->view('administrator/template/footer'); ?>
      <!--footer end-->
