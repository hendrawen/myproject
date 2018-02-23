    <footer class="site-footer" style="margin-top: 500px; ">
          <div class="text-center">
              2017 - My library ver.1.0/alpha
              <a href="index.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
</section>
    
    

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-1.8.3.min.js')?>"></script>
    <!-- <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script> -->
    
    <!-- Bootstrap DataTables -->
    <script src="<?php echo base_url('assets/datatables2/js/jquery-1.11.0.js');?>"></script>
    <script src="<?php echo base_url('assets/datatables2/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/datatables2/datatables/jquery.dataTables.js');?>"></script>
    <script src="<?php echo base_url('assets/datatables2/datatables/dataTables.bootstrap.js');?>"></script>

    <script class="include" type="text/javascript" src="<?php echo base_url('assets/js/jquery.dcjqaccordion.2.7.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.scrollTo.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.nicescroll.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/jquery.sparkline.js')?>"></script>

    <!--common script for all pages-->
    <script src="<?php echo base_url('assets/js/common-scripts.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/gritter/js/jquery.gritter.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/gritter-conf.js')?>"></script>

    <!--script for this page-->
    <script src="<?php echo base_url('assets/js/sparkline-chart.js')?>"></script>    
    <script src="<?php echo base_url('assets/js/zabuto_calendar.js')?>"></script>

    </body>
</html>
    <script type="text/javascript">
        $(function() {
            $("#data").dataTable();
        });
    </script>

    <script type="text/javascript" src="<?php echo base_url()?>assets/bootstrap-datepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/bootstrap-datepicker/js/bootstrap-datetimepicker.id.js"></script>
    
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

<script type="application/javascript">
                $(document).ready(function () {
                    $("#date-popover").popover({html: true, trigger: "manual"});
                    $("#date-popover").hide();
                    $("#date-popover").click(function (e) {
                        $(this).hide();
                    });
                
                    $("#my-calendar").zabuto_calendar({
                        action: function () {
                            return myDateFunction(this.id, false);
                        },
                        action_nav: function () {
                            return myNavFunction(this.id);
                        },
                        ajax: {
                            url: "show_data.php?action=1",
                            modal: true
                        },
                        legend: [
                            {type: "text", label: "Special event", badge: "00"},
                            {type: "block", label: "Regular event", }
                        ]
                    });
                });
                
                
                function myNavFunction(id) {
                    $("#date-popover").hide();
                    var nav = $("#" + id).data("navigation");
                    var to = $("#" + id).data("to");
                    console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
                }
            </script>

