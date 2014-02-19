<?php
if(session_id() == '') {
    session_start();
}


require_once('insert_user.php');
$update= new USER_UPDATE();
if(isset($_SESSION['email'])){
	$email = $_SESSION['email'];
	if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['mobile'])){
		$res = $update -> personal($email,$_POST['firstname'],$_POST['lastname'],$_POST['mobile']);
		echo "$res";
	}
	else if(isset($_POST['address'])  && isset($_POST['city'])  && isset($_POST['state']) && isset($_POST['country'])  && isset($_POST['pin'])){
		$res = $update -> address($email,$_POST['address'],$_POST['city'],$_POST['state'],$_POST['country'],$_POST['pin']);
		echo "$res";		
	}
	else if( isset($_POST['oldpwd'])  && isset($_POST['newpwd'])){
		$res = $update -> changepwd($email,$_POST['oldpwd'],$_POST['newpwd']);
		echo "$res";	
	}
	else{
		$response = array();
		$response['success'] = 5;
		$response['message'] = "Nothing posted :(";
		echo json_encode($response);
	}
}
else{
	$response = array();
	$response['success'] = 6;
	$response['message'] = "Please Login first.";
}

?>