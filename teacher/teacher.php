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
            <li class="breadcrumb-item active">Teacher</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <i class="fa fa-table"></i>
                Teacher

                <form method="POST" action="teacher_action.php" class="float-right">
                    <input type="hidden" name="hid">
                    <input type="hidden" name="ser">
                    <a href="#" class="text-white" data-toggle="modal" data-target="#addNewTeacher">
                        <span class="float-right">
                            <i class="fa fa-plus"></i>
                            Add New Teacher
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
<div class="modal fade" id="addNewTeacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-plus"></i>
                    Add New Teacher
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmsaveteacher1" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <div class="modal-body row">
                    <div class="form-group col-md-4">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="tname" placeholder="Enter Name..." required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Father's Name</label>
                        <input type="text" class="form-control" name="tfname" placeholder="Enter Father Name..."
                            required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Date of Birth</label>
                        <input type="date" class="form-control" name="tdob" placeholder="အမည်..."
                            value="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">NRC</label>
                        <input type="text" required class="form-control" name="tnrc" required placeholder="Enter NRC...">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Gender</label>
                        <select class="form-control text-primary" required name="tgender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Height</label>
                        <input type="text" class="form-control" name="theight" placeholder="Enter Height..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Marital Status</label>
                        <select class="form-control text-primary" name="tmaritial">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Nationality</label>
                        <input type="text" class="form-control" name="tnation" placeholder="Enter Nationality..."
                            >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Religion</label>
                        <input type="text" class="form-control" name="treligion" placeholder="Enter Religion..."
                            >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Education</label>
                        <input type="text" class="form-control" name="teducation" placeholder="Enter Education..."
                            >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Other Qualification</label>
                        <input type="text" class="form-control" name="tother" placeholder="Enter Other Qualification..."
                            >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Teaching Experience</label>
                        <input type="text" class="form-control" name="texperience" placeholder="Enter Experience..."
                            >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Phone No</label>
                        <input type="text" class="form-control" name="tphno" placeholder="Enter Phone No..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="temail" placeholder="Enter Email..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="taddress" placeholder="Enter Address..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Remark</label>
                        <input type="text" class="form-control" name="trmk" placeholder="Enter Remark..." >
                    </div>
                    <div class="form-group col-md-8">
                        <label for="usr"> Photo </label>
                        <div class="border border-primary p-1">
                            <input type="file" id="tfile1" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" name="tfile1">
                        </div>
                        <span>File must be : .jpg, .jpeg, .png, .JPG, .JPEG, .PNG</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btnsaveteacher" class="btn btn-primary"><i
                            class="fa fa-save"></i>&nbsp;Add New Teacher</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editTeacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-edit"></i>
                    Edit Teacher
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmeditteacher">

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
                    Edit Teacher Photo
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
                            <input type="file" id="tfile2" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" name="tfile2">
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


<div class="modal fade" id="reportmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-print"></i>
                    Report Teacher
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
                    <button type="submit" id="btnprintteacher" class="btn btn-primary"><i
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
            url: "<?php echo roothtml.'teacher/teacher_action.php' ?>",
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

    $("#frmsaveteacher1").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var tname = $("[name='tname']").val();
        if (tname == '') {
            swal("Information", "Please fill all data.", "info");
            return false;
        }
        $("#addNewTeacher").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'teacher/teacher_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "wrongtype") {
                    swal("Information!", "Your file is wrong type.", "info");
                }
                if (data == "success") {
                    swal("Successful!", "Save data is successfully.", "success");
                    $("#frmsaveteacher1")[0].reset();
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
            url: "<?php echo roothtml.'teacher/teacher_action.php' ?>",
            data: {
                action: 'prepare',
                aid: aid
            },
            success: function(data) {
                $("#frmeditteacher").html(data);
                $("#editTeacher").modal("show");
            }
        });
    });

    $(document).on("click", "#btneditsave", function(e) {
        e.preventDefault();
        var tname = $("[name='etname']").val();
        if (tname == '') {
            swal("Information", "Please fill all data.", "info");
            return false;
        }
        $("#editTeacher").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'teacher/teacher_action.php' ?>",
            data: $("#frmeditteacher").serialize() + "&action=edit",
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
                    url: "<?php echo roothtml.'teacher/teacher_action.php'; ?>",
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
            path = "<?php echo roothtml.'lib/upload/teacher_images/' ?>" + img;
        }
        $('#showimg').attr('src', path);
        $("[name='paid']").val(aid);
        $("[name='pimg']").val(img);

        $("#photomodal").modal("show");

    });

    $("#frmphoto").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var img = $("#tfile2").val();
        if (img == '') {
            swal("Information", "Please choose photo.", "info");
            return false;
        }
        $("#photomodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'teacher/teacher_action.php' ?>",
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

    $(document).on("click", "#btnreport", function() {
        var aid = $(this).data("aid");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'teacher/teacher_action.php' ?>",
            data: {
                action: 'report',
                aid: aid
            },
            success: function(data) {
                $("#display").html(data);
                $("#reportmodal").modal("show");
            }
        });
    });

    $(document).on("click", "#btnprintteacher", function() {
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


});
</script>