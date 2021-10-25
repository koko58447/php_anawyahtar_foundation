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
            <li class="breadcrumb-item active">Item</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <i class="fa fa-table"></i>
                Item

                <form method="POST" action="item_action.php" class="float-right">
                    <input type="hidden" name="hid">
                    <input type="hidden" name="ser">
                    <a href="#" class="text-white" data-toggle="modal" data-target="#addNewItem">
                        <span class="float-right">
                            <i class="fa fa-plus"></i>
                            Add New Item
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

<!-- Add Student -->
<div class="modal fade" id="addNewItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-plus"></i>
                    Add New Item
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmsaveitem1" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Item Name</label>
                        <input type="text" class="form-control" name="iname" id="iname1"
                            placeholder="Enter Item Name...">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="iprice" id="iprice1"
                            placeholder="Enter Price...">
                    </div>
                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="date" class="form-control" name="idate" id="idate1"
                            value="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control text-primary" name="icategory" id="icategory1">
                            <option value=""><sub>Please select Category</sub></option>
                            <?php echo load_category() ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="usr"> Image </label>
                        <div class="border border-primary p-1">
                            <input type="file" id="ifile1" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" name="ifile1">
                        </div>
                        <span>File must be : .jpg, .jpeg, .png, .JPG, .JPEG, .PNG</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btnsaveitem" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Add
                        New Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-edit"></i>
                    Edit Item
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmedititem">

            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="photomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-edit"></i>
                    Edit Item Photo
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmphoto" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="changephoto">
                <input type="hidden" name="paid">
                <input type="hidden" name="pimg">
                <div class='modal-body'>
                    <div class='form-group'>
                        <label for='usr'> Old Photo :</label><br>
                        <img src='' id="showimg" style='width:100%;height:270px;' />
                    </div>
                    <div class="form-group">
                        <label for="usr"> Choose New Photo </label>
                        <div class="border border-primary p-1">
                            <input type="file" id="ifile2" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" name="ifile2">
                        </div>
                        <span>File must be : .jpg, .jpeg, .png, .JPG, .JPEG, .PNG</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btnupdatephoto" class="btn btn-primary"><i
                            class="fa fa-edit"></i>&nbsp;Edit Photo</button>
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
            url: "<?php echo roothtml.'item/item_action.php' ?>",
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

    $("#frmsaveitem1").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var iname = $("#iname1").val();
        var icategory = $("#icategory1").val();
        var iprice = $("#iprice1").val();
        if (iname == '' || iprice == '' || icategory == '') {
            swal("Information", "Please fill all data.", "info");
            return false;
        }
        $("#addNewItem").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'item/item_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "wrongtype") {
                    swal("Information!", "Your file is wrong type.", "info");
                }
                if (data == "success") {
                    swal("Successful!", "Save data is successfully.", "success");
                    $("#frmsaveitem1")[0].reset();
                    load_pag();
                }
                if (data == "fail") {
                    swal("Error!", "Save data is failed.", "error");
                }
            }
        });
    });

    $(document).on("click", "#btnedit", function() {
        var aid = $(this).data("aid");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'item/item_action.php' ?>",
            data: {
                action: 'prepare',
                aid: aid
            },
            success: function(data) {
                $("#frmedititem").html(data);
                $("#editItem").modal("show");
            }
        });
    });

    $(document).on("click", "#btneditsave", function(e) {
        e.preventDefault();
        $("#editItem").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'item/item_action.php' ?>",
            data: $("#frmedititem").serialize() + "&action=edit",
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
        var path = $(this).data("path");
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
                    url: "<?php echo roothtml.'item/item_action.php'; ?>",
                    data: {
                        action: 'delete',
                        aid: aid,
                        path: path
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

    $(document).on("click", "#btnchangephoto", function() {
        var aid = $(this).data("aid");
        var img = $(this).data("img");

        var path = "";
        if (img == '') {
            path = "<?php echo roothtml.'lib/upload/noimage.jpg' ?>";
        } else {
            path = "<?php echo roothtml.'lib/upload/item_images/' ?>" + img;
        }
        $('#showimg').attr('src', path);
        $("[name='paid']").val(aid);
        $("[name='pimg']").val(img);

        $("#photomodal").modal("show");

    });

    $("#frmphoto").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var img = $("#ifile2").val();
        if (img == '') {
            swal("Information", "Please choose photo.", "info");
            return false;
        }
        $("#photomodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'item/item_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "wrongtype") {
                    swal("Information!", "Your file is wrong type.", "info");
                }
                if (data == "success") {
                    swal("Successful!", "Save data is successfully.", "success");
                    $("#frmphoto")[0].reset();
                    load_pag();
                }
                if (data == "fail") {
                    swal("Error!", "Save data is failed.", "error");
                }
            }
        });
    });


});
</script>