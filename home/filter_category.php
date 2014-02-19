<?php
require_once('../backend/common.php');

if($_POST['filter_products']){
	$query  = "SELECT * FROM product WHERE ".($_POST['filter_products']);
	echo execute_query($query);
}
else{
	$response = array();
	$response['success'] = 0;
	$response['message'] = "Nothing posted here.";
	echo json_encode($response);
}

?>