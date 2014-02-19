<?php

class USER_UPDATE{
	
	
	function __construct() {
        // connecting to database
		
    }
	
	function connectDB(){
		require_once('connect.php');
		$db = new DB_CONNECT();
	}
	

	public function personal($email,$fname,$lname,$mobile){
		require_once('connect.php');
		$db = new DB_CONNECT();
		$response = array();
		$query = "UPDATE user SET firstname='$fname', lastname='$lname', mobile='$mobile' WHERE email='$email'";
		$result = mysql_query($query);
		if($result>0){
			$response['success'] = 1;
			$response['message'] = "personal info updated succesfully!";
		}
		else{
			$response['success'] = 0;
			$response['message'] = "personal info updation failed!";
		}
		return json_encode($response);
	}
	
	public function changepwd($email,$old,$new){
		require_once('connect.php');
		$db = new DB_CONNECT();
		
		$response = array();
		$query1 = "SELECT passwd FROM user WHERE email='$email'";
		$result1 = mysql_query($query1);
		if(empty($result1)){
			$response['success'] = 0;
			$response['message'] = "No user with this email found!";
		}
		else{
		
			if(mysql_num_rows($result1)>0){
				$arr = mysql_fetch_assoc($result1);
				$new = sha1(md5($new));
				$old = sha1(md5($old));
				if($old == $arr['passwd']){
					
					$query = "UPDATE user SET passwd='$new' WHERE email = '$email'";
					$result = mysql_query($query);
					if($result>0){
						$response['success'] = 1;
						$response['message'] = "Password changed succesfully";
					}
					else{
						$response['success'] = 4;
						$response['message'] = "Failed to change password";
					}
				}
				else{
					$response['success'] = 3;
					$response['message'] = "Incorrect old password!";
				}
			}
			else{
				$response['success'] = 2;
				$response['message'] = "No such user exists";
			}
		}
		return json_encode($response);
	}
	
	public function address($email, $address,$city,$state,$country,$postal){
		require_once('connect.php');
		$db = new DB_CONNECT();
		
		$query = "UPDATE user SET address='$address', city='$city', state='$state', country='$country', postal_code='$postal', isset_address=1 WHERE email='$email'";
		$result = mysql_query($query) or die(mysql_error());
		$response = array();
		if($result>0){
			$response['success'] = 1;
			$response['message'] = "Address updated successfully!";
		}
		else{
			$response['success'] = 0;
			$response['message'] = "Address updation failed. Please try again.";
		}
		
		return json_encode($response);
	}
	
	public function add_item($email,$pid,$col){
		require_once('connect.php');
		$db = new DB_CONNECT();
		$query = "SELECT '$col' FROM user WHERE email='$email' AND $col like '%$pid%'";
		$result = mysql_query($query);
		if(!empty($result) && mysql_num_rows($result)>0){
			$response['success'] = 0;
			$response['message'] = "Item already liked";
		}
		else{
			$pid1 = $pid.",";
			$query = "UPDATE user SET $col=IFNULL(CONCAT($col,'$pid1'),'$pid1') WHERE email='$email'";
			$result = mysql_query($query);
			if($result>0){
				$response['success'] = 1;
				$response['message'] = "Item added successfully!";
			}
			else{
				$response['success'] = 0;
				$response['message'] = "Addition of item failed";
			}
		}
		return json_encode($response);
	}
	
	public function add_favlist($email,$pid){
		return $this->add_item($email,$pid,"fav_list");
	}

	public function increaseLike($pid){
		require_once('connect.php');
		$db = new DB_CONNECT();
		$response = array();
		$query = "UPDATE product SET likes=likes+1 WHERE pid='$pid'";
		$result = mysql_query($query);
		if($result>0){
			$response['success'] = 1;
			$response['message'] = "likes updated succesfully!";
		}
		else{
			$response['success'] = 0;
			$response['message'] = "like updation failed!";
		}
		return json_encode($response);
	}

