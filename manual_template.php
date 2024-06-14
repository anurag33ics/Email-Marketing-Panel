<?php

include('includes/config.php');
error_reporting(0);

session_start();

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
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<?php include("loader.php"); ?>
<!--**********************************
Main wrapper start
***********************************-->
<div class="wrapper">
    
    <?php include("nav_header.php"); ?>
    <?php include("header.php");?>
    <?php include("sidebar.php");?>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <!--**********************************
    Content body start
    ***********************************-->
    <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Compose</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Compose</li>
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
                            <h3 class="card-title">Compose Email</h3>
        
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
                                <form id="addTemplate" enctype="multipart/form-data">
                                    <?php
                                    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                        $emailname= "email-". substr(str_shuffle($str_result),0, 10);
                        ?>
                                            <input type="hidden" class="form-control" id="name" name="name" value="<?php echo $emailname ?>" placeholder="Enter email Name" >

                                <?php 
                                
                                $login_id=$_SESSION['login_id'];
 $adminRecord =mysqli_query($con,"SELECT * from admin where id='$login_id'");
 $fetchAdminRecord = mysqli_fetch_array($adminRecord);
//  echo $fetchAdminRecord['email_limit']."hjhhh";
 
 
 
 $querySignature =mysqli_query($con,"SELECT * from my_signature where login_id='$login_id'");
 $mySign='';
while($rowSig=mysqli_fetch_array($querySignature)){
 $mySign = $rowSig['signature'];   
}  ?>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <?php $disabled='';
                                            if($_SESSION['role']!='admin')
                                        {
                                        echo "Total Email Limit-".$fetchAdminRecord['email_limit'];
                                        } 
                                        else{ echo "Total Email Limit- Unlimited" ;} ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1">Subject</label>
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subect" >
                                            <span id="error_subject" style="color:red"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="exampleInputEmail1">Select Vendor</label>
                               <select class="form-control select2" multiple="multiple" name="vendor" id="vendor">
                                     <!--<option selected  value="">Select</option>-->
                                     <?php 
                                $id=$_SESSION['login_id'];
                                if($_SESSION['role']=='admin'){
                                $stats = $con->query("SELECT list.id,list.list_name, COUNT(addmember.list_id) AS member_count FROM list LEFT JOIN addmember ON list.id = addmember.list_id GROUP BY list.list_name  order by list.id desc");
                                }
                                else{
                                  $stats = $con->query("SELECT  list.id, list.list_name, COUNT(addmember.list_id) AS member_count FROM list LEFT JOIN addmember ON list.id = addmember.list_id WHERE list.session_id='$id' OR list.visibility_type='Public' GROUP BY list.list_name  order by list.id desc");   
                                }
                                while ($row1 = $stats->fetch_assoc()) {
                                ?>
                               <option value="<?php echo $row1['id'];?> "><?php echo $row1['list_name']."(",$row1['member_count'].")";?></option>
                             <?php } ?>
                                     </select>
                                            <span id="error_vendor" style="color:red"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="exampleInputEmail1">Salutation</label>
                                            <select class="form-control" name="salutation" id="salutation">
                                     <!--<option selected  value="">Select</option>-->
                                     <!--<option value="Hi-FirstName">Hi [FirstName]</option>-->
                                     <!--<option value="Hello-FirstName">Hello [FirstName]</option>-->
                                     <!--<option value="Hi-FirstNameLastName">Hi [FirstName LastName]</option>-->
                                     <!--<option value="Hi-FirstNameLastName">Hello [FirstName LastName]</option>-->
                                     <option value="Dear-FirstNameLastName">Dear [FirstName LastName]</option>
                                     </select>
                                            <span id="error_salutation" style="color:red"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                      
                                        <div class="col-12">
                                            <label for="exampleInputEmail1">Content</label>
                                        
                                            <textarea id="editor"><?php echo "<br><br>". $mySign?></textarea>
                                            <span id="error_editor" style="color:red"></span>
                                        </div>
                                     </div>
                                        
                                    </div>
                                     <span id="success" style="color:green;"></span>
                                     <span id="success" style="color:red;"></span>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-sm add">Add</button>
                                    <button type="button" id="addAndSend" class="btn btn-primary btn-sm add">Add and Send</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
// jQuery(document).ready(function(){
// $('.summernote').summernote({
// height: 240,                 // set editor height
// minHeight: null,             // set minimum height of editor
// maxHeight: null,             // set maximum height of editor
// focus: false                 // set focus to editable area after initializing summernote
// });
// // Select2
// $(".select2").select2();
// $(".select2-limiting").select2({
// maximumSelectionLength: 2
// });
// });
</script>

<script>


        // Initialize CKEditor
        CKEDITOR.replace('editor');
