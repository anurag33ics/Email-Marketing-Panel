<?php
session_start();
ini_set('display_errors', 1);
require_once 'vendor/autoload.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
Class Action {
private $db;
public function __construct() {
ob_start();
include 'includes/config.php';
include 'includes/SimpleXLSX.php';


$this->db = $con;
}
function __destruct() {
$this->db->close();
ob_end_flush();
}
function login(){
extract($_POST);
$qry = $this->db->query("SELECT * FROM admin where username = '".$username."' and password = '".$password."' ");
if($qry->num_rows > 0){
foreach ($qry->fetch_array() as $key => $value) {
if($key != 'passwors' && !is_numeric($key))
{
$_SESSION['login_'.$key] = $value;
}


}
return 1;
}else{
return 3;
}
}
function logout(){
session_destroy();
foreach ($_SESSION as $key => $value) {
unset($_SESSION[$key]);
}
header("location:login.php");
}

function unsubscribe()
{
extract($_POST);
$checkBox = implode(',', $_POST['checkbox']);

$data .= "email = '$email' ";
$data .= ", reason = '$reason' ";
$data .= ", checkbox = '$checkBox' ";
$data .= ", emailtemplate = '$emailtemplate' ";
$data .= ", campaign_name= '$campaign_name' ";
$data .= ", list_id= '$list_id' ";

$save = $this->db->query("insert unsubscribe set ".$data."");
$save1 = $this->db->query("UPDATE addmember set status='Unsubscribe' where list_id='$list_id' and email='$email'");
return 1;

}
function  deleteunsubscribe()
{
extract($_POST);
$delete = $this->db->query("DELETE FROM unsubscribe where id = ".$id);
if($delete)
return 1;
}


function adduser()
{
extract($_POST);
$pass=$_POST['password'];

$id=$_POST['id'];
$data = "name = '$name' ";
$data .= ", email = '$email' ";
$data .= ", password = '$pass' ";
$data .= ", role = '$role' ";
$data .= ", account_type = '$account_type' ";
$data .= ", email_limit = '$email_limit' ";

if($id==0){
			$save = $this->db->query("INSERT INTO admin set ".$data);
			return 1;
		}else{
		    
			$save = $this->db->query("UPDATE admin set ".$data." where id = ".$id);
		    return 2;
		}
}

function  deleteuser()
{
extract($_POST);
$delete = $this->db->query("DELETE FROM admin where id = ".$id);
if($delete)
return 1;
}


function edituser(){
    
    extract($_POST);
    $id=$_POST['id'];
    $query = $this->db->query("SELECT * from admin where id='$id'")->fetch_array();
    $id=$query['id'];
    $name=$query['name'];
    $email=$query['email'];
    $role=$query['role'];
    $account_type=$query['account_type'];
    $email_limit=$query['email_limit'];
    
    $adminSelect= $role == 'admin' ? 'SELECTED' : '';
    $managerSelect= $role == 'manager' ? 'SELECTED' : '';
    $salesSelect= $role == 'sales' ? 'SELECTED' : '';
    $leadSelect= $role == 'lead' ? 'SELECTED' : '';
    $recruiterSelect= $role == 'recruiter' ? 'SELECTED' : '';
    
    echo "<div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Name</b></label>
            <input type='hidden' class='form-control' id='id' value='$id' name='id' required>
            <input type='text' class='form-control' id='name' value='$name' name='name' required>
            </div>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Email</b></label>
            <input type='text' class='form-control' id='name' value='$email' name='email' required>
            </div>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>password</b></label>
            <input type='password' class='form-control' id='name' value='12345678' name='password' required>
            </div>
            <br>
            <div class='form-group'>
            <label for=recipient-name' class=col-form-label>Role Type</label>
            <select class='form-control' name='role' required>
            <option selected >Select Role Type</option>
            <option value='admin'    $adminSelect >Admin</option>
            <option value='manager'   $managerSelect >Manager</option>
            <option value='admin'     $salesSelect>Sales</option>
            <option value='lead'     $leadSelect>Lead</option>
            <option value='recruiter' $recruiterSelect>Recruiter</option>
            </select>
            </div><br>
            <div class='form-group'>
            <label for=recipient-name' class=col-form-label>Account Type</label>
            <select class='form-control' name='account_type' id='account_type' required>
            <option value='Active'  $account_type == 'Active' ? ' selected : ''; >Active</option>
            <option value='Deactivate' $account_type == 'Deactivate' ? 'selected : ''; > Deactivate</option>
            </select>
            </div><br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Email Limit</b></label>
            <input type='text' class='form-control' id='email_limit' value='$email_limit' name='email_limit' pattern='\d*' required>
            </div>
            <br>";
    
}
function addlist()
{
extract($_POST);
$list_name = $_POST['list_name'];
$query = $this->db->query("SELECT * from  list where list_name ='$list_name' AND visibility_type='$visibility_type' ");
$rowcount = mysqli_num_rows($query);
if($rowcount>0){
    return -1;
}else{
$data='';
$id=$_SESSION['login_id'];
$data .= "list_name = '$list_name' ";
$data .= ", visibility_type = '$visibility_type' ";
$data .= ", session_id = '$id' ";

if(!isset($_POST['id'])){
			$save = $this->db->query("INSERT INTO list set ".$data);
			    $rowid = $this->db->insert_id;

			return $rowid;
		}else{
		    $id1= $_POST['id'];
			$save = $this->db->query("UPDATE list set ".$data." where id = ".$id1);
		    return 2;
		}
}
}
function addlistmember()
{
extract($_POST);
$id=$_SESSION['login_id'];
$query = $this->db->query("SELECT * from  addmember where email ='$email' AND list_id='$list_name' ");
$rowcount = mysqli_num_rows($query);
if($rowcount>0){
    return 3;
}

else{

$data = "name = '$name' ";
$data .= ", list_id = '$list_name' ";
$data .= ", session_id = '$id' ";
$data .= ", email = '$email' ";
$data .= ", phone_no = '$phone_no' ";
$data .= ", degination = '$degination' ";

if(!isset($_POST['id'])){
			$save = $this->db->query("INSERT INTO addmember set ".$data);
			return 1;
		}else{
		    $member_id=$_POST['id'];
			$save = $this->db->query("UPDATE addmember set ".$data." where id = ".$member_id);
		    return 2;
		}
}
}
function editlistmember()
{
extract($_POST);
$id=$_SESSION['login_id'];

$member_id=$_POST['id'];
$data = "name = '$name' ";
$data .= ", list_id = '$list_name' ";
$data .= ", session_id = '$id' ";
$data .= ", email = '$email' ";
$data .= ", phone_no = '$phone_no' ";
$data .= ", degination = '$degination' ";

	$save = $this->db->query("UPDATE addmember set ".$data." where id = ".$member_id);
		    return 2;
		
}

function  deletelist()
{
extract($_POST);
$delete = $this->db->query("DELETE FROM list where id = ".$id);
if($delete)
return 1;
}
function editlist(){
    
    extract($_POST);
    $id=$_POST['id'];
    
   $query = $this->db->query("SELECT * from list where id='$id'")->fetch_array();
    $id=$query['id'];
    $list=$query['list_name'];
    $listData= "<div class='form-group>
            <label for=recipient-name' class=col-form-label><b>List Name</b></label>
            <input type='hidden' class='form-control' id='name' value='$id' name='id' required>
            <input type='text' class='form-control' id='name' value='$list' name='list_name' required>
            </div>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Visibility Type</b></label>
            <select class='form-control' name='visibility_type' id='visibility_type'>";
            if($query['visibility_type']=="Public"){
            $listData .=" <option value='Public' Selected>Public</option>
                            <option value='Private'>Private</option>
                        </select>
                        <span id='error_visibility_type' style='color:red'></span></div>";    
            }else{
                $listData .=" <option value='Public' >Public</option>
                            <option value='Private' Selected>Private</option>
                        </select>
                        <span id='error_visibility_type' style='color:red'></span></div>";
            }
            
    echo $listData;
    
    
}


function editmember(){
    
    extract($_POST);
    $id=$_POST['id'];
    
   $query = $this->db->query("SELECT * from addmember where id='$id'")->fetch_array();
    $id=$query['id'];
    $list_id=$query['list_id'];
    $list=$query['name'];
    $email=$query['email'];
    $phone=$query['phone_no'];
    $degination=$query['degination'];
    
    echo "<div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Name</b></label>
            <input type='hidden' class='form-control' id='name' value='$list_id' name='list_name' required>
            <input type='hidden' class='form-control' id='name' value='$id' name='id' required>
            <input type='text' class='form-control' id='name' value='$list' name='name' required>
            </div>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Email</b></label>
            <input type='text' class='form-control' id='email' value='$email' name='email' required>
            </div>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Phone Number</b></label>
            <input type='text' class='form-control' id='email' value='$phone' name='phone_no' required>
            </div>
            <br>
            <div class='form-group'>
            <label for='recipient-name' class='col-form-label'>Degination</label>
            <input type='text' class='form-control' id='recipient-name' value='$degination' name='degination' required>
             </div>
            ";
    
    
    
}

function  deletemember()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM addmember where id = ".$id);
if($delete)
return 1;
}

