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
        <li class="breadcrumb-item active">Donar</li>
    </ol>
            <!-- Page Content -->
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
        <i class="fa fa-table"></i>
        Donar
        <form method="POST" action="donater_action.php" class="float-right">
            <input type="hidden" name="hid">
            <input type="hidden" name="ser">
            <a href="#" class="text-white" id="btnnew">
                <span class="float-right">
                <i class="fa fa-plus"></i>
                Add New Donar
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
                                  placeholder="Search .... ">
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

    <!-- Add User Control-->
    <div class="modal fade" id="newmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-ml" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="exampleModalLabel">
                <i class="fa fa-tags"></i>
                Add Donar
              </h5>
              <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form class="" id="frmdonate" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                <input type="hidden" name="action" value="save">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name" value="" placeholder="Enter Name..." required>
                 
                </div>
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" class="form-control" name="email" value="" placeholder="Enter email..." required>
                 
                </div>
                <div class="form-group">
                  <label for="">Phone No</label>
                  <input type="text" class="form-control" name="phno" value="" placeholder="Enter Phone Number..." required>
                  
                </div>
                <div class="form-group">
                  <label>Gender</label>
                  <select class="form-control text-primary" name="gender" required>
                    <option disabled selected value=""><sub>Please select Gender</sub></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>                 
                </div>
                <div class="form-group">
                  <label for="">Address</label>
                  <input type="text" class="form-control" name="address" value="" placeholder="Enter Address..." required>
                  
                </div>
                <div class="form-group">
                  <label for="">Image </label>
                  <input type="file" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" class="form-control" name="file" >
                  
                </div>
                
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" value="Add Donar">
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
                Edit Donar
              </h5>
              <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form class="" id="frmedit">
                              
            </form>
          </div>
        </div>
      </div>

       <!-- Add Product Type-->
    <div class="modal fade" id="imgmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-ml" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="exampleModalLabel">
                <i class="fa fa-tags"></i>
                Change Image
              </h5>
              <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form class="" id="frmfileedit" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                <input type="hidden" name="action" value="fileupdate">              
                <input type='hidden' name='aid1' />
                <div class="form-group">
                  <label for="">Old Image</label>
                  <input type="text" class="form-control" name="oldpath" value="" placeholder="">
                  
                </div>
                <div class="form-group">
                  <label for="">Image </label>
                  <input type="file" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" class="form-control" name="file1" >
                  
                </div>
                
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" value="Change Image">
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
        url: "<?php echo roothtml.'donater/donater_action.php' ?>",
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
    $("#frmdonate")[0].reset();
    $("#newmodal").modal("show");
});

$("#frmdonate").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var name = $("[name='name']").val();
        var email = $("[name='email']").val();      
        if (name == '' || email == '') {
            swal("Error!", "Please Fill Data.",
                        "error");
            return false;
        }
        $("#newmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'donater/donater_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "success") {
                    swal("Successful!", "Save data Successful.",
                        "success");
                    load_pag();
                }
                if (data == "fail") {
                    swal("Error!", "Error Save.", "error");
                }
                if (data == "wrongtype") {
                    swal("Warning!", "Your file must be .png, jpg, .jpeg, .PNG !",
                        "warning");
                }
            }
        });
});

$(document).on("click", "#btnedit", function() {
    var aid = $(this).data("aid"); 
    $.ajax({
        type: "post",
        url: "<?php echo roothtml.'donater/donater_action.php' ?>",
        data: {
            action: 'editprepare',
            aid: aid
           
        },
        success: function(data) {

          $("#frmedit").html(data);
          $("#editmodal").modal("show");
            
        }
    });   
   
});


$("#frmedit").on("submit", function(e) {
    e.preventDefault();       
    var name = $("[name='name1']").val();
    var email = $("[name='email1']").val();      
    if (name == '' || email == '') {
        swal("Error!", "Please Fill Data.",
                    "error");
        return false;
    }
    $("#editmodal").modal("hide");
    $.ajax({
        type: "post",
        url: "<?php echo roothtml.'donater/donater_action.php' ?>",
        data: $("#frmedit").serialize(),
        success: function(data) {
            if (data == 1) {
                swal("Successful!", "Save data Successful.",
                    "success");
                load_pag();
            }else{
                swal("Error!", "Error Save.", "error");
            }               
        }
    });
});


$(document).on("click", "#btndelete", function(e) {
    e.preventDefault();
    var aid = $(this).data("aid");
    var img = $(this).data("img");
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
                url: "<?php echo roothtml.'donater/donater_action.php'; ?>",
                data: {
                    action: 'delete',
                    aid: aid,
                    img: img
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

$(document).on("click", "#btnfile", function(e) {

  var aid = $(this).data("aid");
  var img = $(this).data("img");
  $("[name='aid1']").val(aid);
  $("[name='oldpath']").val(img);
  $("#imgmodal").modal("show");

});

$("#frmfileedit").on("submit", function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  $("#imgmodal").modal("hide");
  $.ajax({
      type: "post",
      url: "<?php echo roothtml.'donater/donater_action.php' ?>",
      data: formData,
      contentType: false,
      processData: false,
      success: function(data) {
          if (data == "nofile") {
              swal("Information!", "Please select file.", "info");
          }
          if (data == "wrongtype") {
              swal("Warning!", "Your file must be .png, .jpeg, .jpg!",
                  "warning");
          }
          if (data == "success") {
              swal("Successful!", "Update file success.", "success");
              $("#frmfileedit")[0].reset();
              load_pag();
          }
          if (data == "fail") {
              swal("Error!", "Update file failed.", "error");
          }
      }
  });
});


});
</script>