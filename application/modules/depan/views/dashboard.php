<?php echo $this->load->view('template/header'); ?>

 
  <section id="container" >
      <!--header start-->
            <?php echo $this->load->view('template/navbar'); ?>
      <!--header end-->
      
      <!--sidebar start-->
            <?php echo $this->load->view('template/sidebar'); ?>
      <!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
                  <h3><i class="fa fa-angle-right"></i> <?php echo $judul_menu; ?> <i class="fa fa-angle-right"></i> <?php echo $sub_judul; ?></h3>
                  <br>
            <div class="row-mt">
                
                    <?php echo $this->load->view($content); ?>
                
            </div>
      <!--main content end-->

      <!--footer start-->
            <?php echo $this->load->view('template/footer'); ?>
      <!--footer end-->

        
