<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

?>
<?php include("head.php") ?>
</head>
<body  class="hsidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<?php include("loader.php"); ?>    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div class="wrapper">
         <?php include("nav_header.php"); ?>
         <?php include("header.php");?>    
         <?php include("sidebar.php");?>   
       
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0">Change Password</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                      <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Change Password</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                  </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">  
                                    <!---Success Message--->  
                                    <?php if($msg){ ?>
                                    <div class="alert alert-success" role="alert">
                                    <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                                    </div>
                                    <?php } ?>
    
                                    <!---Error Message--->
                                    <?php if($error){ ?>
                                    <div class="alert alert-danger" role="alert">
                                    <strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
                                    <?php } ?>
                                </div>
                                </div> 
                                <form class="form-horizontal" id="changepass">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Current Password</label>
                                                <input type="text" class="form-control" value="" name="password" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">New Password</label>
                                                <input type="text" class="form-control" value="" id="npass"  name="newpassword" required>
                                            </div>
                                        </div>
                                         
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Confirm Password</label>
                                                <input type="text" class="form-control" value="" id="cpass"  name="confirmpassword" required>
                                            </div>
                                            <span id="error1" style="color:red;"></span>
                                        </div>
                                        
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                     <span id="success" style="color:green;"></span>
                                      <span id="error" style="color:red;"></span>
                                    <div class="row">
                                        
                                        <div class="col-md-12">   
                                            <button type="submit" class="btn btn-primary btn-sm add">Submit</button>
                                        </div>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
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
     <script type="text/javascript">

</script>
      <?php include("script.php"); ?>
</body>

</html>
<?php } ?>
<script>
$('#changepass').submit(function(e){
$(".add").attr("disabled", true);
var cpass=$("#cpass").val();
var npass=$("#npass").val();
if(cpass!=npass){
    $("#error1").text("New password and Confirm password does not match");
    $(".add").attr("disabled",false);
     setTimeout(function() {
        $("#error1").text('');
         }, 3000);
    return false;
}
e.preventDefault()
 $.ajax({
url:'ajax.php?action=changepass',
 data: new FormData($(this)[0]),
 cache: false,
 contentType: false,
 processData: false,
 method: 'POST',
 type: 'POST',
 error:err=>{
 console.log(err)
 },
 success:function(resp){
 if(resp == 1){
 $("#success").text("Password Change Successfully");
 location.href='change_password.php';
 }
  else if (resp == 3) {
    $("#error").text("Current password does not match!");
    $(".add").attr("disabled", false);
    setTimeout(function() {
        $("#error").text('');
         }, 4000);

      }
 }
})
})
$(document).ready(function() {
setTimeout(function() {
$(".alert-success").css("display","none");
}, 2000);
});</script>
<script>
$(document).ready(function() {
setTimeout(function() {
$(".alert-danger").css("display","none");
}, 2000);
});</script>