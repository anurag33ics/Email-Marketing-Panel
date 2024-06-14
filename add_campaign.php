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
                <h1 class="m-0">Add Campaign</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Add Campaign</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- row -->
        <section class="content">
            <div class="btn-group mb-2" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-info btn-sm mb-1 mr-1" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"> Create Campaign</button>
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-validation">
                        <div class="row">
                            <div class="col-sm-6">
                                <!---Success Message--->  
                                <?php if($msg){ ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Campaign Updated!</strong>
                                    </div>
                                <?php } ?>
                                <!---Error Message--->
                                <?php if($error){ ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($error);?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>  
                    <div class="table-new">
                        <div class="table-responsive">
                                <table id="example1" class="table table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>Campaign Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id=$_SESSION['login_id'];
                                        if($_SESSION['role']=='admin'){
                                        $query=mysqli_query($con,"select * from campaign order by id desc");
                                        }
                                        else{
                                            $query=mysqli_query($con,"select * from campaign where session_id='$id' order by id desc");
                                        }
                                        $id = $_GET['id'];
                                         $cnt=1;
                                        $rowcount=mysqli_num_rows($query);
                                        if($rowcount==0)
                                        {
                                        ?>
                                        <tr>
                                            <td colspan="4" align="center"><h4 style="color:red">No record found</h4></td>
                                        </tr>
                                        <?php 
                                        } else {
                                        while($row=mysqli_fetch_array($query))
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo ($row['campaign_name']);?></td>
                                            <td class="text-nowrap">
                                                <button type="button" class="btn btn-info btn-sm preview" data-toggle="modal" data-target="#EditModal" data-id="<?php echo $row['id']; ?>" onclick="openEditModal(<?php echo htmlentities($row['id']); ?>) ">
                                                 <i class="fa fa-edit"></i></button>
                                                
                                                <button class="btn btn-danger btn-sm deleteCampaign" data-id="<?php echo $row['id']; ?> "><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>
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
    <!--Create Campaign Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Campaign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addCampaignuser">
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Campaign Name</label>
                        <input type="text" class="form-control" id="cname" name="campaign_name">
                        <span id="error_cname" style="color:red"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span id="error" style="color:red;"></span>
                        <span id="sucess" style="color:green;"></span>
                        <button type="submit" class="btn btn-primary btn-sm add">Save</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Create Campaign Modal end-->

    
    
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Campaign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              
                <form id="editCampaigndata">
                    <div class="modal-body editmodal">
                 
                    </div>
                    <div class="modal-footer">
                        <span id="sucess2" style="color:green;"></span>
                        <button type="submit" class="btn btn-primary btn-sm add1">Save</button>
                        <button type="button" class="btn btn-danger btn-sm " data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
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
$("#cname").keyup(function() {
        var cname = $('#cname').val();
        if (cname !== '') {
            $("#cname").css("border", "1px solid #2AA3D8");
            $("#error_cname").text("");
        }
    });
$('#addCampaignuser').submit(function(e){
        $(".add").attr("disabled", true);
var cname = $('#cname').val();
if (cname == '') {
        $(".add").attr("disabled",false);
            $("#cname").css("border", "1px solid red");
            $("#error_cname").text("Please Enter Campaign name");
            $(".add").attr("disabled", false);
            return false;
        } else {
            $("#error_cname").text("");
        }

e.preventDefault()
 $.ajax({
url:'ajax.php?action=addCampaign',
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
     $("#sucess").text('Campaign Successfully Added.');
 location.reload();
 }
 else if (resp == 3) {
    $("#error").text("Campaign name already exist");
    $(".add").attr("disabled", false);
    setTimeout(function() {
        $("#error").text('');
         }, 4000);

      }
 }
})
})

 $(".deleteCampaign").click(function(){
      var id=$(this).attr('data-id');
       if(confirm("Are you Sure deleted data?")){

        $.ajax({
            url:'ajax.php?action=deleteCampaign',
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
  $(document).ready(function(){
       
       $(".preview").on("click",function(){
           var id = $(this).attr('data-id');
           
          $.ajax({
              type:'post',
              url:'ajax.php?action=editCampaign',
              data:{id:id},
              success:function(data){ 
                  $('.editmodal').html(data);
                 
              }
          });
           }); 
       });    




$('#editCampaigndata').submit(function(e){
    $(".add1").attr("disabled", true);
e.preventDefault()
 $.ajax({
url:'ajax.php?action=addCampaign',
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
 if(resp == 2){
     $("#sucess2").text('Campaign Successfully Updated.');
 location.reload();
 }
 }
})
})

</script>

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