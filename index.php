<!-- 
 RC-PoS (https://appzaib.com/rc-pos)
 Copyright 2013-2018 BlackRock Digital, LLC, 2018 Vruqa Designs, 2018 Appzaib
 Licensed under MIT (https://github.com/appzaib/rc-pos/blob/master/LICENSE)
-->

<?php 
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Anawrahta Shwe Tharmanay School</title>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo roothtml.'lib/images/logo.jpg' ?>">
    <link href="<?php echo roothtml.'lib/css/bootstrap.css' ?>" rel="stylesheet">
    <link href="<?php echo roothtml.'lib/css/font-awesome.css' ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo roothtml.'lib/css/styles.css' ?>" rel="stylesheet">

    <link href="<?php echo roothtml.'lib/sweet/sweetalert.css' ?>" rel="stylesheet" />
    <script src="<?php echo roothtml.'lib/sweet/sweetalert.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/sweet/sweetalert.js' ?>"></script>   

    <style>
    #logo {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo roothtml.'lib/images/index.jpg' ?>');
        /* Used if the image is unavailable */
        height: 550px;
        /* You must set a specified height */
        background-position: center;
        /* Center the image */
        background-repeat: no-repeat;
        /* Do not repeat the image */
        background-size: cover;
        /* Resize the background image to cover the entire container */

    }

    .loader {
        position: fixed;
        z-index: 999;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background-color: Black;
        filter: alpha(opacity=60);
        opacity: 0.7;
        -moz-opacity: 0.8;
    }

    .center-load {
        z-index: 1000;
        margin: 300px auto;
        padding: 10px;
        width: 130px;
        background-color: black;
        border-radius: 10px;
        filter: 1;
        -moz-opacity: 1;
    }

    .center-load img {
        height: 128px;
        width: 128px;
    }
    </style>

  </head>
  
  <body class="bg-dark" style="background-image:url(<?php echo roothtml.'lib/images/anh.jpg' ?>);background-size: cover;background-position: center;">
    <div class="container">
    <br><br><br>
      <div class="card card-login mx-auto mt-5">
        <div class="card-header bg-primary text-white text-center">Login to your account</div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="username" value=" " name="username" class="form-control" placeholder="username" required="required" autofocus="autofocus">
                <label for="username">Enter username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" value=" " name="password" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>            
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div>
            <input type='submit' class="btn btn-primary btn-block" href="#" id="btnlogin" value='login' />
          </form>
          <div class="text-center">
            <br>
            <a class="d-block small" href="<?php echo roothtml.'forgot-password.php' ?>">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

    <div class="loader" style="display:none;">
            <div class="center-load">
                <img src="<?php echo roothtml.'lib/images/ajax-loader1.gif'; ?>" />
            </div>
    </div>

    <script src="<?php echo roothtml.'lib/js/jquery.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/bootstrap.bundle.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/jquery.easing.min.js' ?>"></script>
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


    $(document).on("click", "#btnlogin", function(e) {
        e.preventDefault();
        var username = $("[name='username']").val();
        var password = $("[name='password']").val();
        var dept = $("[name='dept']").val();

        if (username == '' || password == '' || dept == '') {
            swal("error!",
                "Please Fill Data.",
                "error");


        } else {

            $.ajax({
                type: "post",
                url: "<?php echo roothtml.'index_action.php' ?>",
                data: {
                    action: 'login',
                    username: username,
                    password: password,
                    dept: dept
                },
                success: function(data) {
                   
                    if (data == 1) {
                        swal("Successful!",
                            "Login Successful.",
                            "success");
                        location.href ="<?php echo roothtml.'home/home.php' ?>";

                    } else {

                        swal("Error!",
                            "User Name or Password incorrect.",
                            "error");

                    }

                }
            });

        }

       

    });


    </script>
  </body>
</html>


