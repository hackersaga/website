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
		<link href="account.css" rel="stylesheet">
		<script type="text/javascript">
			$(document).ready(function(){
				$("#instruction").hide();
				$("#total_money").html($("#subtotal").html());
				$(".response").hide();
				$(".gif").hide();
			});
		</script>
	</head>	

	<body>
		
		
		
		<div id="container">
			<center><div id="logo_site"><a href="index.php"><img src="../img/logo/dd.png" width="39%"></a></div></center>
			<form action="../backend/submit.php" method="POST" id="myform">
			<div id="instruction">Please fill all the entries.</div>
			<div id="firstname" class="row1">
				<div class="attr_name">Firstname</div>
				<div class="inputbox"><input type="text" id="firstname" name="firstname" value=<?php echo "$firstname";?> ></div>
			</div>

			<div id="lastname" class="row1">
				<div class="attr_name">Lastname</div>
				<div class="inputbox"><input type="text" id="lastname" name="lastname" value=<?php echo "$lastname";?> ></div>
			</div>

			<div id="mobile" class="row1">
				<div class="attr_name">Mobile</div>
				<div class="inputbox"><input type="text" id="mobile" name="mobile" value=<?php echo "$mobile";?> ></div>
			</div>

			<center>
				<div id="response0" class="row1 response">Error text</div>
				<div class="gif" id="gif_loader0"><img src="../img/ajax_loader.gif"></div>
				<div id="saveme0" class="cursor" ><img src="../img/item/save_changes.png"></div>
			</center>

			<hr>

			<div id="address" class="row1">
				<div class="attr_name">Address</div>
				<div class="inputbox"><textarea id="address" name="address" rows="2" class=""  ><?php echo "$address";?></textarea></div>
			</div>

			<div id="city" class="row1">
				<div class="attr_name">City</div>
				<div class="inputbox"><input type="text" id="city" name="city" value=<?php echo "$city";?> ></div>
			</div>

			<div id="country" class="row1">
				<div class="attr_name">Country</div>
				<div class="inputbox">
					<select id="country_select" name="country" width="250" >
						<option>India</option>
					</select>
				</div>
			</div>

			<div id="country" class="row1">
				<div class="attr_name">State</div>
				<div class="inputbox">
					<?php selectState($state);  ?>
				</div>
			</div>

			<div id="pincode" class="row1">
				<div class="attr_name">PIN</div>
				<div class="inputbox"><input type='text' id="pin" name="pin" value=<?php echo "$pin"; ?> ></div>
			</div>

			<center>
				<div id="response1" class="row1 response">Error text</div>
				<div class="gif" id="gif_loader1"><img src="../img/ajax_loader.gif"></div>
				<div id="saveme1" class="cursor" ><img src="../img/item/save_changes.png"></div>
			</center>

			<hr>
			<br>
			<div id="old_passwd" class="row1">
				<div class="attr_name">Old Password</div>
				<div class="inputbox"><input type="password" id="oldpwd" name="oldpwd" ></div>
			</div>
			<div id="new_passwd" class="row1">
				<div class="attr_name">New Password</div>
				<div class="inputbox"><input type="password" id="newpwd" name="newpwd" ></div>
			</div>
			<div id="cnew_passwd" class="row1">
				<div class="attr_name">Confirm New Password</div>
				<div class="inputbox"><input type="password" id="cnewpwd" name="cnewpwd" ></div>
			</div>
			
			<center>
				<div id="response2" class="row1 response">Error text</div>
				<div class="gif" id="gif_loader2"><img src="../img/ajax_loader.gif"></div>
				<div id="saveme2" class="cursor" ><img src="../img/item/save_changes.png"></div>
			</center>
			
		</form>


		</div>

		<script type="text/javascript">

			$(document).on('click',"#saveme0",function(e){
				var firstname1 = $("input[name='firstname']").val().trim();
				var lastname1 = $("input[name='lastname']").val().trim();
				var mobile1 =  $("input[name='mobile']").val().trim();
				if(firstname1.length<1 && lastname1.length<1){
					$("#response0").css("color","red");
					$("#response0").text("Please fill up firstname & lastname.");
				}
				else{
					$("gif_loader0").show();
					$("#response0").hide();
					$.ajax({
						type:"POST",
						url:"../backend/saveme.php",
						data:"firstname="+firstname1+"&lastname="+lastname1+"&mobile="+mobile1,
						success:function(json){
							var response = JSON.parse(json);
							$("gif_loader0").hide();
							if(response.success==1){
								$("#response0").css("color","#70d000");
								$("#response0").text(response.message);
							}
							else{
								$("#response0").css("color","red");
								$("#response0").text(response.message);	
							}
							$("#response0").show();
						}
					});
				}
				e.preventDefault();
			});

			$(document).on('click',"#saveme1",function(e){
				var address1 = $("textarea[name='address']").val().trim();
				var city1 = $("input[name='city']").val().trim();
				var pin = $("input[name='pin']").val().trim();
				var state1 = $("#state_select").val();
				var country1 = $("#country_select").val();
				alert(address1+" "+city1+" "+pin+" "+state1+" "+country1);
				$("gif_loader1").show();
				$("#response1").hide();
				$.ajax({
						type:"POST",
						url:"../backend/saveme.php",
						data:"address="+address1+"&city="+city1+"&state="+state1+"&country="+country1+"&pin="+pin,
						success:function(json){
							var response = JSON.parse(json);
							$("gif_loader1").hide();
							if(response.success==1){
								$("#response1").css("color","#70d000");
								$("#response1").text(response.message);
							}
							else{
								$("#response1").css("color","red");
								$("#response1").text(response.message);	
							}
							$("#response1").show();
						}
					});
				e.preventDefault();
			});

			$(document).on('click',"#saveme2",function(e){

				var newpwd = $("input[name='newpwd']").val().trim();
				var cnewpwd = $("input[name='cnewpwd']").val().trim();
				var oldpwd = $("input[name='oldpwd']").val().trim()
				if(newpwd.length>5){
					if(cnewpwd==newpwd){
						$("gif_loader2").show();
						$("#response2").hide();
						$.ajax({
								type:"POST",
								url:"../backend/saveme.php",
								data:"oldpwd="+oldpwd+"&newpwd="+newpwd,
								success:function(json){
									var response = JSON.parse(json);
									$("gif_loader2").hide();
									if(response.success==1){
										$("#response2").css("color","#70d000");
										$("#response2").text(response.message);
									}
									else{
										$("#response2").css("color","red");
										$("#response2").text(response.message);	
									}							
									$("#response2").show();
								}
							});
					}
					else{
						$("#response2").show();
						$("#response2").css("color","red");
						$("#response2").text('Password mismatch.');	
					}
				}
				else{
					$("#response2").show();
					$("#response2").css("color","red");
					$("#response2").text('Password should be atleast 6 characters long.');	
				}	
				e.preventDefault();
			});
	
		</script>
	</body>
</html>