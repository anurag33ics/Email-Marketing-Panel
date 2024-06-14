<?php

//Database Configuration File
include('includes/config.php');
//error_reporting(0);

if(isset($_POST['login']))
  {
    // Getting username/ email and password
     $uname=$_POST['username'];
     $password=$_POST['password'];
    // echo "SELECT AdminUserName,AdminEmailId,AdminPassword FROM tbladmin WHERE (AdminUserName='$uname' || AdminEmailId='$uname')";die;
    // Fetch data from database on the basis of username/email and password
$sql =mysqli_query($con,"SELECT id,name,email,password,role FROM admin WHERE (name='$uname' || email='$uname') AND account_type='Active' ");
 $num=mysqli_fetch_array($sql);
 //print_r($num);
if($num>0)
{
$hashpassword=$num['password']; // Hashed password fething from database
//verifying Password
if ($password==$hashpassword) {
     session_start();
     $_SESSION['abc'] ='s';
     $_SESSION['name'] =$num['name'];
     $_SESSION['login'] = $uname;
     $_SESSION['login_id'] = $num['id'];
     $_SESSION['role'] = $num['role'];
     
     
    //  echo $_SESSION['role'].$_SESSION['abc'];
     echo "<script> window.localStorage.setItem('name', '".$num['name']."')  </script>";
     echo "<script> window.localStorage.setItem('login', '".$uname."')  </script>";
     echo "<script> window.localStorage.setItem('login_id', '".$num['id']."')  </script>";
     echo "<script> window.localStorage.setItem('role', '".$num['role']."')  </script>";
     echo"<script>window.location.href='dashboard.php';</script>";
    //echo ""
    //header("Location:../admin/dashboard.php");
  } else {
echo "<script>alert('Wrong Password');</script>";
  }
}//if username or email not found in database
else{
echo "<script>alert('User not registered with us');</script>";
  }
}
?>
<?php include("head.php") ?>

<style>
.login-form-bg,
.login-form {
    height: 100vh;
    overflow: hidden;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-formin {
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    background: #fff;
    box-shadow: 0 0 10px #ccc;
    border-radius: 20px;
    height: 100%;
    max-height: 420px;
}

.login-formin .lft-box {
    overflow: hidden;
    display: flex;
    height: 100%;
    padding: 15px;
}
.login-formin .login-logo {
        display: block;
    width: 100%;
    max-width: 230px;
    position: relative;
    z-index: 2;
    height: max-content;
    background: rgba(255,255,255,.8);
}

.login-formin a.login-logo img {
    width: 100%;
}


.login-formin .row {
    height: 100%;
}

.login-formin .lft-box .coverimg {
    position: absolute;
    text-align:center;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    border-radius: 20px  0 0 20px;
    overflow: hidden;
    display: block;
}

.login-formin .lft-box .coverimg img {
        width: 94%;
    height: 100%;
    object-fit: contain;
}


.login-formin .rgt-box {
    padding: 40px 50px;
}

.login-formin .rgt-box h3{
    font-weight: 800;
    text-transform: uppercase;
}

.login-formin .login-tbs {
    display: table;
    width: 100%;
    margin: 10px 0 20px;
}

.login-formin .login-tbs > a {
    display: block;
    color: #000;
    width: 50%;
    float: left;
    text-align: center;
    padding: 10px;
    text-transform: capitalize;
    border-bottom: solid 2px transparent;
}

.login-formin .login-tbs > a.active,
.login-formin .login-tbs > a:hover {border-bottom-color: #03045e;color: #03045e;}


@media (max-width:767px){
    .login-form {height: auto;}
    .login-formin .lft-box{margin: 0 8px 0 7px; height: 250px;}
    .login-formin .lft-box .coverimg{border-radius: 20px 20px 0 0;}
    .login-formin .login-logo{margin: 0 auto;}
    
    .login-formin{max-height: inherit;}
    .login-formin .rgt-box {padding: 40px 30px;}
    .login-formin .rgt-box h3{text-align:center;}
}

</style>

</head>

<body class="h-100" style="background-image: url(images/login-bg.jpg)">
    <?php include("loader.php"); ?>  
    
    <div class="login-form">
        <div class="login-formin">
            <div class="row">
                <div class="col-md-6 lft-box">
                    <!--<a href="#" class="login-logo"><img src="images/Corptocorp-logo.png"></a>-->
                    <div class="coverimg">
                        <img src="images/Corptocorp-logo.png">
                    </div>
                </div>
                <div class="col-md-6 rgt-box">
                    <h3>Login</h3><br>
                    <!--<div class="login-tbs">-->
                    <!--    <a href="https://www.bugendaitech.com/admin2/index.php" class="active">Admin Login</a>-->
                    <!--    <a href="https://www.bugendaitech.com/blog_admin" class="">Blog Login</a>-->
                    <!--</div>-->
                    <form class="login-input" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username or email" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" required="" placeholder="Password" autocomplete="off">
                        </div>
                        <button class="btn btn-primary login-form__btn submit w-100" id='login' type="submit" name="login">Login</button>
                    </form>
                    <br>
                    <a class="btn btn-info btn-sm mb-1 mr-1" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Forgot Password</a>
                    <!--<button type="button" > Add Vendor Group</button>-->
                </div>
            </div>
        </div>
    </div>
        <!--Create List Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="forgotPassword">
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <span id="error_email" style="color:red"></span>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <span id="sucess" style="color:green;"></span>
                        <span id="error" style="color:red;"></span>
                        <button type="submit" class="btn btn-primary btn-sm add">Submit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Create List Modal end-->

<!--**********************************
    Scripts
***********************************-->
<?php include("script.php"); ?>
<script>
    $('#forgotPassword').submit(function(e){
$(".add").attr("disabled", true);
var email = $('#email').val();
if (email == '') {
        $(".add").attr("disabled", false);
            $("#email").css("border", "1px solid red");
            $("#email").text("Please Enter email");
            $(".add").attr("disabled", false);
            return false;
        } else {
            $("#error_email").text("");
        }
e.preventDefault()
 $.ajax({
url:'ajax.php?action=forgotPassword',
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
 if(resp > 0){
     $("#sucess").text('Verification link has been to email.');
     setTimeout(function(){
        // window.location.href='view_member.php?id='+resp;
 window.location.reload();
                    },2000)
 }
  else if (resp == -1) {
    $("#error").text("Email not exist");
    $(".add").attr("disabled", false);
    setTimeout(function() {
        $("#error").text('');
        window.location.reload();
         }, 2000);

      }
 }
})
})
</script>
</body>
</html>





