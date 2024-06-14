<?php
session_start();
include('includes/config.php');
error_reporting(1);
if(strlen($_SESSION['login'])==0 )
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
<body class="hsidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
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
                <h1 class="m-0">Add Vendor</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Add Vendor</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- row -->
        <section class="content">
            <div class="btn-group mb-2" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-info btn-sm mb-1 mr-1" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"> Add Vendor Group</button>
                <div class="dropdown">
                  <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Add Vendor
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo">Manual Entry</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo">Excel File Upload</a>
                  </div>
                </div>
                 <div style='margin-left: 5px;'> <button class="btn btn-warning btn-sm deleteEmail" title="remove inactive email" data-id="0">Sync All List <i class="fa fa-sync-alt"></i></button> </div>
                  
                 
            </div>
            <div class="row">
                <div class="col-md-12">
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
                                            <th>List Name</th>
                                            <th>Visibility Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $id=$_SESSION['login_id'];
                                      
                                       
                                        if($_SESSION['role']=='admin'){
                                            $query=mysqli_query($con,"SELECT list.session_id, visibility_type,list.id, list.list_name, COUNT(addmember.list_id) AS member_count FROM list LEFT JOIN addmember ON list.id = addmember.list_id GROUP BY list.list_name  order by list.id desc");
                                        }
                                        else{
                                             $query=mysqli_query($con,"SELECT list.session_id,  visibility_type, list.id, list.list_name, COUNT(addmember.list_id) AS member_count FROM list LEFT JOIN addmember ON list.id = addmember.list_id WHERE list.session_id='$id' OR visibility_type='Public'   GROUP BY list.list_name  order by list.id desc ");
                                        }
                                       // $id = $_GET['id'];
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
                                            <td><?php echo ($row['list_name'])."(". $row['member_count'].")";?></td>
                                            <td>
                                            <select class="form-control visibility_type" data-id="<?php echo $row['id']; ?>">
                                                    <option value='Public' <?php if($row['visibility_type']=='Public') echo "Selected"; ?>>Public</option>
                                                    <option value='Private' <?php if($row['visibility_type']=='Private') echo "Selected"; ?>>Private</option>
                                            </select>
                                            </td>
                                            <td class="text-nowrap"> 
                                            <?php if($_SESSION['role']=='admin'){ ?>
                                                <button type="button" class="btn btn-info btn-sm preview" data-toggle="modal" data-target="#EditModal" data-id="<?php echo $row['id']; ?>" onclick="openEditModal(<?php echo htmlentities($row['id']); ?>) " title="edit list">
                                                 <i class="fa fa-edit"></i></button>
                                                <a href="view_member.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm" title="view list"><i class="fa fa-eye"></i></a>
                                                
                                                <button class="btn btn-danger btn-sm deletelist" title="delete list" data-id="<?php echo $row['id']; ?> "><i class="fa fa-trash"></i></button>
                                                
                                                <button class="btn btn-warning btn-sm deleteEmail" title="remove inactive email" data-id="<?php echo $row['id']; ?> "><i   class="fa fa-sync-alt"></i></button>
                                                
                                                       
                                                <button class="btn btn-info btn-sm mergeList" title="merge list" data-id="<?php echo $row['id']; ?> "><i class="fa fa-link"></i></button>
                                                
                                                <?php } else{ 
                                                
                                                $disabled='';
                                                 if($row['session_id']!=$id){
                                                $disabled='Disabled';     
                                                 }
                                                ?>
                                                <button <?php echo $disabled; ?> type="button" class="btn btn-info btn-sm preview" data-toggle="modal" data-target="#EditModal" data-id="<?php echo $row['id']; ?>" onclick="openEditModal(<?php echo htmlentities($row['id']); ?>) " title="edit list">
                                                 <i class="fa fa-edit"></i></button>
                                                <a <?php echo $disabled; ?> href="view_member.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm" title="view list"><i class="fa fa-eye"></i></a>
                                                
                                                <button <?php echo $disabled; ?> class="btn btn-danger btn-sm deletelist" title="delete list" data-id="<?php echo $row['id']; ?> "><i class="fa fa-trash"></i></button>
                                                
                                                <button <?php echo $disabled; ?> class="btn btn-warning btn-sm deleteEmail" title="remove inactive email" data-id="<?php echo $row['id']; ?> "><i   class="fa fa-sync-alt"></i></button>
                                                
                                                       
                                                <button <?php echo $disabled; ?> class="btn btn-info btn-sm mergeList" title="merge list" data-id="<?php echo $row['id']; ?> "><i class="fa fa-link"></i></button>
                                                
                                                
                                            <?php     }?>
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
    <!--Create List Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addlistuser">
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="recipient-name" class="col-form-label">List Name</label>
                        <input type="text" class="form-control" id="list_name" name="list_name">
                        <span id="error_lname" style="color:red"></span>
                        </div>
                        <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Visibility Type</label>
                        
                        <select class="form-control" name='visibility_type' id='visibility_type'>
                            <option value='Public'>Public</option>
                            <option value='Private'>Private</option>
                        </select>
                        <span id="error_visibility_type" style="color:red"></span>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <span id="sucess" style="color:green;"></span>
                        <span id="error" style="color:red;"></span>
                        <button type="submit" class="btn btn-primary btn-sm add">Save</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Create List Modal end-->
    
    <!--Manual Entry modal-->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form id="addlistmember">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">List Name</label>
                        <select class="form-control" name="list_name" id="list_name2" >
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
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
                         <span id="error_name" style="color:red"></span>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                         <span id="error_email" style="color:red"></span>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone Number</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_no">
                         <span id="error_phone_number" style="color:red"></span>
                    </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Designation</label>
                        <input type="text" class="form-control" id="degination" name="degination" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
                         <span id="error_degination" style="color:red"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <span id="sucess1" style="color:green;"></span>
                    <span id="error1" style="color:red;"></span>
                    <button type="submit" class="btn btn-primary btn-sm add2">Save</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <!--Manual Entry modal end-->

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addcsvfile">
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">List Name</label>
                    <select class="form-control" name="list_name" id="list_name1" required>
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
                                                        <span id="error_l_name" style="color:red"></span>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Excel File Upload</label> <a href='example.xlsx' download style="margin-left:10px;" class="btn btn-primary btn-xs mb-2" id="downloadButton">Download Excel</a>
                    <input type="file" class="form-control mb-2" id="customFileInput" name="file" 
                    accept=".xlsx, .xls, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                    <small class="text-danger">Note: Please click on the download button and check Excel format for upload</small>
                </div>
            </div>
            <div class="modal-footer">
                 <span id="sucess4" style="color:green;"></span>
                  <span id="error2" style="color:red;"></span>
                <button type="submit" class="btn btn-primary btn-sm add1">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </form>
            </div>
        </div>
    </div>
    <!-- ************ Modal end***********************-->
    
  
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              
                <form id="editlistdata">
                    <div class="modal-body editmodal">
                 
                    </div>
                    <div class="modal-footer">
                        
                  <span id="erroredit" style="color:red;"></span>
                        <span id="sucess2" style="color:green;"></span>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- merge list-->
    <div class="modal fade" id="mergeListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Merge List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="mergeListData">
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Merge with Vender</label>
                        <select class="form-control" name="mergeid" id="mergeid" >
                            <option selected  value="">Select List</option>
                                <?php 
                                 
                                $stats = $con->query("SELECT * FROM list");
                                while ($row1 = $stats->fetch_assoc()) {
                                ?>
                             <option value="<?php echo $row1['id'];?> "><?php echo $row1['list_name'];?></option>
                             <?php } ?>
                        </select>
                        <span id="error_mergeid" style="color:red"></span>
                        </div>
                        <input type="hidden" id="listid" name="listid">
                    </div>
                    <div class="modal-footer">
                        <span id="sucess" style="color:green;"></span>
                        <span id="error" style="color:red;"></span>
                        <button type="submit" class="btn btn-primary btn-sm add">Save</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
    $(".visibility_type").change(function(){
    let visibility_type= $(this).val();
    let id = $(this).attr("data-id");
    
     $.ajax({
url:'ajax.php?action=changeListVisibility',
 data: {id:id,visibility_type:visibility_type},
 method: 'POST',
 
 error:err=>{
 console.log(err)
 },
 success:function(resp){
 if(resp == 1){
 alert("User Account Status Change Successfully");
 }else{
 alert("Something went wrong");    
 }
 }
})
})
    
    
$("#lname").keyup(function() {
        var lname = $('#lname').val();
        if (lname !== '') {
            $("#lname").css("border", "1px solid #2AA3D8");
            $("#error_lname").text("");
        }
    });
 $("#name").keyup(function() {
        var name = $('#name').val();
        if (name !== '') {
            $("#name").css("border", "1px solid #2AA3D8");
            $("#error_name").text("");
        }
    });
    $("#email").keyup(function() {
        var email = $('#email').val();
        if (email !== '') {
            $("#email").css("border", "1px solid #2AA3D8");
            $("#error_email").text("");
        }
    });   
    
   $("#phone_number").keyup(function() {
        var phone_number = $('#phone_number').val();
        if (phone_number !== '') {
            $("#phone_number").css("border", "1px solid #2AA3D8");
            $("#error_phone_number").text("");
        }
    });
    $("#degination").keyup(function() {
        var degination = $('#degination').val();
        if (degination !== '') {
            $("#degination").css("border", "1px solid #2AA3D8");
            $("#error_degination").text("");
        }
    });   
     $("#list_name").change(function() {
        var list_name = $('#list_name').val();
        if (list_name !== '') {
            $("#list_name").css("border", "1px solid #2AA3D8");
            $("#error_list_name").text("");
        }
    }); 
    
    
    
