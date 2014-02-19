<?php

$response = array();
if(isset($_REQUEST['email']) && isset($_REQUEST['passwd'])){
	$email = $_REQUEST['email'] ;
	$passwd = sha1(md5($_REQUEST['passwd'])) ;
	
	require_once('connect.php');
	$db = new DB_CONNECT();
	
	$query_check_emailID = "SELECT email FROM user WHERE email='$email'";
	$result = mysql_query($query_check_emailID);
	$isExists = false ;
	if(!empty($result)){
		if(mysql_num_rows($result)>0){
			$isExists = true ;
		}
	}
	if(!$isExists){
		$query_create_new_user = "INSERT INTO user (email,passwd)".
								 "VALUES('$email','$passwd')" ;

		$result_iscreated_new_user = mysql_query($query_create_new_user) ;
		if($result_iscreated_new_user){
			$response['success'] = 1 ;
			$response['message'] = "New User created successfully!";
			$response['name'] = null ;
		}
		else{
			$response['success'] = 2 ;
			$response['message'] = "Insertion failed due to some reason ";
		}
	}
	else{
			$response['success'] = 3 ;
			$response['message'] = "User already exists!";
	}	
}
else{
	$response['success'] = 4 ;
	$response['message'] = "Required fields Not available";
}

echo json_encode($response);
?>