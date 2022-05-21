<?php
require_once "controller/functions.php";
session_start();
//print_r($_SESSION);exit;
if(!isset($_SESSION['uname'])){
  header("Location: ../index.php");
    
  exit();
}
$id = $_SESSION['uid_user'];
$name = $_SESSION['uname'];
$email = $_SESSION['user_name'];

$checkuserbrand = getSingleuser($id);
//print_r($checkuserbrand);exit;
$brand = $checkuserbrand['brand'];
$brandname = getBrand($brand);
$_SESSION['brand'] = $brand;
//print_r($brandname['brand_name']);exit;
?>
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <i class="bi bi-list toggle-sidebar-btn"></i>
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/Mukunda_Logo.png" alt="">
      <span class="d-none d-lg-block">KITCHEN.OS</span>
    </a>

  </div><!-- End Logo -->

 <div class="brand-bar">
    <!-- <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button> -->
       <h3><?php echo $brandname['brand_name']; ?> - User</h3>
    <!-- </form> -->
  </div>
  <!-- End Search Bar -->

  <nav class="header-nav ms-auto">


    <ul class="d-flex align-items-center">

     
     
  
      <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number">1</span>
        </a>
        <!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">

          <li class="dropdown-header">
            You have 1 new notifications
            <a href="notification.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-exclamation-circle text-warning"></i>
            <div>
              <h4>Product Location Change</h4>
              <p>Product location Changed from Bengaluru to Mumbai</p>
              <p>30 min. ago</p>
            </div>
          </li>

          <li class="dropdown-footer">
            <a href="notification.php">Show all notifications</a>
          </li>

        </ul>
      

      </li>
     

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="assets/img/Mukunda_Logo.png" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $name; ?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>Admin</h6>
            <!-- <span>Web Designer</span> -->
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
              <i class="bi bi-question-circle"></i>
              <span>Need Help?</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="logout.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->