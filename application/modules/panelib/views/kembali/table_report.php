<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cetak Laporan Pengembalian</title>

	<!-- Global stylesheets -->
  <style>
    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
	<!-- /theme JS files -->

</head>
<body>
  <?php $date1 = tgl_indo($this->input->post('date_from'));
  $date2 = tgl_indo($this->input->post('date_to')); ?>
  <h4>Laporan Pengembalian Buku<!-- <?php echo $this->session->userdata('company'); ?> --> Periode <?php echo $date1; ?> - <?php echo $date2; ?></h4>
  <br>
  <br>
							<table id="customers">
								<thead>
									<tr>
										<th>#</th>
                    <th>Kode Anggota</th>
                    <th>Nama Anggota</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Terlambat</th>
                    <th>Denda</th>
                    <th>Status</th>
									</tr>
								</thead>
								<tbody>
                    <?php $no=1; ?>
            	  		<?php foreach($result_display as $value): ?>
            	  		  <tr>
            	  			<td><?php echo $no; ?></td>
            	  			<td><?php echo $value->kode_anggota; ?></td>
            	  			<td><?php echo $value->nama_anggota; ?></td>
            	  			<td><?php echo $value->kode_buku; ?></td>
                            <td><?php echo $value->judul; ?></td>
                            <td><?php echo $value->tgl_pinjam; ?></td>
                            <td><?php echo $value->tgl_kembali; ?></td>
                            <td><?php echo $value->terlambat; ?></td>
                            <td><?php echo number_format($value->denda,2,",","."); ?></td>
                            <td><?php echo $value->status; ?></td>
                      <!-- <td><?php echo number_format($value->subtotal,2,",","."); ?></td>
                      <td><?php echo tgl_indo($value->bulan); ?></td> -->
            	  		  </tr>
            	  		<?php $no++; ?>
            	  		<?php endforeach; ?>
								</tbody>
              <!-- <?php foreach ($sum as $jum): ?>
                <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total : </th>
                    <th>Rp. <?php echo number_format($jum->total,2,',','.') ?></th>
                </tr>

                </tfoot>
                <?php endforeach; ?> -->
							</table>
</body>
</html>
