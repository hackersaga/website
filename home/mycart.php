<?php
if(session_id() == '') {
    session_start();
}
?>
<html language="en">
	<head>
		<?php include_once("head.php"); ?>		
		<link href="mycart_css.css" rel="stylesheet">
		
		<script type="text/javascript">
			mycart = [];
			$(document).ready(function(){
				bindSearchEvent();
				$("#container").css("min-height","300px");
				mycart = <?php include_once('../backend/get_cart_elements.php'); ?>;
				var total_sub = 0;
				function addItem(pid,pprice,pname,psize,pqty){
					var str = '<div class="cart_item"><div id="'+pid+'" class="cart_image"><div id="rem_'+pid+'" class="remove">x</div></div><div class="cart_price">Rs. <span>'+moneyString(pprice)+'</span></div><div class="cart_specs">size <span class="size">'+psize+'</span> | quantity <span class="quantity">'+pqty+'</span></div><div class="cart_edit">EDIT</div></div>';

					$('<img src ="../img/small/'+pname+'">').load(function(){
						var left_ht = $("#cat_left").height();
						var mid_ht = $("#cat_middle").height();
						var right_ht = $("#cat_right").height();
						if(left_ht<=mid_ht && left_ht<=right_ht){
							$(str).appendTo("#cat_left");
							$(this).appendTo("#"+pid);
						}
						else if(mid_ht<=left_ht && mid_ht<=right_ht){
							$(str).appendTo("#cat_middle");
							$(this).appendTo("#"+pid);
						}
						else{
							$(str).appendTo("#cat_right");
							$(this).appendTo("#"+pid);
						}
						total_sub+=(pprice*pqty);
						$("#subtotal").html(total_sub);
						$("#total_money").html(total_sub);
					});
				}


				
				for(var i=0;i<mycart.length;i++){
					addItem(mycart[i]['pid'],mycart[i]['price'],mycart[i]['pname'],mycart[i]['size'],mycart[i]['qty']);
				}
				if(mycart.length==0){
					$("#no_elem").text('Your cart is empty. Click on "continue shopping" to add items to the cart :).');
				}


			});

			
		</script>
	</head>	

	<body>
		
		<?php if(isset($_SESSION['email'])) {include_once('login_header.php');} ?>		
		
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
				<div class="checkout_table">
				<table>
					<tr>
						<td class="underline">Sub Total</td>
						<td>Rs. <span id="subtotal">0</span></td>
					</tr>
					<tr>
						<td class="underline">Shipping</td>
						<td>Rs. 0</td>
					</tr>
					<tr rowspan="2">
						<td  class="underline">Total</td>
						<td>Rs. <span id="total_money">0</span></td>
					</tr>
				</table>
					
					<div  id="proceed_button"><a href="order.php"><div>
						<img src="../img/item/proceed_to_checkout.png"></div></a>
					</a></div>

					
					
					<div id="continue_button">
						<div><a href="category.php?tag=Women"><img src="../img/item/continue_shopping.png"></div>
					</div>
					
				</div>


		</div>	


		<script type="text/javascript">
			
		
			 
                    $(document).on('click','.cart_edit',function(){
                    	var elem = $(this).parent().children('.cart_image');
					var arr_elem = elem.children(".layer");
					if(arr_elem.length==0){
						elem.append('<div class="cart_edit_hover1 layer"></div>	<div class="layer cart_edit_hover2"><div class="cart_edit_option"><div><select id="select_size"><option>S</option><option>M</option><option>L</option><option>X</option></select>	</div><div><select id="select_qty"><option>1</option><option>2</option><option>3</option><option>4</option></select>	</div><div class="buttons"><div class="hover_button1 cursor" > Done</div><div class="hover_button2 cursor" > Cancel</div></div>	</div></div>');
						elem.children('.cart_edit_hover2').hide();
						elem.children('.cart_edit_hover2').slideDown(800,'easeOutExpo');

						var done = elem.children('.layer').children('.cart_edit_option').children('.buttons').children('.hover_button1');
						var cancel = elem.children('.layer').children('.cart_edit_option').children('.buttons').children('.hover_button2');

						var val_size = $(this).parent().children(".cart_specs").children(".size");
						var val_qty  = $(this).parent().children(".cart_specs").children(".quantity");

						var layer_val_size = elem.children(".cart_edit_hover2").children(".cart_edit_option").children("div").children("#select_size");
						var layer_val_qty = elem.children(".cart_edit_hover2").children(".cart_edit_option").children("div").children("#select_qty");

						layer_val_size.val(val_size.html());
						layer_val_qty.val(val_qty.html());
						
						done.on('click',function(){
							val_size.html(layer_val_size.val());
							val_qty.html(layer_val_qty.val());
							edit_cart(elem.attr('id'),layer_val_size.val(),layer_val_qty.val());
							$("#subtotal").html(newSubtotal());
							$("#total_money").html(newSubtotal());
							cancel.click();
						});

						cancel.on('click',function(){
							elem.children(".cart_edit_hover1").remove();
							elem.children('.cart_edit_hover2').slideUp(function(){
								$(this).remove();
							});
						});			


					}
                    });
            
			function edit_cart(cart_item_id,cart_item_size,cart_item_qty){
					$("#select_size").val("Select size");
					$("#select_qty").val("Select quantity");
					$.ajax({
						type:'POST',
						url:'session.php',
						data:'item_id='+cart_item_id+"&item_size="+cart_item_size+"&item_qty="+cart_item_qty,
						success:function(html){
									
						}
					});	
			}

			function newSubtotal(){
				var arr = $("#cat_left").children();
				arr = arr.add($("#cat_middle").children());
				arr = arr.add($("#cat_right").children());
				var new_price = 0;

				for(var m11=0;m11<arr.length;m11++){
					var this_price = 0;
					var this_id = $(arr[m11]).children(".cart_image").attr('id');
					for(var n11=0;n11<mycart.length;n11++){
						if(this_id==mycart[n11]['pid']){
							this_price = mycart[n11]['price'];
						}
					}
					new_price+=(this_price*$(arr[m11]).children('.cart_specs').children('.quantity').html());
					//alert((this_price+" "+$(arr[m11]).children('.cart_specs').children('.quantity').html()));
					
				}
				return new_price;
			}
			
			$(document).on('click',".remove",function(){
				var this_id = $(this).attr('id').split("_")[1];
				var this_item  = $(this);
				$.ajax({
					type:'POST',
					url:'session.php',
					data:'item_id='+this_id+"&remove=1",
					success:function(str){
						if(str=="1"){
							this_item.parent().parent().remove();
							$("#subtotal").text(newSubtotal());
							$("#total_money").text(newSubtotal());
						}
					}
				});	
			});

		</script>


	</body>	
</html>	