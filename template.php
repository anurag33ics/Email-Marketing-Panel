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

<style>
    
    
</style>

 
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
                        <div class="row">
                            <?php $folder_path = "email-template/*.php";
                                $files = glob($folder_path);
                                $m=1;
                                foreach($files as $file) {
                                 $filename=$file;
                                ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="tempbox">
                                    <div class="temp-ico"><i class="typcn typcn-film"></i></div>
                                    <h4><?php echo strtoupper(str_replace(".php","",str_replace("email-template/","",$filename))); ?></h4>
                                    <a href='' class="btn btn-success btn-sm sendEmailModal" data-toggle="modal" data-name='<?php echo strtoupper(str_replace(".php","",str_replace("email-template/","",$filename))) ?>'
                                    data-id='<?php echo $file ?>'>Send Email</a>
                                    <a href='' class="btn btn-primary btn-sm sendTestEmail" data-toggle="modal" data-name='<?php echo strtoupper(str_replace(".php","",str_replace("email-template/","",$filename))) ?>'
                                    data-id='<?php echo $file ?>'>Test Email</a>
                                    
                                    <button type="button" class="btn btn-primary btn-sm openModal" data-toggle="modal" data-id='<?php echo $file ?>'>View</button>
                                </div>
                            </div>
                            
                            <?php 
                            if($m%3==0){
                                echo "</div><div class='row'>";
                            }
                            $m++; } ?>
                           
                        </div>
                        
            </div>
            </section>
            <!-- #/ container -->

        </div>

        <!--*********************************
            Content body end
        ***********************************-->
        
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">View Tamplate</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="modalbody">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 

<!-- Test Email Modal -->
<div id="testEmailModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Send Test Email</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="sendTestEamil">
          <div class="modal-body">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Template Name</label>
                <input type="text" class="form-control" id="template" name="template" readonly>
                <input type="hidden" class="form-control" id="templatepath" name="templatepath" readonly>
                </div>
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" >
                <span id="error_subject" style="color:red"></span>
                </div>
            
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" >
                <span id="error_email" style="color:red"></span>
                </div>
            </div>
            <div class="modal-footer">
                <span id="sucess" style="color:green;"></span>
                <button type="submit" class="btn btn-primary btn-sm add1">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>

  </div>
</div> 
        
<div id="sendEmailModal1" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Send Test Email</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="sendEamil">
          <div class="modal-body">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Template Name</label>
                <input type="text" class="form-control" id="template1" name="template" readonly>
                <input type="hidden" class="form-control" id="templatepath" name="templatepath" readonly>
                </div>
                <div class="form-group">
                        <label for="recipient-name" class="col-form-label">List Name</label>
                        <select class="form-control" name="list_name" id="list_name">
                            <option selected  value="">Select List</option>
                                <?php 
                                $id=$_SESSION['login_id'];
                                if($_SESSION['role']=='admin'){
                                $stats = $con->query("SELECT * FROM list");
                                }
                                else{
                                  $stats = $con->query("SELECT * FROM list where session_id='$id'");   
                                }
                                while ($row1 = $stats->fetch_assoc()) {
                                ?>
                               <option value="<?php echo $row1['id'];?> "><?php echo $row1['list_name'];?></option>
                             <?php } ?>
                        </select>
                         <span id="error_list_name" style="color:red"></span>
                    </div>
                <div class="form-group">
                        <label for="recipient-name" class="col-form-label">campaign Name</label>
                        <select class="form-control" name="campaign_name" id="cname">
                            <option selected  value="">Select campaign</option>
                                <?php
                                     $id=$_SESSION['login_id'];
                                     if($_SESSION['role']=='admin'){
                                        $stats1 = $con->query("SELECT * FROM campaign");
                                      }else{
                                        $stats1 = $con->query("SELECT * FROM campaign where session_id='$id'");
                                        }
                                      while ($row2 = $stats1->fetch_assoc()) {
                                                                ?>
                               <option value="<?php echo $row2['campaign_name'];?> "><?php echo $row2['campaign_name'];?></option>
                             <?php } ?>
                        </select>
                          <span id="error_cname" style="color:red"></span>
                    </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email Shoot</label>
                        <select class="form-control" name="email_shoot" id="eshoot">
                            <option selected  value="">Select Email Shoot</option>
                                
                               <option value="Email Shoot1">Email Shoot1</option>
                               <option value="Email Shoot2">Email Shoot2</option>
                               <option value="Email Shoot3">Email Shoot3</option>
                               <option value="Email Shoot4">Email Shoot4</option>
                               <option value="Email Shoot5">Email Shoot5</option>
                             
                        </select>
                          <span id="error_eshoot" style="color:red"></span>
                    </div>
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Subject</label>
                <input type="text" class="form-control" id="sub" name="subject">
                <span id="error_sub" style="color:red"></span>
                </div>
            </div>
            <div class="modal-footer">
                <span id="sucessmail" style="color:green;"></span>
                <button type="submit" class="btn btn-primary btn-sm add">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>

  </div>
