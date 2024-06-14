<?php session_start();
include('includes/config.php');
$id=$_SESSION['login_id'];
$sql=mysqli_query($con,"SELECT * FROM  admin where id='$id'");
while($row=mysqli_fetch_array($sql))
{
$image=$row['Image'];
}
?>
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item  d-sm-inline-block">
        <a href="dashboard.php" class="nav-link" title="Dashboard">
            <i class="nav-icon typcn typcn-device-desktop" title="Dashboard"></i><p class="hideonmobile"> DashBoard</p>
        </a>
      </li>
      <?php if($_SESSION['role']=='admin') {?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Admin User"><i class="nav-icon typcn typcn-group-outline"></i>
       <p class="hideonmobile">Admin User</p> 
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="add_user.php"><i class="far typcn typcn-user-add-outline"></i> Add User</a>
        <a class="dropdown-item" href="manage_user.php"><i class="far typcn typcn-user-add-outline"></i> Manage User</a>
      </div>
    </li>
    <?php } ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Vendor">
        <i class="nav-icon typcn typcn-th-list"></i> <p class="hideonmobile"> Vendor</p>
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="manage_list.php">Manage Vendor</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Vendor">
       <i class="nav-icon typcn typcn-film"></i><p class="hideonmobile"> Compose</p>
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="add_signature.php">Add Signature</a>
        <a class="dropdown-item" href="manual_template.php">Compose Email</a>
        <a class="dropdown-item" href="manual_template_list.php">List Composed Email</a>
        
        <a class="dropdown-item" href="campaign_history_manual.php">Email History</a>
      </div>
    </li>
  </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
        <li class="nav-item dropdown">
            <a class="nav-link user-img" data-toggle="dropdown" href="#">
                <span class="activity active"></span>
                <?php 
                if($image!=""){ ?>
                <img  src="images/<?php echo $image;?>" alt="User profile picture" class="img-circle" height="40" width="40">
                <?php } ?>
               <?php if($image==""){ ?>
                <img src="images/default-user-avatar.jpg" alt="User profile picture" class="img-circle" height="40" width="40">
                <?php } ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="app-profile.php" class="dropdown-item">
                <i class="typcn typcn-user-outline mr-2"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="change_password.php" class="dropdown-item">
                <i class="typcn typcn-eye-outline mr-2"></i> Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item">
                <i class="typcn typcn-power-outline mr-2"></i> Logout
              </a>
            </div>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->

<!--
<div class="header">    
    <div class="header-content clearfix">
        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        <div class="header-left"></div>
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="images/user/1.png" height="40" width="40" alt="">
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="app-profile.php"><i class="icon-user"></i> <span>Profile</span></a>
                                </li>
                                <hr class="my-2">
                                <li>
                                    <a href="change_password.php"><i class="icon-lock"></i> <span>Change Password</span></a>
                                </li>
                                <li><a href="logout.php"><i class="icon-key"></i> <span>Logout</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div> -->
<!--**********************************
    Header end ti-comment-alt
***********************************-->