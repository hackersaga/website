<?php
if(session_id() == '') {
    session_start();
}

?>
<html language="en">
	<head>
		<?php include_once("head.php"); ?>
		<link href="profile.css" rel="stylesheet">
		<script type="text/javascript">
		$(function() {
			$("li").click(function(e) {
			  e.preventDefault();
			  $("li").removeClass("active");
			  $(this).addClass("active");
			});
		});

		var data = <?php 
					  include_once("../backend/insert_user.php");
					  $insert1= new USER_UPDATE();
					  $res = $insert1-> getProfileData($_SESSION['email']);
					  echo "$res";
				 ?>;
		 

		$(document).ready(function(){
			$(".image-upload").hide();
			$("#profile_picture").mouseenter(function(){
				$(".image-upload").show();
			});
			$("#profile_picture").mouseleave(function(){
				$(".image-upload").hide();
			});

			$("#user_name").text(data.profile['name']);
			$("#user_gender").text(data.profile['gender']);
			$("#user_email").text(data.profile['email']);

		$("#file-input").change(function(){
			 var file = $(this).get(0).files[0];
		    //var preview = $('#preview');
		    var img = document.createElement('img');
		    img.src = window.URL.createObjectURL(file);
		    $('#preview').html(img);
		    var reader = new FileReader();
		    reader.onload = function(e) {
		        window.URL.revokeObjectURL(this.src);
		    }
		    reader.readAsDataURL(file);
		});

		var win_ht = $(window).height();
		$("#container1").css('min-height',win_ht-235);

		});
		


		</script>
	</head>

	<body>

		<div id="profile_header">
			<div id="profile_header1">
				<span class="profile_header"><a href="profile.php"><span style="font-size:20px;color:white">]</span> PROFILE <span style="font-size:20px">[</span></a></span>
				<span class="profile_header"><a href="index.php">HOME</a></span>
			</div>	
		</div>	

		<div id="profile_tabs">
				<ul class="tabs group">
					<li><a href="#" id="wardrobe">Wardrobe</a></li>
					<li><a href="#" id="upload">Uploads</a></li>
					<li class="active" ><a href="#" id="fav">Favourites</a></li>
				</ul>	
		</div>	
			
	
<div id="container1">
				<div id="filter_div">
					<!-- Code for filter element. -->
				</div>
				<div id="col_left_big">
						<div id="user_info">

							<span id="user_pic">
								<div class="user_pic"><img src="../layout/left.png"></div>
								<div class="user_pic" id="profile_picture">
									<img src="../layout/profile_pic.png">
									
								</div>
								<div class="user_pic"><img src="../layout/right.png"></div>
							</span>	

							<span id="user_name_gender">
								<div id="user_name">Sarah Jones</div>	
								<div id="user_gender">Female</div>
								<div id="user_email" style="float:right;margin-top:16px;color:#58D3F7">sarahjones@gmail.com</div>
							</span>		

						</div>						

					<div id="col_left" class="column">

					</div>
				</div>
				<div id="col_middle" class="column">
				</div>
				<div id="col_right" class="column">
				</div>
				<br>

	</div>
		<?php   include_once("footer.php");	   ?>
		<?php include_once("login_modal.php"); ?>
	<script type="text/javascript">
	function addItem(pid,pcolor,pname,plikes,pdescription){
			var str = '<div id="img1" class="item"><div><a href="item.php#'+pid+'"><div id="to_append_'+pid+'"></div></a></div><div class="color_like"><div class="colors"><div class="available_colors">';

			var arr = pcolor.split(",");
			for(var j1=0;j1<arr.length-1;j1++){
				str += '<div class="circle" style="background-color:'+arr[j1]+'"></div>&nbsp;';
			}
			str +=	'</div></div>';
			str+= '<div class="like"><div id="heart_'+pid+'" class="heart" onclick="addItemToFav('+pid+')"><img src="../layout/heart_gray.png"/></div><div><span id="countlike_'+pid+'">'+plikes+'</span> People like this</div></div></div><div class="description">'+pdescription+'</div>	</div>';

			$('<img id="img_'+pid+'" src="../img/large/'+pname+'" class="img">').load(function(){
				var left_ht = $("#col_left_big").height();
				var mid_ht = $("#col_middle").height();
				var right_ht = $("#col_right").height();
				if(left_ht<=mid_ht && left_ht<=right_ht){
					$(str).appendTo("#col_left");
					$(this).appendTo("	#to_append_"+pid).hide().fadeIn(560);
				}
				else if(mid_ht<=left_ht && mid_ht<=right_ht){
					$(str).appendTo("#col_middle");
					$(this).appendTo("#to_append_"+pid).hide().fadeIn(560);
				}
				else{
					$(str).appendTo("#col_right");
					$(this).appendTo("#to_append_"+pid).hide().fadeIn(560);
				}
				
			});
					
	}



	function loadItems(){
		var y1 = 0;
		for(y1=0;y1<data.fav.length;y1++){
			addItem(data.fav[y1]['pid'],data.fav[y1]['color'],data.fav[y1]['pname'],data.fav[y1]['likes'],data.fav[y1]['title']);
		}
	}

	function addTransactionItem(tid,tsize,tqty,tpid,tname,tdate,ttime,ttotal,tapproval){
		var str = '<div class="item"><div><a href="item.php#'+tpid+'"><div id="to_append_'+tpid+tid+'"></div></a></div><div class="color_like">';

			str+= '</div><div class="description">'+tid+'</div>	</div>';
			
			$('<img id="img_'+tpid+tid+'" src="../img/large/'+tname+'" class="img">').load(function(){
				var left_ht = $("#col_left_big").height();
				var mid_ht = $("#col_middle").height();
				var right_ht = $("#col_right").height();
				if(left_ht<=mid_ht && left_ht<=right_ht){
					$(str).appendTo("#col_left");
					$(this).appendTo("	#to_append_"+tpid+tid).hide().fadeIn(560);
				}
				else if(mid_ht<=left_ht && mid_ht<=right_ht){
					$(str).appendTo("#col_middle");
					$(this).appendTo("#to_append_"+tpid+tid).hide().fadeIn(560);
				}
				else{
					$(str).appendTo("#col_right");
					$(this).appendTo("#to_append_"+tpid+tid).hide().fadeIn(560);
				}
				
			});
	}

	function loadTransactions(){
		var y1 = 0;
		for(y1=0;y1<data.trans.length;y1++){
			addTransactionItem(data.trans[y1]['transaction_id'],data.trans[y1]['item_size'],data.trans[y1]['item_qty'],data.trans[y1]['item_id'],data.trans[y1]['item_name'],data.trans[y1]['date'],data.trans[y1]['time'],data.trans[y1]['total'],data.trans[y1]['approval']);
		}
		
	}

	function addUploads(userial,uname,ucaption){
		var str = '<div class="item"><div><div id="to_append_'+userial+'"></div></div>';

			str+= '<div class="description">'+ucaption+'</div>	</div>';
			
			$('<img id="img_'+userial+'" src="../img/large/'+uname+'" class="img">').load(function(){
				var left_ht = $("#col_left_big").height();
				var mid_ht = $("#col_middle").height();
				var right_ht = $("#col_right").height();
				if(left_ht<=mid_ht && left_ht<=right_ht){
					$(str).appendTo("#col_left");
					$(this).appendTo("	#to_append_"+userial).hide().fadeIn(560);
				}
				else if(mid_ht<=left_ht && mid_ht<=right_ht){
					$(str).appendTo("#col_middle");
					$(this).appendTo("#to_append_"+userial).hide().fadeIn(560);
				}
				else{
					$(str).appendTo("#col_right");
					$(this).appendTo("#to_append_"+userial).hide().fadeIn(560);
				}
				
			});
	}

	function loadUploads(){
		var y1 = 0;
		for(y1=0;y1<data.uploads.length;y1++){
			addUploads(data.uploads[y1]['serial'],data.uploads[y1]['file_name'],data.uploads[y1]['caption']);
		}
		
	}
	if(window.location.hash=="#uploads"){
		loadUploads();
	}
	else if(window.location.hash=="#wardrobe"){
		loadTransactions();
	}	
	else{
		loadItems();
	}


			$(document).on('click',"#wardrobe",function(){
				$("#col_left").empty();
				$("#col_middle").empty();
				$("#col_right").empty();
				window.location.hash="#wardrobe";
				loadTransactions();
			});
			$(document).on('click',"#fav",function(){
				$("#col_left").empty();
				$("#col_middle").empty();
				$("#col_right").empty();
				window.location.hash="";
				loadItems();
			});
			$(document).on('click',"#upload",function(){
				$("#col_left").empty();
				$("#col_middle").empty();
				$("#col_right").empty();
				window.location.hash="#uploads";
				loadUploads();
			});			

	</script>
	</body>
</html>