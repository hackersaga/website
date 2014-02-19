	<?php

class Populate{
	
	function __construct() {
        // connecting to database	
    }
	
	function getCategory($tag){
		require_once('connect.php');
		$db = new DB_CONNECT();

		$query = "SELECT * FROM product WHERE ptags LIKE '%$tag%'";
		$result = mysql_query($query) or die(mysql_error());
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

		$query = "SELECT * FROM vars WHERE var_name='home'";
		$result = mysql_query($query) or die(mysql_error());
		$response = array();
		$response['data'] = array();
		$data = mysql_fetch_assoc($result);
		$strlength = strlen($data['var_value']);
		$data = explode("#", $data['var_value']);
		
		$size = sizeof($data);
		if($strlength>2){
			$query = "SELECT * FROM product WHERE pid IN ";
			$str = "(";
			for($i=0;$i<$size-2;$i++){
				$str.=("'".$data[$i]."',");
			}
			$str.=("'".$data[$size-2]."')");
			$query.= $str;
			
			$result = mysql_query($query);
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
		}
		
		return json_encode($response);
	}
	
}


$populate = new Populate();
$res = $populate-> getCategory("Skirt");
echo "$res";


?>