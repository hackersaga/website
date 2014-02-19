<?php

$success = 0;
 
if(isset($_REQUEST['email'])){

	$emailID = $_REQUEST['email'];
	require_once('connect.php');
	$db = new DB_CONNECT();

	$query_check_emailID = "SELECT email FROM user WHERE email='$emailID'";
	$result = mysql_query($query_check_emailID);
	if(!empty($result)){
		if(mysql_num_rows($result)>0){
			$success =  1;
		}
		else{
			$success = 2 ;
		}
	}
	else{
		$success = 3;
	}
}

echo "$success";

?>