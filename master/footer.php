<br>
<!-- Sticky Footer -->
<footer class="sticky-footer">
            <div class="container my-auto">
              <div class="copyright text-center my-auto ">
                <br><br><br>
                <span>Created By &copy; 2020-2021 <a href="https://kyoungunity.com" target="_blank">Kyoung Unity Software Team.</a>All rights reserved.</span>
                <br><br><br>
              </div>
            </div>
</footer>
  </div>
</div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Modals -->
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" href="#" id="btnlogout">Logout</a>
          </div>
        </div>
      </div>
    </div>

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
                <input type="submit" class="btn btn-primary" id="btnsaveuc" value="Add User Control">
              </div>
            </form>
          </div>
        </div>
    </div>

    <!-- Add donater-->
    <div class="modal fade" id="donatermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form class="" id="frmdonate1" method="POST" enctype="multipart/form-data">
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

    <!-- Add Student -->
    <div class="modal fade" id="studentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form id="frmsavestudent" method="POST" enctype="multipart/form-data">
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
                  <input type="text" class="form-control" name="fname" placeholder="အဖအမည်..." required>                 
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
                  <input type="text" class="form-control" name="caddress" placeholder="ဆက်သွယ်ရန်လိပ်စာ..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">အမြဲနေရပ်လိပ်စာ</label>
                  <input type="text" class="form-control" name="raddress" placeholder="အမြဲနေရပ်လိပ်စာ..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">လူမျိုး</label>
                  <input type="text" class="form-control" name="nation" placeholder="လူမျိုး..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">ကိုးကွယ်သည့်ဘာသာ</label>
                  <input type="text" class="form-control" name="religion" placeholder="ကိုးကွယ်သည့်ဘာသာ..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">နောက်ဆုံးနေခဲ့သည့်ကျောင်း</label>
                  <input type="text" class="form-control" name="lastschool" placeholder="နောက်ဆုံးနေခဲ့သည့်ကျောင်း..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">အမြင့်ဆုံးအောင်မြင်ခဲ့သည့်အတန်း</label>
                  <input type="text" class="form-control" name="maxgrade" placeholder="အမြင့်ဆုံးအောင်မြင်ခဲ့သည့်အတန်း..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">ဝင်စတွင်ချထားသည့်အခန်း</label>
                  <input type="text" class="form-control" name="startgrade" placeholder="ဝင်စတွင်ချထားသည့်အခန်း..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">တန်းခွဲ(ကျောင်းမှဖြည့်ရန်)</label>
                  <input type="text" class="form-control" name="grade" placeholder="တန်းခွဲ..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">အတန်းပိုင်အမည်(ကျောင်းမှဖြည့်ရန်)</label>
                  <input type="text" class="form-control" name="gteacher" placeholder="အတန်းပိုင်အမည်..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">မှတ်ချက်</label>
                  <input type="text" class="form-control" name="rmk" placeholder="မှတ်ချက်..." >                 
                </div>
                <div class="form-group col-md-12">
                        <label for="usr"> ဓါတ်ပုံ </label>
                        <div class="border border-primary p-1">
                            <input type="file" id="file1" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG"  name="file1">
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


        <!-- Add Teacher -->
    <div class="modal fade" id="teachermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form id="frmsaveteacher" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="action" value="save">
              <div class="modal-body row">
                <div class="form-group col-md-4">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="tname" placeholder="Enter Name..." required>                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">Father's Name</label>
                  <input type="text" class="form-control" name="tfname" placeholder="Enter Father Name..." required 
                    >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">Date of Birth</label>
                  <input type="date" class="form-control" name="tdob" placeholder="အမည်..." 
                    value="<?php echo date('Y-m-d') ?>">                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">NRC</label>
                  <input type="text" class="form-control" name="tnrc" required placeholder="Enter NRC..." >                  
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
                  <input type="text" class="form-control" name="tnation" placeholder="Enter Nationality..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">Religion</label>
                  <input type="text" class="form-control" name="treligion" placeholder="Enter Religion..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">Education</label>
                  <input type="text" class="form-control" name="teducation" placeholder="Enter Education..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">Other Qualification</label>
                  <input type="text" class="form-control" name="tother" placeholder="Enter Other Qualification..." >                 
                </div>
                <div class="form-group col-md-4">
                  <label for="">Teaching Experience</label>
                  <input type="text" class="form-control" name="texperience" placeholder="Enter Experience..." >                 
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
                            <input type="file" id="tfile1" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG"  name="tfile1">
                        </div>
                        <span>File must be : .jpg, .jpeg, .png, .JPG, .JPEG, .PNG</span>
                    </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" id="btnsaveteacher" class="btn btn-primary"><i
                            class="fa fa-save"></i>&nbsp;Add New Student</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Add Category -->
    <div class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-ml" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="exampleModalLabel">
                <i class="fa fa-tags"></i>
                Add New Category
              </h5>
              <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form class="">
              <div class="modal-body">
                <div class="form-group">
                  <label for="">Category Name</label>
                  <input type="text" class="form-control" name="cname" value="" placeholder="Enter Category Name..." required>                 
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" id="btnsavecategory" value="Add New Category">
              </div>
            </form>
          </div>
        </div>
      </div>


       <!-- Add Item -->
    <div class="modal fade" id="itemmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-ml" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="exampleModalLabel">
                <i class="fa fa-tags"></i>
                Add New Item
              </h5>
              <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form id="frmsaveitem" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="action" value="save">
              <div class="modal-body">
                <div class="form-group">
                  <label for="">Item Name</label>
                  <input type="text" required class="form-control" name="iname" id="iname" value="" placeholder="Enter Item Name..." >                 
                </div>
                <div class="form-group">
                  <label for="">Price</label>
                  <input type="number" required class="form-control" name="iprice" id="iprice" value="" placeholder="Enter Price..." >                 
                </div>
                <div class="form-group">
                  <label for="">Date</label>
                  <input type="date" class="form-control" name="idate" id="idate" value="<?php echo date('Y-m-d') ?>">                 
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <select class="form-control text-primary" required name="icategory" id="icategory">
                    <option value=""><sub>Please select Category</sub></option>
                    <?php echo load_category() ?>
                  </select>                 
                </div>
                <div class="form-group">
                  <label for="usr"> Image </label>
                  <div class="border border-primary p-1">
                      <input type="file" id="ifile1" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG"  name="ifile1">
                  </div>
                  <span>File must be : .jpg, .jpeg, .png, .JPG, .JPEG, .PNG</span>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" id="btnsaveitem" value="Add New Item">
              </div>
            </form>
          </div>
        </div>
      </div>


         
   
    <script src="<?php echo roothtml.'lib/js/jquery.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/bootstrap.bundle.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/jquery.easing.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/chart.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/rc-pos.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/chart-area-demo.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/jquery.dataTables.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/dataTables.bootstrap4.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/datatables-demo.js' ?>"></script>

     <!-- Print -->
     <script src="<?php echo roothtml.'lib/printThis.js' ?>"></script>
    
    <script>

        $(document).ajaxStart(function() {
            $(".loader").show();
        });

        $(document).ajaxComplete(function() {
            $(".loader").hide();

        });

        $(document).ajaxError(function() {
            swal('error', 'Ajax Error', 'error');

        });

        $(document).on("click", "#btnlogout", function(e) {        

            $.ajax({
                type: "post",
                url: "<?php echo roothtml.'index_action.php' ?>",
                data: {
                        action: 'logout'
                },
                success: function(data) {

                        if (data == 1) {
                            location.href ="<?php echo roothtml.'index.php' ?>";
                        }

                }
            });
        });

        $(document).on("click", "#btnnew", function() {
            $("#newmodal").modal("show");
        });

        $(document).on("click", "#btnsaveuc", function(e) {
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
                      } else {
                          swal("Error", "Error Save.", "error");
                      }

                  }
              });

          });

