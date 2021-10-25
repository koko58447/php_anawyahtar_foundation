<?php
include('../config.php');
include(root.'master/header.php');
?>

<style>
.text-line {
    background-color: transparent;
    color: balck;
    outline: none;
    outline-style: none;
    outline-offset: 0;
    border-top: none;
    border-left: none; 
    border-right: none;
    border-bottom: solid black 1px;
    padding: 2px 2px 5px;
    width: 100%;
}
</style>

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item active">Show All</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <i class="fa fa-table"></i>
                Show All
                <input type="hidden" name="hid">
                <input type="hidden" name="ser">

            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <td width="15%">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-5 col-form-label">Show</label>
                                <div class="col-sm-7">
                                    <select id="entry" class="custom-select btn-sm">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td width="50%" class="float-right">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label text-right">Search</label>
                                <div class="col-sm-8">
                                    <input type="search" class="form-control" id="searching"
                                        placeholder="Searching . . . . . ">
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="table-responsive" id="show_table">

                </div>
            </div>
            <div class="card-footer small text-muted">Updated today at <?php echo date("h:i:s A") ?> </div>
        </div>

    </div>
</div>

<div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-eye"></i>
                    View Detail
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class='modal-body'>
                <div id="display">

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" id="btnprintdetail" class="btn btn-primary"><i
                        class="fa fa-print"></i>&nbsp;Print</button>
            </div>
        </div>
    </div>
</div>

<?php include(root.'master/footer.php'); ?>

<script>
$(document).ready(function() {

    function load_pag(page) {
        var entryvalue = $("[name='hid'").val();
        var search = $("[name='ser'").val();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_alldonation_action.php' ?>",
            data: {
                action: 'show',
                page_no: page,
                entryvalue: entryvalue,
                search: search
            },
            success: function(data) {
                $("#show_table").html(data);
            }
        });
    }
    load_pag();

    $(document).on('click', '.page-link', function() {
        var pageid = $(this).data('page_number');
        load_pag(pageid);
    });

    $(document).on("change", "#entry", function() {
        var entryvalue = $(this).val();
        $("[name='hid'").val(entryvalue);
        load_pag();
    });


    $(document).on("keyup", "#searching", function() {
        var serdata = $(this).val();
        $("[name='ser'").val(serdata);
        load_pag();
    });

    $(document).on("click", "#btnviewdetail", function() {
        var vno = $(this).data("vno");
        var cusname = $(this).data("cusname");
        var phno = $(this).data("phno");
        var address = $(this).data("address");
        var no = $(this).data("no");
        var dt = $(this).data("dt");
        var rmk = $(this).data("rmk");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_alldonation_action.php' ?>",
            data: {
                action: 'detail',
                vno: vno,
                cusname: cusname,
                phno: phno,
                address: address,
                no: no,
                dt: dt,
                rmk: rmk
            },
            success: function(data) {
                $("#display").html(data);
                $("#detailmodal").modal("show");
            }
        });
    });

    $(document).on("click", "#btnprintdetail", function() {
        $("#display").printThis({
            debug: false,
            importCSS: true,
            importStyle: true,
            printContainer: true,
            loadCSS: "../css/style.css",
            pageTitle: "Print",
            removeInline: false,
            printDelay: 333,
            header: null,
            formValues: true
        });
    });

    $(document).on("click", "#btnedit", function() {
        var vno = $(this).data("vno");
        var cusname = $(this).data("cusname");
        var phno = $(this).data("phno");
        var address = $(this).data("address");
        var no = $(this).data("no");
        var dt = $(this).data("dt");
        var rmk = $(this).data("rmk");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_alldonation_action.php' ?>",
            data: {
                action: 'edit',
                vno: vno,
                cusname: cusname,
                phno: phno,
                address: address,
                no: no,
                dt: dt,
                rmk: rmk
            },
            success: function(data) {
                location.href = "<?php echo roothtml.'gold/gold_donation.php' ?>";
            }
        });
    });


    $(document).on("click", "#btndelete", function(e) {
        e.preventDefault();
        var vno = $(this).data("vno");
        swal({
                title: "Delete?",
                text: "Are you sure delete!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo roothtml.'gold/gold_alldonation_action.php'; ?>",
                    data: {
                        action: 'delete',
                        vno: vno
                    },
                    success: function(data) {
                        if (data == 1) {
                            swal("Successful", "Delete data success.", "success");
                            load_pag();
                        } else {
                            swal("Error", "Delete data failed.", "error");
                        }
                    }
                });
            });
    });


});
</script>