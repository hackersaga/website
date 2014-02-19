<!DOCTYPE html>
 <?php
if(session_id() == '') {
    session_start();
}
?><html language="en">
	<head>
		<?php include_once("head.php"); ?>
		<link href="item_css.css" rel="stylesheet">
		<script type="text/javascript">

			var isLoggedin = 0;
			var no_cart_elem = 0;
			isLoggedin = <?php if(isset($_SESSION['email'])){echo "1";} else{echo "0";} ?>;
			no_cart_elem = <?php if(isset($_SESSION['email'])){echo sizeof($_SESSION['cart']);} else{echo 0;} ?>;
			var new_item_id=0;
			//var given_id = GetUrlValue('id');
			
			var fshare = "http://www.facebook.com/sharer.php?u=";
			var tshare = "https://twitter.com/intent/tweet?url=";
			function loadNewData(){
				
				
				$("#normal").css("opacity","0.5");
				$('<img src="../img/small/'+data.data[new_item_id]['pname']+'">').load(function(){
					$("#normal").empty();
					$(this).appendTo($("#normal"));
					$('#title').html(data.data[new_item_id]['title']);
					
					$("#description").html(data.data[new_item_id]['description']);
					$("#normal").css("opacity","1");
					$("#share_facebook").attr('href',fshare+(window.location.href));
					$("#share_twitter").attr('href',tshare+(window.location.href));
				});
				$("#normal").mouseleave();
			}

			var data1;
			var data ;
				
			var img_width;
			var img_height;
			var img_left;
			var img_top;

			$(document).ready(function(){

				var given_id = document.location.href.split("#")[1];

				if(given_id==undefined){
					given_id = document.location.href.split("%23")[1];
				alert(given_id);
				}


				bindSearchEvent();
							data1  = <?php 
									include_once("../backend/populate.php");
									$populate = new Populate();
									if(isset($_REQUEST['tag'])){
										$res = $populate -> getCategory($_REQUEST['tag']);
									}
									else{
										$arr['success'] =-1;
										$arr['data'] = array();
										$arr['msg'] = "No category!";
										$res = json_encode($arr);
									}
									echo json_encode($res);
						 			?>;


				data = JSON.parse(data1);
				if(data.success == -1){
    				$.ajax({
    					type:"POST",
    					url:"session.php",
    					async:false,
    					data:"load_only_item="+document.location.hash.split("#")[1],
    					success:function(json){
    						data1 = json;
    						data = JSON.parse(data1);
    					}
					});
    			}
				var x1 = 0;
				loop1:for(x1=0;x1<data.data.length;x1++){
					if(given_id==data.data[x1]['pid']){
						new_item_id = x1 ;
						break loop1;
					}
				}

				loadNewData();
				//alert(($("#container").offset().top)+70);
			
			$("#normal").mouseenter(function(){
				var position = $(this).position();;
				img_width = $("#normal").width();
			 	img_height = $("#normal").height();
			  	img_left = position.left;
			 	img_top = position.top;	


			 	var tint_str = '<div id=\"tintEffect\" class=\"tint\" style=\"width:'+ img_width+'px; height:'+ img_height+'px ;top:'+ img_top+'px; left:'+ img_left+'px \"></div>';
			 	$(this).append(tint_str);
			 	$("#tintEffect").animate({opacity:0.2},10,"linear");
			 	
			 	$("#container").append('<div id="zoomed" class="zoomed" style="width:'+img_width+'px;height:'+img_height+'px;top:'+img_top+'px;left:'+(img_width+img_left)+'px ;"><img id="large_image" class="large_image" src="../img/large/'+data.data[new_item_id]['pname']+'" style="position:absolute;max-width:none;"/></div>');
			 	// $('<img id="large_image" class="large_image" src="../img/large/'+data.data[new_item_id]['pname']+'" style="position:absolute;max-width:none;"/>').load(function(){
			 	// 	$("#container").append('<div id="zoomed" class="zoomed" style="width:'+img_width+'px;height:'+img_height+'px;top:'+img_top+'px;left:'+(img_width+img_left)+'px ;"></div>');
			 	// 	$(this).appendTo($("#zoomed"));
			 	// });

			 	var rt = ($("#large_image").width()/300);
				$(this).append('<div id="lens" class="lens">'+'<img id="overlay_image" src="../img/small/'+data.data[new_item_id]['pname']+'" width='+img_width+' height='+img_height+' style="position:absolute;max-width:none;top:'+img_top+'px; left:'+img_left+'px;"/>'+'</div>');	 	
			 	$("#lens").css({"top":(img_left+(img_width/2)-($("#lens").width()/2)),"left":(img_top+(img_height/2)-($("#lens").height()/2))});
			 	//$("#lens").css({"top":0,"left":0});
			 	
			});

			
			$("#normal").mousemove(function(e){
			  lens(img_top,img_left,img_height+img_top,img_left+img_width,e.pageX,e.pageY,($("#large_image").width()/img_width));
			});


			$("#normal").mouseleave(function(){
				$("#tintEffect").animate({opacity:0.0},100,"linear",function(){
					$("#tintEffect").remove();
				});

				$("#lens").remove();
				$("#zoomed").remove();
			});
					
			});

			function loadNewData(){
				
				
				$("#normal").css("opacity","0.5");
				$('<img src="../img/small/'+data.data[new_item_id]['pname']+'">').load(function(){
					$("#normal").empty();
					$(this).appendTo($("#normal"));
					$('#title').html(data.data[new_item_id]['title']);
					
					$("#description").html(data.data[new_item_id]['description']);
					$("#normal").css("opacity","1");
					$("#share_facebook").attr('href',fshare+(window.location.href));
					$("#share_twitter").attr('href',tshare+(window.location.href));
				});
				$("#normal").mouseleave();
			}

			function lens(top1,left1,bottom1,right1,mouseX,mouseY,ratio){
			
			var widthby2 = ($("#lens").outerWidth()/2);
			var heightby2 = $("#lens").outerHeight()/(2);
			var wid = $("#lens").width();
			var ht = $("#lens").height();

			//console.log(widthby2+" "+heightby2+" "+wid+" "+ht);
			// Checking top and left coordinates of 
		    if((mouseX-widthby2)<=left1){
		   		$("#lens").clearQueue().animate({"left":left1},300,"easeOutQuint");
		   		$("#overlay_image").clearQueue().animate({"left":(wid-widthby2*2)/2},300,"easeOutQuint");
		   		$("#large_image").clearQueue().animate({"left":0},600,"easeOutCirc");
		    }
		    else if((mouseX+widthby2)>=right1){
		    	$("#lens").clearQueue().animate({"left":right1-(widthby2*2)},300,"easeOutQuint");
		    	$("#overlay_image").clearQueue().animate({"left":wid-img_width-(wid-widthby2*2)/2},300,"easeOutQuint");
		    	$("#large_image").clearQueue().animate({"left":-(img_width*ratio- img_width)},600,"easeOutCirc");
		    }
		    else{
		    	$("#lens").clearQueue().animate({"left":mouseX-widthby2},300,"easeOutQuint");
		    	$("#overlay_image").clearQueue().animate({"left":left1+(wid/2)-mouseX},300,"easeOutQuint");
		    	var temp = img_width/2-((mouseX-left1)*ratio);
		    	if(temp>0){
		    		$("#large_image").clearQueue().animate({"left":0},600,"easeOutCirc");
		    	}
		    	else if(temp+img_width>img_width*ratio){
		    		$("#large_image").clearQueue().animate({"right":-(img_width*ratio- img_width)},600,"easeOutCirc");
		    	}
		    	else{
		    		$("#large_image").clearQueue().animate({"left":temp},600,"easeOutCirc");
		    	}
		    }

		    if((mouseY-heightby2)<=top1){
		    	$("#lens").clearQueue().animate({"top":top1},300,"easeOutQuint");
		    	$("#overlay_image").clearQueue().animate({"top":(ht- heightby2*2)/2},300,"easeOutQuint");
		    	$("#large_image").clearQueue().animate({"top":0},600,"easeOutCirc");
		    }
		    else if((mouseY+heightby2)>=bottom1){
		    	$("#lens").clearQueue().animate({"top":bottom1-(heightby2*2)},300,"easeOutQuint");	
		    	$("#overlay_image").clearQueue().animate({"top":ht-img_height-(ht- heightby2*2)/2},300,"easeOutQuint");
		    	$("#large_image").clearQueue().animate({"top":-(img_height*ratio- img_height)},600,"easeOutCirc");
		    }
		    else{
		    	$("#lens").clearQueue().animate({"top":mouseY-heightby2},300,"easeOutQuint");		
		    	$("#overlay_image").clearQueue().animate({"top":top1+(ht/2)-mouseY},300,"easeOutQuint");
		    	var temp = img_height/2-((mouseY-top1)*ratio);
		    	if(temp+img_height>img_height*ratio){
		    		$("#large_image").clearQueue().animate({"top":-(img_height*ratio- img_height)},600,"easeOutCirc");		
		    	}
		    	else if(temp>0){
		    		$("#large_image").clearQueue().animate({"top":0},600,"easeOutCirc");
		    	}
		    	else{
		    		$("#large_image").clearQueue().animate({"top":temp},600,"easeOutCirc");
		    	}
		    }
		}

		if(isLoggedin=="1"){

		}



		</script>
	</head>

	<body>
		

		
		<div id="head2">
			<div id="top_logo">	
				<div style="display:inline-block"><?php include_once('logo_link.php'); ?></div>
				<div id="search"><input type="text" name="search" placeholder="Search" class="input-large" ></div>
			</div>
			<div id="cat_menu">
				<?php include_once("menu.php"); ?>
			</div>
		</div>

		<div id="container">
			<div id="left_arrow">
				<img id="l_image" src="../img/item/arrowL.png"  class="cursor" onclick="leftClick()">
			</div>
			<div id="products">
				<div id="title">The beautiful blue dress</div>

				<div id="img" class="img">
					<div id="normal" class="image-normal">
						<img id="small_image" src="">
					</div>
					
				</div>	
			</div>
			<div id="details">	
				<div id="description">
						Dress to impress or keep things casual with this original faux halter dress that’s made from Rayon.
				</div>	
				<div id="right_arrow">
					<img id="r_image" src="../img/item/arrowR.png"  class="cursor" onclick="rightClick()">
				</div>

				<div id="price_div">
					<div id="status">Share it :</div>
					<div>
						<span><a href="#" id="share_facebook" target="_blank"><img src="../img/item/icon_facebook.png" width="40"/></a></span>
						<span><a href="#" id="share_twitter" target="_blank"><img src="../img/item/icon_twitter.png" width="40"/></a></span>
					</div>
				</div>

			</div>	

		</div>	

		<?php include_once("login_modal.php"); ?>
		<script type="text/javascript">
			$("#cat").on('change',function(){
				var cat = $("#cat").val();
				$.ajax({
					type:'POST',
					url:'../backend/populate.php',
					data:'category='+cat,
					success:function(json){
						data = JSON.parse(json);
						set_param_session(0,json);
						new_item_id = 0;
						loadNewData();
					}
				});
			});

			function leftClick(){
				if(new_item_id>0){
					new_item_id--;
					document.location.hash=data.data[new_item_id]['pid'];
					loadNewData();
				}
			}

			

			function rightClick(){
				if(new_item_id<data.data.length-1){
					new_item_id++;
					document.location.hash=data.data[new_item_id]['pid'];
					loadNewData();
				}
			}

			function set_item_session(item_id){
				$.ajax({
					type:'POST',
					url:'session.php',
					data:'item_id='+item_id
				});
			}

			function set_param_session(item_id,item_list){
				$.ajax({
					type:'POST',
					url:'session.php',
					data:'item_id='+item_id+"&item_list="+item_list
				});
			}

			function addToCart(){
				if(isLoggedin=="1"){
					var cart_item_size = $("#select_size").val();
					var cart_item_qty = $("#select_qty").val();
					if(cart_item_size=="Select size"){
						$("#instruction").html("Please select the size").hide().show("fast");
					}
					else if(cart_item_qty == "Select quantity"){
						$("#instruction").html("Please select the quantity").hide().show("fast");;
					}
					else{
						$("#instruction").html("<img src='../img/ajax_loader.gif'>");
						$("#select_size").val("Select size");
						$("#select_qty").val("Select quantity");
						$("#instruction").html("");
						$.ajax({
							type:'POST',
							url:'session.php',
							data:'item_id='+data.data[new_item_id]['pid']+"&item_size="+cart_item_size+"&item_qty="+cart_item_qty,
							success:function(html){
								$("#instruction").html("<span style='color:green'>Item added to the cart.</span>").hide().show("fast");
							}
						});	
					}
				}
				else{
					$('#login_box').modal('show');
				}
			}

			$(document).keyup(function(e) {
			    if(e.which == 37) {
			        leftClick();
			    }
			    else if(e.which == 39){
			    	rightClick();
			    }
			});


		</script>

	</body>

</html>		