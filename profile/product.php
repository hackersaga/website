<?php
if(isset($_FILES['file']) && isset($_POST['title']) && isset($_POST['color']) && isset($_POST['tags']) && isset($_POST['price']) )
{
	require_once('connect.php');
	$db = new DB_CONNECT();
	
	$fname = $_FILES["file"]["name"];
	$title = $_POST['title'];
	$color = $_POST['color'];
	$tags = $_POST['tags'];
	$price = $_POST['price'];
	if( $_FILES['file']['name'] != "" )
	{
	   move_uploaded_file($_FILES["file"]["tmp_name"], "../img/small/".$fname);
	}
	else
	{
		echo "Some error occurred 4";
	}
	
	$query = "INSERT INTO product(pid,ptitle,pcolor,ptags,pprice)".
			 "VALUES			 ('$fname','$title', '$color', '$tags', '$price')";

	$query_exe = mysql_query($query) or die(mysql_error());
	echo "product inserted successfully!"; 
}
else{
	echo "Some error occurred 5";
	
}


?>