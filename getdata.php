<?php session_start();
include('includes/config.php');
$cname=$_GET['cname'];
$id=$_SESSION['login_id'];
// if($_SESSION['role']=='admin'){
$stats = $con->query("SELECT COUNT(email_open_status) as email_open_status FROM `sendemaildata` WHERE email_open_status='open' and subject='$cname'");
while ($row3 = $stats->fetch_assoc()) {
    $openstatus=$row3['email_open_status'];
}
$stats = $con->query("SELECT COUNT(email_send_status) as email_send_status FROM `sendemaildata` WHERE email_send_status='yes' and subject='$cname'");
while ($row4 = $stats->fetch_assoc()) {
    $sendstatus=$row4['email_send_status'];
}
// }
// else{
//     $stats = $con->query("SELECT COUNT(email_open_status) as email_open_status FROM `sendemaildata` WHERE email_open_status='open' and session_id='$id' and subject='$cname'");
// while ($row3 = $stats->fetch_assoc()) {
//     $openstatus=$row3['email_open_status'];
// }
// $stats = $con->query("SELECT COUNT(email_send_status) asT email_send_status FROM `sendemaildata` WHERE email_send_status='yes' and session_id='$id' and subject='$cname'");
// while ($row4 = $stats->fetch_assoc()) {
//     $sendstatus=$row4['email_send_status'];
// }
// }       

echo '{
  "cols": [
        {"id":"","label":"Topping","pattern":"","type":"string"},
        {"id":"","label":"Slices","pattern":"","type":"number"}
      ],
  "rows": [';
        echo  '{"c":[{"v":"Open send","f":null},{"v":'.$openstatus.',"f":null}]},
                {"c":[{"v":"Send email","f":null},{"v":'.$sendstatus.',"f":null}]}
           ';
   echo '   ]
}
';

?>