<?php
if(session_id() == '') {
    session_start();
}


if( isset($_POST['item_id']) && isset($_POST['item_size']) && isset($_POST['item_qty'])){
	$i11 = 0 ;
	$check = 0;
	$id = $_POST['item_id'];
	for($i11;$i11<sizeof($_SESSION['cart']);$i11++){
		if($id==$_SESSION['cart'][$i11]['item_id']){
			$check = 1;
			$_SESSION['cart'][$i11]['item_size'] = $_POST['item_size'];
			$_SESSION['cart'][$i11]['item_qty'] = $_POST['item_qty'];
			break;
		}
	}
	if($check==0){
		$arr = array();
		$arr['item_id'] = $_POST['item_id'];
		$arr['item_size'] = $_POST['item_size'];
		$arr['item_qty'] = $_POST['item_qty'];		
		array_push($_SESSION['cart'],$arr);
		echo "success";
	}
	else{
		echo "Not added";
	}
}

else if( isset($_POST['item_id']) && isset($_POST['item_list']) ){
	
	$_SESSION['item_id'] = $_POST['item_id'];
	$_SESSION['item_list'] = $_POST['item_list'];
}


else if(isset($_POST['item_id']) && isset($_POST['remove'])){
	$id = $_POST['item_id'];
	$i11=0;
	$result1 = "0";
	for($i11;$i11<sizeof($_SESSION['cart']);$i11++){
		if($id==$_SESSION['cart'][$i11]['item_id']){
			array_splice($_SESSION['cart'], $i11,$i11+1);
			$result1 = "1";
			break;
		}
	}
	echo "$result1";

}
else if(isset($_POST['item_id'])){
	$_SESSION['item_id'] = $_POST['item_id'];
}

else if(isset($_POST['item_like_id'])){	
	require_once('../backend/insert_user.php');
	$update= new USER_UPDATE();
	$res = $update -> likeItem($_SESSION['email'],$_POST['item_like_id']);
	echo "$res";
}

else if(isset($_POST['item_dislike_id'])){	
	require_once('../backend/insert_user.php');
	$update= new USER_UPDATE();
	$res = $update -> dislikeItem($_SESSION['email'],$_POST['item_dislike_id']);
	echo "$res";
}

else if(isset($_POST['load_only_item'])){
	include_once("../backend/populate.php");
	$populate = new Populate();
	$res2 = $populate -> getItem($_POST['load_only_item']);
	echo "$res2";
}

else if(isset($_POST['getLikedList'])){
	require_once("../backend/insert_user.php");
	$update = new USER_UPDATE();
	$liked = $update -> getLikedList($_SESSION['email']);
	// $liked = json_encode($liked,true);
	// $liked_array = array();
	// if($liked['success']==1){
	// 	if($liked['fav_list']!=null){
	// 		$liked_array = explode(',', $liked['fav_list']);
	// 	}

	// }
	echo $liked;
}
?>