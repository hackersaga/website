<?php

function execute_query($query){

	require_once('connect.php');
	$db = new DB_CONNECT();
	
	$result = mysql_query($query);
	$response = array();
	$response['data'] = array();
	if(!empty($result)){
		while($row = mysql_fetch_assoc($result)){
			array_push($response['data'],$row);
		}
		$response['success'] = 1;
		$response['message'] = "Got result successfully!";
		
	}
	else{
		$response['success'] = 5;
		$response['message'] = "Got empty results while fetching the result";
	}
	
	return json_encode($response);
}

function execute_insert_query($query){
	require_once('connect.php');
	$db = new DB_CONNECT();
	
	$result = mysql_query($query) or die(mysql_error());
	$response = array();
	if($result){
		$response['success'] = 1;
		$response['message'] = "Insertion Successful!";
	}
	else{
		$response['success'] = 0;
		$response['message'] = "Insertion failed!";
	}
	
	return json_encode($response);

}

?>