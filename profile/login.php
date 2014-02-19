<?php 
session_start();

$response = array();

if(isset($_REQUEST['email']) && isset($_REQUEST['passwd'])){
	$email = $_REQUEST['email'] ;
	$passwd = sha1(md5($_REQUEST['passwd'])) ;
	
	require_once('connect.php');
	$db = new DB_CONNECT();
	
	$query_get_user = "SELECT * FROM user WHERE email = '$email'";
	$result_user_info = mysql_query($query_get_user) ;
	if(!empty($result_user_info)){
		if(mysql_num_rows($result_user_info)>0){
			$row = mysql_fetch_assoc($result_user_info);
			if($row['passwd'] == $passwd) {
				session_start();
				$response['success'] = 1 ;
				$response['message'] = "Login Successful";

				$_SESSION['email'] = $email;
				$response['email'] = $email;

				if($row['isset_firstname']==1){
					$response['name'] = $row['firstname'];
				}
				else{
					$response['name'] = null;	
				}
			}
			else{
				$response['success'] = 2 ;
				$response['message'] = "Login failed";
			}
		}
		else{
				$response['success'] = 3 ;
				$response['message'] = "No user found";	
		}
	}
	else{
		$response['success'] = 4 ;
		$response['message'] = "No such User found";
	}
}
else{
	$response['success'] = 5 ;
	$response['message'] = "Required fields Not available";
}

echo json_encode($response);
?>