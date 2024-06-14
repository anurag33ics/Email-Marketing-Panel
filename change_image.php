<?php 

session_start();

include('includes/config.php');

error_reporting(0);

if(strlen($_SESSION['login'])==0)

  { 

header('location:index.php');

}

else{

if(isset($_POST['update']))

{



$imgfile=$_FILES["postimage"]["name"];

// get the image extension

$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));

// allowed extensions

$allowed_extensions = array(".jpg","jpeg",".png",".gif");

// Validation for allowed extensions .in_array() function searches an array for a specific value.

if(!in_array($extension,$allowed_extensions))

{

echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";

}

else

{

//rename the image file

$imgnewfile=md5($imgfile).$extension;

// Code for move image into directory

move_uploaded_file($_FILES["postimage"]["tmp_name"],"postimages/".$imgnewfile);







$postid=intval($_GET['pid']);

$query=mysqli_query($con,"update eventposts set PostImage='$imgnewfile' where id='$postid'");

if($query)

{

$msg="Your Changes are Saved ";

}

else{

$error="Something went wrong . Please try again.";    

} 

}

}

?>



<?php include("head.php") ?>

<script>

function getSubCat(val) {

  $.ajax({

  type: "POST",

  url: "get_subcategory.php",

  data:'catid='+val,

  success: function(data){

    $("#subcategory").html(data);

  }

  });

  }

  </script>

</head>



<body>



<?php include("loader.php"); ?>    

    <!--**********************************

        Main wrapper start

    ***********************************-->

    <div id="main-wrapper">



       

         <?php include("nav_header.php"); ?>



         <?php include("header.php");?>    



         <?php include("sidebar.php");?>   

       

        <!--**********************************

            Content body start

        ***********************************-->

        <div class="content-body">



            <div class="row page-titles mx-0">

                <div class="col p-md-0">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>

                        <?php

                        $postid=intval($_GET['pid']);

                        $query=mysqli_query($con,"select eventposts.id as postid,eventposts.PostImage,eventposts.PostTitle as title,eventposts.PostDetails,eventcategory.CategoryName as category,eventcategory.id as catid,eventsubcategory.SubCategoryId as subcatid,eventsubcategory.Subcategory as subcategory from eventposts left join eventcategory on eventcategory.id=eventposts.CategoryId left join eventsubcategory on eventsubcategory.SubCategoryId=eventposts.SubCategoryId where eventposts.id='$postid' and eventposts.Is_Active=1 ");

                        while($row=mysqli_fetch_array($query))

                        {

                        ?>

                        <li class="breadcrumb-item active"><a href="change_image.php?pid=<?php echo htmlentities($row['postid']);?>">Update Image</a></li>
                    <?php } ?>

                    </ol>

                </div>

            </div>

            <!-- row -->



            <div class="container-fluid">

                <div class="row justify-content-center">

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="card-body">

                                <div class="form-validation">

                                    <h3>Edit Category</h3><hr>

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

                                    <form name="addpost" method="post" enctype="multipart/form-data">

<?php

$postid=intval($_GET['pid']);

$query=mysqli_query($con,"select PostImage,PostTitle from eventposts where id='$postid' and Is_Active=1 ");

while($row=mysqli_fetch_array($query))

{

?>

                        <div class="row">

                            <div class="col-md-10 col-md-offset-1">

                                <div class="p-6">

                                    <div class="">

                                        <form name="addpost" method="post">

 <div class="form-group m-b-20">

<label for="exampleInputEmail1">Post Title</label>

<input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['PostTitle']);?>" name="posttitle"  readonly>

</div>







 <div class="row">

<div class="col-sm-12">

 <div class="card-box">

<h4 class="m-b-30 m-t-0 header-title"><b>Current Post Image</b></h4>

<img src="postimages/<?php echo htmlentities($row['PostImage']);?>" width="300"/>

<br />



</div>

</div>

</div>



<?php } ?>

<div class="row">

<div class="col-sm-12">

 <div class="card-box">

    <br>

<h4 class="m-b-30 m-t-0 header-title"><b>New Feature Image</b></h4>

<input type="file" class="form-control" id="postimage" name="postimage"  required>

</div>

</div>

</div>

<br>

<button type="submit" name="update" class="btn btn-primary">Update </button>

</form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

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

    <!--**********************************

        Main wrapper end

    ***********************************-->



    <!--**********************************

        Scripts

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

      <?php include("script.php"); ?>

</body>



</html>

<?php } ?>
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