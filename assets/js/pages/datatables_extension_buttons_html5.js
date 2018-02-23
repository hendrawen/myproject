/* ------------------------------------------------------------------------------
*
*  # Buttons extension for Datatables. HTML5 examples
*
*  Specific JS code additions for datatable_extension_buttons_html5.html page
*
*  Version: 1.1
*  Latest update: Mar 6, 2016
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
       autoWidth: false,
        searchHighlight: true,
        processing: true, //Feature control the processing indicator.
        serverSide: true,
        
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [
            {
                targets: [1,2,7,8],
                visible: false
            },
            {
                className: 'control',
            },
            { 
                width: "100px",
                targets: [6]
            },
            { 
                targets: [ 0 ], //first column
                orderable: false, //set not orderable
            },
            { 
                targets: [ -1 ], //last column
                orderable: false, //set not orderable
            },
            
        ],
        order: [1, 'asc'],
        dom: '<"datatable-header"fBl><"datatable-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        }
    });


    // Basic initialization
    $('.datatable-button-html5-basic').DataTable({
        buttons: {            
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        }
    });


    // PDF with image
    
    $.ajaxSetup({
        data: {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
        }
    });
    // Column selectors
    $('.datatable-button-html5-columns').DataTable({
        "ajax": {
            "url": "users/ajax_list",
            "cache": true,
            "type": "POST"
        },
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class=icon-copy position-left"></i> Copy',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                extend: 'print',
                text: '<i class="icon-printer position-left"></i> Print',
                className: 'btn btn-default',
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="icon-file-excel"></i> Excel',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class=" icon-file-pdf"></i> PDF',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="icon-move-vertical"></i> Visible Columns',
                    className: 'btn btn-default btn-icon'

                }
            ]
        }
    });
    $("#check-all").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
    });
    

    // Tab separated values
    $('.datatable-button-html5-tab').DataTable({
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy3 position-left"></i> Copy'
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> CSV',
                    fieldSeparator: '\t',
                    extension: '.tsv'
                }
            ]
        }
    });
    


    // External table additions
    // ------------------------------
    $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,  
        });

    //set input/textarea/select event when change value, remove class error and remove text help block 
    // Enable Select2 select for the length option
    $('.dataTables_length select2').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    
    //datepicker
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
