<?php
if(session_id() == '') {
    session_start();
}
?>
<html language="en">
	<head>
		<?php include_once("head.php"); ?>		
		<link href="search.css" rel="stylesheet">
		
		<script type="text/javascript">
			var mycart = [];
			var mycart1 = [];
			$(document).ready(function(){
				bindSearchEvent();
				
				//mycart = mycart1['data'];



			});

			
		</script>

	</head>	

	<body>
		
		<?php 
			if(isset($_SESSION['email'])) {include_once('login_header.php');}
			include_once("../backend/populate.php");
			$populate = new Populate();
			$res = $populate -> getSearchResults($_REQUEST['q']);
							
		 ?>
		
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
				<div id="no_elem"></div>
				<div id="cat_left" class="column">
				</div>
				<div id="cat_middle" class="column">
				</div>
				<div id="cat_right" class="column">
				</div>				
		</div>	

		<!-------------------------------------------------------------------------------->
			<?php include_once("login_modal.php"); ?>
			<?php   include_once("footer.php");	   ?>
		<!-------------------------------------------------------------------------------->
		<script type="text/javascript">
		function addItem(pid,pcolor,pname,plikes,pdescription,pcat){

					var str = '<div id="img1" class="item"><div><a href="item.php?#'+pid+'" ><div id="to_append_'+pid+'"></div></a></div><div class="color_like"><div class="colors"><div class="available_colors">';

					var arr = pcolor.split(",");
					for(var j1=0;j1<arr.length-1;j1++){
						str += '<div class="circle" style="background-color:'+arr[j1]+'"></div>&nbsp;';
					}
					str +=	'</div></div>';
					str+= '<div class="like"><div class="heart"><img src="../layout/heart.png"/></div><div>'+plikes+' People like this</div></div></div><div class="description">'+pdescription+'</div>	</div>';

					$('<img id="img_'+pid+'" src="../img/small/'+pname+'" class="img">').ready(function(){
						$("#gif_loader").show();
					}).load(function(){
						var left_ht = $("#cat_left").height();
						var mid_ht = $("#cat_middle").height();
						var right_ht = $("#cat_right").height();
						if(left_ht<=mid_ht && left_ht<=right_ht){
							$(str).appendTo("#cat_left");
							$(this).appendTo("	#to_append_"+pid).hide().fadeIn(560);
						}
						else if(mid_ht<=left_ht && mid_ht<=right_ht){
							$(str).appendTo("#cat_middle");
							$(this).appendTo("#to_append_"+pid).hide().fadeIn(560);
						}
						else{
							$(str).appendTo("#cat_right");
							$(this).appendTo("#to_append_"+pid).hide().fadeIn(560);
						}

						$("#gif_loader").hide();
					});
					
				}
				category_name = "women";
				function loadItems(nextX,total){
					for(i;i<total && i<nextX;i++){
						addItem(data.data[i]['pid'],data.data[i]['color'],data.data[i]['pname'],data.data[i]['likes'],data.data[i]['description'],category_name);

					if(i>=n){
						$("#loadmoreitems").addClass("disabled");
					}

					}
				}

				var data = <?php echo "$res"; ?>;
				//var data = JSON.parse(data1);
				if(data.data.length==0){
					$("#no_elem").text('No result found.');
				}
				
				var n = 0;
				if(data.success==1){
					 n = data.data.length;
					var i =0;
					loadItems(i+9,n);
					
				}

				function more(){
						loadItems(i+9,n);
				}	

				function addToFav(id){
					alert(id);
				}

				function set_session_elements(item_id){
					var answer = 0;
					for(var j11=0;j11<n;j11++){
						if(data.data[j11]['pid']==item_id){
							answer = j11;
							break;
						}
					}
					$.ajax({
						type:"POST",
						url: "session.php",
						data:"item_id="+answer+"&item_list="+data1,
						success:function(html){
							//alert(html);
						}
					});
				}
		</script>
	</body>	
</html>	