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
<body  class="hsidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">

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
                <div class="row">
                  <div class="col-sm-6">
                    <h1 class="m-0">Vendor List-  <?php 
            $id=intval($_GET['id']);
            $stats = $con->query("SELECT * FROM list where id='$id'");
            while ($row1 = $stats->fetch_assoc()) {  ?><?php echo $row1['list_name'];?> <?php } ?></h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                      <li class="breadcrumb-item active">Vendor List</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content pb-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dropdown mb-3">
                                  <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Add Member
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo">Manual Entry</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo">Excel File Upload</a>
                                  </div>
                            </div>
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $id = $_GET['id'];
                                            $query=mysqli_query($con,"select * from addmember where list_id='$id'");
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
            <!-- #/ container -->

        </div>

        <!--*********************************
            Content body end
        ***********************************-->

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
          <?php 
            $id=intval($_GET['id']);
            $stats = $con->query("SELECT * FROM list where id='$id'");
            while ($row1 = $stats->fetch_assoc()) {  ?>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">List Name</label>
            <input type="text" class="form-control" id="recipient-name" value="<?php echo $row1['list_name'];?>" readonly required>
             <input type="hidden" class="form-control" name="list_name" value="<?php echo $row1['id'];?>" id="target_sector" >
    
          </div>
          <?php } ?>
          
        
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
                        <label for="recipient-name" class="col-form-label">Degination</label>
                        <input type="text" class="form-control" id="degination" name="degination" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
                         <span id="error_degination" style="color:red"></span>
                    </div>
      </div>
     
      <div class="modal-footer">
           <span id="sucess" style="color:green;"></span>
           <span id="error1" style="color:red;"></span> 
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary add">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

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
               <?php 
                $id=intval($_GET['id']);
                $stats = $con->query("SELECT * FROM list where id='$id'");
                while ($row1 = $stats->fetch_assoc()) {  ?>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">List Name</label>
                <input type="text" class="form-control" id="recipient-name" value="<?php echo $row1['list_name'];?>" readonly required>
                 <input type="hidden" class="form-control" name="list_name" value="<?php echo $row1['id'];?>" id="target_sector" >
        
              </div>
              <?php } ?>
              <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Excel File Upload</label> <a href='example.xlsx' download style="margin-left:10px;" class="btn btn-primary btn-xs mb-2" id="downloadButton">Download Excel</a>
                    <input type="file" class="form-control mb-2" id="customFileInput" name="file" required>
                    <small class="text-danger">Note: Please click on the download button and check CSV format for upload</small>
                </div>
            </div>
            <div class="modal-footer">
                <span id="sucess2" style="color:green;"></span>
                <span id="error2" style="color:red;"></span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary add1">Save</button>
            </div>
        </form>
    </div>
    </div>
</div>

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
    
$('#addlistmember').submit(function(e){
    $(".add").attr("disabled", true);
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
var list_name = $('#list_name').val();
var name = $('#name').val();
var email = $('#email').val();
var phone_number = $('#phone_number').val();
var degination = $('#degination').val();

if (list_name == '') {
    $(".add").attr("disabled", false);
            $("#list_name").css("border", "1px solid red");
            $("#error_list_name").text("Please Enter Your List name");
     
            return false;
        } else {
            $("#error_list_name").text("");
        }
if (name == '') {
        $(".add").attr("disabled", false);
        $("#name").css("border", "1px solid red");
            $("#error_name").text("Please Enter Your name");
            return false;
        } else {
            $("#error_name").text("");
        }

    if (email == '') {
            $(".add").attr("disabled", false);
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
      if (phone_number == '') {
              $(".add").attr("disabled", false);
            $("#phone_number").css("border", "1px solid red");
            $("#error_phone_number").text("Please Enter Your Phone Number");
        } else if (phone_number.length < 10) {
            $("#phone_number").css("border", "1px solid red");
            $("#error_phone_number").text("Contact number contains atleast 10 digit");
            return false;
        } else {
            $("#error_phone_number").text("");
        }
        if (degination == '') {
            $("#degination").css("border", "1px solid red");
            $("#error_degination").text("Please Enter Degination")
            return false;
            $(".add").attr("disabled",false);
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
    $("#sucess").text('Member Successfully Added.');
 location.reload();
 }
 else if (resp == 3) {
    $("#error1").text("Email already exist");
    $(".add").attr("disabled", false);
    setTimeout(function() {
        $("#error1").text('');
         }, 4000);

      }
 }
})
})

    $('#editlistmember').submit(function(e){
    e.preventDefault()
     $.ajax({
        url:'ajax.php?action=editlistmember',
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
$('#addcsvfile').submit(function(e){
        $(".add1").attr("disabled", true);
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
    $("#sucess2").text('Member Successfully Added.');
 location.reload();
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
    $(document).ready(function(){
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
    });    

 
    
  </script>
<?php } ?>
