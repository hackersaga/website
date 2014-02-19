<?php if(session_id() == '') {
    session_start();
}
?>
<html language="en">
	<head>
		<?php 
			include_once("head.php"); 
			include_once('../backend/get_order_data.php');
		?>		
		<link href="order_css.css" rel="stylesheet">
		<script type="text/javascript">
			$(document).ready(function(){
				$("#instruction").hide();
				$("#total_money").html($("#subtotal").html());
				$("#document").css("min-height",$(document).height());
			});
		</script>
	</head>	

	<body>
		
		
		<div>
		<div id="container">
			<center><div id="logo_site"><img src="../img/logo/dd.png" width="39%"></div></center>
			<form action="../backend/submit.php" method="POST" id="myform">
			<div id="instruction">Please fill all the entries.</div>
			<div id="firstname" class="row1">
				<div class="attr_name">Recipient's Firstname<span style="color:red">*</span></div>
				<div class="inputbox"><input id="firstname" name="firstname" value=<?php echo "$firstname";?> ></div>
			</div>

			<div id="lastname" class="row1">
				<div class="attr_name">Recipient's Lastname<span style="color:red">*</span></div>
				<div class="inputbox"><input id="lastname" name="lastname" value=<?php echo "$lastname";?> ></div>
			</div>

			<div id="email" class="row1">
				<div class="attr_name">Email address<span style="color:red">*</span></div>
				<div class="inputbox"><input id="email" name="email" value=<?php echo "$email";?> ></div>
			</div>

			<div id="mobile" class="row1">
				<div class="attr_name">Mobile<span style="color:red">*</span></div>
				<div class="inputbox"><input id="mobile" name="mobile" value=<?php echo "$mobile";?> ></div>
			</div>

			<hr>

			<div id="address" class="row1">
				<div class="attr_name">Address<span style="color:red">*</span></div>
				<div class="inputbox"><textarea id="address" name="address" rows="2" class=""  ><?php echo "$address";?></textarea></div>
			</div>

			<div id="city" class="row1">
				<div class="attr_name">City<span style="color:red">*</span></div>
				<div class="inputbox"><input id="city" name="city" value=<?php echo "$city";?> ></div>
			</div>

			<div id="country" class="row1">
				<div class="attr_name">Country<span style="color:red">*</span></div>
				<div class="inputbox">
					<select id="country_select" name="country" width="250" >
						<option>India</option>
					</select>
				</div>
			</div>

			<div id="country" class="row1">
				<div class="attr_name">State<span style="color:red">*</span></div>
				<div class="inputbox">
					<?php selectState($state);  ?>
				</div>
			</div>

			<div id="pincode" class="row1">
				<div class="attr_name">PIN<span style="color:red">*</span></div>
				<div class="inputbox"><input id="pin" name="pincode" value=<?php echo "$pin"; ?> ></div>
			</div>

			<div id="text_payment">
				Please choose from the following payment option
			</div>

			<div id="billing">
				<div id="payment_option">
						<div><div class="radio_input"><input type="radio" name="mode" value="online" disabled></div><div class="text_input">credit card/ debit card/ net banking  (coming soon!)</div></div>
						<div><div class="radio_input"><input type="radio" name="mode" value="cash" checked></div><div class="text_input">cash on delivery</div></div>
				</div>
				
				<div class="checkout_table">
					<table>
						<tr>
							<td>Sub Total</td>
							<td>Rs. <span id="subtotal"><?php echo "$subtotal";?></span></td>
						</tr>
						<tr>
							<td>Shipping</td>
							<td>*TBD</td>
						</tr>
						<tr rowspan="2">
							<td>Total</td>
							<td>Rs. <span id="total_money">0</span></td>
						</tr>
					</table>
				<div id="confirm" class="cursor">
						
				<img src="../img/item/confirm_order.png">
				</div>
		
				</div>


			</div>
			
		</form>


		</div>

		<script type="text/javascript">

			$("#confirm").click(function(e){
				var firstname1 = $("input[name='firstname']").val().trim();
				var lastname1 = $("input[name='lastname']").val().trim();
				var mobile1 =  $("input[name='mobile']").val().trim();
				var email1 = $("input[name='email']").val().trim();
				var address1 = $("input[name='mobile']").val().trim();
				var city1 = $("input[name='city']").val().trim();
				var state1 = $("#state_select").val();
				if(firstname1!="" && lastname1!="" && mobile1!="" && email1!="" && address1!="" && city1!=""  && state1!="Select state"){
						document.forms["myform"].submit();
				}
				else{
					$("#instruction").hide();
					$("#instruction").show('fast');
					
				}
				e.preventDefault();
			});
	
		</script>
	</body>
</html>