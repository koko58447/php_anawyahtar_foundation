<?php
include('../config.php');
include(root.'master/header.php');
?>

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item active">Category</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <i class="fa fa-table"></i>
                Category

                <form method="POST" action="category_action.php" class="float-right">
                    <input type="hidden" name="hid">
                    <input type="hidden" name="ser">
                    <a href="#" class="text-white" data-toggle="modal" data-target="#addNewCategory">
                        <span class="float-right">
                            <i class="fa fa-plus"></i>
                            Add New Category
                        </span>
                    </a>
                    <button name="action" value="excel" style="background: none;border: none;" class="text-white"><i
                            class="fa fa-file-excel-o"></i> Excel &nbsp;&nbsp;</button>
                </form>
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

<div class="modal fade" id="addNewCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-plus"></i>
                    Add New Category
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmsave">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" class="form-control" name="catname" placeholder="Enter category name"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btnsave" class="btn btn-primary"><i
                            class="fa fa-save"></i>&nbsp;Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-plus"></i>
                    Edit Category
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmedit">
                <input type="hidden" name="eaid">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" class="form-control" name="ecatname" placeholder="Enter category name"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btneditsave" class="btn btn-primary"><i
                            class="fa fa-edit"></i>&nbsp;Edit</button>
                </div>
            </form>
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
            url: "<?php echo roothtml.'item/category_action.php' ?>",
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

    $(document).on("click", "#btnsave", function(e) {
        e.preventDefault();
        var catname = $("[name='catname']").val();
        if (catname == '') {
            swal("Information", "Please fill all data.", "info");
            return false;
        }
        $("#addNewCategory").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'item/category_action.php' ?>",
            data: $("#frmsave").serialize() + "&action=save",
            success: function(data) {
                if (data == 1) {
                    swal("Successful", "save data success.", "success");
                    $("#frmsave")[0].reset();
                    load_pag();
                } else {
                    swal("Error", "Save data failed.", "error");
                }

            }
        });
    });

    $(document).on("click", "#btnedit", function() {
        var aid = $(this).data("aid");
        var catname = $(this).data("catname");
        $("[name='eaid']").val(aid);
        $("[name='ecatname']").val(catname);
        $("#editCategory").modal("show");
    });

    $(document).on("click", "#btneditsave", function(e) {
        e.preventDefault();
        var aid = $("[name='eaid']").val();
        var catname = $("[name='ecatname']").val();
        if (catname == '') {
            swal("Information", "Please fill all data.", "info");
            return false;
        }
        $("#editCategory").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'item/category_action.php' ?>",
            data: $("#frmedit").serialize() + "&action=edit",
            success: function(data) {
                if (data == 1) {
                    swal("Successful", "edit data success.", "success");
                    load_pag();
                } else {
                    swal("Error", "Error Edit.", "error");
                }
            }
        });
    });

    $(document).on("click", "#btndelete", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
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
                    url: "<?php echo roothtml.'item/category_action.php'; ?>",
                    data: {
                        action: 'delete',
                        aid: aid
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