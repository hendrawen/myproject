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
        <h6 class="panel-title">Edit Aktivasi User</h6>   </div>
        <div class="panel panel-flat">
        <div class="panel-body">
        <p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

		<?php echo form_open("users/auth/deactivate/".$user->id);?>

		  <p>
		  	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
		    <input type="radio" name="confirm" value="yes" checked="checked" />
		    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
		    <input type="radio" name="confirm" value="no" />
		  </p>

		  <?php echo form_hidden($csrf); ?>
		  <?php echo form_hidden(array('id'=>$user->id)); ?>

		  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'),'class="btn btn-primary"');?></p>

		<?php echo form_close();?>
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
