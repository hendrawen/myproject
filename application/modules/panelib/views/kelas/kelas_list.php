<!-- <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('kelas/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('kelas/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('kelas'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
        <th>No</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>IPA/IPS/Bahasa</th>
        <th>Action</th>
            </tr><?php
            foreach ($kelas_data as $kelas)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $kelas->kelas ?></td>
            <td><?php echo $kelas->jurusan ?></td>
            <td><?php echo $kelas->keberapa ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('kelas/read/'.$kelas->id_kelas),'Read'); 
                echo ' | '; 
                echo anchor(site_url('kelas/update/'.$kelas->id_kelas),'Update'); 
                echo ' | '; 
                echo anchor(site_url('kelas/delete/'.$kelas->id_kelas),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
        <?php echo anchor(site_url('kelas/excel'), 'Excel', 'class="btn btn-primary"'); ?>
        <?php echo anchor(site_url('kelas/word'), 'Word', 'class="btn btn-primary"'); ?>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div> -->

<!-- <?php if ($this->session->flashdata('message')): ?>
<div class="alert bg-danger alert-right">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
    <span class="text-semibold"><?php echo $this->session->flashdata('message');?></span>
</div>
<?php endif; ?> -->

<!-- Notifikasi ID Kelas Anggota -->
<?php if ($this->session->flashdata('message')): ?>
         <small>
           <script type="text/javascript">
              swal({
                   title: "Maaf!!!",
                   text: "<?php echo $this->session->flashdata('message'); ?>",
                    timer: 3000,
                   showConfirmButton: true,
                   type: 'error'
               });
           </script>
         </small>
    <?php endif; ?>

<!-- sukses -->
    <?php if ($this->session->flashdata('msg')): ?>
         <small>
           <script type="text/javascript">
              swal({
                   title: "Mantap!!!",
                   text: "<?php echo $this->session->flashdata('msg'); ?>",
                    timer: 3000,
                   showConfirmButton: true,
                   type: 'success'
               });
           </script>
         </small>
    <?php endif; ?>

<div class="panel panel-default">
  <div class="panel-body">
     <?php echo anchor(site_url('panelib/kelas/create'),'Create', 'class="btn btn-primary"'); ?>
     
    <div class="col-md-12" style="margin-top: 18px;">
    </div>
       <table id="data" class="table table-striped table-advance table-hover">

        <thead>
         <tr>
         <th>No</th>
         <th>Kelas</th>
        <th>Jurusan</th>
        <!-- <th>IPA/IPS/Bahasa</th> -->
        <th>Action</th>
         </tr>
        </thead>
        <tbody>          
              <?php 
              /*if(empty($kelas)){
                      $this->session->set_flashdata('message','Data Tidak Ditemukan'); 
                } else {*/
                $no = 1;
              foreach($kelas as $rows){ ?>
         <tr>
          <td><?=$no++ ?></td>
          <td><?=$rows->kelas?></td>
          <td><?=$rows->jurusan?></td>
          <!-- <td><?=$rows->keberapa?></td> -->
          <td>
           <a href="<?=base_url()?>panelib/kelas/read/<?=$rows->id_kelas?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-search"></i></a>
           <a href="<?=base_url()?>panelib/kelas/update/<?=$rows->id_kelas?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
           <a class="btn btn-danger btn-sm" onclick="return swal({ 
                            title: 'Yakin akan hapus data ini?',
                            text: 'Anda tidak akan melihat data ini lagi!',   
                            type: 'warning',
                            showCancelButton: true,   
                            confirmButtonColor: '#d9534f',
                               }, function(){
                                  window.location.href ='<?=base_url()?>panelib/kelas/delete/<?=$rows->id_kelas?>';   
                                             });"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
        <? }?>
        </tbody>
       </table>
        </div> <!-- /panel-body-->
            <div class="row">
            <div class="col-md-5" style="margin-bottom: 10px";>
                <!-- <a style="margin-left: 8px;" href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a> -->
                <a style="margin-left: 10px;"></a>
                <?php echo anchor(site_url('panelib/kelas/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('panelib/kelas/word'), 'Word', 'class="btn btn-primary"'); ?>
           </div>
           <!-- <div class="col-md-6 text-right">
                <?=$paging?>
           </div> -->
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
