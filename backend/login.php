<?php
if(session_id() == '') {
    session_start();
}

$response = array();

if(isset($_POST['email']) && isset($_POST['passwd'])){
	$email = $_POST['email'] ;
	$passwd = sha1(md5($_POST['passwd'])) ;
	
	require_once('connect.php');
	$db = new DB_CONNECT();
	
	$query_get_user = "SELECT * FROM user WHERE email = '$email'";
	$result_user_info = mysql_query($query_get_user) ;
	if(!empty($result_user_info)){
		if(mysql_num_rows($result_user_info)>0){
			$row = mysql_fetch_assoc($result_user_info);
			if($row['passwd'] == $passwd) {
				$response['success'] = 1 ;
				$response['message'] = "Login Successful";
				$_SESSION['email'] = $email;
				$_SESSION['cart'] = array();
				if($row['isset_firstname']==1){
					$response['name'] = $row['firstname'];
				}
				else{
					$response['name'] = null;	
				}
			}
			else{
				$response['success'] = 2 ;
				$response['message'] = "Email or password is incorrect.";	
			}
		}
		else{
				$response['success'] = 3 ;
				$response['message'] = "New user? Please register.";	
		}
	}
	else{
		$response['success'] = 4 ;
		$response['message'] = "New user? Please register.";
	}
}
else{
	$response['success'] = 5 ;
	$response['message'] = "Required fields Not available";
}

echo json_encode($response);
?>