function addcsvfile()
{
extract($_POST);
$id=$_SESSION['login_id'];
 $save='';

if ( $xlsx = SimpleXLSX::parse( $_FILES['file']['tmp_name'] ) )

     {

$i=1;
foreach ( $xlsx->rows() as $k => $r )
 {   
   
  if($i!=1){
     
     $query = $this->db->query("SELECT * from  addmember where email ='$r[1]' AND list_id='$list_name' ");
$rowcount = mysqli_num_rows($query);
if($rowcount<=0){
    $save = $this->db->query("INSERT INTO addmember set name='$r[0]',
      email='$r[1]',phone_no='$r[2]',degination='$r[3]',session_id='$id',list_id='$list_name'");
}
      
       } 
  $i++;
}
if($save)
 return 1;

}
    else{
        return 2;
    }
}

function  sendmail()
{
extract($_POST);

$username='ankush.gupta@bugendaitech.com';
        include('email.php');
       $respose=resetPassLinkEmail($username,$check);
       return $respose;
}


function  viewTemplate()
{
include($_GET['path']);
$data= array(
    "template"=>"",
    "campaign_name"=>"",
    "list_id"=>"",
    "id"=>"");
       return returnTemplate($data);
}


function  sendTestEmail()
{
extract($_POST);

    // $username='ankush.gupta@bugendaitech.com';
    include('email.php');
    $data= array(
        "email" => $email,
        "subject" => $subject,
        "filepath" => $templatepath,
        "template" => $template,
        "id" =>0
        );
      
    $respose=sendTestEmailMethod($data);
    return $respose;
}

function  sendtemplateEamil()
{
    
    
include('email.php');

extract($_POST);
$id=$_SESSION['login_id'];

$query = $this->db->query("SELECT * from addmember where list_id='$list_name'");
while($row=mysqli_fetch_array($query)){
    $id=$_SESSION['login_id'];
    $list_id=$row['list_id'];
    $name=$row['name'];
    $email=$row['email'];
    $phone=$row['phone_no'];
    $degination=$row['degination'];
    
    $data = "member_name = '$name' ";
    $data .= ",list_id = '$list_id' ";
    $data .= ", session_id = '$id' ";
    $data .= ", member_email = '$email' ";
    $data .= ", member_phone = '$phone' ";
    $data .= ", member_degination = '$degination' ";
    $data .= ", template = '$template' ";
    $data .= ", campaign_name = '$campaign_name' ";
    $data .= ", subject = '$subject' ";
    $data .= ", email_send_status = 'yes' ";
    $data .= ", email_shoot = '$email_shoot' ";
    $data .= ", email_type = 'predefined' ";
    
    $save = $this->db->query("INSERT INTO sendemaildata set ".$data);
    }
    
         $query1 = $this->db->query("SELECT * from sendemaildata where campaign_name='$campaign_name' 
                                AND email_shoot='$email_shoot' AND subject='$subject' AND template='$template' limit 0,10");
     while($row1=mysqli_fetch_array($query1)){
        
        // require_once("email-template/".strtolower($row1['template']).".php");
        $data_array=array(
            "id"      => $row1['id'],
            "subject" => $row1['subject'],
            "filepath" => "email-template/".strtolower($row1['template']).".php",
            "template"=> $row1['template'],
            "email"   => $row1['member_email'],
            "name" => $row1['member_name'],
            "phone" => $row1['member_phone'],
            "designation" =>$row1['member_degination'],
            "campaign_name" =>$row1['campaign_name'],
            "list_id" =>$row1['list_id']
            );

        $respose=sendTestEmailMethod($data_array);
    }
  
return 1;
    	
    
}

function addCampaign()
{
extract($_POST);

$query = $this->db->query("SELECT * from  campaign where 
campaign_name ='$campaign_name'");
$rowcount = mysqli_num_rows($query);
if($rowcount>0){
    return 3;
}

else{
   
   $id=$_SESSION['login_id'];
   $data = "campaign_name = '$campaign_name' ";
   $data .= ",session_id = '$id' ";

if(!isset($_POST['id'])){
			$save = $this->db->query("INSERT INTO campaign set ".$data);
			return 1;
		}else{
		    $id1=$_POST['id'];
			$save = $this->db->query("UPDATE campaign set ".$data." where id = ".$id1);
		    return 2;
		} 
}


}

function  deleteCampaign()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM campaign where id = ".$id);
if($delete)
return 1;
}
function editCampaign(){
    
    extract($_POST);
    $id=$_POST['id'];
    
   $query = $this->db->query("SELECT * from campaign where id='$id'")->fetch_array();
    $id=$query['id'];
    $Campaign=$query['campaign_name'];
    echo "<div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Campaign Name</b></label>
            <input type='hidden' class='form-control' id='name' value='$id' name='id' required>
            <input type='text' class='form-control' id='name' value='$Campaign' name='campaign_name' required>
            </div>";
    
    
    
}

function filtercamp(){
    
    extract($_POST);
    // $id=$_POST['id'];
    $query = $this->db->query("SELECT * from sendemaildata where subject='$campaign_name'");
    $i=1;
    while($row=mysqli_fetch_array($query)){
    // $cname=$row['campaign_name'];
    $mname=$row['member_name'];
    $memail=$row['member_email'];
    $mdegination=$row['member_degination'];
    $msend=$row['email_send_status'];
    $mopen=$row['email_open_status'];
    $open_times=$row['email_open_time'];
        if($open_times=='0000-00-00 00:00:00'){
            $open_times='';
        } 
        else{
          $open_times= date('d-m-Y H:i:s',strtotime($open_times));
        }
         echo "<tr>
                
                 <td>$i</td>
                 <td>$mname</td>
                 <td>$memail</td>
                 <td>$mdegination</td>
                 <td>$msend</td>
                 <td>$mopen</td>
                 <td>$open_times</td>
                
                </tr>";
       
   $i++; }
   
    
    
}


function changepass()
{
extract($_POST);
$id=$_SESSION['login_id'];
$query = $this->db->query("SELECT * from  admin where password ='$password' and id='$id'")->fetch_array();
$oldpassword=$query['password'];
if($password!=$oldpassword){
    return 3;
}

else{
  
   $data .= " password = '$newpassword' ";

	$save = $this->db->query("UPDATE admin set ".$data." where id = ".$id);
    return 1;
		
}
}
function changeprofiles()
{
extract($_POST);
$id=$_SESSION['login_id'];
$data = " name= '$name'";
$data .= ", email= '$email'";

if (isset($_FILES["post_image"]) && $_FILES["post_image"]['name']!== "")
{
    $status = false;
    $target_dir = "images/";
    $file=$_FILES["post_image"]['name'];
    $target_file = $target_dir . basename($file);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $extallowed = array(
    "jpg",
    "jpeg",
    "png",
    );
    if (!in_array(strtolower($imageFileType) , $extallowed))
    {
    $status = false;
    $uploadOk = 0;
    }
    $filename = uniqid() .'.'. $imageFileType;
    $filepath = $target_dir . $filename;

    if ($file > 10000000000000)
{
    $status = false;
    $uploadOk = 0;
}
if (!move_uploaded_file($_FILES["post_image"]["tmp_name"], $filepath))
{
    $uploadOk = 0;
}
else
{
    $file_name = $filename;
}
}


if ($_FILES["post_image"]['name']!==""){
    $data .= ",image= '$filename'";
    //echo "update admin set $data where id = '$id'";
    $query = $this->db->query("update admin set $data where id = '$id'");
    if($query)
return 1;
}
else{
    //echo "update admin set name='$name', email='$email' where id = '$id'";
$query = $this->db->query("update admin set name='$name', email='$email' where id = '$id'");
if($query)
return 1;
}
}





function filtercampunsubscribe(){
    
    extract($_POST);
    // $id=$_POST['id'];
    $query = $this->db->query("SELECT * from  unsubscribe where campaign_name='$campaign_name'");
    $i=1;
    while($row=mysqli_fetch_array($query)){
    // $cname=$row['campaign_name'];
    $memail=$row['email'];
    $reason=$row['reason'];
    $campaign_name=$row['campaign_name'];
    $checkbox=$row['checkbox'];
    $id=$row['id'];
         echo "<tr>
                
                 <td>$i</td>
                 <td>$memail</td>
                 <td>$reason</td>
                 <td>$checkbox</td>
                 <td>$campaign_name</td>
                 <td class='text-nowrap'>
                    <button class='btn btn-outline-danger deleteunsubscribe' data-id='$id'><i class='fa fa-trash'/></i></button>
                </td>
                </tr>";
       
   $i++; }
   
    
    
}
// new cod efor manula
function addTemplate(){
 extract($_POST);
 $sql="INSERT INTO `manual_templete` (`id`, `template_name`, `content`, `created_dt`) VALUES (NULL, '".$_POST['name']."', '".str_replace("'", "''", htmlspecialchars_decode($_POST['editor'], ENT_QUOTES))."', CURRENT_TIMESTAMP)";
    
 $query = $this->db->query($sql);
 if($query){
    return 1;
 }
 else{
        return 0;
 }
}

function addSignature(){
 extract($_POST);
 $id=$_SESSION['login_id'];
 
 $query = $this->db->query("SELECT * from my_signature where login_id='$id'");

 if($query->num_rows == 0){
   $sql="INSERT INTO `my_signature` (`id`, `login_id`, `signature`, `created_dt`) VALUES (NULL, '$id','".str_replace("'", "''", htmlspecialchars_decode($_POST['editor'], ENT_QUOTES))."', CURRENT_TIMESTAMP)";
     
 }else {
     $sql="UPDATE `my_signature` SET `signature`='".str_replace("'", "''", htmlspecialchars_decode($_POST['editor'], ENT_QUOTES))."'    WHERE login_id ='$id'";
 }
 $query = $this->db->query($sql); 
 if($query){
    return 1;
 }
 else{
        return 0;
 }
}


function  viewManualTemplate()
{
include ('email-template/manualTemplate.php');    
 $id =$_GET['id'];

$query = $this->db->query("SELECT * from manual_templete where id='$id'")->fetch_array();
$data= array(
    "content"=>$query['content'],
    "template"=>"",
    "campaign_name"=>"",
    "list_id"=>"",
    "id"=>"",
    "salutation" => "",
    "person_name" => "", 
    "id"=>""
    );
      return returnTemplate1($data);
    // return "ddd";
}

function  sendTestEmailManual()
{
extract($_POST);
    include ('email-template/manualTemplate.php');   

$query = $this->db->query("SELECT * from manual_templete where id='$templatepath'")->fetch_array();

$data= array(
    "content"=>$query['content'],
    "template"=>"",
    "campaign_name"=>"",
    "list_id"=>"",
    "id"=>"",
    "salutation" => "",
    "person_name" => "", 
    "id"=>"");
$html= $this->minify_html(returnTemplate1($data));
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"Messages": [{
			"From": {
				"Email": "test@youremail.com",
				"Name": "corp2corpreq"
			},
			"To": [{
				"Email": "'.$email.'",
				"Name": ""
			}],
			"Subject": "'.$subject.'",
			"TextPart": "'.$subject.'",
			"HTMLPart": "'.$html.'"
		}
	]
}
',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
   'Authorization: Basic base64encode(key:secrectkey)'
  ),
));
$response = curl_exec($curl);

