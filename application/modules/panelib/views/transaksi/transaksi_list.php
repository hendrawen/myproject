
<?php if ($this->session->flashdata('message')): ?>
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
                   title: "Done",
                   text: "<?php echo $this->session->flashdata('msg'); ?>",
                    timer: 3500,
                   showConfirmButton: true,
                   type: 'error'
               });
           </script>
         </small>
    <?php endif; ?>

<div class="panel panel-default">
  <div class="panel-body">
     <?php echo anchor(site_url('panelib/transaksi/create'),'Create', 'class="btn btn-primary"'); ?>

    <div class="col-md-12" style="margin-bottom: 10px;">
    </div>
       <table id="data" class="table table-striped table-advance table-hover">

        <thead>
         <tr>
         <!-- <th>No</th> -->
        <th>Nama</th>
        <th>Judul</th>
        <th>Pengarang</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Terlambat</th>
        <th>Denda</th>
        <th>Status</th>
        <th>Action</th>
         </tr>
        </thead>
        <tbody>
          <?php
              /*if(empty($transaksi)){
                      $this->session->set_flashdata('msg','Data Tidak Ditemukan');
                } else {*/
                $no = 1;
              foreach($transaksi as $rows){ ?>
         <tr>
            <!-- <td><?=$no++?></td> -->
            <td><?php echo $rows->nama_anggota ?></td>
            <td><?php echo $rows->judul ?></td>
            <td><?php echo $rows->pengarang ?></td>
            <td><?php echo tgl_indo($rows->tgl_pinjam) ?></td>
            <td><?php echo tgl_indo($rows->tgl_kembali) ?></td>
            <td><?php
                  $tgl_dateline2 = $rows->tgl_kembali;
                  $tgl_kembali = date("d-m-Y");

                  $lambat = terlambat($tgl_dateline2, $tgl_kembali); //dari helper

                  if ($lambat > 0) {
                      echo "<font color='red'>$lambat hari</font>";
                  } else {
                      echo $lambat." Hari";
                  }
                  ?>
            </td>
            <td>
              <?php
                    foreach ($denda as $jml) {
                        $denda1 = $lambat*$jml;
                    }
                    echo "<font color='red'>Rp. $denda1</font>";
              ?>
            </td>
            <td><?php echo $rows->status ?></td>
          <td>
           <a href="<?php echo base_url('panelib/transaksi/kembali').'/'.$rows->id.'/'.$rows->id_buku.'/'.$lambat.'/'.$denda1;?>" class="btn btn-danger btn-sm">Kembali</a>
           <a class="btn btn-primary btn-sm" onclick="return swal({
                                      title: 'Yakin akan perpanjang peminjaman buku?',
                                      //text: 'Anda tidak akan melihat data ini lagi!',
                                      type: 'warning',
                                      showCancelButton: true,
                                      confirmButtonColor: '#d9534f',
                                         }, function(){
                                            window.location.href ='<?php echo base_url('panelib/transaksi/perpanjang').'/'.$rows->id.'/'.$lambat.'/'.$rows->tgl_kembali;?>';
                                                       });">Perpanjang</a>
          </td>
         </tr>
       <?php } ?>
        </tbody>
       </table>
        </div> <!-- /panel-body-->
            <div class="row">
            <div class="col-md-5" style="margin-bottom: 10px;">
                <a style="margin-left: 8px;"></a>
                <?php echo anchor(site_url('panelib/transaksi/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('panelib/transaksi/word'), 'Word', 'class="btn btn-primary"'); ?>
           </div>
        </div>
    </div>

    <!-- <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.remove').on('click',function(){
                var getLink = $(this).attr('href');
                swal({
                        title: 'Notif',
                        text: 'Yakin Ingin Perpanjang Peminjaman?',
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