	public function decreaseLike($pid){
		require_once('connect.php');
		$db = new DB_CONNECT();
		$response = array();
		$query = "UPDATE product SET likes=likes-1 WHERE pid='$pid'";
		$result = mysql_query($query);
		if($result>0){
			$response['success'] = 1;
			$response['message'] = "likes updated succesfully!";
		}
		else{
			$response['success'] = 0;
			$response['message'] = "like updation failed!";
		}
		return json_encode($response);
	}

	
	public function add_wardrobe($email,$pid){
		return $this->add_item($email,$pid,"wardrobe");
	}
	
	public function remove_item($email,$pid,$col){
		require_once('connect.php');
		$db = new DB_CONNECT();
		$pid1 = $pid.",";
		$query = "UPDATE user SET $col=REPLACE($col,'$pid1','') WHERE email='$email'";
		$result = mysql_query($query);
		if($result>0){
			$response['success'] = 1;
			$response['message'] = "Item removed successfully!";
		}
		else{
			$response['success'] = 0;
			$response['message'] = "removal of item failed";
		}
		return json_encode($response);
	}
	
	public function remove_favlist($email,$pid){
		return $this->remove_item($email,$pid,'fav_list');
	}
	
	public function remove_wardrobe($email,$pid){
		return $this->remove_item($email,$pid,'wardrobe');
	}
	
	public function subscribe($email,$bool){
		require_once('connect.php');
		$db = new DB_CONNECT();
		$query ="";
		if($bool){
			$query = "UPDATE user SET isset_subscribe=1 WHERE email='$email'";
			$result = mysql_query($query);
			if($result>0){
				$response['success'] = 1;
				$response['message'] = "Subscribed successfully!";
			}
			else{
				$response['success'] = 0;
				$response['message'] = "Subscription failed";
			}
		}
		else{
			$query = "UPDATE user SET isset_subscribe=0 WHERE email='$email'";
			$result = mysql_query($query);
			if($result>0){
				$response['success'] = 1;
				$response['message'] = "Unsubscribed successfully!";
			}
			else{
				$response['success'] = 0;
				$response['message'] = "Unsubscription Failed";
			}
		}
		
		return json_encode($response);
	}

	public function getFavList($email){
		require_once('connect.php');
		$db = new DB_CONNECT();
		$response = array();
		$query = "SELECT firstname,lastname,gender,fav_list FROM user WHERE email='$email'";
		$result  = mysql_query($query);
		if(!empty($result)){
			$id_str_arr = mysql_fetch_assoc($result);
			$response['profile'] = array();
			$response['profile']['name'] = $id_str_arr['firstname']." ".$id_str_arr['lastname'];
			$response['profile']['gender'] = $id_str_arr['gender'] ;
			$response['profile']['email'] = $email ;
			if(strlen(trim($id_str_arr['fav_list']))>0){
				$list = explode(",", $id_str_arr['fav_list']);
				$query = "SELECT * FROM product WHERE pid IN (";
				for($i=0;$i<sizeof($list)-2;$i++){
					$query .= $list[$i].",";
				}
				$query.= $list[$i].")";
				$result = mysql_query($query);
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
			}
			else{
				$response['success'] = 1;
				$response['message'] = "unable to fetch like list";
				$response['data'] = "";
			}
		}
		else{
				$response['success'] = 0;
				$response['message'] = "unable to fetch like list";			
		}
		return json_encode($response);
	}