editor.resize( '100%', '350' )
        // Get the value of CKEditor when the button is clicked
        document.getElementById('editor').addEventListener('click', function() {
            var editorValue = CKEDITOR.instances.editor.getData();
             // You can do anything with the value, such as sending it to the server
        });
    </script>




    <script>

    $("#name").keyup(function() {
        var name = $('#name').val();
        if (name !== '') {
            $("#name").css("border", "1px solid #2AA3D8");
            $("#error_name").text("");
        }
    });
    // $("#email").keyup(function() {
    //     var email = $('#email').val();
    //     if (email !== '') {
    //         $("#email").css("border", "1px solid #2AA3D8");
    //         $("#error_email").text("");
    //     }
    // });
    // $("#pwd").keyup(function() {
    //     var psw = $('#pwd').val();
    //     if (psw !== '') {
    //         $("#pwd").css("border", "1px solid #2AA3D8");
    //         $("#error_password").text("");
    //     }
    // });
    // $("#role").change(function() {
    //     var role = $('#role').val();
    //     if (role !== '') {
    //         $("#role").css("border", "1px solid #2AA3D8");
    //         $("#error_role").text("");
    //     }
    // });

// add and send start 
$("#addAndSend").on("click", function(){
  $(".add").attr("disabled", true);
    var salutation = $('#salutation').val();
    var signature = $('#signature').val();
    var subject = $('#subject').val();
    var vendor = $('#vendor').val();
    
    var name = $('#name').val();
    var editor = CKEDITOR.instances.editor.getData();
// var editor = $('#editor').val();
    if (name == '') {
        $(".add").attr("disabled", false);
        $("#name").css("border", "1px solid red");
        $("#error_name").text("Please Enter Your Username");
        $(".add").attr("disabled", false);
        return false;
    } else {
        $("#error_name").text("");
    }

if (editor == '') {
        $(".add").attr("disabled", false);
        $("#editor").css("border", "1px solid red");
        $("#error_editor").text("Please Enter Your Username");
        $(".add").attr("disabled", false);
        return false;
    } else {
        $("#error_editor").text("");
    }
    
if (subject == '') {
        $(".add").attr("disabled", false);
        $("#subject").css("border", "1px solid red");
        $("#error_subject").text("Please Enter Subject");
        $(".add").attr("disabled", false);
        return false;
    } else {
        $("#error_subject").text("");
    }
    
    if (vendor == '') {
        $(".add").attr("disabled", false);
        $("#vendor").css("border", "1px solid red");
        $("#error_vendor").text("Please select vendor");
        $(".add").attr("disabled", false);
        return false;
    } else {
        $("#error_vendor").text("");
    }
// evnpreventDefault()
 $.ajax({
url:'ajax.php?action=addAndSendTemplate',
 data: {
 name: name,
 editor: editor,
 vendor: vendor,
 subject: subject,
 salutation: salutation,
 signature: signature
 },
//  cache: false,
//  contentType: false,
//  processData: false,
//  method: 'POST',
 type: 'POST',
 error:err=>{
 console.log(err)
 },
 success:function(resp){
//  if(resp == 1){
//  $("#success").text("Template Added Successfully");
//  window.location.href='manual_template_list.php';
//  }else{
//  $("#success").text("Something Went Wrong");    
//  }
if(resp == 1){
 $("#success").text("Email Send Successfully");
 window.location.href='manual_template_list.php';
 }else if(resp == -1){
     $("#success").text("Email sending limit over.");
 }
 else{
 $("#success").text("Something Went Wrong");    
 }
 
 }
})

})

// add and send end here
$('#addTemplate').submit(function(e){
    $(".add").attr("disabled", true);
    var name = $('#name').val();
    var editor = CKEDITOR.instances.editor.getData();
// var editor = $('#editor').val();
    if (name == '') {
        $(".add").attr("disabled", false);
        $("#name").css("border", "1px solid red");
        $("#error_name").text("Please Enter Your Username");
        $(".add").attr("disabled", false);
        return false;
    } else {
        $("#error_name").text("");
    }

if (editor == '') {
        $(".add").attr("disabled", false);
        $("#name").css("border", "1px solid red");
        $("#error_editor").text("Please Enter Your Username");
        $(".add").attr("disabled", false);
        return false;
    } else {
        $("#error_editor").text("");
    }

e.preventDefault()
 $.ajax({
url:'ajax.php?action=addTemplate',
 data: {name:name,editor:editor},
//  cache: false,
//  contentType: false,
//  processData: false,
//  method: 'POST',
 type: 'POST',
 error:err=>{
 console.log(err)
 },
 success:function(resp){
 if(resp == 1){
 $("#success").text("Email Send Successfully");
 window.location.href='manual_template_list.php';
 }else if(resp == -1){
     $("#success").text("Email sending limit over.");
 }
 else{
 $("#success").text("Something Went Wrong");    
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
<script src="https://adminlte.io/themes/v3/plugins/select2/js/select2.full.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<?php include("script.php"); ?>

</body>
</html>