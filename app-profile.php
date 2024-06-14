<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
$id=$_SESSION['login_id'];
$sql=mysqli_query($con,"SELECT * FROM  admin where id='$id'");
while($row=mysqli_fetch_array($sql))
{
$name=$row['name'];
$email=$row['email'];
$image=$row['Image'];
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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1>Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">User Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content mb-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <?php 
                                        if($image!=""){ ?>
                                        <img class="profile-user-img img-full img-circle" src="images/<?php echo $image;?>" alt="User profile picture" width="100" height="100" >
                                        <?php } ?>
                                       <?php if($image==""){ ?>
                                        <img class="profile-user-img img-full img-circle" src="images/default-user-avatar.jpg" alt="User profile picture" width="100" height="100" >
                                        <?php } ?>
                                    </div>
                                    <h3 class="profile-username text-center"><?php echo $name; ?></h3>
                                    <p class="text-muted text-center"><?php echo $email; ?></p>
                                    <ul class="list-group list-group-unbordered mb-0">
                                        <li class="list-group-item">
                                            <a href="change_password.php" class="text-dark">
                                                <i class="typcn typcn-eye-outline mr-2"></i> <small>Change Password</small>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="logout.php" class="text-dark">
                                                <i class="typcn typcn-power-outline mr-2"></i> <small>Logout</small>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                    
                                </div>
                            </div>
                            <!-- <div class="card card-primary d-none">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <div class="card-body">
                                    <strong><i class="fas fa-book mr-1"></i> Education</strong>
                                    <p class="text-muted">
                                    B.S. in Computer Science from the University of Tennessee at Knoxville
                                    </p>
                                    <hr>
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                    <p class="text-muted">Malibu, California</p>
                                    <hr>
                                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                                    <p class="text-muted">
                                    <span class="tag tag-danger">UI Design</span>
                                    <span class="tag tag-success">Coding</span>
                                    <span class="tag tag-info">Javascript</span>
                                    <span class="tag tag-warning">PHP</span>
                                    <span class="tag tag-primary">Node.js</span>
                                    </p>
                                    <hr>
                                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-3">
                                    <h3 class="card-title">Profile Settings</h3>
                                    <!-- <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                                        <li class="nav-item"><a class="nav-link  active btn-sm" href="#settings" data-toggle="tab">Settings</a></li>
                                    </ul> -->
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="settings">
                                            <form class="form-horizontal" id="changeprofile" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName" value="<?php echo $name;?>" name="name" placeholder="Name">
                                                </div>
                                            </div>
                                                <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputEmail" value="<?php echo $email;?>" name="email" placeholder="Email">
                                                </div>
                                            </div>
                                                <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Profile Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" id="" name="post_image" placeholder="Name">
                                                </div>
                                            </div>
                                                <span id="success" style="color:green;"></span>
                                                <div class="form-group">
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-primary btn-sm">Update Profile</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class=" tab-pane d-none" id="activity">
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                                    <span class="username">
                                                    <a href="#">Jonathan Burke Jr.</a>
                                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                                    </span>
                                                    <span class="description">Shared publicly - 7:30 PM today</span>
                                                </div>
                                                <p>Lorem ipsum represents a long-held tradition for designers, typographers and the like. Some people hate it and argue for its demise, but others ignore the hate as they create awesome
                                                tools to help create filler text for everyone from bacon lovers to Charlie Sheen fans.</p>
                                                <p>
                                                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                                    <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                                    <span class="float-right">
                                                    <a href="#" class="link-black text-sm">
                                                    <i class="far fa-comments mr-1"></i> Comments (5)
                                                    </a>
                                                    </span>
                                                </p>
                                                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                            </div>
                                        </div>
                                    
                                        <div class="tab-pane d-none" id="timeline">
                                            <div class="timeline timeline-inverse">
                                                <div class="time-label">
                                                    <span class="bg-danger">10 Feb. 2014</span>
                                                </div>
                                                <div>
                                                    <i class="fas fa-envelope bg-primary"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i> 12:05</span>
                                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                                                        <div class="timeline-body">
                                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                        quora plaxo ideeli hulu weebly balihoo...
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <div>
                                                    <i class="fas fa-user bg-info"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
                                                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                                        </h3>
                                                    </div>
                                                </div>
                                                
                                                <div>
                                                    <i class="fas fa-comments bg-warning"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>
                                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                                        <div class="timeline-body">
                                                            Take me to your leader!
                                                            Switzerland is small and neutral!
                                                            We are more like Germany, ambitious and misunderstood!
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="time-label">
                                                    <span class="bg-success">3 Jan. 2014</span>
                                                </div>
                                                
                                                <div>
                                            <i class="fas fa-camera bg-purple"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>
                                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                                <div class="timeline-body">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                        
                                                <div>
                                                    <i class="far fa-clock bg-gray"></i>
                                                </div>
                                            </div>
                                        </div>
                                
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
  <?php include("script.php"); ?>

  
</body>
</html>

<script>
    $('#changeprofile').submit(function(e){
    e.preventDefault()
     $.ajax({
        url:'ajax.php?action=changeprofile',
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
            $("#success").text('Profile Successfully Updated.');
         location.reload();
         }
         }
    })
})  
</script>