</div>      
<?php include("footer.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    
</script>
<script>
  
      $(".openModal").click(function() {

            var path = $(this).attr('data-id');
            
            $.ajax({
                type: "GET",
                url: "ajax.php?action=viewTemplate",
                // data: {'des_id' : des_id},
                data: {
                    path: path
                },
                success: function(data) {
                    //console.log(data);
                    $("#modalbody").html('');
                    $("#modalbody").html(data);
                    
                }
            });
            $('#myModal').modal('show');
        });
        
// open test email modal
 $(".sendTestEmail").click(function() {
        var path = $(this).attr('data-id');
        var tempName = $(this).attr('data-name');
        $("#template").val(tempName);
        $("#templatepath").val(path);
        $('#testEmailModal').modal('show');
 });
 $(".sendEmailModal").click(function() {
        var path = $(this).attr('data-id');
        var tempName = $(this).attr('data-name');
        $("#template1").val(tempName);
        $('#sendEmailModal1').modal('show');
 }); 
 $("#email").keyup(function() {
        var email = $('#email').val();
        if (email !== '') {
            $("#email").css("border", "1px solid #2AA3D8");
            $("#error_email").text("");
        }
    });  
      $("#subject").keyup(function() {
        var subject = $('#subject').val();
        if (subject !== '') {
            $("#subject").css("border", "1px solid #2AA3D8");
            $("#error_subject").text("");
        }
    });  
$('#sendTestEamil').submit(function(e){
 $(".add1").attr("disabled", true);
 var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
 var subject = $('#subject').val();
var email = $('#email').val();
if (subject  == '') {
    $(".add1").attr("disabled", false);
            $("#subject ").css("border", "1px solid red");
            $("#error_subject ").text("Please Enter Subject Name");
     
            return false;
        } else {
            $("#error_subject").text("");
        }
 if (email == '') {
     $(".add1").attr("disabled", false);
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
e.preventDefault()
 $.ajax({
url:'ajax.php?action=sendTestEmail',
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
     $("#sucess").text("Email Send Successfully");
 location.reload();
 }
 }
})
})
$("#sub").keyup(function() {
        var sub = $('#sub').val();
        if (sub !== '') {
            $("#sub").css("border", "1px solid #2AA3D8");
            $("#error_sub").text("");
        }
    }); 
    $("#list_name").change(function() {
        var list_name = $('#list_name').val();
        if (list_name !== '') {
            $("#list_name").css("border", "1px solid #2AA3D8");
            $("#error_list_name").text("");
        }
    }); 
    
    $("#cname").change(function() {
        var cname = $('#cname').val();
        if (cname !== '') {
            $("#cname").css("border", "1px solid #2AA3D8");
            $("#error_cname").text("");
        }
    }); 
    $("#eshoot").change(function() {
        var eshoot = $('#eshoot').val();
        if (cname !== '') {
            $("#eshoot").css("border", "1px solid #2AA3D8");
            $("#error_eshoot").text("");
        }
    }); 
    
$('#sendEamil').submit(function(e){
$(".add").attr("disabled", true);

var sub = $('#sub').val();
 var cname = $('#cname').val();
 var eshoot = $('#eshoot').val();
var list_name = $('#list_name ').val();
if (list_name  == '') {
    $(".add").attr("disabled", false);
            $("#list_name").css("border", "1px solid red");
            $("#error_list_name").text("Please select listname");
     
            return false;
        } else {
            $("#error_list_name").text("");
        }
        if (cname  == '') {
    $(".add").attr("disabled", false);
            $("#cname").css("border", "1px solid red");
            $("#error_cname").text("Please select campaign name");
     
            return false;
        } else {
            $("#error_cname").text("");
        }
        
        if (eshoot  == '') {
    $(".add").attr("disabled", false);
            $("#eshoot").css("border", "1px solid red");
            $("#error_eshoot").text("Please select shoot");
     
            return false;
        } else {
            $("#error_eshoot").text("");
        }
        if (sub  == '') {
    $(".add").attr("disabled", false);
            $("#sub ").css("border", "1px solid red");
            $("#error_sub").text("Please Enter Subject Name");
     
            return false;
        } else {
            $("#error_sub").text("");
        }
e.preventDefault()
 $.ajax({
url:'ajax.php?action=sendtemplateEamil',
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
     $("#sucessmail").text("Email Send Successfully");
 location.reload();
 }
 }
})
})
</script>
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
