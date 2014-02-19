<?php
if(isset($_POST['item1'])){
	$items = explode(",",$_POST['item1']);
	require_once('common.php');
	
	$query = "SELECT * FROM product WHERE pid = ";
	
	for($i=0;$i<sizeof($items)-2;$i++){
		$query.=($items[$i]." or pid = ");
	}
	$query.=($items[sizeof($items)-2]);
	
		require_once('connect.php');
		$db = new DB_CONNECT();
		
		$result = mysql_query($query);
		
		
		
		$response = array();
	
		if(!empty($result)){
			while($row = mysql_fetch_assoc($result)){
				$str1 = "('".$row['pid']."','".$row['title']."','".$row['price']."','".$row['color']."','".$row['tags']."','".$row['fabrics']."','".$row['likes']."','".$row['purchase']."','".$row['pname']."')" ;
				
				$q1 = "INSERT INTO home (pid,title,price,color,tags,fabrics,likes,purchase,pname)".
					  "VALUES $str1";
				
				$result1  = mysql_query($q1) or die(mysql_error());
				
			}
			$response['success'] = 1;
			$response['message'] = "Got result successfully!";
			
		}
		else{
			$response['success'] = 5;
			$response['message'] = "Got empty results while fetching the result";
		}
	echo "Insertion Successful";
}
else{
	
	echo "No entry found";
}

?>