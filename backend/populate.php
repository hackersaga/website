<?php
mb_internal_encoding("utf-8");
if(session_id() == '') {
    session_start();
}

class Populate{
	
	function __construct() {
        // connecting to database	
    }
	
	function getCategory($tag){
		require_once('connect.php');
		$db = new DB_CONNECT();

		$query = "SELECT * FROM product WHERE tags LIKE '%$tag%'";
		$result = mysql_query($query) ;//or die(mysql_error());
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
		return utf8_encode(json_encode($response)) ;
	}

	function getSearchResults($keyword){
		require_once('connect.php');
		$db = new DB_CONNECT();

		$query = "SELECT * FROM product WHERE pid LIKE '%$keyword%' OR title LIKE '%$keyword%'";
		$result = mysql_query($query) ;//or die(mysql_error());
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
		return utf8_encode(json_encode($response)) ;			
	}

	function getItem($pid){
		require_once('connect.php');
		$db = new DB_CONNECT();

		$query = "SELECT * FROM product WHERE pid=".$pid;
		$result = mysql_query($query) ;//or die(mysql_error());
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
	
	function getHome(){
		require_once('connect.php');
		$db = new DB_CONNECT();

		$query = "SELECT * FROM product";
		$result = mysql_query($query) ;//or die(mysql_error());
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


	
}


//$populate = new Populate();
//$res = $populate-> getCategory("Women");
//echo "$res";
// if(isset($_POST['category'])){
// 	$populate = new Populate();
// 	$res = $populate-> getCategory($_POST['category']);
// 	echo $res;
// }

// if(isset($_POST['product_id'])){
// 	$populate = new Populate();
// 	$res = $populate-> getItem($_POST['product_id']);
// 	echo $res;
// }

?>