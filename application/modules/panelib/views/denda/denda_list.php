        <!-- <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('denda/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('denda/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('denda'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div> -->
<!-- <?php if ($this->session->flashdata('message')): ?>
<div class="alert bg-primary alert-right">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
    <span class="text-semibold"><?php echo $this->session->flashdata('message');?></span>
</div>
<?php endif; ?> -->

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

        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
            <div class="content-panel">
                    <div class="panel-body">
        <table class="table table-bordered table-hover" style="margin-bottom: 10px; text-align: center; font-size: 30px;">
            <tr>
                <!-- <th>No</th> -->
    		<td colspan="2"><b>Denda</b></td>
                </tr><?php
                foreach ($denda_data as $denda)
                {
                    ?>
                    <tr>
    			<!-- <td width="80px"><?php echo ++$start ?></td> -->
    			<td><?php echo $denda->denda; ?><?php echo '/Hari' ?></td>
    			<td style="text-align:center" width="200px">
    				<?php 
    				/*echo anchor(site_url('denda/read/'.$denda->id_denda),'Read'); 
    				echo ' | '; */
    				echo anchor(site_url('panelib/denda/update/'.$denda->id_denda),'Ubah'); 
    				/*echo ' | '; 
    				echo anchor(site_url('denda/delete/'.$denda->id_denda),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); */
    				?>
    			</td>
    		</tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
        <!-- <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div> -->