<?php
if(isset($_FILES['file']) && isset($_POST['title']) && isset($_POST['color']) && isset($_POST['tags']) && isset($_POST['price'])  && isset($_POST['fabrics']) && isset($_POST['description'])  && ( ($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/jpg') || ($_FILES['file']['type'] == 'image/png')))
{
	require_once('connect.php');
	$db = new DB_CONNECT();
	
	$query = "SELECT * FROM vars WHERE var_name='product'";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	$value = $row['var_value']+1;
	$query = "UPDATE vars SET var_value = '$value' WHERE var_name = 'product'";
	$result = mysql_query($query) or die(mysql_error());

	$fname = "BP_".$value.'_'.$_FILES["file"]["name"];
	$title = $_POST['title'];
	$color = $_POST['color'];
	$description = $_POST['description'];
	if(substr(trim($color," "),-1)!=","){
		$color.=",";
	}
	$tags = $_POST['tags'];
	$price = $_POST['price'];
	$fabrics = $_POST['fabrics'];
	if( $_FILES['file']['name'] != "" )
	{
	   move_uploaded_file($_FILES["file"]["tmp_name"], "../img/large/".$fname);
	   // copy("../img/large/".$fname, "../img/small/".$fname);
	   list($width, $height) = getimagesize("../img/large/".$fname);
	   $newWidth = 300;
	   $newHeight = $height*(300/ $width);
	   $type = $_FILES['file']['type'];
	   echo "$type";
		if(($_FILES['file']['type'] == 'image/png')){
			echo "1";
			$demo = imagecreatetruecolor($newWidth,$newHeight);
			$myimg = imagecreatefrompng("../img/large/".$fname);
	  		imagecopyresized($demo ,$myimg, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height); 
	  		imagepng($demo,"../img/small/".$fname);
		}
		else if(($_FILES['file']['type'] == 'image/jpg')){
			echo "2";
			$demo = imagecreatetruecolor($newWidth,$newHeight);
			$myimg = imagecreatefromjpg("../img/large/".$fname);
	  		imagecopyresized($demo ,$myimg, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height); 
	  		imagejpg($demo,"../img/small/".$fname);
		}
		else if(($_FILES['file']['type'] == 'image/jpeg')){
			echo "3";
			$demo = imagecreatetruecolor($newWidth,$newHeight);
			$myimg = imagecreatefromjpeg("../img/large/".$fname);
	  		imagecopyresized($demo ,$myimg, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height); 
	  		imagejpeg($demo,"../img/small/".$fname);
		}
	   $query = "INSERT INTO product(pid,title,price,color,tags,fabrics,pname,description)".
			 "VALUES			 ('$value','$title', '$price', '$color', '$tags','$fabrics','$fname','$description')";

		$query_exe = mysql_query($query) or die(mysql_error());

	echo "Product added successfully!";

	}
	else
	{
		echo "Some error occurred 4";
	}
	
	
;}
else{
	echo "Some error occurred 5";
	
}
echo "<br><br>";
echo "<a href='insert_product2.html'>";
echo "Back";
echo "</a>";

?>