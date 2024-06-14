<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Corp2Corp</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 15px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <style>
.login-form-bg,
.login-form {
    height: 100vh;
    overflow: hidden;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-formin {
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    background: #fff;
    box-shadow: 0 0 10px #ccc;
    border-radius: 20px;
    height: 100%;
    max-height: 420px;
}

.login-formin .lft-box {
    overflow: hidden;
    display: flex;
    height: 100%;
    padding: 15px;
}
.login-formin .login-logo {
        display: block;
    width: 100%;
    max-width: 230px;
    position: relative;
    z-index: 2;
    height: max-content;
    background: rgba(255,255,255,.8);
}

.login-formin a.login-logo img {
    width: 100%;
}


.login-formin .row {
    height: 100%;
}

.login-formin .lft-box .coverimg {
    position: absolute;
    text-align:center;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    border-radius: 20px  0 0 20px;
    overflow: hidden;
    display: block;
}

.login-formin .lft-box .coverimg img {
        width: 94%;
    height: 100%;
    object-fit: contain;
}


.login-formin .rgt-box {
    padding: 40px 50px;
}

.login-formin .rgt-box h3{
    font-weight: 800;
    text-transform: uppercase;
}

.login-formin .login-tbs {
    display: table;
    width: 100%;
    margin: 10px 0 20px;
}

.login-formin .login-tbs > a {
    display: block;
    color: #000;
    width: 50%;
    float: left;
    text-align: center;
    padding: 10px;
    text-transform: capitalize;
    border-bottom: solid 2px transparent;
}

.login-formin .login-tbs > a.active,
.login-formin .login-tbs > a:hover {border-bottom-color: #03045e;color: #03045e;}


@media (max-width:767px){
    .login-form {height: auto;}
    .login-formin .lft-box{margin: 0 8px 0 7px; height: 250px;}
    .login-formin .lft-box .coverimg{border-radius: 20px 20px 0 0;}
    .login-formin .login-logo{margin: 0 auto;}
    
    .login-formin{max-height: inherit;}
    .login-formin .rgt-box {padding: 40px 30px;}
    .login-formin .rgt-box h3{text-align:center;}
}

</style>
</head>
<body class="h-100" style="background-image: url(images/login-bg.jpg)">
    <?php include("loader.php"); ?>  
    
    

    <!--Create List Modal end-->

<!--**********************************
    Scripts
***********************************-->
<?php include("script.php"); ?>



    <div style='text-align:center'> 
           
          <img src="images/Corptocorp-logo.png" width='120'>
           <h2>Career subscription form</h2>
      </div>
   
    <form id='submitfrm' >
         <div id='frm'>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="subject">Skill:</label>
        <input type="text" id="skill" name="skill" required>
        <div style="text-align: left;     display: flex;">
            <input type='checkbox' id="checkbox" name="checkbox"  required style='width: auto;'>
        <label for="message">Note:</label> We are using this data to send you latest job updates.
        </div>
        
        

        <input type="submit" class='add' value="Submit">
    </div>
        
    </form>
    <script>
    $('#submitfrm').submit(function(e){
$(".add").attr("disabled", true);
var email = $('#email').val();
var name = $('#name').val();
var skill = $('#skill').val();
alert()
e.preventDefault()
 $(".add").attr("disabled", false);
    setTimeout(function() {
          $("#submitfrm").html(" <label > Data added successfully</label>");
        $("#frm").hide();
     
         }, 1000);
//  $.ajax({
// url:'ajax.php?action=forgotPassword',
//  data: new FormData($(this)[0]),
//  cache: false,
//  contentType: false,
//  processData: false,
//  method: 'POST',
//  type: 'POST',
//  error:err=>{
//  console.log(err)
//  },
//  success:function(resp){
//  if(resp > 0){
//      $("#sucess").text('Verification link has been to email.');
//      setTimeout(function(){
//         // window.location.href='view_member.php?id='+resp;
//  window.location.reload();
//                     },2000)
//  }
//   else if (resp == -1) {
//     $("#error").text("Email not exist");
//     $(".add").attr("disabled", false);
//     setTimeout(function() {
//         $("#error").text('');
//         window.location.reload();
//          }, 2000);

//       }
//  }
// })
})
</script>
</body>
</html>