curl_close($curl);
// echo $response;

    // $respose=sendTestEmailMethod($data);
    return 1;
}

function minify_html($html) {
    $search = array(
        '/\>[^\S ]+/s',  // remove whitespaces after tags
        '/[^\S ]+\</s',  // remove whitespaces before tags
        '/(\s)+/s'       // remove multiple consecutive spaces
    );

    $replace = array(
        '>',
        '<',
        '\\1'
    );

    return preg_replace($search, $replace, $html);
}

// send bulk email
function sendManualtemplateEamil(){
        include ('email-template/manualTemplate.php');   
 extract($_POST);
$id=$_SESSION['login_id'];
$templateData = $this->db->query("SELECT * from manual_templete where id='$templatepath1'")->fetch_array();

$query = $this->db->query("SELECT * from addmember where list_id='$list_name'");
$obj="";
while($row=mysqli_fetch_array($query)){
    $id=$_SESSION['login_id'];
    $list_id=$row['list_id'];
    $name=$row['name'];
    $email=$row['email'];
    $phone=$row['phone_no'];
    $degination=$row['degination'];
    
    $data = "member_name = '$name' ";
    $data .= ",list_id = '$list_id' ";
    $data .= ", session_id = '$id' ";
    $data .= ", member_email = '$email' ";
    $data .= ", member_phone = '$phone' ";
    $data .= ", member_degination = '$degination' ";
    $data .= ", template = '$template' ";
    $data .= ", campaign_name = '$subject' ";
    $data .= ", subject = '$subject' ";
    $data .= ", email_send_status = 'yes' ";
    $data .= ", email_shoot = '$email_shoot' ";
    $data .= ", email_type = 'manual' ";
    $data .= ", is_email_active = 'yes' ";
    $data .= ", template_id = '$templateData[0]' ";
    
    $save = $this->db->query("INSERT INTO sendemaildata set ".$data);
    $rowid = $this->db->insert_id;
    $objdata= array(
    "content"=>$templateData['content'],
    "template"=>$templateData[1],
    "campaign_name"=>"",
    "list_id"=>$list_id,
    "salutation" => $salutation,
    "person_name" => $row['name'], 
    "id"=>$rowid
    );
    $html= $this->minify_html(returnTemplate1($objdata));
    $obj .='{
			"From": {
				"Email": "test@youremail.com",
				"Name": "corp2corpreq"
			},
			"To": [{
				"Email": "'.$email.'",
				"Name": "'.$name.'"
			}],
			"Subject": "'.$subject.'",
			"TextPart": "'.$subject.'",
			"HTMLPart": "'.$html.'"
		},'; 
    
    }

