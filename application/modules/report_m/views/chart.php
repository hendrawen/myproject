<?php
$this->load->view('panelIMS/template/header');
$this->load->view('panelIMS/template/navbar');
?>
    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <?php
            $this->load->view('panelIMS/template/sidebar');
        ?>

        <!-- Main content -->
        <div class="content-wrapper">
        <!-- Content area -->
        <div class="content">
      <div class="panel panel-flat">
          <div class="panel-heading">
              <h5 class="panel-title">Daftar 10 Produk Populer <?php echo$this->session->userdata('username');?></h5>
                          <div class="heading-elements">
                              <ul class="icons-list">
                                  <li><a data-action="collapse"></a></li>
                                  <li><a data-action="reload"></a></li>
                              </ul>
                          </div>
                      </div>
                <div class="table-responsive">
                <table class="table table-togglable table-hover">
                     <thead>
                         <tr>
                             <th data-toggle="true">Nama Produk</th>
                             <th data-hide="phone">Order</th>
                         </tr>
                     </thead>
                     <tbody>
                   <?php
                       if (empty($record)) {

                       $this->session->set_flashdata('msg', 'Tidak Ada Record!!!');

                       } else {
                       foreach ($record as $key) {

                   ?>
                   <tr>
                   <td><?php echo $key->produk; ?></td>
                   <td><?php echo $key->qty;  ?></td>
                                 </tr>
                                 <?php
                                         }}
                                 ?>
                             </tbody>
                         </table>
                       </div>
                     </div>
                         <div class="row">
                             <div class="col-md-6">

                 		<?php echo anchor(site_url('report/excel'), 'Export ke Excel', 'class="btn btn-success"'); ?>
                 	    </div>

                         </div>


<?php
    $this->load->view('panelIMS/template/footer');
?>
