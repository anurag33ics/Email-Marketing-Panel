<?php
define('DB_SERVER','localhost');
define('DB_USER','careerst_marketing_email');
define('DB_PASS' ,'q9~]Jcn-nkp]');
define('DB_NAME','careerst_marketing_email');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>