$(document).on("click", "#btnnewdonater", function() {
    $("#frmdonate1")[0].reset();
    $("#donatermodal").modal("show");
});

$("#frmdonate1").on("submit", function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  var name = $("[name='name']").val();
  var email = $("[name='email']").val();      
  if (name == '' || email == '') {
      swal("Error!", "Please Fill Data.",
                  "error");
      return false;
  }
  $("#donatermodal").modal("hide");
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

$(document).on("click", "#btnnewstudent", function() {
            $("#studentmodal").modal("show");
        });

        $("#frmsavestudent").on("submit", function(e) {
          e.preventDefault();
          var formData = new FormData(this);
          var sno = $("[name='sno']").val();
          var sname = $("[name='sname']").val();
          // if (sno == '' || sname == '') {
          //     swal("Information", "Please fill all data.", "info");
          //     return false;
          // }
          $("#studentmodal").modal("hide");
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
                      $("#frmsavestudent")[0].reset();
                  }
                  if (data == "fail") {
                      swal("Error!", "Save data is failed.", "error");
                  }
              }
          });
        });


        $(document).on("click", "#btnnewteacher", function() {
            $("#teachermodal").modal("show");
        });

        $("#frmsaveteacher").on("submit", function(e) {
          e.preventDefault();
          var formData = new FormData(this);
          var tname = $("[name='tname']").val();
          // if (tname == '') {
          //     swal("Information", "Please fill all data.", "info");
          //     return false;
          // }
          $("#teachermodal").modal("hide");
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
                      $("#frmsaveteacher")[0].reset();
                  }
                  if (data == "fail") {
                      swal("Error!", "Save data is failed.", "error");
                  }
              }
          });
        });

        $(document).on("click", "#btnnewcategory", function() {
            $("#categorymodal").modal("show");
        });

        $(document).on("click", "#btnsavecategory", function(e) {  
          e.preventDefault(); 
          var catname = $("[name='cname']").val();
          if (catname == '') {
              swal("Information", "Please fill all data.", "info");
              return false;
          }
          $("#categorymodal").modal("hide");
          $.ajax({
              type: "post",
              url: "<?php echo roothtml.'item/category_action.php' ?>",
              data: {
                      action: 'save',
                      catname: catname
              },
              success: function(data) {
                if (data == 1) {
                      swal("Successful!", "Save data is successfully.", "success");
                }else {
                    swal("Error!", "Save data is failed.", "error");
                }
              }
          });
        });


        $(document).on("click", "#btnnewitem", function() {
            $("#itemmodal").modal("show");
        });

        $("#frmsaveitem").on("submit", function(e) {
          e.preventDefault();
          var formData = new FormData(this);
          var iname = $("#iname").val();
          var icategory = $("#icategory").val();
          var iprice = $("#iprice").val();
          
          if (iname == '' || iprice=='' || icategory=='') {
              swal("Information", "Please fill all data.", "info");
              return false;
          }
          $("#itemmodal").modal("hide");
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
                      $("#frmsaveitem")[0].reset();
                  }
                  if (data == "fail") {
                      swal("Error!", "Save data is failed.", "error");
                  }
              }
          });
        });

                    

    </script>
  </body>
</html>