$obj= substr($obj, 0, -1);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"Messages": ['.$obj.'
	]
}
',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
     'Authorization: Basic base64encode(key:secrectkey)'
  ),
));
$response = curl_exec($curl);

curl_close($curl);

$array = json_decode($response, true);

// Accessing values in the array
foreach ($array['Messages'] as $message) {
    
            $sql =$this->db->query("UPDATE sendemaildata SET messageUUID='".$message['To'][0]['MessageUUID']."', message_id='". $message['To'][0]['MessageID'] ."', message_href='" . $message['To'][0]['MessageHref'] . "'
            WHERE member_email ='".$message['To'][0]['Email']."' AND 
            list_id='$list_name' AND subject='$subject' AND template_id='$templatepath1' ");
    // }
     
    // echo "MessageUUID: " . $message['To'][0]['MessageUUID'] . "<br>";
    // echo "MessageID: " . $message['To'][0]['MessageID'] . "<br>";
    // echo "MessageHref: " . $message['To'][0]['MessageHref'] . "<br><br>";


}
    //      $query1 = $this->db->query("SELECT * from sendemaildata where campaign_name='$campaign_name' 
    //                             AND email_shoot='$email_shoot' AND subject='$subject' AND template='$template' limit 0,10");
    //  while($row1=mysqli_fetch_array($query1)){
        
    //     // require_once("email-template/".strtolower($row1['template']).".php");
    //     $data_array=array(
    //         "id"      => $row1['id'],
    //         "subject" => $row1['subject'],
    //         "filepath" => "email-template/".strtolower($row1['template']).".php",
    //         "template"=> $row1['template'],
    //         "email"   => $row1['member_email'],
    //         "name" => $row1['member_name'],
    //         "phone" => $row1['member_phone'],
    //         "designation" =>$row1['member_degination'],
    //         "campaign_name" =>$row1['campaign_name'],
    //         "list_id" =>$row1['list_id']
    //         );

    //     $respose=sendTestEmailMethod($data_array);
    // }
  
return 1;
    	   
}

