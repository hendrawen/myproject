<!-- record tidak ada!! -->
<?php if ($this->session->flashdata('pesan')): ?>
         <small>
           <script type="text/javascript">
              swal({
                   title: "Oops!!!",
                   text: "<?php echo $this->session->flashdata('pesan'); ?>",
                    timer: 3500,
                   showConfirmButton: true,
                   type: 'error'
               });
           </script>
         </small>
<?php endif; ?>

<!-- status buku mash dipinjam!! -->
<?php if ($this->session->flashdata('msg')): ?>
         <small>
           <script type="text/javascript">
              swal({
                   title: "Maaf!!!",
                   text: "<?php echo $this->session->flashdata('msg'); ?>",
                    timer: 3500,
                   showConfirmButton: true,
                   type: 'error'
               });
           </script>
         </small>
<?php endif; ?>

<!-- sukess!! -->
<?php if ($this->session->flashdata('message')): ?>
         <small>
           <script type="text/javascript">
              swal({
                   title: "Mantap",
                   text: "<?php echo $this->session->flashdata('message'); ?>",
                    timer: 3500,
                   showConfirmButton: true,
                   type: 'success'
               });
           </script>
         </small>
    <?php endif; ?>

<div class="panel panel-default">
  <div class="panel-body">
     <?php echo anchor(site_url('panelib/buku/create'),'Create', 'class="btn btn-primary"'); ?>
     
    <div class="col-md-12" style="margin-top: 10px;">
     </div>
       <table id="data" class="table table-striped table-advance table-hover">

        <thead>
         <tr>
         <!-- <th>No</th> -->
         <th>Kode Buku</th>
        <th>ISBN</th>
        <th>Judul</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Tahun Terbit</th>
        <th>Stok</th>
        <th>Action</th>
         </tr>
        </thead>
        <tbody>
            <?php 
            //$no = 1;
          foreach($buku as $rows){ ?>
         <tr>
          <!-- <td><?=$no++?></td> -->
          <td><?=$rows->kode_buku?></td>
          <td><?=$rows->ISBN?></td>
          <td><?=$rows->judul?></td>
          <td><?=$rows->pengarang?></td>
          <td><?=$rows->penerbit?></td>
          <td><?=tgl_indo($rows->tahun_terbit)?></td>
          <td><?=$rows->stok?></td>
          <td>
           <a href="<?=base_url()?>panelib/buku/read/<?=$rows->id_buku?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-search"></i></a>
           <a href="<?=base_url()?>panelib/buku/update/<?=$rows->id_buku?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
           <a class="btn btn-danger btn-sm" onclick="return swal({ 
                                      title: 'Yakin akan hapus data ini?',
                                      text: 'Anda tidak akan melihat data ini lagi!',   
                                      type: 'warning',
                                      showCancelButton: true,   
                                      confirmButtonColor: '#d9534f',
                                         }, function(){
                                            window.location.href ='<?=base_url()?>panelib/buku/delete/<?=$rows->id_buku?>';   
                                                       });"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
        <? }?>
        </tbody>
       </table>
        </div> <!-- /panel-body-->
            <div class="row">
            <div class="col-md-5" style="margin-bottom: 20px";>
                <a style="margin-left: 12px"></a>
                <?php echo anchor(site_url('panelib/buku/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('panelib/buku/word'), 'Word', 'class="btn btn-primary"'); ?>
           </div>
        </div>
    </div>    <!-- /panel -->

    <!-- <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.remove').on('click',function(){
                var getLink = $(this).attr('href');
                swal({
                        title: 'Notif',
                        text: 'Yakin Hapus Data?',
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