<div class="row-mt">
  <br>
  <div class="col-md-8 col-md-offset-2">
      <input type="search" name="keyword" value="" class="form-control input-lg" id="keyword" autocomplete="off" oninput="ambildata()" style="text-align: center; " placeholder="Silahkan Masukkan Judul atau Pengarang Buku">
  </div>
  <div class="col-md-offset-2">
      <img src="<?php echo base_url('assets/img/search.gif')?>" width="50">
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