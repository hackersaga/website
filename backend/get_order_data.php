<?php

$email="";
$firstname = "";
$lastname = "";
$mobile = "";
$address = "";
$city = "";
$state="Select state";
$pin = "";
$subtotal = 0;
$debug="";
if(isset($_SESSION['email'])){
	require_once('common.php');
	$email = $_SESSION['email'];
	$query = "SELECT firstname,lastname,mobile,address,city,state,country,postal_code FROM user WHERE email = '$email'";
	$arr = json_decode(execute_query($query),true);
	
	if($arr['data'][0]['firstname']!=null){
		$firstname = $arr['data'][0]['firstname'];
	}

	if($arr['data'][0]['lastname']!=null){
		$lastname = $arr['data'][0]['lastname'];
	}

	if($arr['data'][0]['mobile']!=null){
		$mobile = $arr['data'][0]['mobile'];
	}

	if($arr['data'][0]['address']!=null){
		$address = $arr['data'][0]['address'];
	}

	if($arr['data'][0]['city']!=null){
		$city = $arr['data'][0]['city'];
	}

	if($arr['data'][0]['postal_code']!=null){
		$pin = $arr['data'][0]['postal_code'];
	}
	
	if($arr['data'][0]['state']!=null){
		$state = $arr['data'][0]['state'];
	}	
	if(sizeof($_SESSION['cart'])>0){
		$query = "SELECT pid, price FROM product WHERE pid in (";
		$i=0;
		for($i;$i<sizeof($_SESSION['cart'])-1;$i++){
			$query.=$_SESSION['cart'][$i]['item_id'].",";
		}
		$query.=$_SESSION['cart'][$i]['item_id'].")";
		$checkout_arr = json_decode(execute_query($query),true);
		

		for($i=0;$i<sizeof($_SESSION['cart']);$i++){
			for($j=0;$j<sizeof($checkout_arr['data']);$j++){
				if($_SESSION['cart'][$i]['item_id']==$checkout_arr['data'][$j]['pid']){
					$subtotal+=($checkout_arr['data'][$j]['price']*$_SESSION['cart'][$i]['item_qty']);
				}
			}
		}


	}

}


function selectState($user){
		
		$states = array('Select state','Delhi', 'Madhya Pradesh', 'Rajsthan', 'Gujrat', 'Haryana', 'Punjab');

		$select = "<select id='state_select' name='state'>\n";

		foreach($states as $u) {
		   $s = ($u == $user) ? 'selected' : '';
		   $select .= "<option value='$u' $s>$u</option>\n";
		}
		echo $select . "</select>"; 
}

?>