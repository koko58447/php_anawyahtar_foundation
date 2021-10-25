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
            <li class="breadcrumb-item active">Student</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <i class="fa fa-table"></i>
                Student

                <form method="POST" action="student_action.php" class="float-right">
                    <input type="hidden" name="hid">
                    <input type="hidden" name="ser">
                    <a href="#" class="text-white" data-toggle="modal" data-target="#addNewStudent">
                        <span class="float-right">
                            <i class="fa fa-plus"></i>
                            Add New Student
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
<div class="modal fade" id="addNewStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-plus"></i>
                    Add New Student
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmsavestudent1" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <div class="modal-body row">
                    <div class="form-group col-md-4">
                        <label for="">ကျောင်းဝင်အမှတ်(ကျောင်းမှဖြည့်ရန်)</label>
                        <input type="text" class="form-control" name="sno" placeholder="ကျောင်းဝင်အမှတ်..." required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">ကျောင်းဝင်ရက်စွဲ</label>
                        <input type="date" class="form-control" name="sdate" placeholder="ကျောင်းဝင်ရက်စွဲ..." required
                            value="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">အမည်</label>
                        <input type="text" class="form-control" name="sname" placeholder="အမည်..." required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">မွေးသက္ကရာဇ်</label>
                        <input type="date" class="form-control" name="sdob" required
                            value="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">အဖအမည်</label>
                        <input type="text" class="form-control" name="fname" placeholder="အဖအမည်..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">အလုပ်အကိုင်</label>
                        <input type="text" class="form-control" name="fwork" placeholder="အလုပ်အကိုင်..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">အမိအမည်</label>
                        <input type="text" class="form-control" name="mname" placeholder="အမိအမည်..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">အလုပ်အကိုင်</label>
                        <input type="text" class="form-control" name="mwork" placeholder="အလုပ်အကိုင်..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">ဆက်သွယ်ရန်လိပ်စာ</label>
                        <input type="text" class="form-control" name="caddress" placeholder="ဆက်သွယ်ရန်လိပ်စာ..."
                            >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">အမြဲနေရပ်လိပ်စာ</label>
                        <input type="text" class="form-control" name="raddress" placeholder="အမြဲနေရပ်လိပ်စာ..."
                            >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">လူမျိုး</label>
                        <input type="text" class="form-control" name="nation" placeholder="လူမျိုး..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">ကိုးကွယ်သည့်ဘာသာ</label>
                        <input type="text" class="form-control" name="religion" placeholder="ကိုးကွယ်သည့်ဘာသာ..."
                            >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">နောက်ဆုံးနေခဲ့သည့်ကျောင်း</label>
                        <input type="text" class="form-control" name="lastschool"
                            placeholder="နောက်ဆုံးနေခဲ့သည့်ကျောင်း..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">အမြင့်ဆုံးအောင်မြင်ခဲ့သည့်အတန်း</label>
                        <input type="text" class="form-control" name="maxgrade"
                            placeholder="အမြင့်ဆုံးအောင်မြင်ခဲ့သည့်အတန်း..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">ဝင်စတွင်ချထားသည့်အခန်း</label>
                        <input type="text" class="form-control" name="startgrade"
                            placeholder="ဝင်စတွင်ချထားသည့်အခန်း..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">တန်းခွဲ(ကျောင်းမှဖြည့်ရန်)</label>
                        <input type="text" class="form-control" name="grade" placeholder="တန်းခွဲ..." >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">အတန်းပိုင်အမည်(ကျောင်းမှဖြည့်ရန်)</label>
                        <input type="text" class="form-control" name="gteacher" placeholder="အတန်းပိုင်အမည်..."
                            >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">မှတ်ချက်</label>
                        <input type="text" class="form-control" name="rmk" placeholder="မှတ်ချက်..." >
                    </div>
                    <div class="form-group col-md-12">
                        <label for="usr"> ဓါတ်ပုံ </label>
                        <div class="border border-primary p-1">
                            <input type="file" id="file1" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" name="file1">
                        </div>
                        <span>File must be : .jpg, .jpeg, .png, .JPG, .JPEG, .PNG</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btnsavestudent" class="btn btn-primary"><i
                            class="fa fa-save"></i>&nbsp;Add New Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-edit"></i>
                    Edit Student
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmeditstudent">

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
                    Edit Student Photo
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmphoto" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="changephoto" >
                <input type="hidden" name="paid" >
                <input type="hidden" name="pimg" >
                <div class='modal-body'>
                    <div class='form-group'>
                        <label for='usr'> Old Photo :</label><br>
                        <img src='' id="showimg" style='width:100%;height:270px;' />
                    </div>
                    <div class="form-group">
                        <label for="usr"> Choose New Photo </label>
                        <div class="border border-primary p-1">
                            <input type="file" id="file2" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" name="file2">
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
                    Report Student
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
            url: "<?php echo roothtml.'student/student_action.php' ?>",
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

    $("#frmsavestudent1").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var sno = $("[name='sno']").val();
        var sname = $("[name='sname']").val();
        if (sno == '' || sname == '') {
            swal("Information", "Please fill all data.", "info");
            return false;
        }
        $("#addNewStudent").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'student/student_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "wrongtype") {
                    swal("Information!", "Your file is wrong type.", "info");
                }
                if (data == "success") {
                    swal("Successful!", "Save data is successfully.", "success");
                    $("#frmsavestudent1")[0].reset();
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
            url: "<?php echo roothtml.'student/student_action.php' ?>",
            data: {
                action: 'prepare',
                aid: aid
            },
            success: function(data) {
                $("#frmeditstudent").html(data);
                $("#editStudent").modal("show");
            }
        });
    });

    $(document).on("click", "#btneditsave", function(e) {
        e.preventDefault();
        var sno = $("[name='esno']").val();
        var sname = $("[name='esname']").val();
        if (sno == '' || sname == '') {
            swal("Information", "Please fill all data.", "info");
            return false;
        }
        $("#editStudent").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'student/student_action.php' ?>",
            data: $("#frmeditstudent").serialize() + "&action=edit",
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
                    url: "<?php echo roothtml.'student/student_action.php'; ?>",
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
            path = "<?php echo roothtml.'lib/upload/student_images/' ?>" + img;
        }
        $('#showimg').attr('src', path);
        $("[name='paid']").val(aid);
        $("[name='pimg']").val(img);

        $("#photomodal").modal("show");

    });

    $("#frmphoto").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var img = $("#file2").val();
        if (img == '') {
            swal("Information", "Please choose photo.", "info");
            return false;
        }
        $("#photomodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'student/student_action.php' ?>",
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
            url: "<?php echo roothtml.'student/student_action.php' ?>",
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