$('#addlistuser').submit(function(e){
$(".add").attr("disabled", true);
var lname = $('#list_name').val();
if (lname == '') {
        $(".add").attr("disabled", false);
            $("#list_name").css("border", "1px solid red");
            $("#error_lname").text("Please Enter List name");
            $(".add").attr("disabled", false);
            return false;
        } else {
            $("#error_lname").text("");
        }
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
 if(resp > 0){
     $("#sucess").text('List Successfully Added.');
     setTimeout(function(){
        window.location.href='view_member.php?id='+resp;
//  window.location.reload();
                    },2000)
 }
  else if (resp == -1) {
    $("#error").text("List name already exist");
    $(".add").attr("disabled", false);
    setTimeout(function() {
        $("#error").text('');
         }, 2000);

      }
 }
})
})


$('#addlistmember').submit(function(e){
    $(".add2").attr("disabled", true);
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
var list_name = $('#list_name2').val();
// alert(list_name);
var name = $('#name').val();
var email = $('#email').val();
var phone_number = $('#phone_number').val();
var degination = $('#degination').val();

if (list_name == '') {
    $(".add2").attr("disabled", false);
            $("#list_name").css("border", "1px solid red");
            $("#error_list_name").text("Please Enter Your List name");
     
            return false;
        } else {
            $("#error_list_name").text("");
        }
if (name == '') {
     $(".add2").attr("disabled", false);
            $("#name").css("border", "1px solid red");
            $("#error_name").text("Please Enter Your name");
            return false;
        } else {
            $("#error_name").text("");
        }

    if (email == '') {
         $(".add2").attr("disabled", false);
         $("#email").css("border", "1px solid red");
         $("#error_email").text("Enter a email address.");
         
      } else if (!emailReg.test(email)) {
         $("#email").css("border", "1px solid red");
         $("#error_email").text("Enter a valid email address.");
          $(".add2").attr("disabled", false);
         return false;
      } else {
         $("#email").css("border", "1px solid #2AA3D8");
         $("#error_email").text("");
      }
      if (phone_number == '') {
           $(".add2").attr("disabled", false);
            $("#phone_number").css("border", "1px solid red");
            $("#error_phone_number").text("Please Enter Your Phone Number");
        } else if (phone_number.length < 10) {
            $("#phone_number").css("border", "1px solid red");
            $("#error_phone_number").text("Contact number contains atleast 10 digit");
        } else {
            $("#error_phone_number").text("");
        }
        if (degination == '') {
             $(".add2").attr("disabled", false);
            $("#degination").css("border", "1px solid red");
            $("#error_degination").text("Please Enter Degination")
            return false;
            $(".add2").attr("disabled",false);
        } else {
            $("#error_degination").text("");
        }
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
 if(resp == 1){
    $("#sucess1").text('Member Successfully Added.');
 
 setTimeout(function() {
  location.reload();
         }, 4000);
 }
 else if (resp == 3) {
    $("#error1").text("Email already exist");
    $(".add2").attr("disabled", false);
    setTimeout(function() {
        $("#error1").text('');
         }, 4000);

      }
 }
})
})

