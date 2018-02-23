<div class="row-mt">
  <br>
  <center><h3>Masukkan No.Anggota</h3></center>
  <div class="col-md-4 col-md-offset-4">
      <input type="search" name="keyword" value="" class="form-control" id="keyword" autocomplete="off" oninput="ambildata()" style="text-align: center; ">
  </div>
  <div class="col-md-offset-4">
      <!-- <img src="<?php echo base_url('assets/img/search.gif')?>" width="50"> -->
      <i><h4 style="margin-top: 18px;">Tekan Enter</h4></i>
  </div>
</div>
<br>
<div class="row-mt">
    <table class="table table-responsive table-striped table-hover tabel_pad" id="tabel_cari" style="display: none;">
    <thead>
      <th>Gambar</th>
      <th>Judul Buku</th>
      <th>Pengarang</th>
      <th>Penerbit</th>
      <th>Lokasi</th>
      <th>Bagian</th>
    </thead>
    <tbody id="hasil">
    </tbody>
    </table>

  <script type="text/javascript">
        function ambildata() {
        var keyword=$('#keyword').val();
          if (keyword == "") {
            $('#tabel_cari').hide();
        }else{
        $.ajax({
          url:'<?php echo base_url();?>depan/hasil_cari',
            type:'GET',
              dataType:'html',
              data:'keyword='+keyword,
              success:function (respons) {
            $('#hasil').html(respons);
        },
        })
        $('#tabel_cari').show();
        }
        }
  </script>
</div><br><br><br>
