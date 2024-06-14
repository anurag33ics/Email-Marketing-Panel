<?php

include('includes/config.php');
// // echo "sss". $_SESSION['login'];
// //  $sessionid= $_SESSION['login_id'];
// $login = "<script>document.write(localStorage.getItem('login'));</script>";
// $sessionid = "<script>document.write(localStorage.getItem('login_id'));</script>";
// $sessionrole = "<script>document.write(localStorage.getItem('role'));</script>";
error_reporting(1);

session_start();

if(strlen($_SESSION['login'])==0 )
{
header('location:index.php');
}
else{
?>
<?php include("head.php") ?>
</head>
<body class="hsidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<?php //include("loader.php"); ?>

<!--**********************************
Main wrapper start
***********************************-->
<div class="wrapper">
    <?php include("nav_header.php"); ?>
    <?php include("header.php");?>
    <?php include("sidebar.php");?>
    
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
                <div class="row">
                  
                  
                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>
        
                  <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3 bg-light-accent">
                      <span class="info-box-icon"><i class="typcn typcn-arrow-sync"></i></span>
                      <?php 
                    //   if($_SESSION['role']=="admin"){
                    $sessionid =$_SESSION['login_id'];
                      if($_SESSION['role']!="admin"){
                        $query=mysqli_query($con,"select * FROM `sendemaildata` WHERE email_send_status='yes' AND session_id='".$_SESSION['login_id']."'"); 
                     }else{
                        $query=mysqli_query($con,"select * FROM `sendemaildata` WHERE email_send_status='yes'");
                     }
                        
                        $rowcount1=mysqli_num_rows($query);
                        ?>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Send Email</span>
                        <span class="info-box-number"><?php echo $rowcount1;?></span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3 bg-light-error">
                      <span class="info-box-icon"><i class="typcn typcn-eye-outline"></i></span>
                     <?php  
                     
                       if($_SESSION['role']!="admin"){
                        $query=mysqli_query($con,"select * FROM `sendemaildata` WHERE email_open_status='opened' AND session_id='$sessionid'"); 
                     }else{
                         $query=mysqli_query($con,"select * FROM `sendemaildata` WHERE email_open_status='opened'");
                     }
                     
                        
                        
                        $rowcount2=mysqli_num_rows($query);
                        ?>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Open Email </span>
                        <span class="info-box-number"><?php echo $rowcount2;?></span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3 bg-light-primary">
                      <span class="info-box-icon"><i class="typcn typcn-document-text"></i></span>
        <?php
     
                   if($_SESSION['role']!="admin"){
                  
                        $query1=mysqli_query($con,"select * from list WHERE  session_id='$sessionid'"); 
                     }else{
                       
                         $query1=mysqli_query($con,"select * from list");
                     }
                // $query=mysqli_query($con,"select * from list");
                $rowcount4=mysqli_num_rows($query1);
                     
                     ?>
                      <div class="info-box-content">
                        <span class="info-box-text">List</span>
                        <span class="info-box-number"><?php echo $rowcount4?></span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                
                <!-- Info boxes -->
           
            </div>

        </section>
        <!-- /.content -->
      </div>
    <!-- /.content-wrapper -->
    
    
    <!--**********************************
    Content body start
    ***********************************-->
    <!--**********************************
    Content body end
    ***********************************-->
  
    
    <!--**********************************
    Footer start
    ***********************************-->
    <?php include("footer.php"); ?>
    <!--**********************************
    Footer end
    ***********************************-->
</div>
<!--**********************************
Main wrapper end
***********************************-->
<!--**********************************
Scripts
***********************************-->

<?php include("script.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    <?php
    // Fetch browser counts from the database
    // $query = mysqli_query($con, "SELECT browser, COUNT(*) as count FROM visitor GROUP BY browser");
    // $browserCounts = array();
    // $includedBrowsers = ["Chrome", "Safari", "Firefox", "Mobi"];

    // while ($row = mysqli_fetch_array($query)) {
    //     $browserName = $row['browser'];
    //     // Extract the browser name without version or other details
    //     if (stripos($browserName, "Chrome") !== false) {
    //         $browserName = "Chrome";
    //     } elseif (stripos($browserName, "Safari") !== false) {
    //         $browserName = "Safari";
    //     } elseif (stripos($browserName, "Firefox") !== false) {
    //         $browserName = "Firefox";
    //     } elseif (stripos($browserName, "Mobi") !== false) {
    //         $browserName = "Mobi";
    //     } else {
    //         $browserName = "Other"; // Group excluded browsers as "Other"
    //     }

    //     if (!isset($browserCounts[$browserName])) {
    //         $browserCounts[$browserName] = 0;
    //     }
    //     $browserCounts[$browserName] += $row['count'];
    // }

    // // Prepare the JavaScript arrays for xValues, yValues, and barColors
    // $xValues = [];
    // $yValues = [];
    // $barColors = [];

    // // Define colors for each browser
    // $browserColors = [
    //     "Chrome" => "#b91d47",
    //     "Safari" => "#00aba9",
    //     "Firefox" => "#2b5797",
    //     "Mobi" => "#e8c3b9",
    //     "Other" => "#ffc107" // Color for the "Other" category
    // ];

    // // Populate the arrays with browser names, counts, and colors
    // foreach ($browserCounts as $browserName => $count) {
    //     $xValues[] = $browserName;
    //     $yValues[] = $count;
    //     $barColors[] = $browserColors[$browserName];
    // }
    // ?>

    // var xValues = <?php //echo json_encode($xValues); ?>;
    // var yValues = <?php //echo json_encode($yValues); ?>;
    // var barColors = <?php //echo json_encode($barColors); ?>;

    // new Chart("myChart", {
    //     type: "pie",
    //     data: {
    //         labels: xValues,
    //         datasets: [{
    //             backgroundColor: barColors,
    //             data: yValues
    //         }]
    //     },
    //     options: {
    //         title: {
    //             display: true,
    //             text: "Browser Usage"
    //         }
    //     }
    // });
</script>

</body>
</html>
<?php } ?>