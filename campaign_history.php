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
$id=$_SESSION['login_id'];
if($_SESSION['role']=='admin'){
$stats = $con->query("SELECT COUNT(email_open_status) as email_open_status FROM `sendemaildata` WHERE email_open_status='open'");
while ($row3 = $stats->fetch_assoc()) {
    $openstatus=$row3['email_open_status'];
}
$stats = $con->query("SELECT COUNT(email_send_status) as email_send_status FROM `sendemaildata` WHERE email_send_status='yes'");
while ($row4 = $stats->fetch_assoc()) {
    $sendstatus=$row4['email_send_status'];
}
}
else{
    $stats = $con->query("SELECT COUNT(email_open_status) as email_open_status FROM `sendemaildata` WHERE email_open_status='open' and session_id='$id'");
while ($row3 = $stats->fetch_assoc()) {
    $openstatus=$row3['email_open_status'];
}
$stats = $con->query("SELECT COUNT(email_send_status) asT email_send_status FROM `sendemaildata` WHERE email_send_status='yes' and session_id='$id'");
while ($row4 = $stats->fetch_assoc()) {
    $sendstatus=$row4['email_send_status'];
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
                <div class="row">
                  <div class="col-sm-6">
                    <h1 class="m-0">campaign History</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                      <li class="breadcrumb-item active">campaign List</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content mb-5">
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
                            
                            <div class="card">
                                <div class="card-body pt-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form id="filtercamp">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                           <select class="form-control" name="campaign_name" id="cname" required>
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
                                        <div class="col-md-6" id="oldchart">
                                            <canvas id="myChart" style="width:100%;max-width:400px; margin:auto"></canvas>
                                        </div>
                                        <div class="col-md-6" id="newchart">
                                            <div id="myChart1"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="table-new">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered zero-configuration">
                                        <thead>
                                            
                                            <tr>
                                                <th>SR.No</th>
                                                <th>Template Name & Type</th>
                                                <th>Member Name</th>
                                                <th>Email</th>
                                                <th>Degination</th>
                                                <th>Email Status Send</th>
                                                <th>Email Status Open</th>
                                                <th>Email Time Open</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $id=$_SESSION['login_id'];
                                            if($_SESSION['role']=='admin'){
                                            $query=mysqli_query($con,"select * from sendemaildata order by id desc");
                                            }
                                            else{
                                                 $query=mysqli_query($con,"select * from sendemaildata where session_id='$id' order by id desc ");
                                            }
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
                                                $i=1;
                                            while($row=mysqli_fetch_array($query))
                                            {
                                            ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td>Template Name- <?php echo $row['template'] ;?><br>
                                                Type- <?php echo $row['email_type'] ?></td>
                                                <!--<td><?php echo ($row['campaign_name']);?></td>-->
                                                <td><?php echo ($row['member_name']);?></td>
                                                <td><?php echo ($row['member_email']);?></td>
                                                <td><?php echo ($row['member_degination'])?></td>
                                                <td><?php echo ($row['email_send_status'])?></td>
                                                <td><?php echo ($row['email_open_status'])?></td>
                                                <?php
                                                 if($row['email_open_time']=='0000-00-00 00:00:00'){ ?>
                                                     <td></td>
                                                      <?php  } else {?>
                                                
                                                <td><?php echo date("d-m-Y H:i:s",strtotime($row['email_open_time']))?></td>
                                                <?php } ?>
                                               
                                                <!--<td class="text-nowrap">-->
                                                <!--    <button type="button" class="btn btn-info btn-sm preview" data-toggle="modal" data-target="#AddModal" data-id="<?php echo $row['id']; ?> ">-->
                                                <!--      <i class="typcn typcn-edit"></i>-->
                                                <!--    </button> -->
                                                <!--    <button class="btn btn-danger btn-sm deleteunsubscribe" data-id="<?php echo $row['id']; ?> "><i class="typcn typcn-trash"></i></button>-->
                                                     
                                                <!--</td>-->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
    });
    
    
    var xValues = ["Send Email campaign", "Email Open Status"];
    var yValues = ['<?php echo $sendstatus; ?>', '<?php echo  $openstatus; ?>'];
    var barColors = [
      "#00aba9",
      "#1e7145"
    ];
    
    new Chart("myChart", {
      type: "pie",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      }
    });
</script>
<script>
$('#filtercamp').submit(function(e){
    e.preventDefault()
    $.ajax({
        url:'ajax.php?action=filtercamp',
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
$('#addcsvfile').submit(function(e){
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
    
     $('#cname').change(function(){
   
    google.charts.load('current', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

  

 });
 
 function drawChart() {
       
       var cname= $('#cname').val();
       var jsonData = $.ajax({
          url: "getdata.php",
          dataType: "json",
          data:{cname:cname},
          async: false
          }).responseText;
          let x = JSON.parse(jsonData);
          if(x){
              $("#oldchart").hide();
             var data = new google.visualization.DataTable(x);
            var chart = new google.visualization.PieChart(document.getElementById('myChart1'));
            chart.draw(data, {width: 400, height: 240});

            $("#newchart").show();
          }
    }
$('#example1').DataTable();    
</script>
<?php } ?>
