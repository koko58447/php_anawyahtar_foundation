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
            <li class="breadcrumb-item active">Overview</li>
          </ol>
          <!-- Icon Cards-->
          <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-header">
                  <h1>ပင်မအလှူရှင်</h1>
                  <small class="float-left">Last two weeks</small>
                </div>
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-money"></i>
                  </div>
                  <div class="card-text">
                    <p class="text-center"><strong>ပင်မအလှူရှင် ဆိုသည်မှာ ...</strong></p>
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo roothtml.'home/readmore.php' ?>">
                  <span class="float-left">Read More </span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-header">
                  <h1>အထူးအလှူရှင်</h1>
                  <small class="float-left">Last two weeks</small>
                </div>
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-flash"></i>
                  </div>
                  <div class="card-text">
                    <p class="text-center"><strong>အထူးအလှူရှင် ဆိုသည်မှာ ....</strong></p>
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo roothtml.'home/readmore.php' ?>">
                  <span class="float-left">Read More </span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
              <div class="card text-white bg-dark o-hidden h-100">
                <div class="card-header">
                  <h1>နဝကမအလှူရှင်</h1>
                  <small class="float-left">Last two weeks</small>
                </div>
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-tags"></i>
                  </div>
                  <div class="card-text">
                    <p class="text-center"><strong>နဝကမအလှူရှင် ဆိုသည်မှာ ....</strong></p>
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo roothtml.'home/readmore.php' ?>">
                  <span class="float-left">Read More </span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-header">
                  <h1>အမွေခံအလှူ</h1>
                  <small class="float-left">Last two weeks</small>
                </div>
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="card-text">
                    <p class="text-center"><strong>အမွေခံအလှူ ဆိုသည်မှာ ....</strong></p>
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo roothtml.'home/readmore.php' ?>">
                  <span class="float-left">Read More </span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-header">
                  <h1>သာသနပြုမိသားစုအလှူ</h1>
                  <small class="float-left">Last two weeks</small>
                </div>
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-money"></i>
                  </div>
                  <div class="card-text">
                    <p class="text-center"><strong>သာသနပြုမိသားစုအလှူ ဆိုသည်မှာ ...</strong></p>
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo roothtml.'home/readmore.php' ?>">
                  <span class="float-left">Read More </span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-header">
                  <h1>ရွှေသာမနေအလှူ</h1>
                  <small class="float-left">Last two weeks</small>
                </div>
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-flash"></i>
                  </div>
                  <div class="card-text">
                    <p class="text-center"><strong>ရွှေသာမနေအလှူ ဆိုသည်မှာ ....</strong></p>
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo roothtml.'home/readmore.php' ?>">
                  <span class="float-left">Read More </span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <!-- Area Chart Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-chart-area"></i>
              Photo School Activity</div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                  <div class="card text-white bg-primary o-hidden h-100">
                    <img src="<?php echo roothtml.'lib/images/anh.jpg' ?>" style="width:100%" />
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                  <div class="card text-white bg-primary o-hidden h-100">
                    <img src="<?php echo roothtml.'lib/images/anh1.jpg' ?>" style="width:100%" />
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                  <div class="card text-white bg-primary o-hidden h-100">
                    <img src="<?php echo roothtml.'lib/images/anh2.jpg' ?>" style="width:100%" />
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                  <div class="card text-white bg-primary o-hidden h-100">
                    <img src="<?php echo roothtml.'lib/images/logo.jpg' ?>" style="width:100%" />
                  </div>
                </div>

              </div>
            
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-chart-area"></i>
              အလှူရှင်များ မှတ်တမ်း</div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                  <div class="card text-white bg-primary o-hidden h-100">
                    <img src="<?php echo roothtml.'lib/images/user1.jpg' ?>" style="width:100%" />
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                  <div class="card text-white bg-primary o-hidden h-100">
                    <img src="<?php echo roothtml.'lib/images/user2.jpg' ?>" style="width:100%" />
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                  <div class="card text-white bg-primary o-hidden h-100">
                    <img src="<?php echo roothtml.'lib/images/user3.jpg' ?>" style="width:100%" />
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                  <div class="card text-white bg-primary o-hidden h-100">
                    <img src="<?php echo roothtml.'lib/images/user4.jpg' ?>" style="width:100%" />
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                  <div class="card text-white bg-primary o-hidden h-100">
                    <img src="<?php echo roothtml.'lib/images/user5.jpg' ?>" style="width:100%" />
                  </div>
                </div>

              </div>
            
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
      
        </div>


<?php include(root.'master/footer.php'); ?>
