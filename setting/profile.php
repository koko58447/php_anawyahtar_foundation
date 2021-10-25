<?php
include('../config.php');
include(root.'master/header.php');
?>

<style>
.pass_show {
    position: relative
}

.pass_show .ptxt {

    position: absolute;

    top: 50%;

    right: 10px;

    z-index: 1;

    color: #f36c01;

    margin-top: -10px;

    cursor: pointer;

    transition: .3s ease all;

}

.pass_show .ptxt:hover {
    color: #333333;
}
</style>


<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo roothtml.'home/home.php' ?>">Home</a>
            </li>
            <li class="breadcrumb-item active">Profile / Change Password</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
            <div class="col-md-7 col-sm-12 col-xs-12 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-header">
                        <h1>Profile / Change Password</h1>
                    </div>
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-eye"></i>
                        </div>
                        <form id="frm">
                        <div class="card-text">
                            <div class="form-group">
                                <label for="">User Name</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username'] ?>"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="">User Type</label>
                                <input type="text" class="form-control" name="usertype" value="<?php echo $_SESSION['usertype'] ?>"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Current Password</label>
                                <div class="form-group pass_show">
                                <input type="password" class="form-control" name="password" value="<?php echo $_SESSION['password'] ?>"
                                    readonly>
                                </div>
                            </div>
                            <div class="form-group">
                            <label>New Password</label>
                                        <div class="form-group pass_show">
                                            <input type="password" class="form-control" name="newpassword"
                                                placeholder="New Password">
                                        </div>
                            </div>
                            <div class="form-group">
                            <label>New Password</label>
                                        <div class="form-group pass_show">
                                        <input type="password" class="form-control" name="confirmpassword"
                                                placeholder="Confirm Password">
                                        </div>
                            </div>                           
                            <button class="btn btn-primary" id="btnchangepassword"><i class='fa fa-pencil'></i> Change Password</button>
                           
                        </div>                       
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
        <br>
<?php include(root.'master/footer.php'); ?>

<script>
$(document).ready(function() {
    $('.pass_show').append('<span class="ptxt">Show</span>');

    $(document).on('click', '.pass_show .ptxt', function() {

        $(this).text($(this).text() == "Show" ? "Hide" : "Show");

        $(this).prev().attr('type', function(index, attr) {
            return attr == 'password' ? 'text' : 'password';
        });

    });


    $(document).on("click", "#btnchangepassword", function(e) {
        var newpassword = $("[name='newpassword']").val();
        var confirmpassword = $("[name='confirmpassword']").val();
        if (newpassword != confirmpassword) {
            swal("Error!", "New Password and Confirm Passwod not match.", "error");
            return false;
        }
        if (newpassword == '' || confirmpassword == '') {
            swal("Error!", "Please Fill Data.", "error");
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'usercontrol/usercontrol_action.php' ?>",
            data: $("#frm").serialize() + "&action=changepassword",
            success: function(data) {               
                if (data == 1) {
                    swal("Successful!", "Change Password Successful.",
                        "success");
                    location.href =
                        "<?php echo roothtml.'setting/profile.php' ?>";

                }
            }
        });
    });

});
</script>