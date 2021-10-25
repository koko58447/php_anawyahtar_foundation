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
    <link href="<?php echo roothtml.'lib/css/bootstrap.css' ?>" rel="stylesheet">
    <link href="<?php echo roothtml.'lib/css/font-awesome.css' ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo roothtml.'lib/css/styles.css' ?>" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo roothtml.'lib/images/logo.jpg' ?>">
  </head> 
  <body class="bg-dark">
      <div class="container">
        <div class="card card-login mx-auto mt-5">
          <div class="card-header bg-danger text-white">Error Page</div>
          <div class="card-body">
            <div class="text-center mb-4">
              <h4>Error Page</h4>
              <p>Please first login.</p>
            </div>
            <form>              
              <a class="btn btn-primary btn-block" href="<?php echo roothtml.'index.php' ?>">Login ဝင်ရန်</a>
            </form>
            <hr>
            <div class="text-center">
              <br>
              <a class="d-block small" href="<?php echo roothtml.'index.php' ?>">Go to Login Page</a>
              <br>
              OR
              <a class="d-block small mt-3" target="_blank" href="https://kyoungunity.com/">Contact developers</a>
            </div>
          </div>
        </div>
      </div>
      <script src="<?php echo roothtml.'lib/js/jquery.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/bootstrap.bundle.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/js/jquery.easing.min.js' ?>"></script>
    <script>

    </script>
  </body>
</html>
