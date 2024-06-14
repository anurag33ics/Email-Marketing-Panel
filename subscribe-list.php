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
                    <h1 class="m-0">Subscribe List</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                      <li class="breadcrumb-item active">Subscribe List</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
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
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                             <th>Message</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $query=mysqli_query($con,"select * from contact");
                                        $id = $_GET['id'];
                                         $cnt=1;
                                        $rowcount=mysqli_num_rows($query);
                                        if($rowcount==0)
                                        {
                                        ?>
                                        <tr>
                                            <td colspan="5" align="center"><h5 style="color:red">No record found</h5></td>
                                        </tr>
                                        <?php 
                                        } else {
                                        while($row=mysqli_fetch_array($query))
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($row['name']);?></td>
                                            <td><?php echo ($row['phone'])?></td>
                                            <td><?php echo ($row['email']);?></td>
                                            <td><?php echo ($row['message']);?></td>
                                            <td class="text-nowrap">
                                                <button type="button" class="btn btn-outline-success" onclick="openEditModal(<?php echo htmlentities($row['id']); ?>) ">
                                                  <i class="fa fa-edit"></i>
                                                </button> 
                                                <a href="contact.php?id=<?php echo htmlentities($row['id']);?>&&action=del" onclick="return confirm('Do you reaaly want to delete ?')" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                                 
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

<?php } ?>