function addAndSendTemplate(){
    include ('email-template/manualTemplate.php');   
 extract($_POST);
  $login_id=$_SESSION['login_id'];
 $sql="INSERT INTO `manual_templete` (`id`, `template_name`, `content`, `created_dt`, `session_id`) 
 VALUES (NULL, '".$_POST['name']."', '".str_replace("'", "''", htmlspecialchars_decode($_POST['editor'], ENT_QUOTES))."', CURRENT_TIMESTAMP, '$login_id')";
 $query1= $this->db->query($sql);
//  $query1 = mysqli_query($con,$sql);
 $insert_id = $this->db->insert_id;

 $role= $_SESSION['role'];
 $adminRecord =mysqli_query( $this->db,"SELECT * from admin where id='$login_id'");
 $fetchAdminRecord = mysqli_fetch_array($adminRecord);
 $totalAvailableEmail= intval($fetchAdminRecord['email_limit']);
 
 $querySignature = $this->db->query("SELECT * from my_signature where login_id='$login_id'");
 $mySign='';
while($rowSig=mysqli_fetch_array($querySignature)){
 $mySign = $rowSig['signature'];   
} 

 $listid= implode(",", $vendor);
// echo "SELECT * from addmember where list_id IN ($vendor)";
if($role!='admin' && $totalAvailableEmail==0)
    return "-1";

if($role!='admin')
 $query = $this->db->query("SELECT * from addmember where list_id IN ($listid) limit $totalAvailableEmail");
 else
 $query = $this->db->query("SELECT * from addmember where list_id IN ($listid)");
$obj="";
$i=0;
while($row=mysqli_fetch_array($query)){
    $i++;
    $id=$_SESSION['login_id'];
    $list_id=$row['list_id'];
    $name=$row['name'];
    $email=$row['email'];
    $phone=$row['phone_no'];
    $degination=$row['degination'];
    
    $data = "member_name = '$name' ";
    $data .= ",list_id = '$list_id' ";
    $data .= ", session_id = '$id' ";
    $data .= ", member_email = '$email' ";
    $data .= ", member_phone = '$phone' ";
    $data .= ", member_degination = '$degination' ";
    $data .= ", template = '".$_POST['name']."' ";
    $data .= ", campaign_name = 'Manual' ";
    $data .= ", subject = '$subject' ";
    $data .= ", email_send_status = 'yes' ";
    $data .= ", email_shoot = 'Email Shoot1' ";
    $data .= ", email_type = 'manual' ";
    $data .= ", is_email_active = 'yes' ";
    $data .= ", template_id = '$insert_id' ";
    
    $save = $this->db->query("INSERT INTO sendemaildata set ".$data);
    $rowid = $this->db->insert_id;
    
    $objdata= array(
    "content"=>str_replace("'", "''", htmlspecialchars_decode($_POST['editor'], ENT_QUOTES)),
    "template"=>$_POST['name'],
    "campaign_name"=>"",
    "list_id"=>$list_id,
    "salutation" => $salutation,
    "person_name" => $row['name'],
    "id"=>$rowid,
    "signature" =>$mySign
    
    );
    $html= $this->minify_html(returnTemplate1($objdata));
    $obj .='{
			"From": {
				"Email": "test@youremail.com",
				"Name": "corp2corpreq"
			},
			"To": [{
				"Email": "'.$email.'",
				"Name": "'.$name.'"
			}],
			"Subject": "'.$subject.'",
			"TextPart": "'.$subject.'",
			"HTMLPart": "'.$html.'"
		},'; 
    
    }



$obj= substr($obj, 0, -1);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"Messages": ['.$obj.'
	]
}
',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
     'Authorization: Basic base64encode(key:secrectkey)'
  ),
));
$response = curl_exec($curl);

