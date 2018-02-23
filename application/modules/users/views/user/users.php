<?php echo $this->load->view('administrator/template/header'); ?>


  <section id="container" >
      <!--header start-->
            <?php echo $this->load->view('administrator/template/navbar'); ?>
      <!--header end-->

      <!--sidebar start-->
            <?php echo $this->load->view('administrator/template/sidebar'); ?>
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
                  <h3><i class="fa fa-angle-right"></i> <?php echo $judul_menu;?> <i class="fa fa-angle-right"></i> <?php echo $sub_judul;?></h3>
                  <br>

        <?php if ($this->session->flashdata('message')): ?>
        <div class="alert bg-primary alert-right">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
            <span class="text-semibold"><?php echo $this->session->flashdata('message');?></span>
        </div>
        <?php endif; ?>
        <div class="content-panel"> &nbsp;
            <div class="col-md-4">
                <a href="<?php echo base_url('users/create')?>" class="btn btn-success" ><i class=" fa fa-plus"></i> Create</a>
            <!-- <button class="btn btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
            <button class="btn btn-danger" onclick="bulk_delete()"><i class="glyphicon glyphicon-trash"></i> Delete Selected</button> -->
        </div>
        <div class="col-md-1 text-right">
            </div>
            <div class="col-md-6 text-right">
                <form action="<?php echo site_url('users'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('users'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        <br />
        <br />
        <hr />
        <table id="table_id" class="table table-hover datatable-responsive table-striped" cellspacing="0" width="100%" style="margin-bottom: 2px;">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check-all"></th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            <tfoot>
                <?php foreach ($user_data as $rows):?>
            <tr>
                <td><input type="checkbox" name="id_user"></td>
                <td><?php echo $rows->first_name;?></td>
                <td><?php echo $rows->last_name;?></td>
                <td><?php echo $rows->username;?></td>
                <td><?php echo $rows->company;?></td>
                <td><?php echo $rows->email;?></td>
                <td><?php echo $rows->phone;?></td>
                <td><?php echo $rows->active;?></td>
                <!-- <?php echo ($rows->active) ? anchor("users/auth/deactivate/".$rows->id) : anchor("users/auth/activate/". $rows->id);?> -->
                <td>
                       <!-- <?php
                        echo anchor(site_url('users/auth/edit_user/'.$rows->id),'<button class="btn btn-primary btn-sm"><fa class="fa fa-pencil"></fa></button>');
                        echo ' ';
                        echo anchor(site_url('users/auth/delete/'.$rows->id),'<button class="btn btn-danger btn-sm"><fa class="fa fa-trash-o"></fa></button>');
                        ?>  -->
                    <div class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url('users/auth/edit_user/'.$rows->id);?>">Edit</a></li>
                            <li><a href="<?php echo base_url('users/auth/activate/'.$rows->id);?>">Active</a></li>
                            <li><a href="<?php echo base_url('users/auth/deactivate/'.$rows->id);?>">Deactive</a></li>
                            <li><a href="<?php echo base_url('users/auth/delete/'.$rows->id);?>" onclick="return confirm('Yakin Ingin Hapus?')">Delete</a></li>
                          </ul>
                        </div>
                </td>
            </tr>
            </tfoot>
            </tbody>
        <?php endforeach; ?>
        </table>
        <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
    </div><br>
    <div class="row">
            <div class="col-md-6">
                <a href="" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
           </div>
        </div>
            </section>
        </section>
      <!--main content end-->

<script type="text/javascript">
var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table = $('#table_id').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('users/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });

    $.ajaxSetup({
        data: {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
        }
    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
    });

    //set input/textarea/select event when change value, remove class error and remove text help block
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    $("#check-all").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
    });
    $(".datepicker-menus").datepicker({
        changeMonth: true,
        changeYear: true
    });

});

$('.dataTables_length select2').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });

$.ajaxSetup({
        data: {
            csrf_test_name: $.cookie('csrf_cookie_name')
        }
    });

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}

function delete_user(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('users/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function bulk_delete()
{
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Are you sure delete this '+list_id.length+' data?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: "<?php echo site_url('users/ajax_bulk_delete')?>",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        reload_table();
                    }
                    else
                    {
                        alert('Failed.');
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
        }
    }
    else
    {
        alert('no data selected');
    }
}

//fungsi delete
    function checkAll(frm, checkedOn){
        //have we been passed an ID
        if (typeof frm == "string") {
            frm = document.getElementById(frm);
        }
        //get all of the inputs that are in this room
        var inputs = frm.getElementByTagName("input");
        //for each input in the form, check if it is a checkbox
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "checkbox") {
                inputs[i].checked = checkedOn;
            }
        }
    }

</script>

      <!--footer start-->
            <?php echo $this->load->view('administrator/template/footer'); ?>
      <!--footer end-->