	public function getTransactions($email){
		require_once('connect.php');
		$db = new DB_CONNECT();
		$query = "SELECT * FROM transactions WHERE email='$email'";
		$result = mysql_query($query);
		$response = array();
		$response['data'] = array();
		if(!empty($result)){
			while($row = mysql_fetch_assoc($result)){
				$detail = json_decode($row['detail'],true);
				$pname = explode(",",$row['product_name']);
				$row1 = array();
				$row1['transaction_id'] = $row['transaction_id'];
				$row1['full_address'] = $row['full_address'];
				$row1['total'] = $row['total'];
				$row1['approval'] = $row['approval'];
				$date = explode(" ", $row['datetime']);
				$row1['date'] = $date[0];
				$row1['time'] = $date[1];
				for($i=0;$i<sizeof($detail);$i++){
					$row1['item_id'] = $detail[$i]['item_id'];
					$row1['item_size'] = $detail[$i]['item_size'];
					$row1['item_qty'] = $detail[$i]['item_qty'];
					$row1['item_name'] = $pname[$i];
					array_push($response['data'],$row1);
				}
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

	public function getUploads($email){
		require_once('connect.php');
		$db = new DB_CONNECT();
		$query = "SELECT * FROM uploads WHERE email='$email'";
		$result = mysql_query($query);
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



	public function getProfileData($email){
		$fav = json_decode($this->getFavList($email),true);
		$trans = json_decode($this->getTransactions($email),true);
		$uploads = json_decode($this->getUploads($email),true);
		$response = array();
		$response['fav'] = array();
		$response['trans'] = array();
		$response['uploads'] = array();
		$response['profile'] = array();
		if($fav['success']=='1' && $trans['success']=='1' && $uploads['success']=='1'){
			$response['success'] = 1;
			$response['message'] = "Got result successfully!";
				$response['fav'] = $fav['data'];
				$response['profile'] = $fav['profile'];
				$response['trans'] = $trans['data'];
				$response['uploads'] = $uploads['data'];
		}
		else{
			$response['success'] = 0;
			$response['message'] = "Unable to fetch profile data!";
		}
		return json_encode($response);
	}



	public function getLikedList($email){
		require_once('connect.php');
		$db = new DB_CONNECT();
		$query = "SELECT fav_list FROM user WHERE email='$email'";
		$result = mysql_query($query);
		$response = array();
		$response['data'] = "null";
		if(!empty($result)){
			$row = mysql_fetch_assoc($result);
			$response['data'] = $row['fav_list'];
			
			$response['success'] = 1;
			$response['message'] = "Got result successfully!";
			
		}
		else{
			$response['success'] = 5;
			$response['message'] = "Got empty results while fetching the result";
		}
		
		return json_encode($response);
	}

	public function likeItem($email,$pid){
		$temp  = $this -> add_favlist($email,$pid);
		$back_response = json_decode($temp,true);
		$response = array();
		if($back_response['success']=='1'){
			$back_response = json_decode($this->increaseLike($pid),true);  
			if($back_response['success']=='1'){
				$response['success'] = 1;
				$response['message'] = "liked successfully!";
			}
			else{
				$response['success'] = 10;
				$response['message'] = "like failed!";
			}
		echo json_encode($response);
		}
		else{
				echo ($temp);
		}

	}

	public function dislikeItem($email,$pid){
		$temp  = $this -> remove_favlist($email,$pid);
		$back_response = json_decode($temp,true);
		$response = array();
		if($back_response['success']=='1'){
			$back_response = json_decode($this->decreaseLike($pid),true);  
			if($back_response['success']=='1'){
				$response['success'] = 1;
				$response['message'] = "disliked successfully!";
			}
			else{
				$response['success'] = 10;
				$response['message'] = "dislike failed!";
			}
		echo json_encode($response);
		}
		else{
				echo ($temp);
		}

	}	
}



// require_once('insert_user.php');
 //    $insert= new USER_UPDATE();
	// $res = $insert-> getProfileData("patidar.sagar6955@gmail.com");
	
	// echo "$res";
/*
if(isset($_POST['code'])){
	$code = $_POST['code'];
	if($code==0){ // like it
		if(isset($_POST['email']) && isset($_POST['pid'])){
			$res = $insert-> add_favlist($_POST['email'],$_POST['pid']);
			echo "$res";
		}
	}
	else if($code==1){ // dislike it
		if(isset($_POST['email']) && isset($_POST['pid'])){
			$res = $insert-> remove_favlist($_POST['email'],$_POST['pid']);
			echo "$res";	
		}
	}
	else if($code==2){ // get fav list
		if(isset($_POST['email'])){
			$res = $insert-> getFavList($_POST['email']);
			echo "$res";
		}
	}
}
*/

?>