$('#addcsvfile').submit(function(e){
    $(".add1").attr("disabled", true);
    var l_name = $('#l_name').val();

if (l_name == '') {
    $(".add1").attr("disabled", false);
            $("#l_name").css("border", "1px solid red");
            $("#error_l_name").text("Please Enter Your List name");
     
            return false;
        } else {
            $("#error_l_name").text("");
        }
e.preventDefault()
 $.ajax({
url:'ajax.php?action=addcsvfile',
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
    $("#sucess4").text('Member Successfully Added.');
 setTimeout(function() {
        $("#error").text('');
         }, 2000);

      }
 else if (resp == 2) {
    $("#error2").text("Please upload only excel file");
    $(".add1").attr("disabled", false);
    setTimeout(function() {
        $("#error").text('');
         }, 4000);

      }
 }
})
})

// delete email

$(".deleteEmail").click(function(){
      var id=$(this).attr('data-id');
       if(confirm("Are you Sure deleted data?")){
           $.ajax({
                url:'ajax.php?action=deleteEmail',
                method:'POST',
                data:{id:id},
                success:function(resp){
                    if(resp==1){
                        alert("Data Deleted Successfully!")
                        setTimeout(function(){
                            location.reload()
                        },2000)
    
                    }else if(resp==2){
                        alert("Something went wrong!")
                        setTimeout(function(){
                            location.reload()
                        },2000)
                    }else if(resp==3){
                        alert("Already Filtered")
                        setTimeout(function(){
                            location.reload()
                        },2000)
                    }
                }
            })
       }
    
})


