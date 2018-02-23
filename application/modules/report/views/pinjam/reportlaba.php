<?php
$this->load->view('panelIMS/template/header');
$this->load->view('panelIMS/template/navbar');
?>
<link href="<?php echo base_url()?>assets/date_picker_bootstrap/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php echo base_url()?>assets/date_picker_bootstrap/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/date_picker_bootstrap/js/locales/bootstrap-datetimepicker.id.js"></script>
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

            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <div class="row">
            <div class="col-md-12">
              <div class="panel">
              <div class="panel-body">
                <?php echo form_open("report/laba"); ?>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
                          <div class="date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                             <input class="form-control datepicker"  data-date-format="yyyy-mm-dd" type="text" name="date_from" placeholder="Dari Tanggal" required>
                          </div>
				                </div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
                          <div class="date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                             <input class="form-control datepicker"  data-date-format="yyyy-mm-dd" type="text" name="date_to" placeholder="Hingga Tanggal" required>
                          </div>
				                </div>
											</div>
										</div>
				            <div class="text-right">
                      <div class="form-group has-feedback">
                        <div class="btn-group">
                              <button type="submit" name="proses" value="proses" class="btn btn-primary"><i class=" icon-spinner9 position-left"></i> Proses </button>
                      	</div>
                      </div>
				            </div>
			              </form>
				          </div>
              </div>
              </div>
            </div>
              <div class="message">
                <?php
                $date1 = tgl_indo($this->input->post('date_from'));
                $date2 = tgl_indo($this->input->post('date_to'));
                if (isset($result_display)) {
                echo "";
                if ($result_display == 'No record found !') {
                echo $result_display;
                } else {
                echo "<div class='panel panel-flat'>
                <div class='panel-heading'>
                  <h5 class='panel-title'>Periode $date1 - $date2 </h5>
                  <div class='heading-elements'>
                    <ul class='icons-list'>
                              <li><a data-action='collapse'></a></li>
                              <li><a data-action='reload'></a></li>
                              <li><a data-action='close'></a></li>
                            </ul>
                          </div>
                </div>
                <table class='table datatable-basic'>";
                echo '<thead>
                        <tr>
                          <th>Modal</th>
                          <th>Laba Kotor</th>
                          <th>Laba Bersih</th>
                        </tr>
                      </thead>';
                foreach ($result_display as $value) {
                echo '<tbody><tr>' . '<td>' . number_format($value->modal,2,',','.') . '</td>' . '<td>' . number_format($value->labakotor,2,',','.') . '</td>' . '<td>' . number_format($value->lababersih,2,',','.') . '</td>'. '<tr/></tbody>';
                }

                echo '</table>';
                // echo '
                // </div>
                // <div class="panel panel-flat">
                // 	<div class="panel-heading">
                // 		<h6 class="panel-title">Detail laba rugi</h6>
                //     Modal : ' . $value->modal . '<br>
                //     Laba Kotor :  ' . $value->sub . '
                // 		</div>
                //   </div>';
                }
                }
                ?>
              </div>
        <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-body">
          <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
          </div>
          </div>
          <script>
          Highcharts.chart('container', {
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: 'Chart Presentasi '
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
              },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      showInLegend: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                          style: {
                              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                          }
                      }
                  }
              },
              series: [{
                  name: 'Presentasi',
                  colorByPoint: true,
                  data: [{
                      name: 'Modal',
                      y: <?php echo $value->modal ?>
                  },{
                      name: 'Laba Bersih',
                      sliced: true,
                      selected:true,
                      y: <?php echo $value->lababersih ?>
                  },{
                      name: 'Laba Kotor',
                      y: <?php echo $value->labakotor ?>
                  }]
              }]
          });
      </script>
      <script type="text/javascript">
       $('.datepicker').datetimepicker({
              language:  'id',
              weekStart: 1,
              todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
          });
      </script>
      </div>


<?php
    $this->load->view('panelIMS/template/footer');
?>
