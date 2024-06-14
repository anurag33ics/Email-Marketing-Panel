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
 $id=$_SESSION['login_id'];
$content=''; 
$btnLbl ="Add";
 $qry=mysqli_query($con,"SELECT * from my_signature where login_id='$id'");
 if(mysqli_num_rows($qry)){
     $btnLbl ="Update";
 $res= mysqli_fetch_array($qry);
$content = $res['signature'];
}
?>
<?php include("head.php") ?>
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
    
    <!--**********************************
    Content body start
    ***********************************-->
    <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">My Signature</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">My Signature</li>
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
                            <h3 class="card-title"><?php echo $btnLbl ?> Signature</h3>
        
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form id="addSignature" enctype="multipart/form-data">
                                        <div class="row">
                                        <div class="col-12">
                                            <label for="exampleInputEmail1">Signature</label>
                                            
                                            <textarea id="editor"><?php echo $content ?></textarea>
                                            <span id="error_signature" style="color:red"></span>
                                        </div>
                                     </div>
                                        
                                    </div>
                                     <span id="success" style="color:green;"></span>
                                     <span id="success" style="color:red;"></span>
                                    <br>
                                    <!--<input type="hidden" class="form-control" id="id" name="id" placeholder="Enter Password" value="0" >-->
                                    <button type="submit" class="btn btn-primary btn-sm add"><?php echo $btnLbl ?></button>
                                    <!--<button type="reset" class="btn btn-danger btn-sm">Discard</button>-->
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
    <!-- *************Modal for top buttons **********************-->
     <!--Manual Entry modal end-->

    <!-- ************ Modal end***********************-->
    
    
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

</script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script>
        // Initialize CKEditor
        CKEDITOR.replace('editor');

        // Get the value of CKEditor when the button is clicked
        document.getElementById('getEditorValue').addEventListener('click', function() {
            var editorValue = CKEDITOR.instances.editor.getData();
            alert(editorValue); // You can do anything with the value, such as sending it to the server
        });
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
    $('#addSignature').submit(function(e){
    $(".add").attr("disabled", true);
    var editor = CKEDITOR.instances.editor.getData();
if (editor == '') {
        $(".add").attr("disabled", false);
        $("#error_signature").css("border", "1px solid red");
        $("#error_signature").text("signature cannot be blank");
        $(".add").attr("disabled", false);
        return false;
    } else {
        $("#error_signature").text("");
    }

e.preventDefault()
 $.ajax({
url:'ajax.php?action=addSignature',
 data: {editor:editor},
 type: 'POST',
 error:err=>{
 console.log(err)
 },
 success:function(resp){
 if(resp == 1){
 $("#success").text("Added Successfully");
     setTimeout(function() {
        window.location.reload();
    }, 2000);

 }else{
 $("#success").text("Something Went Wrong");    
 }
 
 }
})
})
</script>

<script>
$(document).ready(function() {
    $('#example1').DataTable(); 
setTimeout(function() {
$(".alert-success").css("display","none");
}, 2000);
});</script>
<script>
$(document).ready(function() {
setTimeout(function() {
$(".alert-danger").css("display","none");
}, 2000);
});

</script>
<!--**********************************
Scripts
***********************************-->
<?php include("script.php"); ?>
</body>
</html>