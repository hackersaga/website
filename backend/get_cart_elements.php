<?php
if(session_id() == '') {
    session_start();
}


if(sizeof($_SESSION['cart'])>0){
	$query = "SELECT pid,price,pname FROM product WHERE pid IN (";
	for($g1=0;$g1<sizeof($_SESSION['cart'])-1;$g1++){
		$query.=$_SESSION['cart'][$g1]['item_id']."," ;
	}
	$query.=$_SESSION['cart'][$g1]['item_id'].")" ;
	include_once('common.php');
	$get_arr = json_decode(execute_query($query),true);


	for($g1=0;$g1<sizeof($get_arr['data']);$g1++){
		$my_row = 0;
		for($h1=0;$h1<sizeof($_SESSION['cart']);$h1++){
			if($_SESSION['cart'][$h1]['item_id']==$get_arr['data'][$g1]['pid']){
				$my_row = $h1;
				break;
			}
		}
			$get_arr['data'][$g1]['size'] = $_SESSION['cart'][$my_row]['item_size'];
			$get_arr['data'][$g1]['qty'] = $_SESSION['cart'][$my_row]['item_qty'];
	}
	
	echo json_encode($get_arr['data']);

}
else{
	echo "";
}

?>