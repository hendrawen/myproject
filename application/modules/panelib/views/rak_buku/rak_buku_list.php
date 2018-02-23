
<?php if ($this->session->flashdata('message')): ?> <!--Notif Berhasil Perpanjangan Buku-->
         <small>
           <script type="text/javascript">
              swal({
                   title: "Done",
                   text: "<?php echo $this->session->flashdata('message'); ?>",
                    timer: 3500,
                   showConfirmButton: true,
                   type: 'success'
               });
           </script>
         </small>
    <?php endif; ?>

<?php if ($this->session->flashdata('msg')): ?> <!--Notif Gagal Perpanjangan Buku-->
         <small>
           <script type="text/javascript">
              swal({
                   title: "Maaf",
                   text: "<?php echo $this->session->flashdata('msg'); ?>",
                   timer: 4000,
                   showConfirmButton: true,
                   type: 'error'
               });
           </script>
         </small>
    <?php endif; ?>

<div class="panel panel-default">
  <div class="panel-body">    
     <?php echo anchor(site_url('panelib/rak_buku/create'),'Create', 'class="btn btn-primary"'); ?>

    <div class="col-md-12" style="margin-bottom: 10px;">
    </div>
       <table id="data" class="table table-striped table-advance table-hover">

        <thead>
         <tr>
         <!-- <th>No</th> -->
        <th>Kode Rak Buku</th>
        <th>Lokasi</th>
        <th>Bagian</th>
        <th>Action</th>
         </tr>
        </thead>
        <tbody>
          <?php 
              /*if(empty($transaksi)){
                      $this->session->set_flashdata('msg','Data Tidak Ditemukan'); 
                } else {*/
                $no = 1;
              foreach($rak_buku as $rows){ ?>
         <tr>
            <!-- <td><?=$no++?></td> -->
            <td><?php echo $rows->kode_rak ?></td>
            <td><?php echo $rows->lokasi ?></td>
            <td><?php echo $rows->bagian ?></td>
          <td>
           <a href="<?=base_url()?>panelib/rak_buku/read/<?=$rows->kode_rak?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-search"></i></a>
           <a href="<?=base_url()?>panelib/rak_buku/update/<?=$rows->kode_rak?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
           <a class="btn btn-danger btn-sm" onclick="return swal({ 
                title: 'Yakin akan hapus data ini?',
                text: 'Anda tidak akan melihat data ini lagi!',   
                type: 'warning',
                showCancelButton: true,   
                confirmButtonColor: '#d9534f',
                   }, function(){
                      window.location.href ='<?=base_url()?>panelib/rak_buku/delete/<?=$rows->kode_rak?>';   
                                 });"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
        <? }?>
        </tbody>
       </table>
        </div> <!-- /panel-body-->
            <div class="row">
            <div class="col-md-5" style="margin-bottom: 10px;">
                <a style="margin-left: 8px;"></a>
                <?php echo anchor(site_url('panelib/rak_buku/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('panelib/rak_buku/word'), 'Word', 'class="btn btn-primary"'); ?>
           </div>
        </div>
    </div>

    <!-- <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.remove').on('click',function(){
                var getLink = $(this).attr('href');
                swal({
                        title: 'Notif',
                        text: 'Yakin Ingin Hapus?',
                        html: true,
                        confirmButtonColor: '#d9534f',
                        showCancelButton: true,
                        },function(){
                        window.location.href = getLink
                    });
                return false;
            });
        });
    </script> -->