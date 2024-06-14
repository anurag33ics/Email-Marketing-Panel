<?php session_start();
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
                    <h1 class="m-0">Unsubscribe List</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                      <li class="breadcrumb-item active">Unsubscribe List</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
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
                        <div class="card">
                                <div class="card-body pt-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form id="filtercamp">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                           <select class="form-control" name="campaign_name" id="cname" >
                                                            <option selected  value="">Select campaign</option>
                                                                <?php
                                                                $id=$_SESSION['login_id'];
                                                                if($_SESSION['role']=='admin'){
                                                                $stats1 = $con->query("SELECT * FROM campaign");
                                                                }
                                                                else{
                                                                     $stats1 = $con->query("SELECT * FROM campaign where session_id='$id'");
                                                                }
                                                                while ($row2 = $stats1->fetch_assoc()) {
                                                                ?>
                                                               <option value="<?php echo $row2['campaign_name'];?> "><?php echo $row2['campaign_name'];?></option>
                                                             <?php } ?>
                                                        </select>
                                                         <span id="error_cname" style="color:red"></span>
                                                        </div>
                                                        
                                                    </div>
                                                    <div id="chart_div"></div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary add2">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                       
                                    </div>
                                </div>
                            </div>
                        <div class="table-new">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                             <th>SR.NO</th>
                                             <th>Email</th>
                                             <th>Reason</th>
                                             <th>Checkbox</th>
                                             <th>campaign Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $query=mysqli_query($con,"select * from unsubscribe order by id desc");
                                        $id = $_GET['id'];
                                         $cnt=1;
                                        $rowcount=mysqli_num_rows($query);
                                        if($rowcount==0)
                                        {
                                        ?>
                                        <tr>
                                            <td colspan="4" align="center"><h5 style="color:red">No record found</h5></td>
                                        </tr>
                                        <?php 
                                        } else {
                                            $i=1;
                                        while($row=mysqli_fetch_array($query))
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo ($row['email']);?></td>
                                            <td><?php echo ($row['reason']);?></td>
                                            <td><?php echo ($row['checkbox'])?></td>
                                            <td><?php echo ($row['campaign_name'])?></td>
                                            <td class="text-nowrap">
                                                <button class="btn btn-outline-danger deleteunsubscribe" data-id="<?php echo $row['id']; ?> "><i class="fa fa-trash"></i></button>
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
            <!-- #/ container -->

        </div>

        <!--*********************************
            Content body end
        ***********************************-->
<?php include("footer.php"); ?>

</div>
<?php include("script.php"); ?>

<!--**********************************
    Main wrapper end
***********************************-->


<!-- Page specific script -->
<script>
  $('#example1').DataTable();
</script>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script>

     $(".deleteunsubscribe").click(function(){
      var id=$(this).attr('data-id');
       if(confirm("Are you Sure deleted data?")){

        $.ajax({
            url:'ajax.php?action=deleteunsubscribe',
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
 $("#cname").change(function() {
        var cname = $('#cname').val();
        if (cname !== '') {
            $("#cname").css("border", "1px solid #2AA3D8");
            $("#error_cname").text("");
        }
    });       
$('#filtercamp').submit(function(e){
    var cname = $('#cname').val();
    if (cname == '') {
            $("#cname").css("border", "1px solid red");
            $("#error_cname").text("Please Select campaign name");
          return false;
        } else {
            $("#error_cname").text("");
        }
    e.preventDefault();
    $.ajax({
        url:'ajax.php?action=filtercampunsubscribe',
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
           $('#example1').dataTable().fnDestroy();
           $("#example1 tbody").html(resp);
          $('#example1').DataTable(); 
         }
    })
})      
</script>
<?php } ?>
