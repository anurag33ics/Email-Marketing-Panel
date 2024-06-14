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
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
                <h1 class="m-0">Add List</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Add List</li>
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
                            <h3 class="card-title">Add List</h3>
        
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
                                <form id="addlistuser" action="add_user.php" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="exampleInputEmail1">Upload File</label>
                                            <input type="file" class="form-control" id="name" name="name" placeholder="Enter User Name" required>
                                        </div>
                                    
                                        
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Save and Post</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
         <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List</h3>
            
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                  </button>
                                </div>
                            </div>
                             /.card-header 
                            <div class="card-body">
                                <div class="form-validation">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            -Success Message-
                                            <?php if($msg){ ?>
                                                <div class="alert alert-success" role="alert">
                                                    <strong>List Updated!</strong>
                                                </div>
                                            <?php } ?>
                                            -Error Message-
                                            <?php if($error){ ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Oh snap!</strong> <?php echo htmlentities($error);?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    
                                                   
                                                     <th>Name</th>
                                                     <th>Email</th>
                                                     <th>Phone Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                
                                                $query=mysqli_query($con,"select * from csvfileuserlist");
                                                $id = $_GET['id'];
                                                 $cnt=1;
                                                $rowcount=mysqli_num_rows($query);
                                                if($rowcount==0)
                                                {
                                                ?>
                                                <tr>
                                                    <td colspan="4" align="center"><h3 style="color:red">No record found</h3></td>
                                                </tr>
                                                <?php 
                                                } else {
                                                while($row=mysqli_fetch_array($query))
                                                {
                                                ?>
                                                <tr>
                                                    
                                                    <td><?php echo ($row['name']);?></td>
                                                    <td><?php echo ($row['email']);?></td>
                                                    <td><?php echo ($row['phone_no'])?></td>
                                                    <td class="text-nowrap">
                                                        <button type="button" class="btn btn-outline-success" onclick="openEditModal(<?php echo htmlentities($row['id']); ?>) ">
                                                          <i class="fa fa-edit"></i>
                                                        </button> 
                                                        <button class="btn btn-outline-danger deletelist" data-id="<?php echo $row['id']; ?> "><i class="fa fa-trash"></i></button>
                                                         
                                                    </td>
                                                </tr>
                                                <?php } }?>
                                            </tbody>
                                        </table>
                                    </div>
                                    
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
    <scrip>
    <script>

$('#addlistuser').submit(function(e){
e.preventDefault()
 $.ajax({
url:'ajax.php?action=addlist',
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
     alert('UserList Successfully Added.')
 location.reload();
 }
 }
})
})

 $(".deletelist").click(function(){
      var id=$(this).attr('data-id');
       if(confirm("Are you Sure deleted data?")){

        $.ajax({
            url:'ajax.php?action=deletelist',
            method:'POST',
            data:{id:id},
            success:function(resp){
                if(resp==1){
                    alert("Data Deleted Successfully!")
                    setTimeout(function(){
                        location.reload()
                    },1000)

                }
            }
        })

       }
        
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