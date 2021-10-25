<!-- 
 RC-PoS (https://appzaib.com/rc-pos)
 Copyright 2013-2018 BlackRock Digital, LLC, 2018 Vruqa Designs, 2018 Appzaib
 Licensed under MIT (https://github.com/appzaib/rc-pos/blob/master/LICENSE)
-->

<?php 

if(isset($_SESSION['userid'])){


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

  </head>
  <body id="page-top">
    <nav class="navbar fixed-top navbar-expand navbar-dark bg-dark static-top">
      <a class="navbar-brand mr-1" href="index.html">Anawrahta Shwe Tharmanay School</a>
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fa fa-bars"></i>
      </button>
      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          
        </div>
      </form>
      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-plus fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">            
            <a class="dropdown-item" href="#" id="btnnewdonater"> <i class="fa fa-plus"></i> New Donater</a>
           
            <a class="dropdown-item" href="#" id="btnnewstudent" > <i class="fa fa-plus"></i> New Student</a>
            <a class="dropdown-item" href="#" id="btnnewteacher" > <i class="fa fa-plus"></i> New Teacher</a>
            <a class="dropdown-item" href="#" id="btnnewitem"> <i class="fa fa-plus"></i> New Item</a>
            <div class="dropdown-divider"></div>
            
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-flash fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="<?php echo roothtml.'donation/main_donation.php' ?>"> <i class="fa fa-tags"></i> ပင်မအလှူရှင်</a>
            <a class="dropdown-item" href="<?php echo roothtml.'donation/special_donation.php' ?>"> <i class="fa fa-tags"></i> အထူးအလှူရှင်</a>
            <a class="dropdown-item" href="<?php echo roothtml.'donation/general_donation.php' ?>"> <i class="fa fa-tags"></i> နဝကာမအလှူရှင်</a>
            <a class="dropdown-item" href="<?php echo roothtml.'inherit/inherit.php' ?>"> <i class="fa fa-tags"></i> အမွေခံအလှူ</a>
            <a class="dropdown-item" href="<?php echo roothtml.'donation/family_donation.php' ?>"> <i class="fa fa-tags"></i> သာသနာပြုမိသားစုအလှူ</a>
            <a class="dropdown-item" href="<?php echo roothtml.'gold/gold_donation.php' ?>"> <i class="fa fa-tags"></i> ရွှေသာမဏေအလှူ</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo roothtml.'donater/donater.php' ?>"> <i class="fa fa-tags"></i> All Donars</a>
            <a class="dropdown-item" href="<?php echo roothtml.'student/student.php' ?>"> <i class="fa fa-tags"></i> All Students</a>
            <a class="dropdown-item" href="<?php echo roothtml.'teacher/teacher.php' ?>"> <i class="fa fa-tags"></i> All Teachers</a>
            <a class="dropdown-item" href="<?php echo roothtml.'item/item.php' ?>"> <i class="fa fa-tags"></i> All Items</a>
            <div class="dropdown-divider"></div>
           
          </div>
        </li>
        
        <li class="nav-item dropdown no-arrow ml-3">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <div class="dropdown-header">User : <?php echo (isset($_SESSION['username']) ? $_SESSION['username'] : '' )?></div>
            <a class="dropdown-item" href="<?php echo roothtml.'setting/profile.php' ?>"> <i class="fa fa-user"></i> Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"> <i class="fa fa-power-off"></i> Logout</a>
          </div>
        </li>
      </ul>
    </nav>
    <br><br>
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item <?php echo (curlink == 'home.php' || curlink == 'readmore.php' )?'active' : '' ?>">
          <a class="nav-link" href="<?php echo roothtml.'home/home.php' ?>">
            <i class="fa fa-fw fa-home"></i>
            <span>Home</span>
          </a>
        </li>
        <li class="nav-item <?php echo (curlink == 'main_donation.php')?'active' : '' ?>">
          <a class="nav-link" href="<?php echo roothtml.'donation/main_donation.php' ?>">
            <i class="fa fa-fw fa-line-chart"></i>
            <span>ပင်မအလှူရှင်</span>
          </a>
        </li>
        <li class="nav-item <?php echo (curlink == 'special_donation.php')?'active' : '' ?>">
          <a class="nav-link" href="<?php echo roothtml.'donation/special_donation.php' ?>">
            <i class="fa fa-fw fa-bar-chart"></i>
            <span>အထူးအလှူရှင်</span></a>
        </li>      
        <li class="nav-item <?php echo (curlink == 'general_donation.php')?'active' : '' ?>">
          <a class="nav-link" href="<?php echo roothtml.'donation/general_donation.php' ?>">
            <i class="fa fa-fw fa-tags"></i>
            <span>နဝကာမအလှူရှင်</span></a>
        </li>     
        <li class="nav-item <?php echo (curlink == 'inherit.php')?'active' : '' ?>">
          <a class="nav-link" href="<?php echo roothtml.'inherit/inherit.php' ?>">
            <i class="fa fa-fw fa-money"></i>
            <span>အမွေခံအလှူ</span></a>
        </li>
        <li class="nav-item <?php echo (curlink == 'family_donation.php')?'active' : '' ?>">
          <a class="nav-link" href="<?php echo roothtml.'donation/family_donation.php' ?>">
            <i class="fa fa-fw fa-table"></i>
            <span>သာသနာပြုမိသားစုအလှူ</span></a>
        </li>
        <li class="nav-item dropdown <?php echo (curlink == 'gold_donation.php' || curlink == 'gold_alldonation.php')?'active' : '' ?>">
          <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-industry"></i>
            <span>
            ရွှေသာမဏေအလှူ
              <i class="float-right fa fa-angle-down"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">ရွှေသာမဏေအလှူ</h6>
            <a class="dropdown-item" href="<?php echo roothtml.'gold/gold_donation.php' ?>"> <i class="fa fa-plus"></i> ရွှေသာမဏေအလှူ</a>
            <a class="dropdown-item" href="<?php echo roothtml.'gold/gold_alldonation.php' ?>"> <i class="fa fa-tags"></i> Show All</a>
            
          </div>
        </li>  
        <li class="nav-item dropdown <?php echo (curlink == 'student.php')?'active' : '' ?>">
          <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-users"></i>
            <span>
              Manage Student
              <i class="float-right fa fa-angle-down"></i>
            </span>
          </a>          
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Student</h6>
            <a class="dropdown-item" href="#" id="btnnewstudent"> <i class="fa fa-plus"></i> Add New Student</a>
            <a class="dropdown-item" href="<?php echo roothtml.'student/student.php' ?>"> <i class="fa fa-tags"></i> All Student</a>
            
          </div>
        </li>
        <li class="nav-item dropdown <?php echo (curlink == 'teacher.php')?'active' : '' ?>">
          <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-user"></i>
            <span>
              Manage Teacher
              <i class="float-right fa fa-angle-down"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Teacher</h6>
            <a class="dropdown-item " href="#" id="btnnewteacher"> <i class="fa fa-plus"></i> Add New Teacher</a>
            <a class="dropdown-item " href="<?php echo roothtml.'teacher/teacher.php' ?>"> <i class="fa fa-tags"></i> All Teacher</a>
            
          </div>
        </li>
        
        <li class="nav-item dropdown <?php echo (curlink == 'category.php' || curlink == 'item.php')?'active' : '' ?>">
          <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-folder"></i>
            <span>
              Manage Items
              <i class="float-right fa fa-angle-down"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Items</h6>
            <a class="dropdown-item" href="#" id="btnnewitem"> <i class="fa fa-plus"></i> Add New Item</a>
            <a class="dropdown-item" href="<?php echo roothtml.'item/item.php' ?>"> <i class="fa fa-tags"></i> All Items</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Category</h6>
            <a class="dropdown-item" href="#" id="btnnewcategory"> <i class="fa fa-plus"></i> Add New Category</a>
            <a class="dropdown-item" href="<?php echo roothtml.'item/category.php' ?>"> <i class="fa fa-tags"></i> All Categorys</a>
            
          </div>
        </li>
        <li class="nav-item dropdown <?php echo (curlink == 'donater.php')?'active' : '' ?>">
          <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-external-link"></i>
            <span>
              Manage Donar
              <i class="float-right fa fa-angle-down"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Donar</h6>
            <a class="dropdown-item" href="#" id="btnnewdonater"> <i class="fa fa-plus"></i> Add Donar</a>
            <a class="dropdown-item" href="<?php echo roothtml.'donater/donater.php' ?>"> <i class="fa fa-tags"></i> All Donars</a>
            
          </div>
        </li>        
        <li class="nav-item dropdown <?php echo (curlink == 'usercontrol.php')?'active' : '' ?>">
          <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-external-link"></i>
            <span>
              Manage Account
              <i class="float-right fa fa-angle-down"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">User Control</h6>
            <a class="dropdown-item" href="#" id="btnnew"> <i class="fa fa-plus"></i> Add User Control</a>
            <a class="dropdown-item" href="<?php echo roothtml.'usercontrol/usercontrol.php' ?>"> <i class="fa fa-tags"></i> All User Control</a>
            
          </div>
        </li>
        <li class="nav-item <?php echo (curlink == 'log.php')?'active' : '' ?>">
          <a class="nav-link" href="<?php echo roothtml.'log/log.php' ?>">
            <i class="fa fa-fw fa-calendar"></i>
            <span>Log History</span></a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fa fa-fw fa-power-off"></i>
            <span>Logout</span></a>
        </li>
      </ul>

<?php

}else{

  header("location:". roothtml."error.php"); 

}

?>
      
    