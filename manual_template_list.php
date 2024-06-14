<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{
header('location:index.php');
}
else{
if($_GET['action']=='del')
{
$postid=intval($_GET['id']);
//echo "DELETE FROM tbladminblog WHERE id ='$postid'";
$query=mysqli_query($con,"DELETE FROM admin WHERE id ='$postid'");
if($query)
{
$msg="Post deleted ";
}
else{
$error="Something went wrong . Please try again.";
}
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
                <h1 class="m-0">Manual Template</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">View Manual Template</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div>
        </div>
        <!-- row -->
        <section class="content">
            <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List</h3>
                            <div class="card-tools">
                                <a href="manual_template.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Add Template</a>
                                <a class="btn btn-primary btn-sm" id="updateMailStatus"><i class="fa fa-plus"></i>&nbsp; Update Daily Mail Status</a>
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
                                
                                
                                
                                
                                <div class="table-new">
                                    <div class="table-responsive">
                                    <table id="example1" class="table table-bordered m-0 zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#Id</th>
                                            <th>Created date</th>
                                            <th>Name</th>
                                            <th>View</th>
                                            <th>Test Email</th>
                                            <th>Send Email</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($_SESSION['role']=="admin"){
                                        $query=mysqli_query($con,"select * from manual_templete order by id desc" );    
                                        }else{
                                            $query=mysqli_query($con,"select * from manual_templete WHERE session_id= '".$_SESSION['login_id']."' order by id DESC");
                                        }
                                        
                                        
                                        $cnt=1;
                                        $rowcount=mysqli_num_rows($query);
                                        if($rowcount==0)
                                        {
                                        ?>
                                        <tr>
                                            <td colspan="5" align="center"><h3 style="color:red">No record found</h3></td>
                                        </tr>
                                        <?php
                                        } else {
                                        while($row=mysqli_fetch_array($query))
                                        {
                                        ?>
                                        <tr>
                                              <td><?php echo ($row['id']);?></td>
                                              <td><?php echo date("d-m-Y H:s:i", strtotime($row['created_dt']));?></td>
                                            <td><?php echo htmlentities($row['template_name']);?></td>
                                            
                                            <td><button type="button" class="btn btn-primary btn-sm openModal" data-toggle="modal" 
                                        data-id='<?php echo $row['id'] ?>' style="background-color:#03045e; border-color:#03045e"> View</button>
                                            </td>
                                            <td><a href='' class="btn btn-primary btn-sm sendTestEmail" data-toggle="modal" data-name='<?php echo $row['template_name'] ?>'
                                    data-id='<?php echo $row['id'] ?>'>Test Email</a></td>
                                    <td><a href='' class="btn btn-success btn-sm sendEmailModal" data-toggle="modal" data-name='<?php echo $row['template_name'] ?>'
                                    data-id='<?php echo $row['id'] ?>'>Send Email</a></td>
                                    <!--<td>delete</td>-->
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
        
        
        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              
                <form id="edituserdata">
                    <div class="modal-body editmodal">
                 
                    </div>
                    <div class="modal-footer">
                        <span id="success" style="color:green;"></span>
                        <button type="submit" class="btn btn-primary btn-sm add">Save</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
        <!--**********************************
        Main wrapper end
        ***********************************-->
        <!--**********************************
        Scripts
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
        <!-- update email status-->
<div id="myModalStatus" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Email Status</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="modalbody">
          <form id="updateEmailStatusForm">
          <div class="modal-body">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">From</label>
                <input type="date" class="form-control" id="fromdate" name="fromdate">
                <span id="error_fromdate" style="color:red"></span>
                </div>
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">To</label>
                <input type="date" class="form-control" id="todate" name="todate" >
                <span id="error_todate" style="color:red"></span>
                </div>
            </div>
            <div class="modal-footer">
                <span id="sucess" style="color:green;"></span>
                <button type="submit" class="btn btn-primary btn-sm save">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </form>
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

<!--send mail-->
<div id="sendEmailModal1" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Send to Email</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="sendEamil">
          <div class="modal-body">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Template Name</label>
                <input type="text" class="form-control" id="template1" name="template" readonly>
                <input type="hidden" class="form-control" id="templatepath1" name="templatepath1" readonly>
                </div>
                <div class="form-group">
                        <label for="recipient-name" class="col-form-label">List Name</label>
                        <select class="form-control" name="list_name" id="list_name">
                            <option selected  value="">Select List</option>
                                <?php 
                                $id=$_SESSION['login_id'];
                                // if($_SESSION['role']=='admin'){
                                // $stats = $con->query("SELECT * FROM list");
                                // }
                                // else{
                                //   $stats = $con->query("SELECT * FROM list where session_id='$id'");   
                                // }
                                
                                 if($_SESSION['role']=='admin'){
                                            $stats=mysqli_query($con,"SELECT list.session_id, visibility_type,list.id, list.list_name, COUNT(addmember.list_id) AS member_count FROM list LEFT JOIN addmember ON list.id = addmember.list_id GROUP BY list.list_name  order by list.id desc");
                                        }
                                        else{
                                             $stats=mysqli_query($con,"SELECT list.session_id,  visibility_type, list.id, list.list_name, COUNT(addmember.list_id) AS member_count FROM list LEFT JOIN addmember ON list.id = addmember.list_id WHERE list.session_id='$id' OR visibility_type='Public'   GROUP BY list.list_name  order by list.id desc ");
                                        }
                                while ($row1 = $stats->fetch_assoc()) {
                                ?>
                               <option value="<?php echo $row1['id'];?> "><?php echo $row1['list_name']."(".$row1['member_count'].")";?></option>
                             <?php } ?>
                        </select>
                         <span id="error_list_name" style="color:red"></span>
                    </div>
                <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Salutation</label>
                       <select class="form-control" name="salutation" id="salutation">
                                     <!--<option selected  value="">Select</option>-->
                                     <!--<option value="Hi-FirstName">Hi [FirstName]</option>-->
                                     <!--<option value="Hello-FirstName">Hello [FirstName]</option>-->
                                     <!--<option value="Hi-FirstNameLastName">Hi [FirstName LastName]</option>-->
                                     <!--<option value="Hi-FirstNameLastName">Hello [FirstName LastName]</option>-->
                                     <option value="Dear-FirstNameLastName">Dear [FirstName LastName]</option>
                                     </select>
                          <span id="error_cname" style="color:red"></span>
                    </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Signature</label>
                           <select class="form-control" name="signature" id="signature">
                                     <!--<option selected  value="">Select</option>-->
                                     <option value="<?php echo $_SESSION['login_id']; ?>" >
                                          <?php echo $_SESSION['name'] ?></option>
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
        <?php include("script.php"); ?>
    </body>
</html>
<?php } ?>
<script>
// my code
$("#updateMailStatus").click(function() {
  $('#myModalStatus').modal('show');  
})
$(".openModal").click(function() {

            var path = $(this).attr('data-id');
            
            $.ajax({
                type: "GET",
                url: "ajax.php?action=viewManualTemplate&id="+path,
                // data: {'des_id' : des_id},
                // data: {
                //     path: path
                // },
                success: function(data) {
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
//  
 $(".sendEmailModal").click(function() {
        var path = $(this).attr('data-id');
        var tempName = $(this).attr('data-name');
        $("#template1").val(tempName);
        $("#templatepath1").val(path);
        $('#sendEmailModal1').modal('show');
 }); 
 
//  update status
$("#updateEmailStatusForm").submit(function(e){
    
var fromdate = $('#fromdate').val();
 var todate = $('#todate').val();    
if(fromdate==""){
    $(".save").attr("disabled", false);
    $("#fromdate").css("border", "1px solid red");
    $("#error_fromdate").text("Please select from");
    return false;
} else {
    $("#error_fromdate").text("");
}

if(todate==""){
     
 $(".save").attr("disabled", false);
    $("#todate").css("border", "1px solid red");
    $("#error_todate").text("Please select to");

    return false;
} else {
    $("#error_todate").text("");
}

 
 e.preventDefault()
 $.ajax({
url:'ajax.php?action=updateStatusEmail',
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
     $("#sucessmail").text("Successfully updated");
// setTimeout(function(){
//         window.location.reload();
//     },2000)
 }else{
     $("#sucessmail").text("Something went wrong");
    //  setTimeout(function(){
    //     window.location.reload();
    // },2000)
 }
 }
})
 
})
 
 
 
//  send email 
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
url:'ajax.php?action=sendManualtemplateEamil',
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
setTimeout(function(){
        window.location.reload();
    },2000)
 }
 }
})
})
// test
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
url:'ajax.php?action=sendTestEmailManual',
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
       setTimeout(function(){
        window.location.reload();
    },2000)
    
 }
 }
})
})

// 












$('#edituserdata').submit(function(e){
$(".add").attr("disabled", true);
e.preventDefault()
 $.ajax({
url:'ajax.php?action=adduser',
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
 $("#success").text("User updated Successfully");
 location.href='manage_user.php';
 }
 }
})
})
$(".deleteuser").click(function(){
      var id=$(this).attr('data-id');
       if(confirm("Are you Sure deleted data?")){

        $.ajax({
            url:'ajax.php?action=deleteuser',
            method:'POST',
            data:{id:id},
            success:function(resp){
                if(resp==1){
                    alert("Data Deleted Successfully!")
                    setTimeout(function(){
                        location.reload()
                    },2000)

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
              url:'ajax.php?action=edituser',
              data:{id:id},
              success:function(data){ 
                  $('.editmodal').html(data);
                 
              }
          });
           }); 
       });    
     
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
// $('#example1').DataTable(); 
new DataTable('#example1', {
    order: [[0, 'desc']]
});
</script>