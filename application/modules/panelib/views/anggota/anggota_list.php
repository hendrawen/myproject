<!-- notifikasi peminjaman -->
<?php if ($this->session->flashdata('msg')): ?>
         <small>
           <script type="text/javascript">
              swal({
                   title: "Maaf",
                   text: "<?php echo $this->session->flashdata('msg'); ?>",
                    timer: 3000,
                   showConfirmButton: true,
                   type: 'error'
               });
           </script>
         </small>
    <?php endif; ?>

<!-- sukses -->
<?php if ($this->session->flashdata('message')): ?>
         <small>
           <script type="text/javascript">
              swal({
                   title: "Done",
                   text: "<?php echo $this->session->flashdata('message'); ?>",
                    timer: 3000,
                   showConfirmButton: true,
                   type: 'success'
               });
           </script>
         </small>
    <?php endif; ?>

<div class="panel panel-default">
  <div class="panel-body">
        <?php echo anchor(site_url('panelib/anggota/create'),'Create', 'class="btn btn-primary"'); ?>

    <div class="col-md-12" style="margin-top: 10px;">
    </div>
       <table id="data" class="table table-striped table-advance table-hover">

        <thead>
         <tr>
         <!-- <th>No</th> -->
            <th>Kode Anggota</th>
            <th>NISP</th>
            <th>Nama Anggota</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Jenis Kelamin</th>
            <th>Tempat Lahir</th>
            <th>Tgl Lahir</th>
            <th>Telepon</th>
            <th>Action</th>
         </tr>
        </thead>
        <tbody>
            <?php
                //$no = 1;
              foreach($anggota as $rows){ ?>
         <tr>
            <!-- <td><?=$no?></td> -->
            <td><?php echo $rows->kode_anggota ?></td>
            <td><?php echo $rows->NISP ?></td>
            <td><?php echo $rows->nama_anggota ?></td>
            <td style="text-align: center;"><?php echo $rows->kelas ?></td>
            <td style="text-align: center;"><?php echo $rows->jurusan ?></td>
            <td style="text-align: center;"><?php echo $rows->jenis_kelamin ?></td>
            <td><?php echo $rows->tempat_lahir ?></td>
            <td><?php echo tgl_indo($rows->tgl_lahir) ?></td>
            <td><?php echo $rows->telepon ?></td>
          <td>
           <a href="<?=base_url()?>panelib/anggota/read/<?=$rows->kode_anggota?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-search"></i></a>
           <a href="<?=base_url()?>panelib/anggota/update/<?=$rows->kode_anggota?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
           <a class="btn btn-danger btn-sm" onclick="return swal({
                            title: 'Yakin akan hapus data ini?',
                            text: 'Anda tidak akan melihat data ini lagi!',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d9534f',
                               }, function(){
                                  window.location.href ='<?=base_url()?>panelib/anggota/delete/<?=$rows->kode_anggota?>';
                                             });"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
        <? }?>
        </tbody>
       </table>
        </div> <!-- /panel-body-->
            <div class="row">
            <div class="col-md-5" style="margin-bottom: 10px;">
                <?php echo anchor(site_url('panelib/anggota/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('panelib/anggota/word'), 'Word', 'class="btn btn-primary"'); ?>
           </div>
        </div>
    </div>

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
