<!DOCTYPE html>
<?php  
if(session_id() == '') {
    session_start();	
}
 ?>

<html language="en">
	<head>
			
		<?php include_once("head.php");?>		
		<link href="category.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/jquery-ui.css" />
		
		<script type="text/javascript">	
			

			$(document).ready(function(){
				bindSearchEvent();
				$(window).scroll(function() {
				    if($(window).scrollTop() >= ($(document).height() - ($(window).height()))){
				    	more();
				    }
				});
				
				var backdrop_ht = $(window).height() - $("#category_body").offset().top - 289;
				// $("#category_body").css("background-position-y",backdrop_ht+"px");
				// $("#category_body").css("background-attachment","fixed");
				var this_tag = window.location.href;
				this_tag = this_tag.split("tag=")[1];
				
				$("#category_list input").each(function(){
					if(this_tag.indexOf($(this).attr('name'))>=0){
						$(this).attr('checked',true);
					}
					console.log(this_tag.indexOf($(this).attr('name')));
				});
				
			$("#filter_dropdown").click(function(){
				if($("#main_filter").is(":Visible")){
					// alert(1);
					$("#main_filter").slideUp();
				}
				else{
					$("#main_filter").slideDown();
				}
			});
			$("#main_filter").hide();

				
	
			$(function(){
			$(".dropdown").mouseenter(function(){
				$('.sub_menu').stop(false, true).hide();

				var dropdown = $(this).children(".sub_menu");
				
				dropdown.slideDown();

				dropdown.mouseleave(function(){
					dropdown.slideUp();
				});
			});
		});
			
			var win_ht = $(window).height();
			$("#container").css('min-height',win_ht-235);

		});



					$(function() {
					    $( "#slider-range" ).slider({
					      range: true,
					      min: 0,
					      max: 100,
					      values: [ 0, 100 ],
					      animate:"fast",
					      step:1,
					      slide: function( event, ui ) {
					        $("#value_left").html("Rs. "+ui.values[0]*50);
					        $("#value_right").html("Rs. "+ui.values[1]*50);
					       
					      },
					      stop: function (event,ui){
					      	 filter_items();
					      }
					    });
					  });


		</script>

	</head>

	<body>	
		<div>
		<div id="backdrop">
		</div>
	<?php 
			
			include_once("../backend/populate.php");
			$populate = new Populate();
			$res = $populate -> getCategory($_REQUEST['tag']);
		 ?>

		
		<div id="top">
			<div id="top_logo">	
				<div style="display:inline-block"><?php include_once('logo_link.php'); ?></div>
				<div id="search"><input type="text" name="search" placeholder="Search" class="input-large" ></div>
			</div>
			<div id="cat_menu">
				<?php include_once("menu.php"); ?>
			</div>
		</div>
		<div id="category_body">

			<div id="cat_body">
				

			

				<div id="container">
					<div id="filter_table">
					<div id="filter_dropdown">Filter Content&nbsp;&nbsp;<img src="../img/item/down_arrow.png"></div>
					<div id="main_filter">
					<div class="filter_container">
						<div class="filter_head">
							Price limit
						</div>
						<div class="filter_body" style="padding-top:20px;">
							  <div id="slider-range"></div>
							  <div id="slider-values">
							  		<div id="value_left">Rs. 0</div>
							  		<div id="value_right">Rs. 5000</div>
							  </div>
						</div>
					</div>

					<div id="filter_color" class="filter_container">
						<div class="filter_head">
							Select Color
						</div>
						<div class="filter_body">
							  <div class="single_color">
							  		<div>Red</div>
							  		<div class="color_option"><input class="check" type="checkbox" name="color1"></div>
							  </div>
							  <div class="single_color">
							  		<div>Green</div>
							  		<div class="color_option"><input class="check" type="checkbox" name="color2"></div>
							  </div>
							  <div class="single_color">
							  		<div>Blue</div>
							  		<div class="color_option"><input class="check" type="checkbox" name="color3"></div>
							  </div>
							  <div class="single_color">
							  		<div>Pink</div>
							  		<div class="color_option"><input class="check" type="checkbox" name="color3"></div>
							  </div>
							  <div class="single_color">
							  		<div>Black</div>
							  		<div class="color_option"><input class="check" type="checkbox" name="color3"></div>
							  </div>
							  <div class="single_color">
							  		<div>White</div>
							  		<div class="color_option"><input class="check" type="checkbox" name="color3"></div>
							  </div>
							  <div class="single_color">
							  		<div>Grey</div>
							  		<div class="color_option"><input class="check" type="checkbox" name="color3"></div>
							  </div>
							  <div class="single_color">
							  		<div>Yellow</div>
							  		<div class="color_option"><input class="check" type="checkbox" name="color3"></div>
							  </div>
						</div>
					</div>

					

					<div id="filter_category" class="filter_container" style="margin-bottom:0px;">
						<div class="filter_head">
							Select Category
						</div>
						<div class="filter_body">
							  <div style="vertical-align:bottom;margin-bottom:5px;"><div style="display:inline-block;vertical-align:top"><input id="all_category" type="radio" name="all"></div><div style="display:inline-block">&nbsp;&nbsp;All</div></div>
							  <div id="category_list">
							  		<div class="single_category">
							  			<div class="cat_checkbox"><input class="cat_check" type="checkbox" name="Dresses"></div>
							  			<div class="cat_name">Dresses</div>
							  		</div>
							  		<div class="single_category">
							  			<div class="cat_checkbox"><input class="cat_check" type="checkbox" name="Top"></div>
							  			<div class="cat_name">Tops</div>
							  		</div>
							  		<div class="single_category">
							  			<div class="cat_checkbox"><input class="cat_check" type="checkbox" name="Bottoms"></div>
							  			<div class="cat_name">Bottoms</div>
							  		</div>
							  		<div class="single_category">
							  			<div class="cat_checkbox"><input class="cat_check" type="checkbox" name="Pant"></div>
							  			<div class="cat_name">Pants</div>
							  		</div>
							  		<div class="single_category">
							  			<div class="cat_checkbox"><input class="cat_check" type="checkbox" name="Skirt"></div>
							  			<div class="cat_name">Skirts</div>
							  		</div>
							  		<div class="single_category">
							  			<div class="cat_checkbox"><input class="cat_check" type="checkbox" name="Shorts"></div>
							  			<div class="cat_name">Shorts</div>
							  		</div>
							  		<div class="single_category">
							  			<div class="cat_checkbox"><input class="cat_check" type="checkbox" name="Jackets"></div>
							  			<div class="cat_name">Jackets</div>
							  		</div>
							  		<div class="single_category">
							  			<div class="cat_checkbox"><input class="cat_check" type="checkbox" name="Winter"></div>
							  			<div class="cat_name">Winter wear</div>
							  		</div>
							  		<div class="single_category">
							  			<div class="cat_checkbox"><input class="cat_check" type="checkbox" name="Bumble"></div>
							  			<div class="cat_name">Bumble Bee</div>
							  		</div>

							  </div>
						</div>
					</div>
				</div>

				</div>
					<div id="cat_left" class="column">
					</div>
					<div id="cat_middle" class="column">
					</div>
					<div id="cat_right" class="column">
					</div>
					<br>
					<center><div id="gif_loader"><img src="../img/ajax_loader.gif"><div></center>
					<br>
				</div>	
			</div>	
		</div>
	</div>

		<?php   include_once("footer.php");	   ?>
		<?php include_once("login_modal.php"); ?>
			<script type="text/javascript">
			var category_name = GetUrlValue('tag');

			function GetUrlValue(VarSearch){
			    var SearchString = window.location.search.substring(1);
			    var VariableArray = SearchString.split('&');
			    for(var i = 0; i < VariableArray.length; i++){
			        var KeyValuePair = VariableArray[i].split('=');
			        if(KeyValuePair[0] == VarSearch){
			            return KeyValuePair[1];
			        }
			    }
			}



			$("#gif_loader").hide();
		function addItem(pid,pcolor,pname,plikes,pdescription,pcat){

					var str = '<div id="img1" class="item"><div><a href="item.php?tag='+pcat+'#'+pid+'" ><div id="to_append_'+pid+'"></div></a></div><div class="color_like"><div class="colors"><div class="available_colors">';

					var arr = pcolor.split(",");
					for(var j1=0;j1<arr.length-1;j1++){
						str += '<div class="circle" style="background-color:'+arr[j1]+'"></div>&nbsp;';
					}
					str +=	'</div></div>';
					str+= '<div class="like"><div class="heart" id="heart_'+pid+'" onclick="addItemToFav('+pid+')">';
					if(isLoggedin=="1"){

						if(liked_array.indexOf(pid)!=-1){
							str += '<img src="../layout/heart_gray.png"/>';
						}
						else{
							str += '<img src="../layout/heart.png"/>';	
						}
					}
					else{
						str+='<img src="../layout/heart.png"/>';	
					}

					str += '</div><div><span id="countlike_'+pid+'">'+plikes+'</span> People like this</div></div></div><div class="description">'+pdescription+'</div>	</div>';

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
				function loadItems(nextX,total){
					for(i;i<total && i<nextX;i++){
						addItem(data.data[i]['pid'],data.data[i]['color'],data.data[i]['pname'],data.data[i]['likes'],data.data[i]['title'],data.data[i]['tags'].split(",")[0]);

					if(i>=n){
						
					}

					}
				}

				var liked_str ="";
				var liked_array = [];
				function updateLikedList(){
					$.ajax({
						type:"POST",
						url:"session.php",
						async:false,
						data:"getLikedList="+1,
						success:function(json){
							var temp = JSON.parse(json);
							if(temp.data!=null || temp.data!=""){
								liked_array = temp.data.split(",");
							}
						}
					});
				}

				if(isLoggedin=='1'){
					updateLikedList();
				}

				var data1 = <?php echo json_encode($res); ?>;
				var data = JSON.parse(data1);
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

				function selected_colors(){
					var selected_colors_list = new Array();
					$("#filter_color input:checked").each(function(){
						selected_colors_list.push($(this).attr('name'));
					});
					return selected_colors_list ;
				}

				function selected_category(){
					var selected_category_list = new Array();
					$("#category_list input:checked").each(function(){
						selected_category_list.push($(this).attr('name'));
					});
					return selected_category_list ;	
				}

				$(".check").change(function(){
					filter_items();
				});

				$("#all_category").change(function(){
					if($(this).is(":checked")){
						$("#category_list input:checked").each(function(){
							$(this).attr('checked',false);
						});
						filter_items();
					}
				});

				$(".cat_check").change(function(){
					if($(this).is(":checked")){
						$("#all_category").attr("checked",false);
					}
					filter_items();
				});

				function string_price(){
					return ("price>="+$("#slider-range").slider("values",0)*50+" AND price<="+$("#slider-range").slider("values",1)*50);
				}

				function string_color(){
					var color_array = selected_colors();
					if(color_array.length==0){
						return "" ;
					}
					else{
						var return_str = "";
						var i11=0;
						for(i11;i11<color_array.length-1;i11++){
							return_str+= "color LIKE %"+color_array[i11]+"% OR ";
						}
						return_str+= "color LIKE %"+color_array[i11]+"%";

						return return_str;
					}
				}

				function string_category(){
					var category_array = selected_category();
					if(category_array.length==0){
						return "";
					}
					else{
						var return_str = "";
						var i11=0;
						for(i11;i11<category_array.length-1;i11++){
							return_str+= "tags LIKE '%"+category_array[i11]+"%' OR ";
						}
						return_str+= "tags LIKE '%"+category_array[i11]+"%'";

						return return_str;	
					}
				}

				function make_query_string(){
					var query_string = "("+string_price()+")";
					var color_string = string_color();
					var category_string = string_category();
					if(color_string.length>1){
						query_string+=" AND ("+color_string+")";
					}
					if(category_string.length>1){
						query_string+=" AND ("+category_string+")";
					}
					return query_string;
				}

				function filter_items(){
					
					
					$.ajax({
						type:"POST",
						url:"filter_category.php",
						data:"filter_products="+make_query_string(),
						success:function(json){
							data1 = json;
							data = JSON.parse(data1);
							n = 0;
							$("#cat_left").empty();
							$("#cat_middle").empty();
							$("#cat_right").empty();
							if(data.success==1){
								 n =data.data.length;

								 i =0;
								 loadItems(i+9,n);
							}

						}
					});
				}



			</script>

	</body>	
</html>