<?php
include('includes/config.php');
 $rowId = base64_decode($_GET['id']);
 $cuurTime = date("Y-m-d H:s:i");
 $cuurTime = date('Y-m-d H:i:s', strtotime($cuurTime. ' + 740 minutes'));
$save =mysqli_query($con,"UPDATE sendemaildata SET email_open_status='open' , email_open_time='$cuurTime' where id='$rowId'");
//print_r($save);
?>