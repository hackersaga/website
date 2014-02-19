<?php 
if(session_id() == '') {
    session_start();
}

require_once('common.php');
if(sizeof($_SESSION['cart'])>0){
	if(isset($_POST['firstname']) &&  isset($_POST['lastname']) && isset($_POST['mobile']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['city']) &&  isset($_POST['country']) && isset($_POST['pincode'])){
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$address = $_POST['firstname']." ".$_POST['lastname']."<br>".$_POST['address']."<br>".$_POST['city']."<br>".$_POST['state']."<br>".$_POST['country']."<br> PIN-".$_POST['pincode']."<br>";
		//print_r($address);
		$ms = round(microtime(true)*1000);
		require_once('connect.php');
		require_once('insert_user.php');
		$db = new DB_CONNECT();
		$insert_user = new USER_UPDATE();
		$query = "SELECT * FROM vars WHERE var_name='transaction'";
		$result = mysql_query($query) or die(mysql_error()." == 1");
		$row = mysql_fetch_assoc($result);

		$value = $row['var_value']+1;

		//include_once('connect.php');
		//$db = new DB_CONNECT();
		$query = "UPDATE vars SET var_value = '$value' WHERE var_name = 'transaction'";
		$result = mysql_query($query) or die(mysql_error()." == 2 ");;

		$tid = "BPO"."$value";
		$detail = json_encode($_SESSION['cart']);

		$query = "SELECT pid, price, pname FROM product WHERE pid in (";
		$i=0;
		$subtotal = 0;
		$shipping = 0;

		for($i;$i<sizeof($_SESSION['cart'])-1;$i++){
			$query.=$_SESSION['cart'][$i]['item_id'].",";
		}



		$query.=$_SESSION['cart'][$i]['item_id'].")";
		$checkout_arr = json_decode(execute_query($query),true);		
		$product_name = "";
		for($i=0;$i<sizeof($_SESSION['cart']);$i++){
			for($j=0;$j<sizeof($checkout_arr['data']);$j++){
				if($_SESSION['cart'][$i]['item_id']==$checkout_arr['data'][$j]['pid']){
					$subtotal+=($checkout_arr['data'][$j]['price']*$_SESSION['cart'][$i]['item_qty']);
				}
			}
			$insert_user->add_wardrobe($email,$_SESSION['cart'][$i]['item_id']);
		}

		for($j=0;$j<sizeof($checkout_arr['data'])-1;$j++){
			$product_name.=$checkout_arr['data'][$j]['pname'].",";
		}
		$product_name.=$checkout_arr['data'][$j]['pname'];
		//echo $product_name;
		$total = $shipping+$subtotal;
		$query = "INSERT INTO transactions(transaction_id,email,mobile,full_address,detail,product_name,state,country,subtotal,shipping,total)".
				 "VALUES('$tid','$email','$mobile','$address','$detail','$product_name','$state','$country','$subtotal','$shipping','$total')";

		$result =  json_decode(execute_insert_query($query),true);
		if($result['success']=='1'){
			header("location:/bpink-17-feb/beyondpink/home/profile.php");
			$_SESSION['cart'] = array();
		}


	}
}
?>