<?php
include('../config.php');
include(root.'master/header.php');
?>

<div id="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="<?php echo roothtml.'home/home.php' ?>">Home</a>
        </li>
        <li class="breadcrumb-item active">User Control</li>
    </ol>
            <!-- Page Content -->
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
        <i class="fa fa-table"></i>
        User Control

        <form method="POST" action="usercontrol_action.php" class="float-right">
            <input type="hidden" name="hid">
            <input type="hidden" name="ser">
            <a href="#" class="text-white" id="btnnew">
                <span class="float-right">
                <i class="fa fa-plus"></i>
                Add New User Control
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
                                        <label for="inputEmail3" class="col-sm-6 col-form-label">Show</label>
                                        <div class="col-sm-6">
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
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Search</label>
                                        <div class="col-sm-9">
                                            <input type="search" class="form-control" id="searching"
                                                placeholder="Search by username or usertype">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div class="table-wrap">
                            <div id="show_table" class="table-responsive">

                            </div>
                        </div>
        
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    </div>
    <br><br><br>

    <!-- Add User Control-->
    <div class="modal fade" id="newmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-ml" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="exampleModalLabel">
                <i class="fa fa-tags"></i>
                Add User Control
              </h5>
              <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form class="">
              <div class="modal-body">
                <div class="form-group">
                  <label for="">User Name</label>
                  <input type="text" class="form-control" name="username" value="" placeholder="Enter User Name..." required>
                 
                </div>
                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" class="form-control" name="password" value="" placeholder="Enter Password..." required>
                 
                </div>
                <div class="form-group">
                  <label for="">Confirm Password</label>
                  <input type="password" class="form-control" name="compassword" value="" placeholder="Enter Password..." required>
                  
                </div>
                <div class="form-group">
                  <label>User Type</label>
                  <select class="form-control text-primary" name="usertype" required>
                    <option disabled selected value=""><sub>Please select User Type</sub></option>
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                  </select>                 
                </div>
                
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" id="btnsave" value="Add User Control">
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Add Product Type-->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-ml" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="exampleModalLabel">
                <i class="fa fa-tags"></i>
                Edit User Control
              </h5>
              <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form class="">
              <div class="modal-body">
                <div class="form-group">
                  <label for="">User Name</label>
                  <input type="text" class="form-control" name="username1" value="" placeholder="Enter User Name..." required>
                 
                </div>
                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" class="form-control" name="password1" value="" placeholder="Enter Password..." required>
                 
                </div>
                <div class="form-group">
                  <label for="">Confirm Password</label>
                  <input type="password" class="form-control" name="compassword1" value="" placeholder="Enter Password..." required>
                  
                </div>
                <div class="form-group">
                  <label>User Type</label>
                  <select class="form-control text-primary" name="usertype1" required>
                    <option disabled selected value=""><sub>Please select User Type</sub></option>
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                  </select>                 
                </div>
                
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" id="btneditsave" value="Edit User Control">
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
        url: "<?php echo roothtml.'usercontrol/usercontrol_action.php' ?>",
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

$(document).on("click", "#btnnew", function() {
    $("#newmodal").modal("show");
});

$(document).on("click", "#btnsave", function(e) {
    e.preventDefault();
    var username = $("[name='username']").val();
    var password = $("[name='password']").val();
    var compassword = $("[name='compassword']").val();
    var usertype = $("[name='usertype']").val();

    if (password != compassword) {
        swal("Error", "Password and Confirm password is not match.", "error");
        return false;
    }

    if (username == '' || usertype == '' || password == "") {
        swal("Error", "Please Fill Data.", "error");
        return false;
    }
    $("#newmodal").modal("hide");
    $.ajax({
        type: "post",
        url: "<?php echo roothtml.'usercontrol/usercontrol_action.php' ?>",
        data: {
            action: 'save',
            username: username,
            password: password,
            usertype: usertype
        },
        success: function(data) {
            if (data == 1) {
                swal("Successful", "save data success.", "success");
                load_pag();
            } else {
                swal("Error", "Error Save.", "error");
            }

        }
    });

});

$(document).on("click", "#btnedit", function() {
    var aid = $(this).data("aid");
    var username = $(this).data("username");
    var password = $(this).data("password");
    var usertype = $(this).data("usertype");
    $("[name='aid'").val(aid);
    $("[name='username1'").val(username);
    $("[name='password1'").val(password);
    $("[name='compassword1'").val(password);
    $("[name='usertype1'").val(usertype);
    $("#editmodal").modal("show");
});

$(document).on("click", "#btneditsave", function() {
    var aid = $("[name='aid']").val();
    var username = $("[name='username1']").val();
    var password = $("[name='password1']").val();
    var compassword = $("[name='compassword1']").val();
    var usertype = $("[name='usertype1']").val();
    if (password != compassword) {
        swal("Error", "Password and Confirm password is not match.", "error");
        return false;
    }

    if (username == '' || usertype == '') {
        swal("Error", "Please Fill Data.", "error");
        return false;
    }

    $("#editmodal").modal("hide");
    $.ajax({
        type: "post",
        url: "<?php echo roothtml.'usercontrol/usercontrol_action.php' ?>",
        data: {
            action: 'edit',
            aid: aid,
            username: username,
            password: password,
            usertype: usertype
        },
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
                url: "<?php echo roothtml.'usercontrol/usercontrol_action.php'; ?>",
                data: {
                    action: 'delete',
                    aid: aid
                },
                beforeSend: function() {
                    $(".loader").show();
                },
                success: function(data) {
                    $(".loader").hide();
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