$(".mergeList").click(function(){
      var id=$(this).attr('data-id');
      $("#listid").val(id);
  $('#mergeListModal').modal('show');    
})

$('#mergeListData').submit(function(e){
    
    e.preventDefault()
    var mergeid= $("#mergeid").val();
    var listid= $("#listid").val();
    if(mergeid==""){
         $("#mergeid").css("border", "1px solid red");
            $("#error_mergeid").text("Please select list");
            return false;
    }
    
    $.ajax({
            url:'ajax.php?action=mergelist',
            method:'POST',
            data:{listid:listid,mergeid:mergeid },
            success:function(resp){
                if(resp==1){
                    alert("Data Merged Successfully!")
                }else{
                    alert("Something Went worng!")
                }
                 setTimeout(function(){
                        location.reload()
                    },2000)
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
              url:'ajax.php?action=editlist',
              data:{id:id},
              success:function(data){ 
                  $('.editmodal').html(data);
                 
              }
          });
           }); 
       });    




$('#editlistdata').submit(function(e){
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
 if(resp == 2){
     $("#sucess2").text('List Successfully Updated.');
       setTimeout(function(){
 window.location.reload();
                    },2000)
 
 }
 if(resp == 3){
     $("#erroredit").text('Already Exist!');
 setTimeout(function(){
 window.location.reload();
                    },2000)
 }
 }
})
})

</script>
 <!--<script>-->
 
 <!--   const data = [-->
 <!--     ['Name', 'Email','Phone', 'Degination'],-->
 <!--     ['John', 'john@gmail.com','8787765788','Lead'],-->
 <!--     ['Smith','Smith@gmail.com','8787765788','Lead']-->
 <!--   ];-->

    // Function to create and download the CSV file
 <!--   function downloadCSV() {-->
      // Convert the data to CSV format
 <!--     const csvContent = data.map(row => row.join(',')).join('\n');-->

      // Create a Blob
 <!--     const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });-->

      // Create a downloadable URL
 <!--     const url = URL.createObjectURL(blob);-->

      // Trigger the download
 <!--     const downloadLink = document.createElement('a');-->
 <!--     downloadLink.href = url;-->
 <!--     downloadLink.setAttribute('download', 'example.xls');-->
 <!--     downloadLink.click();-->

      // Release the object URL
 <!--     URL.revokeObjectURL(url);-->
 <!--   }-->

    // Attach the event listener to the button
 <!--   const button = document.getElementById('downloadButton');-->
 <!--   button.addEventListener('click', downloadCSV);-->
 <!-- </script>-->
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