curl_close($curl);
// $res =json_decode($response);   
// $res = $res['Messages'];

$array = json_decode($response, true);

// Accessing values in the array
foreach ($array['Messages'] as $message) {
    
            $sql =$this->db->query("UPDATE sendemaildata SET messageUUID='".$message['To'][0]['MessageUUID']."', 
            message_id='". $message['To'][0]['MessageID'] ."', 
            message_href='" . $message['To'][0]['MessageHref'] . "'
            WHERE member_email ='".$message['To'][0]['Email']."' 
            AND list_id IN ($listid) 
            AND subject='$subject' 
            AND template_id='$insert_id' ");
}
// update email limit
if($role!='admin'){
 $email_limit= intval($totalAvailableEmail) - intval($i);
$updateEmailLimit =mysqli_query( $this->db,"UPDATE admin SET email_limit ='$email_limit' where id='$login_id'");   
}


 return "1";
}

function updateStatusEmail(){
    extract($_POST);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.mailjet.com/v3/REST/message/?FromTS="'.$fromdate.'"&ToTS='.$todate,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
   'Authorization: Basic base64encode(key:secrectkey)'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;
$array = json_decode($response, true);
foreach ($array['Data'] as $item) {
  $save = $this->db->query("UPDATE sendemaildata set email_open_status ='".$item['Status']."' WHERE message_id='".$item['ID']."'");  
}

return 1;
}


