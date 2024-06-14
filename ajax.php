<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'unsubscribe'){
	$addslider = $crud->unsubscribe();
	if($addslider)
		echo $addslider;
}

if($action == 'deleteunsubscribe'){
	$addslider = $crud->deleteunsubscribe();
	if($addslider)
		echo $addslider;
}

if($action == 'addlist'){
	$addslider = $crud->addlist();
	if($addslider)
		echo $addslider;
}
if($action == 'deletelist'){
	$addslider = $crud->deletelist();
	if($addslider)
		echo $addslider;
}
if($action == 'addlistmember'){
	$addslider = $crud->addlistmember();
	if($addslider)
		echo $addslider;
}
if($action == 'listmem'){
	$addslider = $crud->listmem();
	if($addslider)
		echo $addslider;
}


if($action == 'editlist'){
	$addslider = $crud->editlist();
	if($addslider)
		echo $addslider;
}


if($action == 'deletemember'){
	$addslider = $crud->deletemember();
	if($addslider)
		echo $addslider;
}

if($action == 'editmember'){
	$addslider = $crud->editmember();
	if($addslider)
		echo $addslider;
}

if($action == 'addcsvfile'){
	$addslider = $crud->addcsvfile();
	if($addslider)
		echo $addslider;
}
 
if($action == 'sendmail'){
	$addslider = $crud->sendmail();
	if($addslider)
		echo $addslider;
}

if($action == 'viewTemplate'){
	$addslider = $crud->viewTemplate();
	if($addslider)
		echo $addslider;
}

if($action == 'sendTestEmail'){
	$addslider = $crud->sendTestEmail();
	if($addslider)
		echo $addslider;
}

if($action == 'sendtemplateEamil'){
	$addslider = $crud->sendtemplateEamil();
	if($addslider)
		echo $addslider;
}

if($action == 'addCampaign'){
	$addslider = $crud->addCampaign();
	if($addslider)
		echo $addslider;
}

if($action == 'deleteCampaign'){
	$addslider = $crud->deleteCampaign();
	if($addslider)
		echo $addslider;
}

if($action == 'editCampaign'){
	$addslider = $crud->editCampaign();
	if($addslider)
		echo $addslider;
}

if($action == 'filtercamp'){
	$addslider = $crud->filtercamp();
	if($addslider)
		echo $addslider;
}
if($action == 'adduser'){
	$addslider = $crud->adduser();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteuser'){
	$addslider = $crud->deleteuser();
	if($addslider)
		echo $addslider;
}

if($action == 'edituser'){
	$addslider = $crud->edituser();
	if($addslider)
		echo $addslider;
}

if($action == 'changepass'){
	$addslider = $crud->changepass();
	if($addslider)
		echo $addslider;
}

if($action == 'changeprofile'){
	$addslider = $crud->changeprofiles();
	if($addslider)
		echo $addslider;
}

if($action == 'editlistmember'){
	$addslider = $crud->editlistmember();
	if($addslider)
		echo $addslider;
}

if($action == 'filtercampunsubscribe'){
	$addslider = $crud->filtercampunsubscribe();
	if($addslider)
		echo $addslider;
}

// add manual template

if($action == 'addTemplate'){
	$addslider = $crud->addTemplate();
	if($addslider)
		echo $addslider;
}

if($action == 'viewManualTemplate'){
	$addslider = $crud->viewManualTemplate();
	if($addslider)
		echo $addslider;
}

if($action == 'sendTestEmailManual'){
	$addslider = $crud->sendTestEmailManual();
	if($addslider)
		echo $addslider;
}
if($action == 'sendManualtemplateEamil'){
	$addslider = $crud->sendManualtemplateEamil();
	if($addslider)
		echo $addslider;
}

if($action == 'addSignature'){
	$addslider = $crud->addSignature();
	if($addslider)
		echo $addslider;
}

if($action == 'addAndSendTemplate'){
	$addslider = $crud->addAndSendTemplate();
	if($addslider)
		echo $addslider;
}

if($action == 'updateStatusEmail'){
	$addslider = $crud->updateStatusEmail();
	if($addslider)
		echo $addslider;
}

if($action == 'deleteEmail'){
	$addslider = $crud->deleteEmail();
	if($addslider)
		echo $addslider;
}

if($action == 'mergelist'){
	$addslider = $crud->mergelist();
	if($addslider)
		echo $addslider;
}

// cron
if($action == 'updateStatusEmailCron'){
	$addslider = $crud->updateStatusEmailCron();
	if($addslider)
		echo $addslider;
}

if($action == 'changeUserStatus'){
	$changeUserStatus = $crud->changeUserStatus();
	if($changeUserStatus)
		echo $changeUserStatus;
}


if($action == 'changeListVisibility'){
	$changeUserStatus = $crud->changeListVisibility();
	if($changeUserStatus)
		echo $changeUserStatus;
}


if($action == 'forgotPassword'){
	$changeUserStatus = $crud->forgotPassword();
	if($changeUserStatus)
		echo $changeUserStatus;
}


