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

<?php include("head.php"); 
// ../../../../home3/yqbhzkmy/public_html/marketing-panel/

?>


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
                    <h1 class="m-0">Templates</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                      <li class="breadcrumb-item active">Templates</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    <form id="sendmail">
                        <div class="row">
                            
                            <div class="col-md-3 col-sm-6">
                                <div class="templatebox">
                                    <div class="temp-img">
                                        <div class="templacheck">
                                            <input type="radio" id="check1" name="check" value="Month Calendar">
                                            <label for="check1"></label>
                                        </div>
                                        <img src="images/template/template-1.jpg" alt="">
                                    </div>
                                    <h4>Month Calendar</h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="templatebox">
                                    <div class="temp-img">
                                        <div class="templacheck">
                                            <input type="radio" id="check2" name="check" value="Thanks Giving">
                                            <label for="check2"></label>
                                        </div>
                                        <img src="images/template/template-2.jpg" alt="">
                                    </div>
                                     <h4>Thanks Giving</h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="templatebox">
                                    <div class="temp-img">
                                        <div class="templacheck">
                                            <input type="radio" id="check3" name="check" value="Webinar">
                                            <label for="check3"></label>
                                        </div>
                                        <img src="images/template/template-3.jpg" alt="">
                                    </div>
                                     <h4>Webinar</h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="templatebox">
                                    <div class="temp-img">
                                        <div class="templacheck">
                                            <input type="radio" id="check4" name="check" value="Month Calendar">
                                            <label for="check4"></label>
                                        </div>
                                        <img src="images/template/template-1.jpg" alt="">
                                    </div>
                                    <h4>Month Calendar</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-3">
                            <span id="sucess" style="color:green;"></span>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">Send Email Template</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- #/ container -->

        </div>

        <!--*********************************
            Content body end
        ***********************************-->
        
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">View Tamplate</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>        
        
        
<?php include("footer.php"); ?>

</div>
<?php include("script.php"); ?>

<!--**********************************
    Main wrapper end
***********************************-->


<!-- Page specific script -->
<script>
  $('#example1').DataTable();
  

$('#sendmail').submit(function(e){
e.preventDefault()
 $.ajax({
url:'ajax.php?action=sendmail',
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
    var a=$("#sucess").text('Email Send Successfully.');
    setTimeout(function() {
              location.reload();

            }, 3000);
 }
 }
})
})
</script>
</body>
</html>

<?php } ?>
