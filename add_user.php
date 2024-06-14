<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{
header('location:index.php');
}
else{
// For adding post
if(isset($_POST['submit']))
{
$uname=$_POST['AdminUserName'];
$email=$_POST['AdminEmailId'];
$pwd=$_POST['AdminPassword'];
$hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
$status=1;
$query=mysqli_query($con,"insert into tbladminblog(AdminUserName,AdminEmailId,AdminPassword,Is_Active) values('$uname','$email','$pwd','$status')");
if($query)
{
$msg="User successfully added ";
}
else{
$error="Something went wrong . Please try again.";
}
}
}
?>
<?php include("head.php") ?>
</head>
<body class="hsidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
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
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Add User</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Add User</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- row -->
        <section class="content">
            <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add User</h3>
        
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
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
                                <form id="adduser" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="exampleInputEmail1">User Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter User Name" >
                                            <span id="error_name" style="color:red"></span>
                                        </div>
                                        <div class="col-3">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" >
                                            <span id="error_email" style="color:red"></span>
                                        </div>
                                        <div class="col-3">
                                            <label class="control-label">Password</label>
                                            <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter Password" >
                                            <span id="error_password" style="color:red"></span>
                                        </div>
                                        <div class="col-3">
                                             <label class="control-label">Role Type</label>
                                         <div class="form-group">
                                            <select class="form-control" name="role" id="role">
                                                <option selected  value="">Select Role Type</option>
                                                <option value="admin">Admin</option>
                                                <option value="manager">Manager</option>
                                                  <option value="sales">Sales</option>
                                                    <option value="lead">Lead</option>
                                                      <option value="recruiter">Recruiter</option>
                                                            
                                             </select>
                                             <span id="error_role" style="color:red"></span>
                                     </div>
                                     </div>
                                    </div>
                                    <div class="row">
                                         
                                     
                                     <div class="col-3">
                                             <label class="control-label">Account type</label>
                                         <div class="form-group">
                                            <select class="form-control" name="account_type" id="account_type">
                                                <!--<option selected  value="">Select Role Type</option>-->
                                                <option value="Active">Active</option>
                                                <option value="Deactivate">Deactivate</option>
                                             </select>
                                             <span id="error_account_type" style="color:red"></span>
                                     </div>
                                     </div>
                                     <div class="col-3">
                                             <label class="control-label">Email Limit</label>
                                         <div class="form-group">
                                               <input type="text" class="form-control" required  pattern="\d*"  id="email_limit" name="email_limit" placeholder="Email Limit" >
                                            <span id="error_email_limit" style="color:red"></span>
                                            
                                     </div>
                                     </div>
                                        
                                    </div>
                                     <span id="success" style="color:green;"></span>
                                    <br>
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="Enter Password" value="0" >
                                    <button type="submit" class="btn btn-primary btn-sm add">Save and Post</button>
                                    <button type="reset" class="btn btn-danger btn-sm">Discard</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
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
<script>
jQuery(document).ready(function(){
$('.summernote').summernote({
height: 240,                 // set editor height
minHeight: null,             // set minimum height of editor
maxHeight: null,             // set maximum height of editor
focus: false                 // set focus to editable area after initializing summernote
});
// Select2
$(".select2").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
    $("#name").keyup(function() {
        var name = $('#name').val();
        if (name !== '') {
            $("#name").css("border", "1px solid #2AA3D8");
            $("#error_name").text("");
        }
    });
    $("#email").keyup(function() {
        var email = $('#email').val();
        if (email !== '') {
            $("#email").css("border", "1px solid #2AA3D8");
            $("#error_email").text("");
        }
    });
    $("#pwd").keyup(function() {
        var psw = $('#pwd').val();
        if (psw !== '') {
            $("#pwd").css("border", "1px solid #2AA3D8");
            $("#error_password").text("");
        }
    });
    $("#role").change(function() {
        var role = $('#role').val();
        if (role !== '') {
            $("#role").css("border", "1px solid #2AA3D8");
            $("#error_role").text("");
        }
    });


$('#adduser').submit(function(e){
    $(".add").attr("disabled", true);
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
var name = $('#name').val();
var email = $('#email').val();
var password = $('#pwd').val();
var role = $('#role').val();
if (name == '') {
    $(".add").attr("disabled", false);
            $("#name").css("border", "1px solid red");
            $("#error_name").text("Please Enter Your Username");
            $(".add").attr("disabled", false);
            return false;
        } else {
            $("#error_name").text("");
        }

 var email = $('#email').val();
    if (email == '') {
        $(".add").attr("disabled", false);
         $("#email").css("border", "1px solid red");
         $("#error_email").text("Enter a email address.");
         
      } else if (!emailReg.test(email)) {
         $("#email").css("border", "1px solid red");
         $("#error_email").text("Enter a valid email address.");
          $(".add").attr("disabled", false);
         return false;
      } else {
         $("#email").css("border", "1px solid #2AA3D8");
         $("#error_email").text("");
      }
      if (password == '') {
          $(".add").attr("disabled", false);
            $("#pwd").css("border", "1px solid red");
            $("#error_password").text("Please Enter Your Password")
            return false;
            $(".add").attr("disabled", false);
        } else {
            $("#error_password").text("");
        }
        if (role == '') {
            $(".add").attr("disabled", false);
            $("#role").css("border", "1px solid red");
            $("#error_role").text("Please select role")
            return false;
            $(".add").attr("disabled",false);
        } else {
            $("#error_role").text("");
        }
e.preventDefault()
 $.ajax({
url:'ajax.php?action=adduser',
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
 $("#success").text("User Added Successfully");
 window.location.href='manage_user.php';
 }
 }
})
})
</script>
</scrip>

<script>
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
<!--**********************************
Scripts
***********************************-->
<?php include("script.php"); ?>
</body>
</html>