<?php
if(session_id() == '') {
    session_start();
}


$response = array();
if(isset($_POST['email']) && isset($_POST['passwd']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['gender'])){
	$email = $_POST['email'] ;
	$passwd = sha1(md5($_POST['passwd'])) ;
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$gender = $_POST['gender'];
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

		$query_create_new_user = "INSERT INTO user (firstname,lastname,gender,email,passwd)".
								 "VALUES('$fname','$lname','$gender','$email','$passwd')" ;

		$result_iscreated_new_user = mysql_query($query_create_new_user) or die(mysql_error());
		if($result_iscreated_new_user){
			$response['success'] = 1;
			$response['message'] = "New User created successfully!";
			$_SESSION['email'] = $email;
			$_SESSION['cart'] = array();
		}
		else{
			$response['success'] = 2 ;
			$response['message'] = "Some error occurred. Please Try again.";
		}
	}
	else{
			$response['success'] = 3 ;
			$response['message'] = "User already exist. Please login.";
	}	
}
else{
	$response['success'] = 4 ;
	$response['message'] = "Required fields Not available";
}

echo json_encode($response);
?>