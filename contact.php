<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0){ 
    header('location:index.php');
}
else{
if($_GET['action']=='del'){
    $id=intval($_GET['id']);
    $query=mysqli_query($con,"delete from contact where id='$id'");
    if($query){
        $msg="Post deleted ";
    }
    else{
        $error="Something went wrong . Please try again.";    
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
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0">Contact Us</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                      <li class="breadcrumb-item active">Contact list</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content mb-4">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-validation">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!---Success Message--->  
                                    <?php if($msg){ ?>
                                        <div class="alert alert-success" role="alert">
                                            <strong>List Updated!</strong>
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
                                            <th>Sr.No</th>
                                                 <th>Name</th>
                                                 <th>Email</th>
                                                <th>Phone No</th>
                                                <th>Degination</th>
                                                 <th>Status</th>
                                                <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                             $id=$_SESSION['login_id'];
                                             if($_SESSION['role']=='admin'){
                                                $query=mysqli_query($con,"select * from addmember order by id desc");
                                             }
                                             else{
                                                 $query=mysqli_query($con,"select * from addmember where session_id='$id' order by id desc");
                                             }
                                                $id = $_GET['id'];
                                                 $cnt=1;
                                                $rowcount=mysqli_num_rows($query);
                                                if($rowcount==0)
                                                {
                                            ?>
                                            <tr>
                                                <td colspan="6" align="center"><h4 style="color:red">No record found</h4></td>
                                            </tr>
                                            <?php 
                                            } else {
                                                $i=1;
                                            while($row=mysqli_fetch_array($query))
                                            {
                                            ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo ($row['name']);?></td>
                                                <td><?php echo ($row['email']);?></td>
                                                <td><?php echo ($row['phone_no'])?></td>
                                                <td><?php echo ($row['degination'])?></td>
                                                <td><?php echo ($row['status'])?></td>
                                                <td class="text-nowrap">
                                                    <button type="button" class="btn btn-info btn-sm preview" data-toggle="modal" data-target="#AddModal" data-id="<?php echo $row['id']; ?> ">
                                                      <i class="typcn typcn-edit"></i>
                                                    </button> 
                                                    <button class="btn btn-danger btn-sm deleteunsubscribe" data-id="<?php echo $row['id']; ?> "><i class="typcn typcn-trash"></i></button>
                                                     
                                                </td>
                                            </tr>
                                            <?php $i++; } }?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>
           

        </div>
       <?php include("footer.php"); ?>
    </div>

     <?php include("script.php"); ?>
    

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editlistmember">
                <div class="modal-body editlistdata"></div>
                <div class="modal-footer">
                    <span id="sucess1" style="color:green;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>

<?php } ?>
<script>
  $('#example1').DataTable();
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
});

       $(".preview").on("click",function(){
           var id = $(this).attr('data-id');
           
          $.ajax({
              type:'post',
              url:'ajax.php?action=editmember',
              data:{id:id},
              success:function(data){ 
                  $('.editlistdata').html(data);
                 
              }
          });
           }); 
   
    
     $('#editlistmember').submit(function(e){
    e.preventDefault()
     $.ajax({
        url:'ajax.php?action=addlistmember',
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
            $("#sucess1").text('Member Successfully Updated.');
         location.reload();
         }
         }
    })
})  
    $(".deleteunsubscribe").click(function(){
      var id=$(this).attr('data-id');
       if(confirm("Are you Sure deleted data?")){
        $.ajax({
            url:'ajax.php?action=deletemember',
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