function updateStatusEmailCron(){
    // extract($_POST);
$todate = date("Y-m-d");
$fromdate = date('Y-m-d', strtotime('-2 days', strtotime('2008-12-02')));

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.mailjet.com/v3/REST/message/?FromTS="'.$fromdate.'"&ToTS='.$todate,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic base64encode(key:secrectkey)'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;
$array = json_decode($response, true);
foreach ($array['Data'] as $item) {
  $save = $this->db->query("UPDATE sendemaildata set email_open_status ='".$item['Status']."' WHERE message_id='".$item['ID']."'");  
}

return 1;
}



function deleteEmail(){
extract($_POST);
  if($id==0) {
      $query = $this->db->query("SELECT GROUP_CONCAT( member_email) as 'emails' FROM sendemaildata WHERE email_open_status in ('bounce','bounced', 'blocked', 'softbounced', 'hardbounced', 'deferred');
");
  }else{
$query = $this->db->query("SELECT GROUP_CONCAT( member_email) as 'emails' FROM sendemaildata WHERE list_id='$id' AND email_open_status in ('bounce','bounced', 'blocked', 'softbounced', 'hardbounced', 'deferred');
");
}
$emails='';
$row=mysqli_fetch_array($query);
$emails=  $row['emails'];  
if($emails!=''){
    if($id==0){
   $updateQry =  $this->db->query("DELETE FROM addmember WHERE email IN ('".str_replace(",", "','", $emails  )."') ");       
    }else{
        $updateQry =  $this->db->query("DELETE FROM addmember WHERE list_id='$id' AND  email IN ('".str_replace(",", "','", $emails  )."') ");  
    }
   

if($updateQry){
    return 1;
}else{
    return 2;
}
}else{
    return 3;
}
   
}


function mergelist(){
extract($_POST);
  $sql= "INSERT INTO `addmember` ( `list_id`, `session_id`, `name`, `email`, `phone_no`, `degination`, `status`)
SELECT '$listid' as 'list_id', `session_id`, `name`, `email`, `phone_no`, `degination`, `status` FROM addmember WHERE list_id='$mergeid' ";

 $updateQry =  $this->db->query($sql);
 if($updateQry){
    return 1;
}else{
    return 2;
}
}


function changeUserStatus(){
extract($_POST);

  $sql= " UPDATE admin SET account_type ='$account_type' WHERE id='$id' ";

 $updateQry =  $this->db->query($sql);
 if($updateQry){
    return 1;
}else{
    return 2;
}
}

function changeListVisibility(){
extract($_POST);

  $sql= " UPDATE list SET visibility_type ='$visibility_type' WHERE id='$id' ";

 $updateQry =  $this->db->query($sql);
 if($updateQry){
    return 1;
}else{
    return 2;
}
}


function forgotPassword(){
extract($_POST);
include ('email-template/forgot-password.php');  
$chars = "0123456789";
date_default_timezone_set("Asia/kolkata");
$otp =substr(str_shuffle($chars),0,6);
$otp_time= date("Y-m-d H:s:i");

  $sql= " UPDATE admin SET otp='$otp', otp_time='$otp_time' WHERE email='$email' ";

 $updateQry =  $this->db->query($sql);
 if($updateQry){
    //  returnForgotPassword
      $objdata= array(
    "otp"=>base64_encode($otp),
    "otp_time" => base64_encode($otp_time),
    "email"=>base64_encode($email)
    
    );
    $html= $this->minify_html(returnForgotPassword($objdata));
    $curl = curl_init();
    curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"Messages": [{
			"From": {
				"Email": "test@youremail.com",
				"Name": "corp2corpreq"
			},
			"To": [{
				"Email": "'.$email.'",
				"Name": ""
			}],
			"Subject": "Reset password link",
			"TextPart": "Reset password link",
			"HTMLPart": "'.$html.'"
		}
	]
}
',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    // 'Authorization: Basic OGZkMDE0ZjkwNGUxZmNkMGUzZjgzMThhM2FmOWExMDI6NzJiZTJhNGE1ZjI4YmY5OWY3ZjlkZjQ3YTNjNTZlODg='
     'Authorization: Basic base64encode(key:secrectkey)'
  ),
));
$response = curl_exec($curl);

curl_close($curl);

    

     
    return 1;
}else{
    return 2;
}
}




}